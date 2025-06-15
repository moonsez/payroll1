<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /*
	Author :- Vishal
	work :- Company creation form(save) , (save ,update , delete ,display dependencey) country , state , city

 */
class Master_controller extends CI_Controller {

	public function index()
	{		
		
	} 	

	public function __construct()
    {
        parent::__construct();
       $this->load->model('master_model'); 
       $this->load->model('Slip_vish_model');
    }
   

    function fetchAllStateByCountryData()
	{
		$countryId = $this->input->post('cid');
		$comp_id=$this->session->userdata('comp_id');
		
		//$this->load->model('master_model');
		$stateDetails = $this->master_model->fetchAllStateNameByCountry($countryId,$comp_id);
		$cnt = '<option value="">Select</option>';
		if(isset($stateDetails) && !empty($stateDetails))
		{
			foreach ($stateDetails as $key) 
			{
				$cnt = $cnt.'<option value="'.$key->state_id.'">'.$key->state_name.'</option>';
			}
		}		
		$this->json->jsonReturn($cnt);
	}

	function fetchAllCityByStateData()
	{	
		$comp_id=$this->session->userdata('comp_id');
		$stateId = $this->input->post('sid');
		$cityDetails = $this->master_model->fetchAllCityNameByState($stateId,$comp_id);
		$cnt = '<option value=""> Select</option>';
		if(isset($cityDetails) && !empty($cityDetails))
		{
			foreach ($cityDetails as $key) 
			{
				$cnt = $cnt.'<option value="'.$key->city_id.'">'.$key->city_name.'</option>';				
			}
		}
		$this->json->jsonReturn($cnt);
	}

	/*---------Country tab start-----------------*/
	public function country()
	{
		$tbl_name='tbl_country';
		$uniqueField='country_name';
		$whereId=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['countryData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/country',$data);
	}

	public function fetchCountry()
	{
		$tbl_name='tbl_country';
		$uniqueField='country_name';
		$whereId=$this->session->userdata('comp_id');
		$data['countryData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/country_table',$data);
	} 

	function editCountry()
	{
		$countryId = $this->input->post('id');
		$whereId=$this->session->userdata('comp_id');
		$tblName = 'tbl_country';
		$where = 'country_id';
		$comp_id=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['singleCountry'] = $this->master_model->selectDetailsWhr1($tblName,$where,$countryId,$comp_id);
		$data['countryData']=$this->master_model->selectDetailsDisplay($tblName,$whereId);
		$this->load->view('master/country',$data);
	}

