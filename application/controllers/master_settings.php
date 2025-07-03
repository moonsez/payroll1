<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /*
	Author :- Vishal
	work :- Settings(save)

 */

class Master_settings extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('master_model');
        $this->load->model('slip_aks_model');
        $this->load->model('Slip_vish_model');
        date_default_timezone_set("Asia/kolkata");
    } 
   	//Settings
    public function masterSetting()
	{		
		$company_id = $this->session->userdata('comp_id');
		$data['settingsData']=$this->master_model->selectDetailsDisplayByASC('tbl_earning_allowance','earning_name',$company_id);
		$data['desigData']=$this->master_model->selectDetailsDisplayByASC('tbl_designation','desig_name',$company_id);
		$data['checkData']=$this->master_model->selectDetailsDisplayByASC('tbl_earning_allowance','earning_code',$company_id);
		$data['checkData1']=$this->master_model->selectDetailsDisplayByASC('tbl_deduction_allowance','deduction_code',$company_id);
		$this->load->view('master/settings',$data);
	}
	//Designation
	public function designationForm()
	{		
		$tbl_name='tbl_designation';
		$uniqueField='desig_name';
		$comp_id=$this->session->userdata('comp_id'); 

		$data['compDetails']=$this->master_model->SelectCompany();
		$data['desigData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$comp_id);	

		$this->load->view('master/designation_form',$data);
	}

	public function fetchDesig()
	{
		$tbl_name='tbl_designation';
		$uniqueField='desig_name';	
		$comp_id = $this->session->userdata("comp_id");
		$data['desigData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$comp_id);
		$this->load->view('master/designation_table',$data);
	}

	function editDesignation()
	{	
		$company_id = $this->session->userdata('comp_id');
		$desig_id = $this->input->post('id');
		$tblName = 'tbl_designation';
		$where = 'desig_id';
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['singleDesig'] = $this->master_model->selectDetailsWhr($tblName,$where,$desig_id,$company_id);
		$tbl_name='tbl_designation';
		$uniqueField='desig_name';
		$comp_id=$this->session->userdata('comp_id'); 
		$data['desigData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$comp_id);
		$this->load->view('master/designation_form',$data);
	}

	public function saveDesignation()
	{		
		if($this->session->userdata("comp_id")==1)
		{
			$company_id = $this->input->post("comp_id");
		}else{
			$company_id = $this->session->userdata("comp_id");
		}
		$desig_id=trim($this->input->post('id'));
		$desig_name=trim($this->input->post('desig_name'));
		$desig_desc=trim($this->input->post('desig_desc'));
		$data=array('company_id'=>$company_id,'desig_name'=>$desig_name,'desig_desc'=>$desig_desc);
		if(isset($desig_id) && !empty($desig_id) && ($desig_id>0))
		{
			$tableName = 'tbl_designation';
			$uniqueField = 'desig_id';

			$result = $this->master_model->updateDetails($tableName, $uniqueField, $desig_id, $data);

			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Designation Details Updated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Designation Details !</div>'
				));
			}
		}
		else
		{
			$result=$this->master_model->addData('tbl_designation',$data);
			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Designation Details Saved Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Saving Designation Details !</div>'
				));
			}
		}
	}	

	public function deleteDesignation()
	{
		$desig_id=$this->input->post('id');
		$tableName = 'tbl_designation';
		$uniqueField = 'desig_id';		
		$data=array('display'=>'N');

		$result=$this->master_model->updateDetails($tableName,$uniqueField,$desig_id,$data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Designation Details Deleted Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting Designation Details !</div>'
			));
		}
	}

	/****************Employee Creation***************/

	public function fetch_AdminData()
	{
 		$this->load->model('slip_aks_model');
 		$whereId= $this->input->post('id');

 		$data['compDetails']=$this->master_model->SelectCompany();
	  	$data['employee_create']=$this->master_model->selectDetailsDisplayByASC('tbl_designation','desig_name',$whereId);
      	$data['earning_allow']=$this->master_model->selectDetailsDisplayByASC('tbl_earning_allowance','earning_name',$whereId);
      	$data['deduction_allow']=$this->master_model->selectDetailsDisplayByASC('tbl_deduction_allowance','deduction_name',$whereId);
      	$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($whereId);
      	//$this->load->view('employee_creation',$data);

      	$this->json->jsonReturn($data);
      	//return $data;
 	}
 


	public function employeeCreation()
	{
		// $tbl_name='tbl_earning_allowance';
		// $uniqueField='earning_name';pmaster_settings
		$whereId1=1;//$this->session->userdata('comp_id');
		$whereId=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
	  	$data['employee_create']=$this->master_model->selectDetailsDisplayByASC('tbl_designation','desig_name',$whereId);
      	$data['earning_allow']=$this->master_model->selectDetailsDisplayByASC('tbl_earning_allowance','earning_name',$whereId1);
      	$data['deduction_allow']=$this->master_model->selectDetailsDisplayByASC('tbl_deduction_allowance','deduction_name',$whereId1);
      	$data['empDetails']=$this->master_model->selectDetailsDisplayByASC('tbl_employee_creation','company_id',$whereId);
      	//echo $this->db->last_query(); exit();
      	//print_r($data['empDetails']); exit();
      	//$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($whereId1);
      	$this->load->view('employee_creation',$data);
    }


    public function saveEmployeeCreation()
	{
		$company_id = $this->input->post("comp_id");
		$emp_id=trim($this->input->post('id'));
		$emp_name=trim($this->input->post('employee_name'));
		$location=trim($this->input->post('location'));
		$desig_id=trim($this->input->post('desig_id'));
		$dob=$this->input->post('date_of_birth');		
		$bank_acc_no=trim($this->input->post('bank_acc_no'));
		$date_of_joining=$this->input->post('date_of_joining');
	 	$doj = date('Y-m-d',strtotime($date_of_joining));
		$pan_no=trim($this->input->post('pan_no'));
		$gender=trim($this->input->post('gender'));
		$employee_id=trim($this->input->post('employee_id'));
		$user_id=trim($this->input->post('user_id'));
		$basic=trim($this->input->post('basic'));
		$bank_ifc_code=trim($this->input->post('bank_ifc_code')); 
		$emp_ac_type=trim($this->input->post('emp_ac_type'));
		$bank_name=trim($this->input->post('bank_name'));
		$bank_branch=trim($this->input->post('branch_name'));
		$email_id = trim($this->input->post('email_id'));
		$local_address = trim($this->input->post('local_address'));
		$permanent_address = trim($this->input->post('permanent_address'));
		$pf_acc_no = trim($this->input->post('pf_acc_no'));
		$esi_acc_no = trim($this->input->post('esi_acc_no'));
		$entry_by = $this->session->userdata('userid');
		$fixed_per = $this->input->post('fixed_per');
		$var_per = $this->input->post('var_per');
		$data=array(
				'emp_name'=>$emp_name,
				'user_id'=>$user_id,
				'company_id'=>$company_id,
				'desig_id'=>$desig_id,
				'emp_loc'=>$location,
				'date_of_birth'=>$dob,
				'email_id'=>$email_id,
				'local_address'=>$local_address,
				'permanent_address'=>$permanent_address,
				'bank_acc_no'=>$bank_acc_no,
				'bank_name'=>$bank_name,
				'bank_branch'=>$bank_branch,
				'bank_ifc_code'=>$bank_ifc_code,
				'emp_ac_type'=>$emp_ac_type, 
				'emp_pan_num'=>$pan_no,
				'date_of_joining'=>$doj,
				'gender'=>$gender,
				'pf_acc_no'=>$pf_acc_no,
				'esi_acc_no'=>$esi_acc_no,
				'employee_id'=>$employee_id,
				'emp_basic'=>$basic,
				'fixed_per'=>$fixed_per,
				'var_per'=>$var_per,
				'entry_by'=>$entry_by,
				'entry_date'=>date('Y-m-d h:i:s'),
				'status'=>'Pending',
			);

			// echo '<pre>';print_r($data);exit;

		$earning_id = $this->input->post('earning_allowance');				
		$earning_value = $this->input->post('earn_allowance_input');
		$deduction_id = $this->input->post('deduction_allowance');		
		$deduction_value = $this->input->post('deduction_allowance_input');
		
		if(isset($emp_id) && !empty($emp_id) && ($emp_id>0))
		{
			$tableName = 'tbl_employee_creation';
			$uniqueField = 'emp_id';
			$this->master_model->deleteData('tbl_emp_earn_allowance','emp_id',$emp_id);		
			$this->master_model->deleteData('tbl_emp_deduct_allowance','emp_id',$emp_id);		

			$update_emp_result = $this->master_model->updateDetails($tableName, $uniqueField, $emp_id, $data);

			if($update_emp_result)
			{
				if((isset($earning_id) && !empty($earning_id)) && (isset($earning_value) && !empty($earning_value)) && (sizeof($earning_value)==sizeof($earning_id)))
				{					
					$earning_insert_data = array();
					$earn_ins=0;
					//print_r($earning_insert_data);
					if(sizeof($earning_id)>0)
					{						
						foreach ($earning_id as $key) 
						{							
							$fixed = 0;
							$type_convey='';
							if($key==3)
							{
								$fixed = $earning_value[$earn_ins];
								$type_convey='fixed_amount';
							}
							$bonus_type='';
							if($key==15){
								$bonus_type = $this->input->post('bonus_type');
							}
							$earning_insert_data[] = array(												
								'earning_id' => $key,
								'company_id'=>$company_id,
								'emp_id' => $emp_id,
								'earn_value' => $earning_value[$earn_ins++],
								'fixed_amount'=>$fixed,
								'bonus_type'=>$bonus_type,
								'convey_allowance_type'=>$type_convey										
							);									
						}
						
						$earn_insert_data = $this->master_model->insertBatchSave('tbl_emp_earn_allowance',$earning_insert_data);
					}
 
				else
				{
					$earn_insert_data = $this->master_model->insertBatchSave('tbl_emp_earn_allowance',$earning_insert_data);
				}
					
			}

			if((isset($deduction_id) && !empty($deduction_id)) && (isset($deduction_value) && !empty($deduction_value)) && (sizeof($deduction_value)==sizeof($deduction_id)))
			{
				$deduction_insert_data = array();
				$deduct_ins=0;
				if(sizeof($deduction_id)>0)
				{
					foreach ($deduction_id as $key) 
					{
						$deduction_insert_data[] = array(												
							'deduction_id' => $key,
							'company_id'=>$company_id,
							'emp_id' => $emp_id,
							'deduct_value' => $deduction_value[$deduct_ins++]											
						);							
					}
				}	

				$deduct_insert_data = $this->master_model->insertBatchSave('tbl_emp_deduct_allowance',$deduction_insert_data);
			}
			else
			{
				// condition for earning allowance.
			}
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Employee Creation Details Updated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Employee Creation Details !</div>'
				));
			}
		}
		else
		{			
			$insert_emp_result = $this->master_model->addDetailsGetId('tbl_employee_creation',$data);
			if($insert_emp_result)
			{
				$earning_value = array_values(array_filter($earning_value));
				
				if((isset($earning_id) && !empty($earning_id)) && (isset($earning_value) && !empty($earning_value)) && (sizeof($earning_value)==sizeof($earning_id)))
				{	
					$earning_insert_data = array();
					$earn_ins=0;
					if(sizeof($earning_id)>0)
					{
						foreach ($earning_id as $key) 
						{
							$fixed = 0;
							$type_convey='';
							if($key==3)				
							{
								$fixed = $earning_value[$earn_ins];
								$type_convey='fixed_amount';
							}
							$bonus_type='';
							if($key==15){
								$bonus_type = $this->input->post('bonus_type');
							}
							$earning_insert_data[] = array(												
								'earning_id' => $key,
								'company_id'=>$company_id,
								'emp_id' => $insert_emp_result,
								'earn_value' => $earning_value[$earn_ins++],
								'fixed_amount'=>$fixed,
								'bonus_type'=>$bonus_type,
								'convey_allowance_type'=>$type_convey										
							);			
						}	
						// echo '<pre>';print_r($earning_insert_data);
					}
					$earn_insert_data = $this->master_model->insertBatchSave('tbl_emp_earn_allowance',$earning_insert_data);
				}

				if((isset($deduction_id) && !empty($deduction_id)) && (isset($deduction_value) && !empty($deduction_value)) && (sizeof($deduction_value)==sizeof($deduction_id)))
				{
					$deduction_insert_data = array();
					$deduct_ins=0;
					if(sizeof($deduction_id)>0)
					{
						foreach ($deduction_id as $key) 
						{
							$deduction_insert_data[] = array(												
								'deduction_id' => $key,
								'company_id'=>$company_id,
								'emp_id' => $insert_emp_result,
								'deduct_value' => $deduction_value[$deduct_ins++]				
							);							
						}
					}					   
					$deduct_insert_data = $this->master_model->insertBatchSave('tbl_emp_deduct_allowance',$deduction_insert_data);
				}

				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Employee Creation Details Saved Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Saving Employee Creation Details !</div>'
				));
			}
		}
	}

 
	/*********************For pop up view of Emp Creation**********************************/
	public function update_EmpCreation()
	{
		$company_id = $this->session->userdata('comp_id');
		$emp_id = $this->input->post('id');
		$tblName = 'tbl_employee_creation';
		$where = 'emp_id';
		$data['employee_create']=$this->master_model->selectDetailsDisplayByASC('tbl_designation','desig_name',$company_id);
      	//$data['earning_allow']=$this->master_model->selectDetailsDisplayByASC('tbl_earning_allowance','earning_name');
      	//$data['deduction_allow']=$this->master_model->selectDetailsDisplayByASC('tbl_deduction_allowance','deduction_name');
      	$data['compDetails']=$this->master_model->SelectCompany();
      	$data['earning_data']=$this->slip_aks_model->fetchEarning($emp_id);
      	$data['deduction_data']=$this->slip_aks_model->fetchDeduction($emp_id);
		$data['singleEmployee'] = $this->master_model->selectDetailsWhr($tblName,$where,$emp_id);		
		$data['compName'] = $this->master_model->selectDetailsWhr('tbl_company_master','company_id',$data['singleEmployee']->company_id);		
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);		
		$update_view=$this->load->view('employee_creation_pop_up',$data,true);
		$this->json->jsonReturn(array( 
				'valid'=>TRUE,
				'view'=>$update_view
			));
	}

	public function fetchEmployeeCreation()
	{
		$company_id = $this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		//$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$data['empDetails']=$this->master_model->selectDetailsDisplayByASC('tbl_employee_creation','company_id',$company_id);
		$this->load->view('employee_creation_table',$data);
	}

	function editEmployeeCreation()
	{
		$company_id = $this->session->userdata('comp_id');
		$comp_id= $company_id;
		$emp_id = $this->input->post('id');
		$tblName = 'tbl_employee_creation';
		$where = 'emp_id';
		$company_id1=1;

		$data['compDetails']=$this->master_model->SelectCompany();
		$data['employee_create']=$this->master_model->selectDetailsDisplayByASC('tbl_designation','desig_name',$comp_id);
      	$data['earning_data']=$this->slip_aks_model->fetchEarning($emp_id);
		$data['earning_allow']=$this->master_model->selectDetailsDisplayByASC('tbl_earning_allowance','earning_name',$company_id1);
      	$data['deduction_data']=$this->slip_aks_model->fetchDeduction($emp_id);
       	$data['deduction_allow']=$this->master_model->selectDetailsDisplayByASC('tbl_deduction_allowance','deduction_name',$company_id1);
		$data['singleEmployee'] = $this->master_model->selectDetailsWhr($tblName,$where,$emp_id);		
		//$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);	
		$data['alluser'] = $this->slip_aks_model->fetch_all_user_info_rollmgmt();	
		$data['empDetails']=$this->master_model->selectDetailsDisplayByASC('tbl_employee_creation','company_id',$company_id);
		$this->load->view('employee_creation',$data);
	}



	// function editEmployeeCreation()
	// {
	// 	$company_id = $this->session->userdata('comp_id');
	// 	$emp_id = $this->input->post('id');
	// 	$tblName = 'tbl_employee_creation';
	// 	$where = 'emp_id';
	// 	$data['employee_create']=$this->master_model->selectDetailsDisplayByASC('tbl_designation','desig_name');
	// 	$data['singleEmployee'] = $this->master_model->selectDetailsWhr($tblName,$where,$emp_id);		
	// 	$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);		
	// 	$this->load->view('employee_creation',$data);
	// }



