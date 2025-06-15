<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /*
	Author :- Vaishali
	work :- Allowance Master(form earning allowance & deduction )

 */

class pay_slip extends CI_Controller {
	
	public function __construct()
     {
        parent::__construct();
        $this->load->model('master_model');
    }
    /*public function fetchReportData(){
		$this->load->model('Slip_vish_model'); //slip_emp_name slip_months  report_type comp_id
		$company_id=0;
		if ($this->session->userdata('role_id')==2) {
			$company_id = $this->session->userdata('comp_id');
		}else{
			$company_id = $this->input->post('comp_id');
		}
		$emp_id = $this->input->post('slip_emp_name');
		$month = $this->input->post('slip_months');
		$type = $this->input->post('report_type');
		$data =array();
		$data['companyId'] = $company_id;
		$data['type'] = $type;
		$data['emp_id'] = $eemp_id;
		if($type == "single_emp"){

		$data['reportData']=$this->Slip_vish_model->featchData($company_id,$emp_id,$month);	

		}else{
			$data['reportData']=$this->Slip_vish_model->featchData1($company_id,$month);
		}
			//print_r($data);	
		//$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);
		$this->load->view('report_table',$data);
	}*/

	public function reportExcel(){  

		$company_id = $this->uri->segment(2);
		$month = $this->uri->segment(3);
		
		$emp_id = $this->uri->segment(4);
		$this->load->model('Slip_vish_model');
		 $company_id=$this->session->userdata('comp_id'); 
        $compName =$this->Slip_vish_model->getCompDetails($company_id);
		$data =array();
		$totalAmount=0;
		if (isset($empId)&& !empty($empId)) { 
			/*$data['reportData']=$this->Slip_vish_model->featchData($company_id,$emp_id,$month);*/
			$reportData=$this->Slip_vish_model->featchData($company_id,$emp_id,$month,$emp_ac_type);
			$totalAmount=$this->Slip_vish_model->totalOfSingleEmp($company_id,$emp_id,$month,$emp_ac_type);
		}else{
			$reportData=$this->Slip_vish_model->featchData1($company_id,$month,$emp_ac_type);
			$totalAmount=$this->Slip_vish_model->totalOfAllEmp($company_id,$month,$emp_ac_type);
		}
		$this->load->library('excel_lib');				
		$this->excel_lib->salarySlipGenerateInExcelFormat($reportData,$totalAmount,$compName,$emp_ac_type);
		
	}


// allowance report

	public function AllowancereportExcel1(){  

		$company_id = $this->uri->segment(2);
		$month = $this->uri->segment(3);
		$emp_ac_type = $this->uri->segment(4);
		$emp_id = $this->uri->segment(5);
		$this->load->model('Slip_vish_model');
		 $company_id=$this->session->userdata('comp_id'); 
        $compName =$this->Slip_vish_model->getCompDetails($company_id);
		$data =array();
		$totalAmount=0;
		// if (isset($empId)&& !empty($empId)) {
		// 	/*$data['reportData']=$this->Slip_vish_model->featchData($company_id,$emp_id,$month);*/
		// 	$reportData=$this->Slip_vish_model->featchData($company_id,$emp_id,$month,$emp_ac_type);
		// 	$totalAmount=$this->Slip_vish_model->totalOfSingleEmp($company_id,$emp_id,$month,$emp_ac_type);
		// }else{
			$reportData=$this->Slip_vish_model->featchAllowanceData($company_id,$month,$emp_ac_type);
			$totalAmount=$this->Slip_vish_model->totalOfAllEmpAllowance($company_id,$month,$emp_ac_type);
		//}
		$this->load->library('excel_lib');				
		$this->excel_lib->salarySlipGenerateInExcelFormat1($reportData,$totalAmount,$compName,$emp_ac_type);
		
	}


// report data for basic salary report 

	// allowance report

