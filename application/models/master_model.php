<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
    Author :- Vishal 
    work :- all master creation , add , update , delete , company creation
*/
class Master_model extends CI_Model {

	function fetchAllStateNameByCountry($countryId,$comp_id)
	{
		

		$q = $this->db->query("SELECT state_id, state_name FROM tbl_state 
							   WHERE country_id=? AND company_id=? AND display='Y'",array($countryId,$comp_id));
		if($q->num_rows()>0)
		{
			foreach ($q->result() as $key) 
			{
				$data[]=$key;
			}
			return $data;
		}
		else
		{
			return false;
		}
	}

	function fetchAllCityNameByState($stateId,$comp_id)
	{
		$q = $this->db->query("SELECT city_id, city_name FROM tbl_city
							   WHERE state_id=? AND company_id=? AND display='Y' ORDER BY city_name",array($stateId,$comp_id));
		if($q->num_rows()>0)
		{
			foreach ($q->result() as $key) 
			{
				$data[]=$key;
			}
			return $data;
		}
		else
		{
			return false;
		}
	}

	public function fetchSingleCityData($cityId,$comp_id)
	{
		$qry = $this->db->query("SELECT tc.*, ts.country_id FROM `tbl_city` AS tc, tbl_state AS ts 
								 WHERE tc.state_id=ts.state_id AND tc.city_id=? AND tc.company_id=?", array($cityId,$comp_id));

		if($qry->num_rows()>0)
		{
			return $qry->row();
		}
		else
		{
			return false;
		}
	}

	public function addData($tablename,$data)
	{
		$query=$this->db->insert($tablename,$data);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}			
	}

	public function insertBatchSave($tablename, $data)
	{
		$insert = $this->db->insert_batch($tablename, $data); 		
		return $insert;	
	}


	public function insertBatchSaveTrans($tble_neme,$basic_pt_data,$earnig_data,$deduct_data)
	{
		$this->db->trans_start();
		if (isset($earnig_data) && !empty($earnig_data)) {		
			$this->db->insert_batch('tbl_basic_earning', $earnig_data);
		}/*else{
			echo "in else"; exit();
		}*/

		if (isset($deduct_data) && !empty($deduct_data)) {			
			$this->db->insert_batch('tbl_basic_deduction', $deduct_data);
		}

		$this->db->insert_batch($tble_neme, $basic_pt_data); 		
		$insert = $this->db->trans_complete();
		return $insert;	
	}


	public function updateBatch($tablename, $data,$earnig_data,$deduct_data,$emp_ids,$slip_month)
	{
		$this->db->trans_start();

		if (isset($emp_ids) && !empty($emp_ids)) {
			
			for ($i=0; $i < count($emp_ids) ; $i++) { 		
				$this->db->where('emp_id', $emp_ids[$i]);
				$this->db->where('salary_month',$slip_month);
		   		$this->db->delete('tbl_basic_earning');
	   		}
	   	}

	   	if (isset($emp_ids) && !empty($emp_ids)) {

	   		for ($j=0; $j < count($emp_ids) ; $j++) { 
	   			$this->db->where('emp_id', $emp_ids[$j]);
	   			$this->db->where('salary_month',$slip_month);
		   		$this->db->delete('tbl_basic_deduction');
	   		}
		}

		if (isset($earnig_data) && !empty($earnig_data)) {		
			$this->db->insert_batch('tbl_basic_earning', $earnig_data);
		}

		if (isset($deduct_data) && !empty($deduct_data)) {			
			$this->db->insert_batch('tbl_basic_deduction', $deduct_data);
		}

		$this->db->update_batch($tablename, $data, 'basic_pt_id');

		$result = $this->db->trans_complete();
		return $result;
	}

	

	public function addDetailsGetId($tblname,$data)
    {
        $query = $this->db->insert($tblname, $data);
        if($query)
        {
        	return $this->db->insert_id();
        }
        else
        {
        	return false;
        }        
    }

	public function selectDetails($tblname)
    {
        $query = $this->db->get($tblname);
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
        	return false;
        }
    }

    public function selectDetailsDisplay($tbl_name,$whereId)
    {
       	$this->db->where('display','Y');
       	$this->db->where('company_id',$whereId);
       	$query = $this->db->get($tbl_name);
       
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
        	return false;
        }
    }

