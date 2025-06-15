<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : VISHAL GURHALE 
 *  Purpose    : Generating Salary Slip


 *  ======================================= 
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
 
class excel_lib extends PHPExcel { 
    public function __construct() {  
        parent::__construct(); 
        $CI =& get_instance();  
        $CI->load->model('slip_aks_model');  
    }
    function salarySlipGenerateInExcelFormat($reportData,$totalAmount,$compName,$emp_ac_type)
    {
    	//print_r($reportData);
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	//load our new PHPExcel library
   		$CI->load->library('excel_lib');
   		// $company_id =$reportData->company_id;

		 // $imageName = $CI->slip_aks_model->getImageName($company_id);
	
		$CI->excel_lib->getProperties()->setCreator("Moon Education Pvt. Ltd")
							 	   ->setLastModifiedBy("Moon Education Pvt. Ltd")
							 	   ->setTitle("Pay Slip")
							 	   ->setSubject("Pay Slip Of An Employee")
							 	   ->setDescription("System Generated File.")
							 	   ->setKeywords("office 2007")
							 	   ->setCategory("Confidential");

		//activate worksheet number 1
		$company= "Salary Report of ".$compName." For ".$emp_ac_type;
		$CI->excel_lib->setActiveSheetIndex(0);
		$CI->excel_lib->getActiveSheet()->setCellValue('A1',$company);
		//change the font size
		//change the font name
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);	
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel_lib->getActiveSheet()->mergeCells('A1:H1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		// code for title style and font 
	
		


		
		foreach(range('A','H') as $columnID) {
		    $CI->excel_lib->getActiveSheet()->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}

		$styleThickBrownBorderOutline = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THICK,
					'color' => array('argb' => 'FF993300'),
				),
			),
		);
		$CI->excel_lib->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);
		$CI->excel_lib->getActiveSheet()->setCellValue('A2', 'Sr.No');
		// $CI->excel_lib->getActiveSheet()->setCellValue('B2', 'Emp Id');
		$CI->excel_lib->getActiveSheet()->setCellValue('B2', 'Name');
		// $CI->excel_lib->getActiveSheet()->setCellValue('D2', 'Comp Name');
		// $CI->excel_lib->getActiveSheet()->setCellValue('E2', 'Designation');
		$CI->excel_lib->getActiveSheet()->setCellValue('C2', 'No Of Days');
		$CI->excel_lib->getActiveSheet()->setCellValue('D2', 'Bank Name');
		$CI->excel_lib->getActiveSheet()->setCellValue('E2', 'Branch Name');
		$CI->excel_lib->getActiveSheet()->setCellValue('F2', 'IFSC Code');
		$CI->excel_lib->getActiveSheet()->setCellValue('G2', 'EMP A/C-NO');
		$CI->excel_lib->getActiveSheet()->setCellValue('H2', 'Net Pay');
		//record start
		$i=3;
		$j=1;
		

		

		if (isset($reportData) && !empty($reportData)) 
		{	
			$countCell = 0;
			foreach ($reportData as $key) 
			{
				$CI->excel_lib->getActiveSheet()->setCellValue('A'.$i,$j);
				// $CI->excel_lib->getActiveSheet()->setCellValue('B'.$i, $key->comp_employee_id);
				$CI->excel_lib->getActiveSheet()->setCellValue('B'.$i, $key->emp_name);
				// $CI->excel_lib->getActiveSheet()->setCellValue('D'.$i, $key->emp_comp_name);
				// $CI->excel_lib->getActiveSheet()->setCellValue('E'.$i, $key->emp_designation);
				$CI->excel_lib->getActiveSheet()->setCellValue('C'.$i, $key->emp_working_days);
				$CI->excel_lib->getActiveSheet()->setCellValue('D'.$i, $key->bank_name);
				$CI->excel_lib->getActiveSheet()->setCellValue('E'.$i, $key->bank_branch);
				$CI->excel_lib->getActiveSheet()->setCellValue('F'.$i, $key->bank_ifc_code);
				$CI->excel_lib->getActiveSheet()->setCellValueExplicit('G'.$i,$key->emp_acc_no,PHPExcel_Cell_DataType::TYPE_STRING);
				$CI->excel_lib->getActiveSheet()->setCellValue('H'.$i, $key->net_pay);
				$i++;
				$j++;
				$countCell =$i;

			}			
			//print total amount
			$countCell =$countCell +2;
			$CI->excel_lib->getActiveSheet()->setCellValue('G'.$countCell, 'Total Amount');
			$CI->excel_lib->getActiveSheet()->setCellValueExplicit('H'.$countCell,$totalAmount,PHPExcel_Cell_DataType::TYPE_STRING);
			$CI->excel_lib->getActiveSheet()->getStyle('G'.$countCell.':H'.$countCell)->getFont()->setSize(13);	
			$CI->excel_lib->getActiveSheet()->getStyle('G'.$countCell.':H'.$countCell)->getFont();
		} 


		//$name_date = date('d/m/Y'); 
		$filename='Report-'.$compName.'-'.$current_date.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel_lib, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output'); 
    }


    // excel for allowance 

    function salarySlipGenerateInExcelFormat1($reportData,$totalAmount,$compName,$emp_ac_type)
    {
    	//print_r($reportData);
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	//load our new PHPExcel library
   		$CI->load->library('excel_lib');
   		// $company_id =$reportData->company_id;

		 // $imageName = $CI->slip_aks_model->getImageName($company_id);
	
		$CI->excel_lib->getProperties()->setCreator("Moon Education Pvt. Ltd")
							 	   ->setLastModifiedBy("Moon Education Pvt. Ltd")
							 	   ->setTitle("Pay Slip")
							 	   ->setSubject("Pay Slip Of An Employee")
							 	   ->setDescription("System Generated File.")
							 	   ->setKeywords("office 2007")
							 	   ->setCategory("Confidential");

		//activate worksheet number 1
		$company= "Salary Report of ".$compName." For ".$emp_ac_type;
		$CI->excel_lib->setActiveSheetIndex(0);
		$CI->excel_lib->getActiveSheet()->setCellValue('A1','Allowance '.$company);
		//change the font size
		//change the font name
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);	
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel_lib->getActiveSheet()->mergeCells('A1:H1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		// code for title style and font 
	
		


		
		foreach(range('A','H') as $columnID) {
		    $CI->excel_lib->getActiveSheet()->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}

		$styleThickBrownBorderOutline = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THICK,
					'color' => array('argb' => 'FF993300'),
				),
			),
		);
		$CI->excel_lib->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);
		$CI->excel_lib->getActiveSheet()->setCellValue('A2', 'Sr.No');
		// $CI->excel_lib->getActiveSheet()->setCellValue('B2', 'Emp Id');
		$CI->excel_lib->getActiveSheet()->setCellValue('B2', 'Name');
		// $CI->excel_lib->getActiveSheet()->setCellValue('D2', 'Comp Name');
		// $CI->excel_lib->getActiveSheet()->setCellValue('E2', 'Designation');
		$CI->excel_lib->getActiveSheet()->setCellValue('C2', 'No Of Days');
		$CI->excel_lib->getActiveSheet()->setCellValue('D2', 'Bank Name');
		$CI->excel_lib->getActiveSheet()->setCellValue('E2', 'Branch Name');
		$CI->excel_lib->getActiveSheet()->setCellValue('F2', 'IFSC Code');
		$CI->excel_lib->getActiveSheet()->setCellValue('G2', 'EMP A/C-NO');
		$CI->excel_lib->getActiveSheet()->setCellValue('H2', 'Net Pay');
		//record start
		$i=3;
		$j=1;
		

		

		if (isset($reportData) && !empty($reportData)) 
		{	
			$countCell = 0;
			foreach ($reportData as $key) 
			{
				$CI->excel_lib->getActiveSheet()->setCellValue('A'.$i,$j);
				// $CI->excel_lib->getActiveSheet()->setCellValue('B'.$i, $key->comp_employee_id);
				$CI->excel_lib->getActiveSheet()->setCellValue('B'.$i, $key->emp_name);
				// $CI->excel_lib->getActiveSheet()->setCellValue('D'.$i, $key->emp_comp_name);
				// $CI->excel_lib->getActiveSheet()->setCellValue('E'.$i, $key->emp_designation);
				$CI->excel_lib->getActiveSheet()->setCellValue('C'.$i, $key->workin_day);
				$CI->excel_lib->getActiveSheet()->setCellValue('D'.$i, $key->bank_name);
				$CI->excel_lib->getActiveSheet()->setCellValue('E'.$i, $key->bank_branch);
				$CI->excel_lib->getActiveSheet()->setCellValue('F'.$i, $key->bank_ifc_code);
				$CI->excel_lib->getActiveSheet()->setCellValueExplicit('G'.$i,$key->bank_acc_no,PHPExcel_Cell_DataType::TYPE_STRING);
				$CI->excel_lib->getActiveSheet()->setCellValue('H'.$i, $key->net_allowance_amt);
				$i++;
				$j++;
				$countCell =$i;

			}			
			//print total amount
			$countCell =$countCell +2;
			$CI->excel_lib->getActiveSheet()->setCellValue('G'.$countCell, 'Total Amount');
			$CI->excel_lib->getActiveSheet()->setCellValueExplicit('H'.$countCell,$totalAmount,PHPExcel_Cell_DataType::TYPE_STRING);
			$CI->excel_lib->getActiveSheet()->getStyle('G'.$countCell.':H'.$countCell)->getFont()->setSize(13);	
			$CI->excel_lib->getActiveSheet()->getStyle('G'.$countCell.':H'.$countCell)->getFont();
		} 


		//$name_date = date('d/m/Y'); 
		$filename='Report-'.$compName.'-'.$current_date.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel_lib, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output'); 
    }


     function GenerateInExcelFormatBasicReport($reportData,$totalAmount,$compName)
    {
    	//print_r($reportData);
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	//load our new PHPExcel library
   		$CI->load->library('excel_lib');
   		// $company_id =$reportData->company_id;

		 // $imageName = $CI->slip_aks_model->getImageName($company_id);
	
		$CI->excel_lib->getProperties()->setCreator("Moon Education Pvt. Ltd")
							 	   ->setLastModifiedBy("Moon Education Pvt. Ltd")
							 	   ->setTitle("Pay Slip")
							 	   ->setSubject("Pay Slip Of An Employee")
							 	   ->setDescription("System Generated File.")
							 	   ->setKeywords("office 2007")
							 	   ->setCategory("Confidential");

		//activate worksheet number 1
		$company= "Salary Report of ".$compName;
		$CI->excel_lib->setActiveSheetIndex(0);
		$CI->excel_lib->getActiveSheet()->setCellValue('A1','Basic '.$company);
		//change the font size
		//change the font name
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);	
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$CI->excel_lib->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel_lib->getActiveSheet()->mergeCells('A1:H1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		// code for title style and font 
	
		


		
		foreach(range('A','H') as $columnID) {
		    $CI->excel_lib->getActiveSheet()->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}

		$styleThickBrownBorderOutline = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THICK,
					'color' => array('argb' => 'FF993300'),
				),
			),
		);
		$CI->excel_lib->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);
		$CI->excel_lib->getActiveSheet()->setCellValue('A2', 'Sr.No');
		// $CI->excel_lib->getActiveSheet()->setCellValue('B2', 'Emp Id');
		$CI->excel_lib->getActiveSheet()->setCellValue('B2', 'Name');
		// $CI->excel_lib->getActiveSheet()->setCellValue('D2', 'Comp Name');
		// $CI->excel_lib->getActiveSheet()->setCellValue('E2', 'Designation');
		$CI->excel_lib->getActiveSheet()->setCellValue('C2', 'No Of Days');
		$CI->excel_lib->getActiveSheet()->setCellValue('D2', 'Bank Name');
		$CI->excel_lib->getActiveSheet()->setCellValue('E2', 'Branch Name');
		$CI->excel_lib->getActiveSheet()->setCellValue('F2', 'IFSC Code');
		$CI->excel_lib->getActiveSheet()->setCellValue('G2', 'EMP A/C-NO');
		$CI->excel_lib->getActiveSheet()->setCellValue('H2', 'Net Pay');
		//record start
		$i=3;
		$j=1;
		

		

		if (isset($reportData) && !empty($reportData)) 
		{	
			$countCell = 0;
			foreach ($reportData as $key) 
			{
				$CI->excel_lib->getActiveSheet()->setCellValue('A'.$i,$j);
				// $CI->excel_lib->getActiveSheet()->setCellValue('B'.$i, $key->comp_employee_id);
				$CI->excel_lib->getActiveSheet()->setCellValue('B'.$i, $key->emp_name);
				// $CI->excel_lib->getActiveSheet()->setCellValue('D'.$i, $key->emp_comp_name);
				// $CI->excel_lib->getActiveSheet()->setCellValue('E'.$i, $key->emp_designation);
				$CI->excel_lib->getActiveSheet()->setCellValue('C'.$i, $key->work_day);
				$CI->excel_lib->getActiveSheet()->setCellValue('D'.$i, $key->bank_name);
				$CI->excel_lib->getActiveSheet()->setCellValue('E'.$i, $key->bank_branch);
				$CI->excel_lib->getActiveSheet()->setCellValue('F'.$i, $key->bank_ifc_code);
				$CI->excel_lib->getActiveSheet()->setCellValueExplicit('G'.$i,$key->bank_acc_no,PHPExcel_Cell_DataType::TYPE_STRING);
				$CI->excel_lib->getActiveSheet()->setCellValue('H'.$i, $key->net_pay);
				$i++;
				$j++;
				$countCell =$i;

			}			
			//print total amount
			$countCell =$countCell +2;
			$CI->excel_lib->getActiveSheet()->setCellValue('G'.$countCell, 'Total Amount');
			$CI->excel_lib->getActiveSheet()->setCellValueExplicit('H'.$countCell,$totalAmount,PHPExcel_Cell_DataType::TYPE_STRING);
			$CI->excel_lib->getActiveSheet()->getStyle('G'.$countCell.':H'.$countCell)->getFont()->setSize(13);	
			$CI->excel_lib->getActiveSheet()->getStyle('G'.$countCell.':H'.$countCell)->getFont();
		} 


		//$name_date = date('d/m/Y'); 
		$filename='Report-'.$compName.'-'.$current_date.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel_lib, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output'); 
    }
}