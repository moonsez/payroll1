<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "login_admin";
$route['404_override'] = '';
$route['dashboard'] = 'login_admin/dashboard';
$route['user'] = 'login_admin/load';
$route['login'] = "login_admin/login";

$route['payslip_login/(:any)'] = 'login_admin/payslip/$1';

$route['logout'] = "login_admin/logout";

$route['cnw'] = "welcome/cnw";
//country
$route['country']='master_controller/country';
$route['save_country']='master_controller/saveCountry';
$route['fetch_country'] = 'master_controller/fetchCountry';
$route['edit_country']='master_controller/editCountry';
$route['delete_country']='master_controller/deleteCountry';

//state
$route['state']='master_controller/state';
$route['save_state'] = 'master_controller/saveState';
$route['fetch_state'] = 'master_controller/fetchState';
$route['edit_state'] = 'master_controller/editState';
$route['delete_state']='master_controller/deleteState';

//city
$route['city']='master_controller/city';
$route['save_city'] = 'master_controller/saveCity';
$route['fetch_city'] = 'master_controller/fetchCity';
$route['edit_city'] = 'master_controller/editCity';
$route['delete_city']='master_controller/deleteCity';


$route['fetchAllStateByCountry'] = "master_controller/fetchAllStateByCountryData";
$route['fetchAllCityByState'] = "master_controller/fetchAllCityByStateData";

// change password
$route['change_pwd']='master_controller/changePassword';

// company Creation 
$route['company_creation']='master_controller/companyCreationForm';
$route['save_company']='master_controller/saveCompanyDetails';
$route['fetch_company'] = 'master_controller/fetchCompany';
$route['edit_company'] = 'master_controller/editCompany';
$route['delete_company']='master_controller/deleteCompany';
 
//employee creation 
$route['employee_creation']='master_settings/employeeCreation';
$route['save_employee']='master_settings/saveEmployeeCreation';
$route['fetch_data'] = 'master_settings/fetchEmployeeCreation';
$route['edit_employee'] = 'master_settings/editEmployeeCreation';
//$route['view_employee'] = 'master_settings/viewEmployeeCreation';

$route['updateEmpCreation']='master_settings/update_EmpCreation';

$route['delete_employee']='master_settings/deleteEmployeeCreation';
$route['fetch_employee_by_company'] = "master_controller/fetchAllEmployeeByCompanyData";

//settings
/*$route['settings']='master_settings/masterSetting';
$route['desigData']='master_settings/masterSetting';*/
//earning allowance

$route['earning_allowance']='slip_v/earningAllowance';
$route['save_earning_allowance']='slip_v/saveEarning_allowance';
$route['fetch_earning_allowance'] = 'slip_v/fetchEarning_allowance';
$route['edit_earning_allowance']='slip_v/editEarning_allowance';
$route['delete_earning_allowance']='slip_v/deleteEarning_allowance';

//deduction allowance
 
$route['deduction_allowance']='slip_v/deductionAllowance';
$route['save_deduction_allowance']='slip_v/saveDeduction_allowance';
$route['fetch_deduction_allowance'] ='slip_v/fetchDeduction_allowance';
$route['edit_deduction_allowance']='slip_v/editDeduction_allowance';
$route['delete_deduction_allowance']='slip_v/deleteDeduction_allowance';

//change password  
$route['change_password']='slip_v/change_password'; 
 
//excel for pay slip 
$route['gps'] = "master_settings/generate_pay_slip";
$route['genPdf/:any/:any'] = "payslip_v/generate_pay_slip_PDF/$1/$2";
$route['gef/:any/:any'] = "master_settings/generatePaySlipExcelFunction/$1/$2";

//report generation 
$route['report_pay_slip'] = "master_settings/generate_report"; 
$route['report'] = "master_settings/fetchReportData"; 
// basic salary report 
$route['basic_report_pay_slip'] = "master_settings/generate_basic_report"; 
$route['basic_report'] = "master_settings/fetchBasicReportData"; 
//allowance report salary
$route['allowance_report'] = "master_settings/generate_allowance_report"; 
$route['allowance_report_data'] = "master_settings/fetchAllowanceReportData"; 