    public function selectDetailsDisplayByASC($tblname, $asc_column_name,$comp_id)
    {
       	$this->db->select("*");
	    $this->db->from($tblname);
	    $this->db->where('display','Y');
	   	//$this->db->where('company_id',$comp_id);
		
	    $this->db->order_by($asc_column_name, "asc");
	    $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
        	return false;
        }
    }


    public function selectDetailsDisplayByASC1($tblname, $asc_column_name)
    {
       	$this->db->select("*");
	    $this->db->from($tblname);
	    $this->db->where('display','Y');
	    $this->db->order_by($asc_column_name, "asc");
	    $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
        	return false;
        }
    }


    /*

	$qry = $this->db->query("SELECT tc.city_id, tcn.country_name, ts.state_name, tc.city_name, tc.city_desc 
								 FROM tbl_country AS tcn, tbl_state AS ts, tbl_city AS tc 
								 WHERE tc.state_id=ts.state_id AND ts.country_id = tcn.country_id AND tc.company_id=? AND tc.display='Y'
								 ORDER BY tcn.country_name, ts.state_name, tc.city_name", array($comp_id));
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
    */


	public function selectDetailsWhr($tblname,$where,$condition)
	{
		$this->db->where($where,$condition);
		$query = $this->db->get($tblname);
		if($query->num_rows()== 1)
		{
			
			return $query->row();
		}
		else
		{
			return false;
		}			
	}

    public function selectDetailsWhradmin($id)
	{
		$qry = $this->db->query("SELECT emp_id,emp_name 
								 FROM tbl_company_master
								 WHERE company_id=? AND display='Y'", array($id));
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

	public function selectDetailsWhr1($tblName,$where,$countryId,$comp_id)
	{
		$this->db->where($where,$countryId);
		$this->db->where('company_id',$comp_id);
		$query = $this->db->get($tblName);
		if($query->num_rows()== 1)
		{
			
			return $query->row();
		}
		else
		{
			return false;
		}			
	}

	public function selectAllWhr($tblname,$where,$condition)
	{
		$this->db->where($where,$condition);
		$query = $this->db->get($tblname);
		if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
        	return false;
        }
	}

	public function selectAllmultiWhr($tblname,$where1,$condition1,$where2,$condition2)
	{
		$this->db->where($where1,$condition1);
		$this->db->where($where2,$condition2);
		$query = $this->db->get($tblname);
		if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
        	return false;
        }
	}

	public function updateDetails($tblname, $where, $condition, $data)
	{
		$this->db->where($where, $condition);
		$query = $this->db->update($tblname, $data); 
		if($query)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	} 

	public function updateDetailsWheWhr($tblname, $where1, $condition1, $where2, $condition2, $data)
	{
		$this->db->where($where1, $condition1);
		$this->db->where($where2, $condition2);
		$query = $this->db->update($tblname, $data); 
		if($query)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	} 

	public function deleteData($tblname,$where,$condition)
	{
		$this->db->where($where, $condition);
		$delete_query=$this->db->delete($tblname); 
		return $delete_query;
	} 

	/****************************** State Function ************************************/


	public function fetchStateRecord($comp_id)
	{
		$qry = $this->db->query("SELECT tc.country_id, ts.state_id, tc.country_name, ts.state_name, ts.state_desc 
								 FROM tbl_state AS ts, tbl_country AS tc 
								 WHERE tc.country_id=ts.country_id AND ts.company_id=? AND ts.display='Y' ORDER BY tc.country_name, ts.state_name", array($comp_id));
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

	/**************************** City Function *******************************************/


	public function fetchCityRecord($comp_id)
	{
		$qry = $this->db->query("SELECT tc.city_id, tcn.country_name, ts.state_name, tc.city_name, tc.city_desc 
								 FROM tbl_country AS tcn, tbl_state AS ts, tbl_city AS tc 
								 WHERE tc.state_id=ts.state_id AND ts.country_id = tcn.country_id AND tc.company_id=? AND tc.display='Y'
								 ORDER BY tcn.country_name, ts.state_name, tc.city_name", array($comp_id));
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

	function checkCurrentPassword($comp_id,$oldpass)
	{
		// echo $comp_id."<br/>";
		// echo $oldpass;
		
		 $query=$this->db->query("SELECT * FROM tbl_company_master WHERE company_id=? AND company_password=?",array($comp_id,$oldpass));

		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}

	}




	function fetchAdvanceData()
	{
	
		 $query=$this->db->query("SELECT ta.emp_id, tec.emp_name,IFNULL(bpt.advance_recovery,0) recovery_amt, SUM(ta.amount) AS amount, tad.recoveryPermonthAmt,tad.recovery_mode,tad.opening_amt, (SUM(ta.amount)-IFNULL(bpt.advance_recovery,0)) AS remaining_amount,tad.adv_id,tad.closing_amt,IFNULL(bpt.advance_recovery,0)
		FROM tbl_advance AS ta
		JOIN tbl_employee_creation AS tec ON tec.emp_id=ta.emp_id AND tec.display='Y'
		JOIN tbl_advance_details AS tad ON tad.emp_id=ta.emp_id AND tad.display='Y'
		LEFT JOIN (SELECT emp_id, SUM(advance_recovery) advance_recovery FROM `tbl_basic_pt` WHERE display='Y' AND STR_TO_DATE(salary_month, '%m-%Y') >'2022-06'  GROUP BY emp_id) AS bpt ON bpt.emp_id=ta.emp_id
		WHERE ta.display='Y' AND tad.opening_amt!=0
		GROUP BY ta.emp_id");

		if($query->num_rows()>0)
		{
			foreach ($query->result() as $key) 
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

	function fetchAdvanceDataByEmp($id)
	{
		// echo $comp_id."<br/>";
		// echo $oldpass;
		//$company_id = $this->session->userdata('comp_id');
		 $query=$this->db->query("SELECT ta.emp_id, tec.emp_name,bpt.advance_recovery recovery_amt, SUM(ta.amount) AS amount, tad.recoveryPermonthAmt,tad.recovery_mode,tad.opening_amt, (SUM(ta.amount)-bpt.advance_recovery) AS remaining_amount,tad.adv_id,tad.closing_amt,bpt.advance_recovery
		FROM tbl_advance AS ta
		JOIN tbl_employee_creation AS tec ON tec.emp_id=ta.emp_id AND tec.display='Y'
		JOIN tbl_advance_details AS tad ON tad.emp_id=ta.emp_id AND tad.display='Y'
		JOIN (SELECT emp_id, SUM(advance_recovery) advance_recovery FROM `tbl_basic_pt` WHERE display='Y' GROUP BY emp_id) AS bpt ON bpt.emp_id=ta.emp_id
		WHERE ta.display='Y' AND tad.opening_amt!=0
		GROUP BY ta.emp_id HAVING emp_id=".$id);

		if($query->num_rows()>0)
		{
			
			return $query->row(0);
		}
		else
		{
			return false;
		}
	}

	function fetchPrevAdvanceData($emp_id)
	{
		// echo $comp_id."<br/>";
		// echo $oldpass;
		//$company_id = $this->session->userdata('comp_id');
		 /*$query=$this->db->query("SELECT ta.emp_id, tec.emp_name,tad.recovery_amt, SUM(ta.amount) AS amount, tad.recoveryPermonthAmt,tad.recovery_mode,tad.opening_amt, (SUM(ta.amount)-tad.opening_amt) AS remaining_amount,tad.adv_id,tad.closing_amt
									FROM tbl_advance AS ta, tbl_employee_creation AS tec, tbl_advance_details AS tad
									WHERE tec.emp_id=ta.emp_id AND tad.emp_id=ta.emp_id AND ta.display='Y' AND tec.display='Y' AND tad.display='Y' AND ta.emp_id=? GROUP BY ta.emp_id",array($emp_id));*/
		$query = $this->db->query("SELECT SUM(ta.amount) - (SUM(ta.amount)-tad.opening_amt) AS amount	FROM tbl_advance AS ta, tbl_employee_creation AS tec, tbl_advance_details AS tad WHERE tec.emp_id=ta.emp_id AND tad.emp_id=ta.emp_id AND ta.display='Y' AND tec.display='Y' AND tad.display='Y' AND ta.emp_id=? GROUP BY ta.emp_id",array($emp_id));

		if($query->num_rows()== 1)
		{
			
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function fetchPrevAdvanceDate($emp_id)
	{
		$query = $this->db->query("SELECT ta.advance_date FROM tbl_advance AS ta, tbl_employee_creation AS tec, tbl_advance_details AS tad WHERE tec.emp_id=ta.emp_id AND tad.emp_id=ta.emp_id AND ta.display='Y' AND tec.display='Y' AND tad.display='Y' AND ta.emp_id=? AND ta.advance_id = (select MAX(advance_id) FROM tbl_advance WHERE display='Y' AND emp_id=? GROUP BY emp_id) GROUP BY ta.emp_id",array($emp_id,$emp_id));

		if($query->num_rows()== 1)
		{
			
			return $query->row();
		}
		else
		{
			return false;
		}
	}
	

	function SelectCompany()
	{
		$query=$this->db->query("SELECT company_id,company_name FROM tbl_company_master WHERE display='Y'");

		if($query->num_rows()>0)
		{
			foreach ($query->result() as $key) 
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

	public function payslip_report_data($data)
	{
		/*select year(str_to_date(`tbp`.`salary_month`,'%m-%Y')) AS `sal_year`,`tbp`.`basic_pt_id` AS `basic_pt_id`,`tbp`.`emp_id` AS `empl_id`,`tbp`.`emp_id` AS `emp_id`,`tbp`.`company_id` AS `company_id`,`tbp`.`basic_amt` AS `basic_amt`,`tbp`.`allowances` AS `allowances`,`tbp`.`special_allowance` AS `special_allowance`,`tbp`.`convey` AS `convey`,`tbp`.`hra` AS `hra`,`tbp`.`earn_arrears` AS `earn_arrears`,`tbp`.`mobile_deduction` AS `mobile_deduction`,`tbp`.`other_deduct` AS `other_deduct`,`tbp`.`pt_amt` AS `pt_amt`,`tbp`.`pf_earn` AS `pf_earn`,`tbp`.`pf_deduct` AS `pf_deduct`,`tbp`.`ESIC_earn` AS `ESIC_earn`,`tbp`.`ESIC_deduct` AS `ESIC_deduct`,`tbp`.`basic_net` AS `basic_net`,`tbp`.`sundays_in_month` AS `sundays_in_month`,`tbp`.`holidays_in_month` AS `holidays_in_month`,`tbp`.`advance_opening` AS `advance_opening`,`tbp`.`advance_Addition` AS `advance_Addition`,`tbp`.`advance_recovery` AS `advance_recovery`,`tbp`.`advance_closing_amt` AS `advance_closing_amt`,`tbp`.`work_day` AS `work_day`,`tbp`.`salary_month` AS `salary_month`,`tbp`.`net_pay` AS `net_pay`,`tbp`.`salaryslip` AS `salaryslip`,`tbp`.`display` AS `display`,`tec`.`employee_id` AS `employee_id`,`tec`.`emp_name` AS `emp_name`,`tcm`.`company_name` AS `company_name` from (((`db_erp_solution_live`.`tbl_basic_pt` `tbp` left join `db_erp_solution_live`.`tbl_employee_creation` `tec` on(((`tec`.`emp_id` = `tbp`.`emp_id`) and (`tec`.`display` = 'Y')))) left join `db_erp_solution_live`.`tbl_company_master` `tcm` on(((`tbp`.`company_id` = `tcm`.`company_id`) and (`tcm`.`display` = 'Y')))) left join `db_erp_solution_live`.`tbl_allowance_details` `tad` on(((`tbp`.`emp_id` = `tad`.`emp_id`) and (`tad`.`display` = 'Y')))) where ((`tbp`.`work_day` <> '0.0') and (`tbp`.`display` = 'Y')) order by `tec`.`company_id`*/
		extract($data);
        $this->db->trans_start();
        // SELECT tec.*,tbp.*, tbp.emp_id as empl_id,tad.*,tcm.* FROM tbl_basic_pt tbp 
        // join tbl_employee_creation As tec on tec.emp_id=tbp.emp_id 
        // left join tbl_company_master As tcm ON tbp.company_id=tcm.company_id 
        // left join tbl_allowance_details As tad on tbp.emp_id=tad.emp_id AND tbp.salary_month=tad.allowance_sal_date AND tbp.company_id=tad.company_id where tbp.work_day!='0.0' order by tec.company_id
        $this->db->select('*')->from('payslip_report_view');

        if(isset($comp_id) && !empty($comp_id) && $comp_id != 'All')
        {
            $this->db->where('company_id IN ('.$comp_id.')');
        }
        else
        {
        	$this->db->where('display', 'Y');
        }

        if(isset($emp_id) && !empty($emp_id) && $emp_id != 'All')
        {
            $this->db->where('emp_id IN ('.$emp_id.')');
        }
        else
        {
        	$this->db->where('display', 'Y');
        }

		/*if(isset($earning_id) && !empty($earning_id) && $earning_id != 'All')
        {
            $this->db->where('earning_id IN ('.$earning_id.')');
        }

        if(isset($deduction_id) && !empty($deduction_id) && $deduction_id != 'All')
        {
            $this->db->where_in('deduction_id IN ('.$deduction_id.')');
        }*/

        if(isset($slip_month) && !empty($slip_month))
        {
            $this->db->where('salary_month', $slip_month);
        }

        if(isset($slip_year) && !empty($slip_year))
        {
            $this->db->where('sal_year', $slip_year);
        }

        $query = $this->db->get();
        
        $this->db->trans_complete();
        
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
            return false;
        }
	}

	public function fetch_emp_advance_details()
	{
		$query = $this->db->query('SELECT distinct tec.emp_name,tec.emp_id FROM tbl_advance AS ta LEFT JOIN tbl_employee_creation AS tec ON tec.emp_id=ta.emp_id WHERE ta.display="Y" AND tec.display="Y"');

		if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
            return false;
        }
	}

	public function fetch_advance_details($emp_id)
	{
		$query = $this->db->query('SELECT tbp.advance_opening, tbp.advance_recovery,tbp.advance_closing_amt,tbp.salary_month,ta.amount,ta.advance_date,tad.recoveryPermonthAmt FROM tbl_basic_pt AS tbp LEFT JOIN tbl_advance AS ta ON ta.emp_id = tbp.emp_id LEFT JOIN tbl_advance_details AS tad ON tad.emp_id=tbp.emp_id WHERE tbp.display="Y" AND tbp.emp_id=? AND tbp.advance_opening !=0 ',array($emp_id));

		if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
            return false;
        }
	}
	public function getExpNewData()
	{
		$query = $this->db->query("SELECT tme.*,tec.emp_name as employee_name FROM `tbl_emp_monthly_expenses` as tme join tbl_employee_creation as tec on tec.emp_id=tme.emp_name where tec.display='Y' and tec.display='Y'");

		if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tbl_data[]=$row;
            }
            return $tbl_data;
        }
        else
        {
            return false;
        }
	}

    function fetchEmployee()
    {
        $q = $this->db->query("SELECT tec.* FROM tbl_employee_creation as tec, tbl_userinfo as tu WHERE tu.user_id=tec.user_id AND tu.display='Y' AND tu.account_status='activate' AND tec.display='Y' ");

        if($q->num_rows()>0)
        {
            foreach ($q->result() as $key)
            {
                $data[]=$key;
            }
            return $data;
        }
        else
        {
            return false;
        }
	}
}