	public function saveCountry()
	{		 
		
		$company_id = $this->session->userdata("comp_id");
		$country_id=trim($this->input->post('id'));
		$country_name=trim($this->input->post('country_name'));
		$country_desc=trim($this->input->post('country_desc'));
		$data=array('company_id'=>$company_id,'country_name'=>$country_name,'country_desc'=>$country_desc);
		if(isset($country_id) && !empty($country_id) && ($country_id>0))
		{
			$tableName = 'tbl_country';
			$uniqueField = 'country_id';

			$result = $this->master_model->updateDetails($tableName, $uniqueField, $country_id, $data);

			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Country Details Updated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating Country Details !</div>'
				));
			}
		}
		else
		{
			$result=$this->master_model->addData('tbl_country',$data);
			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Country Details Saved Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Saving Country Details !</div>'
				));
			}
		}
	}	

	public function deleteCountry()
	{
		$countryId=$this->input->post('id');
		$tableName = 'tbl_country';
		$uniqueField = 'country_id';		
		$data=array('display'=>'N');

		$result=$this->master_model->updateDetails($tableName,$uniqueField,$countryId,$data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> Country Details Deleted Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting Country Details !</div>'
			));
		}
	}
	/****************** End Country Function ************************/

	/****************** Start State Function ************************/

	public function state()
	{		
		$tbl_name='tbl_country';
		$uniqueField='country_name';
		$whereId=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['stateData']=$this->master_model->fetchStateRecord($whereId);
		$data['countryData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/state',$data); 
	}

	public function fetchState()
	{
		$comp_id=$this->session->userdata('comp_id');
		$data['stateData']=$this->master_model->fetchStateRecord($comp_id);
		$this->load->view('master/state_table',$data);
	}

	public function editState()
	{
		$countryId = $this->input->post('id');
		$comp_id=$this->session->userdata('comp_id');
		$tblName = 'tbl_state';
		$where = 'state_id';


		$tbl_name='tbl_country';
		$uniqueField='country_name';
		$whereId=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['singleState'] = $this->master_model->selectDetailsWhr1($tblName,$where,$countryId,$comp_id);
		$data['countryData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$data['stateData']=$this->master_model->fetchStateRecord($comp_id);
		$this->load->view('master/state',$data);
	}

	public function saveState()
	{		
		
		
				$company_id = $this->session->userdata("comp_id");
			

		$state_id=trim($this->input->post('id'));
		$country_id = trim($this->input->post('state_coun_name'));
		$state_name=trim($this->input->post('state_name'));
		$state_desc=trim($this->input->post('state_description'));
		$data=array('company_id'=>$company_id,'country_id'=>$country_id,'state_name'=>$state_name,'state_desc'=>$state_desc);
		if(isset($state_id) && !empty($state_id) && ($state_id>0))
		{
			$tableName = 'tbl_state';
			$uniqueField = 'state_id';

			$result = $this->master_model->updateDetails($tableName, $uniqueField, $state_id, $data);

			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> State Details Updated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating State Details !</div>'
				));
			}
		}
		else
		{
			$result=$this->master_model->addData('tbl_state',$data);
			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> State Details Saved Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Saving State Details !</div>'
				));
			}
		}
	}	

	public function deleteState()
	{
		$stateId=$this->input->post('id');
		$tableName = 'tbl_state';
		$uniqueField = 'state_id';		
		$data=array('display'=>'N');

		$result=$this->master_model->updateDetails($tableName,$uniqueField,$stateId,$data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> State Details Deleted Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting State Details !</div>'
			));
		}
	}

	/************************************** End State Function *****************************************************************/

	/*************************************** Start City Function ***************************************************************/

	public function city()
	{		
		$tbl_name='tbl_country';
		$uniqueField='country_name';
		$whereId=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();

		$data['cityData']=$this->master_model->fetchCityRecord($whereId);
		$data['countryData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/city',$data); 
	}

	public function fetchCity()
	{
		$comp_id = $this->session->userdata('comp_id');
		$data['cityData']=$this->master_model->fetchCityRecord($comp_id);
		$this->load->view('master/city_table',$data);
	}

	public function editCity()
	{
		$cityId = $this->input->post('id');
		$tblName = 'tbl_city';
		$where = 'city_id';

		$tbl_name='tbl_country';
		$uniqueField='country_name';
		$comp_id=$this->session->userdata('comp_id');

		$data['compDetails']=$this->master_model->SelectCompany();
		$data['singleCity'] = $this->master_model->fetchSingleCityData($cityId,$comp_id);
		$countryId = $data['singleCity']->country_id;
		$data['stateData'] = $this->master_model->fetchAllStateNameByCountry($countryId,$comp_id);
		$data['countryData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$comp_id);
		$data['cityData']=$this->master_model->fetchCityRecord($comp_id);
		$this->load->view('master/city',$data);
	}

	public function saveCity()
	{		
		
				$company_id = $this->session->userdata("comp_id");
			
		$city_id=trim($this->input->post('id'));
		$state_id = trim($this->input->post('city_state_name'));
		$city_name=trim($this->input->post('city_name'));
		$city_desc=trim($this->input->post('city_description'));
		$data=array('company_id'=>$company_id,'state_id'=>$state_id,'city_name'=>$city_name,'city_desc'=>$city_desc);
		if(isset($city_id) && !empty($city_id) && ($city_id>0))
		{
			$tableName = 'tbl_city';
			$uniqueField = 'city_id';

			$result = $this->master_model->updateDetails($tableName, $uniqueField, $city_id, $data);

			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> City Details Updated Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Updating City Details !</div>'
				));
			}
		}
		else
		{
			$result=$this->master_model->addData('tbl_city',$data);
			if($result)
			{
				$this->json->jsonReturn(array(
					'valid'=>TRUE,
					'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> City Details Saved Successfully!</div>'
				));
			}
			else
			{
				$this->json->jsonReturn(array(
					'valid'=>FALSE,
					'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Saving City Details !</div>'
				));
			}
		}
	}	

	public function deleteCity()
	{
		$stateId=$this->input->post('id');
		$tableName = 'tbl_city';
		$uniqueField = 'city_id';		
		$data=array('display'=>'N');

		$result=$this->master_model->updateDetails($tableName,$uniqueField,$stateId,$data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> City Details Deleted Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting State Details !</div>'
			));
		}
	}
	
