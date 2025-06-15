<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Rahul Pimpalkar  
 *  Purpose    : Generating Salary Slip
 *  ======================================= 
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Excel extends PHPExcel { 
    public function __construct()
    {  
        parent::__construct(); 
        $CI =& get_instance();  
        $CI->load->model('slip_aks_model');
    } 

    // function salarySlipGenerateInExcelFormat($employee_basic_info, $static_earn_data, $static_deduct_data, $companyDetails,$pay_slip_month)
    // {  
    // 	$CI =& get_instance(); 
    // 	/*date_default_timezone_set('Asia/kolkata');*/
    // 	$current_date = date('d/m/Y');    	 
    // 	$CI->load->library('excel');

    // 	$month_year_array = explode('-', $pay_slip_month);			  
	// 	$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 	
			

    // 	$sundays = $employee_basic_info->sundays_in_month;
    // 	$holidays = $employee_basic_info->holidays_in_month;
    // 	$work_day = $employee_basic_info->work_day;
    // 	$actual_day = ($sundays + $holidays) - ($work_day);


	// 	// Set document properties
	// 	 $company_id = $employee_basic_info->company_id;
	// 	 $imageName = $CI->slip_aks_model->getImageName($company_id); //
	// 	$CI->excel->getProperties()->setCreator("Moon Education Pvt. Ltd")
	// 						 	   ->setLastModifiedBy("Moon Education Pvt. Ltd")
	// 						 	   ->setTitle("Pay Slip")
	// 						 	   ->setSubject("Pay Slip Of An Employee")
	// 						 	   ->setDescription("System Generated File.")
	// 						 	   ->setKeywords("office 2007")
	// 						 	   ->setCategory("Confidential");

	// 	//border lines
	// 	$styleThickBrownBorderCalculateTitle2 = array(
	// 		'borders' => array(
	// 			'allborders' => array(
	// 				'style' => PHPExcel_Style_Border::BORDER_THIN,			
	// 			),
	// 		),
	// 	);

	// 	$styleThickBrownBorderCalculate = array(
	// 		'borders' => array(
	// 			'outline' => array(
	// 				'style' => PHPExcel_Style_Border::BORDER_THIN,
					
	// 			),
	// 		),
	// 	);

	// 	//activate worksheet number 1
	// 	$CI->excel->setActiveSheetIndex(0);
	// 	//name the worksheet
	// 	$CI->excel->getActiveSheet()->setTitle('Payslip');
	// 	//set cell A1 content with some text
	// 	$CI->excel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
	// 	$CI->excel->getActiveSheet()->setCellValue('A1', $companyDetails->company_name);
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleThickBrownBorderCalculateTitle2);
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	// 	//set row height
	// 	$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
	// 	//merge cell A1 until D1
	// 	$CI->excel->getActiveSheet()->mergeCells('A1:F1');
	// 								/*->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('EEEEEEEE');*/

	// 	//set aligment to center for that merged cell (A1 to D1)
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	// 	//$CI->excel->getActiveSheet()->setCellValue('A2', $companyDetails->address);
	// 	$CI->excel->getActiveSheet()->setCellValue('A2','Office No. 310, 311, 312, Pride Purple Square, Kalewadi Phata, Wakad, Pune- 411057');
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
	// 	//change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
	// 	//merge cell A1 until D1
	// 	$CI->excel->getActiveSheet()->mergeCells('A2:F3')
	// 								->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('EEEEEEEE');

	// 	//set aligment to center for that merged cell (A1 to D1)

	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);
		
	// 	$CI->excel->getActiveSheet()->getRowDimension('7')->setVisible(FALSE);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(20);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(25);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(20);							
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(30);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);
						
	// 	$final_month_year = '';
	// 	if(isset($employee_basic_info->salary_month) && !empty($employee_basic_info->salary_month))
	// 	{
	// 		$salary_month = $employee_basic_info->salary_month;
	// 		$month_year = explode('-', $salary_month);
	// 		$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)).' '.$month_year[1];
	// 		$month = date("F", mktime(0, 0, 0, $month_year[0], 10));
	// 	}
		
	// 	$CI->excel->getActiveSheet()->setCellValue('A5', 'PAYSLIP - '.$final_month_year);
	// 	$CI->excel->getActiveSheet()->mergeCells('A5:F5');
	// 	$CI->excel->getActiveSheet()->getStyle('A5:F5')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('A5:F5')->getFont()->setSize(12);	
	// 	$CI->excel->getActiveSheet()->getStyle('A5:F5')->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle('A5:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	// 	$CI->excel->getActiveSheet()->setCellValue('A8', 'Employee Name');		
	// 	$CI->excel->getActiveSheet()->setCellValue('A9', 'Designation');		
	// 	$CI->excel->getActiveSheet()->setCellValue('A10', 'PAN No');	
		
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getRowDimension('A8:A10')->setRowHeight(18);
	// 	$CI->excel->getActiveSheet()->getStyle('B8:B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		
	// 	$CI->excel->getActiveSheet()->setCellValue('B8', $employee_basic_info->emp_name);
	// 	$CI->excel->getActiveSheet()->mergeCells('B8:C8');
	// 	$CI->excel->getActiveSheet()->setCellValue('B9', $employee_basic_info->title);
	// 	$CI->excel->getActiveSheet()->mergeCells('B9:C9');
	// 	$CI->excel->getActiveSheet()->setCellValue('B10', $employee_basic_info->emp_pan_num); 
	// 	$CI->excel->getActiveSheet()->mergeCells('B10:C10');
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont()->setSize(10);
	// 	$CI->excel->getActiveSheet()->getRowDimension('B8:B10')->setRowHeight(18);	
	// 	$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont();
	// 	$CI->excel->getActiveSheet()->getStyle('B8:B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

	// 	// the workday and date of joinig Payslip No :-
	// 	$CI->excel->getActiveSheet()->setCellValue('D8', 'Payslip No');
	// 	$CI->excel->getActiveSheet()->getStyle('D8')->getFont()->setBold(true);
		
	// 	$CI->excel->getActiveSheet()->setCellValue('D9', 'Date Of Joining');
	// 	$CI->excel->getActiveSheet()->getStyle('D9')->getFont()->setBold(true);
		
	// 	$CI->excel->getActiveSheet()->setCellValue('D10', 'Employee Code');
	// 	$CI->excel->getActiveSheet()->getStyle('D10')->getFont()->setBold(true);
		
	// 	$CI->excel->getActiveSheet()->mergeCells('E8:F8');
	// 	$CI->excel->getActiveSheet()->setCellValue('E8',date("F", mktime(0, 0, 0, $month_year[0], 10)).'/'.$month_year[1].'/'.$employee_basic_info->emp_id);
		
	// 	$CI->excel->getActiveSheet()->mergeCells('E9:F9');
	// 	$CI->excel->getActiveSheet()->setCellValue('E9', date('d M Y',strtotime($employee_basic_info->date_of_joining)));
		
	// 	$CI->excel->getActiveSheet()->mergeCells('E10:F10');
	// 	$CI->excel->getActiveSheet()->setCellValue('E10',$employee_basic_info->username);

	// 	$CI->excel->getActiveSheet()->getStyle('E8:E10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('C8:D10')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('C8:D10')->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle('C8:D10')->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getRowDimension('C8:D10')->setRowHeight(18);
	// 	$CI->excel->getActiveSheet()->getStyle('C8:D10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('E8:F10')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('E8:F10')->getFont()->setSize(10);
	// 	$CI->excel->getActiveSheet()->getRowDimension('E8:F10')->setRowHeight(18);
	// 	$CI->excel->getActiveSheet()->getStyle('D8:F10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
		
	// 	//table content of Earning Data
	// 	$CI->excel->getActiveSheet()->setCellValue('A11', 'Sr No');
	// 	$CI->excel->getActiveSheet()->setCellValue('B11', 'Earnings');
	// 	$CI->excel->getActiveSheet()->setCellValue('C11', 'Amount Rs');
		
	// 	$perDay = $employee_basic_info->allowances/$num_days_of_month;
	// 	$total_allowance = $perDay*$work_day;

	// 	$perDay = $employee_basic_info->basic_net/$num_days_of_month;
	// 	$basic_net = $perDay*$work_day;

	// 	//basic details
	// 	$CI->excel->getActiveSheet()->setCellValue('A12', '1');
	// 	$CI->excel->getActiveSheet()->setCellValue('B12', 'Basic');
	// 	$CI->excel->getActiveSheet()->setCellValue('C12', round($basic_net));
	// 	$CI->excel->getActiveSheet()->getStyle('C12')->getNumberFormat()->setFormatCode('#,##0.00');
		
	// 	$CI->excel->getActiveSheet()->getStyle('C12:C19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
	// 	$CI->excel->getActiveSheet()->getStyle('F12:F17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
	// 	$CI->excel->getActiveSheet()->getStyle('A12:A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
	// 	$CI->excel->getActiveSheet()->getStyle('D12:D16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		
	// 	$earn = '13';
	// 	$earn_sr = '2';
	// 	$earn_col_sr = 'A';
	// 	$earn_col_name = 'B';
	// 	$earn_col_value = 'C';
	// 	$earnTotal = 0;
	// 	$special_allowance = 0;
	// 	if (isset($employee_basic_info->special_allowance) && !empty($employee_basic_info->special_allowance))
	// 	{
	// 		$perDday_earn = $employee_basic_info->special_allowance/$num_days_of_month;
	// 		$special_allowance = $perDday_earn*$work_day;
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, 'DA/Special Allowance');
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,round($special_allowance));
	// 		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$earn.':F'.$earn)->applyFromArray($styleThickBrownBorderCalculateTitle2);
	// 		$earn++;
	// 		$earnTotal = $earnTotal + $special_allowance;
	// 	}		
	// 	if (isset($employee_basic_info->hra) && !empty($employee_basic_info->hra))
	// 	{
	// 		$perDday_earn = $employee_basic_info->hra/$num_days_of_month;
	// 		$hra = $perDday_earn*$work_day;
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, 'House Rent Allowance');
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,round($hra));
	// 		$earn++;
	// 		//$earnTotal = $earnTotal + $hra;
	// 	}
	// 	$convey = 0;
	// 	if (isset($employee_basic_info->convey) && !empty($employee_basic_info->convey))
	// 	{
	// 		$perDday_earn = $employee_basic_info->convey/$num_days_of_month;
	// 		$convey = $perDday_earn*$work_day;
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, 'Conveyance Allowance');
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,round($convey));
	// 		$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$earn.':F'.$earn)->applyFromArray($styleThickBrownBorderCalculateTitle2);
	// 		$earn++;
	// 	}
		
	// 	$earnTotal_final=0;
	// 	$total_mobile =0;
	// 	$total_medi =0;
	// 	$total_edu = 0;
	// 	$total_city=0;
	// 	$total_entertainment =0;
	// 	if (isset($static_earn_data) && !empty($static_earn_data)) 
	// 	{
	// 		$pf_total=0;
	// 		foreach ($static_earn_data as $key) 
	// 		{   
	// 			if($key->earning_id!='19' && $key->earning_id!='21' && $key->earning_id!='18')
	// 			{
	// 				$value=0;
	// 				$per_day = 0;
	// 				$pf_total = '0';
			
	// 				if ($key->earning_id==6)
	// 				{
	// 					$value = $key->value;
	// 				}
	// 				else
	// 				{	
	// 					$per_day = $key->value/$num_days_of_month;
	// 					$value = $per_day*$work_day;
	// 				}

	// 				if ($key->earning_id==19){
	// 					$earnvalue = $key->value;
	// 				}else{
	// 					$perDday_earn = $key->value/$num_days_of_month;
	// 					$earnvalue = $perDday_earn*$work_day;
	// 				}

	// 				if($key->earning_id==15)
	// 				{
	// 					//$earnvalue = $key->value;
	// 					$perDday_earn = $key->value/$num_days_of_month;
	// 					$earnvalue = $perDday_earn*$work_day;
	// 				}

					

	// 				$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
	// 				$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, $key->earning_name);
	// 				$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,round($earnvalue));
	// 				$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$earn.':F'.$earn)->applyFromArray($styleThickBrownBorderCalculateTitle2);
	// 				$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$earn)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 				$CI->excel->getActiveSheet()->getStyle($earn_col_value.$earn)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 				$earn++;
	// 				//$earnTotal_final = $earnTotal_final + $value;
	// 				$earnTotal = $earnTotal + $earnvalue;

	// 				if ($key->earning_id == 6 ) 
	// 				{
	// 					// mobile allowance
	// 					$last_val = $key->value/$num_days_of_month;
	// 					$value = $work_day*$last_val;											
	// 					$total_mobile = $value;
						
	// 				}elseif($key->earning_id == 13)
	// 				{
	// 					//medical allowance
	// 					$last_val = $key->value/$num_days_of_month;
	// 					$value = $work_day*$last_val;											
	// 					$total_medi = $value;
						
	// 				}elseif($key->earning_id == 20)
	// 				{
	// 					//education allowance
	// 					$last_val = $key->value/$num_days_of_month;
	// 					$value = $work_day*$last_val;											
	// 					$total_edu = $value;
						
	// 				}elseif($key->earning_id == 14 )
	// 				{				
	// 					// City allowance 
	// 					$last_val = $key->value/$num_days_of_month;
	// 					$value = $work_day*$last_val;											
	// 					$total_city = $value;
						
	// 				}elseif($key->earning_id == 22)
	// 				{
	// 					//entertainment allowance
	// 					$last_val = $key->value/$num_days_of_month;
	// 					$value = $work_day*$last_val;
	// 					$total_entertainment = $value;
					
	// 				}
	// 			}
	// 		}

	// 	}

	// 	if (isset($employee_basic_info->earn_arrears) && !empty($employee_basic_info->earn_arrears))
	// 	{
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.$earn, $earn_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$earn, 'Arrears');
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$earn,round($employee_basic_info->earn_arrears));
	// 		$earn++;
	// 		$earnTotal = $earnTotal + $employee_basic_info->earn_arrears;
	// 	}
		
	// 	//table content of Deduction Data
	// 	$CI->excel->getActiveSheet()->setCellValue('D11', 'Sr No.');
	// 	$CI->excel->getActiveSheet()->setCellValue('E11', 'Deductions');
	// 	$CI->excel->getActiveSheet()->setCellValue('F11', 'Amount Rs');

	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle('A11:F11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	// 	//record start
	// 	$deduct = '12';
	// 	$deduct_sr = '1';
	// 	$deduct_col_sr = 'D';
	// 	$deduct_col_name = 'E';
	// 	$deduct_col_value = 'F';
	// 	$deductTotal = 0;
	// 	$pf_deduct = 0;
	// 	$esic_dedct=0;
	// 	$deductTtl=0;
	// 	/*if (isset($static_deduct_data) && !empty($static_deduct_data)) 
	// 	{
	// 		foreach ($static_deduct_data as $key) 
	// 		{
	// 			//PF (Employee's Contribution)
	// 			if($key->deduction_id='7')
	// 			{
	// 				$perDday_earn = $key->deduct_value/$num_days_of_month;
	// 				$deductvalue = ($basic_net+$special_allowance)*0.12;//$perDday_earn*$work_day;
	// 				$deductTtl = $deductTtl + $deductvalue;
	// 			}else{
	// 				$deductvalue = ($basic_net+$special_allowance)*0.12;//$key->deduct_value;
	// 			}
	// 			//ESI (Employee's Contribution)
	// 			if($key->deduction_id='8')
	// 			{
	// 				$perDday_earn = $key->deduct_value/$num_days_of_month;
	// 				$deductvalue = $perDday_earn*$work_day;
	// 				$deductTtl = $deductTtl + $deductvalue;
	// 			}else{
	// 				$deductvalue = $key->deduct_value;
	// 			}
	// 			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
	// 			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, $key->deduction_name);
	// 			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, round($deductvalue));
	// 			$deduct++;
	// 			$deductTotal = $deductTotal + $deductvalue;
				
	// 		}			
	// 	}*/
	// 	if(isset($employee_basic_info->pf_deduct) && !empty($employee_basic_info->pf_deduct))
	// 	{
	// 		if($employee_basic_info->pf_deduct >= '1800')
	// 		{
	// 			$pfd_val = $employee_basic_info->pf_deduct/$num_days_of_month;
	// 			$pf_deduct =  $work_day*$pfd_val;
				
	// 		}else{
	// 			$pf_deduct = round(($basic_net+$special_allowance+$convey+$total_mobile+$total_medi+$total_edu+$total_city+$total_entertainment)*0.12);
	// 		}

	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, "PF (Employee's Contribution)");
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, round($pf_deduct));
	// 		$deduct++;
	// 		$deductTotal = $deductTotal + $pf_deduct;
	// 	}
		
	// 	if(isset($employee_basic_info->ESIC_deduct) && !empty($employee_basic_info->ESIC_deduct))
	// 	{
	// 		$esicd_val = $employee_basic_info->ESIC_deduct/$num_days_of_month;
	// 		$esic_dedct = $work_day*$esicd_val;

	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, "ESI (Employee's Contribution)");
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, round($esic_dedct));

	// 		$deduct++;
	// 		$deductTotal = $deductTotal + $esic_dedct;
	// 	}

	// 	if ($employee_basic_info->pt_amt > 0)
	// 	{
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, 'Professional Tax');

	// 		if($employee_basic_info->pt_amt>0)
	// 		{
	// 			$in_hand = $employee_basic_info->net_pay+(!empty($ESIC_deduct))+(!empty($pf_deduct))+$employee_basic_info->pt_amt+$employee_basic_info->mobile_deduction+$employee_basic_info->advance_recovery+$employee_basic_info->other_deduct;
	// 			if($in_hand<7500)
	// 			{
	// 				$pt = 0;
	// 			}elseif($in_hand<10000 && $in_hand>7500)
	// 			{
	// 				if($employee_basic_info->gender=='Female')
	// 				{
	// 					$pt=0;
	// 				}else{
	// 					$pt = 175;
	// 				}
	// 			}elseif($in_hand>10001)
	// 			{
	// 				if($month=='February')
	// 				{
	// 					$pt = 300;
	// 				}else{
	// 					$pt = 200;
	// 				}
	// 			}
	// 		}else{
	// 			$pt = 0;
	// 		}

	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, round($pt));
	// 		$deductTotal = $deductTotal + $pt;
	// 		$deduct++;
	// 	}
	// 	if (isset($employee_basic_info->advance_recovery) && !empty($employee_basic_info->advance_recovery))
	// 	{	
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, 'Advance Deductions');
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, round($employee_basic_info->advance_recovery));
	// 		$deductTotal = $deductTotal + $employee_basic_info->advance_recovery;
	// 		$deduct++;
	// 	}
	// 	if (isset($employee_basic_info->mobile_deduction) && !empty($employee_basic_info->mobile_deduction))
	// 	{	
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, 'Mobile Deduction');
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, round($employee_basic_info->mobile_deduction));
	// 		$deductTotal = $deductTotal + $employee_basic_info->mobile_deduction;
	// 		$deduct++;
	// 	}

	// 	if (isset($employee_basic_info->other_deduct) && !empty($employee_basic_info->other_deduct))
	// 	{	
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, 'Other Deductions');
	// 		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, round($employee_basic_info->other_deduct));
	// 		$deductTotal = $deductTotal + $employee_basic_info->other_deduct;
	// 		$deduct++;
	// 	}
	// 	$max_value = max($earn,$deduct);

	// 	if($employee_basic_info->var_amount>0){	
	// 		$max_value = $max_value+1;
	// 		$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$max_value, 'Performance Variable Bonus');

	// 		$max_value = $max_value+1;
	// 		$CI->excel->getActiveSheet()->setCellValue('A'.$max_value, '1');
	// 		$CI->excel->getActiveSheet()->setCellValue('B'.$max_value, 'Variable');
	// 		$CI->excel->getActiveSheet()->setCellValue('C'.$max_value, $employee_basic_info->var_amount);
	// 		$CI->excel->getActiveSheet()->setCellValue('E'.$max_value, 'Performance Variable Bonus %');
	// 		$CI->excel->getActiveSheet()->setCellValue('F'.$max_value, round($employee_basic_info->var_per));
	// 	}

	// 	$max_value = $max_value+1;
	// 	$CI->excel->getActiveSheet()->setCellValue($earn_col_name.$max_value, 'Total Earnings');	
	// 	$total_pay = $basic_net+$earnTotal+$convey+$hra+$employee_basic_info->var_amount;
		
	// 	$CI->excel->getActiveSheet()->setCellValue($earn_col_value.$max_value, round($total_pay));
	// 	$CI->excel->getActiveSheet()->getStyle('C12:'.$earn_col_value.$max_value)->getNumberFormat()->setFormatCode('#,##0.00');
	// 	$CI->excel->getActiveSheet()->getStyle('C12:'.$earn_col_value.$max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		
	// 	//$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.($max_value-1), ''); //Advance deduction Amount
	// 	//$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.($max_value-1), '');//advance value here 

	// 	$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$max_value, 'Total Deductions');
	// 	$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$max_value, round($deductTotal));
	// 	$CI->excel->getActiveSheet()->getStyle($deduct_col_value.$max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value)).':B'.($max_value))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value)).':B'.($max_value))->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value)).':C'.($max_value))->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value)).':B'.($max_value))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value)).':B'.($max_value))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_name.($max_value)).':E'.($max_value))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_name.($max_value)).':E'.($max_value))->getFont()->setSize(10);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_name.($max_value)).':F'.($max_value))->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_name.($max_value)).':E'.($max_value))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_name.($max_value)).':E'.($max_value))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		
	// 	$max_value = $max_value+1;

	// 	$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$max_value, 'NET SALARY');
	// 	$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$max_value, round($total_pay-$deductTotal));
	// 	$CI->excel->getActiveSheet()->getStyle('F12:'.$deduct_col_value.$max_value)->getNumberFormat()->setFormatCode('#,##0.00');
		
	// 	//$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+1)), 'In Word');
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+1)))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+1)))->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+1)))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value)))->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_name.($max_value)))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_value.($max_value)))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	// 	$CI->excel->getActiveSheet()->getStyle('F12:'.$deduct_col_value.$max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		
	// 	//getStyle($earn_col_sr.$max_value.':'.$deduct_col_value.$max_value)
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+2)), 'Snap-Shot');
	// 	$CI->excel->getActiveSheet()->mergeCells(($earn_col_sr.($max_value+2)).':'.($deduct_col_value.($max_value+2)))
	// 	                            ->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('EEEEEEEE');

	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)))->getFont()->setSize(12);	
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)))->getFont()->setBold(true);

	// 	//$in_word="Ten Thousend Five Humdred fifty only.";
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_name.($max_value+1))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_name.($max_value+1))->getFont()->setSize(10)->setBold(true);
	// 	$CI->excel->getActiveSheet()->mergeCells($earn_col_value.($max_value+1).':F'.($max_value+1));
		
	// 	$CI->excel->getActiveSheet()->mergeCells(($earn_col_sr.($max_value+1)).':'.($earn_col_value.($max_value+1)));
	// 	$words = $CI->convert_num_to_words->convert_number_to_words(round($total_pay-$deductTotal));
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_value.($max_value+1)),'(Rupees '.ucfirst($words).' only)' ); //	
		
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_value.($max_value+1))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_value.($max_value+1))->getFont()->setSize(10);
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_value.($max_value+1)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	// 	//$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+1).':'.$deduct_col_value.($max_value+1))->applyFromArray($styleThickBrownBorderCalculate);
	// 	//$max_value = $max_value+2;
		
	// 	/********************* start ****************************/
	// 	$max_value = $max_value+1;
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+2)), 'Days in Month');
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+2))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+3)), 'Leaves in Month');
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+3))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+4)),'Present Days');
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr.($max_value+5)),'Period of Service');
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+5))->getFont()->setBold(true);

	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+4))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)).':A'.($max_value+5))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)).':A'.($max_value+5))->getFont()->setSize(9);	
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_sr.($max_value+2)).':A'.($max_value+5))->getFont();
		
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+2)), $num_days_of_month);
	// 	$CI->excel->getActiveSheet()->mergeCells(($earn_col_name.($max_value+2)).':C'.($max_value+2));
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+3)), ($num_days_of_month-$work_day)); //$employee_basic_info->emp_designation 
	// 	$CI->excel->getActiveSheet()->mergeCells(($earn_col_name.($max_value+3)).':C'.($max_value+3));
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+4)), $work_day); 
	// 	$CI->excel->getActiveSheet()->mergeCells(($earn_col_name.($max_value+4)).':C'.($max_value+4));
		
	// 	//$Period_of_Service
	// 	$date1 = date('Y-m-d',strtotime($employee_basic_info->date_of_joining));
	//     $date2 = date('Y-m-d');	   
	//     $diff =  abs(strtotime($date1)-strtotime($date2));
	// 	$years = floor($diff / (365*60*60*24));
	// 	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	// 	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	// 	$Period_of_Service = $years.' years, '.$months.' months, '.$days.' days';
		
	// 	$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+5)), $Period_of_Service); 

	// 	$CI->excel->getActiveSheet()->mergeCells(($earn_col_name.($max_value+5)).':C'.($max_value+5));
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+2)).':B'.($max_value+5))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+2)).':B'.($max_value+5))->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+2)).':B'.($max_value+5))->getFont();
	// 	$CI->excel->getActiveSheet()->getStyle(($earn_col_name.($max_value+2)).':B'.($max_value+5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	// 	$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr.($max_value+2)), 'Opening Advance');
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)))->getFont()->setSize(9);
	// 	$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr.($max_value+3)), 'Addition Advance');
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+3)))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+3)))->getFont()->setSize(9);
	// 	$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr.($max_value+4)), 'Recovery Advance');
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+4)))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+4)))->getFont()->setSize(9);
	// 	$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr.($max_value+5)), 'Closing Advance');
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+5)))->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+5)))->getFont()->setSize(9);
	// 	//$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+5)).':D'.($max_value+5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+5)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


	// 	/************************************** advance code start here **************************************************************************************************/
	// 	$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name.($max_value+2)), $employee_basic_info->advance_opening);
	// 	$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name.($max_value+2)).':F'.($max_value+2));
	// 	$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name.($max_value+3)), $employee_basic_info->advance_Addition); //$employee_basic_info->emp_designation 
	// 	$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name.($max_value+3)).':F'.($max_value+3));
	// 	$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name.($max_value+4)), $employee_basic_info->advance_recovery); 
	// 	$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name.($max_value+4)).':F'.($max_value+4));
	// 	$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name.($max_value+5)), $employee_basic_info->advance_closing_amt); 
	// 	$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name.($max_value+5)).':F'.($max_value+5));
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)).':E'.($max_value+5))->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)).':E'.($max_value+5))->getFont()->setSize(10);	
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)).':E'.($max_value+5))->getFont();
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+2)).':E'.($max_value+5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 	$CI->excel->getActiveSheet()->getStyle(($deduct_col_name.($max_value+2)).':F'.($max_value+5))->getNumberFormat()->setFormatCode('#,##0.00');
		
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+2).':F'.($max_value+5))->applyFromArray($styleThickBrownBorderCalculateTitle2);

	// 	/******************** end advance ***************************************************************************/
	// 	$max_value = $max_value-1;
	// 	/******************** end ***************************/
	// 	//note
	// 	//$note=" Note :-This document contains confidential information. If you are not the intended recipient you are not authorized to use or disclose it in any form. If you received this in error please destroy it along with any copies & notify the sender immediately.";
	// 	$note="This is Computer Generated Document, hence does't required any Signature";
	// 	//set cell A1 content with some text

	// 	$CI->excel->getActiveSheet()->setCellValue($earn_col_sr.($max_value+7),$note);
	// 	$CI->excel->getActiveSheet()->mergeCells($earn_col_sr.($max_value+7).':'.$deduct_col_value.($max_value+7))
	// 								->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('EEEEEEEE');

	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7))->getFont()->setName('Bookman Old Style');
	// 	//change the font size
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7))->getFont()->setSize(10);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7))->getFont()->setBold(true);;
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+7))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$earn.':'.$deduct_col_value.($max_value+1))->getFont()->setName('Bookman Old Style');


	// 	/*foreach(range('A','F') as $columnID) {
	// 	    $CI->excel->getActiveSheet()->getColumnDimension($columnID)->setWidth(20);
	// 	}*/

	// 	$styleThickBrownBorderOutline = array(
	// 		'borders' => array(
	// 			'outline' => array(
	// 				'style' => PHPExcel_Style_Border::BORDER_THICK,
	// 				'color' => array('argb' => 'FF000000'),
	// 				//'color' => array('argb' => 'FF993300'),
	// 			),
	// 		),
	// 	);		
		
	// 	$styleThickBrownBorderCalculateTitle = array(
	// 		'borders' => array(
	// 			'outline' => array(
	// 				'style' => PHPExcel_Style_Border::BORDER_THIN,
					
	// 			),
	// 		),
	// 	);
		
	// 	$styleThickBrownBorderCalculateTitle1 = array(
	// 		'borders' => array(
	// 			'allborders' => array(
	// 				'style' => PHPExcel_Style_Border::BORDER_THIN,
					
	// 			),
	// 		),
	// 	);
	// 	$CI->excel->getActiveSheet()->getStyle($earn_col_sr.$max_value.':'. $deduct_col_value.$max_value)->applyFromArray($styleThickBrownBorderCalculateTitle1);
	// 	$CI->excel->getActiveSheet()->getStyle('A8:B12')->applyFromArray($styleThickBrownBorderCalculateTitle1);
	// 	$CI->excel->getActiveSheet()->getStyle('C8:F12')->applyFromArray($styleThickBrownBorderCalculateTitle1);
	// 	$CI->excel->getActiveSheet()->getStyle('A14:F14')->applyFromArray($styleThickBrownBorderCalculateTitle1);
	// 	$CI->excel->getActiveSheet()->getStyle('A21:F26')->applyFromArray($styleThickBrownBorderCalculateTitle1);
	// 	$CI->excel->getActiveSheet()->getStyle('A19:F19')->applyFromArray($styleThickBrownBorderCalculateTitle1);
	// 	//$CI->excel->getActiveSheet()->getStyle('A21')->applyFromArray($styleThickBrownBorderCalculateTitle1);
	// 	$CI->excel->getActiveSheet()->getStyle('A14:'.$deduct_col_value.($max_value))->applyFromArray($styleThickBrownBorderCalculate);
	// 	//$CI->excel->getActiveSheet()->getStyle($earn_col_name.$max_value.''.)->applyFromArray($styleThickBrownBorderCalculateTitle1);
	// 	$CI->excel->getActiveSheet()->getStyle('A1:'.$deduct_col_value.($max_value+1))->applyFromArray($styleThickBrownBorderOutline);
	// 	$CI->excel->getActiveSheet()->getStyle('A4:'.$deduct_col_value.($max_value+7))->applyFromArray($styleThickBrownBorderOutline);
	// 	//$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+2).':'.$deduct_col_value.($max_value+2))->applyFromArray($styleThickBrownBorderOutline);

	// 	$CI->excel->getActiveSheet()->getStyle('B8:B16')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('B8:B16')->getFont()->setSize(10);
	// 	$CI->excel->getActiveSheet()->getStyle('E8:E16')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('E8:E16')->getFont()->setSize(10);
	// 	$CI->excel->getActiveSheet()->getStyle('C8:C16')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('C8:C16')->getFont()->setSize(10);
	// 	$CI->excel->getActiveSheet()->getStyle('F8:F16')->getFont()->setName('Bookman Old Style');
	// 	$CI->excel->getActiveSheet()->getStyle('F8:F16')->getFont()->setSize(10);	

	// 	if(isset($imageName) && !empty($imageName))
	// 	{
	// 		$path = './images/logo/'.$imageName;
	// 		if(file_exists($path))
	// 		{
	// 			$objDrawing = new PHPExcel_Worksheet_Drawing();
	// 			$objDrawing->setName('Logo');
	// 			$objDrawing->setDescription('Logo');
	// 			$objDrawing->setPath($path);
	// 			$objDrawing->setHeight(60);
	// 			$objDrawing->setWorksheet($CI->excel->getActiveSheet());
	// 		}			
	// 	}
	// 	else
	// 	{
			
	// 	}

		
		
	// 	//$name_date = date('d/m/Y');
	// 	$filename=$employee_basic_info->emp_name.' Pay Slip for the Month of '.$final_month_year.'.xls'; //save our workbook as this file name
	// 	header('Content-Type: application/vnd.ms-excel'); //mime type
	// 	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	// 	header('Cache-Control: max-age=0'); //no cache

	// 	// If you're serving to IE 9, then the following may be needed
	// 	header('Cache-Control: max-age=1');

	// 	// If you're serving to IE over SSL, then the following may be needed
	// 	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	// 	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	// 	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	// 	header ('Pragma: public'); // HTTP/1.0
		             
	// 	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	// 	//if you want to save it as .XLSX Excel 2007 format
	// 	$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
	// 	//force user to download the Excel file without writing it to server's HD
	// 	$objWriter->save('php://output'); 
    // }

	function salarySlipGenerateInExcelFormat($employee_basic_info, $static_earn_data, $static_deduct_data, $companyDetails, $pay_slip_month)
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

		//border lines
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

		//activate worksheet number 1
		$CI->excel->setActiveSheetIndex(0);
		//name the worksheet
		$CI->excel->getActiveSheet()->setTitle('Payslip');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
		$CI->excel->getActiveSheet()->setCellValue('A1', $companyDetails->company_name);
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleThickBrownBorderCalculateTitle2);
		//change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//set row height
		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells('A1:F1');
		/*->getStyle()
								   ->getFill()
								   ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
								   ->getStartColor()->setARGB('EEEEEEEE');*/

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		//$CI->excel->getActiveSheet()->setCellValue('A2', $companyDetails->address);
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Office No. 310, 311, 312, Pride Purple Square, Kalewadi Phata, Wakad, Pune- 411057');
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
		//change the font size
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
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
			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
			->setWrapText(true);

		$CI->excel->getActiveSheet()->getRowDimension('7')->setVisible(FALSE);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(25);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(30);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);

		$final_month_year = '';
		if (isset($employee_basic_info->salary_month) && !empty($employee_basic_info->salary_month)) {
			$salary_month = $employee_basic_info->salary_month;
			$month_year = explode('-', $salary_month);
			$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)) . ' ' . $month_year[1];
			$month = date("F", mktime(0, 0, 0, $month_year[0], 10));
		}

		$CI->excel->getActiveSheet()->setCellValue('A5', 'PAYSLIP - ' . $final_month_year);
		$CI->excel->getActiveSheet()->mergeCells('A5:F5');
		$CI->excel->getActiveSheet()->getStyle('A5:F5')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('A5:F5')->getFont()->setSize(12);
		$CI->excel->getActiveSheet()->getStyle('A5:F5')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A5:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->setCellValue('A8', 'Employee Name');
		$CI->excel->getActiveSheet()->setCellValue('A9', 'Designation');
		$CI->excel->getActiveSheet()->setCellValue('A10', 'PAN No');

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle('A8:A10')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getRowDimension('A8:A10')->setRowHeight(18);
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$CI->excel->getActiveSheet()->setCellValue('B8', $employee_basic_info->emp_name);
		$CI->excel->getActiveSheet()->mergeCells('B8:C8');
		$CI->excel->getActiveSheet()->setCellValue('B9', $employee_basic_info->title);
		$CI->excel->getActiveSheet()->mergeCells('B9:C9');
		$CI->excel->getActiveSheet()->setCellValue('B10', $employee_basic_info->emp_pan_num);
		$CI->excel->getActiveSheet()->mergeCells('B10:C10');
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getRowDimension('B8:B10')->setRowHeight(18);
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getFont();
		$CI->excel->getActiveSheet()->getStyle('B8:B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		// the workday and date of joinig Payslip No :-
		$CI->excel->getActiveSheet()->setCellValue('D8', 'Payslip No');
		$CI->excel->getActiveSheet()->getStyle('D8')->getFont()->setBold(true);

		$CI->excel->getActiveSheet()->setCellValue('D9', 'Date Of Joining');
		$CI->excel->getActiveSheet()->getStyle('D9')->getFont()->setBold(true);

		$CI->excel->getActiveSheet()->setCellValue('D10', 'Employee Code');
		$CI->excel->getActiveSheet()->getStyle('D10')->getFont()->setBold(true);

		$CI->excel->getActiveSheet()->mergeCells('E8:F8');
		$CI->excel->getActiveSheet()->setCellValue('E8', date("F", mktime(0, 0, 0, $month_year[0], 10)) . '/' . $month_year[1] . '/' . $employee_basic_info->emp_id);

		$CI->excel->getActiveSheet()->mergeCells('E9:F9');
		$CI->excel->getActiveSheet()->setCellValue('E9', date('d M Y', strtotime($employee_basic_info->date_of_joining)));

		$CI->excel->getActiveSheet()->mergeCells('E10:F10');
		$CI->excel->getActiveSheet()->setCellValue('E10', $employee_basic_info->username);

		$CI->excel->getActiveSheet()->getStyle('E8:E10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('C8:D10')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('C8:D10')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle('C8:D10')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getRowDimension('C8:D10')->setRowHeight(18);
		$CI->excel->getActiveSheet()->getStyle('C8:D10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('E8:F10')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('E8:F10')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getRowDimension('E8:F10')->setRowHeight(18);
		$CI->excel->getActiveSheet()->getStyle('D8:F10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		//table content of Earning Data
		$CI->excel->getActiveSheet()->setCellValue('A11', 'Sr No');
		$CI->excel->getActiveSheet()->setCellValue('B11', 'Earnings');
		$CI->excel->getActiveSheet()->setCellValue('C11', 'Amount Rs');

		$perDay = $employee_basic_info->allowances / $num_days_of_month;
		$total_allowance = $perDay * $work_day;

		$perDay = $employee_basic_info->basic_net / $num_days_of_month;
		$basic_net = $perDay * $work_day;

		//basic details
		$CI->excel->getActiveSheet()->setCellValue('A12', '1');
		$CI->excel->getActiveSheet()->setCellValue('B12', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('C12', round($basic_net));
		$CI->excel->getActiveSheet()->getStyle('C12')->getNumberFormat()->setFormatCode('#,##0.00');

		$CI->excel->getActiveSheet()->getStyle('C12:C19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$CI->excel->getActiveSheet()->getStyle('F12:F17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$CI->excel->getActiveSheet()->getStyle('A12:A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$CI->excel->getActiveSheet()->getStyle('D12:D16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$earn = '13';
		$earn_sr = '2';
		$earn_col_sr = 'A';
		$earn_col_name = 'B';
		$earn_col_value = 'C';
		$earnTotal = 0;
		$special_allowance = 0;
		if (isset($employee_basic_info->special_allowance) && !empty($employee_basic_info->special_allowance)) {
			$perDday_earn = $employee_basic_info->special_allowance / $num_days_of_month;
			$special_allowance = $perDday_earn * $work_day;
			$CI->excel->getActiveSheet()->setCellValue($earn_col_sr . $earn, $earn_sr++);
			$CI->excel->getActiveSheet()->setCellValue($earn_col_name . $earn, 'DA/Special Allowance');
			$CI->excel->getActiveSheet()->setCellValue($earn_col_value . $earn, round($special_allowance));
			$CI->excel->getActiveSheet()->getStyle($earn_col_sr . $earn . ':F' . $earn)->applyFromArray($styleThickBrownBorderCalculateTitle2);
			$earn++;
			$earnTotal = $earnTotal + $special_allowance;
		}
		if (isset($employee_basic_info->hra) && !empty($employee_basic_info->hra)) {
			$perDday_earn = $employee_basic_info->hra / $num_days_of_month;
			$hra = $perDday_earn * $work_day;
			$CI->excel->getActiveSheet()->setCellValue($earn_col_sr . $earn, $earn_sr++);
			$CI->excel->getActiveSheet()->setCellValue($earn_col_name . $earn, 'House Rent Allowance');
			$CI->excel->getActiveSheet()->setCellValue($earn_col_value . $earn, round($hra));
			$earn++;
			//$earnTotal = $earnTotal + $hra;
		}
		$convey = 0;
		if (isset($employee_basic_info->convey) && !empty($employee_basic_info->convey)) {
			$perDday_earn = $employee_basic_info->convey / $num_days_of_month;
			$convey = $perDday_earn * $work_day;
			$CI->excel->getActiveSheet()->setCellValue($earn_col_sr . $earn, $earn_sr++);
			$CI->excel->getActiveSheet()->setCellValue($earn_col_name . $earn, 'Conveyance Allowance');
			$CI->excel->getActiveSheet()->setCellValue($earn_col_value . $earn, round($convey));
			$CI->excel->getActiveSheet()->getStyle($earn_col_sr . $earn . ':F' . $earn)->applyFromArray($styleThickBrownBorderCalculateTitle2);
			$earn++;
		}

		$earnTotal_final = 0;
		$total_mobile = 0;
		$total_medi = 0;
		$total_edu = 0;
		$total_city = 0;
		$total_entertainment = 0;
		if (isset($static_earn_data) && !empty($static_earn_data)) {
			// echo '<pre>';
			// print_r($static_earn_data);exit;
			$pf_total = 0;
			foreach ($static_earn_data as $key) {
				if ($key->earning_id != '18') {
					$value = 0;
					$per_day = 0;
					$pf_total = '0';

					if ($key->earning_id == 6) {
						$value = $key->value;
					} else {
						$per_day = $key->value / $num_days_of_month;
						$value = $per_day * $work_day;
					}

					if ($key->earning_id == 19) {
						$earnvalue = $key->value;
					} else {
						$perDday_earn = $key->value / $num_days_of_month;
						$earnvalue = $perDday_earn * $work_day;
					}

					if ($key->earning_id == 15) {
						//$earnvalue = $key->value;
						$perDday_earn = $key->value / $num_days_of_month;
						$earnvalue = $perDday_earn * $work_day;
					}
					if ($key->earning_id == 21) {
						$earnvalue = $key->value;
						
					}

					



					$CI->excel->getActiveSheet()->setCellValue($earn_col_sr . $earn, $earn_sr++);
					$CI->excel->getActiveSheet()->setCellValue($earn_col_name . $earn, $key->earning_name);
					$CI->excel->getActiveSheet()->setCellValue($earn_col_value . $earn, round($earnvalue));
					$CI->excel->getActiveSheet()->getStyle($earn_col_sr . $earn . ':F' . $earn)->applyFromArray($styleThickBrownBorderCalculateTitle2);
					$CI->excel->getActiveSheet()->getStyle($earn_col_sr . $earn)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$CI->excel->getActiveSheet()->getStyle($earn_col_value . $earn)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$earn++;
					//$earnTotal_final = $earnTotal_final + $value;
					$earnTotal = $earnTotal + $earnvalue;

					if ($key->earning_id == 6) {
						// mobile allowance
						$last_val = $key->value / $num_days_of_month;
						$value = $work_day * $last_val;
						$total_mobile = $value;

					} elseif ($key->earning_id == 13) {
						//medical allowance
						$last_val = $key->value / $num_days_of_month;
						$value = $work_day * $last_val;
						$total_medi = $value;

					} elseif ($key->earning_id == 20) {
						//education allowance
						$last_val = $key->value / $num_days_of_month;
						$value = $work_day * $last_val;
						$total_edu = $value;

					} elseif ($key->earning_id == 14) {
						// City allowance 
						$last_val = $key->value / $num_days_of_month;
						$value = $work_day * $last_val;
						$total_city = $value;

					} elseif ($key->earning_id == 22) {
						//entertainment allowance
						$last_val = $key->value / $num_days_of_month;
						$value = $work_day * $last_val;
						$total_entertainment = $value;

					}
				}
			}

		}

		if (isset($employee_basic_info->earn_arrears) && !empty($employee_basic_info->earn_arrears)) {
			$CI->excel->getActiveSheet()->setCellValue($earn_col_sr . $earn, $earn_sr++);
			$CI->excel->getActiveSheet()->setCellValue($earn_col_name . $earn, 'Arrears');
			$CI->excel->getActiveSheet()->setCellValue($earn_col_value . $earn, round($employee_basic_info->earn_arrears));
			$earn++;
			$earnTotal = $earnTotal + $employee_basic_info->earn_arrears;
		}

		//table content of Deduction Data
		$CI->excel->getActiveSheet()->setCellValue('D11', 'Sr No.');
		$CI->excel->getActiveSheet()->setCellValue('E11', 'Deductions');
		$CI->excel->getActiveSheet()->setCellValue('F11', 'Amount Rs');

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle('A11:F11')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A11:F11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		//record start
		$deduct = '12';
		$deduct_sr = '1';
		$deduct_col_sr = 'D';
		$deduct_col_name = 'E';
		$deduct_col_value = 'F';
		$deductTotal = 0;
		$pf_deduct = 0;
		$esic_dedct = 0;
		$deductTtl = 0;
		/*if (isset($static_deduct_data) && !empty($static_deduct_data)) 
			  {
				  foreach ($static_deduct_data as $key) 
				  {
					  //PF (Employee's Contribution)
					  if($key->deduction_id='7')
					  {
						  $perDday_earn = $key->deduct_value/$num_days_of_month;
						  $deductvalue = ($basic_net+$special_allowance)*0.12;//$perDday_earn*$work_day;
						  $deductTtl = $deductTtl + $deductvalue;
					  }else{
						  $deductvalue = ($basic_net+$special_allowance)*0.12;//$key->deduct_value;
					  }
					  //ESI (Employee's Contribution)
					  if($key->deduction_id='8')
					  {
						  $perDday_earn = $key->deduct_value/$num_days_of_month;
						  $deductvalue = $perDday_earn*$work_day;
						  $deductTtl = $deductTtl + $deductvalue;
					  }else{
						  $deductvalue = $key->deduct_value;
					  }
					  $CI->excel->getActiveSheet()->setCellValue($deduct_col_sr.$deduct, $deduct_sr++);
					  $CI->excel->getActiveSheet()->setCellValue($deduct_col_name.$deduct, $key->deduction_name);
					  $CI->excel->getActiveSheet()->setCellValue($deduct_col_value.$deduct, round($deductvalue));
					  $deduct++;
					  $deductTotal = $deductTotal + $deductvalue;
					  
				  }			
			  }*/
		if (isset($employee_basic_info->pf_deduct) && !empty($employee_basic_info->pf_deduct)) {
			if ($employee_basic_info->pf_deduct >= '1800') {
				$pfd_val = $employee_basic_info->pf_deduct / $num_days_of_month;
				$pf_deduct = $work_day * $pfd_val;

			} else {
				$pf_deduct = round(($basic_net + $special_allowance + $convey + $total_mobile + $total_medi + $total_edu + $total_city + $total_entertainment) * 0.12);
			}

			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr . $deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name . $deduct, "PF (Employee's Contribution)");
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value . $deduct, round($pf_deduct));
			$deduct++;
			$deductTotal = $deductTotal + $pf_deduct;
		}

		if (isset($employee_basic_info->ESIC_deduct) && !empty($employee_basic_info->ESIC_deduct)) {
			$esicd_val = $employee_basic_info->ESIC_deduct / $num_days_of_month;
			$esic_dedct = $work_day * $esicd_val;

			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr . $deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name . $deduct, "ESI (Employee's Contribution)");
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value . $deduct, round($esic_dedct));

			$deduct++;
			$deductTotal = $deductTotal + $esic_dedct;
		}

		if ($employee_basic_info->pt_amt > 0) {
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr . $deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name . $deduct, 'Professional Tax');

			if ($employee_basic_info->pt_amt > 0) {
				$in_hand = $employee_basic_info->net_pay + (!empty($ESIC_deduct)) + (!empty($pf_deduct)) + $employee_basic_info->pt_amt + $employee_basic_info->mobile_deduction + $employee_basic_info->advance_recovery + $employee_basic_info->other_deduct;
				if ($in_hand < 7500) {
					$pt = 0;
				} elseif ($in_hand < 10000 && $in_hand > 7500) {
					if ($employee_basic_info->gender == 'Female') {
						$pt = 0;
					} else {
						$pt = 175;
					}
				} elseif ($in_hand > 10001) {
					if ($month == 'February') {
						$pt = 300;
					} else {
						$pt = 200;
					}
				}
			} else {
				$pt = 0;
			}

			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value . $deduct, round($pt));
			$deductTotal = $deductTotal + $pt;
			$deduct++;
		}
		if (isset($employee_basic_info->advance_recovery) && !empty($employee_basic_info->advance_recovery)) {
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr . $deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name . $deduct, 'Advance Deductions');
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value . $deduct, round($employee_basic_info->advance_recovery));
			$deductTotal = $deductTotal + $employee_basic_info->advance_recovery;
			$deduct++;
		}
		if (isset($employee_basic_info->mobile_deduction) && !empty($employee_basic_info->mobile_deduction)) {
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr . $deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name . $deduct, 'Mobile Deduction');
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value . $deduct, round($employee_basic_info->mobile_deduction));
			$deductTotal = $deductTotal + $employee_basic_info->mobile_deduction;
			$deduct++;
		}

		if (isset($employee_basic_info->other_deduct) && !empty($employee_basic_info->other_deduct)) {
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_sr . $deduct, $deduct_sr++);
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_name . $deduct, 'Other Deductions');
			$CI->excel->getActiveSheet()->setCellValue($deduct_col_value . $deduct, round($employee_basic_info->other_deduct));
			$deductTotal = $deductTotal + $employee_basic_info->other_deduct;
			$deduct++;
		}
		$max_value = max($earn, $deduct);

		if ($employee_basic_info->var_amount > 0) {
			$max_value = $max_value + 1;
			$CI->excel->getActiveSheet()->setCellValue($earn_col_name . $max_value, 'Performance Variable Bonus');

			$max_value = $max_value + 1;
			$CI->excel->getActiveSheet()->setCellValue('A' . $max_value, '1');
			$CI->excel->getActiveSheet()->setCellValue('B' . $max_value, 'Variable');
			$CI->excel->getActiveSheet()->setCellValue('C' . $max_value, $employee_basic_info->var_amount);
			$CI->excel->getActiveSheet()->setCellValue('E' . $max_value, 'Performance Variable Bonus %');
			$CI->excel->getActiveSheet()->setCellValue('F' . $max_value, round($employee_basic_info->var_per));
		}

		$max_value = $max_value + 1;
		$CI->excel->getActiveSheet()->setCellValue($earn_col_name . $max_value, 'Total Earnings');
		$total_pay = $basic_net + $earnTotal + $convey + $hra + $employee_basic_info->var_amount;

		$CI->excel->getActiveSheet()->setCellValue($earn_col_value . $max_value, round($total_pay));
		$CI->excel->getActiveSheet()->getStyle('C12:' . $earn_col_value . $max_value)->getNumberFormat()->setFormatCode('#,##0.00');
		$CI->excel->getActiveSheet()->getStyle('C12:' . $earn_col_value . $max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		//$CI->excel->getActiveSheet()->setCellValue($deduct_col_name.($max_value-1), ''); //Advance deduction Amount
		//$CI->excel->getActiveSheet()->setCellValue($deduct_col_value.($max_value-1), '');//advance value here 

		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name . $max_value, 'Total Deductions');
		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value . $max_value, round($deductTotal));
		$CI->excel->getActiveSheet()->getStyle($deduct_col_value . $max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value)) . ':B' . ($max_value))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value)) . ':B' . ($max_value))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value)) . ':C' . ($max_value))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value)) . ':B' . ($max_value))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value)) . ':B' . ($max_value))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$CI->excel->getActiveSheet()->getStyle(($deduct_col_name . ($max_value)) . ':E' . ($max_value))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_name . ($max_value)) . ':E' . ($max_value))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_name . ($max_value)) . ':F' . ($max_value))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_name . ($max_value)) . ':E' . ($max_value))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_name . ($max_value)) . ':E' . ($max_value))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$max_value = $max_value + 1;

		$CI->excel->getActiveSheet()->setCellValue($deduct_col_name . $max_value, 'NET SALARY');
		$CI->excel->getActiveSheet()->setCellValue($deduct_col_value . $max_value, round($total_pay - $deductTotal));
		$CI->excel->getActiveSheet()->getStyle('F12:' . $deduct_col_value . $max_value)->getNumberFormat()->setFormatCode('#,##0.00');

		//$CI->excel->getActiveSheet()->setCellValue(($earn_col_name.($max_value+1)), 'In Word');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value + 1)))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value + 1)))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value + 1)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value)))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_name . ($max_value)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_value . ($max_value)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$CI->excel->getActiveSheet()->getStyle('F12:' . $deduct_col_value . $max_value)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		//getStyle($earn_col_sr.$max_value.':'.$deduct_col_value.$max_value)
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr . ($max_value + 2)), 'Snap-Shot');
		$CI->excel->getActiveSheet()->mergeCells(($earn_col_sr . ($max_value + 2)) . ':' . ($deduct_col_value . ($max_value + 2)))
			->getStyle()
			->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('EEEEEEEE');

		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr . ($max_value + 2)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr . ($max_value + 2)))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr . ($max_value + 2)))->getFont()->setSize(12);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr . ($max_value + 2)))->getFont()->setBold(true);

		//$in_word="Ten Thousend Five Humdred fifty only.";
		$CI->excel->getActiveSheet()->getStyle($earn_col_name . ($max_value + 1))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle($earn_col_name . ($max_value + 1))->getFont()->setSize(10)->setBold(true);
		$CI->excel->getActiveSheet()->mergeCells($earn_col_value . ($max_value + 1) . ':F' . ($max_value + 1));

		$CI->excel->getActiveSheet()->mergeCells(($earn_col_sr . ($max_value + 1)) . ':' . ($earn_col_value . ($max_value + 1)));
		$words = $CI->convert_num_to_words->convert_number_to_words(round($total_pay - $deductTotal));
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_value . ($max_value + 1)), '(Rupees ' . ucfirst($words) . ' only)'); //	

		$CI->excel->getActiveSheet()->getStyle($earn_col_value . ($max_value + 1))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle($earn_col_value . ($max_value + 1))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_value . ($max_value + 1)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		//$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+1).':'.$deduct_col_value.($max_value+1))->applyFromArray($styleThickBrownBorderCalculate);
		//$max_value = $max_value+2;

		/********************* start ****************************/
		$max_value = $max_value + 1;
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr . ($max_value + 2)), 'Days in Month');
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 2))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr . ($max_value + 3)), 'Leaves in Month');
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 3))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr . ($max_value + 4)), 'Present Days');
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_sr . ($max_value + 5)), 'Period of Service');
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 5))->getFont()->setBold(true);

		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 4))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr . ($max_value + 2)) . ':A' . ($max_value + 5))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr . ($max_value + 2)) . ':A' . ($max_value + 5))->getFont()->setSize(9);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_sr . ($max_value + 2)) . ':A' . ($max_value + 5))->getFont();

		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name . ($max_value + 2)), $num_days_of_month);
		$CI->excel->getActiveSheet()->mergeCells(($earn_col_name . ($max_value + 2)) . ':C' . ($max_value + 2));
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name . ($max_value + 3)), ($num_days_of_month - $work_day)); //$employee_basic_info->emp_designation 
		$CI->excel->getActiveSheet()->mergeCells(($earn_col_name . ($max_value + 3)) . ':C' . ($max_value + 3));
		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name . ($max_value + 4)), $work_day);
		$CI->excel->getActiveSheet()->mergeCells(($earn_col_name . ($max_value + 4)) . ':C' . ($max_value + 4));

		//$Period_of_Service
		$date1 = date('Y-m-d', strtotime($employee_basic_info->date_of_joining));
		$date2 = date('Y-m-d');
		$diff = abs(strtotime($date1) - strtotime($date2));
		$years = floor($diff / (365 * 60 * 60 * 24));
		$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
		$Period_of_Service = $years . ' years, ' . $months . ' months, ' . $days . ' days';

		$CI->excel->getActiveSheet()->setCellValue(($earn_col_name . ($max_value + 5)), $Period_of_Service);

		$CI->excel->getActiveSheet()->mergeCells(($earn_col_name . ($max_value + 5)) . ':C' . ($max_value + 5));
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value + 2)) . ':B' . ($max_value + 5))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value + 2)) . ':B' . ($max_value + 5))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value + 2)) . ':B' . ($max_value + 5))->getFont();
		$CI->excel->getActiveSheet()->getStyle(($earn_col_name . ($max_value + 2)) . ':B' . ($max_value + 5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr . ($max_value + 2)), 'Opening Advance');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 2)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 2)))->getFont()->setSize(9);
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr . ($max_value + 3)), 'Addition Advance');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 3)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 3)))->getFont()->setSize(9);
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr . ($max_value + 4)), 'Recovery Advance');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 4)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 4)))->getFont()->setSize(9);
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_sr . ($max_value + 5)), 'Closing Advance');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 5)))->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 5)))->getFont()->setSize(9);
		//$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr.($max_value+5)).':D'.($max_value+5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 5)))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


		/************************************** advance code start here **************************************************************************************************/
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name . ($max_value + 2)), $employee_basic_info->advance_opening);
		$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name . ($max_value + 2)) . ':F' . ($max_value + 2));
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name . ($max_value + 3)), $employee_basic_info->advance_Addition); //$employee_basic_info->emp_designation 
		$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name . ($max_value + 3)) . ':F' . ($max_value + 3));
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name . ($max_value + 4)), $employee_basic_info->advance_recovery);
		$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name . ($max_value + 4)) . ':F' . ($max_value + 4));
		$CI->excel->getActiveSheet()->setCellValue(($deduct_col_name . ($max_value + 5)), $employee_basic_info->advance_closing_amt);
		$CI->excel->getActiveSheet()->mergeCells(($deduct_col_name . ($max_value + 5)) . ':F' . ($max_value + 5));
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 2)) . ':E' . ($max_value + 5))->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 2)) . ':E' . ($max_value + 5))->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 2)) . ':E' . ($max_value + 5))->getFont();
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_sr . ($max_value + 2)) . ':E' . ($max_value + 5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$CI->excel->getActiveSheet()->getStyle(($deduct_col_name . ($max_value + 2)) . ':F' . ($max_value + 5))->getNumberFormat()->setFormatCode('#,##0.00');

		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 2) . ':F' . ($max_value + 5))->applyFromArray($styleThickBrownBorderCalculateTitle2);

		/******************** end advance ***************************************************************************/
		$max_value = $max_value - 1;
		/******************** end ***************************/
		//note
		//$note=" Note :-This document contains confidential information. If you are not the intended recipient you are not authorized to use or disclose it in any form. If you received this in error please destroy it along with any copies & notify the sender immediately.";
		$note = "This is Computer Generated Document, hence does't required any Signature";
		//set cell A1 content with some text

		$CI->excel->getActiveSheet()->setCellValue($earn_col_sr . ($max_value + 7), $note);
		$CI->excel->getActiveSheet()->mergeCells($earn_col_sr . ($max_value + 7) . ':' . $deduct_col_value . ($max_value + 7))
			->getStyle()
			->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('EEEEEEEE');

		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 7))->getFont()->setName('Bookman Old Style');
		//change the font size
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 7))->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 7))->getFont()->setBold(true);
		;
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . ($max_value + 7))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . $earn . ':' . $deduct_col_value . ($max_value + 1))->getFont()->setName('Bookman Old Style');


		/*foreach(range('A','F') as $columnID) {
				  $CI->excel->getActiveSheet()->getColumnDimension($columnID)->setWidth(20);
			  }*/

		$styleThickBrownBorderOutline = array(
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THICK,
					'color' => array('argb' => 'FF000000'),
					//'color' => array('argb' => 'FF993300'),
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

		$styleThickBrownBorderCalculateTitle1 = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,

				),
			),
		);
		$CI->excel->getActiveSheet()->getStyle($earn_col_sr . $max_value . ':' . $deduct_col_value . $max_value)->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A8:B12')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('C8:F12')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A14:F14')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A21:F26')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A19:F19')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		//$CI->excel->getActiveSheet()->getStyle('A21')->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A14:' . $deduct_col_value . ($max_value))->applyFromArray($styleThickBrownBorderCalculate);
		//$CI->excel->getActiveSheet()->getStyle($earn_col_name.$max_value.''.)->applyFromArray($styleThickBrownBorderCalculateTitle1);
		$CI->excel->getActiveSheet()->getStyle('A1:' . $deduct_col_value . ($max_value + 1))->applyFromArray($styleThickBrownBorderOutline);
		$CI->excel->getActiveSheet()->getStyle('A4:' . $deduct_col_value . ($max_value + 7))->applyFromArray($styleThickBrownBorderOutline);
		//$CI->excel->getActiveSheet()->getStyle($earn_col_sr.($max_value+2).':'.$deduct_col_value.($max_value+2))->applyFromArray($styleThickBrownBorderOutline);

		$CI->excel->getActiveSheet()->getStyle('B8:B16')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('B8:B16')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle('E8:E16')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('E8:E16')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle('C8:C16')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('C8:C16')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle('F8:F16')->getFont()->setName('Bookman Old Style');
		$CI->excel->getActiveSheet()->getStyle('F8:F16')->getFont()->setSize(10);

		if (isset($imageName) && !empty($imageName)) {
			$path = './images/logo/' . $imageName;
			if (file_exists($path)) {
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setName('Logo');
				$objDrawing->setDescription('Logo');
				$objDrawing->setPath($path);
				$objDrawing->setHeight(60);
				$objDrawing->setWorksheet($CI->excel->getActiveSheet());
			}
		} else {

		}



		//$name_date = date('d/m/Y');
		$filename = $employee_basic_info->emp_name . ' Pay Slip for the Month of ' . $final_month_year . '.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
    
   
} 