	public function basicReportExcel1(){  

		$company_id = $this->uri->segment(2);
		$month = $this->uri->segment(3);
		/*$emp_ac_type = $this->uri->segment(4);*/
		$emp_id = $this->uri->segment(4);
		$this->load->model('Slip_vish_model');
		 $company_id=$this->session->userdata('comp_id'); 
        $compName =$this->Slip_vish_model->getCompDetails($company_id);
		$data =array();
		$totalAmount=0;
		// if (isset($empId)&& !empty($empId)) {
		// 	/*$data['reportData']=$this->Slip_vish_model->featchData($company_id,$emp_id,$month);*/
		// 	$reportData=$this->Slip_vish_model->featchData($company_id,$emp_id,$month,$emp_ac_type);
		// 	$totalAmount=$this->Slip_vish_model->totalOfSingleEmp($company_id,$emp_id,$month,$emp_ac_type);
		// }else{
			$reportData=$this->Slip_vish_model->featchBasicData1($company_id,$month);
			$totalAmount=$this->Slip_vish_model->totalOfAllEmpBasic($company_id,$month);
		//}
			//echo($totalAmount);
		$this->load->library('excel_lib');				
		$this->excel_lib->GenerateInExcelFormatBasicReport($reportData,$totalAmount,$compName);
		
	}

	//generate excel for without account holders  
	public function reportExcelWithAcc(){

		$company_id = $this->uri->segment(2);
		$month = $this->uri->segment(3);
		$emp_ac_type = $this->uri->segment(4);
		$emp_id = $this->uri->segment(5); 
		$this->load->model('Slip_vish_model');
		 $company_id=$this->session->userdata('comp_id'); 
        $compName =$this->Slip_vish_model->getCompDetails($company_id);
		$data =array();
		$totalAmount=0;
		// if (isset($empId)&& !empty($empId)) {
		// 	/*$data['reportData']=$this->Slip_vish_model->featchData($company_id,$emp_id,$month);*/
		// 	$reportData=$this->Slip_vish_model->featchDataWithAcc($company_id,$emp_id,$month,$emp_ac_type);
		// 	$totalAmount=$this->Slip_vish_model->totalOfSingleEmp($company_id,$emp_id,$month,$emp_ac_type);
		// }else{
			$reportData=$this->Slip_vish_model->featchDataWithAccNON($company_id,$month,$emp_ac_type);
			$totalAmount=$this->Slip_vish_model->totalOfAllEmpWithAccNON($company_id,$month,$emp_ac_type);
		// }
			//print_r($reportData);
		$this->load->library('excel_lib');				
		$this->excel_lib->salarySlipGenerateInExcelFormat1($reportData,$totalAmount,$compName,$emp_ac_type);
		
	}



	public function basicReportExcelWithAcc(){ 

		$company_id = $this->uri->segment(2);
		$month = $this->uri->segment(3);
		//$emp_ac_type = $this->uri->segment(4);
		$emp_id = $this->uri->segment(4);
		$this->load->model('Slip_vish_model');
		 $company_id=$this->session->userdata('comp_id'); 
        $compName =$this->Slip_vish_model->getCompDetails($company_id);
		$data =array();
		$totalAmount=0;
		// if (isset($empId)&& !empty($empId)) {
		// 	/*$data['reportData']=$this->Slip_vish_model->featchData($company_id,$emp_id,$month);*/
		// 	$reportData=$this->Slip_vish_model->featchDataWithAcc($company_id,$emp_id,$month,$emp_ac_type);
		// 	$totalAmount=$this->Slip_vish_model->totalOfSingleEmp($company_id,$emp_id,$month,$emp_ac_type);
		// }else{
			$reportData=$this->Slip_vish_model->featchBasicDataWithAcc($company_id,$month);
			$totalAmount=$this->Slip_vish_model->totalOfAllEmpWithAcc($company_id,$month);
		// }
		$this->load->library('excel_lib');				
		$this->excel_lib->GenerateInExcelFormatBasicReport($reportData,$totalAmount,$compName,$emp_ac_type);
		
	}

}