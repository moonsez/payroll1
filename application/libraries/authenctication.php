<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authenctication
{

	function _construct() 
	{
	    $CI =& get_instance();     
		$CI->load->database('database');     
		$CI->load->library("session");
	} 
 
	function get_userdata() 
	{
	    $CI =& get_instance();     
		if( ! $this->logged_in())
		{        
			return false;
		}     
		else     
		{          
			$query = $CI->db->get_where("tbl_company_details", array("role_id" => $CI->session->userdata("role")));          
			return $query->row();     
		}
	 }
 
	function logged_in() 
	{     
		$CI =& get_instance();     
		return ($CI->session->userdata("role")) ? true : false; 
	}

	

	function chklogin($user_id) 
	{  
		$CI =& get_instance();  
		$CI->db->select('*')->from('tbl_userinfo u')->join('tbl_employee_personal_details e','e.user_id=u.user_id');
		$CI->db->where("md5(u.user_id)",$user_id)->where("u.account_status",'activate')->where("u.display",'Y');
		$query = $CI->db->get(); 
		if($query->num_rows() != 1) 
		{
			return false;
		}
		else     
		{
			$CI->session->set_userdata("userid",$query->row()->user_id);
			$CI->session->set_userdata("emailid",$query->row()->email);	
			$CI->session->set_userdata("firstname", $query->row()->firstname);
			$CI->session->set_userdata("middlename", $query->row()->middlename);
			$CI->session->set_userdata("lastname", $query->row()->lastname);		 
			$CI->session->set_userdata("user_name", $query->row()->username);
			$CI->session->set_userdata("image_name", $query->row()->image_name);
			$CI->session->set_userdata("gender", $query->row()->gender);
			$CI->session->set_userdata("sign", $query->row()->signature_file);
			$CI->session->set_userdata("comp_id",$query->row()->company_id);
			
			$CI->session->set_userdata("role",$query->row()->role_id); 
			$CI->session->set_userdata("ISlogin", true);  
			$CI->session->set_userdata("payslip_is_loged", TRUE); 
			$CI->session->sess_expire_on_close = TRUE;
			$value = base_url();
			setcookie("pay_slip",$value, time()+3600*24,'/');$state=FALSE;
			return true;  
		} 
	}

	function logout() 
	{	     
		$CI =& get_instance();
		$CI->session->unset_userdata("comp_id");
		$CI->session->unset_userdata("user_name");
		$CI->session->unset_userdata("role_id");
		$CI->session->unset_userdata("comp_name");		 
		$CI->session->unset_userdata("ISlogin");	

		$CI->session->unset_userdata("userid");
		$CI->session->unset_userdata("emailid");	
		$CI->session->unset_userdata("firstname");
		$CI->session->unset_userdata("middlename");
		$CI->session->unset_userdata("lastname");		 
		$CI->session->unset_userdata("user_name");
		$CI->session->unset_userdata("image_name");
		$CI->session->unset_userdata("gender");
		$CI->session->unset_userdata("sign");
		$CI->session->unset_userdata("comp_id");		
		$CI->session->unset_userdata("role"); 
		$CI->session->unset_userdata("payslip_is_loged");	
	}
}/*class end*/