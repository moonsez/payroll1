<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database_excel extends CI_Model {

	public function fetchColumnName($tableName)
	{
		$qry = $this->db->query("SHOW COLUMNS FROM $tableName");

		if($qry->num_rows()>0)
		{
			foreach ($qry->result() as $key) 
			{
				$data[] = $key;
			}
			return $data;
		}
		else
		{
			return false;
		}
	}
}