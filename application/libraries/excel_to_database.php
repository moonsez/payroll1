<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  =====================================================
 *  Author     : Prabir Sen 
 *  Purpose    : Insert Data From Excel File To Database
 *  =====================================================
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Excel_to_database extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
        $CI =& get_instance(); 
        $CI->load->model('database_excel');    
		//$CI->load->database();     
		//$CI->load->library("session");
    } 

    function excelFileDataToDatabase($inputFileName)
    {
    	$CI =& get_instance();     	
		$CI->load->library('excel_to_database');


		//$inputFileName = 'users_97_2003.xls';  // 97-2003 format Excel File to read
		//$inputFileName = 'users.xlsx';  // New format Excel File to read

		//$inputFileName = $filename;	 
		
	 
	 	//  Read your Excel workbook
		try 
		{
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName); // Excel5 or Excel2007
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);			
			$objPHPExcel = $objReader->load($inputFileName);
		} 
		catch(Exception $e) 
		{
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); // return integer ex:- 3
		$highestColumn = $sheet->getHighestColumn(); // return highest column ex:- D

		$path_parts = pathinfo($inputFileName); //Array ( [dirname] => ./upload [basename] => users_97_2003.xls [extension] => xls [filename] => users_97_2003 ) 
		$excelFileName = $path_parts['filename']; // users_97_2003
		$tableName = 'tbl_'.$excelFileName;

		$firstRowData = '';
		$firstRowDataArray = '';
		// Column Name For Database Table
		$firstRowData = $sheet->rangeToArray('A1:' . $highestColumn .'1',NULL,TRUE,FALSE);
	
		$firstRowDataArray = $firstRowData[0];  //Array ( [0] =>

		$num_columns = count($firstRowDataArray);

		// CREATE TABLE INTO DATABASE
		$table_sql = "create table ". $tableName. " (`user_id` int(11) NOT NULL AUTO_INCREMENT, ";
		  	for ($i = 0; $i < $num_columns; $i++) 
		  	{
		    	$table_sql .= str_replace(' ', '_', strtolower($firstRowDataArray[$i])) ." varchar(255)";

		    	if(($i+1) != $num_columns)
		    	{ 
		    		$table_sql.=", "; 
		    	}
		  	}
		$table_sql .= ", display ENUM('Y','N') NOT NULL DEFAULT 'Y', PRIMARY KEY  (`user_id`), UNIQUE KEY (`user_id`))";

		//echo $table_sql;

		$table_exist_or_not = $CI->db->query("SHOW TABLES LIKE '".$tableName."'");

		if($table_exist_or_not->num_rows()==1)
		{
			echo "Table '".$tableName."' already exists.";
			echo '<br/>';
		}  
		else
		{
			$CI->db->query($table_sql);			
		}
		// END DYNAMIC CREATE TABLE

		$tableColName = $CI->database_excel->fetchColumnName($tableName);
		$colName = '';
		if(isset($tableColName) && !empty($tableColName))
		{
			foreach ($tableColName as $key) 
			{
				$colName .= $key->Field.',';				
			}			
		}

		$colName = substr($colName, 0, -1);

		$sql = ''; // query
		$rowData = '';
		$DataArr ='';
		$sqlCreate = '';
		$result_insert = '';

		for ($row = 1; $row <= $highestRow; $row++)
		{ 
			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);	
			$DataArr = $rowData[0];			
			$columnVal = '';

			for ($col_name = 0; $col_name < sizeof($DataArr); $col_name++) 
			{
				if($DataArr[$col_name]=='')
				{
					echo "Empty row number ".$row;
					echo '<br/>';
				}
				$columnVal .= ",'".$DataArr[$col_name]."'";
			}			
			 
			if($row==1) 
			{
				// get headings
			} 
			else 
			{				

				$sql = "INSERT INTO ".$tableName."(".$colName.") VALUES(''".$columnVal.",'Y');"; 
	  			// echo $sql;
	  			// echo '<br/>';	 
	  			$result_insert = $CI->db->query($sql); 	

				//$result_insert = mysql_query($sql) or die(mysql_error());		
			}
	
			//print_r($rowData);
		}

		if($result_insert)
		{
			echo '<br/>';
			echo 'Succssfully inserted '.($highestRow-1).' records to the database';
		}
		else
		{
			echo "Error in database query";
		}

	 	//if($result_insert) echo 'Succssfully Inserted '.($highestRow-1).' records to the Database';		
	}
}