//Designation  
$route['dForm'] = "master_settings/designationForm";
$route['save_desig']='master_settings/saveDesignation';
$route['fetch_desig'] = 'master_settings/fetchDesig';
$route['edit_designation']='master_settings/editDesignation';
$route['delete_designation']='master_settings/deleteDesignation';

//Salary 21-6-2014
$route['salary_slip_generate']='master_settings/salarySlipGenerate';
$route['pay_slip_data'] = 'master_settings/paySlipDataDetails';
$route['fetch_slip']='master_settings/fetchAllEmployeeByCompanyData';
 
$route['reprint_pay_slip'] = 'master_settings/reprintPaySlipGenerate';
$route['reprint_pay_slip_data'] = 'master_settings/reprintPaySlipDataTable';
$route['re_print'] = 'master_settings/deletePaySlipData';
$route['advance'] = 'master_settings/advance_view';
$route['save_Advance']='master_settings/saveAdvance';
$route['fetch_advance_data']='master_settings/advancefetch';
$route['delete_advance'] = 'master_settings/delete_advance';

 
$route['fetch_by_employee_name']="slip_v/fetch_by_employee_name";
$route['fetch_by_company_empName']="slip_v/fetch_by_com_empName";
$route['fetch_by_company_empName1']="slip_v/fetch_by_com_empName1";
$route['fetch_all_employee_data']="slip_v/fetch_all_employee_data";
$route['fetchAdminData']="master_settings/fetch_AdminData";

 
 //deletePaySlipData  
$route['generate_report/:any/:any/:any/:any'] = "master_settings/reportPdf/$1/$2/$3/$4";
$route['generate_report1/:any/:any/:any'] = "master_settings/reportPdf/$1/$2/$3";
//$route['']="master_settings/reportPdf";
 
/*word generation for pay slip*/
$route['word_OBC/:any']="controller_pg/word_OBC/$1"; 
$route['word_other_than_OBC/:any']="controller_pg/word_other_than_OBC/$1";
 
//Generate Payslip
$route['generate_excel_report/:any/:any/:any'] = "pay_slip/reportExcel/$1/$2/$3"; 
$route['generate_excel_report1/:any/:any/:any'] = "pay_slip/reportExcel/$1/$2/$3"; 

//allowance excel report
$route['AllowancereportExcel/:any/:any/:any'] = "pay_slip/.AllowancereportExcel1/$1/$2/$3";
//for basic salary report 
$route['basicReportExcel/:any/:any'] = "pay_slip/basicReportExcel1/$1/$2";

/* End of file routes.php */
$route['generate_excel_report_NON_AC/:any/:any/:any'] = "pay_slip/reportExcelWithAcc/$1/$2/$3";

$route['basicReportExcelWithAcc/:any/:any'] = "pay_slip/basicReportExcelWithAcc/$1/$2"; 
 

$route['excelUpload'] = "excelupload/uploadform";
$route['uploadAttend'] = "excelupload/uploadAttendance";
$route['testingpdf'] = "payslip_v/testingpdf"; 
 
//for basic salary generate 
$route['basic_pt'] = "basic_controller/fetchBasicData"; 
$route['basic_salary'] = "basic_controller/basic_view";
$route['basicPt'] = "basic_controller/saveBasicPt"; 
$route['update_net_pay'] = "basic_controller/update_net_pay"; 
  
  
$route['basic_salary_bonus'] = "basic_controller/basic_bonus_view";
$route['basic_bonus_pt'] = "basic_controller/fetchBasicBonusData"; 
$route['basicBonusPt'] = "basic_controller/saveBasicBonusPt";
$route['bonusReport'] = "master_settings/bonusReport";


/********* allowance salary *************************/
$route['allowance_salary'] = "basic_controller/allowance"; 
$route['allowance_cal'] = "basic_controller/calculation";  
$route['allowanceSave'] = "basic_controller/saveAllowance";  
$route['genExpendReport/:any/:any'] = "master_settings/salarySlipReportExcelFormat/$1/$2";
$route['genBonusReport/:any/:any'] = "master_settings/genBonusReport/$1/$2";

