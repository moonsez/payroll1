<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Author :- Rahul
	work :-  
*/ 

class basic_controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('master_model');
        $this->load->model('slip_vish_model');
        $this->load->model('slip_aks_model');
    }

	public function basic_view()
	{
		$data['compDetails']=$this->master_model->SelectCompany();
		$this->load->view('basic_pt_salary',$data);
	}

	
	public function basic_bonus_view()
	{
		$data['compDetails']=$this->master_model->SelectCompany();
		$this->load->view('basic_bonus_pt_salary',$data);
	}
		
	public function fetchBasicData()
	{

		$slipMonth=$this->input->post('basic_slip_months');		
		$month_year_array = explode('-', $slipMonth);
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
		$company_id=$this->input->post('comp_id');

		$data['earning_data'] = $this->slip_vish_model->fetchAllByComp('tbl_emp_earn_allowance','company_id',$company_id);
		$data['deduction_data'] = $this->slip_vish_model->fetchAllByComp('tbl_emp_deduct_allowance','company_id',$company_id);
		$salExist = $this->slip_vish_model->checkSalaryExist($slipMonth,$company_id);

        if(isset($salExist) && !empty($salExist)){
			$data['basicWithPt']=$this->slip_vish_model->getExistData($slipMonth,$company_id);
			$data['AdvanceData']=$this->slip_vish_model->editfetchAdvanceData($company_id,$slipMonth);
		}else{ 
			$data['basicWithPt']=$this->slip_vish_model->getBasicSalary($company_id,$slipMonth);
			$data['AdvanceData']=$this->slip_vish_model->featchAdvanceData($company_id);
		}

		$data['mth'] = $month_year_array[0];
		$data['year'] = $month_year_array[1];
		$data['month']=$slipMonth; 
		$data['company_id']=$company_id; 
		$data['num_days_of_month']=$num_days_of_month;
		$this->load->view('basic_pt_tbl',$data); 
	}

	
	public function fetchBasicBonusData()
	{ 
		$slipMonth=$this->input->post('basic_slip_months');		
		$month_year_array = explode('-', $slipMonth);
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);

		//$company_id = $this->session->userdata('comp_id');
		$company_id=$this->input->post('comp_id');
		$data['earning_data'] = $this->slip_vish_model->fetchAllByComp('tbl_emp_earn_allowance','company_id',$company_id);
		//print_r($data['earning_data']); exit();
		$data['deduction_data'] = $this->slip_vish_model->fetchAllByComp('tbl_emp_deduct_allowance','company_id',$company_id);
		
		/*print_r($data['earning_data']);
		print_r($data['deduction_data']); 
		exit();*/

		$salExist = $this->slip_vish_model->checkSalaryExist($slipMonth,$company_id);
		//echo $this->db->last_query();exit();
		//print_r($salExist);	exit();		 
		if(isset($salExist) && !empty($salExist)){ 		
			$data['basicWithPt']=$this->slip_vish_model->getExistData($slipMonth,$company_id);
			$data['AdvanceData']=$this->slip_vish_model->editfetchAdvanceData($company_id,$slipMonth);
			//echo $this->db->last_query();exit();
		}
		
		$data['salExist'] = $salExist;
		$data['mth'] = $month_year_array[0];
		$data['year'] = $month_year_array[1];
		$data['month']=$slipMonth; 
		$data['company_id']=$company_id; 
		$data['num_days_of_month']=$num_days_of_month;
		
		$this->load->view('basic_bonus_pt_tbl',$data); 
	}


	public function basic_emp_tbl()
	{
		$this->load->view('basic_emp_tbl',$data);
	}

	public function allowance()
	{
		$company_id = $this->session->userdata('comp_id');
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('allowance_salary',$data);
	}

	public function calculation()
	{
		$month = $this->input->post('allowance_month');			
		$month_year_array = explode('-', $month);			  
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 	
		$year = $month_year_array[1] ;
		$monthOf = $month_year_array[0];
		$num_sundays = $this->total_sundays($monthOf,$year,$num_days_of_month);
		
		$data['num_sundays'] = $num_sundays;
		$data['num_days_of_month'] = $num_days_of_month;
		$data['slip_month']=$month; 
		$emp_id = $this->input->post('allowance_emp_name'); 

		if ($this->slip_vish_model->checkAllowanceDataexist($month,$emp_id)) {
			$data['earningData'] = $this->slip_vish_model->fetchEarningForUpdate($month,$emp_id);
			$data['deductData']=$this->slip_vish_model->fetchDeductionForUpdate($month,$emp_id);
			$data['ShowearningData']=$this->slip_vish_model->fetchEarning($emp_id);
			$data['totalDetails'] = $data['earningData'][0];
		}else{
			$data['earningData']=$this->slip_vish_model->fetchEarning($emp_id);
			$data['deductData']=$this->slip_vish_model->fetchDeduction($emp_id);
		}		

		$data['emp_id'] = $emp_id;
		$this->load->view('allowance_tbl',$data);
	}

	public function saveBasicPt()
	{
		$basic_id = $this->input->post('basic_id'); 
		$slip_month = $this->input->post('month');
		$month_year_array = explode('-', $slip_month);
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);

		$holiday = $this->input->post('holiday');
		$sundays = $this->input->post('sundays');			

		$emp_ids = $this->input->post('emp_id');
		$basic_amt = $this->input->post('emp_basic');
		
		$Allowance = $this->input->post('Allowance');
		$convey = $this->input->post('convey');
		$hra = $this->input->post('hra');
		$special_allowance = $this->input->post('special_allowance');
		$pf_earn = $this->input->post('pf_earn');
		$ESIC_earn = $this->input->post('ESIC_earn');

		$earn_arrears = $this->input->post('earn_arrears');
		$earn_bonus = $this->input->post('earn_bonus');
		$mobile_deduction = $this->input->post('mobile_deduction');
		$other_deduct = $this->input->post('other_deduct');

		$pt_amt = $this->input->post('emp_pt'); 
		$pf_deduct = $this->input->post('pf_deduct'); 
		$ESIC_deduct = $this->input->post('ESIC_deduct'); 
		$tds_deduct = $this->input->post('tds_deduct'); 
		$netBasic = $basic_amt;//$this->input->post('netBasic');
		
		$work_day = $this->input->post('work_day');
		$wfh_day = $this->input->post('wfh_day');
		$wfh_deduct_per = $this->input->post('wfh_deduct_per');
		$net_pay = $this->input->post('net_pay');
		$company_id = $this->input->post('comp_id'); 

		/*************** allowances details array *************/
		$earn_allow_emp_id = $this->input->post('earn_allow_emp_id');
		$earn_id = $this->input->post('earn_id');
		$earn_value = $this->input->post('earn_value');
		
		$deduct_allow_emp_id = $this->input->post('deduct_allow_emp_id');
		$deduction_id = $this->input->post('deduction_id');
		$deduct_value = $this->input->post('deduct_value');

		/********************** advance ***********************/
		$adv = $this->input->post('adv');
		
		$emp_advance_opening = $this->input->post('emp_advance_opening');
		$emp_advance_Addition = $this->input->post('emp_advance_Addition');
		$emp_advance_recovery = $this->input->post('emp_advance_recovery');
		$emp_advance_closing_amt = $this->input->post('emp_advance_closing_amt');
		
		/******************** end advance *********************/

		$memo_cnt = $this->input->post('memo_cnt');
		$memo_amt = $this->input->post('memo_amt');
		$late_punchin = $this->input->post('late_punchin');
		$early_punchout = $this->input->post('early_punchout');
		$no_punchout_cnt = $this->input->post('no_punchout_cnt');
		
		$late_punchin_halfdays = $this->input->post('late_punchin_halfdays');
		$total_half_days = $this->input->post('total_half_days');

		$half_days_due_to_early_punch_out = $this->input->post('half_days_due_to_early_punch_out');
		$no_min_4hr_work_cnt = $this->input->post('no_min_4hr_work_cnt');
		$no_min_8hr_work_cnt = $this->input->post('no_min_8hr_work_cnt');
		$total_full_days = $this->input->post('total_full_days');

        // print_r($earn_allow_emp_id);
		$earn_count = (isset($earn_allow_emp_id) && !empty($earn_allow_emp_id)?count($earn_allow_emp_id):0);
		$deduct_count = (isset($deduct_allow_emp_id) && !empty($deduct_allow_emp_id)?count($deduct_allow_emp_id):0);  
		// count($deduct_allow_emp_id);
		

		$earnig_data = array();
		$deduct_data = array();

		error_reporting(0);
		
		if (isset($earn_allow_emp_id) && !empty($earn_allow_emp_id) && $earn_allow_emp_id!=0) 
		{					
			for ($m=0; $m < $earn_count ; $m++) { 
				$earnig_data[] = array(																				
										'emp_id' => $earn_allow_emp_id[$m],
										'earning_id'=>$earn_id[$m],
										'value'=>$earn_value[$m],
										'salary_month'=>$slip_month
										);
			}
		}

		if (isset($deduct_allow_emp_id) && !empty($deduct_allow_emp_id) && $deduct_allow_emp_id!=0)
		{
			for ($n=0; $n < $deduct_count; $n++) { 
				$deduct_data[] = array(																				
										'emp_id' =>$deduct_allow_emp_id[$n],
										'deduction_id'=>$deduction_id[$n],
										'deduct_value'=>$deduct_value[$n],
										'salary_month'=>$slip_month
										);
			}
		}
		/*print_r($deduct_data);
		exit();*/
		/************end allowances **************************/
		

		$basic_id = array_filter($basic_id);
		//print_r($basic_id);
		if(isset($basic_id) && !empty($basic_id) && ($basic_id>0))
		{
			//echo "in if"; exit();
				if((isset($emp_ids) && !empty($emp_ids)))
				{	
					$basic_pt_data = array();
					$basicPt_ins=0;
					$pt_ins=0;
					$net_ins=0;
					$basicNet_ins=0;
					$net_pay_ins=0;
					$days_ins=0;
					$basic_ids = 0;

							if(sizeof($emp_ids)>0)
							{
								$i=0;
								foreach ($emp_ids as $key) 
								{	
									$cnt = 0;
									$advance_opening = 0;
									$advance_Addition = 0;
									$advance_recovery = 0;
									$advance_closing_amt = 0;
									if(isset($adv) && !empty($adv))
									{
										foreach ($adv as $advKey) {
											if ($key==$advKey){												
												$advance_opening = $emp_advance_opening[$cnt];
												$advance_Addition = $emp_advance_Addition[$cnt];
												$advance_recovery = $emp_advance_recovery[$cnt];
												$advance_closing_amt = $emp_advance_closing_amt[$cnt];
											}
										$cnt++;
										}
									}


										$basic_pt_data[] = array(	
																'basic_pt_id'=>$basic_id[$basic_ids++],
																'emp_id' => $key,
																'company_id'=>$company_id,
																'basic_amt'=>$basic_amt[$basicPt_ins++],
																'allowances'=>$Allowance[$days_ins],
																'convey'=>$convey[$days_ins],
																'hra'=>$hra[$days_ins],
																'special_allowance'=>$special_allowance[$days_ins],
																'pf_earn'=>$pf_earn[$days_ins],
																'ESIC_earn'=>$ESIC_earn[$days_ins],
																'earn_arrears'=>$earn_arrears[$days_ins],
																'earn_bonus'=>$earn_bonus[$days_ins],
																'mobile_deduction'=>$mobile_deduction[$days_ins],
																'other_deduct'=>$other_deduct[$days_ins],
																'pt_amt' => $pt_amt[$pt_ins++],
																'pf_deduct' => $pf_deduct[$days_ins],
																'ESIC_deduct' => $ESIC_deduct[$days_ins],
																'tds_deduct' => $tds_deduct,
																'sundays_in_month'=>$sundays,
																'holidays_in_month'=>$holiday,

																'memo_cnt' => $memo_cnt[$days_ins],
																'memo_amt' => $memo_amt[$days_ins],
																'late_punchin' => $late_punchin[$days_ins],
																'early_punchout' => $early_punchout[$days_ins],
																'no_punchout_cnt'=>$no_punchout_cnt[$days_ins],
																'late_punchin_halfdays' => $late_punchin_halfdays[$days_ins],
																'total_half_days' => $total_half_days[$days_ins],

																'half_days_due_to_early_punch_out' => $half_days_due_to_early_punch_out[$days_ins],
																'no_min_4hr_work_cnt' => $no_min_4hr_work_cnt[$days_ins],
																'no_min_8hr_work_cnt' => $no_min_8hr_work_cnt[$days_ins],
																'total_full_days' => $total_full_days[$days_ins],

																'wfh_deduct_per' => $wfh_deduct_per[$days_ins],
																'wfh_day' => $wfh_day[$days_ins],
																'work_day' => $work_day[$days_ins++],
																'basic_net'=>$netBasic[$basicNet_ins++],
																'net_pay' => $net_pay[$net_ins++],
																'advance_opening'=>$advance_opening,
																'advance_Addition'=>$advance_Addition,
																'advance_recovery'=>$advance_recovery,
																'advance_closing_amt'=>$advance_closing_amt,
																'salary_month'=>$slip_month
															);	
															
									// }
									$i++;											
								}

								
							}

 
				}
				// print_r($basic_pt_data);
				// exit();

				$basic_insert_data = $this->master_model->updateBatch('tbl_basic_pt', $basic_pt_data,$earnig_data,$deduct_data,$emp_ids,$slip_month);
				//echo $basic_insert_data; 
				$emp_basic_data = $this->slip_vish_model->fetchDataForReport($slip_month,$company_id);
		        
	     	$this->SaveSalaryData($company_id,$emp_basic_data,$num_days_of_month,$month_year_array[0],$month_year_array[1],$slip_month,true);
				if($basic_insert_data) 
				{
					$this->json->jsonReturn(array(
						'valid'=>TRUE,
						'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Basic Salary Update Successfully!</div>'
					)); 
				}
				else
				{
					$this->json->jsonReturn(array(
						'valid'=>FALSE,
						'msg'=>'<div class="alert modify alert-danger"><strong>Error!</strong> While update Basic salary!</div>'
					));
				}
		}else{
		 	if((isset($emp_ids) && !empty($emp_ids)))
			{	
				$basic_pt_data = array();
				$basicPt_ins=0;
				$pt_ins=0;
				$net_ins=0;
				$days_ins=0;
				$basicnet_ins=0;
				if(sizeof($emp_ids)>0)
				{
					$i=0;
					foreach ($emp_ids as $key) 
					{
						$cnt = 0;
						$advance_opening = 0;
						$advance_Addition = 0;
						$advance_recovery = 0;
						$advance_closing_amt = 0;
						if(isset($adv) && !empty($adv))
						{
							foreach ($adv as $advKey) {
								if ($key==$advKey) {
									$advance_opening = $emp_advance_opening[$cnt];
									$advance_Addition = $emp_advance_Addition[$cnt];
									$advance_recovery = $emp_advance_recovery[$cnt];
									$advance_closing_amt = $emp_advance_closing_amt[$cnt];
								}
							$cnt++;
							}
						}

						if($advance_recovery>0)
						{									
							$opening = $advance_opening - $advance_recovery;
							$closing_amt = $opening;
							$indata = array(
											'company_id'=>$company_id,
											'recovery_amt'=>$advance_recovery,
									        'opening_amt'=>$opening,
									        'closing_amt'=>$closing_amt );
							$res = $this->slip_aks_model->setOpeningAmtWhr1($key,$indata);
						}
						$bonus_type = $this->slip_vish_model->fetchBonusType($key);
						$basic_pt_data[] = array(												
												'emp_id' => $key,
												'company_id'=>$company_id,
												'allowances'=>$Allowance[$days_ins],
												'convey'=>$convey[$days_ins],
												'hra'=>$hra[$days_ins],
												'pf_earn'=>$pf_earn[$days_ins],
												'ESIC_earn'=>$ESIC_earn[$days_ins],
												'special_allowance'=>$special_allowance[$days_ins],
												'earn_arrears'=>$earn_arrears[$days_ins],
												'earn_bonus'=>$earn_bonus[$days_ins],
												'mobile_deduction'=>$mobile_deduction[$days_ins],
												'other_deduct'=>$other_deduct[$days_ins],	
												'basic_amt'=>$basic_amt[$basicPt_ins++],
												'pt_amt' => $pt_amt[$pt_ins++],
												'pf_deduct' => $pf_deduct[$days_ins],
												'ESIC_deduct' => $ESIC_deduct[$days_ins],
												'tds_deduct' => $tds_deduct[$days_ins],
												'sundays_in_month'=>$sundays,
												'holidays_in_month'=>$holiday,

												'memo_cnt' => $memo_cnt[$days_ins],
												'memo_amt' => $memo_amt[$days_ins],
												'late_punchin' => $late_punchin[$days_ins],
												'early_punchout' => $early_punchout[$days_ins],
												'no_punchout_cnt'=>$no_punchout_cnt[$days_ins],
												'late_punchin_halfdays' => $late_punchin_halfdays[$days_ins],
												'total_half_days' => $total_half_days[$days_ins],

												'half_days_due_to_early_punch_out' => $half_days_due_to_early_punch_out[$days_ins],
												'no_min_4hr_work_cnt' => $no_min_4hr_work_cnt[$days_ins],
												'no_min_8hr_work_cnt' => $no_min_8hr_work_cnt[$days_ins],
												'total_full_days' => $total_full_days[$days_ins],


												'wfh_deduct_per' => $wfh_deduct_per[$days_ins],
												'wfh_day' => $wfh_day[$days_ins],
												'work_day' => $work_day[$days_ins++],
												'basic_net'=>$netBasic[$basicnet_ins++],
												'net_pay' => $net_pay[$net_ins++],
												'advance_opening'=>$advance_opening,
												'advance_Addition'=>$advance_Addition,
												'advance_recovery'=>$advance_recovery,
												'advance_closing_amt'=>$advance_closing_amt,
												'salary_month'=>$slip_month,
												'bonus_type'=>$bonus_type																
												);		
						$i++;											
					}
				}
			}
			// print_r($basic_pt_data);
			// exit();
			$basic_insert_data = $this->master_model->insertBatchSaveTrans('tbl_basic_pt',$basic_pt_data,$earnig_data,$deduct_data);

			$emp_basic_data = $this->slip_vish_model->fetchDataForReport($slip_month,$company_id);
		        
	     	$this->SaveSalaryData($company_id,$emp_basic_data,$num_days_of_month,$month_year_array[0],$month_year_array[1],$slip_month,true);
			if($basic_insert_data) 
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Basic Salary Generate Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Basic Salary Generate !</div>'
				));
			}
		}	 		 
	}

	
	public function saveBasicBonusPt()
	{
		$basic_id = $this->input->post('basic_id'); 
		$var_per = $this->input->post('var_per');
		$var_amount = $this->input->post('var_amount');
		$i=0;
		foreach ($basic_id as $key) 
		{	
			$basic_pt_data = array(	
				'var_per' => $var_per[$i],
				'var_amount' => $var_amount[$i],
			);
			$this->master_model->updateDetails('tbl_basic_pt', 'basic_pt_id', $basic_id[$i], $basic_pt_data);
			$i++;
		}
		

		$this->json->jsonReturn(array(
			'valid'=>TRUE,
			'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Variable bonus update successfully!</div>'
		)); 

	}

	public function update_net_pay()
	{
		$company_id = $this->input->post('comp_id');
		$month = $this->input->post('month');
		$month_year_array = explode('-', $month);
		$nmonth = date('F',strtotime("01-".$month_year_array[0]."-".date("Y")));
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
		$basic_data = $this->slip_vish_model->fetchDataForReport($month,$company_id);
		if(isset($basic_data) && !empty($basic_data))
		{
			foreach ($basic_data as $key)
			{
				$basic=0;
				$convey=0;
				$hra=0;
				$pf=0;
				$esic=0;
				$advance=0;
				$mobile_deduction=0;
				$other_deduct=0;
				$pt_amt=0;
				//basic
				$emp_basic = $key->basic_amt/$num_days_of_month;
				$basic = round($emp_basic*$key->work_day);
				//convey
				$emp_convey = $key->convey/$num_days_of_month;
				$convey = round($emp_convey*$key->work_day);
				//hra
				$emp_hra = $key->hra/$num_days_of_month;
				$hra = round($emp_hra*$key->work_day);
				//pf earn
				$pf_earn = $key->pf_earn/$num_days_of_month;
				$earn_pf = round($pf_earn*$key->work_day);
				//esic earn
				$esic_earn = $key->ESIC_earn/$num_days_of_month;
				$earn_esic = round($esic_earn*$key->work_day);
				//pf deduct
				$pf_deduct = $key->pf_deduct/$num_days_of_month;
				$pf = round($pf_deduct*$key->work_day);
				//esic deduct
				$esic_deduct = $key->ESIC_deduct/$num_days_of_month;
				$esic = round($esic_deduct*$key->work_day);
				//advance
				$advance = round($key->advance_recovery);
				$mobile_deduction = round($key->mobile_deduction);
				$other_deduct = round($key->other_deduct);
				$pt_amt = round($key->pt_amt);
				$tds_amt = round($key->tds_deduct);

				$emp_allData = $this->slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
				$da=0;
				$mobile=0;
				$medical=0;
				$education=0;
				$city=0;
				$entertainment=0;
				if(isset($emp_allData) && !empty($emp_allData))
				{
					foreach ($emp_allData as $row)
					{
						if($row->earning_id == 18 )
						{
							//DA allowance
							$emp_da = $row->value/$num_days_of_month;
							$da = round($key->work_day*$emp_da);
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$emp_mob = $row->value/$num_days_of_month;
							$mobile = round($key->work_day*$emp_mob);
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$emp_med = $row->value/$num_days_of_month;
							$medical = round($key->work_day*$emp_med);
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$emp_edu = $row->value/$num_days_of_month;
							$education = round($key->work_day*$emp_edu);
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$emp_city = $row->value/$num_days_of_month;
							$city = round($key->work_day*$emp_city);
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$emp_ent = $row->value/$num_days_of_month;
							$entertainment = round($key->work_day*$emp_ent);							
						}
					}
				}
				
				$gross = $basic+$convey+$hra+$da+$mobile+$medical+$education+$city+$entertainment;
				$pt = 200;
				if($pt_amt>0)
				{
					if($gross<7500)
					{
						$pt = 0;
					}elseif($gross<=10000 && $gross>=7500)
					{
						if($key->gender=='Female')
						{
							$pt=0;
						}else{
							$pt = 175;
						}
					}elseif($gross>10000)
					{
						if($nmonth=='February')
						{
							$pt = 300;
						}else{
							$pt = 200;
						}
					}
				}
				$deduction = $pf+$esic+$advance+$mobile_deduction+$other_deduct+$pt +$tds_amt;
				$net_pay = round($gross-$deduction);
				$data = array('net_pay'=>$net_pay);
				$this->master_model->updateDetails('tbl_basic_pt','basic_pt_id',$key->basic_pt_id,$data);
				$emp_details = array(
							'emp_id'=>$key->empl_id,
							'user_id'=>$key->user_id,
							'emp_name'=>$key->emp_name,
							'company_id'=>$company_id,
							'work_day'=>$key->work_day,
							'salary_month'=>$month,
							'num_days_in_month'=>$num_days_of_month,
							'basic'=>$basic,
							'convey'=>$convey,
							'hra'=>$hra,
							'da'=>$da,
							'mobile'=>$mobile,
							'medical'=>$medical,
							'education'=>$education,
							'city'=>$city,
							'entertainment'=>$entertainment,
							'pf_earn'=>$earn_pf,
							'esic_earn'=>$earn_esic,
							'gross_salary'=>$gross,
							'pf_deduct'=>$pf,
							'esic_deduct'=>$esic,
							'advance_recovery'=>$advance,
							'mobile_deduction'=>$mobile_deduction,
							'other_deduct'=>$other_deduct,
							'pt_amt'=>$pt,
							'total_deduction'=>$deduction,
							'net_pay'=>$net_pay,
							);				
				$result = $this->master_model->selectAllmultiWhr('tbl_employee_salary','emp_id',$key->empl_id,'salary_month',$month);
				if(isset($result) && !empty($result))
				{
					$this->master_model->updateDetails('tbl_employee_salary','emp_salary_id',$result[0]->emp_salary_id, $emp_details);
				}else{
					$this->master_model->addData('tbl_employee_salary',$emp_details);
				}
			}
		}
	}

	public function saveAllowance()
	{
		$allowance_id = $this->input->post('allowance_id');
		$slip_month = $this->input->post('allowance_month');
		$emp_id = $this->input->post('emp_id'); 
		$earn_values = $this->input->post('earn_values');
		$earn_types = $this->input->post('earn_type');
		$emp_earn_ids = $this->input->post('emp_earn_allow_id');
		$emp_earn_allow_sal_id = $this->input->post('emp_earn_allow_sal_id');
		$emp_earn_name = $this->input->post('emp_earn_allow_name');       

		$emp_deduct_ids = $this->input->post('emp_deduct_id');
		$emp_deduct_sal_id = $this->input->post('emp_deduct_sal_id');
		$emp_deduct_name = $this->input->post('emp_deduct_name');
		
		$deduct_values = $this->input->post('deduct_value');

		$work_day = $this->input->post('working_days');

		$net_pay = $this->input->post('netpay');
		$deduct_amt = $this->input->post('totalDeduct');
		$earn_amt = $this->input->post('totalEarn');
		$company_id = $this->session->userdata('comp_id');

		//$allowance_details_id = // get last insert id of main allowance details table 
		// code for earning allowance deatisl data array
	
		$allowance_data= array(												
			'workin_day' => $work_day,
			'emp_id' => $emp_id,
			'company_id'=>$company_id,
			'allowance_sal_date'=>$slip_month,
			'net_allowance_amt'=>$net_pay,
			'deduct_amt' => $deduct_amt,
			'earning_amt' =>$earn_amt,
		);	

		if(isset($allowance_id) && !empty($allowance_id) && ($allowance_id>0))
		{ 
			$earn_data = array();
			//$basicPt_ins=0;
			$emp_earn_id_ins=0;
			$earn_types_ins=0;
			$emp_earn_name_ins=0;
			$emp_earn_allow_sal_idns=0;
			//$days_ins=0;
			if(sizeof($earn_values)>0)
			{
				foreach ($earn_values as $key) 
				{
					$earn_data[] = array(		'emp_earn_allow_sal_id'=>$emp_earn_allow_sal_id[$emp_earn_allow_sal_idns++],								
												'emp_id' => $emp_id,
												'company_id'=>$company_id,
												'earn_value'=>$key,
												'emp_earn_allow_id' => $emp_earn_ids[$emp_earn_id_ins++],
												'emp_earn_name'=> $emp_earn_name[$emp_earn_name_ins++],
												'allowance_sal_date'=>$slip_month,
												'convey_allowance_type' => $earn_types[$earn_types_ins++],
												'allowance_details_id' =>$allowance_id
											);							
				}	
			}
			// deduction array data 
			$deduct_data = array();
			//$basicPt_ins=0;
			$emp_deduct_id_ins=0;
			$emp_deduct_name_ins=0;
			$emp_deduct_sal_idns=0;
			//$days_ins=0;
			if (isset($deduct_values) && !empty($deduct_values))
			{	
				if(sizeof($deduct_values)>0)
				{
					foreach ($deduct_values as $key) 
					{
						$deduct_data[] = array(		
							'emp_deduct_sal_id'=>$emp_deduct_sal_id[$emp_deduct_sal_idns++],									
							'emp_id' => $emp_id,
							'company_id'=>$company_id,
							'deduct_value'=>$key,
							'emp_deduct_id' => $emp_deduct_ids[$emp_deduct_id_ins++],
							'emp_deduct_name'=>$emp_deduct_name[$emp_deduct_name_ins++],
							'allowance_sal_date'=>$slip_month,
							'allowance_details_id' =>$allowance_id
						);							
					}
				}
			}

			$basic_insert_data = $this->slip_vish_model->update_allowance_details($allowance_data,$earn_data,$deduct_data,$allowance_id);
			//print_r($basic_insert_data);
			if($basic_insert_data)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Allowance Salary Update Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Allowance Salary Update !</div>'
				));
			}
		}else{	
			$earn_data = array();
			//$basicPt_ins=0;
			$emp_earn_id_ins=0;
			$earn_types_ins=0;
			$emp_earn_name_ins=0;
			//$days_ins=0;
			if(sizeof($earn_values)>0)
			{
				foreach ($earn_values as $key) 
				{
					$earn_data[] = array(												
						'emp_id' => $emp_id,
						'company_id'=>$company_id,
						'earn_value'=>$key,
						'emp_earn_allow_id' => $emp_earn_ids[$emp_earn_id_ins++],
						'emp_earn_name'=> $emp_earn_name[$emp_earn_name_ins++],
						'allowance_sal_date'=>$slip_month,
						'convey_allowance_type' => $earn_types[$earn_types_ins++],
						'allowance_details_id' =>''
					);							
				}
			}

			// deduction array data
			$deduct_data = array();
			//$basicPt_ins=0;
			$emp_deduct_id_ins=0;
			$emp_deduct_name_ins=0;
			//$days_ins=0;
			if (isset($deduct_values) && !empty($deduct_values))
			{	
				if(sizeof($deduct_values)>0)
				{
					foreach ($deduct_values as $key) 
					{
						$deduct_data[] = array(												
							'emp_id' => $emp_id,
							'company_id'=>$company_id,
							'deduct_value'=>$key,
							'emp_deduct_id' => $emp_deduct_ids[$emp_deduct_id_ins++],
							'emp_deduct_name'=>$emp_deduct_name[$emp_deduct_name_ins++],
							'allowance_sal_date'=>$slip_month,
							'allowance_details_id' =>''
						);						
					}
				}
			} 

			$basic_insert_data = $this->slip_vish_model->save_allowance_details($allowance_data , $earn_data , $deduct_data);
			//print_r($basic_insert_data);
			if($basic_insert_data)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Allowance Salary Generated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Allowance Salary Generate !</div>'
				));
			}
		}
	}

	// this function for count sunday in month
	public function total_sundays($monthOf,$year,$num_days_of_month)
	{
		$sundays=0;
		//$total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
		for($i=1;$i<=$num_days_of_month;$i++)
		{
			if(date('N',strtotime($year.'-'.$monthOf.'-'.$i))==7)
			{
				$sundays++;
			}
		}
		return $sundays;
	}

	
	public function update_da_backend()
	{
		$q1=$this->db->query("SELECT * FROM tbl_employee_creation WHERE emp_basic='5800' AND display='Y' ");
		if($q1->num_rows()>0)
		{
			$i=0;
			foreach ($q1->result() as $key) 
			{
				$i++;

				$q3=$this->db->query("select * from tbl_emp_earn_allowance WHERE earning_id=15	AND emp_id=".$key->emp_id);
				if($q3->num_rows()==0)
				{
				echo $key->emp_name;
				//$this->db->query("UPDATE tbl_emp_earn_allowance SET earn_value=(earn_value+45) WHERE earning_id=7	AND emp_id=".$key->emp_id);
				}
				//Update Bonus
				//$this->db->query("UPDATE tbl_emp_earn_allowance SET earn_value='825' WHERE earning_id=15	AND emp_id=".$key->emp_id);
				//update HRA
				//$this->db->query("UPDATE tbl_emp_earn_allowance SET earn_value=(earn_value-45) WHERE earning_id=7	AND emp_id=".$key->emp_id);

				/*//UPDATE PF
				if($key->company_id==2)
				{

				$q2=$this->db->query('SELECT SUM(earn_value) earn_value FROM tbl_emp_earn_allowance WHERE earning_id!=19 AND earning_id!=21 AND emp_id='.$key->emp_id);
				if($q2->num_rows()>0 && ($q2->row(0)->earn_value+$key->emp_basic) >= 21000)
				{
				
				$this->db->query("UPDATE tbl_emp_deduct_allowance SET deduct_value='1188'  WHERE deduction_id=7	AND emp_id=".$key->emp_id);

				$this->db->query("UPDATE tbl_emp_earn_allowance SET earn_value='1188'  WHERE earning_id=19	AND emp_id=".$key->emp_id);

				//update HRA
				$this->db->query("UPDATE tbl_emp_earn_allowance SET earn_value=(earn_value-64) WHERE earning_id=7	AND emp_id=".$key->emp_id);

				}

				


				}*/


			}
			//echo $i;
		}
	}

	function SaveSalaryData($companyId, $emp_basic_data, $num_days_of_month, $month, $year, $slip_month)
	{

		$created_by = $this->session->userdata('userid');
		$currentDate = date('Y-m-d H:i:s');
		
		$lastRowNum = 4;
		if (isset($emp_basic_data) && !empty($emp_basic_data)) {
			$j = 4;
			$lastRowNum = $lastRowNum + count($emp_basic_data);

			$net_basic_total = 0;
			$net_basic_totalE = 0;
			$salBefoPt_total = 0;
			$pt_total = 0;
			$net_with_pt_total = 0;
			$total_deduction = 0;
			$Conveyance_total = 0;
			$mobile_total = 0;
			$HRA_total = 0;
			$DA_total = 0;
			$otherAllow_total = 0;
			$Arrears_total = 0;
			$allowance_total_emp = 0;
			$allowance_ded_total_emp = 0;
			$mobile_ded_total = 0;
			$ArrOther_ded_total = 0;
			$Bonus_total = 0;
			$Advance_total = 0;
			$per_emp_advance = 0;
			$deduct_adv_total = 0;
			$Advance_deduction = 0;
			$medical_total = 0;
			$city_total = 0;
			$education_total = 0;
			$adv_opening = 0;
			$adv_Addition = 0;
			$adv_recovery = 0;
			$adv_closing_amt = 0;

			$mobile_total_all = 0;
			$otherAllow_total_all = 0;
			$recy_ttl = 0;
			$entertainment_total = 0;
			$pf_earn = 0;
			$ESIC_earn = 0;
			$pf_deduct = 0;
			$ESIC_deduct = 0;
			$tot_pf_deduct = 0;
			$tot_ESIC_deduct = 0;
			$pay_during_month = 0;
			$pay_beforePt = 0;
			$final_net_pay = 0;
			$basic_net = 0;
			$total_ctc = 0;
			$total_gross = 0;
			$total_earn_gross = 0;
			$total_earn_gross1 = 0;
			$total_net_salary = 0;
			$total_deduct_mnth = 0;
			$total_net_pay = 0;
			//$Bonus_total=0;
			//emp info
			$emp_bac = 0;
			$emp_da = 0;
			$emp_hra = 0;
			$emp_earn_hra = 0;
			$emp_convy = 0;
			$emp_mob = 0;
			$emp_med = 0;
			$emp_edu = 0;
			$emp_city = 0;
			$emp_enter = 0;
			$emp_gross = 0;
			$emp_bonus = 0;
			$emp_tot_alw = 0;
			$sr = 1;
			$total_star_deduct = 0;
			$total_star_pay = 0;
			foreach ($emp_basic_data as $key) {

				// echo '<pre>';
				// print_r($key);
				$netBasicTotK = 0;
				$emp_wise_ded = 0;
				$boun_emp = 0;
				$emp_wise_add_deduction = 0;

				$emp_allData = $this->slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id, $key->salary_month);

				$emp_Ded_allData = $this->slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);
				$earn_allowance = $this->master_model->selectAllWhr('tbl_emp_earn_allowance', 'emp_id', $key->empl_id);
				$emp_basic = $this->master_model->selectDetailsWhr('tbl_employee_creation', 'emp_id', $key->empl_id);
				$emp_leave_data = $this->slip_vish_model->fetch_emp_leave_data($key->user_id, $month, $year);

				$emp_paid_leave = $this->slip_vish_model->fetch_paid_leave($key->user_id, $month, $year);


				$emp_creditleave_data = $this->slip_vish_model->fetch_emp_credit_leave_data($key->user_id, $year);

				$emp_creditleave = (isset($emp_creditleave_data->no_leave_credit) && !empty($emp_creditleave_data->no_leave_credit)) ? $emp_creditleave_data->no_leave_credit : '0';

				
				$monthsdiff = $this->slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
				$bal_leave_cnt = 0;
				if ($monthsdiff->months >= 6) {
					$saction = $emp_creditleave;
				} else if (isset($emp_creditleave_data->no_leave_credit) && $emp_creditleave_data->no_leave_credit < 0 && $monthsdiff->months < 6) {
					$bal_leave_cnt = $emp_creditleave_data->no_leave_credit;
					$saction = 0;
				} else {
					$saction = 0;
				}

				$actual_present_day = ($key->work_day) - ($emp_leave_data->earn_leave1);
				$total_present_day = $actual_present_day + ($emp_leave_data->earn_leave1);
				$basic = $key->basic_amt;
				$emp_bac = $emp_bac + $basic;

				$da = 0;
				$hra = 0;
				$conveyance = 0;
				$mobile = 0;
				$medical = 0;
				$education = 0;
				$city = 0;
				$entertainment = 0;
				$bonus = 0;
				$total_allowance = 0;

				//EARNING ALLOWANCE				
				if (isset($earn_allowance) && !empty($earn_allowance)) {


					foreach ($earn_allowance as $earn) {
						if ($earn->earning_id == 18) {
							//DA allowance
							$calDa= round($earn->earn_value);
							$emp_da = $emp_da + $earn->earn_value;
							$da = $earn->earn_value;

						} elseif ($earn->earning_id == 7) {
							//HRA

							$emp_hra = $emp_hra + $earn->earn_value;
							$hra = $earn->earn_value;

						} elseif ($earn->earning_id == 3) {
							//Conveyance

							$emp_convy = $emp_convy + $earn->earn_value;
							$conveyance = $earn->earn_value;

						} elseif ($earn->earning_id == 6) {
							// mobile allowance

							$emp_mob = $emp_mob + $earn->earn_value;
							$mobile = $earn->earn_value;

						} elseif ($earn->earning_id == 13) {
							//medical allowance

							$emp_med = $emp_med + $earn->earn_value;
							$medical = $earn->earn_value;

						} elseif ($earn->earning_id == 20) {
							//education allowance

							$emp_edu = $emp_edu + $earn->earn_value;
							$education = $earn->earn_value;

						} elseif ($earn->earning_id == 14) {
							// City allowance

							$emp_city = $emp_city + $earn->earn_value;
							$city = $earn->earn_value;

						} elseif ($earn->earning_id == 22) {
							//entertainment allowance

							$emp_enter = $emp_enter + $earn->earn_value;
							$entertainment = $earn->earn_value;

						} elseif ($earn->earning_id == 9) {
							//entertainment allowance

							$emp_tot_alw = $emp_tot_alw + $earn->earn_value;
							$total_allowance = $earn->earn_value;

						} elseif ($earn->earning_id == 15) {
							//entertainment allowance

							$emp_bonus = $emp_bonus + $earn->earn_value;
							$bonus = $earn->earn_value;

						}
					}
				}

				$gross = $basic + ($da) * 1 + ($hra) * 1 + ($conveyance) * 1 + ($mobile) * 1 + ($medical) * 1 + ($education) * 1 + ($city) * 1 + ($entertainment) * 1 + ($bonus) * 1 + ($total_allowance) * 1;

				$gross1 = $basic + ($da) * 1 + ($conveyance) * 1 + ($mobile) * 1 + ($medical) * 1 + ($education) * 1 + ($city) * 1 + ($entertainment) * 1 + ($total_allowance) * 1;

				$emp_gross = $emp_gross + $gross;

				//CTC
			    $pf_earn = $pf_earn + $key->pf_earn;

				$ESIC_earn = $ESIC_earn + $key->ESIC_earn;

				$pf_deduct = $pf_deduct + $key->pf_deduct;

				$ESIC_deduct = $ESIC_deduct + $key->ESIC_deduct;

				$ctc = $gross + $key->pf_earn + $key->ESIC_earn; 
				$total_ctc = $total_ctc + $ctc;

				//EARNING ALLOWANCE/NO OF DAYS
				$bsNet = 0;
				if (isset($key->net_pay) && $key->net_pay > 0) {
					$bsNet = $key->net_pay + $key->pt_amt;
					$netBasicTotK = $bsNet;
				}

				$basic = $key->basic_net / $num_days_of_month;
				$emp_basic = $key->work_day * $basic;
				
				$basic_net = $basic_net + $emp_basic;

				$hra = $key->hra / $num_days_of_month;
				$emp_earn_hra = $key->work_day * $hra;

				
				$HRA_total = $HRA_total + $emp_earn_hra;

				$convey = $key->convey / $num_days_of_month;
				$emp_convey = $key->work_day * $convey;

				
				$Conveyance_total = $Conveyance_total + $emp_convey;

				$total_mobile = 0;
				$total_city = 0;
				$total_medi = 0;
				$total_edu = 0;
				$total_entertainment = 0;
				$otherAllow_total = 0;
				$total_bonus = 0;
				$total_da = 0;
				$medical_total = 0;
				if (isset($emp_allData) && !empty($emp_allData)) {


					foreach ($emp_allData as $row) {
						if ($row->earning_id == 18) {
							//DA allowance
							$da = $key->special_allowance / $num_days_of_month;
							$value = $key->work_day * $da;
							$DA_total = $DA_total + $value;
							$total_da = $value;

						} elseif ($row->earning_id == 6) {
							// mobile allowance
							$last_val = $row->value / $num_days_of_month;
							$value = $key->work_day * $last_val;
							$mobile_total_all = $mobile_total_all + $value;
							$total_mobile = $value;

						} elseif ($row->earning_id == 13) {
							//medical allowance
							$last_val = $row->value / $num_days_of_month;
							$value = $key->work_day * $last_val;
							$medical_total = $medical_total + $value;
							$total_medi = $value;

						} elseif ($row->earning_id == 20) {
							//education allowance
							$last_val = $row->value / $num_days_of_month;
							$value = $key->work_day * $last_val;
							$education_total = $education_total + $value;
							$total_edu = $value;

						} elseif ($row->earning_id == 14) {
							// City allowance 
							$last_val = $row->value / $num_days_of_month;
							$value = $key->work_day * $last_val;
							$city_total = $city_total + $value;
							$total_city = $value;

						} elseif ($row->earning_id == 22) {
							//entertainment allowance
							$last_val = $row->value / $num_days_of_month;
							$value = $key->work_day * $last_val;
							$entertainment_total = $entertainment_total + $value;
							$total_entertainment = $value;

						} elseif ($row->earning_id == 9) {
							//entertainment allowance
							$last_val = $row->value / $num_days_of_month;
							$value = $key->work_day * $last_val;
							$otherAllow_total_all = $otherAllow_total_all + $value;
							$otherAllow_total = $value;

						} elseif ($row->earning_id == 15) {
							//Bonus
							$last_val = $row->value / $num_days_of_month;
							$value = $key->work_day * $last_val;
							$Bonus_total = $Bonus_total + $value;
							$total_bonus = $value;
						} elseif ($row->earning_id == 16) {
							$Advance_total = $Advance_total + $row->value;
							$per_emp_advance = $row->value;
						} else {
							$allowance_total_emp = 0;
						}
					}
				}

				$earn_gross = ($emp_basic) * 1 + ($emp_earn_hra) * 1 + ($emp_convey) * 1 + ($total_da) * 1 + ($total_mobile) * 1 + ($total_medi) * 1 + ($total_edu) * 1 + ($total_city) * 1 + ($total_entertainment) * 1 + ($total_bonus) * 1 + ($otherAllow_total) * 1;


				$total_earn_gross = $total_earn_gross + $earn_gross;

				$earn_gross1 = ($emp_basic) * 1 + ($emp_earn_hra) * 1 + ($emp_convey) * 1 + ($total_da) * 1 + ($total_mobile) * 1 + ($total_medi) * 1 + ($total_edu) * 1 + ($total_city) * 1 + ($total_entertainment) * 1 + ($otherAllow_total) * 1;


				$total_earn_gross1 = $total_earn_gross1 + $earn_gross1;

				$earn_gross_pf = $emp_basic * 1 + $total_da * 1;


				$pf_dedct1 = $key->pf_deduct;
				$pfd_val = $key->pf_deduct / $num_days_of_month;
				if (isset($key->pf_deduct) && !empty($key->pf_deduct)) {


					if ($earn_gross_pf >= 15000) {
						$pf_dedct = 1800;
					} else {
						$pf_dedct = round($earn_gross_pf * 0.12);
					}

				} else {
					$pf_dedct = 0;
				}

				$employees_pf_deduction=round($pf_dedct);

				$tot_pf_deduct = $tot_pf_deduct + $pf_dedct;

				$esicd_val = $key->ESIC_deduct / $num_days_of_month;

				if (isset($key->ESIC_deduct) && !empty($key->ESIC_deduct)) {
					if ($gross1 <= 21000) {
						$esic_dedct = $earn_gross1 * 0.0075;
					} else {
						$esic_dedct = 0;
					}
				} else {
					$esic_dedct = 0;
				}

				$employees_esic_deduction=round($esic_dedct);
				$tot_ESIC_deduct = $tot_ESIC_deduct + $esic_dedct;
				$month_year_array1 = explode('-', $month);
				$nmonth1 = date('F', strtotime("01-" . $month_year_array1[0] . "-" . date("Y")));
				if ($key->pt_amt > 0) {
					if ($earn_gross < 7500) {
						$pt = 0;
					} elseif ($earn_gross <= 10000 && $earn_gross >= 7500) {
						if ($key->gender == 'Female') {
							$pt = 0;
						} else {
							$pt = 175;
						}
					} elseif ($earn_gross > 10000) {
						if ($nmonth1 == 'February') {
							$pt = 300;
						} else {
							$pt = 200;
						}
					}
				} else {
					$pt = 0;
				}


				$pt_total = $pt_total + $pt;


				$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;


				$emp_wise_ded = $emp_wise_ded + $key->other_deduct;


				if (isset($emp_Ded_allData) && !empty($emp_Ded_allData)) {
					$recy_total = 0;
					$Advance_deduction = 0;
					foreach ($emp_Ded_allData as $rec) {
						if ($rec->deduction_id == 6) {

							$recy_total = $rec->deduct_value;

							$Advance_deduction = $Advance_deduction + $rec->deduct_value;
							$emp_wise_add_deduction = $emp_wise_add_deduction + $rec->deduct_value;
							$per_emp_advance = $per_emp_advance - $rec->deduct_value;
							$deduct_adv_total = $deduct_adv_total + $per_emp_advance;

							if ($per_emp_advance > 0) {
							} else {
								$per_emp_advance = 0;
							}

						} elseif (($rec->deduction_id == 'Arrears/ others') || ($rec->deduction_id == 'Deduction Arrears')) {
							$emp_wise_add_deduction = $emp_wise_add_deduction + $rec->deduct_value;
						} else {

						}
					}
				}

				$adv_opening = $adv_opening + $key->advance_opening;
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;

				$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery + $key->insurance_deduct;

				$total_deduct_mnth = $total_deduct_mnth + $total_deduction;


				$net_pay = ($earn_gross - $total_deduction) + $key->earn_arrears;


				$wfo_days = $total_present_day - $key->wfh_day;
				$per_day_amt = $net_pay / $total_present_day;
				$wfo_amt = $per_day_amt * $wfo_days;
				$wfh_amt = $per_day_amt * $key->wfh_day;
				$wfh_deduct_amt = $wfh_amt * $key->wfh_deduct_per / 100;



				$total_net_pay = $total_net_pay + round($net_pay);



				// $data = array(

				// 	'user_id' => $key->user_id,
				// 	'company_id' => $companyId,
				// 	'emp_name' => $key->emp_name,
				// 	'department_name' => $key->dept,
				// 	'working_days' => $num_days_of_month,
				// 	'sanction_leave' => round($saction),
				// 	'total_utilsed_leave' => $emp_leave_data->earn_leave,
				// 	'balance_leave' => round($emp_leave_data->bal_leave),
				// 	'leave_utilsed_in_month' => $emp_leave_data->earn_leave1,
				// 	'actual_present_days' => $actual_present_day,
				// 	'total_present_days' => $total_present_day,
				// 	'basic' => $key->basic_amt,
				// 	'da_allowance' => round($da),
				// 	'hra' => round($hra),
				// 	'conveyance' => round($conveyance),
				// 	'mobile_allowance' => $mobile,
				// 	'medical_allowance' => $medical,
				// 	'education_allowance' => $education,
				// 	'city_allowance' => $city,
				// 	'entertianment_allowance' => $entertainment,
				// 	'salary_month' => $month . '-' . $year,
				// 	'other_allowance' => round($total_allowance),
				// 	'bonus' => round($bonus),
				// 	'total_gross' => $gross,
				// 	'pf_earn' => round($key->pf_earn),
				// 	'esic_earn' => round($key->ESIC_earn),
				// 	'pf_deduct' => round($key->pf_deduct),
				// 	'esic_deduct' => round($key->ESIC_deduct),
				// 	'ctc' => $ctc,
				// 	'earn_basic' => round($emp_basic),
				// 	'earn_da' => $total_da,
				// 	'earn_hra' => round($emp_earn_hra),
				// 	'earn_conveyance' => $emp_convey,
				// 	'earn_mobile_allowance' => $mobile_total_all,
				// 	'earn_medical_allowance' => $medical_total,
				// 	'earn_education_allowance' => $education_total,
				// 	'earn_city_allowance' => $city_total,
				// 	'earn_entertianmenta_allowance' => $entertainment_total,
				// 	'earn_other_allowance' => round($otherAllow_total),
				// 	'earn_bonus' => round($total_bonus),
				// 	'total_earn_gross' => round($earn_gross),
				// 	'earn_gross_for_esic' => round($earn_gross1),
				// 	'employees_pf_deduction' => $tot_pf_deduct,
				// 	'employees_esic_deduction' => $tot_ESIC_deduct,
				// 	'professional_tax' => $pt,
				// 	'telephone_co' => $mobile_ded_total,
				// 	'others_deduction' => $emp_wise_ded,
				// 	'advance_opening' => $adv_opening,
				// 	'advance_addition' => $adv_Addition,
				// 	'advance_recovery' => $adv_recovery,
				// 	'total_deduction_for_the_month' => round($total_deduction),
				// 	'net_pay' => round($net_pay),
				// 	'wfh_days' => $key->wfh_day,
				// 	'wfh_deduction_%' => $key->wfh_deduct_per,
				// 	'wfh_deduction_amount' => $wfh_deduct_amt,
				// 	'net_pay_after_wfh' => round($net_pay - $wfh_deduct_amt)
				// );
				$data = array(

					'user_id' => $key->user_id,
					'company_id' => $companyId,
					'emp_name' => $key->emp_name,
					'department_name' => $key->dept,
					'working_days' => $num_days_of_month,
					'sanction_leave' => round($saction),
					'total_utilsed_leave' => $emp_leave_data->earn_leave,
					'balance_leave' => round($emp_leave_data->bal_leave),
					'leave_utilsed_in_month' => $emp_leave_data->earn_leave1,
					'actual_present_days' => $actual_present_day,
					'total_present_days' => $total_present_day,
					'basic' => $key->basic_amt,
					'da_allowance' => $key->special_allowance,
					
					'hra' => round($key->hra),
					'conveyance' => round($conveyance),
					'mobile_allowance' => $mobile,
					'medical_allowance' => $medical,
					'education_allowance' => $education,
					'city_allowance' => $city,
					'entertianment_allowance' => $entertainment,
					'salary_month' => $month . '-' . $year,
					'other_allowance' => round($total_allowance),
					'bonus' => round($bonus),
					'total_gross' => $gross,
					'pf_earn' => round($key->pf_earn),
					'esic_earn' => round($key->ESIC_earn),
					'pf_deduct' => round($key->pf_deduct),
					'esic_deduct' => round($key->ESIC_deduct),
					'ctc' => $ctc,
					'earn_basic' => round($emp_basic),
					'earn_da' => round($total_da),
					'earn_hra' => round($emp_earn_hra),
					'earn_conveyance' => round($emp_convey),
					'earn_mobile_allowance' => $mobile_total_all,
					'earn_medical_allowance' => $medical_total,
					'earn_education_allowance' => $education_total,
					'earn_city_allowance' => $city_total,
					'earn_entertianmenta_allowance' => $entertainment_total,
					'earn_other_allowance' => round($otherAllow_total),
					'earn_bonus' => round($total_bonus),
					'total_earn_gross' => round($earn_gross),
					'earn_gross_for_esic' => round($earn_gross1),
					'employees_pf_deduction' => $employees_pf_deduction,
					'employees_esic_deduction' => $employees_esic_deduction,
					'professional_tax' => $pt,
					'telephone_co' => $mobile_ded_total,
					'others_deduction' => $emp_wise_ded,
					'advance_opening' => $key->advance_opening,
					'advance_addition' => $adv_Addition,
					'advance_recovery' => $key->advance_recovery,
					'total_deduction_for_the_month' => round($total_deduction),
					'net_pay' => round($net_pay),
					'wfh_days' => $key->wfh_day,
					'wfh_deduct_per' => $key->wfh_deduct_per,
					'wfh_deduction_amount' => $wfh_deduct_amt,
					'net_pay_after_wfh' => round($net_pay - $wfh_deduct_amt),
					
					'memo_cnt' => $key->memo_cnt,
					'memo_amt' => $key->memo_amt,
					'late_punchin' => $key->late_punchin,
					'early_punchout' => $key->early_punchout,
					'late_punchin_halfdays' => $key->late_punchin_halfdays,
					'total_half_days' => $key->total_half_days,
					// 'tds_deduct' => $key->total_half_days,
   				    'no_punchout_cnt' => $key->no_punchout_cnt,

   				    'half_days_due_to_early_punch_out' => $key->half_days_due_to_early_punch_out,
					'no_min_4hr_work_cnt' => $key->no_min_4hr_work_cnt,
					'no_min_8hr_work_cnt' => $key->no_min_8hr_work_cnt,
					'total_full_days' => $key->total_full_days,
					'medical_insurance' => round($key->insurance_deduct),
					'created_by' => $created_by,
					'created_on' => $currentDate
				);
				// echo '<pre>';
				// print_r($data);

				$this->master_model->addData('tbl_emp_salary_excel_genrated_data', $data);

			}



		}




	}

}
