<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : VISHAL GURHALE 
 *  Purpose    : Generating Salary Slip


 *  ======================================= 
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Monthly_report extends PHPExcel { 
    public function __construct() {  
        parent::__construct(); 
        $CI =& get_instance();  
        $CI->load->model('slip_aks_model');
        $CI->load->model('Slip_vish_model');   
		//$CI->load->database();     
		//$CI->load->library("session");
    } 
/*
	[emp_id] => 13 [company_id] => 27 [employee_id] => ME 08 [emp_name] => Prabir Sen [emp_loc] => pune headoffice [desig_id] => 39 [date_of_birth] => 1986-10-02 [bank_acc_no] => 31579746142 [bank_name] => SBI Bank [bank_ifc_code] => SBIN0000575 [bank_branch] => Pimpri Branch, Pune [emp_ac_type] => OTOBC [date_of_joining] => 2014-05-12 [emp_pan_num] => CDHPS7527Q [gender] => Male [emp_basic] => 10000 [advance_amount] => [display] => Y [basic_pt_id] => 34 [basic_amt] => 12650 [pt_amt] => 200 [work_day] => 30.0 [salary_month] => 03-2015 [net_pay] => 12042 ) Array ( [0] => stdClass Object ( [emp_earn_allow_sal_id] => 20 [allowance_details_id] => 13 [company_id] => 29 [emp_id] => 13 [allowance_sal_date] => 03-2015 [emp_earn_allow_id] => 331 [emp_earn_name] => conveyance allowance [earn_value] => 968 [convey_allowance_type] => fixed_amount [display] => Y ) [1] => stdClass Object ( [emp_earn_allow_sal_id] => 21 [allowance_details_id] => 13 [company_id] => 29 [emp_id] => 13 [allowance_sal_date] => 03-2015 [emp_earn_allow_id] => 332 [emp_earn_name] => House Rent Allowance [earn_value] => 3871 [convey_allowance_type] => Fixed [display] => Y ) ) Array ( [0] => stdClass Object ( [emp_deduct_sal_id] => 4 [emp_id] => 13 [company_id] => 29 [emp_deduct_id] => 274 [emp_deduct_name] => Mobile Deductions [allowance_sal_date] => 03-2015 [deduct_value] => 200 [display] => Y [allowance_details_id] => 13 ) ) 
*/
    function salarySlipReportExcelFormat1($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

    	
		// Set document properties
		 // $company_id = $employee_basic_info->company_id;
		 // $imageName = $CI->slip_aks_model->getImageName($company_id); //
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
		$CI->excel->getActiveSheet()->setTitle('Salery Report');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', 'Statement of Salary expenditure of '.$company_name.' for the Month of '.$month.' '.$year.''); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//set row height
		$CI->excel->getActiveSheet()->getRowDimension('1')
									->setRowHeight(20);
/*  set default border for all stylesheet */
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getTop()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getBottom()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getLeft()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getRight()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
/*  End set default border for all stylesheet */

		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells('A1:V1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEE0000');
/*$CI->excel->getActiveSheet()->getStyle('A1:V1')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '#F7F00C')
        )
    )
);
	*/	

		$CI->excel->getActiveSheet()->getStyle('A2:V3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	

		

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$CI->excel->getActiveSheet()->setCellValue('A2', 'Employee ID'); 
		$CI->excel->getActiveSheet()->setCellValue('B2', 'Name of the Employee'); 


		$CI->excel->getActiveSheet()->mergeCells('B2:C3')
								->getStyle()
								->getFill()
								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
								->getStartColor()->setARGB('EEEEEEEE');

				//set aligment to center for that merged cell (A1 to D1)
				$CI->excel->getActiveSheet()->getStyle('B2:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);


		//$CI->excel->getActiveSheet()->setCellValue('C2', 'Gross Salary P.M'); 
		$CI->excel->getActiveSheet()->setCellValue('D2', 'Present Days');
		$CI->excel->getActiveSheet()->setCellValue('E2', 'Payable during the month');
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Net Basic');
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'HRA');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'Other Allowance');
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Arrears');

		// cityb and medical 
		$CI->excel->getActiveSheet()->setCellValue('K3', 'City All');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Medical All');
		
		$CI->excel->getActiveSheet()->setCellValue('M2', 'Total Payable during the month'); 
		$CI->excel->getActiveSheet()->setCellValue('N2', 'Deductions');
		$CI->excel->getActiveSheet()->setCellValue('N3', 'Telephone (Co.)');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Arrears/ Others');
		$CI->excel->getActiveSheet()->setCellValue('P2', 'Total Deduction for the month');
		$CI->excel->getActiveSheet()->setCellValue('Q2', 'Advance');
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'Opening'); 
		$CI->excel->getActiveSheet()->setCellValue('R3', 'Addition'); 
		$CI->excel->getActiveSheet()->setCellValue('S3', 'Recovery'); 
		$CI->excel->getActiveSheet()->setCellValue('T3', 'Closing');
		$CI->excel->getActiveSheet()->setCellValue('U2', 'Bonus');
		$CI->excel->getActiveSheet()->setCellValue('V2', 'Salary Payable before P.T');   
		$CI->excel->getActiveSheet()->setCellValue('W2', ' P.T');  
		$CI->excel->getActiveSheet()->setCellValue('X2', 'Net Salary after P.T');

		/************ Wrap A2 V3 content */  
		$CI->excel->getActiveSheet()->getStyle('A2:X3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;


		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A2:X2')->getFont()->setName('Bookman Old Style');
		//change the font size
		$CI->excel->getActiveSheet()->getStyle('A2:X2')->getFont()->setSize(10);
		
				//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:X2')->getFont()->setBold(true);
		//merge cell E2:J2
		$CI->excel->getActiveSheet()->mergeCells('E2:L2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		$CI->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
/* marge and wrap K2:K3 */
		$CI->excel->getActiveSheet()->mergeCells('M2:M3')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('M2:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;
/* end marge and wrap K2:K3 */																	
/* marge and wrap L2 : M2 */
$CI->excel->getActiveSheet()->mergeCells('N2:O2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('N2:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;
/* end marge and wrap L2 : M2 */

/* marge and wrap N2:N3 */
		$CI->excel->getActiveSheet()->mergeCells('P2:P3')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('P2:P3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;
/* end marge and wrap N2:N3 */	
		//merge cell E2:J2
		$CI->excel->getActiveSheet()->mergeCells('Q2:T2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		$CI->excel->getActiveSheet()->getStyle('Q2:T2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;
		//end marge
/* marge and wrap S2:S3 */
		$CI->excel->getActiveSheet()->mergeCells('W2:W3')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('W2:W3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;
/* end marge and wrap S2:S3 */	
/* marge and wrap T2:T3 */
		$CI->excel->getActiveSheet()->mergeCells('U2:U3')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('U2:U3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;
/* end marge and wrap T2:T3 */	
/* marge and wrap U2:U3 */
		$CI->excel->getActiveSheet()->mergeCells('X2:X3')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('X2:X3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;
/* end marge and wrap U2:U3 */	
/* marge and wrap V2:V3 */
		$CI->excel->getActiveSheet()->mergeCells('V2:V3')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');

		//set aligment to center for that merged cell (A1 to D1)
		$CI->excel->getActiveSheet()->getStyle('V2:V3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);;

		/* start dynamic code from here *********/
		$lastRowNum=5;
 		if (isset($emp_basic_data) && !empty($emp_basic_data)) {
 		$j=4;
 		$lastRowNum= $lastRowNum + count($emp_basic_data);
 		// define total vcariable for per coloumn 
 		$net_basic_total=0;
 		$net_basic_totalE=0;
 		$salBefoPt_total=0;
 		$pt_total=0;
 		$net_with_pt_total=0;
 		$total_deduction=0;
 		$Conveyance_total=0;
 		$mobile_total=0;
 		$HRA_total = 0;
 		$otherAllow_total=0;
 		$Arrears_total=0;
 		$allowance_total_emp = 0;
 		$allowance_ded_total_emp = 0;
		$mobile_ded_total = 0;
		$ArrOther_ded_total = 0;
		$Bonus_total = 0;
		$Advance_total = 0;
		$per_emp_advance=0;
		$deduct_adv_total=0;
		$Advance_deduction=0;
		$medical_total=0;
		$city_total=0;
		$adv_opening = 0;
		$adv_Addition = 0;
		$adv_recovery = 0;
		$adv_closing_amt = 0;

		
		$pay_during_month = 0;
		$pay_beforePt=0;
		$final_net_pay=0;
		$basic_net=0;
 		foreach ($emp_basic_data as $key) {
 			$netBasicTotK = 0;
 			$emp_wise_ded=0;
 			$boun_emp = 0;
 			$emp_wise_add_deduction = 0;
 		 	$CI->excel->getActiveSheet()->setCellValue('F'.$j,0);	
 		 	$CI->excel->getActiveSheet()->setCellValue('J'.$j,0);
			$CI->excel->getActiveSheet()->setCellValue('G'.$j,0);
			$CI->excel->getActiveSheet()->setCellValue('H'.$j,0);
			$CI->excel->getActiveSheet()->setCellValue('I'.$j,0); 
			$CI->excel->getActiveSheet()->setCellValue('J'.$j,0);
			$CI->excel->getActiveSheet()->setCellValue('K'.$j,0);
			// for ($j=4; $j < 8 ; $j++) { 
			$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
			$emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
			//
				// for ($i='A'; $i < 'W' ; $i++) { 
				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$key->employee_id);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
				
				




				//$CI->excel->getActiveSheet()->setCellValue('C'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->work_day);
				$bsNet = 0;

				if(isset($key->net_pay) && $key->net_pay>0){ $bsNet = $key->net_pay + $key->pt_amt;
				$netBasicTotK = $bsNet; }
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$key->basic_net);
				$basic_net = $basic_net+$key->basic_net;

				/****************** allownces start from here *******************/
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,$key->convey);
					//$allowance_total_emp = $allowance_total_emp + $key->convey;
					$Conveyance_total = $Conveyance_total + $key->convey;
				/*$CI->excel->getActiveSheet()->setCellValue('G'.$j,$key->earn_value);
								$allowance_total_emp = $allowance_total_emp + $key->earn_value;
								$mobile_total = $mobile_total + $key->earn_vhraalue;*/
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,$key->hra);
								//$allowance_total_emp = $allowance_total_emp + $key->hra;
								$HRA_total = $HRA_total + $key->hra;
				// earning ALLOWANCE
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,$key->earn_arrears);
				//$allowance_total_emp = $allowance_total_emp + $key->earn_arrears;
				$Arrears_total = $Arrears_total + $key->earn_arrears;
				$CI->excel->getActiveSheet()->setCellValue('Q'.$j, $key->advance_opening);
				$CI->excel->getActiveSheet()->setCellValue('R'.$j, $key->advance_Addition);
				$CI->excel->getActiveSheet()->setCellValue('S'.$j, $key->advance_recovery);
				$CI->excel->getActiveSheet()->setCellValue('T'.$j, $key->advance_closing_amt);
				
				$CI->excel->getActiveSheet()->setCellValue('U'.$j, '0');

				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;
				/*print_r($emp_allData);
				echo $key->salary_month;
				echo $key->emp_id;
				print_r($emp_basic_data);
					exit();*/
				if(isset($emp_allData) && !empty($emp_allData)){
					
					foreach ($emp_allData as $row) {
					// if ($key->allowance_details_id==$row->allowance_details_id) {						
								

						

						/****************** allowances end here ************************/
								if ($row->earning_id == 6 ) {
								// mobile allowance
									$last_val = $row->value/$num_days_of_month;
									$value = $key->work_day*$last_val;
								$CI->excel->getActiveSheet()->setCellValue('G'.$j,$row->value);
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								$mobile_total = $mobile_total + $row->value;
								
								}elseif($row->earning_id == 8 ) {
									// other allowance 
								/*$CI->excel->getActiveSheet()->setCellValue('I'.$j,$row->earn_value);
								$allowance_total_emp = $allowance_total_emp + $row->earn_value;
								$otherAllow_total = $otherAllow_total + $row->earn_value;
								*/
								// other allowance
								$last_val = $row->value/$num_days_of_month;
								$value = $key->work_day*$last_val;
								$CI->excel->getActiveSheet()->setCellValue('I'.$j,$value);
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								$otherAllow_total = $otherAllow_total + $value;
								
								}elseif($row->earning_id == 14 ) {				
								// City allowance 
								$last_val = $row->value/$num_days_of_month;
								$value = $key->work_day*$last_val;
								$CI->excel->getActiveSheet()->setCellValue('K'.$j,$value);
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								$city_total = $city_total + $value;
								}elseif($row->earning_id == 13) {
								//	medical allowance
								$last_val = $row->value/$num_days_of_month;
								$value = $key->work_day*$last_val;
								$CI->excel->getActiveSheet()->setCellValue('L'.$j,$value);
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								$medical_total = $medical_total + $value;
								}elseif($row->earning_id == 15) {
								//	Bonus

									$CI->excel->getActiveSheet()->setCellValue('U'.$j,$row->value);
									//$allowance_total_emp = $allowance_total_emp + $row->value;
									/*$boun_emp=$boun_emp+$row->value;*/
									$Bonus_total = $Bonus_total + $row->value;
								}elseif($row->earning_id == 16) {
								//	Opening Advance
								//$CI->excel->getActiveSheet()->setCellValue('Q'.$j,$row->value);
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								
								
								$Advance_total = $Advance_total + $row->value;
								$per_emp_advance = $row->value;
								
								}else{
									$allowance_total_emp=0;
									//$CI->excel->getActiveSheet()->setCellValue('J'.$j,0);
									//$CI->excel->getActiveSheet()->setCellValue('G'.$j,0);
									//$CI->excel->getActiveSheet()->setCellValue('H'.$j,0);
									//$CI->excel->getActiveSheet()->setCellValue('I'.$j,0);
								}


						}
				}else{
					//$CI->excel->getActiveSheet()->setCellValue('J'.$j,0);
					//$CI->excel->getActiveSheet()->setCellValue('G'.$j,0);
					//$CI->excel->getActiveSheet()->setCellValue('H'.$j,0);
					//$CI->excel->getActiveSheet()->setCellValue('I'.$j,0);
				}	




		// deduction data printing 
		
		//$CI->excel->getActiveSheet()->setCellValue('N'.$j,0);
		//$CI->excel->getActiveSheet()->setCellValue('P'.$j,0);

		// mobile deduction
		$CI->excel->getActiveSheet()->setCellValue('N'.$j,$key->mobile_deduction);
		$allowance_ded_total_emp = $allowance_ded_total_emp + $key->mobile_deduction;
		$emp_wise_ded = $emp_wise_ded+$key->mobile_deduction;
		$emp_wise_add_deduction = $emp_wise_add_deduction+$key->mobile_deduction;
		$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;
		
		// deduction arrears

		$CI->excel->getActiveSheet()->setCellValue('O'.$j,$key->other_deduct);
		$allowance_ded_total_emp = $allowance_ded_total_emp + $key->other_deduct;
		$ArrOther_ded_total = $ArrOther_ded_total + $key->other_deduct;
		$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

		if(isset($emp_Ded_allData) && !empty($emp_Ded_allData)){

			
				foreach ($emp_Ded_allData as $rec) {
				

					if ($rec->deduction_id == 6) {
							$CI->excel->getActiveSheet()->setCellValue('S'.$j,$rec->deduct_value);
							//$emp_wise_ded = $emp_wise_ded+$rec->deduct_value;
							//$allowance_ded_total_emp = $allowance_ded_total_emp + $rec->deduct_value;
							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
							$per_emp_advance = $per_emp_advance-$rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							if($per_emp_advance>0){}else{$per_emp_advance=0;}
							$CI->excel->getActiveSheet()->setCellValue('T'.$j,$per_emp_advance);
							
							
						}
						elseif (($rec->deduction_id == 'Arrears/ others') || ($rec->emp_deduct_name == 'Deduction Arrears')) {

							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
						}else{
							//$CI->excel->getActiveSheet()->setCellValue('L'.$j,0);
							//$CI->excel->getActiveSheet()->setCellValue('M'.$j,0);
						}

				
			}
		}
		$pay_during_month = ($pay_during_month) + ($allowance_total_emp+$netBasicTotK)+($emp_wise_add_deduction-$boun_emp);
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,($allowance_total_emp+$netBasicTotK)+($emp_wise_add_deduction-$boun_emp));
				/*$CI->excel->getActiveSheet()->setCellValue('L'.$j,$mobile_ded_total);
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,$ArrOther_ded_total);*/
				$CI->excel->getActiveSheet()->setCellValue('P'.$j,$emp_wise_ded);
				//$CI->excel->getActiveSheet()->setCellValue('O'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('R'.$j,'');
				//$CI->excel->getActiveSheet()->setCellValue('R'.$j,'');
				//$CI->excel->getActiveSheet()->setCellValue('S'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('V'.$j,(($allowance_total_emp)+($bsNet))-($key->deduct_amt));
				$pt=0;
				$pay_beforePt = $pay_beforePt + (($allowance_total_emp)+($bsNet))-($key->deduct_amt);
				if(isset($key->net_pay) && $key->net_pay > 0){$pt =$key->pt_amt; }
				$CI->excel->getActiveSheet()->setCellValue('W'.$j,$pt);
				$CI->excel->getActiveSheet()->setCellValue('X'.$j,($allowance_total_emp)+($key->net_pay)-($key->deduct_amt));
				
				//code for sum every coloumn  860065965
				$net_basic_totalE = $net_basic_totalE + $netBasicTotK;
				$net_basic_total = ($allowance_total_emp) + ($bsNet);
				$salBefoPt_total = ($salBefoPt_total)+(($allowance_total_emp)+($bsNet));
				$final_net_pay = $final_net_pay + (($allowance_total_emp)+(($key->net_pay)-($key->deduct_amt)));
				$pt_total = $pt_total + $key->pt_amt;
				$net_with_pt_total = ($net_with_pt_total)+ (($allowance_total_emp)+($key->net_pay));
				$total_deduction = $total_deduction + $key->deduct_amt;


				
					// }
				// }	
				$j++;
				$emp_allData='';
				$emp_Ded_allData ='';
				$allowance_total_emp=0;
			}

			$CI->excel->getActiveSheet()->getStyle('B'.$lastRowNum.':X'.$lastRowNum)->getFont()->setBold(true);
			
		
			$CI->excel->getActiveSheet()->setCellValue('B'.$lastRowNum, 'Total');
			//$CI->excel->getActiveSheet()->setCellValue('C'.$lastRowNum, '00.0');
			$CI->excel->getActiveSheet()->setCellValue('D'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('E'.$lastRowNum, $basic_net);
			$CI->excel->getActiveSheet()->setCellValue('F'.$lastRowNum, $Conveyance_total);
			$CI->excel->getActiveSheet()->setCellValue('G'.$lastRowNum, $mobile_total);
			$CI->excel->getActiveSheet()->setCellValue('H'.$lastRowNum, $HRA_total);
			$CI->excel->getActiveSheet()->setCellValue('I'.$lastRowNum, $otherAllow_total);

			// city and medical 
			$CI->excel->getActiveSheet()->setCellValue('J'.$lastRowNum, $Arrears_total);
			$CI->excel->getActiveSheet()->setCellValue('K'.$lastRowNum, $city_total);

			//
			$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, $medical_total);
			$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, $pay_during_month);
			$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, $mobile_ded_total);
			$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, $ArrOther_ded_total);
			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, $allowance_ded_total_emp);
			
			/*$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, $Advance_total);
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, '00.0');
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, $Advance_deduction);
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, '00.0');*/
			
			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, $adv_opening);
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, $adv_Addition);
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, $adv_recovery);
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, $adv_closing_amt);

			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, $Bonus_total);
			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, $pay_beforePt);
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, $pt_total);
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, $final_net_pay);
		}	
		/* end dynamic code here **************/
		

		//$name_date = date('d/m/Y'); 
		/*$filename=$employee_basic_info->emp_name.'-'.$current_date.'.xls';*/ //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="Salary_report.xls"'); //tell browser what's the file name
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

