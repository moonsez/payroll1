<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /*
	Author :- Vaishali
	work :- Allowance Master(form earning allowance & deduction )

 */

class slip_v extends CI_Controller {
	
	public function __construct()
     {
        parent::__construct();
        $this->load->model('master_model');
        $this->load->model('slip_aks_model');
    }

    public function earningAllowance()
	{
		$tbl_name='tbl_earning_allowance';
		$uniqueField='earning_name';
		$comp_id=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['earningData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$comp_id);
		$this->load->view('/master/earning_allowance',$data);
	}

	public function fetchEarning_allowance()
	{
		$tbl_name='tbl_earning_allowance';
		$uniqueField='earning_name';
		$comp_id=$this->session->userdata('comp_id');
		$data['earningData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$comp_id);
		$this->load->view('master/earning_allowance_table',$data);	
	}

	public function editEarning_allowance()
	{
		$earning_Id = $this->input->post('id');
		$tblName = 'tbl_earning_allowance';
		$where = 'earning_id';

		$tbl_name='tbl_earning_allowance';
		$uniqueField='earning_name';
		$whereId=$this->session->userdata('comp_id');

		$data['compDetails']=$this->master_model->SelectCompany();
		$data['singleEarning'] = $this->master_model->selectDetailsWhr($tblName,$where,$earning_Id);
		$data['earningData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/earning_allowance',$data);	
	}

	public function fetch_all_employee_data()
	{
		$id= $this->input->post('id');
		$comp_id= $this->input->post('comp_id');
 		$data['EmpDetails']=$this->slip_aks_model->fetchAllEmployeeDeatils($id,$comp_id);
 		// print_r($data['EmpDetails']);
 		// echo $this->db->last_query();die;	
 		$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'desig_name'=>$data['EmpDetails']->title,
					'emp_code'=>$data['EmpDetails']->username,
					'dob'=>date('d-m-Y',strtotime($data['EmpDetails']->date_of_birth)),
					'dog'=>date('d-m-Y',strtotime($data['EmpDetails']->emp_joining_date)),
					'email'=>$data['EmpDetails']->work_email,
					'pan'=>$data['EmpDetails']->pan_number,
					'gender'=>$data['EmpDetails']->gender,
					'local_address'=>$data['EmpDetails']->local_address,
					'permanent_address'=>$data['EmpDetails']->permanent_address,
					'user_id'=>$data['EmpDetails']->user_id,					
		));
 		
 	}

	public function saveEarning_allowance()
		{		

			if($this->session->userdata("comp_id")==1){

				$company_id = $this->input->post("comp_id");
			}else{
				$company_id = $this->session->userdata("comp_id");
			}
			
			$earning_id=trim($this->input->post('id'));
			$earning_name=trim($this->input->post('earning_name'));
			$earning_code=trim($this->input->post('earning_code'));
			$earning_unit=trim($this->input->post('unit'));
			$calculate=trim($this->input->post('calculate'));
			$earning_default_value=trim($this->input->post('earning_default_value'));
			$data=array('earning_name'=>$earning_name,'company_id'=>$company_id, 'earning_code'=>$earning_code,'earning_unit'=>$earning_unit,'earning_default_value'=>$earning_default_value, 'calculate' => $calculate);
			if(isset($earning_id) && !empty($earning_id) && ($earning_id>0))
			{
				$tableName = 'tbl_earning_allowance';
				$uniqueField = 'earning_id';

				$result = $this->master_model->updateDetails($tableName, $uniqueField, $earning_id, $data);

				if($result)
				{
					$this->json->jsonReturn(array(
						'valid'=>TRUE,
						'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Allowance Updated Successfully!</div>'
					));
				}
				else
				{
					$this->json->jsonReturn(array(
						'valid'=>FALSE,
						'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Allowance !</div>'
					));
				}
			}
			else
			{
				$result=$this->master_model->addData('tbl_earning_allowance',$data);
				if($result)
				{
					$this->json->jsonReturn(array(
						'valid'=>TRUE,
						'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Allowance Saved Successfully!</div>'
					));
				}
				else
				{
					$this->json->jsonReturn(array(
						'valid'=>FALSE,
						'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Saving Allowance !</div>'
					));
				}
			}
		}	

	public function deleteEarning_allowance()
		{
			$earning_id=$this->input->post('id');
			$tableName = 'tbl_earning_allowance';
			$uniqueField = 'earning_id';		
			$data=array('display'=>'N');

			$result=$this->master_model->updateDetails($tableName,$uniqueField,$earning_id,$data);
			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Earning Allowance Deleted Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting Earning Allowance Details !</div>'
				));
			}
		}