/*	function viewEmployeeCreation()
	{
		$company_id = $this->session->userdata('comp_id');
		$emp_id = $this->input->post('id');
		
		$where = 'emp_id';
		$data['deduction']=$this->master_model->getDeductDetails($company_id,$company_id);
		$data['earning'] = $this->master_model->getEarningDetails($company_id,$company_id);		
			
		$this->load->view('show_allowance',$data);
	} */
	

	public function deleteEmployeeCreation()
	{
		$emp_id=$this->input->post('id');
		$tableName = 'tbl_employee_creation';
		$uniqueField = 'emp_id';		
		$data=array('display'=>'N');

		$result=$this->master_model->updateDetails($tableName,$uniqueField,$emp_id,$data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Employee Details Deleted Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting Employee Details !</div>'
			));
		}
	}
	/************** Allowance report generate ***************************/
	public function generate_allowance_report()  
	{		
		$this->load->model('Slip_vish_model');
		$company_id = $this->session->userdata('comp_id');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC1();		
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('allowance_report',$data);
	} 

	public function fetchAllowanceReportData(){
		$this->load->model('Slip_vish_model'); //slip_emp_name slip_months  report_type comp_id totalAmount
		$company_id=0;
		if ($this->session->userdata('role_id')==2) {
			$company_id = $this->session->userdata('comp_id');
		}else{
			$company_id = $this->input->post('comp_id');
		}
		$emp_id = $this->input->post('slip_emp_name');
		$month = $this->input->post('slip_months');
		$type = $this->input->post('report_type');
		$emp_ac_type = $this->input->post('emp_ac_type');
		//echo $emp_ac_type;
		
		
		$data =array();
		$data['companyId'] = $company_id;
		$data['type'] = $type;
		$data['emp_id'] = $emp_id;
		$data['month']=$month;
		

		$data['reportData']=$this->Slip_vish_model->featchAllowanceData($company_id,$month,$emp_ac_type);	
		$data['$emp_ac_type']=$emp_ac_type;
		$data['totalAmount']=$this->Slip_vish_model->totalOfAllEmpAllowance($company_id,$month,$emp_ac_type);

		
		
		$data['emp_ac_type']=$emp_ac_type;
			//print_r($data);	
		//$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('allowance_report_table',$data);
	}

	/******* Basic report generate code **************************/

	
	public function generate_basic_report()  
	{		
		$this->load->model('Slip_vish_model');
		$company_id = $this->session->userdata('comp_id');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC1();		
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('basic_report',$data);
	} 


	public function fetchBasicReportData(){
		$this->load->model('Slip_vish_model'); //slip_emp_name slip_months  report_type comp_id totalAmount
		$company_id=0;
		if ($this->session->userdata('role_id')==2) {
			$company_id = $this->session->userdata('comp_id');
		}else{
			$company_id = $this->input->post('comp_id');
		}
		$emp_id = $this->input->post('slip_emp_name');
		$month = $this->input->post('slip_months');
		$type = $this->input->post('report_type');
		//$emp_ac_type = $this->input->post('emp_ac_type');
		//echo $emp_ac_type;
		
		
		$data =array();
		$data['companyId'] = $company_id;
		$data['type'] = $type;
		$data['emp_id'] = $emp_id;
		$data['month']=$month; 
		

		$data['reportData']=$this->Slip_vish_model->featchBasicData($company_id,$month);	
		//$data['$emp_ac_type']=$emp_ac_type;
		//$data['totalAmount']=$this->Slip_vish_model->totalOfSingleEmp($company_id,$emp_id,$month,$emp_ac_type);

		
		
		//$data['emp_ac_type']=$emp_ac_type;
			//print_r($data);	
		//$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('basic_report_table',$data);
	}


	/********Salary slip Generate  Date:21-6-2014********/
	public function salarySlipGenerate()
	{		
		$this->load->model('Slip_vish_model');
		$company_id = $this->session->userdata('comp_id');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC1();	
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);

		$this->load->view('salary_slip',$data);
	}

	// report generation 
	public function generate_report()  
	{		
		$this->load->model('Slip_vish_model');
		$company_id = $this->session->userdata('comp_id');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC1();		
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('report_salary',$data);
	}
	//report for who don't have account 

	
	//report for who have account 
	public function fetchReportData(){
		$this->load->model('Slip_vish_model'); //slip_emp_name slip_months  report_type comp_id totalAmount
		$company_id=0;
		if ($this->session->userdata('role_id')==2) {
			$company_id = $this->session->userdata('comp_id');
		}else{
			$company_id = $this->input->post('comp_id');
		}
		$emp_id = $this->input->post('slip_emp_name');
		$month = $this->input->post('slip_months');
		$type = $this->input->post('report_type');
		$emp_ac_type = $this->input->post('emp_ac_type');
		//echo $emp_ac_type;
		
		
		$data =array();
		$data['companyId'] = $company_id;
		$data['type'] = $type;
		$data['emp_id'] = $emp_id;
		$data['month']=$month;
		if($type == "single_emp"){

		$data['reportData']=$this->Slip_vish_model->featchData($company_id,$emp_id,$month,$emp_ac_type);	
		//$data['$emp_ac_type']=$emp_ac_type;
		$data['totalAmount']=$this->Slip_vish_model->totalOfSingleEmp($company_id,$emp_id,$month,$emp_ac_type);

		
		}else{
			$data['reportData']=$this->Slip_vish_model->featchData1($company_id,$month,$emp_ac_type);
			
			$data['totalAmount']=$this->Slip_vish_model->totalOfAllEmp($company_id,$month,$emp_ac_type);
			//print_r($data);
		}
		$data['emp_ac_type']=$emp_ac_type;
			//print_r($data);	
		//$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('report_table',$data);
	}

	//generate report Pdf

	public function reportPdf(){

		$companyId = $this->uri->segment(2);
		$pay_slip_month = $this->uri->segment(3);
		$emp_ac_type = $this->uri->segment(4);
		$empId = $this->uri->segment(5);
		$this->load->model('Slip_vish_model');
		$this->load->model('master_model');
		//$designation =$this->master_model->selectDetailsWhr($tblname1,$where1,$desig_id);
		$company_id=$this->session->userdata('comp_id'); 
        
		$data =array();
		if (isset($empId)&& !empty($empId)) {
			$data['reportData']=$this->Slip_vish_model->featchData($companyId,$empId,$pay_slip_month,$emp_ac_type);
			$data['totalAmount']=$this->Slip_vish_model->totalOfSingleEmp($company_id,$emp_id,$month,$emp_ac_type);
		}else{
			$data['reportData']=$this->Slip_vish_model->featchData1($companyId,$pay_slip_month,$emp_ac_type);
			$data['totalAmount']=$this->Slip_vish_model->totalOfAllEmp($companyId,$pay_slip_month,$emp_ac_type);
		}
		$data['compName'] =$this->Slip_vish_model->getCompDetails($company_id);
		$data['emp_ac_type']=$emp_ac_type;
		// print_r($data);
		// echo $totalAmount;
		$pdfname = 'Salary_Report';

		$html=$this->load->view('pdfView',$data,TRUE);
		//echo $html; 
		$this->report_creation->create_pdf($html,$pdfname);
	}

	public function paySlipDataDetails()
	{	
		$company_id = $this->input->post('comp_id'); 		
		$salaryMonth = $this->input->post('slip_months'); 
		$data['empSalaryList'] = $this->slip_aks_model->fetchSalaryDetailsEmpByMonth($salaryMonth,$company_id);
		// echo $this->db->last_query();die;
		$data['salaryMonth'] = $salaryMonth;
		$this->load->view('salary_slip_excel_view',$data);
	} 

	public function generate_pay_slip()
	{		
		$empId = $this->input->post('id');
		$company_id = $this->input->post("comp_id");
		$emp_id = $empId;
		$company_name = $this->input->post('company_name');
		$company_add = $this->input->post('company_add');
		$city_name = $this->input->post('city_name');
		
		$emp_gender = $this->input->post('emp_gender');
		$emp_location = $this->input->post('emp_location');
		$emp_acc_no = $this->input->post('emp_acc_no');
		//
		$bank_name = $this->input->post('bank_name');
		$bank_branch = $this->input->post('bank_branch');
		$bank_ifc_code = $this->input->post('bank_ifc_code');
		//

		$emp_date_of_birth = $this->input->post('emp_date_of_birth');

		$state_name = $this->input->post('state_name');
		$company_pincode = $this->input->post('company_pincode');
		$comp_final_address = $company_add.', '. $city_name .', '. $state_name.' - '.$company_pincode;
		$generate_date = $this->input->post('generate_date');
		$pay_slip_month = $this->input->post('pay_slip_month');
		$emp_name = $this->input->post('emp_name');
		$num_of_days = $this->input->post('num_of_days');
		$emp_desig = $this->input->post('emp_desig');
		$emp_date_of_joining = $this->input->post('emp_date_of_joining');
		$emp_pan = $this->input->post('emp_pan');
		$employee_id = $this->input->post('employee_id');
		$emp_month_salary = $this->input->post('emp_month_salary');
		$earn_total = $this->input->post('earn_total');
		$deduct_total = $this->input->post('deduct_total');
		$total_pay = $this->input->post('total_pay');
		$number = $total_pay;
		$earning_name = $this->input->post('earning_name');		
		$earn_amount = $this->input->post('earn_amount');		
		$deduction_name = $this->input->post('deduction_name');		
		$deduction_value = $this->input->post('deduction_value');


		$opening_amt = $this->input->post('opening_amt');
		$recovery_amt = $this->input->post('recovery_amt');
		$addition_amt = $this->input->post('addition_amt');
		$closing_amt = $this->input->post('closing_amt');
		
		$recovery_amount = $this->input->post('recovery_amount');
		$emp_ac_type = $this->input->post('emp_ac_type');

		


		$number=$total_pay;
		$checkAlreadyExistRecForExcel = $this->slip_aks_model->fetchDataForExcelGenerate($empId,$pay_slip_month);

		if(isset($checkAlreadyExistRecForExcel) && !empty($checkAlreadyExistRecForExcel))
		{
			
			// UPDATE ADVANCE CALCULATION


			$url = base_url().'gef/'.$empId.'/'.$pay_slip_month;

			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'url'=>$url
			)); 
		}
		else
		{
			
			$words = $this->convert_num_to_words->convert_number_to_words($number);
			
			$emp_basic_data = array(
								'company_id'=>$company_id,
								'emp_id'=> $empId,
								'emp_comp_name'=>$company_name,
								'company_add'=>$comp_final_address,
								'pay_slip_generate_date'=>$generate_date,
								'pay_slip_month'=>$pay_slip_month,
								'emp_name'=>$emp_name,
								'emp_gender'=>$emp_gender,
								'emp_location'=>$emp_location,
								'emp_acc_no'=>$emp_acc_no,
								'bank_name'=>$bank_name,
								'bank_branch'=>$bank_branch,
								'bank_ifc_code'=>$bank_ifc_code,
								'emp_date_of_birth'=>$emp_date_of_birth,
								'emp_designation'=>$emp_desig,
								'emp_pan_num'=>$emp_pan,
								'emp_working_days'=>$num_of_days,
								'date_of_joining'=>$emp_date_of_joining,
								'comp_employee_id'=>$employee_id,
								'emp_basic'=>$emp_month_salary,
								'total_pay'=>$earn_total,
								'total_deduct'=>$deduct_total,
								'net_pay'=>$total_pay,
								'opening_amt'=>$opening_amt,
								'recovery_amt'=>$recovery_amt,
								'addition_amt'=>$addition_amt,
								'closing_amt'=>$closing_amt,
								'recovery_amount'=>$recovery_amount,
								'emp_ac_type'=>$emp_ac_type,
								'inword'=>$words
								
							);

			// $emp_advance_data = array(
								
			// 					'opening_amt'=>$opening_amt,
			// 					'recovery_amt'=>$recovery_amt,
			// 					'addition_amt'=>$addition_amt,
			// 					'closing_amt'=>$closing_amt								
			// 					);

			$insert_emp_result = $this->master_model->addDetailsGetId('tbl_emp_slip_static_data',$emp_basic_data);

			//
			
			if($recovery_amt>0){


					$opening= $this->slip_aks_model->getOpeningAmtWhr($emp_id);
					$opening = $opening - $recovery_amt;
					$closing_amt = $opening;
					$indata = array(
									'company_id'=>$company_id,
							        'opening_amt'=>$opening,
							        'closing_amt'=>$closing_amt
							        );
					$res = $this->slip_aks_model->setOpeningAmtWhr1($emp_id,$indata);
			}

			if($insert_emp_result)
			{
				if(empty($deduction_name) && empty($earning_name))
				{
					$url = base_url().'gef/'.$empId.'/'.$pay_slip_month;
						$this->json->jsonReturn(array(
							'valid'=>TRUE,
							'url'=>$url
						));
				}
				else
				{
					if((isset($earning_name) && !empty($earning_name)) && (isset($earn_amount) && !empty($earn_amount)) && (sizeof($earn_amount)==sizeof($earning_name)))
					{
						$earning_static_insert_data = array();
						$earn_ins=0;
						if(sizeof($earning_name)>0)
						{
							foreach ($earning_name as $key) 
							{
								$earning_insert_data[] = array(									
															'company_id'=>$company_id,			
															'slip_static_data_id'=>$insert_emp_result,
															'static_earn_name'=>$key,
															'static_earn_value'	=>$earn_amount[$earn_ins++]										
														);							
							}
						}					   
						$earn_insert_data = $this->master_model->insertBatchSave('tbl_emp_static_earn_data',$earning_insert_data);
					}
					else
					{
						$url = base_url().'gef/'.$empId.'/'.$pay_slip_month;
						$this->json->jsonReturn(array(
							'valid'=>TRUE,
							'url'=>$url
						));// condition for earning allowance.
					}

					if((isset($deduction_name) && !empty($deduction_name)) && (isset($deduction_value) && !empty($deduction_value)) && (sizeof($deduction_name)==sizeof($deduction_value)))
					{
						
						$deduction_insert_data = array();
						$deduct_ins=0;
						if(sizeof($deduction_name)>0)
						{
							foreach ($deduction_name as $key) 
							{
							$deduction_insert_data[] = array(												
															'static_deduct_name' => $key,
															'company_id'=>$company_id,
															'slip_static_data_id' => $insert_emp_result,
															'static_deduct_value' => $deduction_value[$deduct_ins++]											
														);							
							}
						}					   
						$deduct_insert_data = $this->master_model->insertBatchSave('tbl_emp_static_deduct_data',$deduction_insert_data);
						$url = base_url().'gef/'.$empId.'/'.$pay_slip_month;

						$this->json->jsonReturn(array(
							'valid'=>TRUE,
							'url'=>$url
						));
						//$this->generatePaySlipExcelFunction($empId,$pay_slip_month);
					}
					else
					{
						$url = base_url().'gef/'.$empId.'/'.$pay_slip_month;
						$this->json->jsonReturn(array(
							'valid'=>TRUE,
							'url'=>$url
						));// condition for earning allowance.
					}
				}
			}
			else
			{
				
			}
		}
	}

	function generatePaySlipExcelFunction()
	{
		$empId = $this->uri->segment(2); 
		$pay_slip_month = $this->uri->segment(3);
		$empDetails=$this->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$empId);
		$whereId = $empDetails->company_id;
		//$whereId = $this->session->userdata("comp_id");
		$companyDetails=$this->master_model->selectDetailsWhr('tbl_company_master','company_id',$whereId);
		$employee_basic_info = $this->slip_aks_model->fetchDataForExcelGenerate($empId,$pay_slip_month);
		// echo $this->db->last_query();
		// exit();
		//$slip_static_data_id = $employee_basic_info->slip_static_data_id;
		$static_earn_data = $this->slip_aks_model->fetchDataForExcelEarnData($empId,$pay_slip_month);
		$static_deduct_data = $this->slip_aks_model->fetchDataForExcelDeductData($empId,$pay_slip_month);
		//echo $this->db->last_query(); exit();
		$this->load->library('excel');	
		$this->excel->salarySlipGenerateInExcelFormat($employee_basic_info, $static_earn_data, $static_deduct_data,$companyDetails,$pay_slip_month);
	}

	// public function salarySlipReportExcelFormat()
	// {
	// 	$this->load->library('monthly_report');	
	// 	$companyId = $this->uri->segment(2);
	// 	$salMonth = $this->uri->segment(3);
	// 	$month_year_array = explode('-', $salMonth);
		
	// 	$emp_basic_data_new = $this->Slip_vish_model->getAllSalaryDetailNewTable($salMonth, $companyId);
	// 	if (isset($emp_basic_data_new) && !empty($emp_basic_data_new)) {
	// 		$month = date('F', mktime(0, 0, 0, $month_year_array[0], 10));
	// 		$year = $month_year_array[1];
	// 		$month1 = $month_year_array[0];
	// 		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
	// 		$company_name = $this->Slip_vish_model->getCompDetails($companyId);// if ($emp_basic_data) {
	// 		$this->monthly_report->salarySlipReportExcelFormat_newTbl($emp_basic_data_new, $company_name, $num_days_of_month, $month1, $year, $salMonth, true);
	// 	} else {
	// 		$month = date('F', mktime(0, 0, 0, $month_year_array[0], 10));
	// 		$year = $month_year_array[1];
	// 		$month1 = $month_year_array[0];
	// 		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
	// 		// echo $num_days_of_month; exit();
	// 		$emp_basic_data = $this->Slip_vish_model->fetchDataForReport($salMonth, $companyId);
	// 		//echo $this->db->last_query();exit();
	// 		/*print_r($emp_basic_data); exit();*/
	// 		$company_name = $this->Slip_vish_model->getCompDetails($companyId);// if ($emp_basic_data) {
	// 		$this->monthly_report->salarySlipReportExcelFormat_new($emp_basic_data, $company_name, $num_days_of_month, $month1, $year, $salMonth, true);
	// 	}
	// }

	public function salarySlipReportExcelFormat()
	{
		$this->load->library('monthly_report');	
		$companyId = $this->uri->segment(2);
		$salMonth = $this->uri->segment(3);
		$month_year_array = explode('-', $salMonth);
		
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));		
		$year= $month_year_array[1];
		$month1= $month_year_array[0];
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
		// echo $num_days_of_month; exit();
		$emp_basic_data = $this->Slip_vish_model->fetchDataForReport($salMonth,$companyId);
	   
		/*print_r($emp_basic_data); exit();*/
		$company_name = $this->Slip_vish_model->getCompDetails($companyId);// if ($emp_basic_data) {
		$this->monthly_report->salarySlipReportExcelFormat_new($emp_basic_data,$company_name,$num_days_of_month,$month1,$year,$salMonth, true);	
	}


	

	
	public function genBonusReport()
	{
		$this->load->library('monthly_report');	
		$companyId = $this->uri->segment(2);
		$salMonth = $this->uri->segment(3);
		$month_year_array = explode('-', $salMonth);
		
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));		
		$year= $month_year_array[1];
		$month1= $month_year_array[0];
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
		// echo $num_days_of_month; exit();
		$emp_basic_data = $this->Slip_vish_model->fetchDataForReport($salMonth,$companyId);
	    //echo $this->db->last_query();exit();
		/*print_r($emp_basic_data); exit();*/
		$company_name = $this->Slip_vish_model->getCompDetails($companyId);// if ($emp_basic_data) {
		$this->monthly_report->salarySlipReportExcelFormat_new($emp_basic_data,$company_name,$num_days_of_month,$month1,$year,$salMonth, true, true);	
	}

	public function approveExpenditureReport()
	{
		$comp_id=$this->input->post('comp_id');
		$month=$this->input->post('month');
		$data=array('status'=>'Approved');

		$result=$this->master_model->updateDetailsWheWhr('tbl_basic_pt','salary_month',$month, 'company_id', $comp_id ,$data);

		if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Salary sheet Approved!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While approve salary sheet !</div>'
				));
			}
	}
	

	
	public function app_salarySlipReportExcelFormat()
	{
		$this->load->library('monthly_report');	
		$companyId = $this->uri->segment(2);
		$salMonth = $this->uri->segment(3);
		$month_year_array = explode('-', $salMonth);
		
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));		
		$year= $month_year_array[1];
		$month1= $month_year_array[0];
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
		// echo $num_days_of_month; exit();
		$emp_basic_data = $this->Slip_vish_model->fetchDataForReport($salMonth,$companyId);
	    //echo $this->db->last_query();exit();
		/*print_r($emp_basic_data); exit();*/
		$company_name = $this->Slip_vish_model->getCompDetails($companyId);// if ($emp_basic_data) {
		$data['filename'] = $this->monthly_report->salarySlipReportExcelFormat_new($emp_basic_data,$company_name,$num_days_of_month,$month1,$year,$salMonth, 0);
		$this->load->view('approve_expenditure',$data);
	}

	public function genBankLetter()
	{
		$this->load->library('monthly_report');	
		$companyId = $this->uri->segment(2);
		$salMonth = $this->uri->segment(3);
		$month_year_array = explode('-', $salMonth);
		
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));		
		$year= $month_year_array[1];
		$month1= $month_year_array[0];
		$data['companyDetails']=$this->master_model->selectDetailsWhr('tbl_company_master','company_id',$companyId);
		$data['city']=$this->master_model->selectDetailsWhr('tbl_city','city_id',$data['companyDetails']->city_id);
		$pdfname = $data['companyDetails']->company_name."-".$salMonth;
		$html=$this->load->view('bank_letter',$data,TRUE);
		//print_r($data['companyDetails']);
		$this->report_creation->Save_pdf($html,$pdfname);

	}
	public function genTextReport()
	{
		$this->load->library('monthly_report');	
		$companyId = $this->uri->segment(2);
		$salMonth = $this->uri->segment(3);
		$type = $this->uri->segment(4);
		$month_year_array = explode('-', $salMonth);
		
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));		
		$year= $month_year_array[1];
		$month1= $month_year_array[0];
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
		// echo $num_days_of_month; exit();
		$emp_basic_data = $this->Slip_vish_model->fetchDataForReport($salMonth,$companyId);
	    //echo $this->db->last_query();exit();
		/*print_r($emp_basic_data); exit();*/
		$companyDetails=$this->master_model->selectDetailsWhr('tbl_company_master','company_id',$companyId);
		$company_name = $companyDetails->company_name;
		$bob_data = array();

		$file = $company_name."-".$salMonth.".txt";
		$txt = fopen($file, "w") or die("Unable to open file!");
		
		// $this->monthly_report->salarySlipReportExcelFormat_new($emp_basic_data,$company_name,$num_days_of_month,$month1,$year,$salMonth);

		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
	 		
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

	 		foreach ($emp_basic_data as $key)
	 		{

	 			$netBasicTotK = 0;
	 			$emp_wise_ded=0;
	 			$boun_emp = 0;
	 			$emp_wise_add_deduction = 0;
	 		 	
				$emp_allData = $this->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
				$emp_Ded_allData = $this->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
				$earn_allowance = $this->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->empl_id);
				$emp_basic = $this->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->empl_id);
				$emp_leave_data = $this->Slip_vish_model->fetch_emp_leave_data($key->user_id,$month,$year);
              	$emp_paid_leave = $this->Slip_vish_model->fetch_paid_leave($key->user_id,$month,$year);
              	$emp_creditleave_data = $this->Slip_vish_model->fetch_emp_credit_leave_data($key->user_id,$year);
				
				$emp_creditleave = (isset($emp_creditleave_data->no_leave_credit) && !empty($emp_creditleave_data->no_leave_credit))?$emp_creditleave_data->no_leave_credit:'0';

				
				$monthsdiff = $this->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
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
				$actual_present_day=($key->work_day)-($emp_leave_data->earn_leave1);
              	$total_present_day=$actual_present_day+($emp_leave_data->earn_leave1);
				//$this->excel->getActiveSheet()->setCellValue('K'.$j,$total_present_day);
				//EARNING ALLOWANCE				
				if(isset($earn_allowance) && !empty($earn_allowance))
				{
					$basic = $key->basic_amt;//$emp_basic->emp_basic;
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
					$total_allowance=0;

					foreach ($earn_allowance as $earn)
					{
						if($earn->earning_id == 18 )
						{
							//DA allowance
							$emp_da = $emp_da + $earn->earn_value; 
							$da = $earn->earn_value;
							
						}elseif($earn->earning_id == 7)
						{
							//HRA
							
							$emp_hra = $emp_hra + $earn->earn_value;
							$hra = $earn->earn_value;
							
						}elseif($earn->earning_id == 3)
						{
							//Conveyance
							
							$emp_convy = $emp_convy + $earn->earn_value;
							$conveyance = $earn->earn_value;
							
						}elseif ($earn->earning_id == 6 ) 
						{
							// mobile allowance
							
							$emp_mob = $emp_mob + $earn->earn_value;
							$mobile = $earn->earn_value;
							
						}elseif($earn->earning_id == 13)
						{
							//medical allowance
							$emp_med = $emp_med + $earn->earn_value;
							$medical = $earn->earn_value;
							
						}elseif($earn->earning_id == 20)
						{
							//education allowance
							$emp_edu = $emp_edu + $earn->earn_value;
							$education = $earn->earn_value;
							
						}elseif($earn->earning_id == 14 )
						{				
							// City allowance
							
							$emp_city = $emp_city + $earn->earn_value;
							$city = $earn->earn_value;
							
						}elseif($earn->earning_id == 22)
						{
							//entertainment allowance
							
							$emp_enter = $emp_enter + $earn->earn_value;
							$entertainment = $earn->earn_value;
							
						}
						elseif($earn->earning_id == 9)
						{
							//entertainment allowance
							
							$emp_tot_alw = $emp_tot_alw + $earn->earn_value;
							$total_allowance = $earn->earn_value;						
							
						}
						elseif($earn->earning_id == 15)
						{
							//entertainment allowance
							
							$emp_bonus = $emp_bonus + $earn->earn_value;
							$bonus = $earn->earn_value;						
							
						}
					}
				}
				
				$gross = $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 + ($bonus)*1 +($total_allowance)*1;

				$gross1 = $basic + ($da)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 +($total_allowance)*1;

				
				$emp_gross = $emp_gross + $gross;

				//CTC
				
				$pf_earn = $pf_earn + $key->pf_earn;

				
				$ESIC_earn = $ESIC_earn + $key->ESIC_earn;

				
				$pf_deduct=$pf_deduct+$key->pf_deduct;

				
				$ESIC_deduct=$ESIC_deduct+$key->ESIC_deduct;

				$ctc = $gross+$key->pf_earn+$key->ESIC_earn;//+$key->pf_deduct+$key->ESIC_deduct;
				
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
					$basic = $key->basic_net/$num_days_of_month;					
					$emp_basic = $key->work_day*$basic; 
					
					$basic_net = $basic_net + $emp_basic;

					$hra = $key->hra/$num_days_of_month;
					$emp_earn_hra = $key->work_day*$hra;

					
					$HRA_total = $HRA_total + $emp_earn_hra;

					$convey = $key->convey/$num_days_of_month;
					$emp_convey = $key->work_day*$convey;

					
					$Conveyance_total = $Conveyance_total + $emp_convey;

					$total_mobile=0;
					$total_city=0;
					$total_medi=0;
					$total_edu=0;
					$total_entertainment=0;
					$otherAllow_total = 0;
					$total_bonus=0;
					$total_da=0;

					foreach ($emp_allData as $row)
					{
						if($row->earning_id == 18 )
						{
							//DA allowance
							$da = $key->special_allowance/$num_days_of_month;
							$value = $key->work_day*$da;
							
							$DA_total = $DA_total + $value;
							$total_da = $value;
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							
							$mobile_total_all = $mobile_total_all + $value;
							$total_mobile = $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							
							$medical_total = $medical_total + $value;
							$total_medi = $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							
							$education_total = $education_total + $value;
							$total_edu = $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							
							$city_total = $city_total + $value;
							$total_city = $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							
							$entertainment_total = $entertainment_total + $value;
							$total_entertainment = $value;
							
						}elseif($row->earning_id == 9)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							
							$otherAllow_total_all = $otherAllow_total_all + $value;
							$otherAllow_total = $value;
							
						}
						elseif($row->earning_id == 15)
						{
							//Bonus
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							
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
				$emp_basic = (isset($emp_basic->emp_basic))?$emp_basic->emp_basic:$emp_basic;
				$earn_gross = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($total_bonus)*1 + ($otherAllow_total)*1;

				
				$total_earn_gross = $total_earn_gross + $earn_gross; 
				
				$earn_gross1 = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1;

				
				$total_earn_gross1 = $total_earn_gross1 + $earn_gross1; 

				$earn_gross_pf = ($emp_basic)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1;

				
				$pf_dedct1 = $key->pf_deduct;
				$pfd_val = $key->pf_deduct/$num_days_of_month;
				if(isset($key->pf_deduct) && !empty($key->pf_deduct)){

					if ($earn_gross_pf >= 15000) {
						$pf_dedct = 1800;
					} else {
						$pf_dedct = round($earn_gross_pf*0.12);
					}						
					
				}else{
					$pf_dedct = 0;
				}
				
				$tot_pf_deduct=$tot_pf_deduct+$pf_dedct;

				$esicd_val = $key->ESIC_deduct/$num_days_of_month;
				
				if (isset($key->ESIC_deduct) && !empty($key->ESIC_deduct)) {
					if ($gross1 <= 21000) {
						$esic_dedct = $earn_gross1*0.0075;
					} else {
						$esic_dedct = 0;
					}	
				} else {
					$esic_dedct = 0;
				}
						
				
				$tot_ESIC_deduct=$tot_ESIC_deduct+$esic_dedct;

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

				
				$pt_total = $pt_total + $pt;

				
				$mobile_ded_total = $mobile_ded_total + $key->mobile_deduction;

				
				$emp_wise_ded = $emp_wise_ded+$key->other_deduct;

				

				if(isset($emp_Ded_allData) && !empty($emp_Ded_allData))
				{
					$recy_total=0;
					$Advance_deduction=0;
					foreach ($emp_Ded_allData as $rec)
					{
						if ($rec->deduction_id == 6)
						{
							
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
				$adv_Addition = $adv_Addition + $key->advance_Addition;
				$adv_recovery = $adv_recovery + $key->advance_recovery;
				$adv_closing_amt = $adv_closing_amt + $key->advance_closing_amt;

				$total_deduction = $pf_dedct + $esic_dedct + $pt + $key->mobile_deduction + $key->other_deduct + $key->advance_recovery;
				
				$total_deduct_mnth = $total_deduct_mnth + $total_deduction;

				//NET PAY
				$net_pay = ($earn_gross - $total_deduction) + $key->earn_arrears;
				$wfh_day = $key->wfh_day;
				$wfh_deduct_per = $key->wfh_deduct_per;
				$wfh_amt = $net_pay *$wfh_day/$total_present_day;
				$deduct_amt = 	$wfh_amt*$wfh_deduct_per/100;
				$net_pay = $net_pay - $deduct_amt;	
				fwrite($txt,sprintf("%04s", $sr++)."|".$companyDetails->account_no."|".round($net_pay)."|".$key->bank_ifc_code."|".$key->bank_acc_no."|".preg_replace('!\s+!', ' ', $key->emp_name)."|SB\n");
				$total_net_pay = $total_net_pay + round($net_pay);
				if($key->emp_ac_type ==="OBC"){
					$bob_data[] = array(
						"company_account"=>$companyDetails->account_no,
						"net_pay"=>round($net_pay),
						"account_number"=>$key->bank_acc_no,
						"emp_name" =>$key->emp_name
					);
				}
				
				
			}

			
		}

		if($type=="text"){
		fclose($txt);
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		header("Content-Type: text/plain");
		readfile($file);
		}else{
			//print_r($bob_data);exit;
			$this->monthly_report->exportBOBReport($bob_data, $company_name."-".$salMonth);
		}
	}
	public function genPfTextReport()
	{
		$companyId = $this->uri->segment(2);
		$salMonth = $this->uri->segment(3);
		$type = $this->uri->segment(4);
		$month_year_array = explode('-', $salMonth);
		
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));		
		$year= $month_year_array[1];
		$month1= $month_year_array[0];
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
		// echo $num_days_of_month; exit();
		$emp_basic_data = $this->Slip_vish_model->fetchDataForReport($salMonth,$companyId);
	    //echo $this->db->last_query();exit();
		/*print_r($emp_basic_data); exit();*/
		$companyDetails=$this->master_model->selectDetailsWhr('tbl_company_master','company_id',$companyId);
		$company_name = $companyDetails->company_name;
		$bob_data = array();

		$file = $company_name."-".$salMonth."PF.txt";
		$txt = fopen($file, "w") or die("Unable to open file!");
		
		// $this->monthly_report->salarySlipReportExcelFormat_new($emp_basic_data,$company_name,$num_days_of_month,$month1,$year,$salMonth);

		if (isset($emp_basic_data) && !empty($emp_basic_data))
 		{
	 		
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

	 		 	$emp_allData = $this->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($key->empl_id,$key->salary_month);
				$emp_Ded_allData = $this->Slip_vish_model->fetchDeductAllowDataOfEmpExpend($key->empl_id);	
				$earn_allowance = $this->master_model->selectAllWhr('tbl_emp_earn_allowance','emp_id',$key->empl_id);
				$emp_basic = $this->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$key->empl_id);
				$emp_leave_data = $this->Slip_vish_model->fetch_emp_leave_data($key->user_id,$month,$year);
               	$emp_paid_leave = $this->Slip_vish_model->fetch_paid_leave($key->user_id,$month,$year);
              	$emp_creditleave_data = $this->Slip_vish_model->fetch_emp_credit_leave_data($key->user_id,$year);
				$emp_creditleave = (isset($emp_creditleave_data->no_leave_credit) && !empty($emp_creditleave_data->no_leave_credit))?$emp_creditleave_data->no_leave_credit:'0';
				$monthsdiff = $this->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
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

				// sick leave
              	$emp_sick_leave_data = $this->Slip_vish_model->fetch_emp_sick_leave_data($key->user_id,$year);
				
				$emp_sick_leave = (isset($emp_sick_leave_data->sick_leave_creadit) && !empty($emp_sick_leave_data->sick_leave_creadit))?$emp_sick_leave_data->sick_leave_creadit:'0';

				$monthsdiff = $this->Slip_vish_model->fetch_month_diff_of_emp_joining_date_and_currdate($key->user_id);
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

				$emp_sick_leave_data = $this->Slip_vish_model->fetch_emp_sick_leave_data1($key->user_id,$month,$year);

				$emp_sick_leave = (isset($emp_sick_leave_data->sick_leave_creadit) && !empty($emp_sick_leave_data->sick_leave_creadit))?$emp_sick_leave_data->sick_leave_creadit:'0';

				$actual_present_day=($key->work_day)-($emp_leave_data->earn_leave1)-($emp_sick_leave_data->earn_leave1);
              	$total_present_day=$actual_present_day+($emp_leave_data->earn_leave1)+($emp_sick_leave_data->earn_leave1);
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
				$p_bonus = 0;
				$bonus = 0;
				$total_allowance=0;

				if(isset($earn_allowance) && !empty($earn_allowance))
				{
					foreach ($earn_allowance as $earn)
					{
						if($earn->earning_id == 18 )
						{
							$emp_da = $emp_da + $earn->earn_value; 
							$da = $earn->earn_value;
							
						}elseif($earn->earning_id == 7)
						{
							$emp_hra = $emp_hra + $earn->earn_value;
							$hra = $earn->earn_value;
							
						}elseif($earn->earning_id == 3)
						{
							$emp_convy = $emp_convy + $earn->earn_value;
							$conveyance = $earn->earn_value;
							
						}elseif ($earn->earning_id == 6 ) 
						{
							$emp_mob = $emp_mob + $earn->earn_value;
							$mobile = $earn->earn_value;
							
						}elseif($earn->earning_id == 13)
						{
							$emp_med = $emp_med + $earn->earn_value;
							$medical = $earn->earn_value;
							
						}elseif($earn->earning_id == 20)
						{
							$emp_edu = $emp_edu + $earn->earn_value;
							$education = $earn->earn_value;
							
						}elseif($earn->earning_id == 14 )
						{				
							$emp_city = $emp_city + $earn->earn_value;
							$city = $earn->earn_value;
							
						}elseif($earn->earning_id == 22)
						{
							$emp_enter = $emp_enter + $earn->earn_value;
							$entertainment = $earn->earn_value;
							
						}elseif($earn->earning_id == 25)
						{
							$emp_p_bonus = $emp_p_bonus + $earn->earn_value;
							$p_bonus = $earn->earn_value;
							
						}
						elseif($earn->earning_id == 9)
						{
							$emp_tot_alw = $emp_tot_alw + $earn->earn_value;
							$total_allowance = $earn->earn_value;						
							
						}
						elseif($earn->earning_id == 15)
						{
							$emp_bonus = $emp_bonus + $earn->earn_value;
							$bonus = $earn->earn_value;						
							
						}
					}
				}
				
				$gross = $basic + ($da)*1 + ($hra)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 + ($bonus)*1 +($total_allowance)*1+($p_bonus)*1;

				$gross1 = $basic + ($da)*1 + ($conveyance)*1 + ($mobile)*1 + ($medical)*1 + ($education)*1 + ($city)*1 + ($entertainment)*1 +($total_allowance)*1+($p_bonus)*1;
				$emp_gross = $emp_gross + $gross;
				$pf_earn = $pf_earn + $key->pf_earn;
				$ESIC_earn = $ESIC_earn + $key->ESIC_earn;
				$pf_deduct=$pf_deduct+$key->pf_deduct;
				$ESIC_deduct=$ESIC_deduct+$key->ESIC_deduct;
				$ctc = $gross+$key->pf_earn+$key->ESIC_earn;
				$total_ctc = $total_ctc + $ctc;

				$bsNet = 0;
				if(isset($key->net_pay) && $key->net_pay>0)
				{ 
					$bsNet = $key->net_pay + $key->pt_amt;
					$netBasicTotK = $bsNet;
				}

				$basic = $key->basic_net/$num_days_of_month;					
				$emp_basic = $key->work_day*$basic; 
				$basic_net = $basic_net + $emp_basic;
				$hra = $key->hra/$num_days_of_month;
				$emp_earn_hra = $key->work_day*$hra;
				$HRA_total = $HRA_total + $emp_earn_hra;
				$convey = $key->convey/$num_days_of_month;
				$emp_convey = $key->work_day*$convey;
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
							$da = $key->special_allowance/$num_days_of_month;
							$value = $key->work_day*$da;
							$DA_total = $DA_total + $value;
							$total_da = $value;
							
						}elseif ($row->earning_id == 6 ) 
						{
							// mobile allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$mobile_total_all = $mobile_total_all + $value;
							$total_mobile = $value;
							
						}elseif($row->earning_id == 13)
						{
							//medical allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$medical_total = $medical_total + $value;
							$total_medi = $value;
							
						}elseif($row->earning_id == 20)
						{
							//education allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$education_total = $education_total + $value;
							$total_edu = $value;
							
						}elseif($row->earning_id == 14 )
						{				
							// City allowance 
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$city_total = $city_total + $value;
							$total_city = $value;
							
						}elseif($row->earning_id == 22)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$entertainment_total = $entertainment_total + $value;
							$total_entertainment = $value;
							
						}elseif($row->earning_id == 25)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
							$p_bonus_total = $p_bonus_total + $value;
							$total_p_bonus = $value;
							
						}
						elseif($row->earning_id == 9)
						{
							//entertainment allowance
							$last_val = $row->value/$num_days_of_month;
							$value = $key->work_day*$last_val;
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
								$value = $this->Slip_vish_model->getYearyBonus($key->empl_id, $key->salary_month);
							}
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

				//$this->excel->getActiveSheet()->setCellValue('AT'.$j,round($earn_gross));
				$total_earn_gross = $total_earn_gross + $earn_gross; 

				$earn_gross1 = ($emp_basic)*1 + ($emp_earn_hra)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1 +($total_p_bonus)*1;

				$total_earn_gross1 = $total_earn_gross1 + $earn_gross1; 

				$earn_gross_pf = ($emp_basic)*1 + ($emp_convey)*1 + ($total_da)*1 + ($total_mobile)*1 + ($total_medi)*1 + ($total_edu)*1 + ($total_city)*1 + ($total_entertainment)*1 + ($otherAllow_total)*1+($total_p_bonus)*1;

				$pf_dedct1 = $key->pf_deduct;
				$pfd_val = $key->pf_deduct/$num_days_of_month;
				if(isset($key->pf_deduct) && !empty($key->pf_deduct)){
					$pf_dedct = round(($emp_basic + ($total_da)*1)*0.12);
					if ($pf_dedct > 1800) {
						$pf_dedct = 1800;
					}									
				}else{
					$pf_dedct = 0;
				}

				//$this->excel->getActiveSheet()->setCellValue('AV'.$j,round($pf_dedct));
				$tot_pf_deduct=$tot_pf_deduct+$pf_dedct;


	 			$ahaiar = $total_da + $emp_basic;
	 			if($ahaiar>15000)
	 			$ahaiar=15000;
	 			$per_833 = $ahaiar*8.33/100;
	 			$per_367 = $ahaiar*3.67/100;
	 			if($pf_dedct>0){
	 				$str = $key->pf_acc_no.'#~#'.$key->emp_name.'#~#'.round($earn_gross).'#~#'.round($ahaiar).'#~#'.round($ahaiar).'#~#'.round($ahaiar).'#~#'.round($pf_dedct).'#~#'.round($per_833).'#~#'.round($per_367).'#~#0#~#0';
	 				fwrite($txt, $str . "\n");
	 			}
	 			
				
			}

			
		}
		
		fclose($txt);
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		header("Content-Type: text/plain");
		readfile($file);
		
	}
	

	public function reportList()
	{
		$data['SalaryList'] = $this->Slip_vish_model->getExpenditureReportData();
		$this->load->view('expenditure',$data);
	}

	public function bonusReport()
	{
		$data['SalaryList'] = $this->Slip_vish_model->getExpenditureReportData();
		$this->load->view('bonusReport',$data);
	}

	
	function reprintPaySlipGenerate()
	{
		$data['compDetails']=$this->master_model->SelectCompany();
		$this->load->view('reprint_salary_slip',$data);

	}

	function reprintPaySlipDataTable()
	{	
		if($this->session->userdata("role_id")==1)
		{
			$company_id = $this->input->post("comp_id");
		}
		else
		{
			$company_id = $this->session->userdata("comp_id");
		}
		$data['compDetails']=$this->master_model->SelectCompany();
		$paySlipMonth = $this->input->post('reprint_slip_months');
		$data['reprintTableData'] = $this->slip_aks_model->reprintPaySlipExcelFileGenerate($paySlipMonth,$company_id);
		$this->load->view('reprintPaySlipTable',$data);
	}

	function deletePaySlipData()
	{


		$recovery_amount= 0; 

		$empId = $this->input->post('id');
		$paySlipMonth= $this->input->post('rev');
		$recovery_amount = $this->slip_aks_model->GetAdvanceOnDelete($paySlipMonth,$empId);
		//echo($recovery_amount);
		$opening= $this->slip_aks_model->getOpeningAmtWhrOnDelete($empId);
		//print_r($recovery_amount);
		if($opening){
		$opening = $opening + $recovery_amount;

		$result = $this->slip_aks_model->setOpeningAmtWhrDelete($empId,$opening);
		

		
			if($result)
			{

			$res= $this->slip_aks_model->reprintslip($paySlipMonth,$empId);
			$data['reprintTableData'] = $this->slip_aks_model->reprintPaySlipExcelFileGenerate($paySlipMonth,$empId);
			$this->load->view('reprintPaySlipTable',$data);

			}else{
			$res= $this->slip_aks_model->reprintslip($paySlipMonth,$empId);
			$data['reprintTableData'] = $this->slip_aks_model->reprintPaySlipExcelFileGenerate($paySlipMonth,$empId);
			$this->load->view('reprintPaySlipTable',$data);
			}
		}else{
			$res= $this->slip_aks_model->reprintslip($paySlipMonth,$empId);
			$data['reprintTableData'] = $this->slip_aks_model->reprintPaySlipExcelFileGenerate($paySlipMonth,$empId);
			$this->load->view('reprintPaySlipTable',$data);
		}
	}	

	function advance_view()
	{
		$tbl_name='tbl_country';
		$uniqueField='country_name';
		//$whereId=$this->session->userdata('comp_id');
		$company_id = $this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['employee_create']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$company_id);
		$data['advanceData']=$this->master_model->fetchAdvanceData();
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('master/advance_view',$data);
	}

	function advancefetch()
	{
		$company_id = $this->session->userdata('comp_id');
		//$data['employee_create']=$this->master_model->selectDetailsDisplayByASC('tbl_designation','desig_name');
		$data['advanceData']=$this->master_model->fetchAdvanceData();		
		//$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('master/advance_view_table',$data);
	}

	