/********************* New Format Of Report ********************************/


   function salarySlipReportExcelFormat($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moon Education Pvt. Ltd")
							 	   ->setLastModifiedBy("Moon Education Pvt. Ltd")
							 	   ->setTitle("Pay Slip")
							 	   ->setSubject("Pay Slip Of An Employee")
							 	   ->setDescription("System Generated File.")
							 	   ->setKeywords("office 2007")
							 	   ->setCategory("Confidential");

		$allborders = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					
				),
			),
		);
		//activate worksheet number 1
		$CI->excel->setActiveSheetIndex(0);
		//name the worksheet
		$CI->excel->getActiveSheet()->setTitle('Salery Report');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', $company_name); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//set row height
		$CI->excel->getActiveSheet()->getRowDimension('1')
									->setRowHeight(20);
		/*  set default border for all stylesheet */
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getTop()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getBottom()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getLeft()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getRight()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		/*  End set default border for all stylesheet */

		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells('A1:X1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:X2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Salary Sheet for the Month of '.$month.' '.$year.''); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		//set row height
		$CI->excel->getActiveSheet()->getRowDimension('2')
									->setRowHeight(20);
		/*  set default border for all stylesheet */
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getTop()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getBottom()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getLeft()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$CI->excel->getDefaultStyle()
		    ->getBorders()
		    ->getRight()
		    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		/*  End set default border for all stylesheet */

		//merge cell A1 until D1
		$CI->excel->getActiveSheet()->mergeCells('A2:X2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:X2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Employee ID'); 
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Name of the Employee'); 


		/*$CI->excel->getActiveSheet()->mergeCells('B3:C3')
								->getStyle()
								->getFill()
								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
								->getStartColor()->setARGB('EEEEEEEE');

				//set aligment to center for that merged cell (A1 to D1)
				$CI->excel->getActiveSheet()->getStyle('B3:C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
																	->setWrapText(true);
*/

		//$CI->excel->getActiveSheet()->setCellValue('C2', 'Gross Salary P.M'); 
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Present Days');
		//$CI->excel->getActiveSheet()->setCellValue('E2', 'Payable during the month');
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Net Basic');
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'HRA');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'Other Allowance');
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Arrears');

		// cityb and medical 
		$CI->excel->getActiveSheet()->setCellValue('K3', 'City All');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Medical All');
		
		$CI->excel->getActiveSheet()->setCellValue('M3', 'Total Payable during the month'); 
		$CI->excel->getActiveSheet()->setCellValue('N3', 'Deductions');
		$CI->excel->getActiveSheet()->setCellValue('N3', 'Telephone (Co.)');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Arrears/ Others');
		$CI->excel->getActiveSheet()->setCellValue('P3', 'Total Deduction for the month');
		//$CI->excel->getActiveSheet()->setCellValue('Q2', 'Advance');
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'Opening'); 
		$CI->excel->getActiveSheet()->setCellValue('R3', 'Addition'); 
		$CI->excel->getActiveSheet()->setCellValue('S3', 'Recovery'); 
		$CI->excel->getActiveSheet()->setCellValue('T3', 'Closing');
		$CI->excel->getActiveSheet()->setCellValue('U3', 'Bonus');
		$CI->excel->getActiveSheet()->setCellValue('V3', 'Salary Payable before P.T');   
		$CI->excel->getActiveSheet()->setCellValue('W3', ' P.T');  
		$CI->excel->getActiveSheet()->setCellValue('X3', 'Net Salary after P.T');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(25);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(0);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(15);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(15);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:X3')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:X3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:X3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:X3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:X3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:X3')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A3:X3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);;

		/* start dynamic code from here *********/
		$lastRowNum=4;
 		if (isset($emp_basic_data) && !empty($emp_basic_data)) {
 		$j=4;
 		$lastRowNum= $lastRowNum + count($emp_basic_data);
 		// define total vcariable for per coloumn 
 		$net_basic_total=0;
 		$net_basic_totalE=0;
 		$salBefoPt_total=0;
 		$pt_total=0;
 		$net_with_pt_total=0;
 		$total_deduction=0;
 		$Conveyance_total=0;
 		$mobile_total=0;
 		$HRA_total = 0;
 		$otherAllow_total=0;
 		$Arrears_total=0;
 		$allowance_total_emp = 0;
 		$allowance_ded_total_emp = 0;
		$mobile_ded_total = 0;
		$ArrOther_ded_total = 0;
		$Bonus_total = 0;
		$Advance_total = 0;
		$per_emp_advance=0;
		$deduct_adv_total=0;
		$Advance_deduction=0;
		$medical_total=0;
		$city_total=0;
		$adv_opening = 0;
		$adv_Addition = 0;
		$adv_recovery = 0;
		$adv_closing_amt = 0;

		
		$pay_during_month = 0;
		$pay_beforePt=0;
		$final_net_pay=0;
		$basic_net=0;
 		foreach ($emp_basic_data as $key) {
 			$netBasicTotK = 0;
 			$emp_wise_ded=0;
 			$boun_emp = 0;
 			$emp_wise_add_deduction = 0;
 		 	$CI->excel->getActiveSheet()->setCellValue('F'.$j,0);	
 		 	$CI->excel->getActiveSheet()->setCellValue('J'.$j,0);
			$CI->excel->getActiveSheet()->setCellValue('G'.$j,0);
			$CI->excel->getActiveSheet()->setCellValue('H'.$j,0);
			$CI->excel->getActiveSheet()->setCellValue('I'.$j,0); 
			$CI->excel->getActiveSheet()->setCellValue('J'.$j,0);
			$CI->excel->getActiveSheet()->setCellValue('K'.$j,0);
			// for ($j=4; $j < 8 ; $j++) { 
			$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
			$emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
			//
				// for ($i='A'; $i < 'W' ; $i++) { 
				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$key->employee_id);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
				
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->work_day);
				$bsNet = 0;

				if(isset($key->net_pay) && $key->net_pay>0){ $bsNet = $key->net_pay + $key->pt_amt;
				$netBasicTotK = $bsNet; }
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,round($key->basic_net,2));
				$basic_net = $basic_net+$key->basic_net;

				/****************** allownces start from here *******************/
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,$key->convey);
					//$allowance_total_emp = $allowance_total_emp + $key->convey;
					$Conveyance_total = $Conveyance_total + $key->convey;
				/*$CI->excel->getActiveSheet()->setCellValue('G'.$j,$key->earn_value);
								$allowance_total_emp = $allowance_total_emp + $key->earn_value;
								$mobile_total = $mobile_total + $key->earn_vhraalue;*/
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,$key->hra);
								//$allowance_total_emp = $allowance_total_emp + $key->hra;
								$HRA_total = $HRA_total + $key->hra;
				// earning ALLOWANCE
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,$key->earn_arrears);
				//$allowance_total_emp = $allowance_total_emp + $key->earn_arrears;
				$Arrears_total = $Arrears_total + $key->earn_arrears;
				$CI->excel->getActiveSheet()->setCellValue('Q'.$j, $key->advance_opening);
				$CI->excel->getActiveSheet()->setCellValue('R'.$j, $key->advance_Addition);
				$CI->excel->getActiveSheet()->setCellValue('S'.$j, $key->advance_recovery);
				$CI->excel->getActiveSheet()->setCellValue('T'.$j, $key->advance_closing_amt);
				
				$CI->excel->getActiveSheet()->setCellValue('U'.$j, '0');

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':X'.$j)->getFont()->setName('Bookman Old Style');
		        $CI->excel->getActiveSheet()->getStyle('A'.$j.':X'.$j)->getFont()->setSize(10);
				$CI->excel->getActiveSheet()->getStyle('A'.$j.':X'.$j)->applyFromArray($allborders);
				$CI->excel->getActiveSheet()->getStyle('D'.$j.':X'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																			->setWrapText(true);

				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;
				

				if(isset($emp_allData) && !empty($emp_allData)){
					
					foreach ($emp_allData as $row) {
					// if ($key->allowance_details_id==$row->allowance_details_id) {						
								

						

						/****************** allowances end here ************************/
								if ($row->earning_id == 6 ) {
								// mobile allowance
									$last_val = $row->value/$num_days_of_month;
									$value = $key->work_day*$last_val;
								$CI->excel->getActiveSheet()->setCellValue('G'.$j,$row->value);
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								$mobile_total = $mobile_total + $row->value;
								
								}elseif($row->earning_id == 8 ) {
									// other allowance 
								/*$CI->excel->getActiveSheet()->setCellValue('I'.$j,$row->earn_value);
								$allowance_total_emp = $allowance_total_emp + $row->earn_value;
								$otherAllow_total = $otherAllow_total + $row->earn_value;
								*/
								// other allowance
								$last_val = $row->value/$num_days_of_month;
								$value = $key->work_day*$last_val;
								$CI->excel->getActiveSheet()->setCellValue('I'.$j,round($value,2));
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								$otherAllow_total = $otherAllow_total + $value;
								
								}elseif($row->earning_id == 14 ) {				
								// City allowance 
								$last_val = $row->value/$num_days_of_month;
								$value = $key->work_day*$last_val;
								$CI->excel->getActiveSheet()->setCellValue('K'.$j,$value);
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								$city_total = $city_total + $value;
								}elseif($row->earning_id == 13) {
								//	medical allowance
								$last_val = $row->value/$num_days_of_month;
								$value = $key->work_day*$last_val;
								$CI->excel->getActiveSheet()->setCellValue('L'.$j,$value);
								//$allowance_total_emp = $allowance_total_emp + $row->value;
								$medical_total = $medical_total + $value;
								}elseif($row->earning_id == 15) {
								//	Bonus

									$CI->excel->getActiveSheet()->setCellValue('U'.$j,$row->value);
									//$allowance_total_emp = $allowance_total_emp + $row->value;
									/*$boun_emp=$boun_emp+$row->value;*/
									$Bonus_total = $Bonus_total + $row->value;
								}
								elseif($row->earning_id == 16)
								{
								
								$Advance_total = $Advance_total + $row->value;
								$per_emp_advance = $row->value;
								
								}else{
									$allowance_total_emp=0;
									
								}


						}
				}else{
					
				}	

		// mobile deduction
		$CI->excel->getActiveSheet()->setCellValue('N'.$j,$key->mobile_deduction);
		$allowance_ded_total_emp = $allowance_ded_total_emp + $key->mobile_deduction;
		$emp_wise_ded = $emp_wise_ded+$key->mobile_deduction;
		$emp_wise_add_deduction = $emp_wise_add_deduction+$key->mobile_deduction;
		$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;
		
		// deduction arrears

		$CI->excel->getActiveSheet()->setCellValue('O'.$j,$key->other_deduct);
		$allowance_ded_total_emp = $allowance_ded_total_emp + $key->other_deduct;
		$ArrOther_ded_total = $ArrOther_ded_total + $key->other_deduct;
		$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

		if(isset($emp_Ded_allData) && !empty($emp_Ded_allData)){

			
				foreach ($emp_Ded_allData as $rec) {
				

					if ($rec->deduction_id == 6) {
							$CI->excel->getActiveSheet()->setCellValue('S'.$j,$rec->deduct_value);
							//$emp_wise_ded = $emp_wise_ded+$rec->deduct_value;
							//$allowance_ded_total_emp = $allowance_ded_total_emp + $rec->deduct_value;
							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
							$per_emp_advance = $per_emp_advance-$rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							if($per_emp_advance>0){}else{$per_emp_advance=0;}
							$CI->excel->getActiveSheet()->setCellValue('T'.$j,$per_emp_advance);
							
							
						}
						elseif (($rec->deduction_id == 'Arrears/ others') || ($rec->emp_deduct_name == 'Deduction Arrears')) {

							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
						}else{
							//$CI->excel->getActiveSheet()->setCellValue('L'.$j,0);
							//$CI->excel->getActiveSheet()->setCellValue('M'.$j,0);
						}

				
			}
		}
		$pay_during_month = ($pay_during_month) + ($allowance_total_emp+$netBasicTotK)+($emp_wise_add_deduction-$boun_emp);
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,($allowance_total_emp+$netBasicTotK)+($emp_wise_add_deduction-$boun_emp));
				/*$CI->excel->getActiveSheet()->setCellValue('L'.$j,$mobile_ded_total);
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,$ArrOther_ded_total);*/
				$CI->excel->getActiveSheet()->setCellValue('P'.$j,$emp_wise_ded);
				//$CI->excel->getActiveSheet()->setCellValue('O'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('R'.$j,'');
				//$CI->excel->getActiveSheet()->setCellValue('R'.$j,'');
				//$CI->excel->getActiveSheet()->setCellValue('S'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('V'.$j,(($allowance_total_emp)+($bsNet))-($key->deduct_amt));
				$pt=0;
				$pay_beforePt = $pay_beforePt + (($allowance_total_emp)+($bsNet))-($key->deduct_amt);
				if(isset($key->net_pay) && $key->net_pay > 0){$pt =$key->pt_amt; }
				$CI->excel->getActiveSheet()->setCellValue('W'.$j,$pt);
				$CI->excel->getActiveSheet()->setCellValue('X'.$j,($allowance_total_emp)+($key->net_pay)-($key->deduct_amt));
				
				//code for sum every coloumn  860065965
				$net_basic_totalE = $net_basic_totalE + $netBasicTotK;
				$net_basic_total = ($allowance_total_emp) + ($bsNet);
				$salBefoPt_total = ($salBefoPt_total)+(($allowance_total_emp)+($bsNet));
				$final_net_pay = $final_net_pay + (($allowance_total_emp)+(($key->net_pay)-($key->deduct_amt)));
				$pt_total = $pt_total + $key->pt_amt;
				$net_with_pt_total = ($net_with_pt_total)+ (($allowance_total_emp)+($key->net_pay));
				$total_deduction = $total_deduction + $key->deduct_amt;


				
					// }
				// }	
				$j++;
				$emp_allData='';
				$emp_Ded_allData ='';
				$allowance_total_emp=0;
			}

			$CI->excel->getActiveSheet()->getStyle('B'.$lastRowNum.':X'.$lastRowNum)->getFont()->setBold(true);
			
		
			$CI->excel->getActiveSheet()->setCellValue('B'.$lastRowNum, 'Total');
			//$CI->excel->getActiveSheet()->setCellValue('C'.$lastRowNum, '00.0');
			$CI->excel->getActiveSheet()->setCellValue('D'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('E'.$lastRowNum, round($basic_net,2));
			$CI->excel->getActiveSheet()->setCellValue('F'.$lastRowNum, $Conveyance_total);
			$CI->excel->getActiveSheet()->setCellValue('G'.$lastRowNum, $mobile_total);
			$CI->excel->getActiveSheet()->setCellValue('H'.$lastRowNum, $HRA_total);
			$CI->excel->getActiveSheet()->setCellValue('I'.$lastRowNum, round($otherAllow_total,2));

			// city and medical 
			$CI->excel->getActiveSheet()->setCellValue('J'.$lastRowNum, $Arrears_total);
			$CI->excel->getActiveSheet()->setCellValue('K'.$lastRowNum, $city_total);

			//
			$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, $medical_total);
			$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, $pay_during_month);
			$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, $mobile_ded_total);
			$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, $ArrOther_ded_total);
			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, $allowance_ded_total_emp);
			
			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, $adv_opening);
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, $adv_Addition);
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, $adv_recovery);
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, $adv_closing_amt);

			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, $Bonus_total);
			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, $pay_beforePt);
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, $pt_total);
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, $final_net_pay);

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':X'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':X'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('D'.$lastRowNum.':X'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																			->setWrapText(true);
		}	
		/* end dynamic code here **************/
		

		//$name_date = date('d/m/Y'); 
		/*$filename=$employee_basic_info->emp_name.'-'.$current_date.'.xls';*/ //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="Salary_report.xls"'); //tell browser what's the file name
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