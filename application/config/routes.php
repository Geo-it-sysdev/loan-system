<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//============================== Start Loan System  =================================\\

// For View files
$route['default_controller']            = 'LoginController/login';
$route['Login']                         = 'LoginController/login';
$route['Dashboard']                     = 'LoanSystem/LoanController/dashboard';
$route['Collector']                     = 'LoanSystem/LoanController/collector';
$route['Interest-Rates']                = 'LoanSystem/LoanController/interest_rates';
$route['Borrowers']                     = 'LoanSystem/LoanController/borrowers';
$route['Loan']                          = 'LoanSystem/LoanController/loan';
$route['Payment']                       = 'LoanSystem/LoanController/payment';
// Reports View
$route['Overdue-Loans']                 = 'LoanSystem/LoanController/overdue_Loans';
$route['Outstanding-Balance']           = 'LoanSystem/LoanController/outstanding_balance';
$route['Payment-Collection']            = 'LoanSystem/LoanController/payment_collection';
$route['Fully-Paid']                    = 'LoanSystem/LoanController/fully_paid';
$route['Loan-Release']                  = 'LoanSystem/LoanController/loan_release';
$route['Monthly-Collection']            = 'LoanSystem/LoanController/monthly_collection';
// Authentication
$route['sign_in']                       = 'LoginController/sign_in';
$route['logout']                        = 'LoginController/logout';
// Dashboard Count
$route['get_dashboard_stats']           = 'LoanSystem/AdminController/get_dashboard_stats';
// Collectors 
$route['get_collectors']                = 'LoanSystem/AdminController/get_collectors';
$route['add_collector']                 = 'LoanSystem/AdminController/add_collector';
$route['update_collector']              = 'LoanSystem/AdminController/update_collector';
$route['delete_collector']              = 'LoanSystem/AdminController/delete_collector';
// Interest Rates 
$route['fetch_interest_rate']           = 'LoanSystem/AdminController/fetch_interest_rate';
$route['add_interest_rate']             = 'LoanSystem/AdminController/add_interest_rate';
$route['delete_interest_rate']          = 'LoanSystem/AdminController/delete_interest_rate';
// Borrowers 
$route['borrower_list']                 = 'LoanSystem/AdminController/borrower_list';
$route['add_borrower']                  = 'LoanSystem/AdminController/add_borrower';
$route['update_borrower']               = 'LoanSystem/AdminController/update_borrower';
$route['delete_borrower']               = 'LoanSystem/AdminController/delete_borrower';
$route['get_borrower']                  = 'LoanSystem/AdminController/get_borrower';
$route['get_municipalities']            = 'LoanSystem/AdminController/get_municipalities';
$route['get_barangays']                 = 'LoanSystem/AdminController/get_barangays';
// Loan
$route['select_borrowers']              = 'LoanSystem/AdminController/select_borrowers';
$route['get_interest_rates']            = 'LoanSystem/AdminController/get_interest_rates';
$route['save_loan']                     = 'LoanSystem/AdminController/save_loan';
$route['get_loans']                     = 'LoanSystem/AdminController/get_loans';
$route['get_loan_details']              = 'LoanSystem/AdminController/get_loan_details';
$route['update_loan']                   = 'LoanSystem/AdminController/update_loan';
$route['delete_loan']                   = 'LoanSystem/AdminController/delete_loan';
// Payment
$route['get_loans_payments']            = 'LoanSystem/AdminController/get_loans_payments';
$route['get_loan_by_refno']             = 'LoanSystem/AdminController/get_loan_by_refno';
$route['release_loan']                   = 'LoanSystem/AdminController/release_loan';
$route['cancelled_loan']                   = 'LoanSystem/AdminController/cancelled_loan';

$route['add_payment']                   = 'LoanSystem/AdminController/add_payment';
$route['fetch_the_collectors']          = 'LoanSystem/AdminController/fetch_the_collectors';
$route['get_payment_history']           = 'LoanSystem/AdminController/get_payment_history';
$route['update_payment']                = 'LoanSystem/AdminController/update_payment';
// All reports 
$route['overdue_loans']                 = 'LoanSystem/ReportController/overdue_loans';
$route['outstanding_loans']             = 'LoanSystem/ReportController/outstanding_loans';
$route['payment_collection']            = 'LoanSystem/ReportController/payment_collection';
$route['fully_paid_loans']              = 'LoanSystem/ReportController/fully_paid_loans';
// Profile
$route['Profile']                       = 'LoanSystem/LoanController/profile';

//=============================== End Loan System  ===================================\\




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
