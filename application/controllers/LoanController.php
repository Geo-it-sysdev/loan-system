<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_DB_query_builder $db */
class LoanController extends CI_Controller {


	 public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('logged_in')) {
            redirect('LoginController/login');
            exit; 
        }
    }


	public function dashboard()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/dashboard');
		$this->load->view('template/footer');
	}

	public function collector()
	{
		if ($this->session->userdata('role') !== 'Admin') {
			redirect('Dashboard'); 
		}
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('admin/collector');
		$this->load->view('template/footer');
	}

	public function interest_rates()
	{
		if ($this->session->userdata('role') !== 'Admin') {
			redirect('Dashboard'); 
		}
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('admin/interest_rates');
		$this->load->view('template/footer');
	}
	
	public function borrowers()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('admin/borrowers');
		$this->load->view('template/footer');
	}

	public function loan()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('admin/loan');
		$this->load->view('template/footer');
	}

	public function payment()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('admin/payment');
		$this->load->view('template/footer');
	}

	public function overdue_Loans()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('reports/overdue_Loans');
		$this->load->view('template/footer');
	}

	public function outstanding_balance()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('reports/outstanding_balance');
		$this->load->view('template/footer');
	}

	public function payment_collection()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('reports/payment_collection');
		$this->load->view('template/footer');
	}
	public function fully_paid()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('reports/fully_paid');
		$this->load->view('template/footer');
	}

	public function loan_release()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('reports/loan_release');
		$this->load->view('template/footer');
	}

	public function monthly_collection()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('reports/monthly_collection');
		$this->load->view('template/footer');
	}


	public function profile()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/profile');
		$this->load->view('template/footer');
	}




}
