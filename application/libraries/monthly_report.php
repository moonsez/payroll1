<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Rahul Pimpalkar 
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
        $CI->load->model('Master_model');   
		//$CI->load->database();     
		//$CI->load->library("session");
    } 


	/********************* New Format Of Report ********************************/

   	function salarySlipReportExcelFormat($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Salary Sheet - '.$month.' '.$year);
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
		$CI->excel->getActiveSheet()->mergeCells('A1:AR1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:AR1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:AR2')
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
		$CI->excel->getActiveSheet()->mergeCells('A2:AR2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:AR2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Employee ID'); 
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Name of the Employee');		
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Company name');		
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Working Days');
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Present Days');
		// Earning Allowance
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'DA Allowance');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'HRA');
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('K3', 'Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('N3', 'City Allowance');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('P3', 'Total Gross'); 
		// ctc
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'PF (Employers Contribution)'); 
		$CI->excel->getActiveSheet()->setCellValue('R3', 'ESIC (Employers Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('S3', 'PF (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('T3', 'ESIC (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('U3', 'CTC');
		// salary on number of days
		$CI->excel->getActiveSheet()->setCellValue('V3', 'Earn Basic');
		$CI->excel->getActiveSheet()->setCellValue('W3', 'Earn DA');
		$CI->excel->getActiveSheet()->setCellValue('X3', 'Earn HRA');
		$CI->excel->getActiveSheet()->setCellValue('Y3', 'Earn Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('Z3', 'Earn Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AA3', 'Earn Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AB3', 'Earn Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AC3', 'Earn City Allowance');  
		$CI->excel->getActiveSheet()->setCellValue('AD3', 'Earn Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AE3', 'Total Earn Gross');
		$CI->excel->getActiveSheet()->setCellValue('AF3', 'Employees PF Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AG3', 'Employees ESIC  Deduction ');
		$CI->excel->getActiveSheet()->setCellValue('AH3', 'Professional Tax');
		// if Deducation
		$CI->excel->getActiveSheet()->setCellValue('AI3', 'Telephone (Co.)');
		$CI->excel->getActiveSheet()->setCellValue('AJ3', 'Others Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AK3', 'Advance Opening'); 
		$CI->excel->getActiveSheet()->setCellValue('AL3', 'Advance Addition'); 
		$CI->excel->getActiveSheet()->setCellValue('AM3', 'Advance Recovery'); 
		$CI->excel->getActiveSheet()->setCellValue('AN3', 'Advance Closing');
		$CI->excel->getActiveSheet()->setCellValue('AO3', 'Total Deduction for the month');
		$CI->excel->getActiveSheet()->setCellValue('AP3', 'Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Arrears');
		//Total Salary 
		$CI->excel->getActiveSheet()->setCellValue('AR3', 'Net Pay');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(25);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(35);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(10);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:AR3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);;

		/* start dynamic code from here *********/
		$lastRowNum=4;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
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
	 		$DA_total = 0;
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
			$education_total=0;
			$adv_opening = 0;
			$adv_Addition = 0;
			$adv_recovery = 0;
			$adv_closing_amt = 0;

			$mobile_total_all=0;
			$otherAllow_total_all=0;
			$recy_ttl = 0;
			$entertainment_total = 0;
			$pf_earn = 0;
			$ESIC_earn = 0;
			$pf_deduct = 0;
			$ESIC_deduct = 0;
			$tot_pf_deduct=0;
			$tot_ESIC_deduct=0;
			$pay_during_month = 0;
			$pay_beforePt=0;
			$final_net_pay=0;
			$basic_net=0;
			$total_ctc=0;
			$total_gross=0;
			$total_earn_gross=0;
			$total_net_salary=0;
			$total_deduct_mnth=0;
			$total_net_pay=0;
			//emp info
			$emp_bac = 0;
			$emp_da = 0;
			$emp_hra = 0;
			$emp_convy = 0;
			$emp_mob = 0;
			$emp_med = 0;
			$emp_edu = 0;
			$emp_city = 0;
			$emp_enter = 0;
			$emp_gross = 0;
	 		$sr=1;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$netBasicTotK = 0;
	 			$emp_wise_ded=0;
	 			$boun_emp = 0;
	 			$emp_wise_add_deduction = 0;
	 		 	
				$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
				$emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
				$earn_allowance = $CI->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->empl_id);
				$emp_basic = $CI->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->empl_id);
				
				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->employee_id);
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->emp_name);
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$company_name);
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$num_days_of_month);
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,$key->work_day);
				//EARNING ALLOWANCE
				
				if(isset($earn_allowance) && !empty($earn_allowance))
				{
					$basic = $emp_basic->emp_basic;
					$CI->excel->getActiveSheet()->setCellValue('G'.$j,round($basic));
					$emp_bac = $emp_bac + $basic;

					$da = 0;
					$hra = 0;
					$conveyance = 0;
					$mobile = 0;
					$medical = 0;
					$education = 0;
					$city = 0;
					$entertainment = 0;

					foreach ($earn_allowance as $earn)
					{
						if($earn->earning_id == 18 )
						{
							//DA allowance
							$CI->excel->getActiveSheet()->setCellValue('H'.$j,round($earn->earn_value));
							$emp_da = $emp_da + $earn->earn_value; 
							$da = $earn->earn_value;
							
						}elseif($earn->earning_id == 7)
						{
							//HRA
							$CI->excel->getActiveSheet()->setCellValue('I'.$j,round($earn->earn_value));
							$emp_hra = $emp_hra + $earn->earn_value;
							$hra = $earn->earn_value;
							
						}elseif($earn->earning_id == 3)
						{
							//Conveyance
							$CI->excel->getActiveSheet()->setCellValue('J'.$j,round($earn->earn_value));
							$emp_convy = $emp_convy + $earn->earn_value;
							$conveyance = $earn->earn_value;
							
						}elseif ($earn->earning_id == 6 ) 
						{
							// mobile allowance
							$CI->excel->getActiveSheet()->setCellValue('K'.$j,round($earn->earn_value));
							$emp_mob = $emp_mob + $earn->earn_value;
							$mobile = $earn->earn_value;
							
						}elseif($earn->earning_id == 13)
						{
							//medical allowance
							$CI->excel->getActiveSheet()->setCellValue('L'.$j,round($earn->earn_value));
							$emp_med = $emp_med + $earn->earn_value;
							$medical = $earn->earn_value;
							
						}elseif($earn->earning_id == 20)
						{
							//education allowance
							$CI->excel->getActiveSheet()->setCellValue('M'.$j,round($earn->earn_value));
							$emp_edu = $emp_edu + $earn->earn_value;
							$education = $earn->earn_value;
							
						}elseif($earn->earning_id == 14 )
						{				
							// City allowance
							$CI->excel->getActiveSheet()->setCellValue('N'.$j,round($earn->earn_value));
							$emp_city = $emp_city + $earn->earn_value;
							$city = $earn->earn_value;
							
						}elseif($earn->earning_id == 22)
						{
							//entertainment allowance
							$CI->excel->getActiveSheet()->setCellValue('O'.$j,round($earn->earn_value));
							$emp_enter = $emp_enter + $earn->earn_value;
							$entertainment = $earn->earn_value;
							
						}
					}
				}
				
				$gross = $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1;

				$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($gross));
				$emp_gross = $emp_gross + $gross;

				//CTC
				$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($key->pf_earn));
				$pf_earn = $pf_earn + $key->pf_earn;

				$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($key->ESIC_earn));
				$ESIC_earn = $ESIC_earn + $key->ESIC_earn;

				$CI->excel->getActiveSheet()->setCellValue('S'.$j,round($key->pf_deduct));
				$pf_deduct=$pf_deduct+$key->pf_deduct;

				$CI->excel->getActiveSheet()->setCellValue('T'.$j,round($key->ESIC_deduct));
				$ESIC_deduct=$ESIC_deduct+$key->ESIC_deduct;

				$ctc = $gross+$key->pf_earn+$key->ESIC_earn;//+$key->pf_deduct+$key->ESIC_deduct;
				$CI->excel->getActiveSheet()->setCellValue('U'.$j,round($ctc));
				$total_ctc = $total_ctc + $ctc;
				
				//EARNING ALLOWANCE/NO OF DAYS
				$bsNet = 0;
				if(isset($key->net_pay) && $key->net_pay>0)
				{ 
					$bsNet = $key->net_pay + $key->pt_amt;
					$netBasicTotK = $bsNet;
				}
							

				if(isset($emp_allData) && !empty($emp_allData))
				{
					$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($key->basic_net));
					$basic_net = $basic_net + $key->basic_net;

					$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($key->hra));
					$HRA_total = $HRA_total + $key->hra;

					$CI->excel->getActiveSheet()->setCellValue('Y'.$j,round($key->convey));
					$Conveyance_total = $Conveyance_total + $key->convey;

					$total_mobile=0;
					$total_city=0;
					$total_medi=0;
					$total_edu=0;
					$total_entertainment=0;
					$total_bonus=0;
					$total_da=0;

					foreach ($emp_allData as $row)
					{
						if($row->earning_id == 18 )
						{
							//DA allowance
							$da = $key->special_allowance/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($value));
							$DA_total = $DA_total + $value;
							$total_da = $value;
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('Z'.$j,round($value));
							$mobile_total_all = $mobile_total_all + $value;
							$total_mobile = $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AA'.$j,round($value));
							$medical_total = $medical_total + $value;
							$total_medi = $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AB'.$j,round($value));
							$education_total = $education_total + $value;
							$total_edu = $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AC'.$j,round($value));
							$city_total = $city_total + $value;
							$total_city = $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AD'.$j,round($value));
							$entertainment_total = $entertainment_total + $value;
							$total_entertainment = $value;
							
						}elseif($row->earning_id == 15)
						{
							//Bonus
							$CI->excel->getActiveSheet()->setCellValue('AP'.$j,round($row->value));
							$Bonus_total = $Bonus_total + $row->value;
							$total_bonus=$row->value;
						}elseif($row->earning_id == 16)
						{
							$Advance_total = $Advance_total + $row->value;
							$per_emp_advance = $row->value;
						}else{
							$allowance_total_emp=0;
						}
					}
				}

				$earn_gross = $key->basic_net + $key->hra + $key->convey + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1;

				$CI->excel->getActiveSheet()->setCellValue('AE'.$j,round($earn_gross));
				$total_earn_gross = $total_earn_gross + $earn_gross; 
				
				//DEDUCATION
				$pfd_val = $key->pf_deduct/$num_days_of_month;
				$pf_dedct = $key->work_day*$pfd_val;
				$CI->excel->getActiveSheet()->setCellValue('AF'.$j,round($pf_dedct));
				$tot_pf_deduct=$tot_pf_deduct+$pf_dedct;

				$esicd_val = $key->ESIC_deduct/$num_days_of_month;
				$esic_dedct = $key->work_day*$esicd_val;
				$CI->excel->getActiveSheet()->setCellValue('AG'.$j,round($esic_dedct));
				$tot_ESIC_deduct=$tot_ESIC_deduct+$esic_dedct;

				if($key->pt_amt>0)
				{
					if($earn_gross<=7500)
					{
						$pt = 0;
					}elseif($earn_gross<=10000 && $earn_gross>=7500)
					{
						if($key->gender=='Female')
						{
							$pt=0;
						}else{
							$pt = 175;
						}
					}elseif($earn_gross>10000)
					{
						if($month=='February')
						{
							$pt = 300;
						}else{
							$pt = 200;
						}
					}
				}else{
					$pt = 0;
				}

				$CI->excel->getActiveSheet()->setCellValue('AH'.$j,round($pt));
				$pt_total = $pt_total + $pt;

				$CI->excel->getActiveSheet()->setCellValue('AI'.$j,round($key->mobile_deduction));
				$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;

				$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,round($key->other_deduct));
				$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

				$CI->excel->getActiveSheet()->setCellValue('AK'.$j, round($key->advance_opening));
				$CI->excel->getActiveSheet()->setCellValue('AL'.$j, round($key->advance_Addition));
				$CI->excel->getActiveSheet()->setCellValue('AM'.$j, round($key->advance_recovery));
				$CI->excel->getActiveSheet()->setCellValue('AN'.$j, round($key->advance_closing_amt));

				if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
				{
					$recy_total=0;
					$Advance_deduction=0;
					foreach ($emp_Ded_allData as $rec)
					{
						if ($rec->deduction_id == 6)
						{
							$CI->excel->getActiveSheet()->setCellValue('AM'.$j,round($rec->deduct_value));
							$recy_total = $rec->deduct_value;
							
							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
							$per_emp_advance = $per_emp_advance-$rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							
							if($per_emp_advance>0)
							{ }
							else
							{
								$per_emp_advance=0;
							}
							$CI->excel->getActiveSheet()->setCellValue('AN'.$j,$per_emp_advance);
						}
						elseif(($rec->deduction_id == 'Arrears/ others') || ($rec->deduction_id == 'Deduction Arrears'))
						{
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
						}else{
						
						}				
					}
				}
				
				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;

				$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
				$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($total_deduction));
				$total_deduct_mnth = $total_deduct_mnth + $total_deduction;

				//earning arrers
				$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,round($key->earn_arrears));
				$Arrears_total = $Arrears_total + $key->earn_arrears;

				//NET PAY
				$net_pay = ($earn_gross - $total_deduction) + ($total_bonus)*1 + $key->earn_arrears;
				$CI->excel->getActiveSheet()->setCellValue('AR'.$j,round($net_pay));
				$total_net_pay = $total_net_pay + $net_pay;

				$CI->excel->getActiveSheet()->getStyle('E'.$j.':AR'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('P'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('U'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AE'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AO'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AR'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AR'.$j)->getFont()->setBold(true);

				$j++;
				
			}

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->getFont()->setBold(true);
			$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':F'.$lastRowNum)
										->setCellValue('A'.$lastRowNum, 'Total');

			$CI->excel->getActiveSheet()->setCellValue('G'.$lastRowNum, round($emp_bac));
			$CI->excel->getActiveSheet()->setCellValue('H'.$lastRowNum, round($emp_da));
			$CI->excel->getActiveSheet()->setCellValue('I'.$lastRowNum, round($emp_hra));
			$CI->excel->getActiveSheet()->setCellValue('J'.$lastRowNum, round($emp_convy));
			$CI->excel->getActiveSheet()->setCellValue('K'.$lastRowNum, round($emp_mob));
			$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, round($emp_med));
			$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, round($emp_edu));
			$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, round($emp_city));
			$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, round($emp_enter));
			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($emp_gross));

			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($pf_earn));
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($ESIC_earn));
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, round($pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, round($ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, round($total_ctc));

			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($basic_net));
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($DA_total));
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($HRA_total));
			$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, round($Conveyance_total));
			$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, round($mobile_total_all));
			$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, round($medical_total));
			$CI->excel->getActiveSheet()->setCellValue('AB'.$lastRowNum, round($education_total));
			$CI->excel->getActiveSheet()->setCellValue('AC'.$lastRowNum, round($city_total));
			$CI->excel->getActiveSheet()->setCellValue('AD'.$lastRowNum, round($entertainment_total));
			$CI->excel->getActiveSheet()->setCellValue('AE'.$lastRowNum, round($total_earn_gross));

			$CI->excel->getActiveSheet()->setCellValue('AF'.$lastRowNum, round($tot_pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AG'.$lastRowNum, round($tot_ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AH'.$lastRowNum, round($pt_total));
			
			
			$CI->excel->getActiveSheet()->setCellValue('AI'.$lastRowNum, round($mobile_ded_total));
			$CI->excel->getActiveSheet()->setCellValue('AJ'.$lastRowNum, round($emp_wise_ded));
			$CI->excel->getActiveSheet()->setCellValue('AK'.$lastRowNum, round($adv_opening));
			$CI->excel->getActiveSheet()->setCellValue('AL'.$lastRowNum, round($adv_Addition));
			$CI->excel->getActiveSheet()->setCellValue('AM'.$lastRowNum, round($adv_recovery));
			$CI->excel->getActiveSheet()->setCellValue('AN'.$lastRowNum, round($adv_closing_amt));
			$CI->excel->getActiveSheet()->setCellValue('AO'.$lastRowNum, round($total_deduct_mnth));
			
			$CI->excel->getActiveSheet()->setCellValue('AP'.$lastRowNum, round($Bonus_total));			
			$CI->excel->getActiveSheet()->setCellValue('AQ'.$lastRowNum, round($Arrears_total));
			$CI->excel->getActiveSheet()->setCellValue('AR'.$lastRowNum, round($total_net_pay));

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

		}
		exit;
		/* end dynamic code here **************/
		
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

    // function salarySlipReportExcelFormat_new($emp_basic_data,$company_name,$num_days_of_month,$month,$year,$salMonth, $export, $showbonus =false)
    // {

    	
    // 	$CI =& get_instance(); 
    // 	/*date_default_timezone_set('Asia/kolkata');*/
    // 	$current_date = date('d/m/Y');
    // 	$CI->load->library('excel');

	// 	$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
	// 						 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
	// 						 	   ->setTitle("Pay Slip")
	// 						 	   ->setSubject("Pay Slip Of An Employee")
	// 						 	   ->setDescription("System Generated File.")
	// 						 	   ->setKeywords("office 2007")
	// 						 	   ->setCategory("Confidential");

	// 	$allborders = array(
	// 		'borders' => array(
	// 			'allborders' => array(
	// 				'style' => PHPExcel_Style_Border::BORDER_THIN,
					
	// 			),
	// 		),
	// 	);
	// 	//activate worksheet number 1
	// 	$CI->excel->setActiveSheetIndex(0);
	// 	//name the worksheet
	// 	$CI->excel->getActiveSheet()->setTitle('Salary Sheet - '.$month.' '.$year);
	// 	//set cell A1 content with some text
	// 	$CI->excel->getActiveSheet()->setCellValue('A1', $company_name); //$employee_basic_info->emp_comp_name
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	// 	//set row height
	// 	$CI->excel->getActiveSheet()->getRowDimension('1')
	// 								->setRowHeight(20);
	// 	/*  set default border for all stylesheet */
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getTop()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getBottom()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getLeft()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getRight()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	/*  End set default border for all stylesheet */

	// 	//merge cell A1 until D1
	// 	$CI->excel->getActiveSheet()->mergeCells('A1:BH1')
	// 								->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');
	// 	$CI->excel->getActiveSheet()->getStyle('A1:BH1')->applyFromArray($allborders);

	// 	$CI->excel->getActiveSheet()->getStyle('A2:BH2')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	// 	//set aligment to center for that merged cell (A1 to V1)
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	// 	//set cell A1 content with some text
	// 	$CI->excel->getActiveSheet()->setCellValue('A2', 'Salary Sheet for the Month of '.$month.' '.$year.''); //$employee_basic_info->emp_comp_name
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
	// 	//set row height
	// 	$CI->excel->getActiveSheet()->getRowDimension('2')
	// 								->setRowHeight(20);
	// 	/*  set default border for all stylesheet */
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getTop()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getBottom()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getLeft()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getRight()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	/*  End set default border for all stylesheet */

	// 	//merge cell A1 until D1
	// 	$CI->excel->getActiveSheet()->mergeCells('A2:BH2')
	// 								->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');


	// 	$CI->excel->getActiveSheet()->getStyle('A2:BH2')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	// 	//set aligment to center for that merged cell (A1 to V1)
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


	// 	$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.');
	// 	$CI->excel->getActiveSheet()->setCellValue('B3', 'Employee ID');
	// 	$CI->excel->getActiveSheet()->setCellValue('C3', 'Name of the Employee');	
	// 	$CI->excel->getActiveSheet()->setCellValue('D3', 'Location');		
	// 	$CI->excel->getActiveSheet()->setCellValue('E3', 'Working Days');
	// 	// paid leave
	// 	$CI->excel->getActiveSheet()->setCellValue('F3', 'Sanction Paid Leave');
	// 	$CI->excel->getActiveSheet()->setCellValue('G3', 'Total Utilsed Paid Leave');
	// 	$CI->excel->getActiveSheet()->setCellValue('H3', 'Balance Paid Leave');
	// 	$CI->excel->getActiveSheet()->setCellValue('I3', 'Paid Leave Utilsed In Month');
	// 	// sick leave
	// 	$CI->excel->getActiveSheet()->setCellValue('J3', 'Sanction Sick Leave');
	// 	$CI->excel->getActiveSheet()->setCellValue('K3', 'Total Utilsed Sick Leave');
	// 	$CI->excel->getActiveSheet()->setCellValue('L3', 'Balance Sick Leave');
	// 	$CI->excel->getActiveSheet()->setCellValue('M3', 'Sick Leave Utilsed In Month');

	// 	$CI->excel->getActiveSheet()->setCellValue('N3', 'Actual Present Days');
	// 	$CI->excel->getActiveSheet()->setCellValue('O3', 'Total Present Days');
	// 	// Earning Allowance
	// 	$CI->excel->getActiveSheet()->setCellValue('P3', 'Basic');
	// 	$CI->excel->getActiveSheet()->setCellValue('Q3', 'DA Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('R3', 'HRA');
	// 	$CI->excel->getActiveSheet()->setCellValue('S3', 'Conveyance');
	// 	$CI->excel->getActiveSheet()->setCellValue('T3', 'Mobile Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('U3', 'Medical Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('V3', 'Education Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('W3', 'City Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('X3', 'Entertianment Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('Y3', 'Other Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('Z3', 'Bonus'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('AA3', 'Total Gross'); 
	// 	// ctc
	// 	$CI->excel->getActiveSheet()->setCellValue('AB3', 'PF (Employers Contribution)'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('AC3', 'ESIC (Employers Contribution)');
	// 	$CI->excel->getActiveSheet()->setCellValue('AD3', 'PF (Employees Contribution)');
	// 	$CI->excel->getActiveSheet()->setCellValue('AE3', 'ESIC (Employees Contribution)');
	// 	$CI->excel->getActiveSheet()->setCellValue('AF3', 'CTC');
	// 	// salary on number of days
	// 	$CI->excel->getActiveSheet()->setCellValue('AG3', 'Earn Basic');
	// 	$CI->excel->getActiveSheet()->setCellValue('AH3', 'Earn DA');
	// 	$CI->excel->getActiveSheet()->setCellValue('AI3', 'Earn HRA');
	// 	$CI->excel->getActiveSheet()->setCellValue('AJ3', 'Earn Conveyance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AK3', 'Earn Mobile Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AL3', 'Earn Medical Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AM3', 'Earn Education Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AN3', 'Earn City Allowance');  
	// 	$CI->excel->getActiveSheet()->setCellValue('AO3', 'Earn Entertianment Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AP3', 'Earn Other Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Earn Bonus');
	// 	$CI->excel->getActiveSheet()->setCellValue('AR3', 'Total Earn Gross');
	// 	$CI->excel->getActiveSheet()->setCellValue('AS3', 'Earn Gross For ESIC');
	// 	$CI->excel->getActiveSheet()->setCellValue('AT3', 'Employees PF Deduction');
	// 	$CI->excel->getActiveSheet()->setCellValue('AU3', 'Employees ESIC  Deduction ');
	// 	$CI->excel->getActiveSheet()->setCellValue('AV3', 'Professional Tax');
	// 	// if Deducation
	// 	$CI->excel->getActiveSheet()->setCellValue('AW3', 'Telephone (Co.)');
	// 	$CI->excel->getActiveSheet()->setCellValue('AX3', 'Others Deduction');
	// 	$CI->excel->getActiveSheet()->setCellValue('AY3', 'Advance Opening'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('AZ3', 'Advance Addition'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('BA3', 'Advance Recovery'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('BB3', 'Advance Closing');
	// 	$CI->excel->getActiveSheet()->setCellValue('BC3', 'Total Deduction for the month');
	// 	/*$CI->excel->getActiveSheet()->setCellValue('AU3', 'Bonus');
	// 	$CI->excel->getActiveSheet()->setCellValue('AV3', 'Arrears');*/
	// 	//Total Salary 
	// 	$CI->excel->getActiveSheet()->setCellValue('BD3', 'Net Pay');
	// 	$CI->excel->getActiveSheet()->setCellValue('BE3', 'WFH Days');
	// 	$CI->excel->getActiveSheet()->setCellValue('BF3', 'WFH Deduction %');
	// 	$CI->excel->getActiveSheet()->setCellValue('BG3', 'WFH Deduction Amount');
	// 	$CI->excel->getActiveSheet()->setCellValue('BH3', 'Net Pay After WFH');

	// 	if($showbonus){
	// 	$CI->excel->getActiveSheet()->setCellValue('BI3', 'Variable %');
	// 	$CI->excel->getActiveSheet()->setCellValue('BJ3', 'Variable Bonus Amount');
	// 	}
	// 	//Star rate
	// 	// $CI->excel->getActiveSheet()->setCellValue('AX3', 'Red Star');
	// 	// $CI->excel->getActiveSheet()->setCellValue('AY3', 'Gold Star');
	// 	// $CI->excel->getActiveSheet()->setCellValue('AZ3', 'Balance Red Star');
	// 	// $CI->excel->getActiveSheet()->setCellValue('BA3', 'Balance Gold Star');
	// 	// $CI->excel->getActiveSheet()->setCellValue('BB3', 'Star deducation');
	// 	/*$CI->excel->getActiveSheet()->setCellValue('BC3', 'Black Star');
	// 	$CI->excel->getActiveSheet()->setCellValue('BD3', 'Balance Black Star');*/
	// 	//$CI->excel->getActiveSheet()->setCellValue('BC3', 'Balance Gold Star');
	// 	/*$CI->excel->getActiveSheet()->setCellValue('BD3', 'Black Star deducation');*/
	// 	//$CI->excel->getActiveSheet()->setCellValue('BD3', 'Salary after star deducation');


	// 	$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
	// 	$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);
	// 	$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(50);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(0);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(25);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(40);							
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);		
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(10);		
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(43)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(44)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(45)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(46)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(47)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(48)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(49)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(50)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(51)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(52)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(53)->setWidth(10);

	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(54)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(55)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(56)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(57)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(58)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(59)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(60)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(61)->setWidth(10);
	// 	// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(51)->setWidth(10);
	// 	// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(52)->setWidth(12);
	// 	// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(53)->setWidth(15);
	// 	// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(54)->setWidth(15);
	// 	// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(55)->setWidth(15);
	// 	// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(56)->setWidth(15);
	// 	// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(57)->setWidth(15);
	// 	/************ Wrap A2 V3 content */  

	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->setSize(10);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A2:BH3')->getFont()->setBold(true);															
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BH3')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FF428bca');
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BH3')->applyFromArray($allborders);
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);
	// 	/* start dynamic code from here *********/
	// 	$lastRowNum=4;
 	// 	if (isset($emp_basic_data) && !empty($emp_basic_data))
 	// 	{
	//  		$j=4;
	//  		$lastRowNum= $lastRowNum + count($emp_basic_data);
	//  		// define total vcariable for per coloumn 
	//  		$net_basic_total=0;
	//  		$net_basic_totalE=0;
	//  		$salBefoPt_total=0;
	//  		$pt_total=0;
	//  		$net_with_pt_total=0;
	//  		$total_deduction=0;
	//  		$Conveyance_total=0;
	//  		$mobile_total=0;
	//  		$HRA_total = 0;
	//  		$DA_total = 0;
	//  		$otherAllow_total=0;
	//  		$Arrears_total=0;
	//  		$allowance_total_emp = 0;
	//  		$allowance_ded_total_emp = 0;
	// 		$mobile_ded_total = 0;
	// 		$ArrOther_ded_total = 0;
	// 		$Bonus_total = 0;
	// 		$Advance_total = 0;
	// 		$per_emp_advance=0;
	// 		$deduct_adv_total=0;
	// 		$Advance_deduction=0;
	// 		$medical_total=0;
	// 		$city_total=0;
	// 		$education_total=0;
	// 		$adv_opening = 0;
	// 		$adv_Addition = 0;
	// 		$adv_recovery = 0;
	// 		$adv_closing_amt = 0;

	// 		$mobile_total_all=0;
	// 		$otherAllow_total_all=0;
	// 		$recy_ttl = 0;
	// 		$entertainment_total = 0;
	// 		$pf_earn = 0;
	// 		$ESIC_earn = 0;
	// 		$pf_deduct = 0;
	// 		$ESIC_deduct = 0;
	// 		$tot_pf_deduct=0;
	// 		$tot_ESIC_deduct=0;
	// 		$pay_during_month = 0;
	// 		$pay_beforePt=0;
	// 		$final_net_pay=0;
	// 		$basic_net=0;
	// 		$total_ctc=0;
	// 		$total_gross=0;
	// 		$total_earn_gross=0;
	// 		$total_earn_gross1=0;
	// 		$total_net_salary=0;
	// 		$total_deduct_mnth=0;
	// 		$total_net_pay=0;
	// 		//$Bonus_total=0;
	// 		//emp info
	// 		$emp_bac = 0;
	// 		$emp_da = 0;
	// 		$emp_hra = 0;
	// 		$emp_earn_hra=0;
	// 		$emp_convy = 0;
	// 		$emp_mob = 0;
	// 		$emp_med = 0;
	// 		$emp_edu = 0;
	// 		$emp_city = 0;
	// 		$emp_enter = 0;
	// 		$emp_gross = 0;
	// 		$emp_bonus = 0;
	// 		$emp_tot_alw = 0;
	//  		$sr=1;
	//  		$total_star_deduct=0;
	// 		$total_star_pay=0;
	// 		$actual_present_day=0;
	//  		foreach ($emp_basic_data as $key)
	//  		{
	//  			$netBasicTotK = 0;
	//  			$emp_wise_ded=0;
	//  			$boun_emp = 0;
	//  			$emp_wise_add_deduction = 0;
	//  		 	//echo $key->empl_id; echo '<br>';
	// 			$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
	// 			// print_r($emp_allData); 
	// 			// echo $CI->db->last_query();
	// 			$emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
	// 			$earn_allowance = $CI->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->empl_id);
	// 			$emp_basic = $CI->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->empl_id);
	// 			$emp_leave_data = $CI->Slip_vish_model->fetch_emp_leave_data($key->user_id,$month,$year);
    //            /* echo $CI->db->last_query();exit();	 */   
	// 			$emp_paid_leave = $CI->Slip_vish_model->fetch_paid_leave($key->user_id,$month,$year);
              

	// 			$emp_creditleave_data = $CI->Slip_vish_model->fetch_emp_credit_leave_data($key->user_id,$year);
				
	// 			$emp_creditleave = (isset($emp_creditleave_data->no_leave_credit) && !empty($emp_creditleave_data->no_leave_credit))?$emp_creditleave_data->no_leave_credit:'0';

	// 			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
	// 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->username);
	// 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->emp_name);
	// 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->dept);
	// 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,$num_days_of_month);

	// 			$monthsdiff = $CI->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
	// 			$bal_leave_cnt=0;
	// 			if($monthsdiff->months>=6)
	// 			{
	// 				$saction = $emp_creditleave;
	// 			}else if(isset($emp_creditleave_data->no_leave_credit) && $emp_creditleave_data->no_leave_credit<0 && $monthsdiff->months<6){
	// 				$bal_leave_cnt = $emp_creditleave_data->no_leave_credit;
	// 				$saction=0;
	// 			}else{
	// 				$saction = 0;
	// 			}
	// 			//echo (isset($bal_leave_cnt)?$bal_leave_cnt:$saction); echo '<br>';
	// 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,$saction); //$emp_leave_data->total_leave
	// 			/*if($emp_leave_data->bal_leave!=$emp_creditleave && !empty($emp_leave_data->bal_leave))
	// 			{
	// 				$earn_leave = $emp_creditleave-$emp_leave_data->bal_leave;
	// 			}else{
	// 				$earn_leave = 0;
	// 			}*/
	// 			/*$earn_leave=$emp_leave_data->earn_leave;*/
	// 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,(isset($emp_leave_data->earn_leave) && !empty($emp_leave_data->earn_leave))?$emp_leave_data->earn_leave:0); //$emp_leave_data->earn_leave
	// 			$CI->excel->getActiveSheet()->setCellValue('H'.$j,(isset($emp_leave_data->bal_leave) && !empty($emp_leave_data->bal_leave) && $saction!=0)?$emp_leave_data->bal_leave:$saction);
	// 			/*$CI->excel->getActiveSheet()->setCellValue('H'.$j,$emp_leave_data->bal_leave);*/
	// 			/*$CI->excel->getActiveSheet()->setCellValue('I'.$j,$emp_paid_leave->paid_leave);*/
    //           	$CI->excel->getActiveSheet()->setCellValue('I'.$j,(isset($emp_leave_data->earn_leave1) && !empty($emp_leave_data->earn_leave1))?$emp_leave_data->earn_leave1:0); 
              	
    //           	// sick leave
    //           	$emp_sick_leave_data = $CI->Slip_vish_model->fetch_emp_sick_leave_data($key->user_id,$year);
				
	// 			$emp_sick_leave = (isset($emp_sick_leave_data->sick_leave_creadit) && !empty($emp_sick_leave_data->sick_leave_creadit))?$emp_sick_leave_data->sick_leave_creadit:'0';

	// 			$monthsdiff = $CI->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
	// 			$bal_leave_cnt=0;
	// 			if($monthsdiff->months>=6)
	// 			{
	// 				$saction_sick = $emp_sick_leave;
	// 			}else if(isset($emp_sick_leave_data->sick_leave_creadit) && $emp_sick_leave_data->sick_leave_creadit<0 && $monthsdiff->months<6){
	// 				$bal_leave_cnt = $emp_sick_leave_data->sick_leave_creadit;
	// 				$saction_sick=0;
	// 			}else{
	// 				$saction_sick=0;
	// 			}

    //           	$CI->excel->getActiveSheet()->setCellValue('J'.$j,$saction_sick);

    //           	$emp_sick_leave_data = $CI->Slip_vish_model->fetch_emp_sick_leave_data1($key->user_id,$month,$year);
              	
    //           	$CI->excel->getActiveSheet()->setCellValue('K'.$j,(isset($emp_sick_leave_data->earn_leave) && !empty($emp_sick_leave_data->earn_leave))?$emp_sick_leave_data->earn_leave:0);
    //           	$CI->excel->getActiveSheet()->setCellValue('L'.$j,(isset($emp_sick_leave_data->bal_leave) && !empty($emp_sick_leave_data->bal_leave) && $saction!=0)?$emp_sick_leave_data->bal_leave:$saction_sick-$emp_sick_leave_data->earn_leave);
    //           	$CI->excel->getActiveSheet()->setCellValue('M'.$j,(isset($emp_sick_leave_data->earn_leave1) && !empty($emp_sick_leave_data->earn_leave1))?$emp_sick_leave_data->earn_leave1:0);

    //           	// total leave
    //           	$actual_present_day=($key->work_day)-($emp_leave_data->earn_leave1)-($emp_sick_leave_data->earn_leave1);
    //           	$total_present_day=$actual_present_day+($emp_leave_data->earn_leave1)+($emp_sick_leave_data->earn_leave1);
	// 			$CI->excel->getActiveSheet()->setCellValue('N'.$j,$actual_present_day);
	// 			$CI->excel->getActiveSheet()->setCellValue('O'.$j,$total_present_day);
				
	// 			$basic = $key->basic_amt;//$emp_basic->emp_basic;
	// 			$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($key->basic_amt));
	// 			$emp_bac = $emp_bac + $basic;

	// 			$da = 0;
	// 			$hra = 0;
	// 			$conveyance = 0;
	// 			$mobile = 0;
	// 			$medical = 0;
	// 			$education = 0;
	// 			$city = 0;
	// 			$entertainment = 0;
	// 			$bonus = 0;
	// 			$total_allowance=0;

	// 			//EARNING ALLOWANCE				
	// 			if(isset($earn_allowance) && !empty($earn_allowance))
	// 			{
	// 				foreach ($earn_allowance as $earn)
	// 				{
	// 					if($earn->earning_id == 18 )
	// 					{
	// 						//DA allowance
	// 						$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($earn->earn_value));
	// 						$emp_da = $emp_da + $earn->earn_value; 
	// 						$da = $earn->earn_value;
							
	// 					}elseif($earn->earning_id == 7)
	// 					{
	// 						//HRA
	// 						$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($earn->earn_value));
	// 						$emp_hra = $emp_hra + $earn->earn_value;
	// 						$hra = $earn->earn_value;
							
	// 					}elseif($earn->earning_id == 3)
	// 					{
	// 						//Conveyance
	// 						$CI->excel->getActiveSheet()->setCellValue('S'.$j,round($earn->earn_value));
	// 						$emp_convy = $emp_convy + $earn->earn_value;
	// 						$conveyance = $earn->earn_value;
							
	// 					}elseif ($earn->earning_id == 6 ) 
	// 					{
	// 						// mobile allowance
	// 						$CI->excel->getActiveSheet()->setCellValue('T'.$j,round($earn->earn_value));
	// 						$emp_mob = $emp_mob + $earn->earn_value;
	// 						$mobile = $earn->earn_value;
							
	// 					}elseif($earn->earning_id == 13)
	// 					{
	// 						//medical allowance
	// 						$CI->excel->getActiveSheet()->setCellValue('U'.$j,round($earn->earn_value));
	// 						$emp_med = $emp_med + $earn->earn_value;
	// 						$medical = $earn->earn_value;
							
	// 					}elseif($earn->earning_id == 20)
	// 					{
	// 						//education allowance
	// 						$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($earn->earn_value));
	// 						$emp_edu = $emp_edu + $earn->earn_value;
	// 						$education = $earn->earn_value;
							
	// 					}elseif($earn->earning_id == 14 )
	// 					{				
	// 						// City allowance
	// 						$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($earn->earn_value));
	// 						$emp_city = $emp_city + $earn->earn_value;
	// 						$city = $earn->earn_value;
							
	// 					}elseif($earn->earning_id == 22)
	// 					{
	// 						//entertainment allowance
	// 						$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($earn->earn_value));
	// 						$emp_enter = $emp_enter + $earn->earn_value;
	// 						$entertainment = $earn->earn_value;
							
	// 					}
	// 					elseif($earn->earning_id == 9)
	// 					{
	// 						//entertainment allowance
	// 						$CI->excel->getActiveSheet()->setCellValue('Y'.$j,round($earn->earn_value));
	// 						$emp_tot_alw = $emp_tot_alw + $earn->earn_value;
	// 						$total_allowance = $earn->earn_value;						
							
	// 					}
	// 					elseif($earn->earning_id == 15)
	// 					{
	// 						//entertainment allowance
	// 						$CI->excel->getActiveSheet()->setCellValue('Z'.$j,round($earn->earn_value));
	// 						$emp_bonus = $emp_bonus + $earn->earn_value;
	// 						$bonus = $earn->earn_value;						
							
	// 					}
	// 				}
	// 			}
				
	// 			$gross = $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 + ($bonus)*1 +($total_allowance)*1;

	// 			$gross1 = $basic + ($da)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 +($total_allowance)*1;

	// 			$CI->excel->getActiveSheet()->setCellValue('AA'.$j,round($gross));
	// 			$emp_gross = $emp_gross + $gross;

	// 			//CTC
	// 			$CI->excel->getActiveSheet()->setCellValue('AB'.$j,round($key->pf_earn));
	// 			$pf_earn = $pf_earn + $key->pf_earn;

	// 			$CI->excel->getActiveSheet()->setCellValue('AC'.$j,round($key->ESIC_earn));
	// 			$ESIC_earn = $ESIC_earn + $key->ESIC_earn;

	// 			$CI->excel->getActiveSheet()->setCellValue('AD'.$j,round($key->pf_deduct));
	// 			$pf_deduct=$pf_deduct+$key->pf_deduct;

	// 			$CI->excel->getActiveSheet()->setCellValue('AE'.$j,round($key->ESIC_deduct));
	// 			$ESIC_deduct=$ESIC_deduct+$key->ESIC_deduct;

	// 			$ctc = $gross+$key->pf_earn+$key->ESIC_earn;//+$key->pf_deduct+$key->ESIC_deduct;
	// 			$CI->excel->getActiveSheet()->setCellValue('AF'.$j,round($ctc));
	// 			$total_ctc = $total_ctc + $ctc;
				
	// 			//EARNING ALLOWANCE/NO OF DAYS
	// 			$bsNet = 0;
	// 			if(isset($key->net_pay) && $key->net_pay>0)
	// 			{ 
	// 				$bsNet = $key->net_pay + $key->pt_amt;
	// 				$netBasicTotK = $bsNet;
	// 			}

	// 			$basic = $key->basic_net/$num_days_of_month;					
	// 			$emp_basic = $key->work_day*$basic; 
	// 			$CI->excel->getActiveSheet()->setCellValue('AG'.$j,round($emp_basic));
	// 			$basic_net = $basic_net + $emp_basic;

	// 			$hra = $key->hra/$num_days_of_month;
	// 			$emp_earn_hra = $key->work_day*$hra;

	// 			$CI->excel->getActiveSheet()->setCellValue('AI'.$j,round($emp_earn_hra));
	// 			$HRA_total = $HRA_total + $emp_earn_hra;

	// 			$convey = $key->convey/$num_days_of_month;
	// 			$emp_convey = $key->work_day*$convey;

	// 			$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,round($emp_convey));
	// 			$Conveyance_total = $Conveyance_total + $emp_convey;

	// 			$total_mobile=0;
	// 			$total_city=0;
	// 			$total_medi=0;
	// 			$total_edu=0;
	// 			$total_entertainment=0;
	// 			$otherAllow_total = 0;
	// 			$total_bonus=0;
	// 			$total_da=0;
							
	// 			if(isset($emp_allData) && !empty($emp_allData))
	// 			{

	// 				foreach ($emp_allData as $row)
	// 				{
	// 					if($row->earning_id == 18 )
	// 					{
	// 						//DA allowance
	// 						$da = $key->special_allowance/$num_days_of_month;
	// 						$value = $key->work_day*$da;
	// 						$CI->excel->getActiveSheet()->setCellValue('AH'.$j,round($value));
	// 						$DA_total = $DA_total + $value;
	// 						$total_da = $value;
							
	// 					}elseif ($row->earning_id == 6 ) 
	// 					{
	// 						// mobile allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$CI->excel->getActiveSheet()->setCellValue('AK'.$j,round($value));
	// 						$mobile_total_all = $mobile_total_all + $value;
	// 						$total_mobile = $value;
							
	// 					}elseif($row->earning_id == 13)
	// 					{
	// 						//medical allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$CI->excel->getActiveSheet()->setCellValue('AL'.$j,round($value));
	// 						$medical_total = $medical_total + $value;
	// 						$total_medi = $value;
							
	// 					}elseif($row->earning_id == 20)
	// 					{
	// 						//education allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$CI->excel->getActiveSheet()->setCellValue('AM'.$j,round($value));
	// 						$education_total = $education_total + $value;
	// 						$total_edu = $value;
							
	// 					}elseif($row->earning_id == 14 )
	// 					{				
	// 						// City allowance 
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$CI->excel->getActiveSheet()->setCellValue('AN'.$j,round($value));
	// 						$city_total = $city_total + $value;
	// 						$total_city = $value;
							
	// 					}elseif($row->earning_id == 22)
	// 					{
	// 						//entertainment allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($value));
	// 						$entertainment_total = $entertainment_total + $value;
	// 						$total_entertainment = $value;
							
	// 					}elseif($row->earning_id == 9)
	// 					{
	// 						//entertainment allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$CI->excel->getActiveSheet()->setCellValue('AP'.$j,round($value));
	// 						$otherAllow_total_all = $otherAllow_total_all + $value;
	// 						$otherAllow_total = $value;
							
	// 					}
	// 					elseif($row->earning_id == 15)
	// 					{
	// 						//Bonus
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,round($value));
	// 						$Bonus_total = $Bonus_total + $value;
	// 						$total_bonus=$value;
	// 					}elseif($row->earning_id == 16)
	// 					{
	// 						$Advance_total = $Advance_total + $row->value;
	// 						$per_emp_advance = $row->value;
	// 					}else{
	// 						$allowance_total_emp=0;
	// 					}
	// 				}
	// 			}

	// 			$earn_gross = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($total_bonus)*1 + ($otherAllow_total)*1;

	// 			$CI->excel->getActiveSheet()->setCellValue('AR'.$j,round($earn_gross));
	// 			$total_earn_gross = $total_earn_gross + $earn_gross; 
				
	// 			$earn_gross1 = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1;

	// 			$CI->excel->getActiveSheet()->setCellValue('AS'.$j,round($earn_gross1));
	// 			$total_earn_gross1 = $total_earn_gross1 + $earn_gross1; 

	// 			$earn_gross_pf = ($emp_basic)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1;

	// 			//DEDUCATION
	// 			/*$pf_dedct1 = $key->pf_deduct;
	// 			$pfd_val = $key->pf_deduct/$num_days_of_month;
	// 			if(isset($key->pf_deduct) && !empty($key->pf_deduct)){

	// 				//$pf_dedct =  $key->work_day*$pfd_val;
	// 				if($pf_dedct1 >=1800)
	// 				{
	// 					$pf_dedct =  $key->work_day*$pfd_val;
	// 				}else
	// 				{
	// 					$pf_dedct = round(($emp_basic + $emp_convey + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1)*0.12);
	// 					//$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12);
	// 				}
	// 				//$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12); //$key->work_day*$pfd_val;
	// 				 //round(($emp_basic + ($total_da)*1)*0.12);
	// 			}else{
	// 				$pf_dedct = 0;
	// 			}*/
	// 			$pf_dedct1 = $key->pf_deduct;
	// 			$pfd_val = $key->pf_deduct/$num_days_of_month;
	// 			if(isset($key->pf_deduct) && !empty($key->pf_deduct)){

	// 				//$pf_dedct =  $key->work_day*$pfd_val;
	// 				// if($pf_dedct1 >=1500)
	// 				// {
	// 				// 	$pf_dedct =  $key->work_day*$pfd_val;
	// 				// }else
	// 				// {
	// 				//$pf_dedct = $key->pf_deduct;
	// 				if ($earn_gross_pf >= 15000) {
	// 					$pf_dedct = 1800;
	// 				} else {
	// 					$pf_dedct = round($earn_gross_pf*0.12);
	// 				}						
	// 					//$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12);
	// 				// }
	// 				//$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12); //$key->work_day*$pfd_val;
	// 				 //round(($emp_basic + ($total_da)*1)*0.12);
	// 			}else{
	// 				$pf_dedct = 0;
	// 			}
	// 			$CI->excel->getActiveSheet()->setCellValue('AT'.$j,round($pf_dedct));
	// 			$tot_pf_deduct=$tot_pf_deduct+$pf_dedct;

	// 			$esicd_val = $key->ESIC_deduct/$num_days_of_month;
	// 			// $esic_dedct = $key->work_day*$esicd_val;
	// 			if (isset($key->ESIC_deduct) && !empty($key->ESIC_deduct)) {
	// 				if ($gross1 <= 21000) {
	// 					$esic_dedct = $earn_gross1*0.0075;
	// 				} else {
	// 					$esic_dedct = 0;
	// 				}	
	// 			} else {
	// 				$esic_dedct = 0;
	// 			}
						
	// 			$CI->excel->getActiveSheet()->setCellValue('AU'.$j,round($esic_dedct));
	// 			$tot_ESIC_deduct=$tot_ESIC_deduct+$esic_dedct;
	// 			$month_year_array1 = explode('-', $month);
	// 			$nmonth1 = date('F',strtotime("01-".$month_year_array1[0]."-".date("Y")));
	// 			if($key->pt_amt>0)
	// 			{
	// 				if($earn_gross<7500)
	// 				{
	// 					$pt = 0;
	// 				}elseif($earn_gross<=10000 && $earn_gross>=7500)
	// 				{
	// 					if($key->gender=='Female')
	// 					{
	// 						$pt=0;
	// 					}else{
	// 						$pt = 175;
	// 					}
	// 				}elseif($earn_gross>10000)
	// 				{
	// 					if($nmonth1=='February')
	// 					{
	// 						$pt = 300;
	// 					}else{
	// 						$pt = 200;
	// 					}
	// 				}
	// 			}else{
	// 				$pt = 0;
	// 			}

	// 			$CI->excel->getActiveSheet()->setCellValue('AV'.$j,(isset($pt) && !empty($pt))?$pt:0);
	// 			$pt_total = $pt_total + $pt;

	// 			$CI->excel->getActiveSheet()->setCellValue('AW'.$j,round($key->mobile_deduction));
	// 			$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;

	// 			$CI->excel->getActiveSheet()->setCellValue('AX'.$j,round($key->other_deduct));
	// 			$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

	// 			$CI->excel->getActiveSheet()->setCellValue('AY'.$j, round($key->advance_opening));
	// 			$CI->excel->getActiveSheet()->setCellValue('AZ'.$j, round($key->advance_Addition));
	// 			$CI->excel->getActiveSheet()->setCellValue('BA'.$j, round($key->advance_recovery));
	// 			$CI->excel->getActiveSheet()->setCellValue('BB'.$j, round($key->advance_closing_amt));

	// 			if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
	// 			{
	// 				$recy_total=0;
	// 				$Advance_deduction=0;
	// 				foreach ($emp_Ded_allData as $rec)
	// 				{
	// 					if ($rec->deduction_id == 6)
	// 					{
	// 						$CI->excel->getActiveSheet()->setCellValue('AY'.$j,round($rec->deduct_value));
	// 						$recy_total = $rec->deduct_value;
							
	// 						$Advance_deduction = $Advance_deduction + $rec->deduct_value;
	// 						$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
	// 						$per_emp_advance = $per_emp_advance-$rec->deduct_value;
	// 						$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							
	// 						if($per_emp_advance>0)
	// 						{ }
	// 						else
	// 						{
	// 							$per_emp_advance=0;
	// 						}
	// 						$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,$per_emp_advance);
	// 					}
	// 					elseif(($rec->deduction_id == 'Arrears/ others') || ($rec->deduction_id == 'Deduction Arrears'))
	// 					{
	// 						$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
	// 					}else{
						
	// 					}				
	// 				}
	// 			}
				
	// 			$adv_opening = $adv_opening + $key->advance_opening;
	// 			$adv_Addition = $adv_Addition + $key->advance_Addition;
	// 			$adv_recovery = $adv_recovery + $key->advance_recovery;
	// 			$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;

	// 			$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
	// 			$CI->excel->getActiveSheet()->setCellValue('BC'.$j,round($total_deduction));
	// 			$total_deduct_mnth = $total_deduct_mnth + $total_deduction;

	// 			/*//earning arrers
	// 			$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($key->earn_arrears));
	// 			$Arrears_total = $Arrears_total + $key->earn_arrears;
	// 			*/
	// 			//NET PAY
	// 			$net_pay = ($earn_gross - $total_deduction) + $key->earn_arrears;
	// 			$CI->excel->getActiveSheet()->setCellValue('BD'.$j,round($net_pay));
	// 			$CI->excel->getActiveSheet()->setCellValue('BE'.$j,round($key->wfh_day));
	// 			$CI->excel->getActiveSheet()->setCellValue('BF'.$j,round($key->wfh_deduct_per));
				
	// 			$wfo_days = $total_present_day - $key->wfh_day;
	// 			$per_day_amt = $net_pay/$total_present_day;
	// 			$wfo_amt = $per_day_amt*$wfo_days;
	// 			$wfh_amt = $per_day_amt*$key->wfh_day;
	// 			$wfh_deduct_amt = $wfh_amt*$key->wfh_deduct_per/100;
	// 			$CI->excel->getActiveSheet()->setCellValue('BG'.$j,round($wfh_deduct_amt));
	// 			$CI->excel->getActiveSheet()->setCellValue('BH'.$j,round($net_pay) - round($wfh_deduct_amt));

	// 			if($showbonus){
	// 				$CI->excel->getActiveSheet()->setCellValue('BI'.$j,round($key->var_per));
	// 				$CI->excel->getActiveSheet()->setCellValue('BJ'.$j,round($key->var_amount));
	// 			}
	// 			$total_net_pay = $total_net_pay + round($net_pay);

	// 			/*$emp_star = $CI->Slip_vish_model->fetch_emp_star_rate($key->user_id,$key->salary_month);
	// 			$CI->excel->getActiveSheet()->setCellValue('AX'.$j,(isset($emp_star->red_star) && !empty($emp_star->red_star))?$emp_star->red_star:'0');
	// 			$CI->excel->getActiveSheet()->setCellValue('AY'.$j,(isset($emp_star->gold_star) && !empty($emp_star->gold_star))?$emp_star->gold_star:'0');
	// 			if(isset($emp_star->red_star) && $emp_star->red_star>='10')
	// 			{
	// 				$red = ($emp_star->red_star > $emp_star->gold_star)?($emp_star->red_star-$emp_star->gold_star):'0';
	// 				$gold = ($emp_star->red_star < $emp_star->gold_star)?($emp_star->gold_star-$emp_star->red_star):'0';
	// 			}else{
	// 				$red = (isset($emp_star->red_star) && !empty($emp_star->red_star))?$emp_star->red_star:'0';
	// 				$gold = (isset($emp_star->gold_star) && !empty($emp_star->gold_star))?$emp_star->gold_star:'0';
	// 			}
	// 			$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,$red);
	// 			$CI->excel->getActiveSheet()->setCellValue('BA'.$j,$gold);
	// 			if($monthsdiff->months>=6)
	// 			{
	// 				if($red>='10')
	// 				{
	// 					$per_day = $gross/$num_days_of_month;
	// 					$perval = 1*$per_day;
	// 					$total_salary = round($perval);
	// 				}else{
	// 					$total_salary = 0;
	// 				}
	// 			}else{
	// 				$total_salary = 0;
	// 			}
	// 			$CI->excel->getActiveSheet()->setCellValue('BB'.$j,$total_salary);
	// 			$total_star_deduct = $total_star_deduct+$total_salary;*/

	// 			/*$CI->excel->getActiveSheet()->setCellValue('BC'.$j,(isset($emp_star->black_star) && !empty($emp_star->black_star))?$emp_star->black_star:'0');
	// 			if(isset($emp_star->black_star) && $emp_star->black_star>='10')
	// 			{
	// 				$blackstar = ($gold > $emp_star->black_star)?($gold-$emp_star->black_star):'0';
	// 				$blackstar = ($emp_star->black_star > $gold)?($emp_star->black_star-$gold):'0';
	// 				$bal_gold = ($gold > $emp_star->black_star)?($gold-$emp_star->black_star):'0';
	// 				$bal_black = ($emp_star->black_star > $gold)?($emp_star->black_star-$gold):'0';
	// 			}else{
	// 				$blackstar = 0;
	// 				$bal_gold = $gold;
	// 				$bal_black = (isset($emp_star->black_star) && !empty($emp_star->black_star))?$emp_star->black_star:'0';
	// 			}
				
	// 			if($blackstar>='20')
	// 			{
	// 				$per_day = $gross/$num_days_of_month;
	// 				$perval = 1*$per_day;
	// 				$total_salary1 = round($perval);
	// 			}else{
	// 				$total_salary1 = 0;
	// 			}
	// 			$CI->excel->getActiveSheet()->setCellValue('BD'.$j,$bal_black);*/
	// 			/*$CI->excel->getActiveSheet()->setCellValue('BC'.$j,$gold);*/
	// 			/*$CI->excel->getActiveSheet()->setCellValue('BD'.$j,$total_salary1);*/

	// 			/*$CI->excel->getActiveSheet()->setCellValue('BD'.$j,round($net_pay-$total_salary));
	// 			$total_star_pay = $total_star_pay+round($net_pay-$total_salary);*/

	// 			$CI->excel->getActiveSheet()->getStyle('E'.$j.':BH'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);

	// 			$CI->excel->getActiveSheet()->getStyle('A'.$j.':B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);

	// 			$CI->excel->getActiveSheet()->getStyle('AA'.$j)
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');

	// 			$CI->excel->getActiveSheet()->getStyle('AF'.$j)
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');

	// 			$CI->excel->getActiveSheet()->getStyle('AR'.$j)
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');

	// 			$CI->excel->getActiveSheet()->getStyle('BD'.$j)
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');

	// 			$CI->excel->getActiveSheet()->getStyle('BH'.$j)
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');

	// 			/*$CI->excel->getActiveSheet()->getStyle('AV'.$j)
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');*/

	// 			/*$CI->excel->getActiveSheet()->getStyle('BD'.$j)
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');*/

	// 			$CI->excel->getActiveSheet()->getStyle('BD'.$j)->getFont()->setBold(true);
	// 			//$CI->excel->getActiveSheet()->getStyle('BD'.$j)->getFont()->setBold(true);
	// 			$j++;
				
	// 		}//exit();

	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)->getFont()->setBold(true);
	// 		$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':O'.$lastRowNum)
	// 									->setCellValue('A'.$lastRowNum, 'Total');

	// 		$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($emp_bac));
	// 		$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($emp_da));
	// 		$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($emp_hra));
	// 		$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, round($emp_convy));
	// 		$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, round($emp_mob));
	// 		$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, round($emp_med));
	// 		$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($emp_edu));
	// 		$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($emp_city));
	// 		$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($emp_enter));
	// 		$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, round($emp_tot_alw));
	// 		$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, round($emp_bonus));
	// 		$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, round($emp_gross));

	// 		$CI->excel->getActiveSheet()->setCellValue('AB'.$lastRowNum, round($pf_earn));
	// 		$CI->excel->getActiveSheet()->setCellValue('AC'.$lastRowNum, round($ESIC_earn));
	// 		$CI->excel->getActiveSheet()->setCellValue('AD'.$lastRowNum, round($pf_deduct));
	// 		$CI->excel->getActiveSheet()->setCellValue('AE'.$lastRowNum, round($ESIC_deduct));
	// 		$CI->excel->getActiveSheet()->setCellValue('AF'.$lastRowNum, round($total_ctc));

	// 		$CI->excel->getActiveSheet()->setCellValue('AG'.$lastRowNum, round($basic_net));
	// 		$CI->excel->getActiveSheet()->setCellValue('AH'.$lastRowNum, round($DA_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AI'.$lastRowNum, round($HRA_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AJ'.$lastRowNum, round($Conveyance_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AK'.$lastRowNum, round($mobile_total_all));
	// 		$CI->excel->getActiveSheet()->setCellValue('AL'.$lastRowNum, round($medical_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AM'.$lastRowNum, round($education_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AN'.$lastRowNum, round($city_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AO'.$lastRowNum, round($entertainment_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AP'.$lastRowNum, round($otherAllow_total_all));
	// 		$CI->excel->getActiveSheet()->setCellValue('AQ'.$lastRowNum, round($Bonus_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AR'.$lastRowNum, round($total_earn_gross));
	// 		$CI->excel->getActiveSheet()->setCellValue('AS'.$lastRowNum, round($total_earn_gross1));
	// 		$CI->excel->getActiveSheet()->setCellValue('AT'.$lastRowNum, round($tot_pf_deduct));
	// 		$CI->excel->getActiveSheet()->setCellValue('AU'.$lastRowNum, round($tot_ESIC_deduct));
	// 		$CI->excel->getActiveSheet()->setCellValue('AV'.$lastRowNum, round($pt_total));
			
			
	// 		$CI->excel->getActiveSheet()->setCellValue('AW'.$lastRowNum, round($mobile_ded_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('AX'.$lastRowNum, round($emp_wise_ded));
	// 		$CI->excel->getActiveSheet()->setCellValue('AY'.$lastRowNum, round($adv_opening));
	// 		$CI->excel->getActiveSheet()->setCellValue('AZ'.$lastRowNum, round($adv_Addition));
	// 		$CI->excel->getActiveSheet()->setCellValue('BA'.$lastRowNum, round($adv_recovery));
	// 		$CI->excel->getActiveSheet()->setCellValue('BB'.$lastRowNum, round($adv_closing_amt));
	// 		$CI->excel->getActiveSheet()->setCellValue('BC'.$lastRowNum, round($total_deduct_mnth));
			
	// 		/*$CI->excel->getActiveSheet()->setCellValue('AU'.$lastRowNum, round($Bonus_total));			
	// 		$CI->excel->getActiveSheet()->setCellValue('AV'.$lastRowNum, round($Arrears_total));*/
	// 		$CI->excel->getActiveSheet()->setCellValue('BD'.$lastRowNum, round($total_net_pay));
	// 		// $CI->excel->getActiveSheet()->setCellValue('BB'.$lastRowNum, round($total_star_deduct));
	// 		// $CI->excel->getActiveSheet()->setCellValue('BD'.$lastRowNum, round($total_star_pay));

	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)
	// 									->getFill()
	// 									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 									->getStartColor()->setARGB('EED8D8D8');
	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)->applyFromArray($allborders);
	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																			->setWrapText(true);

	// 	}
	// 	/* end dynamic code here **************/

		

	// 	header('Content-Type: application/vnd.ms-excel'); //mime type
	// 	header('Content-Disposition: attachment;filename="'.$company_name.'-'.$salMonth.'.xls"'); //tell browser what's the file name
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
	// 	if($export == true) {
	// 	$objWriter->save('php://output'); 
	// 	}else{
	// 		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
	// 		$filename = './excelfiles/'.str_replace(" ", "-", $company_name).'-'.$salMonth.'.xls';
	// 		$objWriter->save($filename);
	// 		return 'excelfiles/'.str_replace(" ", "-", $company_name).'-'.$salMonth.'.xls';
	// 	}
		


    // }

	function salarySlipReportExcelFormat_new($emp_basic_data,$company_name,$num_days_of_month,$month,$year,$salMonth, $export, $showbonus =false)
    {

    	
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Salary Sheet - '.$month.' '.$year);
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
		$CI->excel->getActiveSheet()->mergeCells('A1:BZ1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:CB1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:CB2')
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
		$CI->excel->getActiveSheet()->mergeCells('A2:CB2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:CB2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.');
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Employee ID');
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Name of the Employee');	
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Location');		
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Working Days');
		// paid leave
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Sanction Paid Leave');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Total Utilsed Paid Leave');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'Balance Paid Leave');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'Paid Leave Utilsed In Month');
		// sick leave
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Sanction Sick Leave');
		$CI->excel->getActiveSheet()->setCellValue('K3', 'Total Utilsed Sick Leave');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Balance Sick Leave');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'Sick Leave Utilsed In Month');

		$CI->excel->getActiveSheet()->setCellValue('N3', 'Actual Present Days');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Total Present Days');
		// Earning Allowance
		$CI->excel->getActiveSheet()->setCellValue('P3', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'DA Allowance');
		$CI->excel->getActiveSheet()->setCellValue('R3', 'HRA');
		$CI->excel->getActiveSheet()->setCellValue('S3', 'Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('T3', 'Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('U3', 'Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('V3', 'Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('W3', 'City Allowance');
		$CI->excel->getActiveSheet()->setCellValue('X3', 'Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('Y3', 'Performance Bonus');
		$CI->excel->getActiveSheet()->setCellValue('Z3', 'Other Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AA3', 'Bonus'); 
		$CI->excel->getActiveSheet()->setCellValue('AB3', 'Total Gross'); 
		// ctc
		$CI->excel->getActiveSheet()->setCellValue('AC3', 'PF (Employers Contribution)'); 
		$CI->excel->getActiveSheet()->setCellValue('AD3', 'ESIC (Employers Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('AE3', 'PF (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('AF3', 'ESIC (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('AG3', 'Employee Medical Insurance');
		$CI->excel->getActiveSheet()->setCellValue('AH3', 'CTC');
		// salary on number of days
		$CI->excel->getActiveSheet()->setCellValue('AI3', 'Earn Basic');
		$CI->excel->getActiveSheet()->setCellValue('AJ3', 'Earn DA');
		$CI->excel->getActiveSheet()->setCellValue('AK3', 'Earn HRA');
		$CI->excel->getActiveSheet()->setCellValue('AL3', 'Earn Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('AM3', 'Earn Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AN3', 'Earn Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AO3', 'Earn Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AP3', 'Earn City Allowance');  
		$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Earn Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AR3', 'Performance Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AS3', 'Earn Other Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AT3', 'Earn Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AU3', 'Total Earn Gross');
		$CI->excel->getActiveSheet()->setCellValue('AV3', 'Earn Gross For ESIC');
		$CI->excel->getActiveSheet()->setCellValue('AW3', 'Employees PF Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AX3', 'Employees ESIC  Deduction ');
		$CI->excel->getActiveSheet()->setCellValue('AY3', 'Employee Medical Insurance ');
		$CI->excel->getActiveSheet()->setCellValue('AZ3', 'Professional Tax');
		$CI->excel->getActiveSheet()->setCellValue('BA3', 'TDS');
		// if Deducation
		$CI->excel->getActiveSheet()->setCellValue('BB3', 'Telephone (Co.)');
		$CI->excel->getActiveSheet()->setCellValue('BC3', 'Others Deduction');
		$CI->excel->getActiveSheet()->setCellValue('BD3', 'Advance Opening'); 
		$CI->excel->getActiveSheet()->setCellValue('BE3', 'Advance Addition'); 
		$CI->excel->getActiveSheet()->setCellValue('BF3', 'Advance Recovery'); 
		$CI->excel->getActiveSheet()->setCellValue('BG3', 'Advance Closing');
		$CI->excel->getActiveSheet()->setCellValue('BH3', 'Total Deduction for the month');
		/*$CI->excel->getActiveSheet()->setCellValue('AU3', 'Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AV3', 'Arrears');*/
		//Total Salary 
		$CI->excel->getActiveSheet()->setCellValue('BI3', 'Net Pay');
		$CI->excel->getActiveSheet()->setCellValue('BJ3', 'WFH Days');
		$CI->excel->getActiveSheet()->setCellValue('BK3', 'WFH Deduction %');
		$CI->excel->getActiveSheet()->setCellValue('BL3', 'WFH Deduction Amount');
		$CI->excel->getActiveSheet()->setCellValue('BM3', 'Net Pay After WFH');

		$CI->excel->getActiveSheet()->setCellValue('BN3', 'No of Memo');
		$CI->excel->getActiveSheet()->setCellValue('BO3', 'Memo Amount');
		$CI->excel->getActiveSheet()->setCellValue('BP3', 'Late Punch In(After 11 am) Count - Half days');
		$CI->excel->getActiveSheet()->setCellValue('BQ3', 'Early Punch Out Count');
		$CI->excel->getActiveSheet()->setCellValue('BR3', 'Half Days due to Early Punch Out (1 for 3)');

		$CI->excel->getActiveSheet()->setCellValue('BS3', 'Full Days due to no minimum 4 hours');

		$CI->excel->getActiveSheet()->setCellValue('BT3', 'Half Days due to no minimum 8 hours (7 hours on Saturday)');

		
		$CI->excel->getActiveSheet()->setCellValue('BU3', 'Total full days');

		$CI->excel->getActiveSheet()->setCellValue('BV3', 'Total Deduction Amount');

		$CI->excel->getActiveSheet()->setCellValue('BW3', 'Net Pay After Deduction');

		$CI->excel->getActiveSheet()->setCellValue('BX3', 'No Punch Out Count');
	
		$CI->excel->getActiveSheet()->setCellValue('BY3', 'Total Deduction Amount');

		$CI->excel->getActiveSheet()->setCellValue('BZ3', 'Net Pay After Deduction');

		if($showbonus){
		$CI->excel->getActiveSheet()->setCellValue('CA3', 'Variable %');
		$CI->excel->getActiveSheet()->setCellValue('CB3', 'Variable Bonus Amount');
		}
		//Star rate
		// $CI->excel->getActiveSheet()->setCellValue('AX3', 'Red Star');
		// $CI->excel->getActiveSheet()->setCellValue('AY3', 'Gold Star');
		// $CI->excel->getActiveSheet()->setCellValue('AZ3', 'Balance Red Star');
		// $CI->excel->getActiveSheet()->setCellValue('BA3', 'Balance Gold Star');
		// $CI->excel->getActiveSheet()->setCellValue('BB3', 'Star deducation');
		/*$CI->excel->getActiveSheet()->setCellValue('BC3', 'Black Star');
		$CI->excel->getActiveSheet()->setCellValue('BD3', 'Balance Black Star');*/
		//$CI->excel->getActiveSheet()->setCellValue('BC3', 'Balance Gold Star');
		/*$CI->excel->getActiveSheet()->setCellValue('BD3', 'Black Star deducation');*/
		//$CI->excel->getActiveSheet()->setCellValue('BD3', 'Salary after star deducation');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(25);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(40);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);		
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(10);		
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(43)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(44)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(45)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(46)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(47)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(48)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(49)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(50)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(51)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(52)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(53)->setWidth(10);

		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(54)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(55)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(56)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(57)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(58)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(59)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(60)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(61)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(62)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(63)->setWidth(12);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(64)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(65)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(66)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(67)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(68)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(69)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(70)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(71)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(72)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(73)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(74)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(75)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(76)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(77)->setWidth(15);

		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:CB3')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:CB3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:CB3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:CB3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:CB3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:CB3')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A3:CB3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);
		/* start dynamic code from here *********/
		$lastRowNum=4;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
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
	 		$DA_total = 0;
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
			$education_total=0;
			$adv_opening = 0;
			$adv_Addition = 0;
			$adv_recovery = 0;
			$adv_closing_amt = 0;

			$mobile_total_all=0;
			$otherAllow_total_all=0;
			$recy_ttl = 0;
			$entertainment_total = 0;
			$p_bonus_total = 0;
			$pf_earn = 0;
			$ESIC_earn = 0;
			$pf_deduct = 0;
			$ESIC_deduct = 0;
			$insurance_deduct = 0;
			$tot_pf_deduct=0;
			$tot_ESIC_deduct=0;
			$pay_during_month = 0;
			$pay_beforePt=0;
			$final_net_pay=0;
			$basic_net=0;
			$total_ctc=0;
			$total_gross=0;
			$total_earn_gross=0;
			$total_earn_gross1=0;
			$total_net_salary=0;
			$total_deduct_mnth=0;
			$total_net_pay=0;
			$total_net_pay_wfh=0;
			$total_net_pay_deduction=0;
			//$Bonus_total=0;
			//emp info
			$emp_bac = 0;
			$emp_da = 0;
			$emp_hra = 0;
			$emp_earn_hra=0;
			$emp_convy = 0;
			$emp_mob = 0;
			$emp_med = 0;
			$emp_edu = 0;
			$emp_city = 0;
			$emp_enter = 0;
			$emp_gross = 0;
			$emp_p_bonus = 0;
			$emp_bonus = 0;
			$emp_tot_alw = 0;
	 		$sr=1;
	 		$total_star_deduct=0;
			$total_star_pay=0;
			$actual_present_day=0;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$netBasicTotK = 0;
	 			$emp_wise_ded=0;
	 			$boun_emp = 0;
	 			$emp_wise_add_deduction = 0;
	 		 	//echo $key->empl_id; echo '<br>';
				$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
				// print_r($emp_allData); 
				// echo $CI->db->last_query();
				$emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
				$earn_allowance = $CI->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->empl_id);
				$emp_basic = $CI->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->empl_id);
				$emp_leave_data = $CI->Slip_vish_model->fetch_emp_leave_data($key->user_id,$month,$year);
               /* echo $CI->db->last_query();exit();	 */   
				$emp_paid_leave = $CI->Slip_vish_model->fetch_paid_leave($key->user_id,$month,$year);
              

				$emp_creditleave_data = $CI->Slip_vish_model->fetch_emp_credit_leave_data($key->user_id,$year);
				
				$emp_creditleave = (isset($emp_creditleave_data->no_leave_credit) && !empty($emp_creditleave_data->no_leave_credit))?$emp_creditleave_data->no_leave_credit:'0';

				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->username);
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->emp_name);
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->dept);
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$num_days_of_month);

				$monthsdiff = $CI->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
				$bal_leave_cnt=0;
				if($monthsdiff->months>=6)
				{
					$saction = $emp_creditleave;
				}else if(isset($emp_creditleave_data->no_leave_credit) && $emp_creditleave_data->no_leave_credit<0 && $monthsdiff->months<6){
					$bal_leave_cnt = $emp_creditleave_data->no_leave_credit;
					$saction=0;
				}else{
					$saction = 0;
				}
				//echo (isset($bal_leave_cnt)?$bal_leave_cnt:$saction); echo '<br>';
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,$saction); //$emp_leave_data->total_leave
				/*if($emp_leave_data->bal_leave!=$emp_creditleave && !empty($emp_leave_data->bal_leave))
				{
					$earn_leave = $emp_creditleave-$emp_leave_data->bal_leave;
				}else{
					$earn_leave = 0;
				}*/
				/*$earn_leave=$emp_leave_data->earn_leave;*/
				$CI->excel->getActiveSheet()->setCellValue('G'.$j,(isset($emp_leave_data->earn_leave) && !empty($emp_leave_data->earn_leave))?$emp_leave_data->earn_leave:0); //$emp_leave_data->earn_leave
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,(isset($emp_leave_data->bal_leave) && !empty($emp_leave_data->bal_leave) && $saction!=0)?$emp_leave_data->bal_leave:$saction);
				/*$CI->excel->getActiveSheet()->setCellValue('H'.$j,$emp_leave_data->bal_leave);*/
				/*$CI->excel->getActiveSheet()->setCellValue('I'.$j,$emp_paid_leave->paid_leave);*/
              	$CI->excel->getActiveSheet()->setCellValue('I'.$j,(isset($emp_leave_data->earn_leave1) && !empty($emp_leave_data->earn_leave1))?$emp_leave_data->earn_leave1:0); 
              	
              	// sick leave
              	$emp_sick_leave_data = $CI->Slip_vish_model->fetch_emp_sick_leave_data($key->user_id,$year);
				
				$emp_sick_leave = (isset($emp_sick_leave_data->sick_leave_creadit) && !empty($emp_sick_leave_data->sick_leave_creadit))?$emp_sick_leave_data->sick_leave_creadit:'0';

				$monthsdiff = $CI->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
				$bal_leave_cnt=0;
				if($monthsdiff->months>=6)
				{
					$saction_sick = $emp_sick_leave;
				}else if(isset($emp_sick_leave_data->sick_leave_creadit) && $emp_sick_leave_data->sick_leave_creadit<0 && $monthsdiff->months<6){
					$bal_leave_cnt = $emp_sick_leave_data->sick_leave_creadit;
					$saction_sick=0;
				}else{
					$saction_sick=0;
				}

              	$CI->excel->getActiveSheet()->setCellValue('J'.$j,$saction_sick);

              	$emp_sick_leave_data = $CI->Slip_vish_model->fetch_emp_sick_leave_data1($key->user_id,$month,$year);
              	
              	$CI->excel->getActiveSheet()->setCellValue('K'.$j,(isset($emp_sick_leave_data->earn_leave) && !empty($emp_sick_leave_data->earn_leave))?$emp_sick_leave_data->earn_leave:0);
              	$CI->excel->getActiveSheet()->setCellValue('L'.$j,(isset($emp_sick_leave_data->bal_leave) && !empty($emp_sick_leave_data->bal_leave) && $saction!=0)?$emp_sick_leave_data->bal_leave:$saction_sick-$emp_sick_leave_data->earn_leave);
              	$CI->excel->getActiveSheet()->setCellValue('M'.$j,(isset($emp_sick_leave_data->earn_leave1) && !empty($emp_sick_leave_data->earn_leave1))?$emp_sick_leave_data->earn_leave1:0);

              	// total leave
              	$actual_present_day=($key->work_day)-($emp_leave_data->earn_leave1)-($emp_sick_leave_data->earn_leave1);
              	$total_present_day=$actual_present_day+($emp_leave_data->earn_leave1)+($emp_sick_leave_data->earn_leave1);
				$CI->excel->getActiveSheet()->setCellValue('N'.$j,$actual_present_day);
				$CI->excel->getActiveSheet()->setCellValue('O'.$j,$total_present_day);
				
				$basic = $key->basic_amt;//$emp_basic->emp_basic;
				$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($key->basic_amt));
				$emp_bac = $emp_bac + $basic;

				$da = 0;
				$hra = 0;
				$conveyance = 0;
				$mobile = 0;
				$medical = 0;
				$education = 0;
				$city = 0;
				$entertainment = 0;
				$p_bonus = 0;
				$bonus = 0;
				$total_allowance=0;

				//EARNING ALLOWANCE				
				if(isset($earn_allowance) && !empty($earn_allowance))
				{
					foreach ($earn_allowance as $earn)
					{
						if($earn->earning_id == 18 )
						{
							//DA allowance
							$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($earn->earn_value));
							$emp_da = $emp_da + $earn->earn_value; 
							$da = $earn->earn_value;
							
						}elseif($earn->earning_id == 7)
						{
							//HRA
							$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($earn->earn_value));
							$emp_hra = $emp_hra + $earn->earn_value;
							$hra = $earn->earn_value;
							
						}elseif($earn->earning_id == 3)
						{
							//Conveyance
							$CI->excel->getActiveSheet()->setCellValue('S'.$j,round($earn->earn_value));
							$emp_convy = $emp_convy + $earn->earn_value;
							$conveyance = $earn->earn_value;
							
						}elseif ($earn->earning_id == 6 ) 
						{
							// mobile allowance
							$CI->excel->getActiveSheet()->setCellValue('T'.$j,round($earn->earn_value));
							$emp_mob = $emp_mob + $earn->earn_value;
							$mobile = $earn->earn_value;
							
						}elseif($earn->earning_id == 13)
						{
							//medical allowance
							$CI->excel->getActiveSheet()->setCellValue('U'.$j,round($earn->earn_value));
							$emp_med = $emp_med + $earn->earn_value;
							$medical = $earn->earn_value;
							
						}elseif($earn->earning_id == 20)
						{
							//education allowance
							$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($earn->earn_value));
							$emp_edu = $emp_edu + $earn->earn_value;
							$education = $earn->earn_value;
							
						}elseif($earn->earning_id == 14 )
						{				
							// City allowance
							$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($earn->earn_value));
							$emp_city = $emp_city + $earn->earn_value;
							$city = $earn->earn_value;
							
						}elseif($earn->earning_id == 22)
						{
							//entertainment allowance
							$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($earn->earn_value));
							$emp_enter = $emp_enter + $earn->earn_value;
							$entertainment = $earn->earn_value;
							
						}elseif($earn->earning_id == 25)
						{
							//entertainment allowance
							$CI->excel->getActiveSheet()->setCellValue('Y'.$j,round($earn->earn_value));
							$emp_p_bonus = $emp_p_bonus + $earn->earn_value;
							$p_bonus = $earn->earn_value;
							
						}
						elseif($earn->earning_id == 9)
						{
							//entertainment allowance
							$CI->excel->getActiveSheet()->setCellValue('Z'.$j,round($earn->earn_value));
							$emp_tot_alw = $emp_tot_alw + $earn->earn_value;
							$total_allowance = $earn->earn_value;						
							
						}
						elseif($earn->earning_id == 15)
						{
							//entertainment allowance
							$CI->excel->getActiveSheet()->setCellValue('AA'.$j,round($earn->earn_value));
							$emp_bonus = $emp_bonus + $earn->earn_value;
							$bonus = $earn->earn_value;						
							
						}
					}
				}
				
				$gross = $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 + ($bonus)*1 +($total_allowance)*1+($p_bonus)*1;

				$gross1 = $basic + ($da)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 +($total_allowance)*1+($p_bonus)*1;

				$CI->excel->getActiveSheet()->setCellValue('AB'.$j,round((($gross+$key->pf_earn)-$bonus*1)));
				$emp_gross = $emp_gross + ($gross- $bonus);

				//CTC
				$CI->excel->getActiveSheet()->setCellValue('AC'.$j,round($key->pf_earn));
				$pf_earn = $pf_earn + $key->pf_earn;

				$CI->excel->getActiveSheet()->setCellValue('AD'.$j,round($key->ESIC_earn));
				$ESIC_earn = $ESIC_earn + $key->ESIC_earn;

				$CI->excel->getActiveSheet()->setCellValue('AE'.$j,round($key->pf_deduct));
				$pf_deduct=$pf_deduct+$key->pf_deduct;

				$CI->excel->getActiveSheet()->setCellValue('AF'.$j,round($key->ESIC_deduct));
				$ESIC_deduct=$ESIC_deduct+$key->ESIC_deduct;

				$CI->excel->getActiveSheet()->setCellValue('AG'.$j,round($key->insurance_deduct));
				$insurance_deduct=$insurance_deduct+$key->insurance_deduct;

				$ctc = $gross+$key->pf_earn+$key->ESIC_earn;//+$key->pf_deduct+$key->ESIC_deduct;
				$CI->excel->getActiveSheet()->setCellValue('AH'.$j,round($ctc));
				$total_ctc = $total_ctc + $ctc;
				
				//EARNING ALLOWANCE/NO OF DAYS
				$bsNet = 0;
				if(isset($key->net_pay) && $key->net_pay>0)
				{ 
					$bsNet = $key->net_pay + $key->pt_amt;
					$netBasicTotK = $bsNet;
				}

				$basic = $key->basic_net/$num_days_of_month;					
				$emp_basic = $key->work_day*$basic; 
				$CI->excel->getActiveSheet()->setCellValue('AI'.$j,round($emp_basic));
				$basic_net = $basic_net + $emp_basic;

				$hra = $key->hra/$num_days_of_month;
				$emp_earn_hra = $key->work_day*$hra;

				$CI->excel->getActiveSheet()->setCellValue('AK'.$j,round($emp_earn_hra));
				$HRA_total = $HRA_total + $emp_earn_hra;

				$convey = $key->convey/$num_days_of_month;
				$emp_convey = $key->work_day*$convey;

				$CI->excel->getActiveSheet()->setCellValue('AL'.$j,round($emp_convey));
				$Conveyance_total = $Conveyance_total + $emp_convey;

				$total_mobile=0;
				$total_city=0;
				$total_medi=0;
				$total_edu=0;
				$total_entertainment=0;
				$otherAllow_total = 0;
				$total_bonus=0;
				$total_da=0;
				$total_p_bonus=0;
							
				if(isset($emp_allData) && !empty($emp_allData))
				{

					foreach ($emp_allData as $row)
					{
						if($row->earning_id == 18 )
						{
							//DA allowance
							$da = $key->special_allowance/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,round($value));
							$DA_total = $DA_total + $value;
							$total_da = $value;
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AM'.$j,round($value));
							$mobile_total_all = $mobile_total_all + $value;
							$total_mobile = $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AN'.$j,round($value));
							$medical_total = $medical_total + $value;
							$total_medi = $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($value));
							$education_total = $education_total + $value;
							$total_edu = $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AP'.$j,round($value));
							$city_total = $city_total + $value;
							$total_city = $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,round($value));
							$entertainment_total = $entertainment_total + $value;
							$total_entertainment = $value;
							
						}elseif($row->earning_id == 25)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AR'.$j,round($value));
							$p_bonus_total = $p_bonus_total + $value;
							$total_p_bonus = $value;
							
						}
						elseif($row->earning_id == 9)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AS'.$j,round($value));
							$otherAllow_total_all = $otherAllow_total_all + $value;
							$otherAllow_total = $value;
							
						}
						elseif($row->earning_id == 15)
						{
							//Bonus
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$bonus_type = $key->bonus_type;
							if($bonus_type =="yearly"){
								$value = 0;
							}
							if ($bonus_type =="yearly" && strpos($key->salary_month, "10-") !== false) {
								$value = $CI->Slip_vish_model->getYearyBonus($key->empl_id, $key->salary_month);
							}
							$CI->excel->getActiveSheet()->setCellValue('AT'.$j,round($value));
							$Bonus_total = $Bonus_total + $value;
							$total_bonus=$value;
						}elseif($row->earning_id == 16)
						{
							$Advance_total = $Advance_total + $row->value;
							$per_emp_advance = $row->value;
						}else{
							$allowance_total_emp=0;
						}
					}
				}

				$earn_gross = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($total_bonus)*1 + ($otherAllow_total)*1+($total_p_bonus)*1;
				$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12);
				$CI->excel->getActiveSheet()->setCellValue('AU'.$j,round((($earn_gross+$pf_dedct)-$total_bonus*1)));
				$total_earn_gross = $total_earn_gross + ($earn_gross - $total_bonus); 
				
				$earn_gross1 = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1 +($total_p_bonus)*1;

				$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($earn_gross1));
				$total_earn_gross1 = $total_earn_gross1 + $earn_gross1; 

				$earn_gross_pf = ($emp_basic)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1+($total_p_bonus)*1;
				//DEDUCATION
				/*$pf_dedct1 = $key->pf_deduct;
				$pfd_val = $key->pf_deduct/$num_days_of_month;
				if(isset($key->pf_deduct) && !empty($key->pf_deduct)){

					//$pf_dedct =  $key->work_day*$pfd_val;
					if($pf_dedct1 >=1800)
					{
						$pf_dedct =  $key->work_day*$pfd_val;
					}else
					{
						$pf_dedct = round(($emp_basic + $emp_convey + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1)*0.12);
						//$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12);
					}
					//$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12); //$key->work_day*$pfd_val;
					 //round(($emp_basic + ($total_da)*1)*0.12);
				}else{
					$pf_dedct = 0;
				}*/
				$pf_dedct1 = $key->pf_deduct;
				$pfd_val = $key->pf_deduct/$num_days_of_month;
				if(isset($key->pf_deduct) && !empty($key->pf_deduct)){

					//$pf_dedct =  $key->work_day*$pfd_val;
					// if($pf_dedct1 >=1500)
					// {
					// 	$pf_dedct =  $key->work_day*$pfd_val;
					// }else
					// {
					//$pf_dedct = $key->pf_deduct;
					$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12);
					if ($pf_dedct > 1800) {
						$pf_dedct = 1800;
					}					
						
					// }
					//$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12); //$key->work_day*$pfd_val;
					 //round(($emp_basic + ($total_da)*1)*0.12);
				}else{
					$pf_dedct = 0;
				}
				$CI->excel->getActiveSheet()->setCellValue('AW'.$j,round($pf_dedct));
				$tot_pf_deduct=$tot_pf_deduct+$pf_dedct;

				$esicd_val = $key->ESIC_deduct/$num_days_of_month;
				// $esic_dedct = $key->work_day*$esicd_val;
				if (isset($key->ESIC_deduct) && !empty($key->ESIC_deduct)) {
					if ($gross1 <= 21000) {
						$esic_dedct = $earn_gross1*0.0075;
					} else {
						$esic_dedct = 0;
					}	
				} else {
					$esic_dedct = 0;
				}
						
				$CI->excel->getActiveSheet()->setCellValue('AX'.$j,round($esic_dedct));
				$tot_ESIC_deduct=$tot_ESIC_deduct+$esic_dedct;
				$month_year_array1 = explode('-', $month);
				$nmonth1 = date('F',strtotime("01-".$month_year_array1[0]."-".date("Y")));
				if($key->pt_amt>0)
				{
					if($earn_gross<7500)
					{
						$pt = 0;
					}elseif($earn_gross<=10000 && $earn_gross>=7500)
					{
						if($key->gender=='Female')
						{
							$pt=0;
						}else{
							$pt = 175;
						}
					}elseif($earn_gross>10000)
					{
						if($nmonth1=='February')
						{
							$pt = 300;
						}else{
							$pt = 200;
						}
					}
				}else{
					$pt = 0;
				}

				

				$CI->excel->getActiveSheet()->setCellValue('AY'.$j,(isset($key->insurance_deduct) && !empty($key->insurance_deduct))?$key->insurance_deduct:0);

				$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,(isset($pt) && !empty($pt))?$pt:0);
				$pt_total = $pt_total + $pt;

				$CI->excel->getActiveSheet()->setCellValue('BA'.$j,(isset($key->tds_deduct) && !empty($key->tds_deduct))?$key->tds_deduct:0);


				$CI->excel->getActiveSheet()->setCellValue('BB'.$j,round($key->mobile_deduction));
				$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;

				$CI->excel->getActiveSheet()->setCellValue('BC'.$j,round($key->other_deduct));
				$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

				$CI->excel->getActiveSheet()->setCellValue('BD'.$j, round($key->advance_opening));
				$CI->excel->getActiveSheet()->setCellValue('BE'.$j, round($key->advance_Addition));
				$CI->excel->getActiveSheet()->setCellValue('BF'.$j, round($key->advance_recovery));
				$CI->excel->getActiveSheet()->setCellValue('BG'.$j, round($key->advance_closing_amt));

				if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
				{
					$recy_total=0;
					$Advance_deduction=0;
					foreach ($emp_Ded_allData as $rec)
					{
						if ($rec->deduction_id == 6)
						{
							$CI->excel->getActiveSheet()->setCellValue('BB'.$j,round($rec->deduct_value));
							$recy_total = $rec->deduct_value;
							
							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
							$per_emp_advance = $per_emp_advance-$rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							
							if($per_emp_advance>0)
							{ }
							else
							{
								$per_emp_advance=0;
							}
							$CI->excel->getActiveSheet()->setCellValue('BC'.$j,$per_emp_advance);
						}
						elseif(($rec->deduction_id == 'Arrears/ others') || ($rec->deduction_id == 'Deduction Arrears'))
						{
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
						}else{
						
						}				
					}
				}
				
				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;

				$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery + $key->tds_deduct + $key->insurance_deduct;
				$CI->excel->getActiveSheet()->setCellValue('BH'.$j,round($total_deduction));
				$total_deduct_mnth = $total_deduct_mnth + $total_deduction;

				/*//earning arrers
				$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($key->earn_arrears));
				$Arrears_total = $Arrears_total + $key->earn_arrears;
				*/
				//NET PAY
				$net_pay = ($earn_gross - $total_deduction) + $key->earn_arrears;
				$CI->excel->getActiveSheet()->setCellValue('BI'.$j,round($net_pay));

				$CI->excel->getActiveSheet()->setCellValue('BJ'.$j,round($key->wfh_day));
				$CI->excel->getActiveSheet()->setCellValue('BK'.$j,round($key->wfh_deduct_per));
				
				$wfo_days = $total_present_day - $key->wfh_day;
				$per_day_amt = $net_pay/$total_present_day;
				$wfo_amt = $per_day_amt*$wfo_days;
				$wfh_amt = $per_day_amt*$key->wfh_day;
				$wfh_deduct_amt = $wfh_amt*$key->wfh_deduct_per/100;
				
				$CI->excel->getActiveSheet()->setCellValue('BL'.$j,round($wfh_deduct_amt));
				$CI->excel->getActiveSheet()->setCellValue('BM'.$j,round($net_pay) - round($wfh_deduct_amt));

				
				$CI->excel->getActiveSheet()->setCellValue('BN'.$j,round($key->memo_cnt));
				$CI->excel->getActiveSheet()->setCellValue('BO'.$j,round($key->memo_amt));

				$CI->excel->getActiveSheet()->setCellValue('BP'.$j,round($key->late_punchin));
				$CI->excel->getActiveSheet()->setCellValue('BQ'.$j,round($key->early_punchout));
				$CI->excel->getActiveSheet()->setCellValue('BR'.$j,round($key->half_days_due_to_early_punch_out));

				$CI->excel->getActiveSheet()->setCellValue('BS'.$j,round($key->no_min_4hr_work_cnt));
				$CI->excel->getActiveSheet()->setCellValue('BT'.$j,round($key->no_min_8hr_work_cnt));

				$CI->excel->getActiveSheet()->setCellValue('BU'.$j, ($key->total_full_days) - round(($key->no_punchout_cnt)*1));


				$net_pay_after_wfh = round($net_pay) - round($wfh_deduct_amt);
				$per_day_amt = $net_pay_after_wfh / $total_present_day;
				$net_pay_after_deduction = ($net_pay_after_wfh -( $key->memo_amt* $key->memo_cnt)) - (($key->total_full_days*2 - $key->no_punchout_cnt*2)*$per_day_amt/2);

				$CI->excel->getActiveSheet()->setCellValue('BV'.$j,round(($key->total_full_days*2 - $key->no_punchout_cnt*2)*$per_day_amt/2));

				$CI->excel->getActiveSheet()->setCellValue('BW'.$j,round($net_pay_after_deduction));

				$CI->excel->getActiveSheet()->setCellValue('BX'.$j, round($key->no_punchout_cnt));
				$net_pay_after_deduction = $net_pay_after_deduction - round(($key->no_punchout_cnt*$per_day_amt));

				$CI->excel->getActiveSheet()->setCellValue('BY'.$j,round(($key->no_punchout_cnt*$per_day_amt)));

				$CI->excel->getActiveSheet()->setCellValue('BZ'.$j,round($net_pay_after_deduction));

				

				
				


				


				if($showbonus){
					$CI->excel->getActiveSheet()->setCellValue('CA'.$j,round($key->var_per));
					$CI->excel->getActiveSheet()->setCellValue('CB'.$j,round($key->var_amount));
				}
				$total_net_pay = $total_net_pay + round($net_pay);
				$total_net_pay_wfh = $total_net_pay_wfh + $net_pay_after_wfh;
				$total_net_pay_deduction = $total_net_pay_deduction + $net_pay_after_deduction;
				/*$emp_star = $CI->Slip_vish_model->fetch_emp_star_rate($key->user_id,$key->salary_month);
				$CI->excel->getActiveSheet()->setCellValue('AX'.$j,(isset($emp_star->red_star) && !empty($emp_star->red_star))?$emp_star->red_star:'0');
				$CI->excel->getActiveSheet()->setCellValue('AY'.$j,(isset($emp_star->gold_star) && !empty($emp_star->gold_star))?$emp_star->gold_star:'0');
				if(isset($emp_star->red_star) && $emp_star->red_star>='10')
				{
					$red = ($emp_star->red_star > $emp_star->gold_star)?($emp_star->red_star-$emp_star->gold_star):'0';
					$gold = ($emp_star->red_star < $emp_star->gold_star)?($emp_star->gold_star-$emp_star->red_star):'0';
				}else{
					$red = (isset($emp_star->red_star) && !empty($emp_star->red_star))?$emp_star->red_star:'0';
					$gold = (isset($emp_star->gold_star) && !empty($emp_star->gold_star))?$emp_star->gold_star:'0';
				}
				$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,$red);
				$CI->excel->getActiveSheet()->setCellValue('BA'.$j,$gold);
				if($monthsdiff->months>=6)
				{
					if($red>='10')
					{
						$per_day = $gross/$num_days_of_month;
						$perval = 1*$per_day;
						$total_salary = round($perval);
					}else{
						$total_salary = 0;
					}
				}else{
					$total_salary = 0;
				}
				$CI->excel->getActiveSheet()->setCellValue('BB'.$j,$total_salary);
				$total_star_deduct = $total_star_deduct+$total_salary;*/

				/*$CI->excel->getActiveSheet()->setCellValue('BC'.$j,(isset($emp_star->black_star) && !empty($emp_star->black_star))?$emp_star->black_star:'0');
				if(isset($emp_star->black_star) && $emp_star->black_star>='10')
				{
					$blackstar = ($gold > $emp_star->black_star)?($gold-$emp_star->black_star):'0';
					$blackstar = ($emp_star->black_star > $gold)?($emp_star->black_star-$gold):'0';
					$bal_gold = ($gold > $emp_star->black_star)?($gold-$emp_star->black_star):'0';
					$bal_black = ($emp_star->black_star > $gold)?($emp_star->black_star-$gold):'0';
				}else{
					$blackstar = 0;
					$bal_gold = $gold;
					$bal_black = (isset($emp_star->black_star) && !empty($emp_star->black_star))?$emp_star->black_star:'0';
				}
				
				if($blackstar>='20')
				{
					$per_day = $gross/$num_days_of_month;
					$perval = 1*$per_day;
					$total_salary1 = round($perval);
				}else{
					$total_salary1 = 0;
				}
				$CI->excel->getActiveSheet()->setCellValue('BD'.$j,$bal_black);*/
				/*$CI->excel->getActiveSheet()->setCellValue('BC'.$j,$gold);*/
				/*$CI->excel->getActiveSheet()->setCellValue('BD'.$j,$total_salary1);*/

				/*$CI->excel->getActiveSheet()->setCellValue('BD'.$j,round($net_pay-$total_salary));
				$total_star_pay = $total_star_pay+round($net_pay-$total_salary);*/

				$CI->excel->getActiveSheet()->getStyle('E'.$j.':BX'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('AB'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AH'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AU'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('BI'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('BJ'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
				// $CI->excel->getActiveSheet()->getStyle('BP'.$j)
				// 					->getFill()
				// 					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
				// 					->getStartColor()->setARGB('FFD8D8D8');					

				/*$CI->excel->getActiveSheet()->getStyle('AV'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');*/

				/*$CI->excel->getActiveSheet()->getStyle('BD'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');*/

				$CI->excel->getActiveSheet()->getStyle('BI'.$j)->getFont()->setBold(true);
				$CI->excel->getActiveSheet()->getStyle('BJ'.$j)->getFont()->setBold(true);
				$CI->excel->getActiveSheet()->getStyle('BT'.$j)->getFont()->setBold(true);


				//$CI->excel->getActiveSheet()->getStyle('BD'.$j)->getFont()->setBold(true);
				$j++;
				
			}//exit();

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BI'.$lastRowNum)->getFont()->setBold(true);

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BJ'.$lastRowNum)->getFont()->setBold(true);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BT'.$lastRowNum)->getFont()->setBold(true);

			$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':O'.$lastRowNum)
										->setCellValue('A'.$lastRowNum, 'Total');

			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($emp_bac));
			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($emp_da));
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($emp_hra));
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, round($emp_convy));
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, round($emp_mob));
			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, round($emp_med));
			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($emp_edu));
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($emp_city));
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($emp_enter));

			$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, round($emp_p_bonus));

			$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, round($emp_tot_alw));

			$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, round($emp_bonus));
			$CI->excel->getActiveSheet()->setCellValue('AB'.$lastRowNum, round($emp_gross));

			$CI->excel->getActiveSheet()->setCellValue('AC'.$lastRowNum, round($pf_earn));
			$CI->excel->getActiveSheet()->setCellValue('AD'.$lastRowNum, round($ESIC_earn));
			$CI->excel->getActiveSheet()->setCellValue('AE'.$lastRowNum, round($pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AF'.$lastRowNum, round($ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AH'.$lastRowNum, round($total_ctc));

			$CI->excel->getActiveSheet()->setCellValue('AI'.$lastRowNum, round($basic_net));
			$CI->excel->getActiveSheet()->setCellValue('AJ'.$lastRowNum, round($DA_total));
			$CI->excel->getActiveSheet()->setCellValue('AK'.$lastRowNum, round($HRA_total));
			$CI->excel->getActiveSheet()->setCellValue('AL'.$lastRowNum, round($Conveyance_total));
			$CI->excel->getActiveSheet()->setCellValue('AM'.$lastRowNum, round($mobile_total_all));
			$CI->excel->getActiveSheet()->setCellValue('AN'.$lastRowNum, round($medical_total));
			$CI->excel->getActiveSheet()->setCellValue('AO'.$lastRowNum, round($education_total));
			$CI->excel->getActiveSheet()->setCellValue('AP'.$lastRowNum, round($city_total));
			$CI->excel->getActiveSheet()->setCellValue('AQ'.$lastRowNum, round($entertainment_total));
			$CI->excel->getActiveSheet()->setCellValue('AR'.$lastRowNum, round($p_bonus_total));
			$CI->excel->getActiveSheet()->setCellValue('AS'.$lastRowNum, round($otherAllow_total_all));
			$CI->excel->getActiveSheet()->setCellValue('AT'.$lastRowNum, round($Bonus_total));
			$CI->excel->getActiveSheet()->setCellValue('AU'.$lastRowNum, round($total_earn_gross));
			$CI->excel->getActiveSheet()->setCellValue('AV'.$lastRowNum, round($total_earn_gross1));
			$CI->excel->getActiveSheet()->setCellValue('AW'.$lastRowNum, round($tot_pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AX'.$lastRowNum, round($tot_ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AZ'.$lastRowNum, round($pt_total));
			
			
			$CI->excel->getActiveSheet()->setCellValue('BB'.$lastRowNum, round($mobile_ded_total));
			$CI->excel->getActiveSheet()->setCellValue('BC'.$lastRowNum, round($emp_wise_ded));
			// $CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, round($adv_opening));
			// $CI->excel->getActiveSheet()->setCellValue('BC'.$lastRowNum, round($adv_Addition));
			// $CI->excel->getActiveSheet()->setCellValue('BD'.$lastRowNum, round($adv_recovery));
			// $CI->excel->getActiveSheet()->setCellValue('BE'.$lastRowNum, round($adv_closing_amt));
			$CI->excel->getActiveSheet()->setCellValue('BH'.$lastRowNum, round($total_deduct_mnth));
			
			/*$CI->excel->getActiveSheet()->setCellValue('AU'.$lastRowNum, round($Bonus_total));			
			$CI->excel->getActiveSheet()->setCellValue('AV'.$lastRowNum, round($Arrears_total));*/
			$CI->excel->getActiveSheet()->setCellValue('BI'.$lastRowNum, round($total_net_pay));

			$CI->excel->getActiveSheet()->setCellValue('BM'.$lastRowNum, round($total_net_pay_wfh));

			$CI->excel->getActiveSheet()->setCellValue('BZ'.$lastRowNum, round($total_net_pay_deduction));

			
			// $CI->excel->getActiveSheet()->setCellValue('BB'.$lastRowNum, round($total_star_deduct));
			// $CI->excel->getActiveSheet()->setCellValue('BD'.$lastRowNum, round($total_star_pay));

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':CB'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':CB'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':CB'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

		}
		/* end dynamic code here **************/

		

		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$company_name.'-'.$salMonth.'.xls"'); //tell browser what's the file name
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
		if($export == true) {
		$objWriter->save('php://output'); 
		}else{
			$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
			$filename = './excelfiles/'.str_replace(" ", "-", $company_name).'-'.$salMonth.'.xls';
			$objWriter->save($filename);
			return 'excelfiles/'.str_replace(" ", "-", $company_name).'-'.$salMonth.'.xls';
		}
		


    }

    function generate_compy_wise_report($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Salary Sheet - '.$month.' '.$year);
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
		$CI->excel->getActiveSheet()->mergeCells('A1:AR1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:AR1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:AR2')
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
		$CI->excel->getActiveSheet()->mergeCells('A2:AR2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:AR2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Employee ID'); 
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Name of the Employee');		
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Company name');		
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Working Days');
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Present Days');
		// Earning Allowance
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'DA Allowance');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'HRA');
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('K3', 'Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('N3', 'City Allowance');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('P3', 'Total Gross'); 
		// ctc
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'PF (Employers Contribution)'); 
		$CI->excel->getActiveSheet()->setCellValue('R3', 'ESIC (Employers Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('S3', 'PF (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('T3', 'ESIC (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('U3', 'CTC');
		// salary on number of days
		$CI->excel->getActiveSheet()->setCellValue('V3', 'Earn Basic');
		$CI->excel->getActiveSheet()->setCellValue('W3', 'Earn DA');
		$CI->excel->getActiveSheet()->setCellValue('X3', 'Earn HRA');
		$CI->excel->getActiveSheet()->setCellValue('Y3', 'Earn Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('Z3', 'Earn Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AA3', 'Earn Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AB3', 'Earn Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AC3', 'Earn City Allowance');  
		$CI->excel->getActiveSheet()->setCellValue('AD3', 'Earn Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AE3', 'Total Earn Gross');
		$CI->excel->getActiveSheet()->setCellValue('AF3', 'Employees PF Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AG3', 'Employees ESIC  Deduction ');
		$CI->excel->getActiveSheet()->setCellValue('AH3', 'Professional Tax');
		// if Deducation
		$CI->excel->getActiveSheet()->setCellValue('AI3', 'Telephone (Co.)');
		$CI->excel->getActiveSheet()->setCellValue('AJ3', 'Others Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AK3', 'Advance Opening'); 
		$CI->excel->getActiveSheet()->setCellValue('AL3', 'Advance Addition'); 
		$CI->excel->getActiveSheet()->setCellValue('AM3', 'Advance Recovery'); 
		$CI->excel->getActiveSheet()->setCellValue('AN3', 'Advance Closing');
		$CI->excel->getActiveSheet()->setCellValue('AO3', 'Total Deduction for the month');
		$CI->excel->getActiveSheet()->setCellValue('AP3', 'Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Arrears');
		//Total Salary 
		$CI->excel->getActiveSheet()->setCellValue('AR3', 'Net Pay');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(25);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(35);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(10);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:AR3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);;

		/* start dynamic code from here *********/
		$lastRowNum=4;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
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
	 		$DA_total = 0;
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
			$education_total=0;
			$adv_opening = 0;
			$adv_Addition = 0;
			$adv_recovery = 0;
			$adv_closing_amt = 0;

			$mobile_total_all=0;
			$otherAllow_total_all=0;
			$recy_ttl = 0;
			$entertainment_total = 0;
			$pf_earn = 0;
			$ESIC_earn = 0;
			$pf_deduct = 0;
			$ESIC_deduct = 0;
			$tot_pf_deduct=0;
			$tot_ESIC_deduct=0;
			$pay_during_month = 0;
			$pay_beforePt=0;
			$final_net_pay=0;
			$basic_net=0;
			$total_ctc=0;
			$total_gross=0;
			$total_earn_gross=0;
			$total_net_salary=0;
			$total_deduct_mnth=0;
			$total_net_pay=0;
			//emp info
			$emp_bac = 0;
			$emp_da = 0;
			$emp_hra = 0;
			$emp_convy = 0;
			$emp_mob = 0;
			$emp_med = 0;
			$emp_edu = 0;
			$emp_city = 0;
			$emp_enter = 0;
			$emp_gross = 0;
	 		$sr=1;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$netBasicTotK = 0;
	 			$emp_wise_ded=0;
	 			$boun_emp = 0;
	 			$emp_wise_add_deduction = 0;
	 		 	
				$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
				$emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
				$earn_allowance = $CI->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->empl_id);
				$emp_basic = $CI->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->empl_id);
				
				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->employee_id);
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->emp_name);
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->company_name);
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$num_days_of_month);
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,$key->work_day);
				//EARNING ALLOWANCE
				
				if(isset($earn_allowance) && !empty($earn_allowance))
				{
					$basic = $emp_basic->emp_basic;
					$CI->excel->getActiveSheet()->setCellValue('G'.$j,round($basic));
					$emp_bac = $emp_bac + $basic;

					$da = 0;
					$hra = 0;
					$conveyance = 0;
					$mobile = 0;
					$medical = 0;
					$education = 0;
					$city = 0;
					$entertainment = 0;

					foreach ($earn_allowance as $earn)
					{
						if($earn->earning_id == 18 )
						{
							//DA allowance
							$CI->excel->getActiveSheet()->setCellValue('H'.$j,round($earn->earn_value));
							$emp_da = $emp_da + $earn->earn_value; 
							$da = $earn->earn_value;
							
						}elseif($earn->earning_id == 7)
						{
							//HRA
							$CI->excel->getActiveSheet()->setCellValue('I'.$j,round($earn->earn_value));
							$emp_hra = $emp_hra + $earn->earn_value;
							$hra = $earn->earn_value;
							
						}elseif($earn->earning_id == 3)
						{
							//Conveyance
							$CI->excel->getActiveSheet()->setCellValue('J'.$j,round($earn->earn_value));
							$emp_convy = $emp_convy + $earn->earn_value;
							$conveyance = $earn->earn_value;
							
						}elseif ($earn->earning_id == 6 ) 
						{
							// mobile allowance
							$CI->excel->getActiveSheet()->setCellValue('K'.$j,round($earn->earn_value));
							$emp_mob = $emp_mob + $earn->earn_value;
							$mobile = $earn->earn_value;
							
						}elseif($earn->earning_id == 13)
						{
							//medical allowance
							$CI->excel->getActiveSheet()->setCellValue('L'.$j,round($earn->earn_value));
							$emp_med = $emp_med + $earn->earn_value;
							$medical = $earn->earn_value;
							
						}elseif($earn->earning_id == 20)
						{
							//education allowance
							$CI->excel->getActiveSheet()->setCellValue('M'.$j,round($earn->earn_value));
							$emp_edu = $emp_edu + $earn->earn_value;
							$education = $earn->earn_value;
							
						}elseif($earn->earning_id == 14 )
						{				
							// City allowance 
							$CI->excel->getActiveSheet()->setCellValue('N'.$j,round($earn->earn_value));
							$emp_city = $emp_city + $earn->earn_value;
							$city = $earn->earn_value;
							
						}elseif($earn->earning_id == 22)
						{
							//entertainment allowance
							$CI->excel->getActiveSheet()->setCellValue('O'.$j,round($earn->earn_value));
							$emp_enter = $emp_enter + $earn->earn_value;
							$entertainment = $earn->earn_value;
							
						}
					}
				}
				
				$gross = $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1;

				$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($gross));
				$emp_gross = $emp_gross + $gross;

				//CTC
				$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($key->pf_earn));
				$pf_earn = $pf_earn + $key->pf_earn;

				$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($key->ESIC_earn));
				$ESIC_earn = $ESIC_earn + $key->ESIC_earn;

				$CI->excel->getActiveSheet()->setCellValue('S'.$j,round($key->pf_deduct));
				$pf_deduct=$pf_deduct+$key->pf_deduct;

				$CI->excel->getActiveSheet()->setCellValue('T'.$j,round($key->ESIC_deduct));
				$ESIC_deduct=$ESIC_deduct+$key->ESIC_deduct;

				$ctc = $gross+$key->pf_earn+$key->ESIC_earn+$key->pf_deduct+$key->ESIC_deduct;
				$CI->excel->getActiveSheet()->setCellValue('U'.$j,round($ctc));
				$total_ctc = $total_ctc + $ctc;
				
				//EARNING ALLOWANCE/NO OF DAYS
				$bsNet = 0;
				if(isset($key->net_pay) && $key->net_pay>0)
				{ 
					$bsNet = $key->net_pay + $key->pt_amt;
					$netBasicTotK = $bsNet;
				}
							

				if(isset($emp_allData) && !empty($emp_allData))
				{
					$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($key->basic_net));
					$basic_net = $basic_net + $key->basic_net;

					$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($key->hra));
					$HRA_total = $HRA_total + $key->hra;

					$CI->excel->getActiveSheet()->setCellValue('Y'.$j,round($key->convey));
					$Conveyance_total = $Conveyance_total + $key->convey;

					$total_mobile=0;
					$total_city=0;
					$total_medi=0;
					$total_edu=0;
					$total_entertainment=0;
					$total_bonus=0;
					$total_da=0;

					foreach ($emp_allData as $row)
					{
						if($row->earning_id == 18 )
						{
							//DA allowance
							$da = $key->special_allowance/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($value));
							$DA_total = $DA_total + $value;
							$total_da = $value;
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('Z'.$j,round($value));
							$mobile_total_all = $mobile_total_all + $value;
							$total_mobile = $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AA'.$j,round($value));
							$medical_total = $medical_total + $value;
							$total_medi = $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AB'.$j,round($value));
							$education_total = $education_total + $value;
							$total_edu = $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AC'.$j,round($value));
							$city_total = $city_total + $value;
							$total_city = $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AD'.$j,round($value));
							$entertainment_total = $entertainment_total + $value;
							$total_entertainment = $value;
							
						}elseif($row->earning_id == 15)
						{
							//Bonus
							$CI->excel->getActiveSheet()->setCellValue('AP'.$j,round($row->value));
							$Bonus_total = $Bonus_total + $row->value;
							$total_bonus=$row->value;
						}elseif($row->earning_id == 16)
						{
							$Advance_total = $Advance_total + $row->value;
							$per_emp_advance = $row->value;
						}else{
							$allowance_total_emp=0;
						}
					}
				}

				$earn_gross = $key->basic_net + $key->hra + $key->convey + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1;

				$CI->excel->getActiveSheet()->setCellValue('AE'.$j,round($earn_gross));
				$total_earn_gross = $total_earn_gross + $earn_gross; 
				
				//DEDUCATION
				$pfd_val = $key->pf_deduct/$num_days_of_month;
				$pf_dedct = round(($key->basic_net + ($total_da)*1)*0.12);//$key->work_day*$pfd_val;
				$CI->excel->getActiveSheet()->setCellValue('AF'.$j,round($pf_dedct));
				$tot_pf_deduct=$tot_pf_deduct+$pf_dedct;

				$esicd_val = $key->ESIC_deduct/$num_days_of_month;
				$esic_dedct = $key->work_day*$esicd_val;
				$CI->excel->getActiveSheet()->setCellValue('AG'.$j,round($esic_dedct));
				$tot_ESIC_deduct=$tot_ESIC_deduct+$esic_dedct;

				if($key->pt_amt>0)
				{
					if($key->net_pay<7500)
					{
						$pt = 0;
					}elseif($key->net_pay<10001 && $key->net_pay>7500)
					{
						$pt = 175;
					}elseif($key->net_pay>10001)
					{
						if($month=='February')
						{
							$pt = 300;
						}else{
							$pt = 200;
						}
					}
				}else{
					$pt = 0;
				}

				$CI->excel->getActiveSheet()->setCellValue('AH'.$j,round($pt));
				$pt_total = $pt_total + $pt;

				$CI->excel->getActiveSheet()->setCellValue('AI'.$j,round($key->mobile_deduction));
				$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;

				$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,round($key->other_deduct));
				$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

				$CI->excel->getActiveSheet()->setCellValue('AK'.$j, round($key->advance_opening));
				$CI->excel->getActiveSheet()->setCellValue('AL'.$j, round($key->advance_Addition));
				$CI->excel->getActiveSheet()->setCellValue('AM'.$j, round($key->advance_recovery));
				$CI->excel->getActiveSheet()->setCellValue('AN'.$j, round($key->advance_closing_amt));

				if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
				{
					$recy_total=0;
					$Advance_deduction=0;
					foreach ($emp_Ded_allData as $rec)
					{
						if ($rec->deduction_id == 6)
						{
							$CI->excel->getActiveSheet()->setCellValue('AM'.$j,round($rec->deduct_value));
							$recy_total = $rec->deduct_value;
							
							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
							$per_emp_advance = $per_emp_advance-$rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							
							if($per_emp_advance>0)
							{ }
							else
							{
								$per_emp_advance=0;
							}
							$CI->excel->getActiveSheet()->setCellValue('AN'.$j,$per_emp_advance);
						}
						elseif(($rec->deduction_id == 'Arrears/ others') || ($rec->deduction_id == 'Deduction Arrears'))
						{
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
						}else{
						
						}
					}
				}
				
				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;

				$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
				$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($total_deduction));
				$total_deduct_mnth = $total_deduct_mnth + $total_deduction;

				//earning arrers
				$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,round($key->earn_arrears));
				$Arrears_total = $Arrears_total + $key->earn_arrears;

				//NET PAY
				$net_pay = ($earn_gross - $total_deduction) + ($total_bonus)*1 + $key->earn_arrears;
				$CI->excel->getActiveSheet()->setCellValue('AR'.$j,round($net_pay));
				$total_net_pay = $total_net_pay + $net_pay;

				$CI->excel->getActiveSheet()->getStyle('E'.$j.':AR'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('P'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('U'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AE'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AO'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AR'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AR'.$j)->getFont()->setBold(true);

				$j++;
				
			}

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->getFont()->setBold(true);
			$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':F'.$lastRowNum)
										->setCellValue('A'.$lastRowNum, 'Total');

			$CI->excel->getActiveSheet()->setCellValue('G'.$lastRowNum, round($emp_bac));
			$CI->excel->getActiveSheet()->setCellValue('H'.$lastRowNum, round($emp_da));
			$CI->excel->getActiveSheet()->setCellValue('I'.$lastRowNum, round($emp_hra));
			$CI->excel->getActiveSheet()->setCellValue('J'.$lastRowNum, round($emp_convy));
			$CI->excel->getActiveSheet()->setCellValue('K'.$lastRowNum, round($emp_mob));
			$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, round($emp_med));
			$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, round($emp_edu));
			$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, round($emp_city));
			$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, round($emp_enter));
			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($emp_gross));

			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($pf_earn));
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($ESIC_earn));
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, round($pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, round($ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, round($total_ctc));

			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($basic_net));
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($DA_total));
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($HRA_total));
			$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, round($Conveyance_total));
			$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, round($mobile_total_all));
			$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, round($medical_total));
			$CI->excel->getActiveSheet()->setCellValue('AB'.$lastRowNum, round($education_total));
			$CI->excel->getActiveSheet()->setCellValue('AC'.$lastRowNum, round($city_total));
			$CI->excel->getActiveSheet()->setCellValue('AD'.$lastRowNum, round($entertainment_total));
			$CI->excel->getActiveSheet()->setCellValue('AE'.$lastRowNum, round($total_earn_gross));

			$CI->excel->getActiveSheet()->setCellValue('AF'.$lastRowNum, round($tot_pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AG'.$lastRowNum, round($tot_ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AH'.$lastRowNum, round($pt_total));
			
			
			$CI->excel->getActiveSheet()->setCellValue('AI'.$lastRowNum, round($mobile_ded_total));
			$CI->excel->getActiveSheet()->setCellValue('AJ'.$lastRowNum, round($emp_wise_ded));
			$CI->excel->getActiveSheet()->setCellValue('AK'.$lastRowNum, round($adv_opening));
			$CI->excel->getActiveSheet()->setCellValue('AL'.$lastRowNum, round($adv_Addition));
			$CI->excel->getActiveSheet()->setCellValue('AM'.$lastRowNum, round($adv_recovery));
			$CI->excel->getActiveSheet()->setCellValue('AN'.$lastRowNum, round($adv_closing_amt));
			$CI->excel->getActiveSheet()->setCellValue('AO'.$lastRowNum, round($total_deduct_mnth));
			
			$CI->excel->getActiveSheet()->setCellValue('AP'.$lastRowNum, round($Bonus_total));			
			$CI->excel->getActiveSheet()->setCellValue('AQ'.$lastRowNum, round($Arrears_total));
			$CI->excel->getActiveSheet()->setCellValue('AR'.$lastRowNum, round($total_net_pay));

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

		}
		/* end dynamic code here **************/
		if($company_name=='All Companywise Salary Report')
		{
			$filename = 'All Companywise Salary Report.xls'; //save our workbook as this file name
		}else{
			$filename = $company_name.'.xls'; //save our workbook as this file name	
		}
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

    function generate_payslip_report($report_data, $company_name, $num_days_of_month, $month, $year, $file_name, $earning_id, $deduction_id)
    {
    	$CI =& get_instance(); 
    	$current_date = date('d/m/Y');    	
		$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Salary Report - '.$month.' '.$year);
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', $company_name);
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
		$CI->excel->getActiveSheet()->mergeCells('A1:AR1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:AR1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:AR2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Salary Report for the Month of '.$month.' '.$year.''); //$employee_basic_info->emp_comp_name
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
		$CI->excel->getActiveSheet()->mergeCells('A2:AR2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:AR2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Employee ID'); 
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Name of the Employee');		
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Company name');		
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Working Days');
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Present Days');
		// Earning Allowance
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'DA Allowance');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'HRA');
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('K3', 'Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('N3', 'City Allowance');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('P3', 'Total Gross'); 
		// ctc
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'PF (Employers Contribution)'); 
		$CI->excel->getActiveSheet()->setCellValue('R3', 'ESIC (Employers Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('S3', 'PF (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('T3', 'ESIC (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('U3', 'CTC');
		// salary on number of days
		$CI->excel->getActiveSheet()->setCellValue('V3', 'Earn Basic');
		$CI->excel->getActiveSheet()->setCellValue('W3', 'Earn DA');
		$CI->excel->getActiveSheet()->setCellValue('X3', 'Earn HRA');
		$CI->excel->getActiveSheet()->setCellValue('Y3', 'Earn Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('Z3', 'Earn Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AA3', 'Earn Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AB3', 'Earn Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AC3', 'Earn City Allowance');  
		$CI->excel->getActiveSheet()->setCellValue('AD3', 'Earn Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AE3', 'Total Earn Gross');
		$CI->excel->getActiveSheet()->setCellValue('AF3', 'Employees PF Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AG3', 'Employees ESIC  Deduction ');
		$CI->excel->getActiveSheet()->setCellValue('AH3', 'Professional Tax');
		// if Deducation
		$CI->excel->getActiveSheet()->setCellValue('AI3', 'Telephone (Co.)');
		$CI->excel->getActiveSheet()->setCellValue('AJ3', 'Others Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AK3', 'Advance Opening'); 
		$CI->excel->getActiveSheet()->setCellValue('AL3', 'Advance Addition'); 
		$CI->excel->getActiveSheet()->setCellValue('AM3', 'Advance Recovery'); 
		$CI->excel->getActiveSheet()->setCellValue('AN3', 'Advance Closing');
		$CI->excel->getActiveSheet()->setCellValue('AO3', 'Total Deduction for the month');
		$CI->excel->getActiveSheet()->setCellValue('AP3', 'Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Arrears');
		//Total Salary 
		$CI->excel->getActiveSheet()->setCellValue('AR3', 'Net Pay');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(25);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(0);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(43)->setWidth(0);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->setName('Bookman Old Style');
	    //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:AR3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A3:AR3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);;

		/* start dynamic code from here *********/
		$lastRowNum=4;
		if (isset($report_data) && !empty($report_data))
		{
	 		$j=4;
	 		$lastRowNum= $lastRowNum + count($report_data);
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
	 		$DA_total = 0;
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
			$education_total=0;
			$adv_opening = 0;
			$adv_Addition = 0;
			$adv_recovery = 0;
			$adv_closing_amt = 0;

			$mobile_total_all=0;
			$otherAllow_total_all=0;
			$recy_ttl = 0;
			$entertainment_total = 0;
			$pf_earn = 0;
			$ESIC_earn = 0;
			$pf_deduct = 0;
			$ESIC_deduct = 0;
			$tot_pf_deduct=0;
			$tot_ESIC_deduct=0;
			$pay_during_month = 0;
			$pay_beforePt=0;
			$final_net_pay=0;
			$basic_net=0;
			$total_ctc=0;
			$total_gross=0;
			$total_earn_gross=0;
			$total_net_salary=0;
			$total_deduct_mnth=0;
			$total_net_pay=0;
			//emp info
			$emp_bac = 0;
			$emp_da = 0;
			$emp_hra = 0;
			$emp_convy = 0;
			$emp_mob = 0;
			$emp_med = 0;
			$emp_edu = 0;
			$emp_city = 0;
			$emp_enter = 0;
			$emp_gross = 0;
	 		$sr=1;
	 		foreach ($report_data as $key)
	 		{
	 			$netBasicTotK = 0;
	 			$emp_wise_ded=0;
	 			$boun_emp = 0;
	 			$emp_wise_add_deduction = 0;
	 		 	
				$emp_allData = $CI->Slip_vish_model->fetchearnallowanceforreport($key->empl_id,$key->salary_month,$earning_id);
				$emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowforreport($key->empl_id,$deduction_id);	
				$earn_allowance = $CI->Slip_vish_model->fetchallowanceforreport($key->empl_id,$earning_id);

				$emp_basic = $CI->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->empl_id);
				
				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->employee_id);
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->emp_name);
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->company_name);
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$num_days_of_month);
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,$key->work_day);
				//EARNING ALLOWANCE
				
				if(isset($earn_allowance) && !empty($earn_allowance))
				{
					$da = $emp_basic->emp_basic/$num_days_of_month;
					$basic = $key->work_day*$da;
					$CI->excel->getActiveSheet()->setCellValue('G'.$j,round($basic));
					$emp_bac = $emp_bac + $basic;

					$da = 0;
					$hra = 0;
					$conveyance = 0;
					$mobile = 0;
					$medical = 0;
					$education = 0;
					$city = 0;
					$entertainment = 0;

					foreach ($earn_allowance as $earn)
					{
						if($earn->earning_id == 18 )
						{
							//DA allowance
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('H'.$j,round($value));
							$emp_da = $emp_da + $value;
							$da = $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(15);
						}

						if($earn->earning_id == 7)
						{
							//HRA
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('I'.$j,round($value));
							$emp_hra = $emp_hra + $value;
							$hra = $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);
						}

						if($earn->earning_id == 3)
						{
							//Conveyance
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('J'.$j,round($value));
							$emp_convy = $emp_convy + $value;
							$conveyance = $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(15);
						}

						if ($earn->earning_id == 6 ) 
						{
							// mobile allowance
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('K'.$j,round($value));
							$emp_mob = $emp_mob + $value;
							$mobile = $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(15);
						}

						if($earn->earning_id == 13)
						{
							//medical allowance
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('L'.$j,round($value));
							$emp_med = $emp_med + $value;
							$medical = $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(15);
						}

						if($earn->earning_id == 20)
						{
							//education allowance
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('M'.$j,round($value));
							$emp_edu = $emp_edu + $value;
							$education = $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(15);
						}

						if($earn->earning_id == 14)
						{				
							// City allowance
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('N'.$j,round($value));
							$emp_city = $emp_city + $value;
							$city = $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(15);
						}

						if($earn->earning_id == 22)
						{
							//entertainment allowance
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('O'.$j,round($value));
							$emp_enter = $emp_enter + $value;
							$entertainment = $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(15);						
						}

						if($earn->earning_id == 19 )
						{
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($value));
							$pf_earn = $pf_earn + $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
						}

						if($earn->earning_id == 21 )
						{
							$da = $earn->earn_value/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($value));
							$ESIC_earn = $ESIC_earn + $value;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
						}
					}
				}
				
				$gross = 0;// $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1;

				$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($gross));
				$emp_gross = $emp_gross + $gross;

				//CTC
				
				$CI->excel->getActiveSheet()->setCellValue('S'.$j,round($key->pf_deduct));
				$pf_deduct=$pf_deduct+$key->pf_deduct;

				$CI->excel->getActiveSheet()->setCellValue('T'.$j,round($key->ESIC_deduct));
				$ESIC_deduct=$ESIC_deduct+$key->ESIC_deduct;

				$ctc = $gross+$key->pf_earn+$key->ESIC_earn+$key->pf_deduct+$key->ESIC_deduct;
				$CI->excel->getActiveSheet()->setCellValue('U'.$j,round($ctc));
				$total_ctc = $total_ctc + $ctc;
				
				//EARNING ALLOWANCE/NO OF DAYS
				$bsNet = 0;
				if(isset($key->net_pay) && $key->net_pay>0)
				{ 
					$bsNet = $key->net_pay + $key->pt_amt;
					$netBasicTotK = $bsNet;
				}				

				if(isset($emp_allData) && !empty($emp_allData))
				{
					$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($key->basic_net));
					$basic_net = $basic_net + $key->basic_net;

					$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($key->hra));
					$HRA_total = $HRA_total + $key->hra;

					$CI->excel->getActiveSheet()->setCellValue('Y'.$j,round($key->convey));
					$Conveyance_total = $Conveyance_total + $key->convey;

					$total_mobile=0;
					$total_city=0;
					$total_medi=0;
					$total_edu=0;
					$total_entertainment=0;
					$total_bonus=0;
					$total_da=0;

					foreach ($emp_allData as $row)
					{
						if($row->earning_id == 18 )
						{
							//DA allowance
							$da = $key->special_allowance/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($value));
							$DA_total = $DA_total + $value;
							$total_da = $value;
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('Z'.$j,round($value));
							$mobile_total_all = $mobile_total_all + $value;
							$total_mobile = $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AA'.$j,round($value));
							$medical_total = $medical_total + $value;
							$total_medi = $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AB'.$j,round($value));
							$education_total = $education_total + $value;
							$total_edu = $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AC'.$j,round($value));
							$city_total = $city_total + $value;
							$total_city = $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AD'.$j,round($value));
							$entertainment_total = $entertainment_total + $value;
							$total_entertainment = $value;
							
						}elseif($row->earning_id == 15)
						{
							//Bonus
							$CI->excel->getActiveSheet()->setCellValue('AP'.$j,round($row->value));
							$Bonus_total = $Bonus_total + $row->value;
							$total_bonus=$row->value;
						}elseif($row->earning_id == 16)
						{
							$Advance_total = $Advance_total + $row->value;
							$per_emp_advance = $row->value;
						}else{
							$allowance_total_emp=0;
						}
					}
				}

				$earn_gross = 0;//$key->basic_net + $key->hra + $key->convey + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1;

				$CI->excel->getActiveSheet()->setCellValue('AE'.$j,round($earn_gross));
				$total_earn_gross = $total_earn_gross + $earn_gross; 
				
				//DEDUCATION
				if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
				{
					foreach ($emp_Ded_allData as $rec)
					{
						if ($rec->deduction_id == 7)
						{
							$pfd_val = $key->pf_deduct/$num_days_of_month;
							$pf_dedct = round(($key->basic_net + ($total_da)*1)*0.12);//$key->work_day*$pfd_val;
							$CI->excel->getActiveSheet()->setCellValue('AF'.$j,round($pf_dedct));
							$tot_pf_deduct=$tot_pf_deduct+$pf_dedct;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
						}

						if ($rec->deduction_id == 8)
						{
							$esicd_val = $key->ESIC_deduct/$num_days_of_month;
							$esic_dedct = $key->work_day*$esicd_val;
							$CI->excel->getActiveSheet()->setCellValue('AG'.$j,round($esic_dedct));
							$tot_ESIC_deduct=$tot_ESIC_deduct+$esic_dedct;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
						}

						if ($rec->deduction_id == 4)
						{
							if($key->pt_amt>0)
							{
								if($key->net_pay<7500)
								{
									$pt = 0;
								}elseif($key->net_pay<10001 && $key->net_pay>7500)
								{
									$pt = 175;
								}elseif($key->net_pay>10001)
								{
									if($month=='February')
									{
										$pt = 300;
									}else{
										$pt = 200;
									}
								}
							}else{
								$pt = 0;
							}

							$CI->excel->getActiveSheet()->setCellValue('AH'.$j,round($pt));
							$pt_total = $pt_total + $pt;
							$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(15);
						}

					}
				}

				$CI->excel->getActiveSheet()->setCellValue('AI'.$j,round($key->mobile_deduction));
				$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;

				$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,round($key->other_deduct));
				$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

				$CI->excel->getActiveSheet()->setCellValue('AK'.$j, round($key->advance_opening));
				$CI->excel->getActiveSheet()->setCellValue('AL'.$j, round($key->advance_Addition));
				$CI->excel->getActiveSheet()->setCellValue('AM'.$j, round($key->advance_recovery));
				$CI->excel->getActiveSheet()->setCellValue('AN'.$j, round($key->advance_closing_amt));

				if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
				{
					$recy_total=0;
					$Advance_deduction=0;
					foreach ($emp_Ded_allData as $rec)
					{
						if ($rec->deduction_id == 6)
						{
							$CI->excel->getActiveSheet()->setCellValue('AM'.$j,round($rec->deduct_value));
							$recy_total = $rec->deduct_value;
							
							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
							$per_emp_advance = $per_emp_advance-$rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							
							if($per_emp_advance>0)
							{ }
							else
							{
								$per_emp_advance=0;
							}
							$CI->excel->getActiveSheet()->setCellValue('AN'.$j,$per_emp_advance);
						}
						elseif(($rec->deduction_id == 'Arrears/ others') || ($rec->deduction_id == 'Deduction Arrears'))
						{
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
						}else{
						
						}				
					}
				}
				
				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;

				$total_deduction = 0;//$pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
				$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($total_deduction));
				$total_deduct_mnth = $total_deduct_mnth + $total_deduction;

				//earning arrers
				$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,round($key->earn_arrears));
				$Arrears_total = $Arrears_total + $key->earn_arrears;

				//NET PAY
				$net_pay = 0;//($earn_gross - $total_deduction) + ($total_bonus)*1 + $key->earn_arrears;
				$CI->excel->getActiveSheet()->setCellValue('AR'.$j,round($net_pay));
				$total_net_pay = $total_net_pay + $net_pay;

				$CI->excel->getActiveSheet()->getStyle('E'.$j.':AR'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('P'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('U'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AE'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AO'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AR'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AR'.$j)->getFont()->setBold(true);

				$j++;
				
			}

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->getFont()->setBold(true);
			$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':F'.$lastRowNum)
										->setCellValue('A'.$lastRowNum, 'Total');

			$CI->excel->getActiveSheet()->setCellValue('G'.$lastRowNum, round($emp_bac));
			$CI->excel->getActiveSheet()->setCellValue('H'.$lastRowNum, round($emp_da));
			$CI->excel->getActiveSheet()->setCellValue('I'.$lastRowNum, round($emp_hra));
			$CI->excel->getActiveSheet()->setCellValue('J'.$lastRowNum, round($emp_convy));
			$CI->excel->getActiveSheet()->setCellValue('K'.$lastRowNum, round($emp_mob));
			$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, round($emp_med));
			$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, round($emp_edu));
			$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, round($emp_city));
			$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, round($emp_enter));
			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($emp_gross));

			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($pf_earn));
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($ESIC_earn));
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, round($pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, round($ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, round($total_ctc));

			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($basic_net));
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($DA_total));
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($HRA_total));
			$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, round($Conveyance_total));
			$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, round($mobile_total_all));
			$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, round($medical_total));
			$CI->excel->getActiveSheet()->setCellValue('AB'.$lastRowNum, round($education_total));
			$CI->excel->getActiveSheet()->setCellValue('AC'.$lastRowNum, round($city_total));
			$CI->excel->getActiveSheet()->setCellValue('AD'.$lastRowNum, round($entertainment_total));
			$CI->excel->getActiveSheet()->setCellValue('AE'.$lastRowNum, round($total_earn_gross));

			$CI->excel->getActiveSheet()->setCellValue('AF'.$lastRowNum, round($tot_pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AG'.$lastRowNum, round($tot_ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AH'.$lastRowNum, round($pt_total));
			
			
			$CI->excel->getActiveSheet()->setCellValue('AI'.$lastRowNum, round($mobile_ded_total));
			$CI->excel->getActiveSheet()->setCellValue('AJ'.$lastRowNum, round($emp_wise_ded));
			$CI->excel->getActiveSheet()->setCellValue('AK'.$lastRowNum, round($adv_opening));
			$CI->excel->getActiveSheet()->setCellValue('AL'.$lastRowNum, round($adv_Addition));
			$CI->excel->getActiveSheet()->setCellValue('AM'.$lastRowNum, round($adv_recovery));
			$CI->excel->getActiveSheet()->setCellValue('AN'.$lastRowNum, round($adv_closing_amt));
			$CI->excel->getActiveSheet()->setCellValue('AO'.$lastRowNum, round($total_deduct_mnth));
			
			$CI->excel->getActiveSheet()->setCellValue('AP'.$lastRowNum, round($Bonus_total));			
			$CI->excel->getActiveSheet()->setCellValue('AQ'.$lastRowNum, round($Arrears_total));
			$CI->excel->getActiveSheet()->setCellValue('AR'.$lastRowNum, round($total_net_pay));

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AR'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

		}
		/* end dynamic code here **************/
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$file_name.'"'); //tell browser what's the file name
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

	// function gen_register_of_wages_report($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    // {
    // 	$CI =& get_instance(); 
    // 	/*date_default_timezone_set('Asia/kolkata');*/
    // 	$current_date = date('d/m/Y');    	
    // 	$CI->load->library('excel');

	// 	$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
	// 						 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
	// 						 	   ->setTitle("Pay Slip")
	// 						 	   ->setSubject("Pay Slip Of An Employee")
	// 						 	   ->setDescription("System Generated File.")
	// 						 	   ->setKeywords("office 2007")
	// 						 	   ->setCategory("Confidential");

	// 	$allborders = array(
	// 		'borders' => array(
	// 			'allborders' => array(
	// 				'style' => PHPExcel_Style_Border::BORDER_THIN,
					
	// 			),
	// 		),
	// 	);
	// 	//activate worksheet number 1
	// 	$CI->excel->setActiveSheetIndex(0);
	// 	//name the worksheet
	// 	$CI->excel->getActiveSheet()->setTitle('RoW - '.$month.' '.$year);
	// 	//set cell A1 content with some text
	// 	$CI->excel->getActiveSheet()->setCellValue('A1', 'Register of Wages - '.$month.' '.$year.''); //$employee_basic_info->emp_comp_name
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	// 	//set row height
	// 	$CI->excel->getActiveSheet()->getRowDimension('1')
	// 								->setRowHeight(20);
	// 	/*  set default border for all stylesheet */
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getTop()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getBottom()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getLeft()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getRight()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	/*  End set default border for all stylesheet */

	// 	//merge cell A1 until D1
	// 	$CI->excel->getActiveSheet()->mergeCells('A1:AA1')
	// 								->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');
	// 	$CI->excel->getActiveSheet()->getStyle('A1:AA1')->applyFromArray($allborders);

	// 	$CI->excel->getActiveSheet()->getStyle('A2:AA2')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	// 	//set aligment to center for that merged cell (A1 to V1)
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	// 	//set cell A1 content with some text
	// 	$headline = "FORM XIII [See rule 59(2)(a)]\n".$company_name."\nOffice No. 310, 311, 312, Pride Purple Square Kalewadi Phata,\nWakad, Pune- 411057";
	// 	$CI->excel->getActiveSheet()->setCellValue('A2', $headline);
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(10);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);

	// 	/*  set default border for all stylesheet */
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getTop()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getBottom()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getLeft()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getRight()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	/*  End set default border for all stylesheet */

	// 	//merge cell A1 until D1
	// 	$CI->excel->getActiveSheet()->mergeCells('A2:AA2')
	// 								->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');


	// 	$CI->excel->getActiveSheet()->getStyle('A2:AA2')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	// 	//set aligment to center for that merged cell (A1 to V1)
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


	// 	$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('B3', 'Name of Workman'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('C3', 'Serial No.');		
	// 	$CI->excel->getActiveSheet()->setCellValue('D3', 'Designation');		
	// 	$CI->excel->getActiveSheet()->setCellValue('E3', 'No. of days worked');
	// 	$CI->excel->getActiveSheet()->setCellValue('F3', 'O. T. Hrs');
	// 	$CI->excel->getActiveSheet()->setCellValue('G3', 'Wage Rate');
	// 	$CI->excel->getActiveSheet()->setCellValue('H3', 'Units of Work done');
	// 	$CI->excel->getActiveSheet()->setCellValue('I3', 'Piece Rate');
	// 	$CI->excel->getActiveSheet()->setCellValue('J3', 'Basic Wages');
	// 	$CI->excel->getActiveSheet()->setCellValue('K3', 'Dearness Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('L3', 'Over time');
	// 	$CI->excel->getActiveSheet()->setCellValue('M3', 'Other Cash Payments');
	// 	$CI->excel->getActiveSheet()->setCellValue('N3', 'Total');
	// 	$CI->excel->getActiveSheet()->setCellValue('O3', 'Advance');
	// 	$CI->excel->getActiveSheet()->setCellValue('P3', 'Professional Tax'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('Q3', 'ESI'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('R3', 'Provident Fund');
	// 	$CI->excel->getActiveSheet()->setCellValue('S3', 'Family Pension Fund');
	// 	$CI->excel->getActiveSheet()->setCellValue('T3', 'Canteen');
	// 	$CI->excel->getActiveSheet()->setCellValue('U3', 'Dhobi');
	// 	$CI->excel->getActiveSheet()->setCellValue('V3', 'Others');
	// 	$CI->excel->getActiveSheet()->setCellValue('W3', 'Total');
	// 	$CI->excel->getActiveSheet()->setCellValue('X3', 'Net amount paid');
	// 	$CI->excel->getActiveSheet()->setCellValue('Y3', 'Signature / Thumb Impression of workman');
	// 	$CI->excel->getActiveSheet()->setCellValue('Z3', 'Initials of contractor or his respresentative');
	// 	$CI->excel->getActiveSheet()->setCellValue('AA3', 'Initials of Principal Employer');


	// 	$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
	// 	$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(55);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(23);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(8);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(30);							
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(10);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);
	// 	/************ Wrap A2 V3 content */  

	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->setSize(10);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A2:AA3')->getFont()->setBold(true);															
	// 	$CI->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
	// 	$CI->excel->getActiveSheet()->getStyle('A3:AA3')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FF428bca');
	// 	$CI->excel->getActiveSheet()->getStyle('A3:AA3')->applyFromArray($allborders);
	// 	$CI->excel->getActiveSheet()->getStyle('A3:AA3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);;

	// 	/* start dynamic code from here *********/
	// 	$lastRowNum=4;
 	// 	if (isset($emp_basic_data) && !empty($emp_basic_data))
 	// 	{
	//  		$j=4;
	//  		$lastRowNum= $lastRowNum + count($emp_basic_data);
	//  		// define total vcariable for per coloumn 
	//  		$net_basic_total=0;
	//  		$net_basic_totalE=0;
	//  		$salBefoPt_total=0;
	//  		$pt_total=0;
	//  		$net_with_pt_total=0;
	//  		$total_deduction=0;
	//  		$Conveyance_total=0;
	//  		$mobile_total=0;
	//  		$HRA_total = 0;
	//  		$DA_total = 0;
	//  		$otherAllow_total=0;
	//  		$Arrears_total=0;
	//  		$allowance_total_emp = 0;
	//  		$allowance_ded_total_emp = 0;
	// 		$mobile_ded_total = 0;
	// 		$ArrOther_ded_total = 0;
	// 		$Bonus_total = 0;
	// 		$Advance_total = 0;
	// 		$per_emp_advance=0;
	// 		$deduct_adv_total=0;
	// 		$Advance_deduction=0;
	// 		$medical_total=0;
	// 		$city_total=0;
	// 		$education_total=0;
	// 		$adv_opening = 0;
	// 		$adv_Addition = 0;
	// 		$adv_recovery = 0;
	// 		$pf_deduct = 0;
	// 		$ESIC_deduct = 0;
	// 		$tot_ESIC_deduct = 0;
	// 		$tot_pf_deduct = 0;
	// 		$total_deduct_mnth = 0;
	// 		//emp info
	// 		$emp_bac = 0;
	// 		$emp_da = 0;
	// 		$emp_hra = 0;
	// 		$emp_convy = 0;
	// 		$emp_mob = 0;
	// 		$emp_med = 0;
	// 		$emp_edu = 0;
	// 		$emp_city = 0;
	// 		$emp_enter = 0;
	//  		$sr=1;
	//  		foreach ($emp_basic_data as $key)
	//  		{
	//  			$netBasicTotK = 0;
	//  			$emp_wise_ded=0;
	//  			$boun_emp = 0;
	//  			$emp_wise_add_deduction = 0;

	//  			$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
	 		 	
	// 			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
	// 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
	// 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->employee_id);
	// 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->desig_id);
	// 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,$key->work_day);
	// 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,'NA');
	// 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,'NA');
	// 			$CI->excel->getActiveSheet()->setCellValue('H'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('I'.$j,'NA');
				
	// 			$bsc = $key->basic_amt/$num_days_of_month;
	// 			$basic = $key->work_day*$bsc;
	// 			$CI->excel->getActiveSheet()->setCellValue('J'.$j,round($basic));
	// 			$emp_bac = $emp_bac + round($basic);

	// 			$da = $key->special_allowance/$num_days_of_month;
	// 			$sa = $key->work_day*$da;
	// 			$CI->excel->getActiveSheet()->setCellValue('K'.$j,round($sa));
	// 			$emp_da = $emp_da + round($sa); 
	// 			$da = $sa;

	// 			$CI->excel->getActiveSheet()->setCellValue('L'.$j,'-');

	// 			/*$allowances = $key->allowances;
	// 			$oa = $key->allowances/$num_days_of_month;
	// 			$other_allow = $key->work_day*$oa;*/
	// 			if(isset($emp_allData) && !empty($emp_allData))
	// 			{					
	// 				$other_allow=0;
	// 				foreach ($emp_allData as $row)
	// 				{
	// 					if ($row->earning_id == 6 ) 
	// 					{
	// 						// mobile allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;
							
	// 					}elseif($row->earning_id == 13)
	// 					{
	// 						//medical allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;
							
	// 					}elseif($row->earning_id == 20)
	// 					{
	// 						//education allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;
							
	// 					}elseif($row->earning_id == 14 )
	// 					{				
	// 						// City allowance 
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;
							
	// 					}elseif($row->earning_id == 22)
	// 					{
	// 						//entertainment allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;						
	// 					}elseif($row->earning_id == 15)
	// 					{
	// 						//Bonus
	// 						$bonus_value = $row->value / $num_days_of_month * $key->work_day; 
	// 					}
	// 				}
	// 			}
	// 			$last_val1 = $key->hra/$num_days_of_month;
	// 			$value1 = $key->work_day*$last_val1;
	// 			$other_allow1 = $value1;

	// 			$last_val2 = $key->convey/$num_days_of_month;
	// 			$value2 = $key->work_day*$last_val2;
	// 			$other_allow2 = $value2;
	// 			$CI->excel->getActiveSheet()->setCellValue('M'.$j,round($other_allow+$other_allow1+$other_allow2+$bonus_value));
	// 			$net_basic_total = $net_basic_total+round($other_allow+$other_allow1+$other_allow2+$bonus_value);
				
				
	// 			//$total_earn = $other_allow+$da+$basic+$key->hra+$key->convey;
	// 			$total_earn = $other_allow+$da+$basic+$other_allow1+$other_allow2+$bonus_value;
				
	// 			$CI->excel->getActiveSheet()->setCellValue('N'.$j,round($total_earn));
	// 			$allowance_total_emp = $allowance_total_emp+round($total_earn);
				
	// 			$CI->excel->getActiveSheet()->setCellValue('O'.$j,round($key->advance_recovery));
	// 			$adv_recovery = $adv_recovery + round($key->advance_recovery);
				
	// 			//DEDUCATION
	// 			if($key->pt_amt>0)
	// 			{
	// 				if($total_earn<=7500)
	// 				{
	// 					$pt = 0;
	// 				}elseif($total_earn<=10000 && $total_earn>=7500)
	// 				{
	// 					if($key->gender=='Female')
	// 					{
	// 						$pt=0;
	// 					}else{
	// 						$pt = 175;
	// 					}
	// 				}elseif($total_earn>10000)
	// 				{
	// 					if($month=='February')
	// 					{
	// 						$pt = 300;
	// 					}else{
	// 						$pt = 200;
	// 					}
	// 				}
	// 			}else{
	// 				$pt = 0;
	// 			}

	// 			$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($pt));
	// 			$pt_total = $pt_total + $pt;

	// 			$esicd_val = $key->ESIC_deduct/$num_days_of_month;
	// 			$esic_dedct = $key->work_day*$esicd_val;
	// 			$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($esic_dedct));
	// 			$tot_ESIC_deduct=$tot_ESIC_deduct+round($esic_dedct);

	// 			$pfd_val = $key->pf_deduct/$num_days_of_month;
	// 			$pf_dedct = $pfd_val*$key->work_day;//$pf_dedct = ($da+$basic)*0.12;//$key->work_day*$pfd_val;
	// 			$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($pf_dedct));
	// 			$tot_pf_deduct=$tot_pf_deduct+round($pf_dedct);

				
	// 			$CI->excel->getActiveSheet()->setCellValue('S'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('T'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('U'.$j,'-');

	// 			$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($key->mobile_deduction+$key->other_deduct));
	// 			$mobile_ded_total = $mobile_ded_total + round($key->mobile_deduction+$key->other_deduct);
				
	// 			$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
	// 			$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($total_deduction));
	// 			$total_deduct_mnth = $total_deduct_mnth + round($total_deduction);

	// 			//earning arrers
	// 			$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($total_earn-$total_deduction));
	// 			$Arrears_total = $Arrears_total + round($total_earn-$total_deduction);

	// 			$CI->excel->getActiveSheet()->setCellValue('Y'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('Z'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AA'.$j,'-');


	// 			$CI->excel->getActiveSheet()->getStyle('E'.$j.':AA'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);

	// 			$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);
	// 			$CI->excel->getActiveSheet()->getStyle('D'.$j.':D'.$j)->getAlignment()->setWrapText(true);
	// 			$j++;
				
	// 		}

	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AA'.$lastRowNum)->getFont()->setBold(true);
	// 		$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':E'.$lastRowNum)
	// 									->setCellValue('A'.$lastRowNum, 'Total');

	// 		$CI->excel->getActiveSheet()->setCellValue('F'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('G'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('H'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('I'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('J'.$lastRowNum, round($emp_bac));
	// 		$CI->excel->getActiveSheet()->setCellValue('K'.$lastRowNum, round($emp_da));
	// 		$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, round($net_basic_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, round($allowance_total_emp));
	// 		$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, round($adv_recovery));
	// 		$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($pt_total));

	// 		$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($tot_ESIC_deduct));
	// 		$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($tot_pf_deduct));
	// 		$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, '');

	// 		$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($mobile_ded_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($total_deduct_mnth));
	// 		$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($Arrears_total));
	// 		$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, '');
	// 		$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, '');

	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AA'.$lastRowNum)
	// 									->getFill()
	// 									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 									->getStartColor()->setARGB('EED8D8D8');
	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AA'.$lastRowNum)->applyFromArray($allborders);
	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AA'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																			->setWrapText(true);

	// 		$lastRowNum = $lastRowNum+2;

	// 		$objDrawing = new PHPExcel_Worksheet_Drawing();
	// 		$objDrawing->setName('test_img');
	// 		$objDrawing->setDescription('test_img');
	// 		$objDrawing->setPath('./images/logo/stamp.jpg');
	// 		$objDrawing->setCoordinates('D'.$lastRowNum);                      
	// 		//setOffsetX works properly
	// 		$objDrawing->setOffsetX(5); 
	// 		$objDrawing->setOffsetY(5);                
	// 		//set width, height
	// 		$objDrawing->setWidth(100); 
	// 		$objDrawing->setHeight(150); 
	// 		$objDrawing->setWorksheet($CI->excel->getActiveSheet());

	// 	}
	// 	/* end dynamic code here **************/
	// 	$filename = 'Register of Wages - '.$month.' '.$year.'.xls'; //save our workbook as this file name	
		
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

	function gen_register_of_wages_report($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('RoW - '.$month.' '.$year);
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', 'Register of Wages - '.$month.' '.$year.''); //$employee_basic_info->emp_comp_name
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
		$CI->excel->getActiveSheet()->mergeCells('A1:AA1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:AA1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:AA2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		//set cell A1 content with some text
		$headline = "FORM XIII [See rule 59(2)(a)]\n".$company_name."\nOffice No. 310, 311, 312, Pride Purple Square Kalewadi Phata,\nWakad, Pune- 411057";
		$CI->excel->getActiveSheet()->setCellValue('A2', $headline);
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);

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
		$CI->excel->getActiveSheet()->mergeCells('A2:AA2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:AA2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Name of Workman'); 
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Serial No.');		
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Designation');		
		$CI->excel->getActiveSheet()->setCellValue('E3', 'No. of days worked');
		$CI->excel->getActiveSheet()->setCellValue('F3', 'O. T. Hrs');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Wage Rate');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'Units of Work done');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'Piece Rate');
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Basic Wages');
		$CI->excel->getActiveSheet()->setCellValue('K3', 'Dearness Allowance');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Over time');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'Other Cash Payments');
		$CI->excel->getActiveSheet()->setCellValue('N3', 'Total');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Advance');
		$CI->excel->getActiveSheet()->setCellValue('P3', 'Professional Tax'); 
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'ESI'); 
		$CI->excel->getActiveSheet()->setCellValue('R3', 'Provident Fund');
		$CI->excel->getActiveSheet()->setCellValue('S3', 'Family Pension Fund');
		$CI->excel->getActiveSheet()->setCellValue('T3', 'Canteen');
		$CI->excel->getActiveSheet()->setCellValue('U3', 'Dhobi');
		$CI->excel->getActiveSheet()->setCellValue('V3', 'Others');
		$CI->excel->getActiveSheet()->setCellValue('W3', 'Total');
		$CI->excel->getActiveSheet()->setCellValue('X3', 'Net amount paid');
		$CI->excel->getActiveSheet()->setCellValue('Y3', 'Signature / Thumb Impression of workman');
		$CI->excel->getActiveSheet()->setCellValue('Z3', 'Initials of contractor or his respresentative');
		$CI->excel->getActiveSheet()->setCellValue('AA3', 'Initials of Principal Employer');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(55);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(23);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(8);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(30);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:AA3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:AA3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:AA3')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A3:AA3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);;

		/* start dynamic code from here *********/
		$lastRowNum=4;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
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
	 		$DA_total = 0;
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
			$education_total=0;
			$adv_opening = 0;
			$adv_Addition = 0;
			$adv_recovery = 0;
			$pf_deduct = 0;
			$ESIC_deduct = 0;
			$tot_ESIC_deduct = 0;
			$tot_pf_deduct = 0;
			$total_deduct_mnth = 0;
			//emp info
			$emp_bac = 0;
			$emp_da = 0;
			$emp_hra = 0;
			$emp_convy = 0;
			$emp_mob = 0;
			$emp_med = 0;
			$emp_edu = 0;
			$emp_city = 0;
			$emp_enter = 0;
			$bonus_value=0;
	 		$sr=1;
			 $other_allow=0;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$netBasicTotK = 0;
	 			$emp_wise_ded=0;
	 			$boun_emp = 0;
				
	 			$emp_wise_add_deduction = 0;

	 			$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
	 		 	
				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->employee_id);
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->desig_id);
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$key->work_day);
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,'NA');
				$CI->excel->getActiveSheet()->setCellValue('G'.$j,'NA');
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('I'.$j,'NA');
				
				$bsc = $key->basic_amt/$num_days_of_month;
				$basic = $key->work_day*$bsc;
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,round($basic));
				$emp_bac = $emp_bac + round($basic);

				$da = $key->special_allowance/$num_days_of_month;
				$sa = $key->work_day*$da;
				$CI->excel->getActiveSheet()->setCellValue('K'.$j,round($sa));
				$emp_da = $emp_da + round($sa); 
				$da = $sa;
				$bonus_value=0;
				$CI->excel->getActiveSheet()->setCellValue('L'.$j,'-');

				/*$allowances = $key->allowances;
				$oa = $key->allowances/$num_days_of_month;
				$other_allow = $key->work_day*$oa;*/
				if(isset($emp_allData) && !empty($emp_allData))
				{					
					$other_allow=0;
					$bonus_value=0;
					foreach ($emp_allData as $row)
					{
						if ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;						
						}elseif($row->earning_id == 15)
						{
							//Bonus
							$bonus_value = $row->value / $num_days_of_month * $key->work_day; 
						}
					}
				}
				$last_val1 = $key->hra/$num_days_of_month;
				$value1 = $key->work_day*$last_val1;
				$other_allow1 = $value1;

				$last_val2 = $key->convey/$num_days_of_month;
				$value2 = $key->work_day*$last_val2;
				$other_allow2 = $value2;
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,round($other_allow+$other_allow1+$other_allow2+$bonus_value));
				$net_basic_total = $net_basic_total+round($other_allow+$other_allow1+$other_allow2+$bonus_value);
				
				
				//$total_earn = $other_allow+$da+$basic+$key->hra+$key->convey;
				$total_earn = $other_allow+$da+$basic+$other_allow1+$other_allow2+$bonus_value;
				
				$CI->excel->getActiveSheet()->setCellValue('N'.$j,round($total_earn));
				$allowance_total_emp = $allowance_total_emp+round($total_earn);
				
				$CI->excel->getActiveSheet()->setCellValue('O'.$j,round($key->advance_recovery));
				$adv_recovery = $adv_recovery + round($key->advance_recovery);
				
				//DEDUCATION
				if($key->pt_amt>0)
				{
					if($total_earn<=7500)
					{
						$pt = 0;
					}elseif($total_earn<=10000 && $total_earn>=7500)
					{
						if($key->gender=='Female')
						{
							$pt=0;
						}else{
							$pt = 175;
						}
					}elseif($total_earn>10000)
					{
						if($month=='February')
						{
							$pt = 300;
						}else{
							$pt = 200;
						}
					}
				}else{
					$pt = 0;
				}

				$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($pt));
				$pt_total = $pt_total + $pt;

				$esicd_val = $key->ESIC_deduct/$num_days_of_month;
				$esic_dedct = $key->work_day*$esicd_val;
				$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($esic_dedct));
				$tot_ESIC_deduct=$tot_ESIC_deduct+round($esic_dedct);

				$pfd_val = $key->pf_deduct/$num_days_of_month;
				$pf_dedct = $pfd_val*$key->work_day;//$pf_dedct = ($da+$basic)*0.12;//$key->work_day*$pfd_val;
				$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($pf_dedct));
				$tot_pf_deduct=$tot_pf_deduct+round($pf_dedct);

				
				$CI->excel->getActiveSheet()->setCellValue('S'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('T'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('U'.$j,'-');

				$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($key->mobile_deduction+$key->other_deduct));
				$mobile_ded_total = $mobile_ded_total + round($key->mobile_deduction+$key->other_deduct);
				
				$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
				$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($total_deduction));
				$total_deduct_mnth = $total_deduct_mnth + round($total_deduction);

				//earning arrers
				$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($total_earn-$total_deduction+$key->allowances));
				$Arrears_total = $Arrears_total + round($total_earn-$total_deduction+$key->allowances);

				$CI->excel->getActiveSheet()->setCellValue('Y'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('Z'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AA'.$j,'-');


				$CI->excel->getActiveSheet()->getStyle('E'.$j.':AA'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);
				$CI->excel->getActiveSheet()->getStyle('D'.$j.':D'.$j)->getAlignment()->setWrapText(true);
				$j++;
				
			}

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AA'.$lastRowNum)->getFont()->setBold(true);
			$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':E'.$lastRowNum)
										->setCellValue('A'.$lastRowNum, 'Total');

			$CI->excel->getActiveSheet()->setCellValue('F'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('G'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('H'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('I'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('J'.$lastRowNum, round($emp_bac));
			$CI->excel->getActiveSheet()->setCellValue('K'.$lastRowNum, round($emp_da));
			$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, round($net_basic_total));
			$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, round($allowance_total_emp));
			$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, round($adv_recovery));
			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($pt_total));

			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($tot_ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($tot_pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, '');

			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($mobile_ded_total));
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($total_deduct_mnth));
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($Arrears_total));
			$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, '');

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AA'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AA'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':AA'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

			$lastRowNum = $lastRowNum+2;

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('test_img');
			$objDrawing->setDescription('test_img');
			$objDrawing->setPath('./images/logo/stamp.jpg');
			$objDrawing->setCoordinates('D'.$lastRowNum);                      
			//setOffsetX works properly
			$objDrawing->setOffsetX(5); 
			$objDrawing->setOffsetY(5);                
			//set width, height
			$objDrawing->setWidth(100); 
			$objDrawing->setHeight(150); 
			$objDrawing->setWorksheet($CI->excel->getActiveSheet());

		}
		/* end dynamic code here **************/
		$filename = 'Register of Wages - '.$month.' '.$year.'.xls'; //save our workbook as this file name	
		
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

    function gen_leave_wages_register($emp_leave_data,$emp_data,$years)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Leave with Wages Register');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', 'Leave with Wages Register [Form No. 20]'); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

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
		$CI->excel->getActiveSheet()->mergeCells('A1:R1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:R1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:R2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('A2:F2');
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Name of Worker : ' .$emp_data->emp_name);

		$CI->excel->getActiveSheet()->mergeCells('A3:C3');
		$CI->excel->getActiveSheet()->setCellValue('A3', 'Ticket No :');

		$CI->excel->getActiveSheet()->mergeCells('D3:F3');
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Occupation :');

		$CI->excel->getActiveSheet()->mergeCells('A4:F5');
		$CI->excel->getActiveSheet()->setCellValue('A4', 'Name of the factory : ' .$emp_data->company_name);
		$CI->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);

		$CI->excel->getActiveSheet()->mergeCells('A6:F6');
		$CI->excel->getActiveSheet()->setCellValue('A6', 'Department : ' .$emp_data->dept_master_name);

		$CI->excel->getActiveSheet()->mergeCells('G2:L2');
		$CI->excel->getActiveSheet()->setCellValue('G2', 'Fathers Name : ' .$emp_data->middlename);

		$CI->excel->getActiveSheet()->mergeCells('G3:L3');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Normal Rate of wages : ');

		$CI->excel->getActiveSheet()->mergeCells('G4:L4');
		$CI->excel->getActiveSheet()->setCellValue('G4', 'Page No. Old/New : ');

		$CI->excel->getActiveSheet()->mergeCells('G5:L5');
		$CI->excel->getActiveSheet()->setCellValue('G5', 'Date of entry into service : ');

		$CI->excel->getActiveSheet()->mergeCells('G6:L6');
		$CI->excel->getActiveSheet()->setCellValue('G6','Serial No. ............................. from Adult/Children workers register.');

		$CI->excel->getActiveSheet()->mergeCells('M2:R2');
		$CI->excel->getActiveSheet()->setCellValue('M2', 'Date of Discharge : ');

		$CI->excel->getActiveSheet()->mergeCells('M3:N5');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'Date and amount of payment made in lieu of leavewith wages etc.');
		$CI->excel->getActiveSheet()->getStyle('M3')->getAlignment()->setWrapText(true);

		$CI->excel->getActiveSheet()->mergeCells('O3:P3');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Date');
		$CI->excel->getActiveSheet()->mergeCells('O4:P5');
		$CI->excel->getActiveSheet()->setCellValue('O4', '');

		$CI->excel->getActiveSheet()->mergeCells('Q3:R3');
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'Amount');
		$CI->excel->getActiveSheet()->mergeCells('Q4:R5');
		$CI->excel->getActiveSheet()->setCellValue('Q4', '');

		$CI->excel->getActiveSheet()->getStyle('O3:R3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('M6:R6');
		$CI->excel->getActiveSheet()->setCellValue('M6', 'Remarks : ');

		$CI->excel->getActiveSheet()->mergeCells('A7:R7');
		$CI->excel->getActiveSheet()->getStyle('A2:R7')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:R7')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A2:R7')->getFont()->setSize(11);
		$CI->excel->getActiveSheet()->getRowDimension('7')->setRowHeight(5);

		$CI->excel->getActiveSheet()->setCellValue('A8', 'Year'); 
		$CI->excel->getActiveSheet()->setCellValue('B8', 'Month'); 
		$CI->excel->getActiveSheet()->setCellValue('C8', 'No. of days work performed');		
		$CI->excel->getActiveSheet()->setCellValue('D8', 'No. of days of lay-off');		
		$CI->excel->getActiveSheet()->setCellValue('E8', 'No. of days of maternity leave with wages');
		$CI->excel->getActiveSheet()->setCellValue('F8', 'No. of days leave with wages enjoyed');
		$CI->excel->getActiveSheet()->setCellValue('G8', 'Total');

		$CI->excel->getActiveSheet()->setCellValue('H8', 'Balance of leave with wages from preceding year');
		$CI->excel->getActiveSheet()->setCellValue('I8', 'Leave with wages earned during this year');
		$CI->excel->getActiveSheet()->setCellValue('J8', 'Total');

		$CI->excel->getActiveSheet()->setCellValue('K8', 'Whether leave with wages refused');
		$CI->excel->getActiveSheet()->setCellValue('L8', 'Whether leave with wages not desired during the next calender year');
		$CI->excel->getActiveSheet()->setCellValue('M8', 'Leave with wages enjoyed from');
		$CI->excel->getActiveSheet()->setCellValue('N8', 'Leave with wages enjoyed to');

		$CI->excel->getActiveSheet()->setCellValue('O8', 'Balance to credit');
		$CI->excel->getActiveSheet()->setCellValue('P8', 'Normal rate of wages'); 
		$CI->excel->getActiveSheet()->setCellValue('Q8', 'Cash equivalent or advvantage accruing throught concessional sale of foodgrains or other articles'); 
		$CI->excel->getActiveSheet()->setCellValue('R8', 'Rate of wages for leave wages period');

		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(7);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(10);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(8);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(8);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(10);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A8:R8')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A8:R8')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A8:R8')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A8:R8')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A8:R8')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A8:R8')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A8:R8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);;

		/* start dynamic code from here *********/
		$lastRowNum=9;
 		if (isset($emp_leave_data) && !empty($emp_leave_data))
 		{
	 		$j=9;
	 		$lastRowNum= $lastRowNum + count($emp_leave_data);
	 		$sr=1;
	 		$total_num_days_of_month=0;
	 		$total_absent_day=0;
	 		$total_leave=0;
	 		foreach ($emp_leave_data as $key)
	 		{
	 			if($sr==1)
	 			{
	 				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$years);
	 			}	 			
	 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->month);
	 			if(!empty($key->mnth))
	 			{
	 				$num_days_of_month = date(' t ', strtotime($key->year."-".$key->mnth."-".$key->mnth));
	 			}else{
	 				$num_days_of_month = 0;
	 			}
	 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,$num_days_of_month);
	 			$total_num_days_of_month = $total_num_days_of_month+$num_days_of_month;

	 			$absent_day = $num_days_of_month-$key->Present_days;
	 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,$absent_day);
	 			$total_absent_day = $total_absent_day+$absent_day;

	 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,'-');
	 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,'-');

	 			$leave = $num_days_of_month-$absent_day;
	 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,$leave);
				$total_leave = $total_leave+$leave;

				$CI->excel->getActiveSheet()->setCellValue('H'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('I'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('K'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('L'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('N'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('O'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('P'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('Q'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('R'.$j,'-');

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':R'.$j)->applyFromArray($allborders);
				$CI->excel->getActiveSheet()->getStyle('C'.$j.':R'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

				$sr++;
				$j++;				
			}
			$CI->excel->getActiveSheet()->setCellValue('A'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('B'.$lastRowNum, 'Total');
			$CI->excel->getActiveSheet()->setCellValue('C'.$lastRowNum, $total_num_days_of_month);
			$CI->excel->getActiveSheet()->setCellValue('D'.$lastRowNum, $total_absent_day);
			$CI->excel->getActiveSheet()->setCellValue('E'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('F'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('G'.$lastRowNum, $total_leave);
			$CI->excel->getActiveSheet()->setCellValue('H'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('I'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('J'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('K'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, '');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':R'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':R'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':R'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

			$lastRowNum = $lastRowNum+2;

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('test_img');
			$objDrawing->setDescription('test_img');
			$objDrawing->setPath('./images/logo/stamp.jpg');
			$objDrawing->setCoordinates('D'.$lastRowNum);                      
			//setOffsetX works properly
			$objDrawing->setOffsetX(5); 
			$objDrawing->setOffsetY(5);                
			//set width, height
			$objDrawing->setWidth(100); 
			$objDrawing->setHeight(150); 
			$objDrawing->setWorksheet($CI->excel->getActiveSheet());
		}

		/* end dynamic code here **************/
		$filename = 'Leave With Wages Register.xls'; //save our workbook as this file name	
		
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

    function gen_advance_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Leave with Wages Register');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', 'Register of Advances [Form No. 18] - '.$month.' '.$year); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

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
		$CI->excel->getActiveSheet()->mergeCells('A1:K1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($allborders);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('A2:F3');
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Name and address of contractor : '.$company_name);

		$CI->excel->getActiveSheet()->mergeCells('A4:F5');
		$CI->excel->getActiveSheet()->setCellValue('A4', 'Nature and location of work : Office No. 310, 311, 312, Pride Purple Square Kalewadi Phata, Wakad, Pune- 411057');

		$CI->excel->getActiveSheet()->mergeCells('G2:K3');
		$CI->excel->getActiveSheet()->setCellValue('G2', 'Name and address of establishment in/under which contract is carried on : ');

		$CI->excel->getActiveSheet()->mergeCells('G4:K5');
		$CI->excel->getActiveSheet()->setCellValue('G4', 'Nature and address of principal Employer : Mr. Ratan Moondra                                          Office No. 310, 311, 312, Pride Purple Square Kalewadi Phata, Wakad, Pune- 411057');

		$CI->excel->getActiveSheet()->getStyle('A2:K6')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->mergeCells('A6:K6');
		$CI->excel->getActiveSheet()->getStyle('A2:K6')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A2:K6')->getFont()->setSize(11);
		$CI->excel->getActiveSheet()->getStyle('A2:K6')->getAlignment()->setWrapText(true);

		$CI->excel->getActiveSheet()->setCellValue('A7', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B7', 'Name'); 
		$CI->excel->getActiveSheet()->setCellValue('C7', 'Fathers / Husbands Name');		
		$CI->excel->getActiveSheet()->setCellValue('D7', 'Nature of employment');		
		$CI->excel->getActiveSheet()->setCellValue('E7', 'Earnings during a wage period');
		$CI->excel->getActiveSheet()->setCellValue('F7', 'Date and amount of advance');
		$CI->excel->getActiveSheet()->setCellValue('G7', 'Purpose for which advance made');
		$CI->excel->getActiveSheet()->setCellValue('H7', 'No of instalments by which advance to be repaid');
		$CI->excel->getActiveSheet()->setCellValue('I7', 'Amount of instalments repaid with date of postponement granted');
		$CI->excel->getActiveSheet()->setCellValue('J7', 'Date on which total amount paid');
		$CI->excel->getActiveSheet()->setCellValue('K7', 'Signature or thumb impression of the worker');

		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('6')->setRowHeight(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(7);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(25);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(15);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(15);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A7:K7')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A7:K7')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A7:K7')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A7:K7')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A7:K7')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A7:K7')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A7:K7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

		/* start dynamic code from here *********/
		$lastRowNum=7;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
	 		$j=8;
	 		$lastRowNum= $lastRowNum + count($emp_basic_data);
	 		$sr=1;
	 		$total_num_days_of_month=0;
	 		$total_absent_day=0;
	 		$total_leave=0;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr);	 			 			
	 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
	 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->middlename);
	 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,'-');
	 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,'-');
	 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,'NIL');
	 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('I'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('K'.$j,'');

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':K'.$j)->applyFromArray($allborders);
				$CI->excel->getActiveSheet()->getStyle('D'.$j.':K'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);
				$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$sr++;
				$j++;				
			}
		}
		$CI->excel->getActiveSheet()->mergeCells('A'.$j.':K'.$j);
		$CI->excel->getActiveSheet()->getRowDimension($j)->setRowHeight(5);
			
		$j = $j+2;
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('test_img');
		$objDrawing->setPath('./images/logo/stamp.jpg');
		$objDrawing->setCoordinates('D'.$j);                      
		//setOffsetX works properly
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);                
		//set width, height
		$objDrawing->setWidth(100); 
		$objDrawing->setHeight(150); 
		$objDrawing->setWorksheet($CI->excel->getActiveSheet());

		/* end dynamic code here **************/
		$filename = 'Register of Advances - '.$month.' '.$year.'.xls'; //save our workbook as this file name
		
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

    function gen_deduction_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Register of Deduction');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', 'Register of Deductions for Damage or Loss [Form No. 16] - '.$month.' '.$year); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

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
		$CI->excel->getActiveSheet()->mergeCells('A1:N1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($allborders);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('A2:G3');
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Name and address of contractor : '.$company_name);

		$CI->excel->getActiveSheet()->mergeCells('A4:G5');
		$CI->excel->getActiveSheet()->setCellValue('A4', 'Nature and location of work : Office No. 310, 311, 312, Pride Purple Square Kalewadi Phata, Wakad, Pune- 411057');

		$CI->excel->getActiveSheet()->mergeCells('H2:N3');
		$CI->excel->getActiveSheet()->setCellValue('H2', 'Name and address of establishment in/under which contract is carried on : ');

		$CI->excel->getActiveSheet()->mergeCells('H4:N5');
		$CI->excel->getActiveSheet()->setCellValue('H4', "Nature and address of principal Employer : Mr. Ratan Moondra\nOffice No. 310, 311, 312, Pride Purple Square Kalewadi Phata, Wakad, Pune- 411057");

		$CI->excel->getActiveSheet()->getStyle('A2:N6')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->mergeCells('A6:N6');
		$CI->excel->getActiveSheet()->getStyle('A2:N6')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A2:N6')->getFont()->setSize(11);
		$CI->excel->getActiveSheet()->getStyle('A2:N6')->getAlignment()->setWrapText(true);

		$CI->excel->getActiveSheet()->setCellValue('A7', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B7', 'Name of workman'); 
		$CI->excel->getActiveSheet()->setCellValue('C7', 'Fathers / Husbands Name');		
		$CI->excel->getActiveSheet()->setCellValue('D7', 'Designation');		
		$CI->excel->getActiveSheet()->setCellValue('E7', 'Particulars of damage or loss');
		$CI->excel->getActiveSheet()->setCellValue('F7', 'Date of damage or loss');
		$CI->excel->getActiveSheet()->setCellValue('G7', 'Whether worker showed cause against deducation');
		$CI->excel->getActiveSheet()->setCellValue('H7', 'Name of person in whose presence employees explanation was heard');
		$CI->excel->getActiveSheet()->setCellValue('I7', 'Amount of deductions imposed');
		$CI->excel->getActiveSheet()->setCellValue('J7', 'No. of instalments');
		$CI->excel->getActiveSheet()->setCellValue('K7', 'Date of recovery of First Instalment');
		$CI->excel->getActiveSheet()->setCellValue('L7', 'Date of recovery of Last Instalment');
		$CI->excel->getActiveSheet()->setCellValue('M7', 'Remarks');
		$CI->excel->getActiveSheet()->setCellValue('N7', 'Signature of the Employer or his representative');

		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('6')->setRowHeight(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(7);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(25);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(28);							
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
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A7:N7')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A7:N7')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A7:N7')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A7:N7')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A7:N7')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A7:N7')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A7:N7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

		/* start dynamic code from here *********/
		$lastRowNum=7;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
	 		$j=8;
	 		$lastRowNum= $lastRowNum + count($emp_basic_data);
	 		$sr=1;
	 		$total_num_days_of_month=0;
	 		$total_absent_day=0;
	 		$total_leave=0;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr);	 			 			
	 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
	 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->middlename);
	 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->desig_id);
	 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,'NIL');
	 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,'NIL');
	 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('I'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('K'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('L'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('N'.$j,'');

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':N'.$j)->applyFromArray($allborders);
				$CI->excel->getActiveSheet()->getStyle('E'.$j.':N'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);
				$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$sr++;
				$j++;				
			}
		}
		$CI->excel->getActiveSheet()->mergeCells('A'.$j.':N'.$j);
		$CI->excel->getActiveSheet()->getRowDimension($j)->setRowHeight(5);

		$j = $j+2;
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('test_img');
		$objDrawing->setPath('./images/logo/stamp.jpg');
		$objDrawing->setCoordinates('D'.$j);                      
		//setOffsetX works properly
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);                
		//set width, height
		$objDrawing->setWidth(100); 
		$objDrawing->setHeight(150); 
		$objDrawing->setWorksheet($CI->excel->getActiveSheet());

		/* end dynamic code here **************/
		$filename = 'Register of Deduction - '.$month.' '.$year.'.xls'; //save our workbook as this file name
		
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

    function gen_overtime_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Register of Overtime');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', 'Register of Overtime [Form No. 19] - '.$month.' '.$year); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

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
		$CI->excel->getActiveSheet()->mergeCells('A1:Q1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($allborders);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('A2:H3');
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Name and address of contractor : '.$company_name);

		$CI->excel->getActiveSheet()->mergeCells('A4:H5');
		$CI->excel->getActiveSheet()->setCellValue('A4', 'Nature and location of work : Office No. 310, 311, 312, Pride Purple Square Kalewadi Phata, Wakad, Pune- 411057');

		$CI->excel->getActiveSheet()->mergeCells('I2:Q3');
		$CI->excel->getActiveSheet()->setCellValue('I2', 'Name and address of establishment in/under which contract is carried on : ');

		$CI->excel->getActiveSheet()->mergeCells('I4:Q5');
		$CI->excel->getActiveSheet()->setCellValue('I4', "Nature and address of principal Employer : Mr. Ratan Moondra\nOffice No. 310, 311, 312, Pride Purple Square Kalewadi Phata, Wakad, Pune- 411057");

		$CI->excel->getActiveSheet()->getStyle('A2:Q6')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->mergeCells('A6:Q6');
		$CI->excel->getActiveSheet()->getStyle('A2:Q6')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A2:Q6')->getFont()->setSize(11);
		$CI->excel->getActiveSheet()->getStyle('A2:Q6')->getAlignment()->setWrapText(true);

		$CI->excel->getActiveSheet()->setCellValue('A7', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B7', 'Name of workman'); 
		$CI->excel->getActiveSheet()->setCellValue('C7', 'Fathers / Husbands Name');
		$CI->excel->getActiveSheet()->setCellValue('D7', 'Sex');		
		$CI->excel->getActiveSheet()->setCellValue('E7', 'Designation');		
		$CI->excel->getActiveSheet()->setCellValue('F7', 'Date on which overtime work was put in');
		$CI->excel->getActiveSheet()->setCellValue('G7', 'Wages of overtime on each occasion');
		$CI->excel->getActiveSheet()->setCellValue('H7', 'Total overtime worked or production in case of piece-rates');
		$CI->excel->getActiveSheet()->setCellValue('I7', 'Normal hours');
		$CI->excel->getActiveSheet()->setCellValue('J7', 'Normal rate');
		$CI->excel->getActiveSheet()->setCellValue('K7', 'Overtime rate');
		$CI->excel->getActiveSheet()->setCellValue('L7', 'Normal Earnings');
		$CI->excel->getActiveSheet()->setCellValue('M7', 'Overtime earining');
		$CI->excel->getActiveSheet()->setCellValue('N7', 'Total Earning');
		$CI->excel->getActiveSheet()->setCellValue('O7', 'Date on which overtime payment made');
		$CI->excel->getActiveSheet()->setCellValue('P7', 'Initials of contractor or his representative');
		$CI->excel->getActiveSheet()->setCellValue('Q7', 'Initials of authorised representative or principal employer');

		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('6')->setRowHeight(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(7);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(23);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(10);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(28);	
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
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A7:Q7')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A7:Q7')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A7:Q7')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A7:Q7')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A7:Q7')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A7:Q7')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A7:Q7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

		/* start dynamic code from here *********/
		$lastRowNum=7;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
	 		$j=8;
	 		$lastRowNum= $lastRowNum + count($emp_basic_data);
	 		$sr=1;
	 		$total_num_days_of_month=0;
	 		$total_absent_day=0;
	 		$total_leave=0;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr);	 			 			
	 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
	 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->middlename);
	 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->gender);
	 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,$key->desig_id);
	 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,'NIL');
	 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('I'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('K'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('L'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('N'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('O'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('P'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('Q'.$j,'');

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':Q'.$j)->applyFromArray($allborders);
				$CI->excel->getActiveSheet()->getStyle('F'.$j.':Q'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);
				$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$sr++;
				$j++;				
			}
		}
		$CI->excel->getActiveSheet()->mergeCells('A'.$j.':Q'.$j);
		$CI->excel->getActiveSheet()->getRowDimension($j)->setRowHeight(5);

		$j = $j+2;
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('test_img');
		$objDrawing->setPath('./images/logo/stamp.jpg');
		$objDrawing->setCoordinates('D'.$j);                      
		//setOffsetX works properly
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);                
		//set width, height
		$objDrawing->setWidth(100); 
		$objDrawing->setHeight(150); 
		$objDrawing->setWorksheet($CI->excel->getActiveSheet());

		/* end dynamic code here **************/
		$filename = 'Register of Overtime - '.$month.' '.$year.'.xls'; //save our workbook as this file name
		
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

    function gen_fines_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Register of Fines');
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', 'Register of Fines [Form No. 17] - '.$month.' '.$year); //$employee_basic_info->emp_comp_name
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

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
		$CI->excel->getActiveSheet()->mergeCells('A1:L1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($allborders);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$CI->excel->getActiveSheet()->mergeCells('A2:F3');
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Name and address of contractor : '.$company_name);

		$CI->excel->getActiveSheet()->mergeCells('A4:F5');
		$CI->excel->getActiveSheet()->setCellValue('A4', 'Nature and location of work : Office No. 310, 311, 312, Pride Purple Square Kalewadi Phata, Wakad, Pune- 411057');

		$CI->excel->getActiveSheet()->mergeCells('G2:L3');
		$CI->excel->getActiveSheet()->setCellValue('G2', 'Name and address of establishment in/under which contract is carried on : ');

		$CI->excel->getActiveSheet()->mergeCells('G4:L5');
		$CI->excel->getActiveSheet()->setCellValue('G4', "Nature and address of principal Employer : Mr. Ratan Moondra\nOffice No. 310, 311, 312, Pride Purple Square Kalewadi Phata, Wakad, Pune- 411057");

		$CI->excel->getActiveSheet()->getStyle('A2:L6')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->mergeCells('A6:L6');
		$CI->excel->getActiveSheet()->getStyle('A2:L6')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A2:L6')->getFont()->setSize(11);
		$CI->excel->getActiveSheet()->getStyle('A2:L6')->getAlignment()->setWrapText(true);

		$CI->excel->getActiveSheet()->setCellValue('A7', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B7', 'Name of workman'); 
		$CI->excel->getActiveSheet()->setCellValue('C7', 'Fathers / Husbands Name');
		$CI->excel->getActiveSheet()->setCellValue('D7', 'Designation');		
		$CI->excel->getActiveSheet()->setCellValue('E7', 'Act / Omission for which fine imposed');		
		$CI->excel->getActiveSheet()->setCellValue('F7', 'Date of offence');
		$CI->excel->getActiveSheet()->setCellValue('G7', 'Whether employees showed cause against fine');
		$CI->excel->getActiveSheet()->setCellValue('H7', 'Name of person in whose presence employees explanation was heard (in case of contractors)');
		$CI->excel->getActiveSheet()->setCellValue('I7', 'Rate of wages');
		$CI->excel->getActiveSheet()->setCellValue('J7', 'Amount of fine imposed');
		$CI->excel->getActiveSheet()->setCellValue('K7', 'Date on which fine realised');
		$CI->excel->getActiveSheet()->setCellValue('L7', 'Remarks');

		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('6')->setRowHeight(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(7);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(23);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(28);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(15);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A7:L7')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A7:L7')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A7:L7')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A7:L7')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A7:L7')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A7:L7')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A7:L7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

		/* start dynamic code from here *********/
		$lastRowNum=7;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
	 		$j=8;
	 		$lastRowNum= $lastRowNum + count($emp_basic_data);
	 		$sr=1;
	 		$total_num_days_of_month=0;
	 		$total_absent_day=0;
	 		$total_leave=0;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$earn_allowance=0;
	 			$allowance = $CI->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->emp);
				foreach($allowance as $row)
	 			{
	 				$earn_allowance = $earn_allowance + $row->earn_value;
	 			}

	 			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr);	 			 			
	 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
	 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->middlename);
	 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->desig_id);
	 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,'NIL');
	 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,'NIL');
	 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,'NIL');				
				$CI->excel->getActiveSheet()->setCellValue('I'.$j,'NIL');
				//$CI->excel->getActiveSheet()->setCellValue('I'.$j,round($earn_allowance+$key->emp_basic));
				//$CI->excel->getActiveSheet()->getStyle('I'.$j)->getNumberFormat()->setFormatCode('#,##0.00');
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('K'.$j,'NIL');
				$CI->excel->getActiveSheet()->setCellValue('L'.$j,'NIL');

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':L'.$j)->applyFromArray($allborders);
				$CI->excel->getActiveSheet()->getStyle('E'.$j.':L'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);
				$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$sr++;
				$j++;				
			}
		}
		$CI->excel->getActiveSheet()->mergeCells('A'.$j.':L'.$j);
		$CI->excel->getActiveSheet()->getRowDimension($j)->setRowHeight(5);

		$j = $j+2;
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('test_img');
		$objDrawing->setPath('./images/logo/stamp.jpg');
		$objDrawing->setCoordinates('D'.$j);                      
		//setOffsetX works properly
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);                
		//set width, height
		$objDrawing->setWidth(100); 
		$objDrawing->setHeight(150); 
		$objDrawing->setWorksheet($CI->excel->getActiveSheet());
		
		/* end dynamic code here **************/
		$filename = 'Register of Fines - '.$month.' '.$year.'.xls'; //save our workbook as this file name
		
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

    // function gen_muster_wage_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year,$salMonth)
    // {
    // 	$CI =& get_instance(); 
    // 	/*date_default_timezone_set('Asia/kolkata');*/
    // 	$current_date = date('d/m/Y');
    // 	$CI->load->library('excel');

	// 	$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
	// 						 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
	// 						 	   ->setTitle("Pay Slip")
	// 						 	   ->setSubject("Pay Slip Of An Employee")
	// 						 	   ->setDescription("System Generated File.")
	// 						 	   ->setKeywords("office 2007")
	// 						 	   ->setCategory("Confidential");

	// 	$allborders = array(
	// 		'borders' => array(
	// 			'allborders' => array(
	// 				'style' => PHPExcel_Style_Border::BORDER_THIN,
					
	// 			),
	// 		),
	// 	);
	// 	//activate worksheet number 1
	// 	$CI->excel->setActiveSheetIndex(0);
	// 	//name the worksheet
	// 	$CI->excel->getActiveSheet()->setTitle('RoW - '.$month.' '.$year);
	// 	//set cell A1 content with some text
	// 	$CI->excel->getActiveSheet()->setCellValue('A1', 'Form II - Muster Roll cum Wage Register - '.$month.' '.$year.''); //$employee_basic_info->emp_comp_name
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	// 	//set row height
	// 	$CI->excel->getActiveSheet()->getRowDimension('1')
	// 								->setRowHeight(20);
	// 	/*  set default border for all stylesheet */
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getTop()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getBottom()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getLeft()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getRight()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	/*  End set default border for all stylesheet */

	// 	//merge cell A1 until D1
	// 	$CI->excel->getActiveSheet()->mergeCells('A1:BD1')
	// 								->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');
	// 	$CI->excel->getActiveSheet()->getStyle('A1:BD1')->applyFromArray($allborders);

	// 	$CI->excel->getActiveSheet()->getStyle('A2:BD2')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	// 	//set aligment to center for that merged cell (A1 to V1)
	// 	$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	// 	//set cell A1 content with some text
	// 	$headline = "[See Rule 27(1)]\n".$company_name."\nOffice No. 310, 311, 312, Pride Purple Square Kalewadi Phata,\nWakad, Pune- 411057";
	// 	$CI->excel->getActiveSheet()->setCellValue('A2', $headline);
	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(10);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);

	// 	/*  set default border for all stylesheet */
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getTop()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getBottom()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getLeft()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	$CI->excel->getDefaultStyle()
	// 	    ->getBorders()
	// 	    ->getRight()
	// 	    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	// 	/*  End set default border for all stylesheet */

	// 	//merge cell A1 until D1
	// 	$CI->excel->getActiveSheet()->mergeCells('A2:BD2')
	// 								->getStyle()
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FFD8D8D8');


	// 	$CI->excel->getActiveSheet()->getStyle('A2:BD2')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	// 	//set aligment to center for that merged cell (A1 to V1)
	// 	$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


	// 	$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('B3', 'Full name of the employee'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('C3', 'Age and sex');		
	// 	$CI->excel->getActiveSheet()->setCellValue('D3', 'Nature of work and Designation');		
	// 	$CI->excel->getActiveSheet()->setCellValue('E3', 'Date of entry into service');
	// 	$CI->excel->getActiveSheet()->setCellValue('F3', 'Working hours From To');
	// 	$CI->excel->getActiveSheet()->setCellValue('G3', 'Intervals for rest or meal From To');
	// 	$CI->excel->getActiveSheet()->setCellValue('H3', '1');
	// 	$CI->excel->getActiveSheet()->setCellValue('I3', '2');
	// 	$CI->excel->getActiveSheet()->setCellValue('J3', '3');
	// 	$CI->excel->getActiveSheet()->setCellValue('K3', '4');
	// 	$CI->excel->getActiveSheet()->setCellValue('L3', '5');
	// 	$CI->excel->getActiveSheet()->setCellValue('M3', '6');
	// 	$CI->excel->getActiveSheet()->setCellValue('N3', '7');
	// 	$CI->excel->getActiveSheet()->setCellValue('O3', '8');
	// 	$CI->excel->getActiveSheet()->setCellValue('P3', '9'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('Q3', '10'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('R3', '11');
	// 	$CI->excel->getActiveSheet()->setCellValue('S3', '12');
	// 	$CI->excel->getActiveSheet()->setCellValue('T3', '13');
	// 	$CI->excel->getActiveSheet()->setCellValue('U3', '14');
	// 	$CI->excel->getActiveSheet()->setCellValue('V3', '15');
	// 	$CI->excel->getActiveSheet()->setCellValue('W3', '16');
	// 	$CI->excel->getActiveSheet()->setCellValue('X3', '17');
	// 	$CI->excel->getActiveSheet()->setCellValue('Y3', '18');
	// 	$CI->excel->getActiveSheet()->setCellValue('Z3', '19');
	// 	$CI->excel->getActiveSheet()->setCellValue('AA3', '20');
	// 	$CI->excel->getActiveSheet()->setCellValue('AB3', '21'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('AC3', '22');		
	// 	$CI->excel->getActiveSheet()->setCellValue('AD3', '23');		
	// 	$CI->excel->getActiveSheet()->setCellValue('AE3', '24');
	// 	$CI->excel->getActiveSheet()->setCellValue('AF3', '25');
	// 	$CI->excel->getActiveSheet()->setCellValue('AG3', '26');
	// 	$CI->excel->getActiveSheet()->setCellValue('AH3', '27');
	// 	$CI->excel->getActiveSheet()->setCellValue('AI3', '28');
	// 	$CI->excel->getActiveSheet()->setCellValue('AJ3', '29');
	// 	$CI->excel->getActiveSheet()->setCellValue('AK3', '30');
	// 	$CI->excel->getActiveSheet()->setCellValue('AL3', '31');
	// 	$CI->excel->getActiveSheet()->setCellValue('AM3', 'Total days worked');
	// 	/*$CI->excel->getActiveSheet()->setCellValue('AN3', 'Minimum rates of wages payable');
	// 	$CI->excel->getActiveSheet()->setCellValue('AO3', 'Actual rates of wages payable');
	// 	$CI->excel->getActiveSheet()->setCellValue('AP3', 'Total production in case of piece rate');
	// 	$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Total overtime hours worked');
	// 	$CI->excel->getActiveSheet()->setCellValue('AR3', 'Normal wages');
	// 	$CI->excel->getActiveSheet()->setCellValue('AS3', 'Rate of HRA');
	// 	$CI->excel->getActiveSheet()->setCellValue('AT3', 'HRA Payable');
	// 	$CI->excel->getActiveSheet()->setCellValue('AU3', 'Overtime earnings');
	// 	$CI->excel->getActiveSheet()->setCellValue('AV3', 'Gross wages payable');
	// 	$CI->excel->getActiveSheet()->setCellValue('AW3', 'Deduction Advances Fines Damages');
	// 	$CI->excel->getActiveSheet()->setCellValue('AX3', 'Net wages paid');
	// 	$CI->excel->getActiveSheet()->setCellValue('AY3', 'Previous Balance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AZ3', 'Earned during the month');
	// 	$CI->excel->getActiveSheet()->setCellValue('BA3', 'Availed during the month');
	// 	$CI->excel->getActiveSheet()->setCellValue('BB3', 'Balance at the end of the month');*/
	// 	$CI->excel->getActiveSheet()->setCellValue('AN3', 'Basic Wages');
	// 	$CI->excel->getActiveSheet()->setCellValue('AO3', 'Dearness Allowance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AP3', 'Over time');
	// 	$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Other Cash Payments');
	// 	$CI->excel->getActiveSheet()->setCellValue('AR3', 'Total');
	// 	$CI->excel->getActiveSheet()->setCellValue('AS3', 'Advance');
	// 	$CI->excel->getActiveSheet()->setCellValue('AT3', 'Professional Tax'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('AU3', 'ESI'); 
	// 	$CI->excel->getActiveSheet()->setCellValue('AV3', 'Provident Fund');
	// 	$CI->excel->getActiveSheet()->setCellValue('AW3', 'Family Pension Fund');
	// 	$CI->excel->getActiveSheet()->setCellValue('AX3', 'Canteen');
	// 	$CI->excel->getActiveSheet()->setCellValue('AY3', 'Dhobi');
	// 	$CI->excel->getActiveSheet()->setCellValue('AZ3', 'Others');
	// 	$CI->excel->getActiveSheet()->setCellValue('BA3', 'Total');
	// 	$CI->excel->getActiveSheet()->setCellValue('BB3', 'Net amount paid');
	// 	$CI->excel->getActiveSheet()->setCellValue('BC3', 'Date of payment of wages');
	// 	$CI->excel->getActiveSheet()->setCellValue('BD3', 'Signature of thumb impression of the employee');


	// 	$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
	// 	$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(55);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(23);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(8);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(30);							
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(14);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(20);	
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(20);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(5);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(12);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(43)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(44)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(45)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(46)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(47)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(48)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(49)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(50)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(51)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(52)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(53)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(54)->setWidth(15);
	// 	$CI->excel->getActiveSheet()->getColumnDimensionByColumn(55)->setWidth(15);
	// 	/************ Wrap A2 V3 content */  

	// 	//change the font name
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BD3')->getFont()->setName('Bookman Old Style');
    //     //change the font size
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BD3')->getFont()->setSize(10);
	// 	//make the font become bold
	// 	$CI->excel->getActiveSheet()->getStyle('A2:BD3')->getFont()->setBold(true);															
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BD3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BD3')
	// 								->getFill()
	// 								->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 								->getStartColor()->setARGB('FF428bca');
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BD3')->applyFromArray($allborders);
	// 	$CI->excel->getActiveSheet()->getStyle('A3:BD3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);;

	// 	/* start dynamic code from here *********/
	// 	$net_basic_total=0;
 	// 	$net_basic_totalE=0;
 	// 	$salBefoPt_total=0;
 	// 	$pt_total=0;
 	// 	$net_with_pt_total=0;
 	// 	$total_deduction=0;
 	// 	$Conveyance_total=0;
 	// 	$mobile_total=0;
 	// 	$HRA_total = 0;
 	// 	$DA_total = 0;
 	// 	$otherAllow_total=0;
 	// 	$Arrears_total=0;
 	// 	$allowance_total_emp = 0;
 	// 	$allowance_ded_total_emp = 0;
	// 	$mobile_ded_total = 0;
	// 	$ArrOther_ded_total = 0;
	// 	$Bonus_total = 0;
	// 	$Advance_total = 0;
	// 	$per_emp_advance=0;
	// 	$deduct_adv_total=0;
	// 	$Advance_deduction=0;
	// 	$medical_total=0;
	// 	$city_total=0;
	// 	$education_total=0;
	// 	$adv_opening = 0;
	// 	$adv_Addition = 0;
	// 	$adv_recovery = 0;
	// 	$pf_deduct = 0;
	// 	$ESIC_deduct = 0;
	// 	$tot_ESIC_deduct = 0;
	// 	$tot_pf_deduct = 0;
	// 	$total_deduct_mnth = 0;
	// 	//emp info
	// 	$emp_bac = 0;
	// 	$emp_da = 0;
	// 	$emp_hra = 0;
	// 	$emp_convy = 0;
	// 	$emp_mob = 0;
	// 	$emp_med = 0;
	// 	$emp_edu = 0;
	// 	$emp_city = 0;
	// 	$emp_enter = 0;

	// 	$lastRowNum=4;
 	// 	if (isset($emp_basic_data) && !empty($emp_basic_data))
 	// 	{
	//  		$j=4;
	//  		$lastRowNum= $lastRowNum + count($emp_basic_data);
	//  		$sr=1;
	//  		foreach ($emp_basic_data as $key)
	//  		{
	//  			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
	// 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
	// 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->gender);
	// 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->desig_id);
	// 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,$key->date_of_joining);
	// 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,'10:00 AM - 07:00 PM');
	// 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,'01:00 PM - 01:45 PM');

	// 			$emp_hrs = $CI->Slip_vish_model->fetch_hrs($key->user_id,$key->salary_month); 
	// 			if(isset($emp_hrs) && !empty($emp_hrs))
	// 			{
	// 				foreach ($emp_hrs as $row)
	// 				{
	// 					if($row->date_no==='01'){
	// 						$CI->excel->getActiveSheet()->setCellValue('H'.$j,$row->type);
	// 					}if($row->date_no==='02'){
	// 						$CI->excel->getActiveSheet()->setCellValue('I'.$j,$row->type);
	// 					}if($row->date_no==='03'){
	// 						$CI->excel->getActiveSheet()->setCellValue('J'.$j,$row->type);
	// 					}if($row->date_no==='04'){
	// 						$CI->excel->getActiveSheet()->setCellValue('K'.$j,$row->type);
	// 					}if($row->date_no==='05'){
	// 						$CI->excel->getActiveSheet()->setCellValue('L'.$j,$row->type);
	// 					}if($row->date_no==='06'){
	// 						$CI->excel->getActiveSheet()->setCellValue('M'.$j,$row->type);
	// 					}if($row->date_no==='07'){
	// 						$CI->excel->getActiveSheet()->setCellValue('N'.$j,$row->type);
	// 					}if($row->date_no==='08'){
	// 						$CI->excel->getActiveSheet()->setCellValue('O'.$j,$row->type);
	// 					}if($row->date_no==='09'){
	// 						$CI->excel->getActiveSheet()->setCellValue('P'.$j,$row->type);
	// 					}if($row->date_no==='10'){
	// 						$CI->excel->getActiveSheet()->setCellValue('Q'.$j,$row->type);
	// 					}if($row->date_no==='11'){
	// 						$CI->excel->getActiveSheet()->setCellValue('R'.$j,$row->type);
	// 					}if($row->date_no==='12'){
	// 						$CI->excel->getActiveSheet()->setCellValue('S'.$j,$row->type);
	// 					}if($row->date_no==='13'){
	// 						$CI->excel->getActiveSheet()->setCellValue('T'.$j,$row->type);
	// 					}if($row->date_no==='14'){
	// 						$CI->excel->getActiveSheet()->setCellValue('U'.$j,$row->type);
	// 					}if($row->date_no==='15'){
	// 						$CI->excel->getActiveSheet()->setCellValue('V'.$j,$row->type);
	// 					}if($row->date_no==='16'){
	// 						$CI->excel->getActiveSheet()->setCellValue('W'.$j,$row->type);
	// 					}if($row->date_no==='17'){
	// 						$CI->excel->getActiveSheet()->setCellValue('X'.$j,$row->type);
	// 					}if($row->date_no==='18'){
	// 						$CI->excel->getActiveSheet()->setCellValue('Y'.$j,$row->type);
	// 					}if($row->date_no==='19'){
	// 						$CI->excel->getActiveSheet()->setCellValue('Z'.$j,$row->type);
	// 					}if($row->date_no==='20'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AA'.$j,$row->type);
	// 					}if($row->date_no==='21'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AB'.$j,$row->type);
	// 					}if($row->date_no==='22'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AC'.$j,$row->type);
	// 					}if($row->date_no==='23'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AD'.$j,$row->type);
	// 					}if($row->date_no==='24'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AE'.$j,$row->type);
	// 					}if($row->date_no==='25'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AF'.$j,$row->type);
	// 					}if($row->date_no==='26'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AG'.$j,$row->type);
	// 					}if($row->date_no==='27'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AH'.$j,$row->type);
	// 					}if($row->date_no==='28'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AI'.$j,$row->type);
	// 					}if($row->date_no==='29'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,$row->type);
	// 					}if($row->date_no==='30'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AK'.$j,$row->type);
	// 					}if($row->date_no==='31'){
	// 						$CI->excel->getActiveSheet()->setCellValue('AL'.$j,$row->type);
	// 					}
	// 				}
	// 			}

	// 			$CI->excel->getActiveSheet()->setCellValue('AM'.$j,$key->work_day);
	// 			$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
	// 			/*$CI->excel->getActiveSheet()->setCellValue('AN'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AO'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AP'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AR'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AS'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AT'.$j,$key->hra);
	// 			$CI->excel->getActiveSheet()->setCellValue('AU'.$j,'-');				
	// 			if(isset($emp_allData) && !empty($emp_allData))
	// 			{
	// 				$basic = $key->basic_net/$num_days_of_month;
	// 				$emp_basic = $key->work_day*$basic;

	// 				$hra = $key->hra/$num_days_of_month;
	// 				$emp_hra = $key->work_day*$hra;

	// 				$convey = $key->convey/$num_days_of_month;
	// 				$emp_convey = $key->work_day*$convey;

	// 				$total_mobile=0;
	// 				$total_city=0;
	// 				$total_medi=0;
	// 				$total_edu=0;
	// 				$total_entertainment=0;
	// 				$total_bonus=0;
	// 				$total_da=0;

	// 				foreach ($emp_allData as $row)
	// 				{
	// 					if($row->earning_id == 18 )
	// 					{
	// 						//DA allowance
	// 						$da = $key->special_allowance/$num_days_of_month;
	// 						$value = $key->work_day*$da;
	// 						$total_da = $value;
							
	// 					}elseif ($row->earning_id == 6 ) 
	// 					{
	// 						// mobile allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$total_mobile = $value;
							
	// 					}elseif($row->earning_id == 13)
	// 					{
	// 						//medical allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$total_medi = $value;
							
	// 					}elseif($row->earning_id == 20)
	// 					{
	// 						//education allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$total_edu = $value;
							
	// 					}elseif($row->earning_id == 14 )
	// 					{				
	// 						// City allowance 
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$total_city = $value;
							
	// 					}elseif($row->earning_id == 22)
	// 					{
	// 						//entertainment allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$total_entertainment = $value;
							
	// 					}
	// 				}
	// 			}
	// 			$earn_gross = $emp_basic + $emp_hra + $emp_convey + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1;

	// 			$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($earn_gross));
	// 			$CI->excel->getActiveSheet()->setCellValue('AW'.$j,'-');

	// 			$emp_paid_leave = $CI->Slip_vish_model->fetch_paid_leave($key->user_id,$month,$year);
	// 			$emp_leave_data = $CI->Slip_vish_model->fetch_emp_leave_data($key->user_id,$year);
	// 			if($emp_leave_data->bal_leave!=10 && !empty($emp_leave_data->bal_leave))
	// 			{
	// 				$earn_leave = 10-$emp_leave_data->bal_leave;
	// 			}else{
	// 				$earn_leave = 0;
	// 			}
				
	// 			$CI->excel->getActiveSheet()->setCellValue('AX'.$j,'10');
	// 			$CI->excel->getActiveSheet()->setCellValue('AY'.$j,(isset($emp_leave_data->bal_leave) && !empty($emp_leave_data->bal_leave))?$emp_leave_data->bal_leave:0);
	// 			$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,$emp_paid_leave->paid_leave);
	// 			$CI->excel->getActiveSheet()->setCellValue('BA'.$j,($emp_leave_data->bal_leave-$emp_paid_leave->paid_leave));
	// 			$CI->excel->getActiveSheet()->setCellValue('BB'.$j,($emp_leave_data->bal_leave-$emp_paid_leave->paid_leave));*/
	// 			$bsc = $key->basic_amt/$num_days_of_month;
	// 			$basic = $key->work_day*$bsc;
	// 			$CI->excel->getActiveSheet()->setCellValue('AN'.$j,round($basic));
				
	// 			$da = $key->special_allowance/$num_days_of_month;
	// 			$sa = $key->work_day*$da;
	// 			$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($sa));
	// 			$da = $sa;

	// 			$CI->excel->getActiveSheet()->setCellValue('AP'.$j,'-');
	// 			$other_allow=0;
	// 			if(isset($emp_allData) && !empty($emp_allData))
	// 			{
	// 				foreach ($emp_allData as $row)
	// 				{
	// 					if ($row->earning_id == 6 ) 
	// 					{
	// 						// mobile allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;
							
	// 					}elseif($row->earning_id == 13)
	// 					{
	// 						//medical allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;
							
	// 					}elseif($row->earning_id == 20)
	// 					{
	// 						//education allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;
							
	// 					}elseif($row->earning_id == 14 )
	// 					{				
	// 						// City allowance 
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;
							
	// 					}elseif($row->earning_id == 22)
	// 					{
	// 						//entertainment allowance
	// 						$last_val = $row->value/$num_days_of_month;
	// 						$value = $key->work_day*$last_val;
	// 						$other_allow = $other_allow + $value;						
	// 					}elseif($row->earning_id == 15)
	// 					{
	// 						//Bonus
	// 						$bonus_value = $row->value / $num_days_of_month * $key->work_day; 
	// 					}
	// 				}
	// 			}

	// 			$last_val1 = $key->hra/$num_days_of_month;
	// 			$value1 = $key->work_day*$last_val1;
	// 			$other_allow1 = $value1;

	// 			$last_val2 = $key->convey/$num_days_of_month;
	// 			$value2 = $key->work_day*$last_val2;
	// 			$other_allow2 = $value2;

	// 			$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,round($other_allow+$other_allow1+$other_allow2+$bonus_value));
	// 			$net_basic_total = $net_basic_total+round($other_allow+$key->hra+$key->convey);
				
	// 			print_r($other_allow1); echo "<br>";
	// 			print_r($other_allow2); echo "<br>";
	// 				print_r($bonus_value);exit;
	// 			$total_earn = $other_allow+$da+$basic+$other_allow1+$other_allow2+$bonus_value;

	// 			$CI->excel->getActiveSheet()->setCellValue('AR'.$j,round($total_earn));
	// 			$allowance_total_emp = $allowance_total_emp+round($total_earn);
				
	// 			$CI->excel->getActiveSheet()->setCellValue('AS'.$j,round($key->advance_recovery));
	// 			$adv_recovery = $adv_recovery + round($key->advance_recovery);
				
	// 			//DEDUCATION
	// 			if($key->pt_amt>0)
	// 			{
	// 				if($total_earn<=7500)
	// 				{
	// 					$pt = 0;
	// 				}elseif($total_earn<=10000 && $total_earn>=7500)
	// 				{
	// 					if($key->gender=='Female')
	// 					{
	// 						$pt=0;
	// 					}else{
	// 						$pt = 175;
	// 					}
	// 				}elseif($total_earn>10000)
	// 				{
	// 					if($month=='February')
	// 					{
	// 						$pt = 300;
	// 					}else{
	// 						$pt = 200;
	// 					}
	// 				}
	// 			}else{
	// 				$pt = 0;
	// 			}

	// 			$CI->excel->getActiveSheet()->setCellValue('AT'.$j,round($pt));
	// 			$pt_total = $pt_total + $pt;

	// 			$esicd_val = $key->ESIC_deduct/$num_days_of_month;
	// 			$esic_dedct = $key->work_day*$esicd_val;
	// 			$CI->excel->getActiveSheet()->setCellValue('AU'.$j,round($esic_dedct));
	// 			$tot_ESIC_deduct=$tot_ESIC_deduct+round($esic_dedct);

	// 			$pfd_val = $key->pf_deduct/$num_days_of_month;
	// 			$pf_dedct = $pfd_val*$key->work_day;//($basic + $da)*0.12;
	// 			//($key->basic_net + ($total_da)*1)*0.12;//$key->work_day*$pfd_val;
	// 			$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($pf_dedct));
	// 			$tot_pf_deduct=$tot_pf_deduct+round($pf_dedct);
				
	// 			$CI->excel->getActiveSheet()->setCellValue('AW'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AX'.$j,'-');
	// 			$CI->excel->getActiveSheet()->setCellValue('AY'.$j,'-');

	// 			$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,round($key->mobile_deduction+$key->other_deduct));
	// 			$mobile_ded_total = $mobile_ded_total + round($key->mobile_deduction+$key->other_deduct);
				
	// 			$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
	// 			$CI->excel->getActiveSheet()->setCellValue('BA'.$j,round($total_deduction));
	// 			$total_deduct_mnth = $total_deduct_mnth + round($total_deduction);

	// 			//earning arrers
	// 			// print_r($total_deduction);
				
	// 			$CI->excel->getActiveSheet()->setCellValue('BB'.$j,round($total_earn-$total_deduction));
	// 			$Arrears_total = $Arrears_total + round($total_earn-$total_deduction);

	// 			$CI->excel->getActiveSheet()->setCellValue('BC'.$j,'');
	// 			$CI->excel->getActiveSheet()->setCellValue('BD'.$j,'');
				
	// 			$CI->excel->getActiveSheet()->getStyle('E'.$j.':BD'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);

	// 			$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																->setWrapText(true);
	// 			$CI->excel->getActiveSheet()->getStyle('D'.$j.':D'.$j)->getAlignment()->setWrapText(true);
	// 			$j++;
				
	// 		}

	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)->getFont()->setBold(true);
	// 		$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':E'.$lastRowNum)
	// 									->setCellValue('A'.$lastRowNum, '');

	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)
	// 									->getFill()
	// 									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	// 									->getStartColor()->setARGB('EED8D8D8');
	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)->applyFromArray($allborders);
	// 		$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 																			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
	// 																			->setWrapText(true);

	// 		$lastRowNum = $lastRowNum+2;

	// 		$objDrawing = new PHPExcel_Worksheet_Drawing();
	// 		$objDrawing->setName('test_img');
	// 		$objDrawing->setDescription('test_img');
	// 		$objDrawing->setPath('./images/logo/stamp.jpg');
	// 		$objDrawing->setCoordinates('D'.$lastRowNum);                      
	// 		//setOffsetX works properly
	// 		$objDrawing->setOffsetX(5); 
	// 		$objDrawing->setOffsetY(5);                
	// 		//set width, height
	// 		$objDrawing->setWidth(100); 
	// 		$objDrawing->setHeight(150); 
	// 		$objDrawing->setWorksheet($CI->excel->getActiveSheet());


	// 	}
	// 	/* end dynamic code here **************/
	// 	$filename = 'Form II - Muster Roll cum Wage Register - '.$month.' '.$year.'.xls'; //save our workbook as this file name	
		
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

	function gen_muster_wage_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year,$salMonth)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('RoW - '.$month.' '.$year);
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', 'Form II - Muster Roll cum Wage Register - '.$month.' '.$year.''); //$employee_basic_info->emp_comp_name
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
		$CI->excel->getActiveSheet()->mergeCells('A1:BD1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:BD1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:BD2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		//set cell A1 content with some text
		$headline = "[See Rule 27(1)]\n".$company_name."\nOffice No. 310, 311, 312, Pride Purple Square Kalewadi Phata,\nWakad, Pune- 411057";
		$CI->excel->getActiveSheet()->setCellValue('A2', $headline);
		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);

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
		$CI->excel->getActiveSheet()->mergeCells('A2:BD2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:BD2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Full name of the employee'); 
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Age and sex');		
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Nature of work and Designation');		
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Date of entry into service');
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Working hours From To');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Intervals for rest or meal From To');
		$CI->excel->getActiveSheet()->setCellValue('H3', '1');
		$CI->excel->getActiveSheet()->setCellValue('I3', '2');
		$CI->excel->getActiveSheet()->setCellValue('J3', '3');
		$CI->excel->getActiveSheet()->setCellValue('K3', '4');
		$CI->excel->getActiveSheet()->setCellValue('L3', '5');
		$CI->excel->getActiveSheet()->setCellValue('M3', '6');
		$CI->excel->getActiveSheet()->setCellValue('N3', '7');
		$CI->excel->getActiveSheet()->setCellValue('O3', '8');
		$CI->excel->getActiveSheet()->setCellValue('P3', '9'); 
		$CI->excel->getActiveSheet()->setCellValue('Q3', '10'); 
		$CI->excel->getActiveSheet()->setCellValue('R3', '11');
		$CI->excel->getActiveSheet()->setCellValue('S3', '12');
		$CI->excel->getActiveSheet()->setCellValue('T3', '13');
		$CI->excel->getActiveSheet()->setCellValue('U3', '14');
		$CI->excel->getActiveSheet()->setCellValue('V3', '15');
		$CI->excel->getActiveSheet()->setCellValue('W3', '16');
		$CI->excel->getActiveSheet()->setCellValue('X3', '17');
		$CI->excel->getActiveSheet()->setCellValue('Y3', '18');
		$CI->excel->getActiveSheet()->setCellValue('Z3', '19');
		$CI->excel->getActiveSheet()->setCellValue('AA3', '20');
		$CI->excel->getActiveSheet()->setCellValue('AB3', '21'); 
		$CI->excel->getActiveSheet()->setCellValue('AC3', '22');		
		$CI->excel->getActiveSheet()->setCellValue('AD3', '23');		
		$CI->excel->getActiveSheet()->setCellValue('AE3', '24');
		$CI->excel->getActiveSheet()->setCellValue('AF3', '25');
		$CI->excel->getActiveSheet()->setCellValue('AG3', '26');
		$CI->excel->getActiveSheet()->setCellValue('AH3', '27');
		$CI->excel->getActiveSheet()->setCellValue('AI3', '28');
		$CI->excel->getActiveSheet()->setCellValue('AJ3', '29');
		$CI->excel->getActiveSheet()->setCellValue('AK3', '30');
		$CI->excel->getActiveSheet()->setCellValue('AL3', '31');
		$CI->excel->getActiveSheet()->setCellValue('AM3', 'Total days worked');
		/*$CI->excel->getActiveSheet()->setCellValue('AN3', 'Minimum rates of wages payable');
		$CI->excel->getActiveSheet()->setCellValue('AO3', 'Actual rates of wages payable');
		$CI->excel->getActiveSheet()->setCellValue('AP3', 'Total production in case of piece rate');
		$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Total overtime hours worked');
		$CI->excel->getActiveSheet()->setCellValue('AR3', 'Normal wages');
		$CI->excel->getActiveSheet()->setCellValue('AS3', 'Rate of HRA');
		$CI->excel->getActiveSheet()->setCellValue('AT3', 'HRA Payable');
		$CI->excel->getActiveSheet()->setCellValue('AU3', 'Overtime earnings');
		$CI->excel->getActiveSheet()->setCellValue('AV3', 'Gross wages payable');
		$CI->excel->getActiveSheet()->setCellValue('AW3', 'Deduction Advances Fines Damages');
		$CI->excel->getActiveSheet()->setCellValue('AX3', 'Net wages paid');
		$CI->excel->getActiveSheet()->setCellValue('AY3', 'Previous Balance');
		$CI->excel->getActiveSheet()->setCellValue('AZ3', 'Earned during the month');
		$CI->excel->getActiveSheet()->setCellValue('BA3', 'Availed during the month');
		$CI->excel->getActiveSheet()->setCellValue('BB3', 'Balance at the end of the month');*/
		$CI->excel->getActiveSheet()->setCellValue('AN3', 'Basic Wages');
		$CI->excel->getActiveSheet()->setCellValue('AO3', 'Dearness Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AP3', 'Over time');
		$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Other Cash Payments');
		$CI->excel->getActiveSheet()->setCellValue('AR3', 'Total');
		$CI->excel->getActiveSheet()->setCellValue('AS3', 'Advance');
		$CI->excel->getActiveSheet()->setCellValue('AT3', 'Professional Tax'); 
		$CI->excel->getActiveSheet()->setCellValue('AU3', 'ESI'); 
		$CI->excel->getActiveSheet()->setCellValue('AV3', 'Provident Fund');
		$CI->excel->getActiveSheet()->setCellValue('AW3', 'Family Pension Fund');
		$CI->excel->getActiveSheet()->setCellValue('AX3', 'Canteen');
		$CI->excel->getActiveSheet()->setCellValue('AY3', 'Dhobi');
		$CI->excel->getActiveSheet()->setCellValue('AZ3', 'Others');
		$CI->excel->getActiveSheet()->setCellValue('BA3', 'Total');
		$CI->excel->getActiveSheet()->setCellValue('BB3', 'Net amount paid');
		$CI->excel->getActiveSheet()->setCellValue('BC3', 'Date of payment of wages');
		$CI->excel->getActiveSheet()->setCellValue('BD3', 'Signature of thumb impression of the employee');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(55);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(23);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(8);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(30);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(14);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(20);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(12);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(43)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(44)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(45)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(46)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(47)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(48)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(49)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(50)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(51)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(52)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(53)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(54)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(55)->setWidth(15);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:BD3')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:BD3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:BD3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:BD3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:BD3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:BD3')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A3:BD3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);;

		/* start dynamic code from here *********/
		$net_basic_total=0;
 		$net_basic_totalE=0;
 		$salBefoPt_total=0;
 		$pt_total=0;
 		$net_with_pt_total=0;
 		$total_deduction=0;
 		$Conveyance_total=0;
 		$mobile_total=0;
 		$HRA_total = 0;
 		$DA_total = 0;
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
		$education_total=0;
		$adv_opening = 0;
		$adv_Addition = 0;
		$adv_recovery = 0;
		$pf_deduct = 0;
		$ESIC_deduct = 0;
		$tot_ESIC_deduct = 0;
		$tot_pf_deduct = 0;
		$total_deduct_mnth = 0;
		//emp info
		$emp_bac = 0;
		$emp_da = 0;
		$emp_hra = 0;
		$emp_convy = 0;
		$emp_mob = 0;
		$emp_med = 0;
		$emp_edu = 0;
		$emp_city = 0;
		$emp_enter = 0;

		$lastRowNum=4;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
	 		$j=4;
	 		$lastRowNum= $lastRowNum + count($emp_basic_data);
	 		$sr=1;
	 		foreach ($emp_basic_data as $key)
	 		{
				// echo '<pre>';
				// print_r($key);exit;
	 			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,$key->emp_name);
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->gender);
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->desig_id);
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$key->date_of_joining);
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,'10:00 AM - 07:00 PM');
				$CI->excel->getActiveSheet()->setCellValue('G'.$j,'01:00 PM - 01:45 PM');

				$emp_hrs = $CI->Slip_vish_model->fetch_hrs($key->user_id,$key->salary_month); 
				if(isset($emp_hrs) && !empty($emp_hrs))
				{
					foreach ($emp_hrs as $row)
					{
						if($row->date_no==='01'){
							$CI->excel->getActiveSheet()->setCellValue('H'.$j,$row->type);
						}if($row->date_no==='02'){
							$CI->excel->getActiveSheet()->setCellValue('I'.$j,$row->type);
						}if($row->date_no==='03'){
							$CI->excel->getActiveSheet()->setCellValue('J'.$j,$row->type);
						}if($row->date_no==='04'){
							$CI->excel->getActiveSheet()->setCellValue('K'.$j,$row->type);
						}if($row->date_no==='05'){
							$CI->excel->getActiveSheet()->setCellValue('L'.$j,$row->type);
						}if($row->date_no==='06'){
							$CI->excel->getActiveSheet()->setCellValue('M'.$j,$row->type);
						}if($row->date_no==='07'){
							$CI->excel->getActiveSheet()->setCellValue('N'.$j,$row->type);
						}if($row->date_no==='08'){
							$CI->excel->getActiveSheet()->setCellValue('O'.$j,$row->type);
						}if($row->date_no==='09'){
							$CI->excel->getActiveSheet()->setCellValue('P'.$j,$row->type);
						}if($row->date_no==='10'){
							$CI->excel->getActiveSheet()->setCellValue('Q'.$j,$row->type);
						}if($row->date_no==='11'){
							$CI->excel->getActiveSheet()->setCellValue('R'.$j,$row->type);
						}if($row->date_no==='12'){
							$CI->excel->getActiveSheet()->setCellValue('S'.$j,$row->type);
						}if($row->date_no==='13'){
							$CI->excel->getActiveSheet()->setCellValue('T'.$j,$row->type);
						}if($row->date_no==='14'){
							$CI->excel->getActiveSheet()->setCellValue('U'.$j,$row->type);
						}if($row->date_no==='15'){
							$CI->excel->getActiveSheet()->setCellValue('V'.$j,$row->type);
						}if($row->date_no==='16'){
							$CI->excel->getActiveSheet()->setCellValue('W'.$j,$row->type);
						}if($row->date_no==='17'){
							$CI->excel->getActiveSheet()->setCellValue('X'.$j,$row->type);
						}if($row->date_no==='18'){
							$CI->excel->getActiveSheet()->setCellValue('Y'.$j,$row->type);
						}if($row->date_no==='19'){
							$CI->excel->getActiveSheet()->setCellValue('Z'.$j,$row->type);
						}if($row->date_no==='20'){
							$CI->excel->getActiveSheet()->setCellValue('AA'.$j,$row->type);
						}if($row->date_no==='21'){
							$CI->excel->getActiveSheet()->setCellValue('AB'.$j,$row->type);
						}if($row->date_no==='22'){
							$CI->excel->getActiveSheet()->setCellValue('AC'.$j,$row->type);
						}if($row->date_no==='23'){
							$CI->excel->getActiveSheet()->setCellValue('AD'.$j,$row->type);
						}if($row->date_no==='24'){
							$CI->excel->getActiveSheet()->setCellValue('AE'.$j,$row->type);
						}if($row->date_no==='25'){
							$CI->excel->getActiveSheet()->setCellValue('AF'.$j,$row->type);
						}if($row->date_no==='26'){
							$CI->excel->getActiveSheet()->setCellValue('AG'.$j,$row->type);
						}if($row->date_no==='27'){
							$CI->excel->getActiveSheet()->setCellValue('AH'.$j,$row->type);
						}if($row->date_no==='28'){
							$CI->excel->getActiveSheet()->setCellValue('AI'.$j,$row->type);
						}if($row->date_no==='29'){
							$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,$row->type);
						}if($row->date_no==='30'){
							$CI->excel->getActiveSheet()->setCellValue('AK'.$j,$row->type);
						}if($row->date_no==='31'){
							$CI->excel->getActiveSheet()->setCellValue('AL'.$j,$row->type);
						}
					}
				}

				$CI->excel->getActiveSheet()->setCellValue('AM'.$j,$key->work_day);
				$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
				/*$CI->excel->getActiveSheet()->setCellValue('AN'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AO'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AP'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AR'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AS'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AT'.$j,$key->hra);
				$CI->excel->getActiveSheet()->setCellValue('AU'.$j,'-');				
				if(isset($emp_allData) && !empty($emp_allData))
				{
					$basic = $key->basic_net/$num_days_of_month;
					$emp_basic = $key->work_day*$basic;

					$hra = $key->hra/$num_days_of_month;
					$emp_hra = $key->work_day*$hra;

					$convey = $key->convey/$num_days_of_month;
					$emp_convey = $key->work_day*$convey;

					$total_mobile=0;
					$total_city=0;
					$total_medi=0;
					$total_edu=0;
					$total_entertainment=0;
					$total_bonus=0;
					$total_da=0;

					foreach ($emp_allData as $row)
					{
						if($row->earning_id == 18 )
						{
							//DA allowance
							$da = $key->special_allowance/$num_days_of_month;
							$value = $key->work_day*$da;
							$total_da = $value;
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$total_mobile = $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$total_medi = $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$total_edu = $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$total_city = $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$total_entertainment = $value;
							
						}
					}
				}
				$earn_gross = $emp_basic + $emp_hra + $emp_convey + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1;

				$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($earn_gross));
				$CI->excel->getActiveSheet()->setCellValue('AW'.$j,'-');

				$emp_paid_leave = $CI->Slip_vish_model->fetch_paid_leave($key->user_id,$month,$year);
				$emp_leave_data = $CI->Slip_vish_model->fetch_emp_leave_data($key->user_id,$year);
				if($emp_leave_data->bal_leave!=10 && !empty($emp_leave_data->bal_leave))
				{
					$earn_leave = 10-$emp_leave_data->bal_leave;
				}else{
					$earn_leave = 0;
				}
				
				$CI->excel->getActiveSheet()->setCellValue('AX'.$j,'10');
				$CI->excel->getActiveSheet()->setCellValue('AY'.$j,(isset($emp_leave_data->bal_leave) && !empty($emp_leave_data->bal_leave))?$emp_leave_data->bal_leave:0);
				$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,$emp_paid_leave->paid_leave);
				$CI->excel->getActiveSheet()->setCellValue('BA'.$j,($emp_leave_data->bal_leave-$emp_paid_leave->paid_leave));
				$CI->excel->getActiveSheet()->setCellValue('BB'.$j,($emp_leave_data->bal_leave-$emp_paid_leave->paid_leave));*/
				$bsc = $key->basic_amt/$num_days_of_month;
				$basic = $key->work_day*$bsc;
				$CI->excel->getActiveSheet()->setCellValue('AN'.$j,round($basic));
				
				$da = $key->special_allowance/$num_days_of_month;
				$sa = $key->work_day*$da;
				$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($sa));
				$da = $sa;

				$CI->excel->getActiveSheet()->setCellValue('AP'.$j,'-');
				$other_allow=0;
				$bonus_value=0;
				if(isset($emp_allData) && !empty($emp_allData))
				{
					foreach ($emp_allData as $row)
					{
						if ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$other_allow = $other_allow + $value;						
						}elseif($row->earning_id == 15)
						{
							//Bonus
							$bonus_value = $row->value / $num_days_of_month * $key->work_day; 
						}
					}
				}

				$last_val1 = $key->hra/$num_days_of_month;
				$value1 = $key->work_day*$last_val1;
				$other_allow1 = $value1;

				$last_val2 = $key->convey/$num_days_of_month;
				$value2 = $key->work_day*$last_val2;
				$other_allow2 = $value2;

				$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,round($other_allow+$other_allow1+$other_allow2+$bonus_value));
				$net_basic_total = $net_basic_total+round($other_allow+$key->hra+$key->convey);
				
				$total_earn = $other_allow+$da+$basic+$other_allow1+$other_allow2+$bonus_value;
				$CI->excel->getActiveSheet()->setCellValue('AR'.$j,round($total_earn));
				$allowance_total_emp = $allowance_total_emp+round($total_earn);
				
				$CI->excel->getActiveSheet()->setCellValue('AS'.$j,round($key->advance_recovery));
				$adv_recovery = $adv_recovery + round($key->advance_recovery);
				
				//DEDUCATION
				if($key->pt_amt>0)
				{
					if($total_earn<=7500)
					{
						$pt = 0;
					}elseif($total_earn<=10000 && $total_earn>=7500)
					{
						if($key->gender=='Female')
						{
							$pt=0;
						}else{
							$pt = 175;
						}
					}elseif($total_earn>10000)
					{
						if($month=='February')
						{
							$pt = 300;
						}else{
							$pt = 200;
						}
					}
				}else{
					$pt = 0;
				}

				$CI->excel->getActiveSheet()->setCellValue('AT'.$j,round($pt));
				$pt_total = $pt_total + $pt;

				$esicd_val = $key->ESIC_deduct/$num_days_of_month;
				$esic_dedct = $key->work_day*$esicd_val;
				$CI->excel->getActiveSheet()->setCellValue('AU'.$j,round($esic_dedct));
				$tot_ESIC_deduct=$tot_ESIC_deduct+round($esic_dedct);

				$pfd_val = $key->pf_deduct/$num_days_of_month;
				$pf_dedct = $pfd_val*$key->work_day;
				$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($pf_dedct));
				$tot_pf_deduct=$tot_pf_deduct+round($pf_dedct);
				
				$CI->excel->getActiveSheet()->setCellValue('AW'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AX'.$j,'-');
				$CI->excel->getActiveSheet()->setCellValue('AY'.$j,'-');

				$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,round($key->mobile_deduction+$key->other_deduct));
				$mobile_ded_total = $mobile_ded_total + round($key->mobile_deduction+$key->other_deduct);
				
				$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
				$CI->excel->getActiveSheet()->setCellValue('BA'.$j,round($total_deduction));
				$total_deduct_mnth = $total_deduct_mnth + round($total_deduction);

				//earning arrers
				$CI->excel->getActiveSheet()->setCellValue('BB'.$j,round($total_earn-$total_deduction+$key->allowances));
				$Arrears_total = $Arrears_total + round($total_earn-$total_deduction+$key->allowances);

				$CI->excel->getActiveSheet()->setCellValue('BC'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('BD'.$j,'');
				
				$CI->excel->getActiveSheet()->getStyle('E'.$j.':BD'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);
				$CI->excel->getActiveSheet()->getStyle('D'.$j.':D'.$j)->getAlignment()->setWrapText(true);
				$j++;
				
			}

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)->getFont()->setBold(true);
			$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':E'.$lastRowNum)
										->setCellValue('A'.$lastRowNum, '');

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

			$lastRowNum = $lastRowNum+2;

			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('test_img');
			$objDrawing->setDescription('test_img');
			$objDrawing->setPath('./images/logo/stamp.jpg');
			$objDrawing->setCoordinates('D'.$lastRowNum);                      
			//setOffsetX works properly
			$objDrawing->setOffsetX(5); 
			$objDrawing->setOffsetY(5);                
			//set width, height
			$objDrawing->setWidth(100); 
			$objDrawing->setHeight(150); 
			$objDrawing->setWorksheet($CI->excel->getActiveSheet());


		}
		/* end dynamic code here **************/
		$filename = 'Form II - Muster Roll cum Wage Register - '.$month.' '.$year.'.xls'; //save our workbook as this file name	
		
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
    function gen_emp_salary_report($emp_salary_data,$emp_data,$year)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Salary Sheet - '.$year);
		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A1', $emp_data->emp_name);
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
		$CI->excel->getActiveSheet()->mergeCells('A1:BG1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:BG1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:BG2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		//set cell A1 content with some text
		$CI->excel->getActiveSheet()->setCellValue('A2', 'Salary Sheet for the Year of '.$year.''); //$employee_basic_info->emp_comp_name
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
		$CI->excel->getActiveSheet()->mergeCells('A2:BG2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:BG2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.');
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Employee ID');
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Name of the Employee');	
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Salary Month');		
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Working Days');
		//leave
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Sanction Leave');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Total Utilsed Leave');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'Balance Leave');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'Leave Utilsed In Month');
		
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Present Days');
		$CI->excel->getActiveSheet()->setCellValue('K3', 'Present Days');
		// Earning Allowance
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'DA Allowance');
		$CI->excel->getActiveSheet()->setCellValue('N3', 'HRA');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('P3', 'Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('R3', 'Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('S3', 'City Allowance');
		$CI->excel->getActiveSheet()->setCellValue('T3', 'Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('U3', 'Total Gross');
		// ctc
		$CI->excel->getActiveSheet()->setCellValue('V3', 'PF (Employers Contribution)'); 
		$CI->excel->getActiveSheet()->setCellValue('W3', 'ESIC (Employers Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('X3', 'PF (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('Y3', 'ESIC (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('Z3', 'CTC');
		// salary on number of days
		$CI->excel->getActiveSheet()->setCellValue('AA3', 'Earn Basic');
		$CI->excel->getActiveSheet()->setCellValue('AB3', 'Earn DA');
		$CI->excel->getActiveSheet()->setCellValue('AC3', 'Earn HRA');
		$CI->excel->getActiveSheet()->setCellValue('AD3', 'Earn Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('AE3', 'Earn Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AF3', 'Earn Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AG3', 'Earn Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AH3', 'Earn City Allowance');  
		$CI->excel->getActiveSheet()->setCellValue('AI3', 'Earn Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AJ3', 'Earn Other Allowance');

		$CI->excel->getActiveSheet()->setCellValue('AK3', 'Total Earn Gross');
		$CI->excel->getActiveSheet()->setCellValue('AL3', 'Employees PF Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AM3', 'Employees ESIC  Deduction ');
		$CI->excel->getActiveSheet()->setCellValue('AN3', 'Professional Tax');
		// if Deducation
		$CI->excel->getActiveSheet()->setCellValue('AO3', 'Telephone (Co.)');
		$CI->excel->getActiveSheet()->setCellValue('AP3', 'Others Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Advance Opening'); 
		$CI->excel->getActiveSheet()->setCellValue('AR3', 'Advance Addition'); 
		$CI->excel->getActiveSheet()->setCellValue('AS3', 'Advance Recovery'); 
		$CI->excel->getActiveSheet()->setCellValue('AT3', 'Advance Closing');
		$CI->excel->getActiveSheet()->setCellValue('AU3', 'Total Deduction for the month');
		$CI->excel->getActiveSheet()->setCellValue('AV3', 'Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AW3', 'Arrears');
		//Total Salary 
		$CI->excel->getActiveSheet()->setCellValue('AX3', 'Net Pay');
		//Star rate
		$CI->excel->getActiveSheet()->setCellValue('AY3', 'Red Star');
		$CI->excel->getActiveSheet()->setCellValue('AZ3', 'Gold Star');
		$CI->excel->getActiveSheet()->setCellValue('BA3', 'Balance Red Star');
		$CI->excel->getActiveSheet()->setCellValue('BB3', 'Balance Gold Star');
		$CI->excel->getActiveSheet()->setCellValue('BC3', 'Star deducation');
		$CI->excel->getActiveSheet()->setCellValue('BD3', 'Black Star');
		$CI->excel->getActiveSheet()->setCellValue('BE3', 'Balance Black Star');
		$CI->excel->getActiveSheet()->setCellValue('BF3', 'Balance Gold Star');
		$CI->excel->getActiveSheet()->setCellValue('BG3', 'Black Star deducation');
		$CI->excel->getActiveSheet()->setCellValue('BH3', 'Salary after star deducation');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(0);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(10);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(0);		
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(43)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(44)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(45)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(46)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(47)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(48)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(49)->setWidth(10);

		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(50)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(51)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(52)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(53)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(54)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(55)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(56)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(57)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(58)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(59)->setWidth(0);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:BH3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);
		/* start dynamic code from here *********/
		$lastRowNum=4;
 		if (isset($emp_salary_data) && !empty($emp_salary_data))
 		{
	 		$j=4;
	 		$lastRowNum= $lastRowNum + count($emp_salary_data);
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
	 		$DA_total = 0;
	 		$otherAllow_total=0;
	 		$Arrears_total=0;
	 		$allowance_total_emp = 0;
	 		$allowance_ded_total_emp = 0;
			$mobile_ded_total = 0;
			$ArrOther_ded_total = 0;
			$Bonus_total = 0;
			$bonus_value = 0; //pallavi
			$Advance_total = 0;
			$per_emp_advance=0;
			$deduct_adv_total=0;
			$Advance_deduction=0;
			$medical_total=0;
			$city_total=0;
			$education_total=0;
			$adv_opening = 0;
			$adv_Addition = 0;
			$adv_recovery = 0;
			$adv_closing_amt = 0;

			$mobile_total_all=0;
			$otherAllow_total_all=0;
			$recy_ttl = 0;
			$entertainment_total = 0;
			$other_total = 0;
			$pf_earn = 0;
			$ESIC_earn = 0;
			$pf_deduct = 0;
			$ESIC_deduct = 0;
			$tot_pf_deduct=0;
			$tot_ESIC_deduct=0;
			$pay_during_month = 0;
			$pay_beforePt=0;
			$final_net_pay=0;
			$basic_net=0;
			$total_ctc=0;
			$total_gross=0;
			$total_earn_gross=0;
			$total_net_salary=0;
			$total_deduct_mnth=0;
			$total_net_pay=0;
			//emp info
			$emp_bac = 0;
			$emp_da = 0;
			$emp_hra = 0;
			$emp_convy = 0;
			$emp_mob = 0;
			$emp_med = 0;
			$emp_edu = 0;
			$emp_city = 0;
			$emp_enter = 0;
			$emp_gross = 0;
	 		$sr=1;
	 		$total_star_deduct=0;
			$total_star_pay=0;
	 		foreach ($emp_salary_data as $key)
	 		{
	 			$netBasicTotK = 0;
	 			$emp_wise_ded=0;
	 			$boun_emp = 0;
	 			$emp_wise_add_deduction = 0;
	 		 	
				$emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->emp_id,$key->salary_month);
				$emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->emp_id);	
				$earn_allowance = $CI->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->emp_id);
				$emp_basic = $CI->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->emp_id);
				
				$mthyr = explode('-',$key->salary_month);
				$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $mthyr[0], $mthyr[1]);

				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->salary_month);
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$num_days_of_month);

				$CI->excel->getActiveSheet()->setCellValue('F'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('G'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('I'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,'');

				$CI->excel->getActiveSheet()->setCellValue('K'.$j,$key->work_day);
				
				//EARNING ALLOWANCE				
				if(isset($earn_allowance) && !empty($earn_allowance))
				{
					$basic = $emp_basic->emp_basic;
					$CI->excel->getActiveSheet()->setCellValue('L'.$j,round($basic));
					$emp_bac = $emp_bac + $basic;

					$da = 0;
					$hra = 0;
					$conveyance = 0;
					$mobile = 0;
					$medical = 0;
					$education = 0;
					$city = 0;
					$entertainment = 0;

					foreach ($earn_allowance as $earn)
					{
						if($earn->earning_id == 18 )
						{
							//DA allowance
							$CI->excel->getActiveSheet()->setCellValue('M'.$j,round($earn->earn_value));
							$emp_da = $emp_da + $earn->earn_value; 
							$da = $earn->earn_value;
							
						}elseif($earn->earning_id == 7)
						{
							//HRA
							$CI->excel->getActiveSheet()->setCellValue('N'.$j,round($earn->earn_value));
							$emp_hra = $emp_hra + $earn->earn_value;
							$hra = $earn->earn_value;
							
						}elseif($earn->earning_id == 3)
						{
							//Conveyance
							$CI->excel->getActiveSheet()->setCellValue('O'.$j,round($earn->earn_value));
							$emp_convy = $emp_convy + $earn->earn_value;
							$conveyance = $earn->earn_value;
							
						}elseif ($earn->earning_id == 6 ) 
						{
							// mobile allowance
							$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($earn->earn_value));
							$emp_mob = $emp_mob + $earn->earn_value;
							$mobile = $earn->earn_value;
							
						}elseif($earn->earning_id == 13)
						{
							//medical allowance
							$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($earn->earn_value));
							$emp_med = $emp_med + $earn->earn_value;
							$medical = $earn->earn_value;
							
						}elseif($earn->earning_id == 20)
						{
							//education allowance
							$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($earn->earn_value));
							$emp_edu = $emp_edu + $earn->earn_value;
							$education = $earn->earn_value;
							
						}elseif($earn->earning_id == 14 )
						{				
							// City allowance
							$CI->excel->getActiveSheet()->setCellValue('S'.$j,round($earn->earn_value));
							$emp_city = $emp_city + $earn->earn_value;
							$city = $earn->earn_value;
							
						}elseif($earn->earning_id == 22)
						{
							//entertainment allowance
							$CI->excel->getActiveSheet()->setCellValue('T'.$j,round($earn->earn_value));
							$emp_enter = $emp_enter + $earn->earn_value;
							$entertainment = $earn->earn_value;
							
						}
					}
				}
				
				$gross = $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1;

				$CI->excel->getActiveSheet()->setCellValue('U'.$j,round($gross));
				$emp_gross = $emp_gross + $gross;

				//CTC
				$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($key->pf_earn));
				$pf_earn = $pf_earn + $key->pf_earn;

				$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($key->ESIC_earn));
				$ESIC_earn = $ESIC_earn + $key->ESIC_earn;

				$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($key->pf_deduct));
				$pf_deduct=$pf_deduct+$key->pf_deduct;

				$CI->excel->getActiveSheet()->setCellValue('Y'.$j,round($key->ESIC_deduct));
				$ESIC_deduct=$ESIC_deduct+$key->ESIC_deduct;

				$ctc = $gross+$key->pf_earn+$key->ESIC_earn;//+$key->pf_deduct+$key->ESIC_deduct;
				$CI->excel->getActiveSheet()->setCellValue('Z'.$j,round($ctc));
				$total_ctc = $total_ctc + $ctc;
				
				//EARNING ALLOWANCE/NO OF DAYS
				$bsNet = 0;
				if(isset($key->net_pay) && $key->net_pay>0)
				{ 
					$bsNet = $key->net_pay + $key->pt_amt;
					$netBasicTotK = $bsNet;
				}
				$emp_basic=0;				
				if(isset($emp_allData) && !empty($emp_allData))
				{
					$basic = $key->basic_net/$num_days_of_month;
					$emp_basic = $key->work_day*$basic;
					$CI->excel->getActiveSheet()->setCellValue('AA'.$j,round($emp_basic));
					$basic_net = $basic_net + $emp_basic;

					$hra = $key->hra/$num_days_of_month;
					$emp_hra = $key->work_day*$hra;
					$CI->excel->getActiveSheet()->setCellValue('AC'.$j,round($emp_hra));
					$HRA_total = $HRA_total + $emp_hra;

					$convey = $key->convey/$num_days_of_month;
					$emp_convey = $key->work_day*$convey;
					$CI->excel->getActiveSheet()->setCellValue('AD'.$j,round($emp_convey));
					$Conveyance_total = $Conveyance_total + $emp_convey;

					$total_mobile=0;
					$total_city=0;
					$total_medi=0;
					$total_edu=0;
					$total_entertainment=0;
					$total_other=0;
					$total_bonus=0;
					$total_da=0;

					foreach ($emp_allData as $row)
					{
						if($row->earning_id == 18 )
						{
							//DA allowance
							$da = $key->special_allowance/$num_days_of_month;
							$value = $key->work_day*$da;
							$CI->excel->getActiveSheet()->setCellValue('AB'.$j,round($value));
							$DA_total = $DA_total + $value;
							$total_da = $value;
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AE'.$j,round($value));
							$mobile_total_all = $mobile_total_all + $value;
							$total_mobile = $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AF'.$j,round($value));
							$medical_total = $medical_total + $value;
							$total_medi = $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AG'.$j,round($value));
							$education_total = $education_total + $value;
							$total_edu = $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AH'.$j,round($value));
							$city_total = $city_total + $value;
							$total_city = $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AI'.$j,round($value));
							$entertainment_total = $entertainment_total + $value;
							$total_entertainment = $value;
							
						}elseif($row->earning_id == 9)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,round($value));
							$other_total = $other_total + $value;
							$total_other = $value;
							
						}elseif($row->earning_id == 15)
						{
							//Bonus
							$bonus_value = $row->value / $num_days_of_month * $key->work_day;
							$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($bonus_value));
							$Bonus_total = $Bonus_total + $row->value;
							$total_bonus=$row->value;
						}elseif($row->earning_id == 16)
						{
							$Advance_total = $Advance_total + $row->value;
							$per_emp_advance = $row->value;
						}else{
							$allowance_total_emp=0;
						}
					}
				}
				//print_r($emp_basic);exit();
				$earn_gross = $emp_basic + $emp_hra + $emp_convey + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1+ ($total_other)*1;


				$CI->excel->getActiveSheet()->setCellValue('AK'.$j,round($earn_gross));
				$total_earn_gross = $total_earn_gross + $earn_gross; 
				
				//DEDUCATION
				$pfd_val = $key->pf_deduct/$num_days_of_month;
				//print_r($key);
				if(isset($key->pf_deduct) && !empty($key->pf_deduct)){
					$pf_dedct = $key->pf_deduct; //$key->work_day*$pfd_val;
				}else{
					$pf_dedct = 0;
				}
				$CI->excel->getActiveSheet()->setCellValue('AL'.$j,round($pf_dedct));
				$tot_pf_deduct=$tot_pf_deduct+$pf_dedct;

				$esicd_val = $key->ESIC_deduct/$num_days_of_month;
				$esic_dedct = $key->work_day*$esicd_val;
				$CI->excel->getActiveSheet()->setCellValue('AM'.$j,round($esic_dedct));
				$tot_ESIC_deduct=$tot_ESIC_deduct+$esic_dedct;

				$CI->excel->getActiveSheet()->setCellValue('AN'.$j,round($key->pt_amt));
				$pt_total = $pt_total + $key->pt_amt;

				$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($key->mobile_deduction));
				$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;

				$CI->excel->getActiveSheet()->setCellValue('AP'.$j,round($key->other_deduct));
				$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

				$CI->excel->getActiveSheet()->setCellValue('AQ'.$j, round($key->advance_opening));
				$CI->excel->getActiveSheet()->setCellValue('AR'.$j, round($key->advance_Addition));
				$CI->excel->getActiveSheet()->setCellValue('AS'.$j, round($key->advance_recovery));
				$CI->excel->getActiveSheet()->setCellValue('AT'.$j, round($key->advance_closing_amt));

				if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
				{
					$recy_total=0;
					$Advance_deduction=0;
					foreach ($emp_Ded_allData as $rec)
					{
						if ($rec->deduction_id == 6)
						{
							$CI->excel->getActiveSheet()->setCellValue('AS'.$j,round($rec->deduct_value));
							$recy_total = $rec->deduct_value;
							
							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
							$per_emp_advance = $per_emp_advance-$rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							
							if($per_emp_advance>0)
							{ }
							else
							{
								$per_emp_advance=0;
							}
							$CI->excel->getActiveSheet()->setCellValue('AT'.$j,$per_emp_advance);
						}
						elseif(($rec->deduction_id == 'Arrears/ others') || ($rec->deduction_id == 'Deduction Arrears'))
						{
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
						}else{
						
						}				
					}
				}
				
				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;

				$total_deduction = $pf_dedct + $esic_dedct + $key->pt_amt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
				$CI->excel->getActiveSheet()->setCellValue('AU'.$j,round($total_deduction));
				$total_deduct_mnth = $total_deduct_mnth + $total_deduction;

				//earning arrers
				$CI->excel->getActiveSheet()->setCellValue('AW'.$j,round($key->earn_arrears));
				$Arrears_total = $Arrears_total + $key->earn_arrears;

				//NET PAY
				$net_pay = ($earn_gross - $total_deduction) + ($bonus_value)*1 + $key->earn_arrears;
				$CI->excel->getActiveSheet()->setCellValue('AX'.$j,round($net_pay));
				$total_net_pay = $total_net_pay + round($net_pay);

				$CI->excel->getActiveSheet()->setCellValue('AY'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('AZ'.$j,'');
				
				$CI->excel->getActiveSheet()->setCellValue('BA'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('BB'.$j,'');
				
				$CI->excel->getActiveSheet()->setCellValue('BC'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('BD'.$j,'');
				
				$CI->excel->getActiveSheet()->setCellValue('BE'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('BF'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('BG'.$j,'');

				$CI->excel->getActiveSheet()->setCellValue('BH'.$j,'');

				$CI->excel->getActiveSheet()->getStyle('E'.$j.':BH'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('U'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('Z'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AK'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AU'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AX'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('BH'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AX'.$j)->getFont()->setBold(true);
				$CI->excel->getActiveSheet()->getStyle('BH'.$j)->getFont()->setBold(true);
				$j++;
				
			}

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)->getFont()->setBold(true);
			$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':K'.$lastRowNum)
										->setCellValue('A'.$lastRowNum, 'Total');

			$CI->excel->getActiveSheet()->setCellValue('L'.$lastRowNum, round($emp_bac));
			$CI->excel->getActiveSheet()->setCellValue('M'.$lastRowNum, round($emp_da));
			$CI->excel->getActiveSheet()->setCellValue('N'.$lastRowNum, round($emp_hra));
			$CI->excel->getActiveSheet()->setCellValue('O'.$lastRowNum, round($emp_convy));
			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($emp_mob));
			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($emp_med));
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($emp_edu));
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, round($emp_city));
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, round($emp_enter));
			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, round($emp_gross));

			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($pf_earn));
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($ESIC_earn));
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, round($ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, round($total_ctc));

			$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, round($basic_net));
			$CI->excel->getActiveSheet()->setCellValue('AB'.$lastRowNum, round($DA_total));
			$CI->excel->getActiveSheet()->setCellValue('AC'.$lastRowNum, round($HRA_total));
			$CI->excel->getActiveSheet()->setCellValue('AD'.$lastRowNum, round($Conveyance_total));
			$CI->excel->getActiveSheet()->setCellValue('AE'.$lastRowNum, round($mobile_total_all));
			$CI->excel->getActiveSheet()->setCellValue('AF'.$lastRowNum, round($medical_total));
			$CI->excel->getActiveSheet()->setCellValue('AG'.$lastRowNum, round($education_total));
			$CI->excel->getActiveSheet()->setCellValue('AH'.$lastRowNum, round($city_total));
			$CI->excel->getActiveSheet()->setCellValue('AI'.$lastRowNum, round($entertainment_total));
			$CI->excel->getActiveSheet()->setCellValue('AJ'.$lastRowNum, round($other_total));
			$CI->excel->getActiveSheet()->setCellValue('AK'.$lastRowNum, round($total_earn_gross));

			$CI->excel->getActiveSheet()->setCellValue('AL'.$lastRowNum, round($tot_pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AM'.$lastRowNum, round($tot_ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AN'.$lastRowNum, round($pt_total));
			
			
			$CI->excel->getActiveSheet()->setCellValue('AO'.$lastRowNum, round($mobile_ded_total));
			$CI->excel->getActiveSheet()->setCellValue('AP'.$lastRowNum, round($emp_wise_ded));
			$CI->excel->getActiveSheet()->setCellValue('AQ'.$lastRowNum, round($adv_opening));
			$CI->excel->getActiveSheet()->setCellValue('AR'.$lastRowNum, round($adv_Addition));
			$CI->excel->getActiveSheet()->setCellValue('AS'.$lastRowNum, round($adv_recovery));
			$CI->excel->getActiveSheet()->setCellValue('AT'.$lastRowNum, round($adv_closing_amt));
			$CI->excel->getActiveSheet()->setCellValue('AU'.$lastRowNum, round($total_deduct_mnth));
			
			$CI->excel->getActiveSheet()->setCellValue('AV'.$lastRowNum, round($Bonus_total));			
			$CI->excel->getActiveSheet()->setCellValue('AW'.$lastRowNum, round($Arrears_total));
			$CI->excel->getActiveSheet()->setCellValue('AX'.$lastRowNum, round($total_net_pay));
			$CI->excel->getActiveSheet()->setCellValue('BC'.$lastRowNum, round(''));
			$CI->excel->getActiveSheet()->setCellValue('BH'.$lastRowNum, round(''));

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

		}
		/* end dynamic code here **************/
		
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="employee wise report.xls"'); //tell browser what's the file name
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

    function gen_employee_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year)
    {
    	$CI =& get_instance(); 
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Employee Register');

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

		$CI->excel->getActiveSheet()->mergeCells('A1:AE1');
		$CI->excel->getActiveSheet()->setCellValue('A1', "Form A\nEmployee Register\n[See Rule2(1) of the Ease of Compliance to Maintain Registers Under Various Labour Laws Rules,2017]\n[Part A : For All Establishment] [Part A : For All Establishment]");

		$CI->excel->getActiveSheet()->mergeCells('A2:J2');
		$CI->excel->getActiveSheet()->setCellValue('A2', "Name of Establishment : MOON SEZ CONSULTANTS PRIVATE LIMITED");

		$CI->excel->getActiveSheet()->mergeCells('K2:T2');
		$CI->excel->getActiveSheet()->setCellValue('K2', "Name of Owner : Ratan Moondra");

		$CI->excel->getActiveSheet()->mergeCells('U2:AE2');
		$CI->excel->getActiveSheet()->setCellValue('U2', "LIN : ");

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A1:AE1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		$CI->excel->getActiveSheet()->mergeCells('A3:AE3');
		$CI->excel->getActiveSheet()->getStyle('A1:AE2')->getFont()->setBold(true);
		$CI->excel->getActiveSheet()->getStyle('A1:AE2')->getFont()->setSize(11);
		$CI->excel->getActiveSheet()->getStyle('A1:AE2')->getAlignment()->setWrapText(true);

		$CI->excel->getActiveSheet()->setCellValue('A4', 'Sr. No.'); 
		$CI->excel->getActiveSheet()->setCellValue('B4', 'Employee Code'); 
		$CI->excel->getActiveSheet()->setCellValue('C4', 'Name');
		$CI->excel->getActiveSheet()->setCellValue('D4', 'Surname');		
		$CI->excel->getActiveSheet()->setCellValue('E4', 'Gender');		
		$CI->excel->getActiveSheet()->setCellValue('F4', "Father's/Spouse Name");
		$CI->excel->getActiveSheet()->setCellValue('G4', 'Date of Birth');
		$CI->excel->getActiveSheet()->setCellValue('H4', 'Nationality');
		$CI->excel->getActiveSheet()->setCellValue('I4', 'Education Level');
		$CI->excel->getActiveSheet()->setCellValue('J4', 'Date of Joining');
		$CI->excel->getActiveSheet()->setCellValue('K4', 'Designation');
		$CI->excel->getActiveSheet()->setCellValue('L4', 'Category Address *(HS/S/SS/US)');
		$CI->excel->getActiveSheet()->setCellValue('M4', 'Type of Employment');
		$CI->excel->getActiveSheet()->setCellValue('N4', 'Mobile');
		$CI->excel->getActiveSheet()->setCellValue('O4', 'UAN');
		$CI->excel->getActiveSheet()->setCellValue('P4', 'PAN');
		$CI->excel->getActiveSheet()->setCellValue('Q4', 'ESIC IP');
		$CI->excel->getActiveSheet()->setCellValue('R4', 'LWF');
		$CI->excel->getActiveSheet()->setCellValue('S4', 'Aadhar');
		$CI->excel->getActiveSheet()->setCellValue('T4', 'Bank A/C Number');
		$CI->excel->getActiveSheet()->setCellValue('U4', 'Bank');
		$CI->excel->getActiveSheet()->setCellValue('V4', 'Branch (IFSC)');
		$CI->excel->getActiveSheet()->setCellValue('W4', 'Present Address');
		$CI->excel->getActiveSheet()->setCellValue('X4', 'Permanant Address');
		$CI->excel->getActiveSheet()->setCellValue('Y4', 'Service Book No');
		$CI->excel->getActiveSheet()->setCellValue('Z4', 'Date of Exit');
		$CI->excel->getActiveSheet()->setCellValue('AA4', 'Reason for Exit');
		$CI->excel->getActiveSheet()->setCellValue('AB4', 'Mark of Indentification');
		$CI->excel->getActiveSheet()->setCellValue('AC4', 'Photo');
		$CI->excel->getActiveSheet()->setCellValue('AD4', 'Specimen Signature/Thumb Impression');
		$CI->excel->getActiveSheet()->setCellValue('AE4', 'Remarks');	

		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(60);
		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(7);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A4:AE4')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A4:AE4')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A4:AE4')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A4:AE4')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A4:AE4')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A4:AE4')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A4:AE4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

		/* start dynamic code from here *********/
		$lastRowNum=4;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
	 		$j=5;
	 		$lastRowNum= $lastRowNum + count($emp_basic_data);
	 		$sr=1;
	 		$total_num_days_of_month=0;
	 		$total_absent_day=0;
	 		$total_leave=0;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$earn_allowance=0;
	 			$allowance = $CI->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->emp);
				foreach($allowance as $row)
	 			{
	 				$earn_allowance = $earn_allowance + $row->earn_value;
	 			}

	 			$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr);	 			 			
	 			$CI->excel->getActiveSheet()->setCellValue('B'.$j,(isset($key->employee_id) && !empty($key->employee_id))?$key->employee_id:'');
	 			$CI->excel->getActiveSheet()->setCellValue('C'.$j,(isset($key->firstname) && !empty($key->firstname))?$key->firstname:'');
	 			$CI->excel->getActiveSheet()->setCellValue('D'.$j,(isset($key->lastname) && !empty($key->lastname))?$key->lastname:'');
	 			$CI->excel->getActiveSheet()->setCellValue('E'.$j,(isset($key->gender) && !empty($key->gender))?$key->gender:'');
	 			$CI->excel->getActiveSheet()->setCellValue('F'.$j,(isset($key->father_name) && !empty($key->father_name))?$key->father_name:'');
	 			$CI->excel->getActiveSheet()->setCellValue('G'.$j,(isset($key->date_of_birth) && !empty($key->date_of_birth))?date('d-m-Y',strtotime($key->date_of_birth)):'');
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,'Indian');
				$CI->excel->getActiveSheet()->setCellValue('I'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('J'.$j,(isset($key->date_of_joining) && !empty($key->date_of_joining))?date('d-m-Y',strtotime($key->date_of_joining)):'');
				$CI->excel->getActiveSheet()->setCellValue('K'.$j,(isset($key->desig_id) && !empty($key->desig_id))?$key->desig_id:'');
				$CI->excel->getActiveSheet()->setCellValue('L'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('M'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('N'.$j,(isset($key->personal_mobile_num) && !empty($key->personal_mobile_num))?$key->personal_mobile_num:'');
				
				$CI->excel->getActiveSheet()->setCellValue('O'.$j,(isset($key->pf_acc_no) && !empty($key->pf_acc_no))?$key->pf_acc_no:'');
				$CI->excel->getActiveSheet()->getStyle('O'.$j)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

				$CI->excel->getActiveSheet()->setCellValue('P'.$j,(isset($key->pan_number) && !empty($key->pan_number))?$key->pan_number:'');
				$CI->excel->getActiveSheet()->setCellValue('Q'.$j,(isset($key->esic_acc_no) && !empty($key->esic_acc_no))?$key->esic_acc_no:'');
				$CI->excel->getActiveSheet()->setCellValue('R'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('S'.$j,(isset($key->aadhar_number) && !empty($key->aadhar_number))?$key->aadhar_number:'');
				$CI->excel->getActiveSheet()->setCellValue('T'.$j,(isset($key->bank_acc_no) && !empty($key->bank_acc_no))?$key->bank_acc_no:'');
				$CI->excel->getActiveSheet()->setCellValue('U'.$j,(isset($key->bank_name) && !empty($key->bank_name))?$key->bank_name:'');
				$CI->excel->getActiveSheet()->setCellValue('V'.$j,(isset($key->ifsc_code) && !empty($key->ifsc_code))?$key->ifsc_code:'');
				$CI->excel->getActiveSheet()->setCellValue('W'.$j,(isset($key->local_address) && !empty($key->local_address))?$key->local_address:'');
				$CI->excel->getActiveSheet()->setCellValue('X'.$j,(isset($key->permanent_add1) && !empty($key->permanent_add1))?$key->permanent_add1:'');
				$CI->excel->getActiveSheet()->setCellValue('Y'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('Z'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('AA'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('AB'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('AC'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('AD'.$j,'');
				$CI->excel->getActiveSheet()->setCellValue('AE'.$j,'');

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':AE'.$j)->applyFromArray($allborders);
				$CI->excel->getActiveSheet()->getStyle('E'.$j.':AE'.$j)->getAlignment()->setWrapText(true);
				$CI->excel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$sr++;
				$j++;
			}
		}
		$CI->excel->getActiveSheet()->mergeCells('A'.$j.':L'.$j);
		$CI->excel->getActiveSheet()->getRowDimension($j)->setRowHeight(5);

		foreach(range('A','Z') as $column) {
		    $CI->excel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
		}

		$j = $j+2;
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('test_img');
		$objDrawing->setPath('./images/logo/stamp.jpg');
		$objDrawing->setCoordinates('D'.$j);                      
		//setOffsetX works properly
		$objDrawing->setOffsetX(5); 
		$objDrawing->setOffsetY(5);                
		//set width, height
		$objDrawing->setWidth(100); 
		$objDrawing->setHeight(150); 
		$objDrawing->setWorksheet($CI->excel->getActiveSheet());
		
		/* end dynamic code here **************/
		$filename = 'Employee Register - '.$month.' '.$year.'.xls'; //save our workbook as this file name
		
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

    function exportBOBReport($bob_data, $month){
    	$fileName="./excelfiles/BOB/RDS-Payroll-Bank-Advice.xls";
    	$inputFileType = PHPExcel_IOFactory::identify($fileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($fileName);

		// Change the file
		if(isset($bob_data) && !empty($bob_data)){
			$i=4;
			foreach ($bob_data as $row ) {
				$i++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row["account_number"]);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row["account_number"]);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row["emp_name"]);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row["net_pay"]);
			}
		}
		
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="RDS Payroll Bank Advice '.$month.'.xls"'); 
		//tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		// Write the file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $inputFileType);
		$objWriter->save('php://output');
    }

    function salarySlipReportExcelFormat_newTbl($emp_basic_data,$company_name,$num_days_of_month,$month,$year,$salMonth, $export, $showbonus =false)
    {

    	
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');
    	$CI->load->library('excel');

		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
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
		$CI->excel->getActiveSheet()->setTitle('Salary Sheet - '.$month.' '.$year);
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
		$CI->excel->getActiveSheet()->mergeCells('A1:BH1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');
		$CI->excel->getActiveSheet()->getStyle('A1:BH1')->applyFromArray($allborders);

		$CI->excel->getActiveSheet()->getStyle('A2:BH2')
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
		$CI->excel->getActiveSheet()->mergeCells('A2:BH2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');


		$CI->excel->getActiveSheet()->getStyle('A2:BH2')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

		//set aligment to center for that merged cell (A1 to V1)
		$CI->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		


		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.');
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Employee ID');
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Name of the Employee');	
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Location');		
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Working Days');
		// paid leave
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Sanction Paid Leave');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Total Utilsed Paid Leave');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'Balance Paid Leave');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'Paid Leave Utilsed In Month');
		// sick leave
		$CI->excel->getActiveSheet()->setCellValue('J3', 'Sanction Sick Leave');
		$CI->excel->getActiveSheet()->setCellValue('K3', 'Total Utilsed Sick Leave');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'Balance Sick Leave');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'Sick Leave Utilsed In Month');

		$CI->excel->getActiveSheet()->setCellValue('N3', 'Actual Present Days');
		$CI->excel->getActiveSheet()->setCellValue('O3', 'Total Present Days');
		// Earning Allowance
		$CI->excel->getActiveSheet()->setCellValue('P3', 'Basic');
		$CI->excel->getActiveSheet()->setCellValue('Q3', 'DA Allowance');
		$CI->excel->getActiveSheet()->setCellValue('R3', 'HRA');
		$CI->excel->getActiveSheet()->setCellValue('S3', 'Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('T3', 'Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('U3', 'Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('V3', 'Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('W3', 'City Allowance');
		$CI->excel->getActiveSheet()->setCellValue('X3', 'Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('Y3', 'Other Allowance');
		$CI->excel->getActiveSheet()->setCellValue('Z3', 'Bonus'); 
		$CI->excel->getActiveSheet()->setCellValue('AA3', 'Total Gross'); 
		// ctc
		$CI->excel->getActiveSheet()->setCellValue('AB3', 'PF (Employers Contribution)'); 
		$CI->excel->getActiveSheet()->setCellValue('AC3', 'ESIC (Employers Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('AD3', 'PF (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('AE3', 'ESIC (Employees Contribution)');
		$CI->excel->getActiveSheet()->setCellValue('AF3', 'CTC');
		// salary on number of days
		$CI->excel->getActiveSheet()->setCellValue('AG3', 'Earn Basic');
		$CI->excel->getActiveSheet()->setCellValue('AH3', 'Earn DA');
		$CI->excel->getActiveSheet()->setCellValue('AI3', 'Earn HRA');
		$CI->excel->getActiveSheet()->setCellValue('AJ3', 'Earn Conveyance');
		$CI->excel->getActiveSheet()->setCellValue('AK3', 'Earn Mobile Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AL3', 'Earn Medical Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AM3', 'Earn Education Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AN3', 'Earn City Allowance');  
		$CI->excel->getActiveSheet()->setCellValue('AO3', 'Earn Entertianment Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AP3', 'Earn Other Allowance');
		$CI->excel->getActiveSheet()->setCellValue('AQ3', 'Earn Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AR3', 'Total Earn Gross');
		$CI->excel->getActiveSheet()->setCellValue('AS3', 'Earn Gross For ESIC');
		$CI->excel->getActiveSheet()->setCellValue('AT3', 'Employees PF Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AU3', 'Employees ESIC  Deduction ');
		$CI->excel->getActiveSheet()->setCellValue('AV3', 'Professional Tax');
		// if Deducation
		$CI->excel->getActiveSheet()->setCellValue('AW3', 'Telephone (Co.)');
		$CI->excel->getActiveSheet()->setCellValue('AX3', 'Others Deduction');
		$CI->excel->getActiveSheet()->setCellValue('AY3', 'Advance Opening'); 
		$CI->excel->getActiveSheet()->setCellValue('AZ3', 'Advance Addition'); 
		$CI->excel->getActiveSheet()->setCellValue('BA3', 'Advance Recovery'); 
		$CI->excel->getActiveSheet()->setCellValue('BB3', 'Advance Closing');
		$CI->excel->getActiveSheet()->setCellValue('BC3', 'Total Deduction for the month');
		/*$CI->excel->getActiveSheet()->setCellValue('AU3', 'Bonus');
		$CI->excel->getActiveSheet()->setCellValue('AV3', 'Arrears');*/
		//Total Salary 
		$CI->excel->getActiveSheet()->setCellValue('BD3', 'Net Pay');
		$CI->excel->getActiveSheet()->setCellValue('BE3', 'WFH Days');
		$CI->excel->getActiveSheet()->setCellValue('BF3', 'WFH Deduction %');
		$CI->excel->getActiveSheet()->setCellValue('BG3', 'WFH Deduction Amount');
		$CI->excel->getActiveSheet()->setCellValue('BH3', 'Net Pay After WFH');

		if($showbonus){
		$CI->excel->getActiveSheet()->setCellValue('BI3', 'Variable %');
		$CI->excel->getActiveSheet()->setCellValue('BJ3', 'Variable Bonus Amount');
		}
		//Star rate
		// $CI->excel->getActiveSheet()->setCellValue('AX3', 'Red Star');
		// $CI->excel->getActiveSheet()->setCellValue('AY3', 'Gold Star');
		// $CI->excel->getActiveSheet()->setCellValue('AZ3', 'Balance Red Star');
		// $CI->excel->getActiveSheet()->setCellValue('BA3', 'Balance Gold Star');
		// $CI->excel->getActiveSheet()->setCellValue('BB3', 'Star deducation');
		/*$CI->excel->getActiveSheet()->setCellValue('BC3', 'Black Star');
		$CI->excel->getActiveSheet()->setCellValue('BD3', 'Balance Black Star');*/
		//$CI->excel->getActiveSheet()->setCellValue('BC3', 'Balance Gold Star');
		/*$CI->excel->getActiveSheet()->setCellValue('BD3', 'Black Star deducation');*/
		//$CI->excel->getActiveSheet()->setCellValue('BD3', 'Salary after star deducation');


		$CI->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);
		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(5);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(0);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(25);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(40);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(10);		
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(10);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(10);		
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(37)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(38)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(39)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(40)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(41)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(42)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(43)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(44)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(45)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(46)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(47)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(48)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(49)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(50)->setWidth(15);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(51)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(52)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(53)->setWidth(10);

		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(54)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(55)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(56)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(57)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(58)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(59)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(60)->setWidth(10);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(61)->setWidth(10);
		// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(51)->setWidth(10);
		// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(52)->setWidth(12);
		// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(53)->setWidth(15);
		// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(54)->setWidth(15);
		// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(55)->setWidth(15);
		// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(56)->setWidth(15);
		// $CI->excel->getActiveSheet()->getColumnDimensionByColumn(57)->setWidth(15);
		/************ Wrap A2 V3 content */  

		//change the font name
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->setName('Bookman Old Style');
        //change the font size
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->setSize(10);
		//make the font become bold
		$CI->excel->getActiveSheet()->getStyle('A2:BH3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getFont()->getColor()->setRGB('FFFFFFFF');														
										
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->applyFromArray($allborders);
		$CI->excel->getActiveSheet()->getStyle('A3:BH3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);
		/* start dynamic code from here *********/
		$lastRowNum=4;
 		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
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
	 		$DA_total = 0;
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
			$education_total=0;
			$adv_opening = 0;
			$adv_Addition = 0;
			$adv_recovery = 0;
			$adv_closing_amt = 0;

			$mobile_total_all=0;
			$otherAllow_total_all=0;
			$recy_ttl = 0;
			$entertainment_total = 0;
			$pf_earn = 0;
			$ESIC_earn = 0;
			$pf_deduct = 0;
			$ESIC_deduct = 0;
			$tot_pf_deduct=0;
			$tot_ESIC_deduct=0;
			$pay_during_month = 0;
			$pay_beforePt=0;
			$final_net_pay=0;
			$basic_net=0;
			$total_ctc=0;
			$total_gross=0;
			$total_earn_gross=0;
			$total_earn_gross1=0;
			$total_net_salary=0;
			$total_deduct_mnth=0;
			$total_net_pay=0;
			//$Bonus_total=0;
			//emp info
			$emp_bac = 0;
			$emp_da = 0;
			$emp_hra = 0;
			$emp_earn_hra=0;
			$emp_convy = 0;
			$emp_mob = 0;
			$emp_med = 0;
			$emp_edu = 0;
			$emp_city = 0;
			$emp_enter = 0;
			$emp_gross = 0;
			$emp_bonus = 0;
			$emp_tot_alw = 0;
	 		$sr=1;
	 		$total_star_deduct=0;
			$total_star_pay=0;
			$actual_present_day=0;

			$da = 0;
				$hra = 0;
				$conveyance = 0;
				$mobile = 0;
				$medical = 0;
				$education = 0;
				$city = 0;
				$entertainment = 0;
				$bonus = 0;
				$total_allowance=0;
	 		foreach ($emp_basic_data as $key)
	 		{
	 			$netBasicTotK = 0;
	 			$emp_wise_ded=0;
	 			$boun_emp = 0;
	 			$emp_wise_add_deduction = 0;
	 		 	//echo $key->empl_id; echo '<br>';
				// $emp_allData = $CI->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
				// // print_r($emp_allData); 
				// // echo $CI->db->last_query();
				// $emp_Ded_allData = $CI->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
				// $earn_allowance = $CI->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->empl_id);
				// $emp_basic = $CI->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->empl_id);
				$emp_leave_data = $CI->Slip_vish_model->fetch_emp_leave_data($key->user_id,$month,$year);
               /* echo $CI->db->last_query();exit();	 */   
				$emp_paid_leave = $CI->Slip_vish_model->fetch_paid_leave($key->user_id,$month,$year);
              

				$emp_creditleave_data = $CI->Slip_vish_model->fetch_emp_credit_leave_data($key->user_id,$year);
				
				$emp_creditleave = (isset($emp_creditleave_data->no_leave_credit) && !empty($emp_creditleave_data->no_leave_credit))?$emp_creditleave_data->no_leave_credit:'0';

				$CI->excel->getActiveSheet()->setCellValue('A'.$j,$sr++);
				$CI->excel->getActiveSheet()->setCellValue('B'.$j,0);
				$CI->excel->getActiveSheet()->setCellValue('C'.$j,$key->emp_name);
				$CI->excel->getActiveSheet()->setCellValue('D'.$j,$key->department_name);
				$CI->excel->getActiveSheet()->setCellValue('E'.$j,$key->working_days);

				$monthsdiff = $CI->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
				$bal_leave_cnt=0;
				if($monthsdiff->months>=6)
				{
					$saction = $emp_creditleave;
				}else if(isset($emp_creditleave_data->no_leave_credit) && $emp_creditleave_data->no_leave_credit<0 && $monthsdiff->months<6){
					$bal_leave_cnt = $emp_creditleave_data->no_leave_credit;
					$saction=0;
				}else{
					$saction = 0;
				}
				//echo (isset($bal_leave_cnt)?$bal_leave_cnt:$saction); echo '<br>';
				$CI->excel->getActiveSheet()->setCellValue('F'.$j,$saction); //$emp_leave_data->total_leave
				/*if($emp_leave_data->bal_leave!=$emp_creditleave && !empty($emp_leave_data->bal_leave))
				{
					$earn_leave = $emp_creditleave-$emp_leave_data->bal_leave;
				}else{
					$earn_leave = 0;
				}*/
				/*$earn_leave=$emp_leave_data->earn_leave;*/
				$CI->excel->getActiveSheet()->setCellValue('G'.$j,$key->sanction_leave); //$emp_leave_data->earn_leave
				$CI->excel->getActiveSheet()->setCellValue('H'.$j,$key->total_utilsed_leave);
				/*$CI->excel->getActiveSheet()->setCellValue('H'.$j,$emp_leave_data->bal_leave);*/
				/*$CI->excel->getActiveSheet()->setCellValue('I'.$j,$emp_paid_leave->paid_leave);*/
              	$CI->excel->getActiveSheet()->setCellValue('I'.$j,$key->balance_leave); 
              	
              	// sick leave
              	$emp_sick_leave_data = $CI->Slip_vish_model->fetch_emp_sick_leave_data($key->user_id,$year);
				
				$emp_sick_leave = (isset($emp_sick_leave_data->sick_leave_creadit) && !empty($emp_sick_leave_data->sick_leave_creadit))?$emp_sick_leave_data->sick_leave_creadit:'0';

				$monthsdiff = $CI->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
				$bal_leave_cnt=0;
				if($monthsdiff->months>=6)
				{
					$saction_sick = $emp_sick_leave;
				}else if(isset($emp_sick_leave_data->sick_leave_creadit) && $emp_sick_leave_data->sick_leave_creadit<0 && $monthsdiff->months<6){
					$bal_leave_cnt = $emp_sick_leave_data->sick_leave_creadit;
					$saction_sick=0;
				}else{
					$saction_sick=0;
				}

              	$CI->excel->getActiveSheet()->setCellValue('J'.$j,$saction_sick);

              	$emp_sick_leave_data = $CI->Slip_vish_model->fetch_emp_sick_leave_data1($key->user_id,$month,$year);
              	
              	$CI->excel->getActiveSheet()->setCellValue('K'.$j,(isset($emp_sick_leave_data->earn_leave) && !empty($emp_sick_leave_data->earn_leave))?$emp_sick_leave_data->earn_leave:0);
              	$CI->excel->getActiveSheet()->setCellValue('L'.$j,(isset($emp_sick_leave_data->bal_leave) && !empty($emp_sick_leave_data->bal_leave) && $saction!=0)?$emp_sick_leave_data->bal_leave:$saction_sick-$emp_sick_leave_data->earn_leave);
              	$CI->excel->getActiveSheet()->setCellValue('M'.$j,(isset($emp_sick_leave_data->earn_leave1) && !empty($emp_sick_leave_data->earn_leave1))?$emp_sick_leave_data->earn_leave1:0);

              	// total leave
              	// $actual_present_day=($key->work_day)-($emp_leave_data->earn_leave1)-($emp_sick_leave_data->earn_leave1);
              	// $total_present_day=$actual_present_day+($emp_leave_data->earn_leave1)+($emp_sick_leave_data->earn_leave1);
				$CI->excel->getActiveSheet()->setCellValue('N'.$j,$key->actual_present_days);
				$CI->excel->getActiveSheet()->setCellValue('O'.$j,$key->total_present_days);
				
				$basic = $key->basic;//$emp_basic->emp_basic;
				$CI->excel->getActiveSheet()->setCellValue('P'.$j,round($key->basic));
				$emp_bac = $emp_bac + $basic;

				$CI->excel->getActiveSheet()->setCellValue('Q'.$j,round($key->da_allowance));
				$emp_da = $emp_da + $key->da_allowance; 
				$da = $key->da_allowance;

				$CI->excel->getActiveSheet()->setCellValue('R'.$j,round($key->hra));
				$emp_hra = $emp_hra + $key->hra;
				$hra = $key->hra;

				$CI->excel->getActiveSheet()->setCellValue('S'.$j,round($key->conveyance));
				$emp_convy = $emp_convy + $key->conveyance;
				$conveyance = $key->conveyance;

				$CI->excel->getActiveSheet()->setCellValue('T'.$j,round($key->mobile_allowance));
				$emp_mob = $emp_mob + $key->mobile_allowance;
				$mobile = $key->mobile_allowance;

				$CI->excel->getActiveSheet()->setCellValue('U'.$j,round($key->medical_allowance));
				$emp_med = $emp_med + $key->medical_allowance;
				$medical = $key->medical_allowance;

				$CI->excel->getActiveSheet()->setCellValue('V'.$j,round($key->education_allowance));
				$emp_edu = $emp_edu + $key->education_allowance;
				$education = $key->education_allowance;

				$CI->excel->getActiveSheet()->setCellValue('W'.$j,round($key->city_allowance));
				$emp_city = $emp_city + $key->city_allowance;
				$city = $key->city_allowance;

				$CI->excel->getActiveSheet()->setCellValue('X'.$j,round($key->entertianment_allowance));
				$emp_enter = $emp_enter + $key->entertianment_allowance;
				$entertainment = $key->entertianment_allowance;

				$CI->excel->getActiveSheet()->setCellValue('Y'.$j,round($key->other_allowance));
				$emp_tot_alw = $emp_tot_alw + $key->other_allowance;
				$total_allowance = $key->other_allowance;

				$CI->excel->getActiveSheet()->setCellValue('Z'.$j,round($key->bonus));
				$emp_bonus = $emp_bonus + $key->bonus;
				$bonus = $key->bonus;

				

				//EARNING ALLOWANCE				
				
				
				$gross = $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 + ($bonus)*1 +($total_allowance)*1;

				$gross1 = $basic + ($da)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 +($total_allowance)*1;

				$CI->excel->getActiveSheet()->setCellValue('AA'.$j,round($key->total_gross));
				$emp_gross = $emp_gross + $key->total_gross;

				//CTC
				$CI->excel->getActiveSheet()->setCellValue('AB'.$j,round($key->pf_earn));
				$pf_earn = $pf_earn + $key->pf_earn;

				$CI->excel->getActiveSheet()->setCellValue('AC'.$j,round($key->esic_earn));
				$ESIC_earn = $ESIC_earn + $key->esic_earn;

				$CI->excel->getActiveSheet()->setCellValue('AD'.$j,round($key->pf_deduct));
				$pf_deduct=$pf_deduct+$key->pf_deduct;

				$CI->excel->getActiveSheet()->setCellValue('AE'.$j,round($key->esic_deduct));
				$ESIC_deduct=$ESIC_deduct+$key->esic_deduct;

				// $ctc = $gross+$key->pf_earn+$key->ESIC_earn;//+$key->pf_deduct+$key->ESIC_deduct;
				$CI->excel->getActiveSheet()->setCellValue('AF'.$j,round($key->ctc));
				$total_ctc = $total_ctc + $key->ctc;
				
				//EARNING ALLOWANCE/NO OF DAYS
				$bsNet = 0;
				// if(isset($key->net_pay) && $key->net_pay>0)
				// { 
				// 	$bsNet = $key->net_pay + $key->pt_amt;
				// 	$netBasicTotK = $bsNet;
				// }

				// $basic = $key->basic_net/$num_days_of_month;					
				// $emp_basic = $key->work_day*$basic; 
				$CI->excel->getActiveSheet()->setCellValue('AG'.$j,round($key->earn_basic));
				$basic_net = $basic_net + $key->earn_basic;

				// $hra = $key->hra/$num_days_of_month;
				// $emp_earn_hra = $key->work_day*$hra;


				$total_mobile=0;
				$total_city=0;
				$total_medi=0;
				$total_edu=0;
				$total_entertainment=0;
				$otherAllow_total = 0;
				$total_bonus=0;
				$total_da=0;

				$CI->excel->getActiveSheet()->setCellValue('AH'.$j,round($key->earn_da));
				$DA_total = $DA_total + $key->earn_da;
				$total_da = $key->earn_da;

				$CI->excel->getActiveSheet()->setCellValue('AI'.$j,round($key->earn_hra));
				$HRA_total = $HRA_total + $key->earn_hra;

				// $convey = $key->convey/$num_days_of_month;
				// $emp_convey = $key->work_day*$convey;

				$CI->excel->getActiveSheet()->setCellValue('AJ'.$j,round($key->earn_conveyance));
				$Conveyance_total = $Conveyance_total + $key->earn_conveyance;

				$CI->excel->getActiveSheet()->setCellValue('AK'.$j,round($key->earn_mobile_allowance));
				$mobile_total_all = $mobile_total_all + $key->earn_mobile_allowance;
				$total_mobile = $key->earn_mobile_allowance;

				$CI->excel->getActiveSheet()->setCellValue('AL'.$j,round($key->earn_medical_allowance));
				$medical_total = $medical_total + $key->earn_medical_allowance;
				$total_medi = $key->earn_medical_allowance;

				
				$CI->excel->getActiveSheet()->setCellValue('AM'.$j,round($key->earn_education_allowance));
				$education_total = $education_total + $key->earn_education_allowance;
				$total_edu = $key->earn_education_allowance;

				$CI->excel->getActiveSheet()->setCellValue('AN'.$j,round($key->earn_city_allowance));
				$city_total = $city_total + $key->earn_city_allowance;
				$total_city = $key->earn_city_allowance;

				$CI->excel->getActiveSheet()->setCellValue('AO'.$j,round($key->earn_entertianmenta_allowance));
				$entertainment_total = $entertainment_total + $key->earn_entertianmenta_allowance;
				$total_entertainment = $key->earn_entertianmenta_allowance;

				$CI->excel->getActiveSheet()->setCellValue('AP'.$j,round($key->earn_other_allowance));
				$otherAllow_total_all = $otherAllow_total_all + $key->earn_other_allowance;
				$otherAllow_total = $key->earn_other_allowance;

				$CI->excel->getActiveSheet()->setCellValue('AQ'.$j,round($key->earn_bonus));
				$Bonus_total = $Bonus_total + $key->earn_bonus;
				$total_bonus=$key->earn_bonus;

				
							
				

				// $earn_gross = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($total_bonus)*1 + ($otherAllow_total)*1;

				$CI->excel->getActiveSheet()->setCellValue('AR'.$j,round($key->earn_bonus));
				$total_earn_gross = $total_earn_gross + $key->earn_bonus; 
				
				// $earn_gross1 = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1;

				$CI->excel->getActiveSheet()->setCellValue('AS'.$j,round($key->earn_gross_for_esic));
				$total_earn_gross1 = $total_earn_gross1 + $key->earn_gross_for_esic; 

				// $earn_gross_pf = ($emp_basic)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1;
  
				$CI->excel->getActiveSheet()->setCellValue('AT'.$j,round($key->employees_pf_deduction));
				$tot_pf_deduct=$tot_pf_deduct+$key->employees_pf_deduction;
				
				// $pf_dedct1 = $key->pf_deduct;
				// $pfd_val = $key->pf_deduct/$num_days_of_month;
				
				

				// $esicd_val = $key->ESIC_deduct/$num_days_of_month;
				// $esic_dedct = $key->work_day*$esicd_val;
				
						
				$CI->excel->getActiveSheet()->setCellValue('AU'.$j,round($key->employees_esic_deduction));
				$tot_ESIC_deduct=$tot_ESIC_deduct+$key->employees_esic_deduction;
				
				

				$CI->excel->getActiveSheet()->setCellValue('AV'.$j,$key->professional_tax);
				$pt_total = $pt_total + $key->professional_tax;

				$CI->excel->getActiveSheet()->setCellValue('AW'.$j,round($key->telephone_co));
				$mobile_ded_total = $mobile_ded_total + $key->telephone_co;

				$CI->excel->getActiveSheet()->setCellValue('AX'.$j,round($key->others_deduction));
				$emp_wise_ded = $emp_wise_ded+$key->others_deduction;

				$CI->excel->getActiveSheet()->setCellValue('AY'.$j, round($key->advance_opening));
				$CI->excel->getActiveSheet()->setCellValue('AZ'.$j, round($key->advance_addition));
				$CI->excel->getActiveSheet()->setCellValue('BA'.$j, round($key->advance_recovery));
				$CI->excel->getActiveSheet()->setCellValue('BB'.$j, round($key->advance_closing));
				
				if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
				{
					$recy_total=0;
					$Advance_deduction=0;
					foreach ($emp_Ded_allData as $rec)
					{
						if ($rec->deduction_id == 6)
						{
							$CI->excel->getActiveSheet()->setCellValue('AY'.$j,round($rec->deduct_value));
							$recy_total = $rec->deduct_value;
							
							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
							$per_emp_advance = $per_emp_advance-$rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total+$per_emp_advance;
							
							if($per_emp_advance>0)
							{ }
							else
							{
								$per_emp_advance=0;
							}
							
						}
						elseif(($rec->deduction_id == 'Arrears/ others') || ($rec->deduction_id == 'Deduction Arrears'))
						{
							$emp_wise_add_deduction = $emp_wise_add_deduction+$rec->deduct_value;
						}else{
						
						}				
					}
				}
				
				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing;

				// $total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
				$CI->excel->getActiveSheet()->setCellValue('BC'.$j,round($key->total_deduction_for_the_month));
				$total_deduct_mnth = $total_deduct_mnth + $key->total_deduction_for_the_month;

				/*//earning arrers
				$CI->excel->getActiveSheet()->setCellValue('AV'.$j,round($key->earn_arrears));
				$Arrears_total = $Arrears_total + $key->earn_arrears;
				*/
				//NET PAY
				// $net_pay = ($earn_gross - $total_deduction) + $key->earn_arrears;
				$CI->excel->getActiveSheet()->setCellValue('BD'.$j,round($key->net_pay));
				$CI->excel->getActiveSheet()->setCellValue('BE'.$j,round($key->wfh_days));
				$CI->excel->getActiveSheet()->setCellValue('BF'.$j,round($key->wfh_deduct_per));
				
				// $wfo_days = $total_present_day - $key->wfh_day;
				// $per_day_amt = $net_pay/$total_present_day;
				// $wfo_amt = $per_day_amt*$wfo_days;
				// $wfh_amt = $per_day_amt*$key->wfh_day;
				// $wfh_deduct_amt = $wfh_amt*$key->wfh_deduct_per/100;
				$CI->excel->getActiveSheet()->setCellValue('BG'.$j,round($key->wfh_deduction_amount));
				$CI->excel->getActiveSheet()->setCellValue('BH'.$j,round($key->net_pay_after_wfh));

				if($showbonus){
					$CI->excel->getActiveSheet()->setCellValue('BI'.$j,round($key->var_per));
					$CI->excel->getActiveSheet()->setCellValue('BJ'.$j,round($key->var_amount));
				}
				$total_net_pay = $total_net_pay + round($key->net_pay);

				

				$CI->excel->getActiveSheet()->getStyle('E'.$j.':BH'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('A'.$j.':B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																	->setWrapText(true);

				$CI->excel->getActiveSheet()->getStyle('AA'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AF'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('AR'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('BD'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				$CI->excel->getActiveSheet()->getStyle('BH'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');

				/*$CI->excel->getActiveSheet()->getStyle('AV'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');*/

				/*$CI->excel->getActiveSheet()->getStyle('BD'.$j)
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FFD8D8D8');*/

				$CI->excel->getActiveSheet()->getStyle('BD'.$j)->getFont()->setBold(true);
				//$CI->excel->getActiveSheet()->getStyle('BD'.$j)->getFont()->setBold(true);
				$j++;
				
			}//exit();

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BD'.$lastRowNum)->getFont()->setBold(true);
			$CI->excel->getActiveSheet()->mergeCells('A'.$lastRowNum.':O'.$lastRowNum)
										->setCellValue('A'.$lastRowNum, 'Total');

			$CI->excel->getActiveSheet()->setCellValue('P'.$lastRowNum, round($emp_bac));
			$CI->excel->getActiveSheet()->setCellValue('Q'.$lastRowNum, round($emp_da));
			$CI->excel->getActiveSheet()->setCellValue('R'.$lastRowNum, round($emp_hra));
			$CI->excel->getActiveSheet()->setCellValue('S'.$lastRowNum, round($emp_convy));
			$CI->excel->getActiveSheet()->setCellValue('T'.$lastRowNum, round($emp_mob));
			$CI->excel->getActiveSheet()->setCellValue('U'.$lastRowNum, round($emp_med));
			$CI->excel->getActiveSheet()->setCellValue('V'.$lastRowNum, round($emp_edu));
			$CI->excel->getActiveSheet()->setCellValue('W'.$lastRowNum, round($emp_city));
			$CI->excel->getActiveSheet()->setCellValue('X'.$lastRowNum, round($emp_enter));
			$CI->excel->getActiveSheet()->setCellValue('Y'.$lastRowNum, round($emp_tot_alw));
			$CI->excel->getActiveSheet()->setCellValue('Z'.$lastRowNum, round($emp_bonus));
			$CI->excel->getActiveSheet()->setCellValue('AA'.$lastRowNum, round($emp_gross));

			$CI->excel->getActiveSheet()->setCellValue('AB'.$lastRowNum, round($pf_earn));
			$CI->excel->getActiveSheet()->setCellValue('AC'.$lastRowNum, round($ESIC_earn));
			$CI->excel->getActiveSheet()->setCellValue('AD'.$lastRowNum, round($pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AE'.$lastRowNum, round($ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AF'.$lastRowNum, round($total_ctc));

			$CI->excel->getActiveSheet()->setCellValue('AG'.$lastRowNum, round($basic_net));
			$CI->excel->getActiveSheet()->setCellValue('AH'.$lastRowNum, round($DA_total));
			$CI->excel->getActiveSheet()->setCellValue('AI'.$lastRowNum, round($HRA_total));
			$CI->excel->getActiveSheet()->setCellValue('AJ'.$lastRowNum, round($Conveyance_total));
			$CI->excel->getActiveSheet()->setCellValue('AK'.$lastRowNum, round($mobile_total_all));
			$CI->excel->getActiveSheet()->setCellValue('AL'.$lastRowNum, round($medical_total));
			$CI->excel->getActiveSheet()->setCellValue('AM'.$lastRowNum, round($education_total));
			$CI->excel->getActiveSheet()->setCellValue('AN'.$lastRowNum, round($city_total));
			$CI->excel->getActiveSheet()->setCellValue('AO'.$lastRowNum, round($entertainment_total));
			$CI->excel->getActiveSheet()->setCellValue('AP'.$lastRowNum, round($otherAllow_total_all));
			$CI->excel->getActiveSheet()->setCellValue('AQ'.$lastRowNum, round($Bonus_total));
			$CI->excel->getActiveSheet()->setCellValue('AR'.$lastRowNum, round($total_earn_gross));
			$CI->excel->getActiveSheet()->setCellValue('AS'.$lastRowNum, round($total_earn_gross1));
			$CI->excel->getActiveSheet()->setCellValue('AT'.$lastRowNum, round($tot_pf_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AU'.$lastRowNum, round($tot_ESIC_deduct));
			$CI->excel->getActiveSheet()->setCellValue('AV'.$lastRowNum, round($pt_total));
			
			
			$CI->excel->getActiveSheet()->setCellValue('AW'.$lastRowNum, round($mobile_ded_total));
			$CI->excel->getActiveSheet()->setCellValue('AX'.$lastRowNum, round($emp_wise_ded));
			$CI->excel->getActiveSheet()->setCellValue('AY'.$lastRowNum, round($adv_opening));
			$CI->excel->getActiveSheet()->setCellValue('AZ'.$lastRowNum, round($adv_Addition));
			$CI->excel->getActiveSheet()->setCellValue('BA'.$lastRowNum, round($adv_recovery));
			$CI->excel->getActiveSheet()->setCellValue('BB'.$lastRowNum, round($adv_closing_amt));
			$CI->excel->getActiveSheet()->setCellValue('BC'.$lastRowNum, round($total_deduct_mnth));
			
			/*$CI->excel->getActiveSheet()->setCellValue('AU'.$lastRowNum, round($Bonus_total));			
			$CI->excel->getActiveSheet()->setCellValue('AV'.$lastRowNum, round($Arrears_total));*/
			$CI->excel->getActiveSheet()->setCellValue('BD'.$lastRowNum, round($total_net_pay));
			// $CI->excel->getActiveSheet()->setCellValue('BB'.$lastRowNum, round($total_star_deduct));
			// $CI->excel->getActiveSheet()->setCellValue('BD'.$lastRowNum, round($total_star_pay));

			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)
										->getFill()
										->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()->setARGB('EED8D8D8');
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.$lastRowNum.':BH'.$lastRowNum)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																				->setWrapText(true);

		}
		/* end dynamic code here **************/

		

		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$company_name.'-'.$salMonth.'.xls"'); //tell browser what's the file name
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
		if($export == true) {
		$objWriter->save('php://output'); 
		}else{
			$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
			$filename = './excelfiles/'.str_replace(" ", "-", $company_name).'-'.$salMonth.'.xls';
			$objWriter->save($filename);
			return 'excelfiles/'.str_replace(" ", "-", $company_name).'-'.$salMonth.'.xls';
		}
		
      

    }

}
/*
SELECT ec.no_leave_credit AS total_leave,count(ld.emp_leaveday_id) as earn_leave,(ec.no_leave_credit - count(ld.emp_leaveday_id)) AS bal_leave FROM tbl_emp_leave AS l JOIN tbl_emp_leaveday AS ld on l.leave_id=ld.leave_id JOIN tbl_emp_leave_credit AS ec ON l.user_id=ec.user_id WHERE l.user_id ='344' AND l.status = 'approved' AND l.display = 'Y' AND l.leavetype_id='2' AND ld.display='Y'

SELECT count(ld.emp_leaveday_id) as paid_leave FROM tbl_emp_leave AS l JOIN tbl_emp_leaveday AS ld on l.leave_id=ld.leave_id JOIN tbl_emp_leave_credit AS ec ON l.user_id=ec.user_id WHERE l.user_id ='344' AND l.status = 'approved' AND l.display = 'Y' AND l.leavetype_id='2' AND ld.display='Y' AND DATE_FORMAT(ld.leave_from_day, '%M')='August' AND DATE_FORMAT(ld.leave_from_day, '%Y')='2016'
*/