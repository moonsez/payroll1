<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /*
	Author :- Poonam
	work :- Word generation

 */
 
class Controller_pg extends CI_Controller {
	
	public function __construct()
     {
        parent::__construct();
        $this->load->model('master_model');
        $this->load->library('word');
    }

    public function word_OBC()
    {   
        $this->load->model('Slip_vish_model');
        $amount  = $this->uri->segment(2);
        $company_id=$this->session->userdata('comp_id'); 
        $compName =$this->Slip_vish_model->getCompDetails($company_id);
        $number= $amount;
        $amountInWord=$this->convert_num_to_words->convert_number_to_words($number);
    	  $this->word->word_OBC($amount,$amountInWord,$compName);
    }

    public function word_other_than_OBC()
    {
        $this->load->model('Slip_vish_model');
        $company_id=$this->session->userdata('comp_id'); 
        $amount = $this->uri->segment(2);
        $compName =$this->Slip_vish_model->getCompDetails($company_id);
        $number= $amount;
        $amountInWord=$this->convert_num_to_words->convert_number_to_words($number);
        $this->word->word_other_than_OBC($amount,$amountInWord,$compName);
    }
    
   	
}// end of controller