//add advance


	public function saveAdvance()
	{			
		$company_id = $this->input->post("comp_id");
			
		$ischk=trim($this->input->post('rel'));
		$emp_id=trim($this->input->post('emp_name'));
		$advance_date=trim($this->input->post('advance_date'));
		$amount=trim($this->input->post('amount'));
		$desig_name=trim($this->input->post('design_name_ad'));
		$recovery_mode=trim($this->input->post('recovery_mode'));
		$rec_mode_amt=trim($this->input->post('recovery_amount'));


		$opening= $this->slip_aks_model->getOpeningAmtWhr($emp_id);
		//echo $this->db->last_query();
		
		if(isset($opening) && !empty($opening))
		{ //print_r($opening);exit();
			foreach ($opening as $key) {
				$opening_amt = $key->opening_amt + $amount;	
				//$rec_mode_amt = $key->recoveryPermonthAmt + $rec_mode_amt;	
			}
			$data=array(
				'opening_amt'=>$opening_amt,
				'recovery_mode'=>$recovery_mode,
				'recoveryPermonthAmt'=>$rec_mode_amt,
				'closing_amt'=>$opening_amt,
				'addition_amt'=>$amount		
			);	
			$result = $this->master_model->updateDetails('tbl_advance_details','emp_id',$emp_id, $data);

			$data1=array(
				'company_id'=>$company_id,
				'emp_id'=>$emp_id,
				'opening_amt'=>$opening_amt,
				'recovery_mode'=>$recovery_mode,
				'recoveryPermonthAmt'=>$rec_mode_amt,
				'addition_amt'=>$amount,
				'closing_amt'=>$opening_amt,				
				'updated_date'=>date('Y-m-d')				
			);
			$result1 = $this->master_model->addData('tbl_advance_temp_details', $data1);
			//$res = $this->slip_aks_model->setOpeningAmtWhr($emp_id,$opening,$recovery_mode,$rec_mode_amt);
		}else{
			$data=array(
				'company_id'=>$company_id,
				'emp_id'=>$emp_id,
				'opening_amt'=>$amount,
				'recovery_amt'=>0,
				'addition_amt'=>0,
				'closing_amt'=>$amount,
				'recovery_mode'=>$recovery_mode,
				'recoveryPermonthAmt'=>$rec_mode_amt				
			);		

			$tableName = 'tbl_advance_details';
			$advance_details_result =$this->master_model->addData($tableName,$data);

			$data1=array(
				'company_id'=>$company_id,
				'emp_id'=>$emp_id,
				'opening_amt'=>$amount,
				'recovery_amt'=>0,
				'addition_amt'=>0,
				'closing_amt'=>$amount,
				'recovery_mode'=>$recovery_mode,
				'recoveryPermonthAmt'=>$rec_mode_amt,				
				'updated_date'=>date('Y-m-d')			
			);
			$result1 = $this->master_model->addData('tbl_advance_temp_details', $data1);
		}
		
		$data=array(
			'company_id'=>$company_id,
			'emp_id'=>$emp_id,
			'amount'=>$amount,
			'advance_date'=>$advance_date,
			'desig_id'=>$desig_name				
		);		

		$tableName = 'tbl_advance';

		if(isset($ischk) && !empty($ischk) && ($ischk>0))
		{
			$uniqueField = 'emp_id';

			$result = $this->master_model->updateDetails($tableName, $uniqueField, $emp_id, $data);

			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Company Details Updated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Company Details !</div>'
				));
			}
		}
		else
		{
			$advance_details_result =$this->master_model->addData($tableName,$data);

			if($advance_details_result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well done!</strong> Company Information Saved Successfully !</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> Try To Submit Again .</div>'
				));	
			}
		}
	}

	public function delete_advance()
	{
		$emp_id=$this->input->post('id');
		$tableName = 'tbl_advance_details';
		$uniqueField = 'emp_id';		
		$data=array('display'=>'N');

		$result=$this->master_model->updateDetails($tableName,$uniqueField,$emp_id,$data);
		if($result)
		{
			$this->master_model->updateDetails('tbl_advance','emp_id',$emp_id,$data);
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Advance Details Deleted Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting Advance Details !</div>'
			));
		}
	}

	public function update_advance()
	{
		$adv_id = $this->input->post('id');
		$data['adv_id'] = $this->input->post('id');
		$advance_data=$this->master_model->selectDetailsWhr('tbl_advance_details','adv_id',$adv_id);
		$data['advance_data']=$this->master_model->fetchAdvanceDataByEmp($advance_data->emp_id);
		$update_view=$this->load->view('master/advance_update',$data,true);
		$this->json->jsonReturn(array( 
				'valid'=>TRUE,
				'view'=>$update_view
			));
	}

	public function update_advance_str()
	{
		$adv_id = $this->input->post("adv_id");			
		$opening_amt=trim($this->input->post('opening_amt'));
		$recoveryPermonthAmt = $this->input->post('recoveryPermonthAmt'); 
		$closing_amt = $this->input->post('closing_amt'); 
		/*$closing_amt = (isset($closing_amt) && ($opening_amt == $closing_amt))?$closing_amt:$opening_amt;*/
		

		$data = array('opening_amt' =>($opening_amt-$recoveryPermonthAmt),'recoveryPermonthAmt'=>$recoveryPermonthAmt,'closing_amt'=>($closing_amt));
		//print_r($data); exit();
		$advance_data = $this->master_model->selectDetailsWhr('tbl_advance_details', 'adv_id', $adv_id);
		if(isset($advance_data) && !empty($advance_data)){
			$data1= array('company_id'=>$advance_data->company_id,'emp_id'=>$advance_data->emp_id,'opening_amt' =>($opening_amt-$recoveryPermonthAmt),'recovery_mode'=>$advance_data->recovery_mode,'recovery_amt'=>$recoveryPermonthAmt,'recoveryPermonthAmt'=>$advance_data->recoveryPermonthAmt,'closing_amt'=>($closing_amt),'updated_date'=>date('Y-m-d'));
			$result1 = $this->master_model->addData('tbl_advance_temp_details', $data1);
		}
		
		$result = $this->master_model->updateDetails('tbl_advance_details', 'adv_id', $adv_id, $data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Details Updated Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Details !</div>'
			));
		}
	}

	public function CompanyWiseReport()  
	{		
		$this->load->model('Slip_vish_model');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC1();
		$this->load->view('CompanyWiseReport',$data);
	}

	public function generate_compy_wise_report()
	{
		$this->load->library('monthly_report');
		$companyId = $this->input->post('comp_id');
		$companyId = implode(',', $companyId);
		$salMonth = $this->input->post('slip_months');
		$month_year_array = explode('-', $salMonth);
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year= $month_year_array[1];				
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 
		$emp_basic_data = $this->Slip_vish_model->fetchallDataForReport($salMonth,$companyId);
		if($companyId=='All')
		{
			$company_name = 'All Companywise Salary Report';
		}else{
			$company_name = $this->Slip_vish_model->getCompDetails($companyId);
		}	
		$this->monthly_report->generate_compy_wise_report($emp_basic_data,$company_name,$num_days_of_month,$month,$year);
	}

	public function approve_salaryslip()
	{
		$this->load->model('Slip_vish_model');
		$company_id = $this->session->userdata('comp_id');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC1();	
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);

		$this->load->view('approve_salaryslip',$data);
	}

	public function fetch_salaryslip_list()
	{	
		$company_id = $this->input->post('comp_id'); 		
		$salaryMonth = $this->input->post('slip_months'); 

		$month_year_array = explode('-', $salaryMonth);	
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));		
		$year= $month_year_array[1];
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);
		$data['num_days_of_month']=$num_days_of_month;
		$data['empSalaryList'] = $this->slip_aks_model->fetchSalaryDetailsEmpByMonth($salaryMonth,$company_id);
		$data['salaryMonth'] = $salaryMonth;
		$this->load->view('emp_salaryslip_list',$data);
	} 

	public function update_salaryslip_status()
	{
		$this->load->model('slip_aks_model');
		$comp_id = $this->input->post("comp_id");			
		$emp_id=trim($this->input->post('emp_id'));
		$salaryMonth = $this->input->post('month'); 
		
		$emp = explode(",",$emp_id);
		
		/*$star_data = array();
		for($i=0;$i<count($emp);$i++)
		{
			//echo $emp[$i]; exit();
			$star_data = $this->slip_aks_model->fetch_star_details($emp[$i],$salaryMonth);
			//print_r($star_data);
			if(isset($star_data->red_star) && $star_data->red_star>='10')
			{
				$red_star = $star_data->red_star - 10;
				$this->slip_aks_model->update_star_details($star_data->user_id,$salaryMonth,$red_star);				
			}
		}*/



		$result = $this->slip_aks_model->update_salaryslip_status($emp_id, $comp_id, $salaryMonth);
		
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Details Updated Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Details !</div>'
			));
		}
	}

	public function approve_paid_leave()
	{
		$data['compDetails']=$this->master_model->SelectCompany();
		$this->load->view('approve_paid_leave',$data);
	}

	public function fetch_emp_list()
	{ 
		$company_id=$this->input->post('comp_id');
		$data['emp_list'] = $this->master_model->selectDetailsDisplay('tbl_employee_creation',$company_id);
		$this->load->view('emp_list_for_leave',$data); 
	}

	public function leave_model()
    {
    	$id = $this->input->post('id');
    	$data['leave_data'] = $this->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$id);
    	$view=$this->load->view('leave_model',$data,true);
		$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'view'=>$view
					));
    }

    public function update_leaves()
    {
    	$paid_leave = $this->input->post('paid_leave');
    	$approve_leave = $this->input->post('approve_leave');
    	$bal_approve_leave = $this->input->post('bal_approve_leave');
    	$taken_leave = $this->input->post('taken_leave');
    	$bal_taken_leave = $this->input->post('bal_taken_leave');
    	$balance_leave = $this->input->post('balance_leave');
    	$emp_id = $this->input->post('emp_id');

    	$data2 = array('paid_leave'=>$paid_leave,'approve_leave'=>$approve_leave,'bal_approve_leave'=>$bal_approve_leave,'taken_leave'=>$taken_leave,'bal_taken_leave'=>$bal_taken_leave,'balance_leave' =>$balance_leave);
    	
    	$result = $this->master_model->updateDetails('tbl_employee_creation', 'emp_id', $emp_id, $data2);
    	if($result)
		{
	    	if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Details Saved Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Details !</div>'
				));
			}
		}
    }
	
	public function payslip_report()  
	{		
		$this->load->model('Slip_vish_model');
		$data['companyData'] = $this->Slip_vish_model->selectDisplayCompanyByASC1();
		// $data['employeeData'] = $this->slip_aks_model->fetchAllEmployee();
		$data['earningData'] = $this->master_model->selectDetailsDisplayByASC1('tbl_earning_allowance', 'earning_name');
		$data['deductionData'] = $this->master_model->selectDetailsDisplayByASC1('tbl_deduction_allowance', 'deduction_name');
		$this->load->view('payslip_report',$data);
	}

	public function fetch_emp_by_company()
	{
		$cid = $this->input->post('id');
		$empDetails = array();
		if($cid == 'All')
		{
			$empDetails = $this->slip_aks_model->fetchAllEmployee();
		}
		else
		{
			$empDetails = $this->slip_aks_model->fetchAllEmployeeByComyReport($cid);
		}

		$cnt = '<option value="All">All</option>';
		if(isset($empDetails) && !empty($empDetails))
		{
			foreach ($empDetails as $key) 
			{
				$cnt = $cnt.'<option value="'.$key->emp_id.'">'.$key->emp_name.'</option>';
			}
		}		
		$this->json->jsonReturn($cnt);
	}

	public function fetch_allowance_by_emp()
	{
		$eid = $this->input->post('id');
		$earningAllowance = array();
		$deductionAllowance = array();

		if($eid == 'All')
		{
			$earningAllowance = $this->master_model->selectDetailsDisplayByASC1('tbl_earning_allowance', 'earning_name');
			$deductionAllowance = $this->master_model->selectDetailsDisplayByASC1('tbl_deduction_allowance', 'deduction_name');
		}
		else
		{
			$earningAllowance = $this->slip_aks_model->fetchParticularEmpEarningDataReport($eid);	
			$deductionAllowance = $this->slip_aks_model->fetchParticularEmpDeductionDataReport($eid);
		}
		
		$cnt = '<option value="All">All</option>';
		if(isset($earningAllowance) && !empty($earningAllowance))
		{
			foreach ($earningAllowance as $key) 
			{
				$cnt = $cnt.'<option value="'.$key->earning_id.'">'.$key->earning_name.'</option>';
			}
		}	

		$cnt1 = '<option value="All">All</option>';
		if(isset($deductionAllowance) && !empty($deductionAllowance))
		{
			foreach ($deductionAllowance as $key) 
			{
				$cnt1 = $cnt1.'<option value="'.$key->deduction_id.'">'.$key->deduction_name.'</option>';
			}
		}		
		$this->json->jsonReturn(array('earning' => $cnt, 'deduction' =>$cnt1));
	}

	public function generate_payslip_report()
	{
		$this->load->library('monthly_report');

		$comp_id1 = $this->input->post('comp_id');
		if(isset($comp_id1) && !empty($comp_id1))
		{
			$comp_id = implode(',', $comp_id1);
		}
		$data['comp_id'] = $comp_id;
		$emp_id = $this->input->post('emp_id');
		if(isset($emp_id) && !empty($emp_id))
		{
			$data['emp_id'] = implode(',', $emp_id);	
		}
		
		$earning_id = $this->input->post('earning_id');
		if(isset($earning_id) && !empty($earning_id))
		{
			$earning_id = implode(',', $earning_id);
		}
		$earning_id = (isset($earning_id) && !empty($earning_id))?$earning_id:'0';
		$data['earning_id'] = $earning_id;

		$deduction_id = $this->input->post('deduction_id');
		if(isset($deduction_id) && !empty($deduction_id))
		{
			$deduction_id = implode(',', $deduction_id);
		}
		$deduction_id = (isset($deduction_id) && !empty($deduction_id))?$deduction_id:'0';
		$data['deduction_id'] = $deduction_id;
		
		$data['slip_month'] = $this->input->post('slip_month');
		$month_year_array = explode('-', $data['slip_month']);
		$month = date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year = $month_year_array[1];				
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]);

		$data['slip_year'] = $this->input->post('slip_year');

		$report_data = $this->master_model->payslip_report_data($data);
		
		if($comp_id == 'All')
		{
			$company_name = 'All Companywise Salary Report';
			$file_name = 'All Companywise Salary Report.xls';
		}
		else
		{	
			if(count($comp_id1)==1)
			{
				$company_name = $this->Slip_vish_model->getCompDetailsReport($comp_id);
				$file_name = $company_name.'.xls';
			}
			else
			{
				$company_name = 'Company Wise Report';
				$file_name = 'Company Wise Report.xls';
			}
		}

		$this->monthly_report->generate_payslip_report($report_data, $company_name, $num_days_of_month, $month, $year, $file_name, $earning_id, $deduction_id);
	}

	public function register_of_wages()  
	{		
		$this->load->model('master_model');
		//$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');

		$data['empData']=$this->Slip_vish_model->SelectEmp();
		$this->load->view('hr compliances/register_of_wages',$data);
	}

	public function gen_register_of_wages_report()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$emp_id = implode(',', $emp_id);
		$salMonth = $this->input->post('slip_months');  
		$month_year_array = explode('-', $salMonth);
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year= $month_year_array[1];				
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 
		$emp_basic_data = $this->Slip_vish_model->fetchallDataForReport($salMonth,$emp_id); 
		$company_name = 'Register of Wages Report';			
		$this->monthly_report->gen_register_of_wages_report($emp_basic_data,$company_name,$num_days_of_month,$month,$year);
	}

	public function leave_wages_register()  
	{		
		$this->load->model('master_model');
		$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
		$this->load->view('hr compliances/leave_wages_register',$data);
	}

	public function gen_leave_wages_register()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$years = $this->input->post('years');
		$emp_leave_data = $this->Slip_vish_model->fetch_leave_wages_regis($emp_id,$years);
		$emp_data = $this->Slip_vish_model->fetch_emp_all_data($emp_id);
		//echo $this->db->last_query();exit();
		$this->monthly_report->gen_leave_wages_register($emp_leave_data,$emp_data,$years);
	}

	public function advance_register()  
	{		
		$this->load->model('master_model');
		$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
		$this->load->view('hr compliances/advance_register',$data);
	}

	public function gen_advance_register()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$emp_id = implode(',', $emp_id);
		$salMonth = $this->input->post('slip_months');
		$month_year_array = explode('-', $salMonth);
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year= $month_year_array[1];				
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 
		$emp_basic_data = $this->Slip_vish_model->fetch_emp_compwise_data($emp_id,$salMonth);
		$company_name = 'Advance Register Report';		
		$this->monthly_report->gen_advance_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year);
	}

	public function deduction_register()  
	{		
		$this->load->model('master_model');
		$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
		$this->load->view('hr compliances/deduction_register',$data);
	}

	public function gen_deduction_register()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$emp_id = implode(',', $emp_id);
		$salMonth = $this->input->post('slip_months');
		$month_year_array = explode('-', $salMonth);
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year= $month_year_array[1];				
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 
		$emp_basic_data = $this->Slip_vish_model->fetch_emp_compwise_data($emp_id,$salMonth);
		$company_name = 'Deduction Register Report';		
		$this->monthly_report->gen_deduction_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year);
	}

	public function overtime_register()  
	{		
		$this->load->model('master_model');
		$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
		$this->load->view('hr compliances/overtime_register',$data);
	}

	public function gen_overtime_register()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$emp_id = implode(',', $emp_id);
		$salMonth = $this->input->post('slip_months');
		$month_year_array = explode('-', $salMonth);
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year= $month_year_array[1];				
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 
		$emp_basic_data = $this->Slip_vish_model->fetch_emp_compwise_data($emp_id,$salMonth);
		$company_name = 'Overtime Register Report';
		$this->monthly_report->gen_overtime_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year);
	}

	public function fines_register()  
	{		
		$this->load->model('master_model');
		$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
		$this->load->view('hr compliances/fines_register',$data);
	}

	public function gen_fines_register()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$emp_id = implode(',', $emp_id);
		$salMonth = $this->input->post('slip_months');
		$month_year_array = explode('-', $salMonth);
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year= $month_year_array[1];				
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 
		$emp_basic_data = $this->Slip_vish_model->fetch_emp_compwise_data($emp_id,$salMonth);
		$company_name = 'Fine Register Report';
		$this->monthly_report->gen_fines_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year);
	}

	public function get_total_salary()
	{
		$data=$this->Slip_vish_model->get_total_salary();		
        $this->json->jsonReturn($data);
	}

	public function get_total_emp()
	{
		$data=$this->Slip_vish_model->get_total_emp();		
        $this->json->jsonReturn($data);
	}

	public function muster_wage_register()  
	{		
		$this->load->model('Slip_vish_model');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC1();
		$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
		$this->load->view('hr compliances/muster_wage_register',$data);
	}

	public function gen_muster_wage_register()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$emp_id = implode(',', $emp_id);
		$salMonth = $this->input->post('slip_months');
		$month_year_array = explode('-', $salMonth);
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year= $month_year_array[1];				
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 
		$emp_basic_data = $this->Slip_vish_model->fetchmasterwagesDataForReport($salMonth,$emp_id);
		$company_name = 'MOON SEZ CONSULTANTS PRIVATE LIMITED';
		$this->monthly_report->gen_muster_wage_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year,$salMonth);
	}

	public function approve_salary_str()
	{
		$data['pending_str'] = $this->slip_aks_model->selectAllempDetails();
		$this->load->view('approve_salary_str',$data);
	}

	public function approve_salary_model()
	{
		$emp_id = $this->input->post('id');
		$data['earning_data']=$this->slip_aks_model->fetchEarning($emp_id);
      	$data['deduction_data']=$this->slip_aks_model->fetchDeduction($emp_id);
		$data['singleEmployee'] = $this->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$emp_id);		
		$update_view=$this->load->view('salary_str_model',$data,true);
		$this->json->jsonReturn(array( 
				'valid'=>TRUE,
				'view'=>$update_view
			));
	}

	public function save_salary_str()
	{
		$status = $this->input->post('status');
		$remark = $this->input->post('remark');
		$emp_id = $this->input->post('emp_id');
		$data = array('status' =>$status , 'remark'=>$remark);
		$result = $this->master_model->updateDetails('tbl_employee_creation', 'emp_id', $emp_id, $data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Data Updated Successfully!</div>'
			));
		}else{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error! </strong> While Saving Data!</div>'
			));
		}
	}

	public function emp_salary_report()  
	{		
		$this->load->model('master_model');
		$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
		$this->load->view('hr compliances/emp_salary_report',$data);
	}

	public function gen_emp_salary_report()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$year = $this->input->post('years');
		$emp_salary_data = $this->Slip_vish_model->gen_emp_salary_report($emp_id,$year);
		// echo $this->db->last_query();die;
		$emp_data = $this->Slip_vish_model->fetch_emp_all_data($emp_id);
		// echo $this->db->last_query();die;
		$this->monthly_report->gen_emp_salary_report($emp_salary_data,$emp_data,$year);
	}

	public function employee_register()
	{
		$this->load->model('master_model');
		$data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
		$this->load->view('hr compliances/employee_register',$data);
	}

	public function gen_employee_register()
	{
		$this->load->library('monthly_report');
		$emp_id = $this->input->post('emp_id');
		$emp_id = implode(',', $emp_id);
		$salMonth = $this->input->post('slip_months');
		$month_year_array = explode('-', $salMonth);
		$month= date('F', mktime(0, 0, 0, $month_year_array[0], 10));
		$year= $month_year_array[1];
		$num_days_of_month = cal_days_in_month(CAL_GREGORIAN, $month_year_array[0], $month_year_array[1]); 
		$emp_basic_data = $this->Slip_vish_model->fetch_emp_wise_data($emp_id);
		//print_r($emp_basic_data); exit();
		$company_name = 'Employee Register';
		$this->monthly_report->gen_employee_register($emp_basic_data,$company_name,$num_days_of_month,$month,$year);
	}

	public function delete_salary()
	{
		$company_id = $this->input->post('id');
		$mth = $this->input->post('mth');

		$deleted_by = $this->session->userdata('userid');
        $currentDate = date('Y-m-d H:i:s');
		$mth = $this->input->post('mth');
		$data=array(
			'display'=>'N',
			'deleted_by'=>$deleted_by,
			'deleted_on'=>$currentDate
		);
		$result = $this->master_model->updateDetailsWheWhr('tbl_emp_salary_excel_genrated_data', 'company_id', $company_id, 'salary_month', $mth, $data);
		
		
		$result = $this->Slip_vish_model->deleteSalary($company_id, $mth);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Data Updated Successfully!</div>'
			));
		}else{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error! </strong> While Saving Data!</div>'
			));
		}
	}


	public function employee_advance_report()
	{
		$this->load->model('master_model');
		$data['empData']=$this->master_model->fetch_emp_advance_details();
		$this->load->view('hr compliances/employee_advance_report',$data);
	}

	public function gen_employee_advance_details()
	{
		$emp_id = $this->input->post('emp_id');
		$emp_data= $this->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$emp_id);
		$data['emp_name'] = $emp_data->emp_name;
		$data['empDetails'] = $this->master_model->fetch_advance_details($emp_id);
		$view = $this->load->view('hr compliances/employee_advance_report_table',$data,TRUE);
		$this->json->jsonReturn(array('view'=>$view));
	}


	public function local_exp(){
	  $data['empData']=$this->master_model->selectDetailsDisplayByASC1('tbl_employee_creation', 'emp_id');
	  $data['exp_data']=$this->master_model->getExpNewData();	
	  $this->load->view('master/local_exp_view',$data);
	}

	function exp_view_tbl()
	{
		
		$data['exp_data']=$this->master_model->getExpNewData();		
	    $this->load->view('master/expenses_view_table',$data);
	}

	public function save_Exp(){
		$emp_name=$this->input->post('emp_name');
		$exp_amt=$this->input->post('expenses');
		$month=date('m-Y');
		$currentDate = date('Y-m-d H:i:s');
		$entry_by = $this->session->userdata('userid');

		$expData=array(
			'emp_name'=>$emp_name,
			'expenses'=>$exp_amt,
			'month'=>$month,
			'created_at'=>$currentDate,
			'created_by'=>$entry_by
		);

		$result=$this->master_model->addData('tbl_emp_monthly_expenses',$expData);

		if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Expenses Details Updated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Expenses Details !</div>'
				));
			}
		
	}


	
}