$route['genBankLetter/:any/:any'] = "master_settings/genBankLetter/$1/$2";
$route['genTextReport/:any/:any/:any'] = "master_settings/genTextReport/$1/$2/$3";
$route['genPfTextReport/:any/:any/:any'] = "master_settings/genPfTextReport/$1/$2/$3";

$route['expenditureReport'] = "master_settings/reportList";
$route['CompanyWiseReport'] = "master_settings/CompanyWiseReport";
$route['generate_compy_wise_report'] = "master_settings/generate_compy_wise_report";

$route['appExpendReport/:any/:any'] = "master_settings/app_salarySlipReportExcelFormat/$1/$2";
$route['approveExpenditureReport'] = "master_settings/approveExpenditureReport";


$route['approve_salaryslip'] = 'master_settings/approve_salaryslip';
$route['fetch_salaryslip_list'] = 'master_settings/fetch_salaryslip_list';
$route['update_salaryslip_status'] = 'master_settings/update_salaryslip_status';

$route['approve_paid_leave'] = 'master_settings/approve_paid_leave';
$route['fetch_emp_list'] = 'master_settings/fetch_emp_list';
$route['leave_model'] = 'master_settings/leave_model';
$route['update_leaves'] = 'master_settings/update_leaves';

$route['payslip_report'] = 'master_settings/payslip_report';
$route['fetch_emp_by_company'] = 'master_settings/fetch_emp_by_company';
$route['fetch_allowance_by_emp'] = 'master_settings/fetch_allowance_by_emp';
$route['generate_payslip_report'] = 'master_settings/generate_payslip_report';

$route['register_of_wages'] = 'master_settings/register_of_wages';
$route['gen_register_of_wages_report'] = 'master_settings/gen_register_of_wages_report';

$route['muster_wage_register'] = 'master_settings/muster_wage_register';
$route['gen_muster_wage_register'] = 'master_settings/gen_muster_wage_register';

$route['leave_wages_register'] = 'master_settings/leave_wages_register';
$route['gen_leave_wages_register'] = 'master_settings/gen_leave_wages_register';

$route['advance_register'] = 'master_settings/advance_register';
$route['gen_advance_register'] = 'master_settings/gen_advance_register';

$route['deduction_register'] = 'master_settings/deduction_register';
$route['gen_deduction_register'] = 'master_settings/gen_deduction_register';

$route['overtime_register'] = 'master_settings/overtime_register';
$route['gen_overtime_register'] = 'master_settings/gen_overtime_register';

$route['fines_register'] = 'master_settings/fines_register';
$route['gen_fines_register'] = 'master_settings/gen_fines_register';

$route['get_total_salary'] = 'master_settings/get_total_salary';
$route['get_total_emp'] = 'master_settings/get_total_emp';

$route['approve_salary_str'] = 'master_settings/approve_salary_str';
$route['approve_salary_model'] = 'master_settings/approve_salary_model';
$route['save_salary_str'] = 'master_settings/save_salary_str';

$route['emp_salary_report'] = "master_settings/emp_salary_report";
$route['gen_emp_salary_report'] = "master_settings/gen_emp_salary_report";

$route['employee_register'] = "master_settings/employee_register";
$route['gen_employee_register'] = 'master_settings/gen_employee_register';

$route['update_advance'] = 'master_settings/update_advance';
$route['update_advance_str'] = 'master_settings/update_advance_str';
$route['delete_salary'] = 'master_settings/delete_salary';

$route['update_da_backend'] = 'basic_controller/update_da_backend';


$route['employee_advance_report'] = 'master_settings/employee_advance_report';
$route['gen_employee_advance_details'] = 'master_settings/gen_employee_advance_details';

$route['local_exp'] = 'master_settings/local_exp';
$route['save_Exp'] = 'master_settings/save_Exp';
$route['exp_view_tbl'] = 'master_settings/exp_view_tbl';
/* Location: ./application/config/routes.php */