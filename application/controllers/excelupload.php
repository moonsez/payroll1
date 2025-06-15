<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /*
	Author :- Vishal
	work :- 

 */

class excelupload extends CI_Controller {

	public function uploadform(){

		$this->load->view('uploadexcel');
	}

	public function uploadAttendance(){

		//$compLogoImg='';	
		//$fileName = $this->input->post('slip_months');
		$this->load->library('excel_reader');

		// Read the spreadsheet via a relative path to the document
		// for example $this->excel_reader->read('./uploads/file.xls');
		

		$config['upload_path'] = './excelfiles/attendance/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '30000';
		// $config['max_width']  = '1024';
		// $config['max_height']  = '768'; //

		$this->load->library('upload', $config);
		//$this->load->library('reader');
		$this->load->model('importExcel');

		if ( ! $this->upload->do_upload())
		{
			//$error = array('error' => $this->upload->display_errors());
			//print_r($error);
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Excel Upload !</div>'
			));
			
			//$this->load->view('upload_form', $error); 
		}
		else
		{
			$data = $this->upload->data();
			$fileName = $data['file_name'];

				// public function excelToDatabase()
				// {
					
					$fileName1 = './excelfiles/attendance/'.$fileName;
					$this->load->library('excel_to_database');
					$this->excel_to_database->excelFileDataToDatabase($fileName1);
				// }
				// print_r($data);
				// if ($data) {
				// 	//$fileName = $data['file_name'];

				// 	$this->excel_reader->read('./excelfiles/attendance/sample.xls');
				// 	// $excel->read($fileName); 
				// 	 //$excel->read('sample1.xlxs');
				
				// 	$x=2;
				// 	while($x<=$excel_reader->sheets[0]['numRows']) {
				// 		$emp_name = isset($excel_reader->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
				// 		$emp_id = isset($excel_reader->sheets[0]['cells'][$x][2]) ? $excel->sheets[0]['cells'][$x][2] : '';
				// 		$no_day = isset($excel_reader->sheets[0]['cells'][$x][3]) ? $excel->sheets[0]['cells'][$x][3] : '';
				// 		$date_salary = isset($excel_reader->sheets[0]['cells'][$x][4]) ? $excel->sheets[0]['cells'][$x][4] : '';
						
				// 		// Save details
						
						
				// 		 $data[] = array('emp_name'=>$emp_name,
				// 					'emp_id'=>$emp_id,
				// 					'no_day'=>$no_day,
				// 					'date'=>$date_salary);

				// 		 $this->importExcel->insertData($data);
				// 		//$result_insert = mysql_query($sql_insert) or die(mysql_error()); 
						 
				// 	  $x++;
				// 	}
					//
					$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Excel Upload Successfully!</div>'
				));
				}
			
			$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Excel Upload Successfully!</div>'
				));
			//$this->load->view('upload_success', $data);
		}


		

	}

	// public function readExcelFile(){

	// 	$excel->read('sample.xls'); 
	// 		// $excel->read('sample1.xlxs');
			
	// 		$x=2;
	// 		while($x<=$excel->sheets[0]['numRows']) {
	// 			$name = isset($excel->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
	// 			$job = isset($excel->sheets[0]['cells'][$x][2]) ? $excel->sheets[0]['cells'][$x][2] : '';
	// 			$email = isset($excel->sheets[0]['cells'][$x][3]) ? $excel->sheets[0]['cells'][$x][3] : '';
	// 			$location = isset($excel->sheets[0]['cells'][$x][4]) ? $excel->sheets[0]['cells'][$x][4] : '';
				
	// 			// Save details
	// 			$sql_insert="INSERT INTO users_details (id,name,job,email,location) VALUES ('','$name','$job','$email','$location')";
	// 			$result_insert = mysql_query($sql_insert) or die(mysql_error()); 
				 
	// 		  $x++;
	// 		}
	// }

