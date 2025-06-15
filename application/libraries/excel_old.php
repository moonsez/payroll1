<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : VISHAL GURHALE  
 *  Purpose    : Generating Salary Slip
 *  ======================================= 
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Excel extends PHPExcel { 
    public function __construct() {  
        parent::__construct(); 
        $CI =& get_instance();  
        $CI->load->model('slip_aks_model');   
		//$CI->load->database();     
		//$CI->load->library("session");

    } 
/*
	[emp_id] => 13 [company_id] => 27 [employee_id] => ME 08 [emp_name] => Prabir Sen [emp_loc] => pune headoffice [desig_id] => 39 [date_of_birth] => 1986-10-02 [bank_acc_no] => 31579746142 [bank_name] => SBI Bank [bank_ifc_code] => SBIN0000575 [bank_branch] => Pimpri Branch, Pune [emp_ac_type] => OTOBC [date_of_joining] => 2014-05-12 [emp_pan_num] => CDHPS7527Q [gender] => Male [emp_basic] => 10000 [advance_amount] => [display] => Y [basic_pt_id] => 34 [basic_amt] => 12650 [pt_amt] => 200 [work_day] => 30.0 [salary_month] => 03-2015 [net_pay] => 12042 ) Array ( [0] => stdClass Object ( [emp_earn_allow_sal_id] => 20 [allowance_details_id] => 13 [company_id] => 29 [emp_id] => 13 [allowance_sal_date] => 03-2015 [emp_earn_allow_id] => 331 [emp_earn_name] => conveyance allowance [earn_value] => 968 [convey_allowance_type] => fixed_amount [display] => Y ) [1] => stdClass Object ( [emp_earn_allow_sal_id] => 21 [allowance_details_id] => 13 [company_id] => 29 [emp_id] => 13 [allowance_sal_date] => 03-2015 [emp_earn_allow_id] => 332 [emp_earn_name] => House Rent Allowance [earn_value] => 3871 [convey_allowance_type] => Fixed [display] => Y ) ) Array ( [0] => stdClass Object ( [emp_deduct_sal_id] => 4 [emp_id] => 13 [company_id] => 29 [emp_deduct_id] => 274 [emp_deduct_name] => Mobile Deductions [allowance_sal_date] => 03-2015 [deduct_value] => 200 [display] => Y [allowance_details_id] => 13 ) ) 
*/
    function salarySlipGenerateInExcelFormat($employee_basic_info, $static_earn_data, $static_deduct_data, $companyDetails,$pay_slip_month)
    {  
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	 
    	$CI->load->library('excel');

    	$month_year_array = explode('-', $pay_slip_month);			  
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 	
			

    	$sundays = $employee_basic_info->sundays_in_month;
    	$holidays = $employee_basic_info->holidays_in_month;
    	$work_day = $employee_basic_info->work_day;
    	$actual_day = ($sundays + $holidays) - ($work_day);


		// Set document properties
		 $company_id = $employee_basic_info->company_id;
		 $imageName = $CI->slip_aks_model->getImageName($company_id); //
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
		$CI->excel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
		$CI->excel->getActiveSheet()->setCellValue('A1', $companyDetails[0]->company_name); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
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

		$CI->excel->getActiveSheet()->setCellValue('A2', $companyDetails[0]->company_add); 
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
		//change the font size
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
		//$CI->excel->getActiveSheet()->getStyle('A2')
				//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells('A2:F3')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)

		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);

		$CI->excel->getActiveSheet()->getStyle('E4:F4')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue('E4', 'Date:');
		$CI->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
									//->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$CI->excel->getActiveSheet()->getStyle('F14')->getFont()->setName('Bookman Old Style');
		
		$CI->excel->getActiveSheet()->setCellValue('F4', $current_date)
									->getStyle('F4')->getAlignment()->setShrinkToFit(true);

		$CI->excel->getActiveSheet()->setCellValue('C5', 'PAYSLIP');
		
		//change the font size
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('C5')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('C5')->getFont()->setSize(12);	
		$CI->excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('C5:D5')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		$final_month_year = '';
		if(isset($employee_basic_info->salary_month) && !empty($employee_basic_info->salary_month))
		{
			$salary_month = $employee_basic_info->salary_month;
			$month_year = explode('-', $salary_month);
			$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)).' '.$month_year[1];
		}
		
		$CI->excel->getActiveSheet()->setCellValue('C6', $final_month_year);
		//change the font size
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('C6')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('C6')->getFont()->setSize(11);	
		$CI->excel->getActiveSheet()->getStyle('C6')->getFont();
		$CI->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('C6:D6')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		$CI->excel->getActiveSheet()->setCellValue('A8', 'Employee Name');
		$CI->excel->getActiveSheet()->getStyle('A8')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue('A9', 'Designation');
		$CI->excel->getActiveSheet()->getStyle('A9')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue('A10', 'PAN No');
		$CI->excel->getActiveSheet()->getStyle('A10')->getFont()->setBold(true);
		/*$CI->excel->getActiveSheet()->setCellValue('A11', 'Loca10ion.');
		$CI->excel->getActiveSheet()->setCellValue('A12', 'PAN No..');*/

		//$CI->excel->getActiveSheet()->getStyle('A')->getAlignment()->setShrinkToFit(true);
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont()->setSize(8);	
		$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont();
		
		$CI->excel->getActiveSheet()->setCellValue('B8', $employee_basic_info->emp_name);
		$CI->excel->getActiveSheet()->mergeCells('B8:C8');
		$CI->excel->getActiveSheet()->setCellValue('B9', $employee_basic_info->desig_name); //$employee_basic_info->emp_designation 
		$CI->excel->getActiveSheet()->mergeCells('B9:C9');
		$CI->excel->getActiveSheet()->setCellValue('B10', $employee_basic_info->emp_pan_num); 
		$CI->excel->getActiveSheet()->mergeCells('B10:C10');
	/*	$CI->excel->getActiveSheet()->mergeCells('B10:C10');
		$CI->excel->getActiveSheet()->setCellValue('B11', $employee_basic_info->emp_loc); //
		$CI->excel->getActiveSheet()->mergeCells('B11:C11');*/
		//$CI->excel->getActiveSheet()->setCellValue('B10', $employee_basic_info->gender);
		//$CI->excel->getActiveSheet()->setCellValue('B11', $employee_basic_info->emp_loc);
		/*$CI->excel->getActiveSheet()->setCellValue('B12', $employee_basic_info->emp_pan_num);
		$CI->excel->getActiveSheet()->mergeCells('B12:C12');*/
		//$CI->excel->getActiveSheet()->getStyle('A')->getAlignment()->setShrinkToFit(true);
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont()->setSize(8);	
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont();
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


		// the workday and date of joinig Payslip No :-
		/*$CI->excel->getActiveSheet()->setCellValue('D8', 'Working Days');*/
		$CI->excel->getActiveSheet()->setCellValue('D8', 'Payslip No');
		$CI->excel->getActiveSheet()->getStyle('D8')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue('D9', 'Date Of Joining');
		$CI->excel->getActiveSheet()->getStyle('D9')->getFont()->setBold(true);
		
		$CI->excel->getActiveSheet()->setCellValue('D10', 'Employee Code');
		$CI->excel->getActiveSheet()->getStyle('D10')->getFont()->setBold(true);
		/*$CI->excel->getActiveSheet()->setCellValue('D11', 'Date Of Birth');

		$CI->excel->getActiveSheet()->setCellValue('D12', 'Employee Id');*/

		//$CI->excel->getActiveSheet()->setCellValue('E8', $employee_basic_info->work_day);
		$CI->excel->getActiveSheet()->setCellValue('E8','');
		$CI->excel->getActiveSheet()->mergeCells('E8:F8');
		$CI->excel->getActiveSheet()->setCellValue('E9', date('d M Y',strtotime($employee_basic_info->date_of_joining)));
		$CI->excel->getActiveSheet()->mergeCells('E9:F9');
		$CI->excel->getActiveSheet()->setCellValueExplicit('E10',$employee_basic_info->employee_id, PHPExcel_Cell_DataType::TYPE_STRING); //$employee_basic_info->emp_acc_no
		$CI->excel->getActiveSheet()->mergeCells('E10:F10');
		/*$CI->excel->getActiveSheet()->mergeCells('E10:F10');
		$CI->excel->getActiveSheet()->setCellValue('E11', date('d M Y',strtotime($employee_basic_info->date_of_birth))); //date('d M Y',strtotime($employee_basic_info->emp_date_of_birth))
		$CI->excel->getActiveSheet()->mergeCells('E11:F11');
		$CI->excel->getActiveSheet()->setCellValue('E12', $employee_basic_info->employee_id); //$employee_basic_info->employee_id
		$CI->excel->getActiveSheet()->mergeCells('E12:F12');*/
		//
		// the workday and date of joinig
		/*$CI->excel->getActiveSheet()->setCellValue('E8', 'Advance Details');
		$CI->excel->getActiveSheet()->getStyle('E8')->getFont()->setBold(true);
		
		$CI->excel->getActiveSheet()->mergeCells('E8:F8')
									->getStyle()
									->getFill()									
									->getStartColor()->setARGB('EEEEEEEE');*/
		//$CI->excel->getActiveSheet()->getStyle('E8:F8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		/*$CI->excel->getActiveSheet()->setCellValue('E9', 'Opening');
		$CI->excel->getActiveSheet()->setCellValue('E10', 'Recovery');
		$CI->excel->getActiveSheet()->setCellValue('E11', 'Addition');

		$CI->excel->getActiveSheet()->setCellValue('E12', 'Closing');*/

		/*$CI->excel->getActiveSheet()->setCellValue('F9','');
		$CI->excel->getActiveSheet()->setCellValue('F10','');
		$CI->excel->getActiveSheet()->setCellValueExplicit('F11','', PHPExcel_Cell_DataType::TYPE_STRING);
		$CI->excel->getActiveSheet()->setCellValue('F12','');*/
		
		
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('C8:F10')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('C8:F10')->getFont()->setSize(8);	
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('F8:F10')->getFont()->setName('Bookman Old Style');														  
		$CI->excel->getActiveSheet()->getStyle('F8:F10')->getFont()->setSize(8);
		$CI->excel->getActiveSheet()->getStyle('C8:F10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$CI->excel->getActiveSheet()->getStyle('C8:F10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		
		//table content of Earning Data
		$CI->excel->getActiveSheet()->setCellValue('A11', 'Sr No');
		$CI->excel->getActiveSheet()->setCellValue('B11', 'Payments');
		$CI->excel->getActiveSheet()->setCellValue('C11', 'Amount Rs');
		
		$perDay = $employee_basic_info->allowances/$num_days_of_month;
		$total_allowance = $perDay*$work_day;
		//basic details
		$CI->excel->getActiveSheet()->setCellValue('A12', '1');
		$CI->excel->getActiveSheet()->setCellValue('B12', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('C12', ((($employee_basic_info->net_pay)-($employee_basic_info->convey+$employee_basic_info->hra)+(($employee_basic_info->other_deduct+$employee_basic_info->mobile_deduction)+($employee_basic_info->pt_amt)))-($total_allowance)));



		$earn = '13';
		$earn_sr = '2';
		$earn_col_sr = 'A';
		$earn_col_name = 'B';
		$earn_col_value = 'C';
		$earnTotal = 0;
		if (isset($employee_basic_info->convey) && !empty($employee_basic_info->convey)) {
				$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
				$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, 'conveyance');
				$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,$employee_basic_info->convey);
				$earn++;
				//$earnTotal = $earnTotal + $employee_basic_info->convey;
			}
			if (isset($employee_basic_info->hra) && !empty($employee_basic_info->hra)) {
				$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
				$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, 'House Rent');
				$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,$employee_basic_info->hra);
				$earn++;
				//$earnTotal = $earnTotal + $employee_basic_info->hra;
			}

		if (isset($employee_basic_info->earn_arrears) && !empty($employee_basic_info->earn_arrears)) {
				$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
				$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, 'Arrears');
				$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,$employee_basic_info->earn_arrears);
				$earn++;
				$earnTotal = $earnTotal + $employee_basic_info->earn_arrears;
			}
			$earnTotal_final=0;
		if (isset($static_earn_data) && !empty($static_earn_data)) 
		{	
			
			foreach ($static_earn_data as $key) 
			{   $value=0;
				$per_day = 0;

				if ($key->earning_id==6) {
					$value = $key->value;
				}else{
					
					$per_day = $key->value/$num_days_of_month;
					$value = $per_day*$work_day;
				}

				$perDday_earn = $key->value/$num_days_of_month;
				$earnvalue = $perDday_earn*$work_day;
				$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
				$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, $key->earning_name);
				$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,$earnvalue);
				$earn++;
				
				//$earnTotal_final = $earnTotal_final + $value;
				$earnTotal = $earnTotal + $earnvalue;
			}

		}

		//table content of Deduction Data
		$CI->excel->getActiveSheet()->setCellValue('D11', 'Sr No.');
		$CI->excel->getActiveSheet()->setCellValue('E11', 'Deductions');
		$CI->excel->getActiveSheet()->setCellValue('F11', 'Amount Rs');

		//record start
		$deduct = '12';
		$deduct_sr = '1';
		$deduct_col_sr = 'D';
		$deduct_col_name = 'E';
		$deduct_col_value = 'F';
		$deductTotal = 0;

		if ($employee_basic_info->pt_amt > 0) {
						
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, 'profetional tax');
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, $employee_basic_info->pt_amt);
			$deductTotal = $deductTotal + $employee_basic_info->pt_amt;
			$deduct++;
		}
		if (isset($employee_basic_info->mobile_deduction) && !empty($employee_basic_info->mobile_deduction)) {
			
			//$earnTotal = $earnTotal + $employee_basic_info->convey;
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, 'Mobile Deduction');
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, $employee_basic_info->mobile_deduction);
			

			$deductTotal = $deductTotal + $employee_basic_info->mobile_deduction;
			$deduct++;
		}

		if (isset($employee_basic_info->other_deduct) && !empty($employee_basic_info->other_deduct)) {
			
			//$earnTotal = $earnTotal + $employee_basic_info->convey;
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, 'Other Deductions (Arrears)');
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, $employee_basic_info->other_deduct);
			$deductTotal = $deductTotal + $employee_basic_info->other_deduct;
			$deduct++;
		}

		if (isset($static_deduct_data) && !empty($static_deduct_data)) 
		{ 
			foreach ($static_deduct_data as $key) 
			{
				$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
				$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, $key->emp_deduct_name);
				$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, $key->deduct_value);
				$deduct++;
				$deductTotal = $deductTotal + $key->deduct_value;
			}			
		}
			
		$max_value = max($earn,$deduct);
		$max_value = $max_value+1;	  
		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$max_value, 'Total Pay');
		//
		$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$max_value, (($employee_basic_info->net_pay+$deductTotal) + $earnTotal)-($total_allowance));
		//
		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.($max_value-1), ''); //Advance deduction Amount
		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.($max_value-1), '');//advance value here 

		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$max_value, 'Total Deductions'); 
		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$max_value, $deductTotal);
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


		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$earn.':'.$deduct_col_value.$max_value)->applyFromArray($styleThickBrownBorderCalculateTitle2);
		
		


		$max_value = $max_value+2;

		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$max_value, 'Net Pay');
		$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$max_value, ((($employee_basic_info->net_pay+$deductTotal) + $earnTotal)-($deductTotal))-($total_allowance)); 
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+1)), 'In Word');
		//getStyle($earn_col_sr.$max_value.':'.$deduct_col_value.$max_value)
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+3)), 'Snap-shot');
		$CI->excel->getActiveSheet()->mergeCells(($earn_col_sr.($max_value+3)).':'.($deduct_col_value.($max_value+3)));
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+3)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+3)))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+3)))->getFont()->setSize(12);	
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+3)))->getFont()->setBold(true);

		//$in_word="Ten Thousend Five Humdred fifty only.";
		$CI->excel->getActiveSheet()->getStyle($earn_col_name.($max_value+1))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle($earn_col_name.($max_value+1))->getFont()->setSize(8)->setBold(true);
		$CI->excel->getActiveSheet()->mergeCells($earn_col_value.($max_value+1).':F'.($max_value+1));
		$words = $CI->convert_num_to_words->convert_number_to_words(((($employee_basic_info->net_pay+$deductTotal) + $earnTotal)-($deductTotal))-($total_allowance));
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_value.($max_value+1)),ucfirst($words) ); //
		$CI->excel->getActiveSheet()->getStyle($earn_col_value.($max_value+1))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle($earn_col_value.($max_value+1))->getFont()->setSize(8);
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+1).':'.$deduct_col_value.($max_value+1))->applyFromArray($styleThickBrownBorderCalculate);
		//$max_value = $max_value+2;
		/********************* start raviraj ****************************/
		$max_value = $max_value+2;
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+2)), 'Days in Month');
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+2))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+3)), 'Leaves in Month');
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+3))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+4)),'Present Days');
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+5)),'Period of Service');
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+5))->getFont()->setBold(true);

		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+4))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)).':A'.($max_value+5))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)).':A'.($max_value+5))->getFont()->setSize(8);	
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)).':A'.($max_value+5))->getFont();
		
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+2)), $num_days_of_month);
		$CI->excel->getActiveSheet()->mergeCells(($earn_col_name.($max_value+2)).':C'.($max_value+2));
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+3)), ($num_days_of_month-$work_day)); //$employee_basic_info->emp_designation 
		$CI->excel->getActiveSheet()->mergeCells(($earn_col_name.($max_value+3)).':C'.($max_value+3));
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+4)), $work_day); 
		$CI->excel->getActiveSheet()->mergeCells(($earn_col_name.($max_value+4)).':C'.($max_value+4));
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+5)), ''); 

		$CI->excel->getActiveSheet()->mergeCells(($earn_col_name.($max_value+5)).':C'.($max_value+5));
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+2)).':B'.($max_value+5))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+2)).':B'.($max_value+5))->getFont()->setSize(8);	
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+2)).':B'.($max_value+5))->getFont();
		//$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+2)).':B'.($max_value+4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr.($max_value+2)), 'Advance (Opening)');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr.($max_value+3)), 'Advance (Addition)');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+3)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr.($max_value+4)), 'Advance (Recovery)');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+4)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr.($max_value+5)), 'Advance (closing)');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+5)))->getFont()->setBold(true);
		


		/************************************** advance code start here **************************************************************************************************/
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name.($max_value+2)), $employee_basic_info->advance_opening);
		$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name.($max_value+2)).':F'.($max_value+2));
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name.($max_value+3)), $employee_basic_info->advance_Addition); //$employee_basic_info->emp_designation 
		$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name.($max_value+3)).':F'.($max_value+3));
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name.($max_value+4)), $employee_basic_info->advance_recovery); 
		$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name.($max_value+4)).':F'.($max_value+4));
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name.($max_value+5)), $employee_basic_info->advance_closing_amt); 
		$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name.($max_value+5)).':F'.($max_value+5));
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)).':E'.($max_value+5))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)).':E'.($max_value+5))->getFont()->setSize(8);	
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)).':E'.($max_value+5))->getFont();
		/******************** end advance ***************************************************************************/

		
		
		$max_value = $max_value-1;
		/******************** end raviraj here ***************************/


		//note
		$note=" Note :-This document contains confidential information. If you are not the intended recipient you are not authorized to use or disclose it in any form. If you received this in error please destroy it along with any copies & notify the sender immediately.";
		// $note2="";
		// $note3="";
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.($max_value+7),$note);
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7))->getFont()->setName('Bookman Old Style');
		//change the font size 
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7))->getFont()->setSize(8);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7))->getFont();
		//set row height
		$CI->excel->getActiveSheet()->getRowDimension('1')
									->setRowHeight(40);
		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells($earn_col_sr.($max_value+7).':'.$deduct_col_value.($max_value+9))
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7).':'.$deduct_col_value.($max_value+9))
    					->getAlignment()->setWrapText(true); 
    	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7).':'.$deduct_col_value.($max_value+7))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7).':'.$deduct_col_value.($max_value+9))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		// $CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+2).':F'.($max_value+2)), $note);
		// $CI->excel->getActiveSheet()->mergeCells($earn_col_value.$max_value);
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7).':'.$deduct_col_value.($max_value+9))->applyFromArray($styleThickBrownBorderCalculate);
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7).':'.$deduct_col_value.($max_value+9))->applyFromArray($styleThickBrownBorderCalculate);

		//$CI->excel->getActiveSheet()->getStyle('C15:C23')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
