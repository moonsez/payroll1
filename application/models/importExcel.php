<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
    Author :- Vishal
    work :- all master creation , add , update , delete , company creation
*/
class importExcel extends CI_Model {

	public function insertData($data)
	{
		$query=$this->db->insert('tbl_excelData',$data);
		// if($query)
		// {
		// 	return true;
		// }
		// else
		// {
		// 	return false;
		// }	

	}

}