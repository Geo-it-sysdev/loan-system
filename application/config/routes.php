<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//============================== Start Loan System  =================================\\

// For View files
$route['default_controller']            = 'LoginController/login';
$route['Login']                         = 'LoginController/login';
$route['Dashboard']                     = 'LoanController/dashboard';
$route['Collector']                     = 'LoanController/collector';
$route['Interest-Rates']                = 'LoanController/interest_rates';
$route['Borrowers']                     = 'LoanController/borrowers';
$route['Loan']                          = 'LoanController/loan';
$route['Payment']                       = 'LoanController/payment';
// Reports View
$route['Overdue-Loans']                 = 'LoanController/overdue_Loans';
$route['Outstanding-Balance']           = 'LoanController/outstanding_balance';
$route['Payment-Collection']            = 'LoanController/payment_collection';
$route['Fully-Paid']                    = 'LoanController/fully_paid';
$route['Loan-Release']                  = 'LoanController/loan_release';
$route['Monthly-Collection']            = 'LoanController/monthly_collection';
// Authentication
$route['sign_in']                       = 'LoginController/sign_in';
$route['logout']                        = 'LoginController/logout';
// Dashboard Count
$route['get_dashboard_stats']           = 'AdminController/get_dashboard_stats';
$route['get_revenue_chart']             = 'AdminController/get_revenue_chart';
// Collectors 
$route['get_collectors']                = 'AdminController/get_collectors';
$route['add_collector']                 = 'AdminController/add_collector';
$route['update_collector']              = 'AdminController/update_collector';
$route['delete_collector']              = 'AdminController/delete_collector';
// Interest Rates 
$route['fetch_interest_rate']           = 'AdminController/fetch_interest_rate';
$route['add_interest_rate']             = 'AdminController/add_interest_rate';
$route['delete_interest_rate']          = 'AdminController/delete_interest_rate';
// Borrowers 
$route['borrower_list']                 = 'AdminController/borrower_list';
$route['add_borrower']                  = 'AdminController/add_borrower';
$route['update_borrower']               = 'AdminController/update_borrower';
$route['delete_borrower']               = 'AdminController/delete_borrower';
$route['get_borrower']                  = 'AdminController/get_borrower';
$route['get_municipalities']            = 'AdminController/get_municipalities';
$route['get_barangays']                 = 'AdminController/get_barangays';
// Loan
$route['select_borrowers']              = 'AdminController/select_borrowers';
$route['get_interest_rates']            = 'AdminController/get_interest_rates';
$route['save_loan']                     = 'AdminController/save_loan';
$route['get_loans']                     = 'AdminController/get_loans';
$route['get_loan_for_details']          = 'AdminController/get_loan_for_details';
$route['update_loan']                   = 'AdminController/update_loan';
$route['delete_loan']                   = 'AdminController/delete_loan';
// Payment
$route['get_loans_payments']            = 'AdminController/get_loans_payments';
$route['get_loan_by_refno']             = 'AdminController/get_loan_by_refno';
$route['release_loan']                  = 'AdminController/release_loan';
$route['add_payment']                   = 'AdminController/add_payment';
$route['fetch_the_collectors']          = 'AdminController/fetch_the_collectors';
$route['get_payment_history']           = 'AdminController/get_payment_history';
$route['update_payment']                = 'AdminController/update_payment';
// All reports 
$route['overdue_loans']                 = 'ReportController/overdue_loans';
$route['outstanding_loans']             = 'ReportController/outstanding_loans';
$route['payment_collection']            = 'ReportController/payment_collection';
$route['fully_paid_loans']              = 'ReportController/fully_paid_loans';
$route['released_loans']                = 'ReportController/released_loans';
$route['get_loan_details']              = 'ReportController/get_loan_details';
$route['monthly_collection']            = 'ReportController/monthly_collection';
// Profile
$route['Profile']                       = 'LoanController/profile';
//=============================== End Loan System  ===================================\\

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
