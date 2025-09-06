<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	Author :- Prabir
	Work :- login function.
*/

class Login_admin extends CI_Controller {

	
	public function index()
	{		
		if($this->authenctication->logged_in()==FALSE)
		{			
			$msg = 'slip_generation_login';
			$data['key_string'] = $this->encryption->encrypt($msg);
			$this->session->set_userdata("secret_key", $data['key_string']);
			$this->load->view('login',$data);
		}
		else
		{
			$this->load();
		}
	}

	public function __construct()
    {
        parent::__construct();
        $this->clear_cache(); 
        $this->load->model('master_model');            
    }
	
	function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    function load() 
	{		
		$msg = 'slip_generation_login';
		$data['key_string'] = $this->encryption->encrypt($msg);
		$this->session->set_userdata("secret_key", $data['key_string']);
		$state=$this->authenctication->logged_in();
		if($state==false)
		{
			redirect(BASEURL2,'user');
		}
		else if($state==true)
		{			
			$role=$this->session->userdata('roleid');
			$userId=$this->session->userdata('userid');	
			$value = base_url();
			setcookie("pay_slip",$value, time()+3600*24,'/');$state=FALSE;
			$this->load->view('main');								 		
		}
		else 
		{
			redirect('user');	
		}
	}

	function login()
	{
		$secretkey = $this->session->userdata('secret_key');
		$a=$this->input->post('key');
		$pass=$this->input->post('password');
		$login=$this->input->post('username');
		if (isset($a) && $a==$secretkey)
		{
			$valid = false;
			if (!isset($login) or strlen($login) == 0)
			{
				$error = 'Please enter your user name.';
			}
			elseif (!isset($pass) or strlen($pass) == 0)
			{
				$error = 'Please enter your password.';
			}
			else
			{
				$valid['state']=$this->authenctication->chklogin($login,$pass);
				if (!$valid['state'])
					$error = 'Wrong user/password, please try again.';
			}

			$ajax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

			if ($valid['state']==true)
			{				
    			if ($ajax)
				{					
					$data=array(
						'valid' => TRUE,
						'msg'=>"Please Wait, We Will Redirect You Soon...",
						'redirect' => base_url().'user'
					);
					$this->json->jsonReturn($data);					
				}
				else
				{					
					$this->logout();
					redirect('user');
				}					
			}
			else
			{
				if ($ajax)
				{
					$data=array(
						'valid' => FALSE,
						'msg' => $error
					);
					$this->json->jsonReturn($data);
				}
			}
		}
		else
		{
			//$this->load->view('red_page');
		}		
    }

    function payslip($user_id)
	{
		$this->load->library('authenctication');

		if(isset($user_id) && !empty($user_id))
		{
			$valid['state']=$this->authenctication->chklogin($user_id);
            if (!$valid['state'])
			{
				redirect(BASEURL2,'user');
			}else
			{
				redirect('user');
			} 
		}
		else
		{
			redirect(BASEURL2); 	
		}
	}
	
	function logout()	
	{
		
		if($this->authenctication->logged_in()==FALSE)
		{
			//redirect(BASEURL2);
			echo "<script language=\"javascript\">window.close();</script>";
		}
		else
		{			
			$this->authenctication->logout();	 
			//redirect(BASEURL2);
			echo "<script language=\"javascript\">window.close();</script>";
		}	
	}	

    public function dashboard()
	{		
		$state=$this->authenctication->logged_in();		
		if($state==false)
		{		 	
			redirect(BASEURL2,'user');
		}
		else if($state==true)
		{			
			$this->load->view('main');								 		
		}else{
			redirect(BASEURL2,'user');
		}
	}

	/******************** Generate Excel File *******************************/

	public function generate_pay_slip()
	{
		$path = './images/logo/officelogo.jpg';
		$this->load->library('excel');				
		$this->excel->salarySlipGenerateInExcelFormat($path);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */