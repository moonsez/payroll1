<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class New_model extends CI_Model {


	public function fetch_company()
	{
		return $this->db->where('display', 'Y')->select('company_id, company_name')->get('tbl_company_master')->result_array();
	}

	// public function fetchDataForReportRange($start_date, $end_date, $company_id)
	// {		
	//     $query = $this->db->query("
	//         SELECT 
	//             tec.*,
	//             tbp.*,
	//             tbp.emp_id as empl_id,
	//             tu.username,
	//             tad.*,
	//             CONCAT(
	//                 tdm.dept_master_name,
	//                 ' - ',
	//                 tsd.station_name,
	//                 ' [ ',
	//                 tst.station_type_name,
	//                 ' ] '
	//             ) as dept,
	//             (
	//                 SELECT deduct_value 
	//                 FROM tbl_emp_deduct_allowance 
	//                 WHERE emp_id = tbp.emp_id 
	//                 AND deduction_id = 11
	//                 LIMIT 1
	//             ) as insurance_deduct
	//         FROM tbl_basic_pt tbp
	//         JOIN tbl_employee_creation AS tec 
	//             ON tec.emp_id = tbp.emp_id
	//             AND tbp.company_id = ?
	//         LEFT JOIN tbl_userinfo as tu 
	//             ON tu.user_id = tec.user_id 
	//             AND tu.display = 'Y'
	//         LEFT JOIN tbl_user_station_dept as tusd 
	//             ON tusd.usd_id = tu.usd_id 
	//             AND tusd.user_id = tu.user_id
	//         LEFT JOIN tbl_department_station as tds 
	//             ON tusd.stat_dept_id = tds.stat_dept_id 
	//             AND tds.display = 'Y'
	//         LEFT JOIN tbl_department_master as tdm 
	//             ON tdm.dept_master_id = tds.dept_master_id 
	//             AND tdm.display = 'Y'
	//         LEFT JOIN tbl_station_details as tsd 
	//             ON tsd.station_id = tds.station_id 
	//             AND tsd.display = 'Y'
	//         LEFT JOIN tbl_station_type as tst 
	//             ON tst.station_type_id = tsd.station_type_id 
	//             AND tst.display = 'Y'
	//         LEFT JOIN tbl_allowance_details AS tad 
	//             ON tbp.emp_id = tad.emp_id 
	//             AND tbp.salary_month = tad.allowance_sal_date 
	//             AND tbp.company_id = tad.company_id
	//         WHERE 
	//             tbp.work_day != '0.0'
	//             AND tbp.display = 'Y'
	//             AND tbp.company_id = ?
	//             AND STR_TO_DATE(CONCAT('01-', tbp.salary_month), '%d-%m-%Y') 
	//                 BETWEEN STR_TO_DATE(CONCAT('01-', ?), '%d-%m-%Y')
	//                 AND LAST_DAY(STR_TO_DATE(CONCAT('01-', ?), '%d-%m-%Y'))
	//         ORDER BY 
	//             tec.emp_name ASC,
	//             STR_TO_DATE(CONCAT('01-', tbp.salary_month), '%d-%m-%Y') ASC
	//     ", array($company_id, $company_id, $start_date, $end_date));

	//     // echo $this->db->last_query(); exit;

	//     if ($query->num_rows() > 0)
	//     {
	//         $earningData = array();
	//         foreach ($query->result() as $row)
	//         {
	//             $earningData[] = $row;
	//         }
	//         return $earningData;
	//     }
	//     else
	//     {
	//         return false;
	//     }
	// }

	public function fetchDataForReportRange($start_date, $end_date, $company_id)
{        
    $query = $this->db->query("
        SELECT 
            tec.*,
            tbp.*,
            tbp.emp_id as empl_id,
            tu.username,
            tad.*,

            -- ✅ NEW FIELDS START
            tbp.salary_month as report_salary_month,
            DATE_FORMAT(STR_TO_DATE(CONCAT('01-', tbp.salary_month), '%d-%m-%Y'), '%m') as report_month,
            DATE_FORMAT(STR_TO_DATE(CONCAT('01-', tbp.salary_month), '%d-%m-%Y'), '%Y') as report_year,
            DATE_FORMAT(STR_TO_DATE(CONCAT('01-', tbp.salary_month), '%d-%m-%Y'), '%Y-%m-%d') as report_full_date,
            -- ✅ NEW FIELDS END

            CONCAT(
                tdm.dept_master_name,
                ' - ',
                tsd.station_name,
                ' [ ',
                tst.station_type_name,
                ' ] '
            ) as dept,

            (
                SELECT deduct_value 
                FROM tbl_emp_deduct_allowance 
                WHERE emp_id = tbp.emp_id 
                AND deduction_id = 11
                LIMIT 1
            ) as insurance_deduct

        FROM tbl_basic_pt tbp

        JOIN tbl_employee_creation AS tec 
            ON tec.emp_id = tbp.emp_id
            AND tbp.company_id = ?

        LEFT JOIN tbl_userinfo as tu 
            ON tu.user_id = tec.user_id 
            AND tu.display = 'Y'

        LEFT JOIN tbl_user_station_dept as tusd 
            ON tusd.usd_id = tu.usd_id 
            AND tusd.user_id = tu.user_id

        LEFT JOIN tbl_department_station as tds 
            ON tusd.stat_dept_id = tds.stat_dept_id 
            AND tds.display = 'Y'

        LEFT JOIN tbl_department_master as tdm 
            ON tdm.dept_master_id = tds.dept_master_id 
            AND tdm.display = 'Y'

        LEFT JOIN tbl_station_details as tsd 
            ON tsd.station_id = tds.station_id 
            AND tsd.display = 'Y'

        LEFT JOIN tbl_station_type as tst 
            ON tst.station_type_id = tsd.station_type_id 
            AND tst.display = 'Y'

        LEFT JOIN tbl_allowance_details AS tad 
            ON tbp.emp_id = tad.emp_id 
            AND tbp.salary_month = tad.allowance_sal_date 
            AND tbp.company_id = tad.company_id

        WHERE 
            tbp.work_day != '0.0'
            AND tbp.display = 'Y'
            AND tbp.company_id = ?
            AND STR_TO_DATE(CONCAT('01-', tbp.salary_month), '%d-%m-%Y') 
                BETWEEN STR_TO_DATE(CONCAT('01-', ?), '%d-%m-%Y')
                AND LAST_DAY(STR_TO_DATE(CONCAT('01-', ?), '%d-%m-%Y'))

        ORDER BY 
            tec.emp_name ASC,
            STR_TO_DATE(CONCAT('01-', tbp.salary_month), '%d-%m-%Y') ASC

    ", array($company_id, $company_id, $start_date, $end_date));

    if ($query->num_rows() > 0)
    {
        $earningData = array();
        foreach ($query->result() as $row)
        {
            $earningData[] = $row;
        }
        return $earningData;
    }
    else
    {
        return false;
    }
}

public function get_year_wise_report($company_id, $end_month, $start_month)
{	
	// return $this->db
 //    ->where('company_id', $company_id)
 //    ->where('display', 'Y')
 //    ->where("
 //        STR_TO_DATE(CONCAT('01-', salary_month), '%d-%m-%Y') 
 //        BETWEEN STR_TO_DATE(CONCAT('01-', '$start_month'), '%d-%m-%Y')
 //        AND LAST_DAY(STR_TO_DATE(CONCAT('01-', '$end_month'), '%d-%m-%Y'))
 //    ", null, false)
 //    ->select("
 //        *,
 //        LPAD(MONTH(STR_TO_DATE(CONCAT('01-', salary_month), '%d-%m-%Y')), 2, '0') AS report_month,
 //        YEAR(STR_TO_DATE(CONCAT('01-', salary_month), '%d-%m-%Y')) AS report_year
 //    ")
 //    ->group_by(['emp_name','salary_month'])
 //    ->get('tbl_emp_salary_excel_genrated_data')
 //    ->result();
	return $this->db
    ->where('t.company_id', $company_id)
    ->where('t.display', 'Y')
    ->where("
        STR_TO_DATE(CONCAT('01-', t.salary_month), '%d-%m-%Y') 
        BETWEEN STR_TO_DATE(CONCAT('01-', '$start_month'), '%d-%m-%Y')
        AND LAST_DAY(STR_TO_DATE(CONCAT('01-', '$end_month'), '%d-%m-%Y'))
    ", null, false)
    ->select("
        t.*,
        u.username,
        LPAD(MONTH(STR_TO_DATE(CONCAT('01-', t.salary_month), '%d-%m-%Y')), 2, '0') AS report_month,
        YEAR(STR_TO_DATE(CONCAT('01-', t.salary_month), '%d-%m-%Y')) AS report_year
    ")
    ->from('tbl_emp_salary_excel_genrated_data t')
    ->join('tbl_userinfo u', 'u.user_id = t.user_id', 'left')
    ->group_by(['t.emp_name','t.salary_month'])
    ->get()
    ->result();
}
    
	
	
}

