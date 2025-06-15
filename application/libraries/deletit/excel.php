<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Prabir Sen 
 *  Purpose    : Generating Salary Slip
 *  ======================================= 
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Excel extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
        $CI =& get_instance();     
		//$CI->load->database();     
		//$CI->load->library("session");
    } 

    function salarySlipGenerateInExcelFormat($employee_basic_info, $static_earn_data, $static_deduct_data)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	//load our new PHPExcel library
		$CI->load->library('excel');

		// print_r($employee_basic_info);		
		// print_r($static_earn_data);	
		// print_r($static_deduct_data);

		// Set document properties
		$CI->excel->getProperties()->setCreator("Moon Education Pvt. Ltd")
							 	   ->setLastModifiedBy("Moon Education Pvt. Ltd")
							 	   ->setTitle("Pay Slip")
							 	   ->setSubject("Pay Slip Of An Employee")
							 	   ->setDescription("System Generated File.")
							 	   ->setKeywords("office 2007")
							 	   ->setCategory("Confidential");

		//activate worksheet number 1
		$CI->excel->setActiveSheetIndex(0);
		//name the worksheet
		$CI->excel->getActiveSheet()->setTitle('test worksheet');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', $employee_basic_info->emp_comp_name);
		//change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//set row height
		$CI->excel->getActiveSheet()->getRowDimension('1')
									->setRowHeight(40);
		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells('A1:F1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$CI->excel->getActiveSheet()->setCellValue('A2', $employee_basic_info->company_add);
		//change the font size
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells('A2:F2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

		$CI->excel->getActiveSheet()->getStyle('E4:F4')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue('E4', 'Date:');
									//->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$CI->excel->getActiveSheet()->setCellValue('F4', $current_date)
									->getStyle('F4')->getAlignment()->setShrinkToFit(true);

		$CI->excel->getActiveSheet()->setCellValue('C5', 'PAYSLIP');
		//change the font size
		$CI->excel->getActiveSheet()->getStyle('C5')->getFont()->setSize(11);	
		$CI->excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('C5:D5')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		$final_month_year = '';
		if(isset($employee_basic_info->pay_slip_month) && !empty($employee_basic_info->pay_slip_month))
		{
			$pay_slip_month = $employee_basic_info->pay_slip_month;
			$month_year = explode('-', $pay_slip_month);
			$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)).' '.$month_year[1];
		}
		
		$CI->excel->getActiveSheet()->setCellValue('C6', $final_month_year);
		//change the font size
		$CI->excel->getActiveSheet()->getStyle('C6')->getFont()->setSize(11);	
		$CI->excel->getActiveSheet()->getStyle('C6')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('C6:D6')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		$CI->excel->getActiveSheet()->setCellValue('A8', 'Employee Name');
		$CI->excel->getActiveSheet()->setCellValue('A9', 'Designation');
		$CI->excel->getActiveSheet()->setCellValue('A10', 'Gender');
		$CI->excel->getActiveSheet()->setCellValue('A11', 'Location.');
		$CI->excel->getActiveSheet()->setCellValue('A12', 'PAN No..');

		//$CI->excel->getActiveSheet()->getStyle('A')->getAlignment()->setShrinkToFit(true);
		$CI->excel->getActiveSheet()->getStyle('A8:A12')->getFont()->setSize(11);	
		$CI->excel->getActiveSheet()->getStyle('A8:A12')->getFont()->setBold(true);
		
		$CI->excel->getActiveSheet()->setCellValue('B8', $employee_basic_info->emp_name);
		$CI->excel->getActiveSheet()->setCellValue('B9', $employee_basic_info->emp_designation);
		$CI->excel->getActiveSheet()->setCellValue('B10', $employee_basic_info->emp_gender);
		$CI->excel->getActiveSheet()->setCellValue('B11', $employee_basic_info->emp_location);
		//$CI->excel->getActiveSheet()->setCellValue('B10', $employee_basic_info->gender);
		//$CI->excel->getActiveSheet()->setCellValue('B11', $employee_basic_info->emp_loc);
		$CI->excel->getActiveSheet()->setCellValue('B12', $employee_basic_info->emp_pan_num);

		//$CI->excel->getActiveSheet()->getStyle('A')->getAlignment()->setShrinkToFit(true);
		$CI->excel->getActiveSheet()->getStyle('B8:B12')->getFont()->setSize(11);	
		$CI->excel->getActiveSheet()->getStyle('B8:B12')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('B8:B12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


		// the workday and date of joinig
		$CI->excel->getActiveSheet()->setCellValue('E8', 'Working Days');
		$CI->excel->getActiveSheet()->setCellValue('E9', 'Date Of Joining');
		$CI->excel->getActiveSheet()->setCellValue('E10', 'Bank A/C No');
		$CI->excel->getActiveSheet()->setCellValue('E11', 'Date Of Birth');

		$CI->excel->getActiveSheet()->setCellValue('E12', 'Employee Id');

		$CI->excel->getActiveSheet()->setCellValue('F8', $employee_basic_info->emp_working_days);
		$CI->excel->getActiveSheet()->setCellValue('F9', date('d M Y',strtotime($employee_basic_info->date_of_joining)));
		$CI->excel->getActiveSheet()->setCellValueExplicit('F10', $employee_basic_info->emp_acc_no, PHPExcel_Cell_DataType::TYPE_STRING);
		$CI->excel->getActiveSheet()->setCellValue('F11', date('d M Y',strtotime($employee_basic_info->emp_date_of_birth)));
		$CI->excel->getActiveSheet()->setCellValue('F12', $employee_basic_info->emp_id);

		$CI->excel->getActiveSheet()->getStyle('E8:E12')->getFont()->setSize(11)->setBold(true);	
																  
		$CI->excel->getActiveSheet()->getStyle('F8:F12')->getFont()->setSize(11)->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('F8:F12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		
		//table content of Earning Data
		$CI->excel->getActiveSheet()->setCellValue('A14', 'Sr No');
		$CI->excel->getActiveSheet()->setCellValue('B14', 'Earnings');
		$CI->excel->getActiveSheet()->setCellValue('C14', 'Amount Rs');

		//basic details
		$CI->excel->getActiveSheet()->setCellValue('A15', '1');
		$CI->excel->getActiveSheet()->setCellValue('B15', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('C15', $employee_basic_info->emp_basic);

		$earn = '16';
		$earn_sr = '2';
		$earn_col_sr = 'A';
		$earn_col_name = 'B';
		$earn_col_value = 'C';

		if (isset($static_earn_data) && !empty($static_earn_data)) 
		{
			foreach ($static_earn_data as $key) 
			{
				$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
				$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, $key->static_earn_name);
				$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn, $key->static_earn_value);
				$earn++;
			}			
		}

		//table content of Deduction Data
		$CI->excel->getActiveSheet()->setCellValue('D14', 'Sr No.');
		$CI->excel->getActiveSheet()->setCellValue('E14', 'Deductions');
		$CI->excel->getActiveSheet()->setCellValue('F14', 'Amount Rs');

		//record start
		$deduct = '15';
		$deduct_sr = '1';
		$deduct_col_sr = 'D';
		$deduct_col_name = 'E';
		$deduct_col_value = 'F';

		if (isset($static_deduct_data) && !empty($static_deduct_data)) 
		{
			foreach ($static_deduct_data as $key) 
			{
				$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
				$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, $key->static_deduct_name);
				$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, $key->static_deduct_value);
				$deduct++;
			}			
		}
			
		$max_value = max($earn,$deduct);
		$max_value = $max_value+1;	  
		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$max_value, 'Total Pay');
		//
		$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$max_value, $employee_basic_info->total_pay);
		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$max_value, 'Total Deductions'); 
		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$max_value, $employee_basic_info->total_deduct);
		$styleThickBrownBorderCalculateTitle2 = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					
				),
			),
		);

		$styleThickBrownBorderCalculate = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					
				),
			),
		);


		$CI->excel->getActiveSheet()->getStyle($earn_col_name.$max_value.':'.$deduct_col_value.$max_value)->applyFromArray($styleThickBrownBorderCalculateTitle2);
		
		$max_value = $max_value+2;

		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$max_value, 'Net Pay');
		$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$max_value, $employee_basic_info->net_pay); 
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+2)), 'In Word');
		//
		//$in_word="Ten Thousend Five Humdred fifty only.";
		$CI->excel->getActiveSheet()->mergeCells($earn_col_value.($max_value+2).':F'.($max_value+2));
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_value.($max_value+2)), $employee_basic_info->inword);

		//note
		$note=" Note :-This document contains confidential information. If you are not the intended recipient you are not authorized to use or disclose it in any form. If you received this in error please destroy it along with any copies & notify the sender immediately.";
		// $note2="";
		// $note3="";
		
		
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.($max_value+6),$note);
		//change the font size
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+6))->getFont()->setSize(14);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+6))->getFont()->setBold(true);
		//set row height
		$CI->excel->getActiveSheet()->getRowDimension('1')
									->setRowHeight(40);
		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells($earn_col_sr.($max_value+6).':'.$deduct_col_value.($max_value+6))
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+6).':'.$deduct_col_value.($max_value+6))
    					->getAlignment()->setWrapText(true); 
    	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+2).':'.$deduct_col_value.($max_value+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				
		// $CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+2).':F'.($max_value+2)), $note);
		// $CI->excel->getActiveSheet()->mergeCells($earn_col_value.$max_value);
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+2).':'.$deduct_col_value.($max_value+1))->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+2).':'.$deduct_col_value.($max_value+1))->applyFromArray($styleThickBrownBorderCalculate);

		$CI->excel->getActiveSheet()->getStyle('C15:C23')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$CI->excel->getActiveSheet()->getStyle('F15:F23')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 		  
		$CI->excel->getActiveSheet()->getStyle('A15:A23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$CI->excel->getActiveSheet()->getStyle('D15:D23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$CI->excel->getActiveSheet()->getStyle('F16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		 

		$CI->excel->getActiveSheet()->getStyle('A15:A23')->getFont()->setSize(11)->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('B15:B23')->getFont()->setSize(11)->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('C15:C23')->getFont()->setSize(11)->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('D15:D23')->getFont()->setSize(11)->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('E15:E23')->getFont()->setSize(11)->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('F15:F23')->getFont()->setSize(11)->setBold(true);

		$CI->excel->getActiveSheet()->getStyle('A14:F14')->getFont()->setSize(11);	
		$CI->excel->getActiveSheet()->getStyle('A14:F14')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A14:F14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		

		foreach(range('A','F') as $columnID) {
		    $CI->excel->getActiveSheet()->getColumnDimension($columnID)
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
		$CI->excel->getActiveSheet()->getStyle('A3:F27')->applyFromArray($styleThickBrownBorderOutline);

		
		$CI->excel->getActiveSheet()->getStyle('A15:F18')->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle('B15:B18')->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle('C15:C18')->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle('D15:D18')->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle('E15:E18')->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle('F15:F18')->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle('A25:F27')->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle('A25:F27')->applyFromArray($styleThickBrownBorderCalculate);
		
		$styleThickBrownBorderCalculateTitle = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					
				),
			),
		);
		$CI->excel->getActiveSheet()->getStyle('A13:F18')->applyFromArray($styleThickBrownBorderCalculateTitle);
		//$CI->excel->getActiveSheet()->getStyle('A12:A18')->applyFromArray($styleThickBrownBorderCalculateTitle);
		//
		$styleThickBrownBorderCalculateTitle1 = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					
				),
			),
		);
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$max_value.':'. $deduct_col_value.$max_value)->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A8:F12')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A14:F14')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A14:A18')->applyFromArray($styleThickBrownBorderCalculate);
		//$CI->excel->getActiveSheet()->getStyle($earn_col_name.$max_value.''.)->applyFromArray($styleThickBrownBorderCalculateTitle1);
		

		//
		//
		// $styleThickBrownBorderCalculateTitle = array(
		// 	'borders' => array(
		// 		'outline' => array(
		// 			'style' => PHPExcel_Style_Border::BORDER_THIN,
					
		// 		),
		// 	),
		// );
		// $CI->excel->getActiveSheet()->getStyle('A13:F18')->applyFromArray($styleThickBrownBorderCalculateTitle);	

		// Add a drawing to the worksheet A12:F12
		//echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;		
		/*$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo');
		$objDrawing->setDescription('Logo');
		$objDrawing->setPath($path);
		$objDrawing->setHeight(60);
		$objDrawing->setWorksheet($CI->excel->getActiveSheet());*/
		 
		$filename=$employee_basic_info->emp_name.'.xls'; //save our workbook as this file name
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
		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output'); 
    }
    
   
}