/*		$CI->excel->getActiveSheet()->getStyle('F15:'.$deduct_col_value.$max_value)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1); 		  
		$CI->excel->getActiveSheet()->getStyle('A15:'.$deduct_col_value.$max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/
		//$CI->excel->getActiveSheet()->getStyle('D15:D23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$CI->excel->getActiveSheet()->getStyle('F16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		 
		/*$CI->excel->getActiveSheet()->getStyle('A15:'.$deduct_col_value.$max_value)->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('A15:'.$deduct_col_value.$max_value)->getFont()->setSize(8);
		$CI->excel->getActiveSheet()->getStyle('C15:'.$earn_col_value.$max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$CI->excel->getActiveSheet()->getStyle('B15:'.$earn_col_name.$max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$CI->excel->getActiveSheet()->getStyle('E15:'.$deduct_col_name.$max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$CI->excel->getActiveSheet()->getStyle('F15:'.$deduct_col_value.$max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		*/// $CI->excel->getActiveSheet()->getStyle('B15:B23')->getFont()->setSize(11)->setBold(true);
		// $CI->excel->getActiveSheet()->getStyle('C15:C23')->getFont()->setSize(11)->setBold(true);
		// $CI->excel->getActiveSheet()->getStyle('D15:D23')->getFont()->setSize(11)->setBold(true);
		// $CI->excel->getActiveSheet()->getStyle('E15:E23')->getFont()->setSize(11)->setBold(true);
		// $CI->excel->getActiveSheet()->getStyle('F15:F23')->getFont()->setSize(11)->setBold(true);
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setSize(9);	
		$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A11:F11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$earn.':'.$deduct_col_value.($max_value+1))->getFont()->setName('Bookman Old Style');


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
		

		
		
		
		$styleThickBrownBorderCalculateTitle = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					
				),
			),
		);
		//$CI->excel->getActiveSheet()->getStyle('A13:'.$deduct_col_value.$max_value)->applyFromArray($styleThickBrownBorderCalculateTitle);
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
		$CI->excel->getActiveSheet()->getStyle('A8:B12')->applyFromArray($styleThickBrownBorderCalculateTitle1);
			$CI->excel->getActiveSheet()->getStyle('C8:F12')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A14:F14')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A14:'.$deduct_col_value.($max_value))->applyFromArray($styleThickBrownBorderCalculate);
		//$CI->excel->getActiveSheet()->getStyle($earn_col_name.$max_value.''.)->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A4:'.$deduct_col_value.($max_value+9))->applyFromArray($styleThickBrownBorderOutline);
		$CI->excel->getActiveSheet()->getStyle('E8:F8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
		
		if(isset($imageName) && !empty($imageName))
		{
			$path = './images/logo/'.$imageName;
			if(file_exists($path))
			{
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Logo');
				$objDrawing->setDescription('Logo');
				$objDrawing->setPath($path);
				$objDrawing->setHeight(60);
				$objDrawing->setWorksheet($CI->excel->getActiveSheet());
			}			
		}
		else
		{
			
		}		
		 
		//$name_date = date('d/m/Y'); 
		$filename=$employee_basic_info->emp_name.'-'.$current_date.'.xls'; //save our workbook as this file name
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