//deduction Allowance
	public function deductionAllowance()
	{	
		$tbl_name='tbl_deduction_allowance';
		$uniqueField='deduction_name';
		$whereId=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['deductionData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/deduction_allowance',$data);
	}
   		
	public function fetchDeduction_allowance()
	{
		$tbl_name='tbl_deduction_allowance';
		$uniqueField='deduction_name';
		$whereId=$this->session->userdata('comp_id');
		$data['deductionData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/deduction_allowance_table',$data);	
	}

	public function editDeduction_allowance()
	{
		$deduction_Id = $this->input->post('id');
		$tblName = 'tbl_deduction_allowance';
		$where = 'deduction_id';
		$data['singleDeduction'] = $this->master_model->selectDetailsWhr($tblName,$where,$deduction_Id);

		$tbl_name='tbl_deduction_allowance';
		$uniqueField='deduction_name';
		$whereId=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['deductionData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/deduction_allowance',$data);	
	}

	public function saveDeduction_allowance()
	{		
		if($this->session->userdata("comp_id")==1){

			$company_id = $this->input->post("comp_id");
		}else{
			$company_id = $this->session->userdata("comp_id");
		}
		$deduction_id=trim($this->input->post('id'));
		$deduction_name=trim($this->input->post('deduction_name'));
		$deduction_code=trim($this->input->post('deduction_code'));
		$deduction_unit=trim($this->input->post('deduction_unit'));
		$deduction_default_value=trim($this->input->post('deduction_default_value'));
		$data=array('deduction_name'=>$deduction_name,
					'company_id'=>$company_id,
					'deduction_code'=>$deduction_code,
					'deduction_unit'=>$deduction_unit,
					'deduction_default_value'=>$deduction_default_value
					);
		if(isset($deduction_id) && !empty($deduction_id) && ($deduction_id>0))
		{
			$tableName = 'tbl_deduction_allowance';
			$uniqueField = 'deduction_id';

			$result = $this->master_model->updateDetails($tableName, $uniqueField, $deduction_id, $data);

			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Deduction Updated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Deduction !</div>'
				));
			}
		}      
		else
		{
			$result=$this->master_model->addData('tbl_deduction_allowance',$data);
			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Allowance Saved Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Saving Allowance !</div>'
				));
			}
		}
	}

	public function deleteDeduction_allowance()
	{
		$deduction_id=$this->input->post('id');
		$tableName = 'tbl_deduction_allowance';
		$uniqueField = 'deduction_id';		
		$data=array('display'=>'N');

		$result=$this->master_model->updateDetails($tableName,$uniqueField,$deduction_id,$data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Deduction Allowance Deleted Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting Deduction Allowance Details !</div>'
			));
		}
	}

	public function fetch_by_employee_name()
	{
		$id= $this->input->post('id');
 		$tblname='tbl_employee_creation';
 		$where='emp_id';
 		$employeeData=$this->master_model->selectDetailsWhr($tblname,$where,$id);
 		$desig_id=$employeeData->desig_id;
 		$where1='desig_id';
 		$tblname1='tbl_designation';
 		$designation =$this->master_model->selectDetailsWhr($tblname1,$where1,$desig_id);
 		// print_r($data);
 		//$this->load->view('advance_view',$designation);
 		$prev_advance_data = $this->master_model->fetchPrevAdvanceData($id);
 		$prev_advance_date = $this->master_model->fetchPrevAdvanceDate($id);
 		$prev_amt = (isset($prev_advance_data->amount) && !empty($prev_advance_data->amount))?$prev_advance_data->amount:0;
 		$prev_date = (isset($prev_advance_date->advance_date) && !empty($prev_advance_date->advance_date))?$prev_advance_date->advance_date:'';
 		$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'desig_name'=>$desig_id,
					'prev_amt'=>$prev_amt,
					'prev_date'=>$prev_date
					
		));
 		
 	}

 	public function fetch_by_com_empName()
	{
 		$this->load->model('slip_aks_model');
 		$compId= $this->input->post('id');
		$empDetails = $this->slip_aks_model->fetchAllEmployeeByComy($compId);
		$cnt = '<option value="">Select</option>';
		if(isset($empDetails) && !empty($empDetails))
		{
			foreach ($empDetails as $key) 
			{
				$cnt = $cnt.'<option value="'.$key->emp_name.'">'.$key->emp_name.'</option>';
			}
		}		
		$this->json->jsonReturn($cnt);
 	}

 	public function fetch_by_com_empName1()
	{
 		$this->load->model('slip_aks_model');
 		$compId= $this->input->post('id');
		$empDetails = $this->slip_aks_model->fetchAllEmployeeByComy11($compId);
		$cnt = '<option value="">Select</option>';
		if(isset($empDetails) && !empty($empDetails))
		{
			foreach ($empDetails as $key) 
			{
				$cnt = $cnt.'<option value="'.$key->emp_id.'">'.$key->emp_name.'</option>';
			}
		}		
		$this->json->jsonReturn($cnt);
 	}

	//fetch admin data
	public function change_password()
	{
		$data['compDetails']=$this->master_model->SelectCompany();
		$this->load->view('/master/change_password',$data);
	}
	
}// end of controller

