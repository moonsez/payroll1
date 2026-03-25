<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slip_vish_model extends CI_Model {

    public function selectDisplayCompanyByASC()
    {       
        $this->db->select("tcod.*, tcd.country_name, tsd.state_name, tcid.city_name");
        $this->db->from("`tbl_company_master` AS tcod, `tbl_country` As tcd, `tbl_state` As tsd , `tbl_city` As tcid");
        $this->db->where("tcod.country_id = tcd.country_id AND tcod.state_id = tsd.state_id AND tcod.city_id=tcid.city_id AND tcod.display='Y'");
        $this->db->order_by('tcod.company_name', 'asc');
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

    public function selectDisplayCompanyByASC1()
    {
        $this->db->select("company_id,company_name");
        $this->db->from("tbl_company_master");
        $this->db->where('display','Y');
        // $this->db->order_by('tcod.company_name', 'asc');
        $query = $this->db->get();
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

    // query for basic report 
    public function featchBasicData($companyId,$month)
    {
        $query = $this->db->query("SELECT tbp.* , tec.emp_name,tec.bank_acc_no,tec.bank_name, tec.bank_ifc_code,tec.bank_branch FROM `tbl_basic_pt` As tbp , `tbl_employee_creation` AS tec WHERE tbp.display='Y' AND tbp.company_id=? AND tbp.salary_month=? AND tbp.company_id=tec.company_id AND tbp.emp_id=tec.emp_id AND tbp.net_pay > 0",array($companyId,$month));
        // old query for by account type report
        //$query = $this->db->query("SELECT tbp.* , tec.emp_name,tec.bank_acc_no,tec.bank_name, tec.bank_ifc_code,tec.bank_branch FROM `tbl_basic_pt` As tbp , `tbl_employee_creation` AS tec WHERE tbp.display='Y' AND tbp.company_id=? AND tbp.salary_month=? AND tec.emp_ac_type=? AND tbp.company_id=tec.company_id AND tbp.emp_id=tec.emp_id AND tbp.net_pay > 0",array($companyId,$month,$emp_ac_type));    
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

    //query for fetch allowance data
    public function featchAllowanceData($companyId,$month,$emp_ac_type)
    {
        $query = $this->db->query("SELECT tad.* , tec.emp_name,tec.bank_acc_no,tec.bank_name, tec.bank_ifc_code,tec.bank_branch FROM `tbl_allowance_details` As tad , `tbl_employee_creation` AS tec WHERE tad.display='Y' AND tad.company_id=? AND tad.allowance_sal_date=? AND tec.emp_ac_type=? AND tad.company_id=tec.company_id AND tad.emp_id=tec.emp_id AND tad.net_allowance_amt > 0",array($companyId,$month,$emp_ac_type));    
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

    // query for fetch advance details for salary

    public function featchAdvanceData($companyId)
    {
        $query=$this->db->query("SELECT tad.company_id,ta.emp_id, tec.emp_name,IFNULL(bpt.advance_recovery,0) recovery_amt, SUM(ta.amount) AS amount, tad.recoveryPermonthAmt,tad.recovery_mode,tad.opening_amt, (SUM(ta.amount)-IFNULL(bpt.advance_recovery,0)) AS remaining_amount,tad.adv_id,tad.closing_amt,IFNULL(bpt.advance_recovery,0)
        FROM tbl_advance AS ta
        JOIN tbl_employee_creation AS tec ON tec.emp_id=ta.emp_id AND tec.display='Y'
        JOIN tbl_advance_details AS tad ON tad.emp_id=ta.emp_id AND tad.display='Y'
        LEFT JOIN (SELECT emp_id, SUM(advance_recovery) advance_recovery FROM `tbl_basic_pt` WHERE display='Y' AND STR_TO_DATE(salary_month, '%m-%Y') >'2022-06' GROUP BY emp_id) AS bpt ON bpt.emp_id=ta.emp_id
        WHERE ta.display='Y' AND tad.opening_amt!=0
        GROUP BY ta.emp_id HAVING company_id=".$companyId);


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
    
    //without acc salary
    public function featchBasicDataWithAcc($companyId,$month)
    {
        $query = $this->db->query("SELECT tbp.* ,tec.* FROM tbl_basic_pt As tbp ,tbl_employee_creation As tec  WHERE tec.display='Y' AND tbp.company_id=tec.company_id AND tbp.company_id=? AND tbp.salary_month= ? AND tbp.emp_id=tec.emp_id AND tec.bank_acc_no=''   ORDER BY emp_name",array($companyId,$month));
        
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

    //fetch data for basic report excel sheet
    public function featchBasicData1($companyId,$month)
    {       
        $query = $this->db->query("SELECT tbp.* , tec.emp_name,tec.bank_acc_no,tec.bank_name, tec.bank_ifc_code,tec.bank_branch FROM `tbl_basic_pt` As tbp , `tbl_employee_creation` AS tec WHERE tbp.display='Y' AND tbp.company_id=? AND tbp.salary_month=? AND tbp.company_id=tec.company_id AND tbp.emp_id=tec.emp_id AND tbp.net_pay > 0 ",array($companyId,$month));
        //old query
        //$query = $this->db->query("SELECT tbp.* , tec.emp_name,tec.bank_acc_no,tec.bank_name, tec.bank_ifc_code,tec.bank_branch FROM `tbl_basic_pt` As tbp , `tbl_employee_creation` AS tec WHERE tbp.display='Y' AND tbp.company_id=? AND tbp.salary_month=? AND tec.emp_ac_type=? AND tbp.company_id=tec.company_id AND tbp.emp_id=tec.emp_id AND tbp.net_pay > 0 AND tec.bank_acc_no <>''",array($companyId,$month,$emp_ac_type));
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

    /*public function featchBasicData1($companyId,$month,$emp_ac_type)
    {
        $query = $this->db->query("SELECT tbp.* , tec.emp_name,tec.bank_acc_no,tec.bank_name, tec.bank_ifc_code,tec.bank_branch FROM `tbl_basic_pt` As tbp , `tbl_employee_creation` AS tec WHERE tbp.display='Y' AND tbp.company_id=? AND tbp.salary_month=? AND tec.emp_ac_type='OTOBC' AND tbp.company_id=tec.company_id AND tbp.emp_id=tec.emp_id ",array($companyId,$month));
        
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
    }*/

    //query for report generation 
    public function featchData($companyId,$emp_id,$month)
    {       
        $query = $this->db->query("SELECT * FROM `tbl_emp_slip_static_data` WHERE display='Y' AND `company_id`=? AND `emp_id`=? AND `pay_slip_month`=?  ORDER BY emp_name",array($companyId,$emp_id,$month));
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

    //SELECT sum(net_pay) as totalSalary FROM `tbl_emp_slip_static_data` WHERE display='Y' AND `company_id`=29 AND `pay_slip_month`= '08-2014' AND emp_ac_type='OBC' ORDER BY emp_name
    public function featchData1($companyId,$month)
    {
        $query = $this->db->query("SELECT * FROM `tbl_emp_slip_static_data` WHERE display='Y' AND `company_id`=? AND `pay_slip_month`= ?  ORDER BY emp_name",array($companyId,$month));
        //old query for fetch by account type
        //$query = $this->db->query("SELECT * FROM `tbl_emp_slip_static_data` WHERE display='Y' AND `company_id`=? AND `pay_slip_month`= ? AND emp_ac_type=? AND `emp_acc_no`<>''  ORDER BY emp_name",array($companyId,$month,$emp_ac_type));
        
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

    //fetch data of employee slip without account number
    public function featchDataWithAcc($companyId,$month,$emp_ac_type)
    {        
        $query = $this->db->query("SELECT * FROM `tbl_emp_slip_static_data` WHERE display='Y' AND `company_id`=? AND `pay_slip_month`= ? AND emp_ac_type=? AND `emp_acc_no`=''  ORDER BY emp_name",array($companyId,$month,$emp_ac_type));
        
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

    public function fetchAllByComp($tblname,$where,$condition)
    {
        $this->db->where($where,$condition);
        $this->db->where('display','Y');
        $this->db->order_by($where, "desc");
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

    public function featchDataWithAccNON($companyId,$month,$emp_ac_type)
    {
        $query = $this->db->query("SELECT tad.* , tec.emp_name,tec.bank_acc_no,tec.bank_name, tec.bank_ifc_code,tec.bank_branch FROM `tbl_allowance_details` As tad , `tbl_employee_creation`AS tec WHERE tad.display='Y' AND tad.company_id=? AND tad.allowance_sal_date=? AND tec.emp_ac_type=? AND tad.company_id=tec.company_id AND tad.emp_id=tec.emp_id AND tad.net_allowance_amt > 0  AND tec.bank_acc_no =''",array($companyId,$month,$emp_ac_type));
        
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

    //total for all emp without account number

    public function totalOfAllEmpWithAcc($companyId,$month)
    {
        $query = $this->db->query("SELECT sum(tbp.net_pay) as with_totalSalary FROM tbl_basic_pt As tbp ,tbl_employee_creation As tec  WHERE tec.display='Y' AND tbp.company_id=tec.company_id AND tbp.company_id=? AND tbp.salary_month=? AND tbp.emp_id=tec.emp_id AND tec.bank_acc_no='' ORDER BY emp_name",array($companyId,$month));
        
        if($query->num_rows()>0)
        {          
            return $query->row()->with_totalSalary;
        }
        else
        {
            return false;
        }
    }

    // query for total amount of salary for month 

    public function totalOfAllEmpAllowance($companyId,$month,$emp_ac_type)
    {
        $query = $this->db->query("SELECT SUM(tad.net_allowance_amt) AS totalSalary FROM tbl_allowance_details As tad, tbl_employee_creation AS tec WHERE tad.emp_id=tec.emp_id AND tec.emp_ac_type=? AND tad.company_id=? AND tad.allowance_sal_date=? AND tad.display='Y' AND tec.bank_acc_no <>''",array($emp_ac_type,$companyId,$month));
        
        if($query->num_rows()>0)
        {          
            return $query->row()->totalSalary;
        }
        else
        {
            return false;
        }
    }

    public function totalOfAllEmpBasic($companyId,$month)
    {   
        $query = $this->db->query("SELECT SUM(tbp.net_pay) AS totalSalary FROM tbl_basic_pt As tbp, tbl_employee_creation AS tec WHERE tbp.emp_id=tec.emp_id AND tbp.company_id=? AND tbp.salary_month=? AND tbp.display='Y'",array($companyId,$month));
        //$query = $this->db->query("SELECT SUM(tbp.net_pay) AS totalSalary FROM tbl_basic_pt As tbp, tbl_employee_creation AS tec WHERE tbp.emp_id=tec.emp_id AND tec.emp_ac_type=? AND tbp.company_id=? AND tbp.salary_month=? AND tbp.display='Y' AND tec.bank_acc_no <>'' ",array($emp_ac_type,$companyId,$month));
        if($query->num_rows()>0)
        {          
            return $query->row()->totalSalary;
        }
        else
        {
            return false;
        }
    }
    
    //query for get total salary amount of perticular month
    public function totalOfAllEmp($companyId,$month,$emp_ac_type)
    {
        $query = $this->db->query("SELECT sum(net_pay) as totalSalary FROM `tbl_emp_slip_static_data` WHERE display='Y' AND `company_id`=? AND `pay_slip_month`= ? AND emp_ac_type=? AND `emp_acc_no`<>''  ORDER BY emp_name",array($companyId,$month,$emp_ac_type));
        
        if($query->num_rows()>0)
        {          
            return $query->row()->totalSalary;
        }
        else
        {
            return false;
        }
    }

    public function totalOfSingleEmp($companyId,$emp_id,$month,$emp_ac_type)
    {   
        $query = $this->db->query("SELECT sum(net_pay) as totalSalary FROM `tbl_emp_slip_static_data` WHERE display='Y' AND `company_id`=? AND `emp_id`=? AND `pay_slip_month`=? AND emp_ac_type=? AND `emp_acc_no`<>'' ORDER BY emp_name",array($companyId,$emp_id,$month,$emp_ac_type));

        if($query->num_rows()>0)
          {          
              return $query->row()->totalSalary;
          }
        else
        {
            return false;
        }
    }

    //fetch company details for cover letter
    public function totalOfAllEmpWithAccNON($companyId,$month,$emp_ac_type)
    {    
        $query = $this->db->query("SELECT sum(tad.net_allowance_amt) as with_totalSalary FROM `tbl_allowance_details` As tad , `tbl_employee_creation` AS tec WHERE tad.display='Y' AND tad.company_id=? AND tad.allowance_sal_date=? AND tec.emp_ac_type=? AND tad.company_id=tec.company_id AND tad.emp_id=tec.emp_id AND tad.net_allowance_amt > 0  AND tec.bank_acc_no =''",array($companyId,$month,$emp_ac_type));
        
        if($query->num_rows()>0)
        {          
            return $query->row()->with_totalSalary;
        }
        else
        {
            return false;
        }
    }

    public function getCompDetails($company_id)
    {
        $query = $this->db->query("SELECT `company_name`  FROM `tbl_company_master` WHERE display='Y' AND `company_id`=? ",array($company_id));

        if($query->num_rows()>0)
          {          
              return $query->row()->company_name;
          }
        else
        {
            return false;
        }
    }

    public function getCompDetailsReport($company_id)
    {
        $query = $this->db->query("SELECT `company_name` FROM `tbl_company_master` WHERE display='Y' AND company_id IN (".$company_id.")");
        
        if($query->num_rows()>0)
          {          
              return $query->row()->company_name;
          }
        else
        {
            return false;
        }    
    }

    // fetch basic salary data with pt
    /* old query
        SELECT tec.emp_id ,tec.emp_name,tec.employee_id,tec.emp_basic,teda.deduct_value, cast(tec.emp_basic-teda.deduct_value as signed) As totalSal  
                                    FROM `tbl_employee_creation` AS tec,`tbl_emp_deduct_allowance` AS teda
                                    WHERE  tec.company_id=? AND tec.emp_id=teda.emp_id AND teda.deduction_id='4' AND tec.display='Y'
    */

    public function checkSalaryExist($slipMonth,$company_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_basic_pt WHERE display='Y' AND salary_month = ? AND company_id=?", array($slipMonth,$company_id));
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
   
    public function getExistData($slipMonth,$company_id)
    {
        $query = $this->db->query("SELECT tbp.*,tec.emp_name,tu.username employee_id,tec.user_id,tbp.pt_amt as deduct_value, tec.var_per basic_var FROM tbl_basic_pt as tbp,tbl_employee_creation tec,tbl_userinfo AS tu WHERE tbp.emp_id=tec.emp_id AND tec.user_id = tu.user_id AND tbp.salary_month = ? AND tu.account_status='activate' AND tbp.company_id=? ORDER BY tec.emp_name ASC", array($slipMonth,$company_id));
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
    
    public function getBasicSalary($company_id, $slipMonth)
    {
        $query = $this->db->query("SELECT tec.emp_id,tec.user_id,tec.emp_name,tu.username employee_id,tec.emp_basic as basic_amt,teda.deduct_value, cast(tec.emp_basic-teda.deduct_value as signed) As totalSal, (SELECT SUM(earn_value) FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id!=6 AND earning_id!=16 AND earning_id!=18 AND earning_id!=19 AND earning_id!=21) As allowances,
        (SELECT earn_value FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id=3) as convey,
        (SELECT convey_allowance_type FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id=3) as convey_allowance_type,
        (SELECT earn_value FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id=7) as hra,
        (SELECT earn_value FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id=18) as special_allowance,
        (SELECT earn_value FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id=19) as pf_earn,
        (SELECT earn_value FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id=21) as ESIC_earn,
        (SELECT earn_value FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id=15) as bouns_earn,
        (SELECT deduct_value FROM `tbl_emp_deduct_allowance` WHERE emp_id=tec.emp_id AND deduction_id=7) as pf_deduct,
        (SELECT deduct_value FROM `tbl_emp_deduct_allowance` WHERE emp_id=tec.emp_id AND deduction_id=8) as ESIC_deduct, 
        (SELECT deduct_value FROM `tbl_emp_deduct_allowance` WHERE emp_id=tec.emp_id AND deduction_id=10) as tds_deduct,
        (SELECT deduct_value FROM `tbl_emp_deduct_allowance` WHERE emp_id=tec.emp_id AND deduction_id=11) as insurance_deduct,
         tec.var_per, memo.memo_cnt, memo.memo_amt, lp.late_punchin, lp.late_punchin_halfdays, lp.early_punchout,lp.no_punchout_cnt, lp.no_min_4hr_work_cnt, lp.no_min_8hr_work_cnt, lp.wfh_cnt, lp.wfh_dates

            FROM tbl_employee_creation AS tec
            JOIN  tbl_emp_deduct_allowance AS teda ON  tec.emp_id=teda.emp_id AND teda.deduction_id='4'
            JOIN tbl_userinfo AS tu ON tu.user_id = tec.user_id AND tec.display='Y'
            LEFT JOIN  (SELECT count(*) memo_cnt, SUM(penality) memo_amt, user_id  FROM tbl_memo_details WHERE DATE_FORMAT(ifrac_date, '%m-%Y') =? AND display='Y' GROUP BY user_id) AS memo ON  memo.user_id=tu.user_id  
            LEFT JOIN ( SELECT 
                p.user_id,
                s.shift_start_time,
                s.shift_end_time,
                COUNT(
                    CASE 
                        WHEN p.day_status!='LD' AND l.user_id IS NULL AND TIMEDIFF(p.punchout_time, p.punchin_time) > '04:00:00' AND p.punchin_time > '11:00:00' AND p.punchin_time < '14:00:00' THEN 1
                    END
                ) AS late_punchin,
                COUNT(
                    CASE 
                        WHEN DAYOFWEEK(p.punch_date) = 7 AND p.day_status!='LD' AND l.user_id IS NULL AND (p.punchin_time BETWEEN ADDTIME(s.shift_start_time, '00:59:30') AND ADDTIME(s.shift_start_time, '03:30:00') OR p.punchout_time BETWEEN ADDTIME(s.shift_end_time, '-06:30:00') AND ADDTIME(s.shift_end_time, '-02:00:30')) THEN 1
                        WHEN DAYOFWEEK(p.punch_date) != 7 AND day_status!='LD' AND l.user_id IS NULL AND (p.punchin_time BETWEEN ADDTIME(s.shift_start_time, '00:59:30') AND ADDTIME(s.shift_start_time, '03:29:50') OR p.punchout_time BETWEEN ADDTIME(s.shift_end_time, '-06:30:00') AND ADDTIME(s.shift_end_time, '-01:00:30')) THEN 1
                    END
                ) AS late_punchin_halfdays,

                COUNT(
                    CASE 
                        WHEN DAYOFWEEK(p.punch_date) = 7 AND p.day_status!='LD' AND l.user_id IS NULL
                             AND p.punchout_time BETWEEN SUBTIME(ADDTIME(p.punchin_time, '08:00:00'), '02:00:00')AND SUBTIME(ADDTIME(p.punchin_time, '08:00:00'), '01:01:30') THEN 1
                        WHEN DAYOFWEEK(p.punch_date) != 7 AND p.day_status!='LD' AND l.user_id IS NULL
                             AND p.punchout_time BETWEEN SUBTIME(ADDTIME(p.punchin_time, '09:00:00'), '01:00:00') AND SUBTIME(ADDTIME(p.punchin_time, '09:00:00'), '00:01:30') THEN 1
                    END
                ) AS early_punchout,
                COUNT(
                    CASE
                        WHEN  p.punchin_time IS NOT NULL AND p.punchin_time!='00:00:00' AND p.day_status!='LD' AND l.user_id IS NULL AND (p.punchout_time IS NULL OR p.punchout_time ='00:00:00') THEN 1
                    END
                ) AS no_punchout_cnt,

                COUNT(
                        CASE 
                            WHEN
                                p.punchin_time IS NOT NULL AND p.punchin_time!='00:00:00' AND
                                p.punchout_time IS NOT NULL AND p.punchout_time!='00:00:00' AND
                                TIMEDIFF(p.punchout_time, p.punchin_time) < '04:00:00' 
                                AND p.day_status!='LD'
                                AND l.user_id IS NULL
                                AND p.punchout_time IS NOT NULL 
                                AND p.punchin_time IS NOT NULL THEN 1
                        END
                    ) AS no_min_4hr_work_cnt,

                COUNT(
                        CASE 
                            WHEN (TIMEDIFF(p.punchout_time, p.punchin_time) > '04:00:00' 
                                                            AND TIMEDIFF(p.punchout_time, p.punchin_time) < IF(DAYOFWEEK(p.punch_date) = 7, '07:00:00', '08:00:00')

                                                            AND p.punchin_time < '11:00:00'

                                                            AND p.day_status!='LD'
                                                            AND l.user_id IS NULL
                                                            AND p.punchout_time IS NOT NULL 
                                                            AND p.punchin_time IS NOT NULL) OR l.user_id IS NOT NULL THEN 1
                        END
                    ) AS no_min_8hr_work_cnt,
                COUNT(
                    CASE 
                        WHEN p.punch_from ='WFH' THEN 1
                    END
                ) AS wfh_cnt,
                GROUP_CONCAT(
                    CASE 
                        WHEN p.punch_from = 'WFH' THEN p.punch_date
                    END
                    ORDER BY p.punch_date ASC
                ) AS wfh_dates

            FROM tbl_punching p 
            JOIN tbl_userinfo u ON u.user_id = p.user_id
            JOIN tbl_shift s ON s.shift_id = u.emp_shift_id
            LEFT JOIN (SELECT el.user_id, eld.leave_from_day FROM tbl_emp_leave el JOIN tbl_emp_leaveday eld ON el.leave_id = eld.leave_id AND el.status = 'Approved' AND leavetype_id =8 AND DATE_FORMAT(eld.leave_from_day, '%m-%Y') = ?) l 
                ON l.user_id = p.user_id AND p.punch_date = l.leave_from_day
            WHERE 
                DATE_FORMAT(p.punch_date, '%m-%Y') = ? 
            GROUP BY 
                p.user_id) lp ON lp.user_id = tu.user_id

            WHERE tec.company_id=? AND tec.status='Approve' AND tu.account_status='activate' ORDER BY tec.emp_name ASC", array($slipMonth, $slipMonth, $slipMonth, $company_id));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tbl_data[] = $row;
            }
            return $tbl_data;
        } else {
            return false;
        }
    }

    public function fetch_joining_date($emp_id)
    {
        $query = $this->db->query('SELECT date_of_joining FROM tbl_employee_creation WHERE display="Y" AND emp_id=?',array($emp_id));

        if($query->num_rows()>0)
        {          
          return $query->row()->date_of_joining;
        }
        else
        {
            return false;
        }    
    }

    public function fetch_punchin_data($user_id,$month)
    {


        $q = $this->db->query("SELECT * FROM tbl_punching AS tp WHERE tp.user_id=? AND DATE_FORMAT(tp.punch_date,'%m-%Y')=? ORDER BY tp.punch_date ASC",array($user_id,$month));
        if($q->num_rows() > 0){
            $month_array=explode('-', $month);

            $query=$this->db->query("SELECT date_field,h.*,p.*
                    FROM
                    (
                        SELECT
                            MAKEDATE(".$month_array[1].",1) +
                            INTERVAL (".$month_array[0]."-1) MONTH +
                            INTERVAL daynum DAY date_field
                        FROM
                        (
                            SELECT t*10+u daynum
                            FROM
                                (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
                                (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
                                UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                                UNION SELECT 8 UNION SELECT 9) B
                            ORDER BY daynum
                        ) AA
                    ) AAA
                    LEFT JOIN tbl_punching p ON p.user_id=? AND DATE_FORMAT(p.punch_date,'%m-%Y')=? AND p.punch_date=date_field 
                    LEFT JOIN tbl_holiday h ON h.holiday_date=date_field AND h.display='Y'
                    WHERE MONTH(date_field) = ?  ORDER BY date_field",array($user_id,$month,$month_array[0]));
            //echo $this->db->last_query(); 

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
        }else {
            return false;
        }
    }/*AND tp.punchout_time!='00:00:00'*/

    public function fetch_holidays($month)
    {
        $query = $this->db->query("SELECT count(holiday_id) AS holiday FROM `tbl_holiday` WHERE DATE_FORMAT(holiday_date,'%m-%Y')=?",array($month));
        if($query->num_rows()>0)
        {          
            return $query->row()->holiday;
        }else
        {
            return false;
        } 
    }

    // get existing data for update allowance 
    public function fetchDeductionForUpdate($month,$emp_id)
    {
        $query = $this->db->query("SELECT tedas.* ,tedas.emp_deduct_name as deduction_name, tad.* FROM tbl_emp_deduct_allowance_sal AS tedas,tbl_allowance_details AS tad WHERE tad.allowance_details_id= tedas.allowance_details_id AND tad.allowance_sal_date = tedas.allowance_sal_date AND tad.emp_id = tedas.emp_id AND tad.allowance_sal_date=? AND tad.emp_id=? AND tad.display='Y'",array($month,$emp_id));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    //fetch earning allowance salary data
    public function fetchDeduction($emp_id)
    {
        $query = $this->db->query("SELECT teda.* , tda.`deduction_name` FROM `tbl_deduction_allowance` AS tda,`tbl_emp_deduct_allowance` AS teda WHERE teda.`deduction_id`= tda.`deduction_id` AND teda.emp_id=? AND tda.display='Y' ",array($emp_id));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $deductionData[]=$row;
            }
            return $deductionData;
        }
        else
        {
            return false;
        }
    }

    // fetch deduction allowance data
   
    public function fetchEarning($emp_id)
    {
        $query = $this->db->query("SELECT teea.* , taa.`earning_name` FROM `tbl_earning_allowance` AS taa,`tbl_emp_earn_allowance` AS teea
                                    WHERE teea.`earning_id`= taa.`earning_id` AND teea.emp_id=? AND taa.display='Y'",array($emp_id));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    //when update fetch earning data for particular employee 

    public function checkAllowanceDataexist($month,$emp_id)
    {
        $query = $this->db->query("SELECT teeas.* , tad.* FROM tbl_emp_earn_allowance_sal AS teeas,tbl_allowance_details AS tad WHERE tad.allowance_details_id= teeas.allowance_details_id AND tad.allowance_sal_date = teeas.allowance_sal_date AND tad.emp_id = teeas.emp_id AND tad.allowance_sal_date=? AND tad.emp_id=? AND tad.display='Y'",array($month,$emp_id));

        if($query->num_rows() > 0)
        {
            
            return true;
        }
        else
        {
            return false;
        }
    }
   

    public function fetchEarningForUpdate($month,$emp_id)
    {
        $query = $this->db->query("SELECT teeas.*,teeas.emp_earn_name As earning_name , tad.* FROM tbl_emp_earn_allowance_sal AS teeas,tbl_allowance_details AS tad WHERE tad.allowance_details_id= teeas.allowance_details_id AND tad.allowance_sal_date = teeas.allowance_sal_date AND tad.emp_id = teeas.emp_id AND tad.allowance_sal_date=? AND tad.emp_id=? AND tad.display='Y'",array($month,$emp_id));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }
  

    public function getExpenditureReportData()
    {
        $query = $this->db->query("SELECT tbp.*, tad.allowance_details_id,tcd.company_name FROM tbl_basic_pt As tbp, tbl_allowance_details tad, tbl_company_master As tcd WHERE tbp.company_id=tcd.company_id AND tbp.display='Y' group by tbp.salary_month ,tbp.company_id order by tbp.basic_pt_id desc");

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }
    
    public function fetchDataForReport($month,$company_id)
    {
        $query = $this->db->query("SELECT tec.*,tbp.*, tbp.emp_id as empl_id,tu.username,tad.*,concat(tdm.dept_master_name,' - ',tsd.station_name,' [ ',tst.station_type_name,' ] ') dept, 
            (SELECT deduct_value FROM `tbl_emp_deduct_allowance` WHERE emp_id=tbp.emp_id AND deduction_id=11) as insurance_deduct
            FROM tbl_basic_pt tbp join tbl_employee_creation As tec on tec.emp_id=tbp.emp_id AND tbp.salary_month=? AND tbp.company_id=? left join tbl_userinfo as tu on tu.user_id=tec.user_id and tu.display='Y' left join tbl_user_station_dept as tusd on tusd.usd_id = tu.usd_id and tusd.user_id = tu.user_id left join tbl_department_station as tds on tusd.stat_dept_id = tds.stat_dept_id AND tds.display = 'Y' left join tbl_department_master as tdm on tdm.dept_master_id = tds.dept_master_id AND tdm.display = 'Y' left join tbl_station_details as tsd on tsd.station_id = tds.station_id AND tsd.display = 'Y' left join tbl_station_type as tst on tst.station_type_id = tsd.station_type_id AND tst.display = 'Y' left join tbl_allowance_details As tad on tbp.emp_id=tad.emp_id AND tbp.salary_month=tad.allowance_sal_date AND tbp.company_id=tad.company_id where tbp.work_day!='0.0' AND tbp.display='Y' order by tec.emp_name",array($month,$company_id));
        //echo $this->db->last_query();exit;
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    public function fetchallDataForReport($month,$emp_id)
    {
        if($emp_id=='All')
        {
            $query = $this->db->query("SELECT tec.*,tbp.*, tbp.emp_id as empl_id,tad.*,tcm.* FROM tbl_basic_pt tbp join tbl_employee_creation As tec on tec.emp_id=tbp.emp_id AND tbp.salary_month=? left join tbl_company_master As tcm ON tbp.company_id=tcm.company_id left join tbl_allowance_details As tad on tbp.emp_id=tad.emp_id AND tbp.salary_month=tad.allowance_sal_date AND tbp.company_id=tad.company_id  where tbp.work_day!='0.0' order by tec.company_id",array($month,$emp_id));
        }
        else{
            $query = $this->db->query("SELECT tec.*,tbp.*, tbp.emp_id as empl_id,tad.*,tcm.* FROM tbl_basic_pt tbp join tbl_employee_creation As tec on tec.emp_id=tbp.emp_id AND tbp.salary_month=? AND FIND_IN_SET(tbp.emp_id, '$emp_id') left join tbl_company_master As tcm ON tbp.company_id=tcm.company_id left join tbl_allowance_details As tad on tbp.emp_id=tad.emp_id AND tbp.salary_month=tad.allowance_sal_date AND tbp.company_id=tad.company_id where tbp.work_day!='0.0' order by tec.company_id",array($month,$emp_id));
        }
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    public function fetchmasterwagesDataForReport($month,$emp_id)
    {
        if($emp_id=='All')
        {
            $query = $this->db->query("SELECT tec.*,tbp.*, tbp.emp_id as empl_id,tad.*,tcm.* FROM tbl_basic_pt tbp join tbl_employee_creation As tec on tec.emp_id=tbp.emp_id AND tbp.salary_month=? left join tbl_company_master As tcm ON tbp.company_id=tcm.company_id left join tbl_allowance_details As tad on tbp.emp_id=tad.emp_id AND tbp.salary_month=tad.allowance_sal_date AND tbp.company_id=tad.company_id  where tbp.work_day!='0.0' order by tec.company_id",array($month,$emp_id));
        }
        else{
            $query = $this->db->query("SELECT tec.*,tbp.*, tbp.emp_id as empl_id,tad.*,tcm.* FROM tbl_basic_pt tbp join tbl_employee_creation As tec on tec.emp_id=tbp.emp_id AND tbp.salary_month=? AND FIND_IN_SET(tbp.emp_id, '$emp_id') left join tbl_company_master As tcm ON tbp.company_id=tcm.company_id left join tbl_allowance_details As tad on tbp.emp_id=tad.emp_id AND tbp.salary_month=tad.allowance_sal_date AND tbp.company_id=tad.company_id where tbp.work_day!='0.0' order by tec.company_id",array($month,$emp_id));
        }
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    public function fetchallowanceforreport($emp_id,$earning_id)
    {
        if($earning_id=='All'){
            $query = $this->db->query("SELECT * FROM tbl_emp_earn_allowance WHERE emp_id=? ",array($emp_id));
        }else{
            $query = $this->db->query("SELECT * FROM tbl_emp_earn_allowance WHERE emp_id=? AND earning_id IN (".$earning_id.") ",array($emp_id,$earning_id));
        }
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    public function fetchDeductAllowforreport($emp_id,$deduction_id)
    {
        if($deduction_id=='All'){
            $query = $this->db->query("SELECT * FROM tbl_emp_deduct_allowance WHERE emp_id=? ",array($emp_id));
        }else{
            $query = $this->db->query("SELECT * FROM tbl_emp_deduct_allowance WHERE emp_id=? AND deduction_id IN (".$deduction_id.") ",array($emp_id));
        }
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    // FETCH ALL DEDUCTION FOR EXPENDATURE 
    public function fetchDeductAllowDataOfEmpExpend($emp_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_emp_deduct_allowance WHERE deduction_id!=4 AND emp_id=?",array($emp_id));
        /*echo $this->db->last_query();
        exit();*/
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }
    // END expendature deduction fetch data

    public function fetchearnallowanceforreport($emp_id,$salary_month,$earning_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_basic_earning WHERE emp_id=? AND salary_month=? AND earning_id=?",array($emp_id,$salary_month,$earning_id));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    // fetch all earning allowance 
    public function fetchAllowDataOfEmp_basic_allow($emp_id,$salary_month)
    {
        $query = $this->db->query("SELECT * FROM tbl_basic_earning WHERE emp_id=? AND salary_month=?",array($emp_id,$salary_month));
        
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    public function fetchAllowDataOfEmp($allowance_details_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_emp_earn_allowance_sal WHERE allowance_details_id=?",array($allowance_details_id));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }


    public function fetchDeductAllowDataOfEmp($allowance_details_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_emp_deduct_allowance_sal WHERE allowance_details_id=?",array($allowance_details_id));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }


    // query for save allowance details
    public function save_allowance_details($allowance_data,$earn_data,$deduct_data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_allowance_details',$allowance_data);
        $allowance_details_id=$this->db->insert_id();
        if(isset($earn_data) && !empty($earn_data))
        {
            for($i=0;$i<count($earn_data);$i++)
            {
                $earn_data[$i]['allowance_details_id']=$allowance_details_id;
            }
            $this->db->insert_batch('tbl_emp_earn_allowance_sal', $earn_data);
        }        
        if(isset($deduct_data) && !empty($deduct_data))
        {   
            for($j=0;$j<count($deduct_data);$j++)
            {
                $deduct_data[$j]['allowance_details_id']=$allowance_details_id;
            }
            $this->db->insert_batch('tbl_emp_deduct_allowance_sal', $deduct_data);
        }
        //$this->db->insert('tbl_emp_earn_allowance_sal',$earn_data);
        // $deduct_data['allowance_details_id']=$allowance_details_id;
        // $this->db->insert('tbl_emp_deduct_allowance_sal',$deduct_data);
        $query=$this->db->trans_complete();
        if($query)
        {
            return true; 
        }
        else
        {
            return false;
        }
    }

    public function update_allowance_details($allowance_data,$earn_data,$deduct_data,$allowance_id)
    {
        $this->db->trans_start();
        $this->db->where('allowance_details_id',$allowance_id);
        $this->db->update('tbl_allowance_details',$allowance_data);
       
        if(isset($earn_data) && !empty($earn_data))
        {
            $this->db->update_batch('tbl_emp_earn_allowance_sal', $earn_data,'emp_earn_allow_sal_id');
        }        
        if(isset($deduct_data) && !empty($deduct_data))
        {
            $this->db->update_batch('tbl_emp_deduct_allowance_sal', $deduct_data,'emp_deduct_sal_id');
        }

        $query=$this->db->trans_complete();
        if($query)
        {
            return true; 
        }
        else
        {
            return false;
        }
    }

    public function fetch_leave_wages_regis($emp_id,$years)
    {
        $query = $this->db->query("SELECT m.month,ifnull(p.work_day,0) as Present_days,SUBSTRING_INDEX(salary_month, '-', -1) AS year,SUBSTRING_INDEX(salary_month, '-', 1) AS mnth FROM (SELECT 'January' AS MONTH,01 month_cnt UNION SELECT 'February' AS MONTH,02 month_cnt UNION SELECT 'March' AS MONTH,03 month_cnt UNION SELECT 'April' AS MONTH,04 month_cnt UNION SELECT 'May' AS MONTH,05 month_cnt UNION SELECT 'June' AS MONTH,06 month_cnt UNION SELECT 'July' AS MONTH,07 month_cnt UNION SELECT 'August' AS MONTH,08 month_cnt UNION SELECT 'September' AS MONTH,09 month_cnt UNION SELECT 'October' AS MONTH,10 month_cnt UNION SELECT 'November' AS MONTH,11 month_cnt UNION SELECT 'December' AS MONTH,12 month_cnt) AS m LEFT JOIN tbl_basic_pt as p on  p.emp_id=? AND ?=SUBSTRING_INDEX(salary_month, '-', -1) AND SUBSTRING_INDEX(salary_month, '-', 1)=m.month_cnt order by month_cnt asc",array($emp_id,$years));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    public function fetch_emp_all_data($emp_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_employee_creation as tec join tbl_employee_personal_details tepd on tec.user_id=tepd.user_id join tbl_company_master tcm on tepd.company_id=tcm.company_id join tbl_userinfo tu on tepd.user_id=tu.user_id left join tbl_department_master tdm on tu.emp_dept_id=tdm.dept_master_id where tec.emp_id=?",array($emp_id));
        
        if($query->num_rows()== 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }           
    }

    public function fetch_emp_compwise_data($emp_id,$salMonth)
    {
        $query = $this->db->query("SELECT *,tec.emp_id as emp FROM tbl_basic_pt as bp left join tbl_employee_creation as tec on bp.emp_id=tec.emp_id left join tbl_employee_personal_details tepd on tec.user_id=tepd.user_id left join tbl_company_master tcm on tepd.company_id=tcm.company_id left join tbl_userinfo tu on tepd.user_id=tu.user_id left join tbl_department_master tdm on tu.emp_dept_id=tdm.dept_master_id where FIND_IN_SET(tec.emp_id, '$emp_id') and bp.salary_month=? and tec.display='Y'",array($salMonth));
        
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }           
    }

    public function fetch_emp_leave_data($user_id,$month,$year)
    {
        /*$query = $this->db->query("SELECT ec.no_leave_credit AS total_leave,count(ld.emp_leaveday_id) as earn_leave,(ec.no_leave_credit - count(ld.emp_leaveday_id)) AS bal_leave FROM tbl_emp_leave_credit AS ec LEFT JOIN tbl_emp_leave AS l on ec.user_id=l.user_id AND l.status = 'approved' AND l.leavetype_id='2' AND l.display = 'Y' LEFT JOIN tbl_emp_leaveday AS ld on l.leave_id=ld.leave_id AND ld.display='Y' AND DATE_FORMAT(leave_from_day, '%M-%Y') <= '".$month.'-'.$year."' AND DATE_FORMAT(ld.leave_from_day, '%Y')=? WHERE ec.user_id =? AND ec.foryear=? ",array($year,$user_id,$year)); */

        $query=$this->db->query("SELECT ec.no_leave_credit AS total_leave,l.earn_leave,m.earn_leave1,(ec.no_leave_credit - l.earn_leave) AS bal_leave,count(emp_leave_credit_id) emp_id FROM tbl_emp_leave_credit AS ec
            LEFT JOIN (SELECT l1.*,COUNT(l2.emp_leaveday_id) AS earn_leave FROM tbl_emp_leave l1 JOIN tbl_emp_leaveday AS l2 on l1.leave_id=l2.leave_id AND l2.display='Y' AND DATE_FORMAT(l2.leave_from_day, '%m') >= '01' AND DATE_FORMAT(l2.leave_from_day, '%m') <= ? AND DATE_FORMAT(l2.leave_from_day, '%Y') = ? AND l1.status = 'approved' AND l1.leavetype_id='2' AND l1.display = 'Y' AND l1.user_id = ?) AS l on ec.user_id=l.user_id 

            LEFT JOIN (SELECT l3.*,COUNT(l4.emp_leaveday_id) AS earn_leave1 FROM tbl_emp_leave l3 JOIN tbl_emp_leaveday AS l4 on l3.leave_id=l4.leave_id AND l4.display='Y' AND DATE_FORMAT(l4.leave_from_day, '%m') = ? AND DATE_FORMAT(l4.leave_from_day, '%Y') = ? AND l3.status = 'approved' AND l3.leavetype_id='2' AND l3.display = 'Y' AND l3.user_id = ?) AS m on ec.user_id=m.user_id 




            WHERE ec.user_id = ? AND ec.foryear=?",array($month,$year,$user_id,$month,$year,$user_id,$user_id,$year));

        if($query->num_rows()== 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function fetch_emp_credit_leave_data($user_id,$year)
    {
        $query = $this->db->query("SELECT ec.no_leave_credit FROM tbl_emp_leave_credit AS ec WHERE ec.user_id =? AND ec.foryear=? AND ec.leavetype_id = 2",array($user_id,$year));
        
        if($query->num_rows()== 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function fetch_paid_leave($user_id,$month,$year)
    {
        $query = $this->db->query("SELECT count(ld.emp_leaveday_id) as paid_leave 
            FROM tbl_emp_leave AS l JOIN tbl_emp_leaveday AS ld on l.leave_id=ld.leave_id 
            JOIN tbl_emp_leave_credit AS ec ON l.user_id=ec.user_id AND ec.foryear=? 
            WHERE l.user_id =? AND l.status = 'approved' AND l.display = 'Y' AND l.leavetype_id='2' AND ld.display='Y' AND DATE_FORMAT(ld.leave_from_day, '%M')=? AND DATE_FORMAT(ld.leave_from_day, '%Y')=? ",array($year,$user_id,$month,$year));

        //echo $this->db->last_query();exit();
        
        if($query->num_rows()== 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }           
    }

    public function get_paid_leave($year,$user_id,$month)
    {
        $query = $this->db->query("SELECT * FROM tbl_emp_leave AS l 
            JOIN tbl_emp_leaveday AS ld on l.leave_id=ld.leave_id 
            JOIN tbl_emp_leave_credit AS ec ON l.user_id=ec.user_id AND foryear=? 
            WHERE l.user_id =? AND l.status = 'approved' AND l.display = 'Y' AND l.leavetype_id='2' AND ld.display='Y' AND DATE_FORMAT(ld.leave_from_day, '%m-%Y')=? group by ld.emp_leaveday_id",array($year,$user_id,$month));
        // echo $this->db->last_query();
        
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

    public function get_total_salary()
    {       
        $query = $this->db->query("SELECT MONTHNAME(STR_TO_DATE(SUBSTRING_INDEX(salary_month,'-',1),'%m')) AS Month_name, SUBSTRING_INDEX(salary_month,'-',1) AS mth_count, sum(net_pay) AS total FROM tbl_basic_pt as tle WHERE SUBSTRING_INDEX(salary_month,'-',-1)=YEAR(CURDATE()) GROUP BY Month_name order by mth_count");
        
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $key)
            {
                $tbl_data[]=array(
                    $key->Month_name,
                    $key->total
                    );
            }
            return $tbl_data;
        }
        else
        {
            return false;
        } 
    }

    public function get_total_emp()
    {       
        $query = $this->db->query("SELECT MONTHNAME(STR_TO_DATE(SUBSTRING_INDEX(salary_month,'-',1),'%m')) AS Month_name, SUBSTRING_INDEX(salary_month,'-',1) AS mth_count, sum(net_pay) AS total, count(emp_id) AS total_emp FROM tbl_basic_pt as tle WHERE SUBSTRING_INDEX(salary_month,'-',-1)=YEAR(CURDATE()) GROUP BY Month_name order by mth_count");
        
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $key)
            {
                $tbl_data[]=array(
                    $key->Month_name,
                    $key->total_emp
                    );
            }
            return $tbl_data;
        }
        else
        {
            return false;
        } 
    }

    public function fetch_emp_star_rate($user_id,$salary_month)
    {
        $query = $this->db->query("SELECT * FROM tbl_emp_star_rate where user_id=? and month=?",array($user_id,$salary_month));
        
        if($query->num_rows()== 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }


    public function fetch_month_diff_of_emp_joining_date_and_currdate($id) 
    { 
        $query = $this->db->query("SELECT 12 * (YEAR(CURDATE()) - YEAR(emp_joining_date)) + (MONTH(CURDATE())- MONTH(emp_joining_date))-1 AS months FROM `tbl_employee_personal_details` where user_id =?",array($id));
        
        if($query->num_rows()== 1)
        {       
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function fetch_hrs($user_id,$month)
    {
        /*$query = $this->db->query("SELECT DATE_FORMAT(punch_date,'%d') date_no,punch_date,TIME_FORMAT(TIMEDIFF(punchout_time,punchin_time),'%H:%i:%s') AS 'totalHour' FROM tbl_punching where user_id=? and DATE_FORMAT(punch_date, '%m-%Y')=? order by punch_date ASC",array($user_id,$month));*/

        $query = $this->db->query("SELECT DATE_FORMAT(p.punch_date,'%d') date_no,p.punch_date pdate, if(isnull(p.punch_date),'A','P') type FROM tbl_punching p where p.user_id=? and DATE_FORMAT(p.punch_date, '%m-%Y')=? 
        UNION 
        SELECT DATE_FORMAT(h.holiday_date,'%d') date_no,h.holiday_date pdate, if(isnull(h.holiday_date),'','NH') type FROM tbl_holiday h where DATE_FORMAT(h.holiday_date, '%m-%Y')=?
        UNION
        SELECT DATE_FORMAT(ld.leave_from_day,'%d') date_no,ld.leave_from_day pdate,if(isnull(ld.leave_from_day),'','PL') type FROM tbl_emp_leave el join tbl_emp_leaveday ld on ld.leave_id=el.leave_id where el.user_id=? and el.leavetype_id='2' and el.status='approved' and DATE_FORMAT(ld.leave_from_day, '%m-%Y')=?
        UNION
        SELECT DATE_FORMAT(DATE(punch_date + INTERVAL (8 - DAYOFWEEK(punch_date)) DAY),'%d') date_no, DATE(punch_date + INTERVAL (8 - DAYOFWEEK(punch_date)) DAY) pdate, if(isnull(DATE(punch_date + INTERVAL (8 - DAYOFWEEK(punch_date)) DAY)),'','WO') type from tbl_punching where DATE_FORMAT(DATE(punch_date + INTERVAL (8 - DAYOFWEEK(punch_date)) DAY), '%m-%Y')=?
        UNION

        SELECT DATE_FORMAT(ld1.leave_from_day,'%d') date_no,ld1.leave_from_day pdate,if(isnull(ld1.leave_from_day),'','A') type FROM tbl_emp_leave el1 join tbl_emp_leaveday ld1 on ld1.leave_id=el1.leave_id where el1.user_id=? and el1.leavetype_id='1' and el1.status='applied' and DATE_FORMAT(ld1.leave_from_day, '%m-%Y')=? AND ld1.display = 'Y'  group by pdate order by pdate asc",array($user_id,$month,$month,$user_id,$month,$month,$user_id,$month)); 
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

    public function gen_emp_salary_report($emp_id,$years)
    {
        $query = $this->db->query("SELECT * FROM tbl_basic_pt WHERE emp_id=? AND SUBSTRING_INDEX(salary_month, '-', -1)=? AND display='Y' ORDER BY basic_pt_id ASC",array($emp_id,$years));

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }
    }

    public function fetch_emp_wise_data($emp_id)
    {
        $query = $this->db->query("SELECT *,tec.emp_id as emp FROM tbl_employee_creation as tec left join tbl_employee_personal_details tepd on tec.user_id=tepd.user_id left join tbl_company_master tcm on tepd.company_id=tcm.company_id left join tbl_userinfo tu on tepd.user_id=tu.user_id left join tbl_department_master tdm on tu.emp_dept_id=tdm.dept_master_id where FIND_IN_SET(tec.emp_id, '$emp_id') and tec.display='Y'");
        
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $earningData[]=$row;
            }
            return $earningData;
        }
        else
        {
            return false;
        }           
    }

    public function editfetchAdvanceData($companyId,$slipMonth)
    {
        $query = $this->db->query("SELECT emp_id,advance_opening as opening_amt,advance_Addition as advAddition_val,advance_recovery as recoveryPermonthAmt,advance_closing_amt as closing_amt FROM tbl_basic_pt WHERE company_id=? AND salary_month=? AND display='Y' AND advance_opening!='0'",array($companyId,$slipMonth));

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

    public function deleteSalary($company_id, $mth)
    {

         $this->db->trans_start();

         $this->db->query("DELETE be.* FROM tbl_basic_earning be JOIN tbl_employee_creation b ON b.emp_id=be.emp_id AND be.salary_month='".$mth."' AND b.company_id=".$company_id );

         $this->db->query("DELETE be.* FROM `tbl_basic_deduction` be JOIN tbl_employee_creation b ON b.emp_id=be.emp_id AND be.salary_month='".$mth."' AND b.company_id=".$company_id);

         /*
        $advace_details = $this->fetchAdvanceDetails($company_id);
        if(isset($advace_details) && !empty($advace_details))
        {
            foreach ($advace_details as $key) {
                $adv_id = $key->adv_id;
                $emp_id = $key->emp_id;
                $comp_id = $key->company_id;
               
                $temp_details = $this->fetch_adv_tepm_details($emp_id,$comp_id,$mth); 
                if(isset($temp_details) && !empty($temp_details))
                {
                    $basic_details = $this->fetch_basic_pt_details($company_id, $mth,$emp_id);
                  
                    $recovery_amt = ($key->opening_amt <= $key->recoveryPermonthAmt)?$key->opening_amt:$key->recoveryPermonthAmt;
                    $advance_opening = $temp_details->opening_amt + $temp_details->recovery_amt; 
                    $advance_recovery = $temp_details->recovery_amt;
                    $advance_closing_amt = $temp_details->closing_amt+$temp_details->recovery_amt;
                    
                    $adv_temp_id = isset($temp_details->adv_temp_id) && !empty($temp_details->adv_temp_id)?$temp_details->adv_temp_id:'';
                    $advance_data = array('opening_amt'=>$advance_opening,'recovery_amt'=>$advance_recovery,'closing_amt'=>$advance_closing_amt);
                   

                    $this->db->where('adv_id', $adv_id)->where('company_id', $comp_id)->where('emp_id', $emp_id)->where('display', 'Y')->update('tbl_advance_details', $advance_data);
                    $this->db->where('adv_temp_id',$adv_temp_id)->update('tbl_advance_temp_details',array('display'=>'N'));
                   


                }               
            }
        }
        */


         
        $this->db->query('DELETE FROM `tbl_basic_pt` WHERE company_id='.$company_id.' AND salary_month="'.$mth.'"');
        


        $query=$this->db->trans_complete();

        if($query)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }   
    }

    public function fetch_basic_pt_details($company_id, $mth,$emp_id)
    {
        $query = $this->db->query('SELECT advance_opening,advance_recovery,advance_closing_amt,advance_Addition FROM tbl_basic_pt WHERE emp_id=? AND company_id=? AND salary_month=? LIMIT 1',array($emp_id,$company_id,$mth));
        if($query->num_rows()== 1)
        {       
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function fetchAdvanceDetails($company_id)
    {
        $query = $this->db->query('SELECT * FROM tbl_advance_details WHERE company_id = ? AND display="Y"',$company_id);

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


    public function fetch_adv_tepm_details($emp_id,$comp_id,$mth)
    {
        $query = $this->db->query('SELECT opening_amt,recovery_amt,closing_amt,adv_temp_id FROM tbl_advance_temp_details  
            WHERE adv_temp_id = (SELECT DISTINCT(adv_temp_id) 
            FROM tbl_advance_temp_details WHERE emp_id=? AND company_id=? ORDER BY adv_temp_id desc LIMIT 0,1)',array($emp_id,$comp_id,$mth));

        // display = "Y" AND recovery_mode = ""
        if($query->num_rows()== 1)
        {       
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function SelectEmp()
    {
        $query = $this->db->query("SELECT tec.* 
            FROM tbl_employee_creation AS tec
            LEFT JOIN tbl_userinfo AS tu ON tu.user_id = tec.user_id AND tu.display = 'Y'
            WHERE tec.display='Y' AND tu.account_status = 'activate'");
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


    public function get_sick_leave($year,$user_id,$month)
    {
        $query = $this->db->query("SELECT * FROM tbl_emp_leave AS l 
            JOIN tbl_emp_leaveday AS ld on l.leave_id=ld.leave_id 
            JOIN tbl_emp_leave_credit AS ec ON l.user_id=ec.user_id AND foryear=? 
            WHERE l.user_id =? AND l.status = 'approved' AND l.display = 'Y' AND l.leavetype_id=7 AND ld.display='Y' AND DATE_FORMAT(ld.leave_from_day, '%m-%Y')=? group by ld.emp_leaveday_id",array($year,$user_id,$month));
        //echo $this->db->last_query();
        
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

    public function fetch_emp_sick_leave_data($user_id,$year)
    {
        $query = $this->db->query("SELECT ec.sick_leave_creadit FROM tbl_emp_leave_credit AS ec WHERE ec.user_id =? AND ec.foryear=? AND ec.leavetype_id = 7",array($user_id,$year));
        
        if($query->num_rows()== 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function fetch_emp_sick_leave_data1($user_id,$month,$year)
    {
        $query=$this->db->query("SELECT ec.sick_leave_creadit AS total_leave,l.earn_leave,m.earn_leave1,(ec.sick_leave_creadit - l.earn_leave) AS bal_leave,count(emp_leave_credit_id) emp_id FROM tbl_emp_leave_credit AS ec
            LEFT JOIN (SELECT l1.*,COUNT(l2.emp_leaveday_id) AS earn_leave FROM tbl_emp_leave l1 JOIN tbl_emp_leaveday AS l2 on l1.leave_id=l2.leave_id AND l2.display='Y' AND DATE_FORMAT(l2.leave_from_day, '%m') >= '01' AND DATE_FORMAT(l2.leave_from_day, '%m') <= ? AND DATE_FORMAT(l2.leave_from_day, '%Y') = ? AND l1.status = 'approved' AND l1.leavetype_id=7 AND l1.display = 'Y' AND l1.user_id = ?) AS l on ec.user_id=l.user_id 

            LEFT JOIN (SELECT l3.*,COUNT(l4.emp_leaveday_id) AS earn_leave1 FROM tbl_emp_leave l3 JOIN tbl_emp_leaveday AS l4 on l3.leave_id=l4.leave_id AND l4.display='Y' AND DATE_FORMAT(l4.leave_from_day, '%m') = ? AND DATE_FORMAT(l4.leave_from_day, '%Y') = ? AND l3.status = 'approved' AND l3.leavetype_id=7 AND l3.display = 'Y' AND l3.user_id = ?) AS m on ec.user_id=m.user_id 




            WHERE ec.user_id = ? AND ec.foryear=? AND ec.leavetype_id = 7",array($month,$year,$user_id,$month,$year,$user_id,$user_id,$year));
          //echo $this->db->last_query();exit();
        if($query->num_rows()== 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function getAllSalaryDetailNewTable($salary_month, $company_id)
    {
        $query = $this->db->query("SELECT * FROM `tbl_emp_salary_excel_genrated_data` WHERE salary_month=? and company_id=? and display='Y'", array($salary_month, $company_id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tbl_data[] = $row;
            }
            return $tbl_data;
        } else {
            return false;
        }
    }

    public function getYearyBonus($emp_id, $salary_month)
    {
        $query = $this->db->query("SELECT SUM(earn_bonus) bonus FROM tbl_basic_pt WHERE bonus_type LIKE 'yearly' AND emp_id = ? AND DATE_FORMAT(STR_TO_DATE(salary_month, '%m-%Y'), '%Y-%m') 
      BETWEEN 
      DATE_FORMAT(DATE_SUB(STR_TO_DATE(CONCAT('01-', ?), '%d-%m-%Y'), INTERVAL 11 MONTH), '%Y-%m') 
      AND DATE_FORMAT(STR_TO_DATE(CONCAT('01-', ?), '%d-%m-%Y'), '%Y-%m')  AND display='Y'", array($emp_id, $salary_month, $salary_month));
        if ($query->num_rows() == 1) {
            return $query->row(0)->bonus;
        } else {
            return false;
        }

    }
    function fetchBonusType($emp_id){
        $query = $this->db->query("SELECT bonus_type FROM tbl_emp_earn_allowance WHERE emp_id =? AND earning_id = 15 AND display='Y'", array($emp_id));
        if ($query->num_rows() > 0 && $query->row(0)->bonus_type=="yearly") {
            return "yearly";
        } else {
            return "monthly";
        }
    }
    
}// end of model