/****************************** Company creation Functions ************************************/

	public function companyCreationForm()
	{			 
		$tbl_name='tbl_country';
		$uniqueField='country_name';
		$whereId=$this->session->userdata('comp_id');

		$data['countryData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC();
		$this->load->view('company_creation',$data);
			
	}

	public function fetchCompany()
	{
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC();
		$this->load->view('company_creation_table',$data);
	}

	function editCompany()
	{
		$companyId = $this->input->post('id');
		$whereId=$this->session->userdata('comp_id');
		$tblName = 'tbl_company_master';
		$where = 'company_id';
		$data['singleCompany'] = $this->master_model->selectDetailsWhr($tblName,$where,$companyId);
		$data['countryData']=$this->master_model->selectDetailsDisplayByASC1('tbl_country','country_name');
		$countryId = $data['singleCompany']->country_id;
		$data['stateData'] = $this->master_model->fetchAllStateNameByCountry($countryId,$whereId);
		$stateId = $data['singleCompany']->state_id;
		$data['cityData'] = $this->master_model->fetchAllCityNameByState($stateId,$whereId);		
		//$data['cityData']=$this->master_model->selectDetailsDisplayByASC('tbl_city','city_name');
		$data['companyData']=$this->Slip_vish_model->selectDisplayCompanyByASC();
		$this->load->view('company_creation',$data);
	}

	public function deleteCompany()
	{
		$stateId=$this->input->post('id');
		$tableName = 'tbl_company_master';
		$uniqueField = 'company_id';		
		$data=array('display'=>'N');

		$result=$this->master_model->updateDetails($tableName,$uniqueField,$stateId,$data);
		if($result)
		{
			$this->json->jsonReturn(array(
				'valid'=>TRUE,
				'msg'=>'<div class="alert modify alert-success"><strong>Well Done!</strong> State Details Deleted Successfully!</div>'
			));
		}
		else
		{
			$this->json->jsonReturn(array(
				'valid'=>FALSE,
				'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> While Deleting State Details !</div>'
			));
		}
	}
	//company Creation 
	
	public function saveCompanyDetails()
	{
		$compLogoImg='';		
		$company_id = trim($this->input->post('id'));
		$company_name=trim($this->input->post('company_name'));		 
		$company_add=trim($this->input->post('company_address'));
		$company_country=trim($this->input->post('company_country'));
		$company_state=trim($this->input->post('company_state'));
		$company_city=trim($this->input->post('company_city'));
		$company_pincode=trim($this->input->post('company_pincode'));

		$company_login=trim($this->input->post('company_login'));
		$company_pass=trim($this->input->post('company_password'));
		$final_comp_pass = md5(sha1(md5($company_pass)));
		 
		$compImg = array('upload_path' =>'./images/logo/',
					   'fieldname' => 'company_logo',
					   'encrypt_name' => TRUE,			   
					   'overwrite' => FALSE 
					  );

		$comp_logo = $this->imageupload->image_upload($compImg);

		if(isset($comp_logo) && !empty($comp_logo))
		{
			$compData = $this->upload->data();	
			$compLogoImg = $compData['file_name'];
		}

		$data  = array( 'company_name' =>$company_name ,
					    'company_logo' =>$compLogoImg , 
						'company_add' =>$company_add ,
						'country_id' =>$company_country ,
						'state_id' =>$company_state,
						'city_id' =>$company_city,
						'company_pincode' =>$company_pincode,
						'company_login' =>$company_login,
						'company_password' =>$final_comp_pass,
						'role_id' => 2 );

		$tableName = 'tbl_company_master';

		if(isset($company_id) && !empty($company_id) && ($company_id>0))
		{
			$uniqueField = 'company_id';

			$result = $this->master_model->updateDetails($tableName, $uniqueField, $company_id, $data);

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
			$company_details_result =$this->master_model->addData($tableName,$data);

			if($company_details_result)
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
	 


/****************************** Designation master Functions ************************************/
	public function designationForm()
	{
		$tbl_name='tbl_country';
		$uniqueField='country_name';
		$whereId=$this->session->userdata('comp_id');
		$data['compDetails']=$this->master_model->SelectCompany();
		$data['designationData']=$this->master_model->selectDetailsDisplayByASC($tbl_name,$uniqueField,$whereId);
		$this->load->view('master/designation_form',$data);
	}


	/****************************** Update user Authontication Functions ************************************/
	public function changePassword()
	{	
		
		$tblName="tbl_company_master";
		$uniqueField = 'company_id';
		$oldpass= $this->input->post('oldPassword');
		$newpass=$this->input->post('new_password');
		if($this->session->userdata("role_id")==1){
			$company_id = $this->input->post("comp_id");
		}else{
			$company_id = $this->session->userdata("comp_id");
		}

		
		$comp_id = $this->session->userdata("comp_id");
			

		$where="company_id";	
		$encheck = md5(sha1(md5($oldpass)));
		//echo $encheck; 	
		$newpwd = md5(sha1(md5($newpass)));
		$data= array('company_password'=>$newpwd);

		$rest=$this->master_model->checkCurrentPassword($comp_id,$encheck);		

			if($rest)
			{
				$result = $this->master_model->updateDetails($tblName,$where,$company_id,$data);
					
				
				if($result == TRUE)
				{
					$this->json->jsonReturn(array(
						'valid'=>TRUE,
						'msg'=>'<div class="alert modify alert-success"><strong>Well done!</strong> Company Password Change Successfully !</div>'
					));
				}
				else
				{
					$this->json->jsonReturn(array(
						'valid'=>FALSE,
						'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> Try To Change Again .</div>'
					));	
				}	

			}
			else
			{

				$this->json->jsonReturn(array(
						'valid'=>FALSE,
						'msg'=>'<div class="alert modify alert-error"><strong>Error!</strong> Incorrect Current Password .</div>'
					));	
			}

		

	}
}// end controller

