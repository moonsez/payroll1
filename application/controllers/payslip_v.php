<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	Author :- Rahul Pimpalkar
	Work :- Generate pdf 
*/

class payslip_v extends CI_Controller {

	public function generate_pay_slip_PDF()

	{	
		$this->load->model('slip_aks_model');
		$this->load->model('Slip_vish_model');
		$this->load->model('master_model'); 
 		$empId = $this->uri->segment(2);
 		$empDetails=$this->master_model->selectDetailsWhr('tbl_employee_creation','emp_id',$empId);
		// $company_id = $empDetails->company_id;
		$userId = $empDetails->user_id;
		$pay_slip_month = $this->uri->segment(3);
		$oldCompData=$this->master_model->slip_aks_model->fetchMothWiseComp($userId, $pay_slip_month);
		$company_id=$oldCompData->company_id;
		$month_year = explode( '-', $pay_slip_month);
		$final_month_year = date("F", mktime(0, 0, 0, $month_year[0], 10)).' '.$month_year[1];
		
		$data['companyDetails']=$this->master_model->selectDetailsWhr('tbl_company_master','company_id',$company_id);
		$data['employee_basic_info'] = $this->slip_aks_model->fetchDataForExcelGenerate($empId,$pay_slip_month);
		$data['getNewCtc'] = $this->slip_aks_model->fetchNewCtc($company_id, $userId, $pay_slip_month);
		// echo $this->db->last_query(); exit();
		//$data['static_earn_data'] = $this->Slip_vish_model->fetchAllowDataOfEmp_basic_allow($empId,$pay_slip_month);
		$data['static_earn_data'] = $this->slip_aks_model->fetchDataForExcelEarnData($empId,$pay_slip_month);
		//echo $this->db->last_query(); exit();
		$data['static_deduct_data'] = $this->slip_aks_model->fetchDataForExcelDeductData($empId,$pay_slip_month);
		//print_r($data['static_deduct_data']); exit();
		$month = $month_year[0];
		$year = $month_year[1];
		$data['leave_data'] = $this->slip_aks_model->fetchLeaveData($empId,$month,$year);
		
		$data['logo_name']=$this->slip_aks_model->Getlogo($company_id);
		$dateTim = date('d-m-y');
 		$pdfname = $data['employee_basic_info']->emp_name.' Pay Slip for the Month of '.$final_month_year;
 		$mail_id = $data['employee_basic_info']->email_id;
 		$html=$this->load->view('salary_slip_pdf_view',$data,TRUE);
		$this->report_creation->Save_pdf($html,$pdfname);
	}	

	public function testingpdf(){

		//testhtml.php
		$pdfname = 'slipPdf';
		$html=$this->load->view('testhtml',$data,TRUE);
		$this->report_creation->create_pdf($html,$pdfname);
	}


	public function salarySlipGenerate()
	{		
		$this->load->model('Slip_vish_model');
		$company_id = $this->session->userdata('comp_id');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC1();		
		$data['empDetails']=$this->slip_aks_model->fetchAllEmployeeByCompany($company_id);

		$this->load->view('salary_slip',$data);
	}
		

}
