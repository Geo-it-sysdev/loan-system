<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}


	public function login()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('Dashboard');
		}

		$this->load->view('template/login');
	}

	public function sign_in()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tbl_collector', [
			'username' => $username
		])->row();

		if (!$user) {
			$this->session->set_flashdata('error', 'User not found');
			redirect('LoginController/logout');
		}

		if (!password_verify($password, $user->password)) {
			$this->session->set_flashdata('error', 'Wrong password');
			redirect('LoginController/logout');
		}

		// SESSION
		

		$this->session->set_userdata([
			'id'          => $user->id,
			'username'    => $user->username,
			'fullname'    => $user->fullname,
			'photo'       => $user->photo,
			'role'        => $user->collector_type,
			'email'       => $user->email,
			'contact_no'  => $user->contact_no,
			'logged_in'   => true
		]);
		
		redirect('Dashboard');
	}

	// 🚪 LOGOUT
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}