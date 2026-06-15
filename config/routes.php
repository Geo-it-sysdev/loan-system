<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Auth_ctrl login
$route['default_controller'] = 'Auth_ctrl/login2'; 
$route['auth/login'] = 'Auth_ctrl/login';      
$route['auth/logout'] = 'Auth_ctrl/logout';    
$route['auth/login2'] = 'Auth_ctrl/login2';    


// $route['default_controller']
$route['PO_ctrl'] = 'PO_ctrl/Po_monitoring';
$route['Po_monitoring'] = 'PO_ctrl/Po_monitoring';  

// Routes for Purchasing (Pending PO Logs)
$route['PO_ctrl/purchasing'] = 'PO_ctrl/purchasing';
$route['pendingPOTable'] = 'PO_ctrl/get_po_logs';  
$route['logs'] = 'PO_ctrl/get_po_logs'; 
$route['pending_po_log/update'] = 'PO_ctrl/update_shipping'; 

// Routes for Delivery Schedule (under PO_ctrl)
$route['PO_ctrl/get_delivery_logs'] = 'PO_ctrl/get_delivery_logs';  
$route['PO_ctrl/fetch_delivery_logs'] = 'PO_ctrl/fetch_delivery_logs'; 
$route['PO_ctrl/fetch_history_logs'] = 'PO_ctrl/fetch_history_logs';


// Routes for cdc mis data (under PO_ctrl)
$route['PO_ctrl/get_cdc_mis_data_log'] = 'PO_ctrl/get_cdc_mis_data_log';
$route['PO_ctrl/fetch_cdc_mis_data'] = 'PO_ctrl/fetch_cdc_mis_data';

// Routes for pricing (under PO_ctrl)
$route['PO_ctrl/get_pricing_log'] = 'PO_ctrl/get_pricing_log';
$route['PO_ctrl/fetch_pricing_data'] = 'PO_ctrl/fetch_pricing_data';

// Routes for PI (under PO_ctrl)
$route['PO_ctrl/get_pi_log'] = 'PO_ctrl/get_pi_log';
$route['PO_ctrl/fetch_pi_data'] = 'PO_ctrl/fetch_pi_data';

// Routes for AP Monitoring (under PO_ctrl)
$route['PO_ctrl/get_ap_log'] = 'PO_ctrl/get_ap_log';
$route['PO_ctrl/fetch_ap_data'] = 'PO_ctrl/fetch_ap_data';

// Routes for Uploading (under PO_ctrl)
$route['PO_ctrl/get_uploading'] = 'PO_ctrl/get_uploading';
$route['PO_ctrl/get_sop_uploading'] = 'PO_ctrl/get_sop_uploading';



// Admin_Routes //
$route['Admin_ctrl/admin'] = 'Admin_ctrl/admin';
$route['Admin_ctrl/users'] = 'Admin_ctrl/users';


// Other Routes
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


