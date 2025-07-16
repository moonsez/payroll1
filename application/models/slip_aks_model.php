<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class slip_aks_model extends CI_Model {
/*
    Author :- Vishal
    work :- save company data Ajax call , form validations
*/

    function fetchAllEmployeeByCompany($companyId)
    {
            $q = $this->db->query("SELECT tec.emp_id, td.desig_id, tec.company_id, tec.emp_name, tu.username employee_id, td.desig_name, 
                                   tec.date_of_joining, tec.emp_pan_num, tec.emp_basic,tec.gender,tec.emp_loc,tec.bank_acc_no 
                                   FROM tbl_employee_creation AS tec, tbl_designation AS td,tbl_userinfo AS tu 
                                   WHERE tec.desig_id=td.desig_id AND tu.user_id = tec.user_id AND tu.display='Y' AND tu.account_status='activate' AND tec.display='Y' AND tec.company_id=?
                                   ORDER BY tec.emp_name",array($companyId));
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

    function fetchAllEmployeeByComy11($companyId)
    {
            $q = $this->db->query("SELECT * FROM tbl_employee_creation AS tec
                                   WHERE tec.display='Y' AND tec.company_id=?
                                   ORDER BY tec.emp_name",array($companyId));
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

    function fetchAllEmployeeByComy($companyId)
    {
            $q = $this->db->query("SELECT tepd.emp_id,tepd.user_id,tepd.company_id,concat(tepd.firstname,' ',tepd.lastname) AS emp_name FROM tbl_employee_personal_details AS tepd LEFT JOIN tbl_userinfo AS tu ON tepd.user_id=tu.user_id WHERE company_id=? AND tu.account_status='activate' AND tu.display='Y' ORDER BY tepd.user_id ASC",array($companyId));
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

    function fetchAllEmployeeByComyReport($companyId)
    {
            $q = $this->db->query("SELECT * FROM tbl_employee_creation AS tec LEFT JOIN tbl_company_master AS tcm ON tec.company_id = tcm.company_id AND tcm.display='Y' WHERE tec.display='Y' AND tec.company_id IN (".$companyId.") ORDER BY tec.company_id");
            
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

    function fetchAllEmployee()
    {
            $q = $this->db->query("SELECT tepd.emp_id,tepd.user_id,tepd.company_id,concat(tepd.firstname,' ',tepd.lastname) AS emp_name FROM tbl_employee_personal_details AS tepd LEFT JOIN tbl_userinfo AS tu ON tepd.user_id=tu.user_id WHERE tu.account_status='activate' AND tu.display='Y' ORDER BY tepd.user_id ASC");
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

    function fetchAllEmployeeDeatils($id,$comp_id)
    {
      $q = $this->db->query("SELECT tepd.pan_number,tepd.user_id,concat(tepd.firstname,' ',tepd.lastname) name,tepd.local_address, concat(tepd.permanent_add1,' ',tepd.permanent_add2,' ',tepd.permanent_add3) permanent_address,tepd.gender,tu.username,tepd.emp_joining_date,tepd.date_of_birth,tepd.work_email,tet.title FROM tbl_employee_personal_details AS tepd LEFT JOIN tbl_userinfo AS tu ON tu.user_id=tepd.user_id AND tu.account_status='activate' AND tu.display='Y' LEFT JOIN tbl_user_emp_type AS tuet ON tuet.uet_id=tu.uet_id LEFT JOIN tbl_employee_type AS tet ON tuet.emp_type_id=tet.emp_type_id AND tet.display='Y' WHERE concat(tepd.firstname,' ',tepd.lastname)=? AND tepd.display='Y' AND tepd.company_id=? GROUP BY name ORDER BY tepd.emp_id,tuet.emp_type_id DESC",array($id,$comp_id));
        if($q->num_rows()==1)
        {
          return $q->row();
        }
        else
        {
          return false;
        }
    }

    function fetch_all_user_info_rollmgmt()
    {
      $q = $this->db->query("SELECT tu.user_id,tu.username,concat(tepd.firstname,' ',tepd.lastname) emp_name,
                  tst.station_type_name,tsd.station_name,tdm.dept_master_name
                  FROM `tbl_userinfo` as tu,`tbl_employee_personal_details` as tepd,`tbl_user_station_dept` as tusd,
                  `tbl_department_station` as tds,`tbl_department_master` as tdm,`tbl_station_details` as tsd,
                  `tbl_station_type` as tst
                  WHERE 
                  tu.user_id = tepd.user_id
                  and tu.display = 'Y'
                  and tusd.usd_id = tu.usd_id
                  and tu.user_id = tusd.user_id
                  and tds.stat_dept_id = tusd.stat_dept_id 
                  and tdm.dept_master_id = tds.dept_master_id
                  and tsd.station_id = tds.station_id
                  and tst.station_type_id = tsd.station_type_id and tu.account_status = 'activate'
                  order by replace(tu.username,'VOL','0') ASC ");
      if($q->num_rows>0)
      {
        foreach ($q->result() as $key) 
        {
          $data[]=$key;
        }
        return $data;     
      }
    }

    public function fetchSalaryDetailsEmpByMonth($salaryMonth,$company_id)
    {

      $q = $this->db->query("SELECT tu.username,tec.*,tbp.net_pay as basic_amt, tbp.work_day,tbp.salaryslip , tad.net_allowance_amt as total_allow_amt, tad.deduct_amt,tad.earning_amt,(SELECT earn_value FROM `tbl_emp_earn_allowance` WHERE emp_id=tec.emp_id AND earning_id=15) as bonus_allowance FROM tbl_basic_pt As tbp join tbl_employee_creation As tec on tbp.emp_id=tec.emp_id AND tbp.company_id=? AND tbp.salary_month=? AND tbp.display='Y' left join tbl_allowance_details As tad on tbp.emp_id=tad.emp_id AND tbp.salary_month=tad.allowance_sal_date LEFT JOIN tbl_userinfo AS tu ON tu.user_id = tec.user_id AND tu.display='Y' where tbp.work_day!='0.0' ",array($company_id,$salaryMonth));
     
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

    //get opening amount and add new advance in opening amount 


    /*function getOpeningAmtWhr($emp_id){

      $q = $this->db->query("SELECT opening_amt,recoveryPermonthAmt
                            FROM tbl_advance_details
                            WHERE display='Y' AND emp_id=? LIMIT 1",array($emp_id));
         
        if($q->num_rows() > 0)
        {
          //return $q->row()->opening_amt;
          //return $q->row()->recovery_amt; 
          
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

    }*/

    function getOpeningAmtWhr($emp_id){

      $q = $this->db->query("SELECT (SUM(ta.amount) - (SUM(ta.amount)-tad.opening_amt)) opening_amt,recoveryPermonthAmt FROM tbl_advance AS ta, tbl_advance_details AS tad WHERE tad.emp_id=ta.emp_id AND ta.display='Y' AND tad.display='Y' AND ta.emp_id=? GROUP BY ta.emp_id",array($emp_id));
         
        if($q->num_rows() > 0)
        {
          //return $q->row()->opening_amt;
          //return $q->row()->recovery_amt; 
          
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



    function getOpeningAmtWhrOnDelete($emp_id){

      $q = $this->db->query("SELECT opening_amt
                            FROM tbl_advance_details
                            WHERE emp_id=?",array($emp_id));
         
        if($q->num_rows() > 0)
        {
            return $q->row()->opening_amt;
           // return $q->row()->recovery_amt;
        }
        else
        {
            return false;
        }

    }
    function setOpeningAmtWhr($emp_id,$opening,$recovery_mode,$rec_mode_amt){

      $indata = array(
        'opening_amt'=>$opening,
        'recovery_mode'=>$recovery_mode,
        'recoveryPermonthAmt'=>$rec_mode_amt
        
        );

     $q  =  $this->db->where('emp_id', $emp_id)
               ->update('tbl_advance_details', $indata); 


    // $this->db->where('emp_id',$emp_id)
    //           ->update('',$indata);

    
        if($q)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    function setOpeningAmtWhrDelete($empId,$opening){

      $indata = array(
        'opening_amt'=>$opening        
        
        );

     $q  =  $this->db->where('emp_id', $empId)
               ->update('tbl_advance_details', $indata); 


    // $this->db->where('emp_id',$emp_id)
    //           ->update('',$indata);

    
        if($q)
        {
            return true;
        }
        else
        {
            return false;
        }
    }



  

    function setOpeningAmtWhr1($emp_id,$indata){

      // $indata = array(
      //   'opening_amt'=>$opening,
      //   'closing_amt'=>$closing_amt
      //   );

     $q  =  $this->db->where('emp_id', $emp_id)
               ->update('tbl_advance_details', $indata); 


    // $this->db->where('emp_id',$emp_id)
    //           ->update('',$indata);

    
        if($q)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function fetchParticularEmpEarningData($empId)
    {
        $q = $this->db->query("SELECT teea.emp_earn_allow_id,teea.convey_allowance_type, teea.emp_id, teea.earning_id, teea.earn_value, tea.earning_name, 
                               tea.earning_code, tea.earning_default_value, tea.earning_unit 
                               FROM tbl_emp_earn_allowance AS teea, tbl_earning_allowance AS tea 
                               WHERE teea.earning_id=tea.earning_id AND teea.emp_id=?",array($empId));
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

    function fetchParticularEmpDeductionData($empId)
    {
        $q = $this->db->query("SELECT teda.emp_id, teda.deduction_id, teda.deduct_value, tda.deduction_name, tda.deduction_code, 
                               tda.deduction_default_value, tda.deduction_unit
                               FROM tbl_emp_deduct_allowance AS teda, tbl_deduction_allowance AS tda 
                               WHERE tda.deduction_id=teda.deduction_id AND teda.emp_id=?",array($empId));
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

    function fetchParticularEmpEarningDataReport($empId)
    {
        $q = $this->db->query("SELECT teea.emp_earn_allow_id,teea.convey_allowance_type, teea.emp_id, teea.earning_id, teea.earn_value, tea.earning_name, 
                               tea.earning_code, tea.earning_default_value, tea.earning_unit 
                               FROM tbl_emp_earn_allowance AS teea, tbl_earning_allowance AS tea 
                               WHERE teea.earning_id=tea.earning_id AND teea.emp_id IN (".$empId.") GROUP BY teea.earning_id");
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

    function fetchParticularEmpDeductionDataReport($empId)
    {
        $q = $this->db->query("SELECT teda.emp_id, teda.deduction_id, teda.deduct_value, tda.deduction_name, tda.deduction_code, 
                               tda.deduction_default_value, tda.deduction_unit
                               FROM tbl_emp_deduct_allowance AS teda, tbl_deduction_allowance AS tda 
                               WHERE tda.deduction_id=teda.deduction_id AND teda.emp_id IN (".$empId.") GROUP BY teda.deduction_id");
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

    function fetchParticularEmpAdvanceData($empId)
    {
        $q = $this->db->query("SELECT  `opening_amt`, `recovery_amt`, `recoveryPermonthAmt`,`addition_amt`, `closing_amt`
                               FROM tbl_advance_details
                               WHERE emp_id=?",array($empId));
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

    
// 
   function fetchDataForExcelGenerate($empId,$pay_slip_month)
    {

      /*$q = $this->db->query("SELECT tec.*,tbp.* FROM tbl_basic_pt As tbp, tbl_employee_creation As tec WHERE tbp.emp_id=? AND tbp.salary_month=? AND tbp.work_day > 0 AND tbp.display='Y' AND tbp.emp_id=tec.emp_id AND tec.display='Y'",array($empId, $pay_slip_month));*/

      $q = $this->db->query("SELECT tec.*,tbp.*,tepd.emp_code,tu.username,tet.title
                  FROM tbl_basic_pt As tbp
                  LEFT JOIN tbl_employee_creation As tec ON tbp.emp_id=tec.emp_id 
                  LEFT JOIN tbl_userinfo AS tu ON tu.user_id = tec.user_id AND tu.display='Y'
                  LEFT JOIN tbl_employee_personal_details AS tepd ON tepd.user_id = tu.user_id AND tepd.display='Y' 
                  LEFT JOIN tbl_bonus_track_record as tbtr ON tbtr.user_id=tepd.user_id AND tbtr.display='Y'
                  LEFT JOIN tbl_user_emp_type AS tuet ON tu.uet_id=tuet.uet_id
                  LEFT JOIN tbl_employee_type AS tet ON tet.emp_type_id=tuet.emp_type_id
                  WHERE tbp.emp_id=? AND tbp.salary_month=? AND tbp.work_day > 0 AND tbp.display='Y'",array($empId, $pay_slip_month));
                //   echo $this->db->last_query();die;
      
      if($q->num_rows()==1)
      {
        return $q->row();
      }
      else
      {
        return false;
      }
    }


    public function getImageName($company_id){

      $q = $this->db->query("SELECT company_logo FROM `tbl_company_master` WHERE company_id=?",array($company_id));
      if($q->num_rows()>0)
      {          
          return $q->row()->company_logo;
      }
      else
      {
          return false;
      }
    }

    // old fetch earning data for pay slip excel
   /* function fetchDataForExcelEarnData($empId,$pay_slip_month)
    {

      $q = $this->db->query("SELECT * FROM tbl_emp_earn_allowance_sal WHERE emp_id=? AND allowance_sal_date=? AND display='Y'",array($empId,$pay_slip_month));
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
    }*/

    function fetchDataForExcelEarnData($empId,$pay_slip_month)
    {

      /*$q = $this->db->query("SELECT tbe.*,tea.earning_name FROM tbl_basic_earning As tbe, tbl_earning_allowance As tea WHERE tbe.earning_id=tea.earning_id AND tbe.emp_id=? AND tbe.salary_month=?",array($empId,$pay_slip_month));*/
      $q = $this->db->query("SELECT tbe.*,tea.earning_name FROM tbl_basic_earning As tbe, tbl_earning_allowance As tea WHERE tbe.earning_id=tea.earning_id AND tea.display='Y' AND tbe.emp_id=? AND tbe.salary_month=? group by tea.earning_id ORDER BY basic_earning_id ASC",array($empId,$pay_slip_month));
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
    // old deduction alloewances fetch 
    /*function fetchDataForExcelDeductData($empId,$pay_slip_month)
    {

      $q = $this->db->query("SELECT * FROM tbl_emp_deduct_allowance_sal WHERE emp_id=? AND allowance_sal_date= ? AND display='Y'",array($empId,$pay_slip_month));
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
    }*/

    function fetchDataForExcelDeductData($empId,$pay_slip_month)
    {

      $q = $this->db->query("SELECT tbd.*,tda.deduction_name FROM tbl_basic_deduction As tbd, tbl_deduction_allowance As tda WHERE tbd.deduction_id=tda.deduction_id AND tbd.emp_id=? AND tbd.salary_month=? AND tda.deduction_id!=7 AND tda.deduction_id!=8 ",array($empId,$pay_slip_month));
      //echo $this->db->last_query(); exit();
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

    
    function fetchEarning($emp_id)
    {

      $q = $this->db->query("SELECT ea.calculate, ea.earning_id,ea.earning_unit, ea.earning_name, eea.earn_value,eea.fixed_amount,eea.convey_allowance_type,eea.bonus_type 
                             FROM tbl_earning_allowance as ea, tbl_emp_earn_allowance as eea 
                             WHERE eea.earning_id=ea.earning_id AND eea.emp_id=? AND eea.display='Y'",array($emp_id));
                            //  echo $this->db->last_query();die;
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

    function fetchEarning1()
    {

      $q = $this->db->query("SELECT ea.earning_id,ea.earning_unit, ea.earning_name, eea.earn_value,eea.fixed_amount,eea.convey_allowance_type 
                             FROM tbl_earning_allowance as ea, tbl_emp_earn_allowance as eea 
                             WHERE eea.earning_id=ea.earning_id AND eea.display='Y'",array($emp_id));
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


    function fetchDeduction($emp_id)
    {
      $q = $this->db->query("SELECT ed.deduction_id,ed.deduction_unit, ed.deduction_name, eda.deduct_value FROM tbl_deduction_allowance as ed, tbl_emp_deduct_allowance as eda WHERE eda.deduction_id=ed.deduction_id and eda.emp_id=? and eda.display='Y' ",array($emp_id));
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

    function fetch_str_Earning($emp_id)
    {

      $q = $this->db->query("SELECT ea.earning_id,ea.earning_unit, ea.earning_name, eea.earn_value,eea.fixed_amount,eea.convey_allowance_type 
                             FROM tbl_earning_allowance as ea, tbl_emp_earn_allowance_approve as eea 
                             WHERE eea.earning_id=ea.earning_id AND eea.emp_id=? AND eea.display='Y'",array($emp_id));
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

    function fetch_str_Deduction($emp_id)
    {
      $q = $this->db->query("SELECT ed.deduction_id,ed.deduction_unit, ed.deduction_name, eda.deduct_value FROM tbl_deduction_allowance as ed, tbl_emp_deduct_allowance_approve as eda WHERE eda.deduction_id=ed.deduction_id and eda.emp_id=? and eda.display='Y' ",array($emp_id));
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

    function reprintPaySlipExcelFileGenerate($paySlipMonth,$company_id)
    {
      $q = $this->db->query("SELECT slip_static_data_id, emp_id, comp_employee_id, emp_name, emp_gender, emp_designation, 
                             DATE_FORMAT(pay_slip_generate_date,'%d-%m-%Y') AS pay_slip_generate_date, emp_working_days, 
                             emp_basic, total_pay, total_deduct, net_pay, pay_slip_month 
                             FROM `tbl_emp_slip_static_data` 
                             WHERE pay_slip_month LIKE ? AND company_id = ? AND display='Y'",array($paySlipMonth,$company_id));
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

    //

    function reprintslip($paySlipMonth,$empId)
    {
      $q = $this->db->query("UPDATE tbl_emp_slip_static_data SET display='N' WHERE pay_slip_month LIKE ? AND emp_id=?",array($paySlipMonth,$empId));
      if($q)
      {
         

          
          return true;
      }
      else
      {
          return false;
      }
    }

     function GetAdvanceOnDelete($paySlipMonth,$empId)
    {
      $q = $this->db->query("SELECT recovery_amount FROM tbl_emp_slip_static_data WHERE display='Y' AND pay_slip_month LIKE '".$paySlipMonth."' AND emp_id=?",array($empId));
     
         if($q->num_rows() > 0)
          {
              return $q->row()->recovery_amount;
             // return $q->row()->recovery_amt;
          }
          else
          {
              return false;
          }

        
    }
 function Getlogo($company_id)
 {
   $q = $this->db->query("SELECT company_logo FROM `tbl_company_master` WHERE display='Y' AND company_id=?",array($company_id));
    if($q->num_rows() > 0)
          {
             return $q->row()->company_logo;
             // return $q->row()->recovery_amt;
          }
          else
          {
              return false;
          }
 }


  public function fetch_star_details($emp_id,$month)
  {
    $query = $this->db->query('SELECT te.user_id,tes.red_star,tes.gold_star FROM tbl_employee_creation AS te LEFT JOIN tbl_emp_star_rate AS tes ON te.user_id = tes.user_id AND tes.display="Y" WHERE te.emp_id = ? AND tes.month = ? AND te.display ="Y"',array($emp_id,$month));

    if($query->num_rows()==1)
      {
        return $query->row();
      }
      else
      {
        return false;
      }
  } 

  function update_salaryslip_status($emp_id, $comp_id, $month)
  {


    $query = $this->db->query("UPDATE tbl_basic_pt SET salaryslip = 'hide' WHERE FIND_IN_SET(company_id,?) AND salary_month=? ",array($comp_id, $month));

    $q = $this->db->query("UPDATE tbl_basic_pt SET salaryslip = 'show' WHERE FIND_IN_SET(emp_id,?) AND FIND_IN_SET(company_id,?) AND salary_month=? ",array($emp_id, $comp_id, $month));

    if($q)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function update_star_details($user_id,$salaryMonth,$red_star)
  {
    $query = $this->db->query("UPDATE tbl_emp_star_rate SET red_star = ? WHERE user_id = ? AND month=? ",array($red_star,$user_id, $salaryMonth));

    if($query)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  function fetchLeaveData($empId,$month,$year)
    {
      $q = $this->db->query("SELECT sum(no_of_leave) as no_of_leave FROM tbl_earn_leave_salary WHERE emp_id=? AND display='Y'",array($empId));
      if($q->num_rows()==1)
      {
        return $q->row();
      }
      else
      {
        return false;
      }
    }


  public function selectAllempDetails()
  {
      $q = $this->db->query("SELECT tec.*,tu.username FROM tbl_employee_creation as tec, tbl_userinfo as tu WHERE tu.user_id=tec.user_id AND tu.display='Y' AND tec.status='Pending' AND tu.account_status='activate' AND tec.display='Y' ");
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

  public function fetchNewCtc($company_id, $userId, $newdate)
	{

		$query = $this->db->query('SELECT * FROM `tbl_emp_salary_excel_genrated_data`  WHERE company_id=? and user_id=? and salary_month=? and display="Y"', array($company_id, $userId, $newdate));
		//	echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

    public function fetchMothWiseComp($userId, $newdate)
	{

		$query = $this->db->query('SELECT * FROM `tbl_emp_salary_excel_genrated_data`  WHERE user_id=? and salary_month=? and display="Y"', array($userId, $newdate));
		//	echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}


    /*function update_location()
    {
      $q = $this->db->query("SELECT usd.user_id,sd.station_name FROM tbl_user_station_dept usd LEFT JOIN tbl_department_station ds ON usd.stat_dept_id=ds.stat_dept_id LEFT JOIN tbl_station_details sd ON ds.station_id=sd.station_id WHERE usd.display='Y' AND ds.display='Y' AND sd.display='Y'");
      if($q->num_rows()>0)
      {
          foreach ($q->result() as $key) 
          {
              $data = [];
              $user_id=$key->user_id;
              $data = array('emp_loc'=>$key->station_name);
              $this->db->where('user_id', $user_id);
              $this->db->update('tbl_employee_creation', $data);
          }
          return $data;
      }
      else
      {
          return false;
      }
    }*/



}// end of model
