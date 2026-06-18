<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_DB_query_builder $db */
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
		$username = trim($this->input->post('username'));
		$password = $this->input->post('password');

		$user = $this->db
		->where('username', $username)
		->get('tbl_collector')
		->row();

		if (!$user || !password_verify($password, $user->password)) {
			$this->session->set_flashdata('error', 'Invalid username or password.');
			redirect('Login');
			return;
		}

		// Create Session
		$this->session->set_userdata([
			'id'         => $user->id,
			'username'   => $user->username,
			'fullname'   => $user->fullname,
			'photo'      => $user->photo,
			'role'       => $user->collector_type,
			'email'      => $user->email,
			'contact_no' => $user->contact_no,
			'logged_in'  => TRUE
		]);

		redirect('Dashboard');
	}

	// 🚪 LOGOUT
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}


	public function update_account()
	{
		if (!$this->session->userdata('logged_in')) {
			echo json_encode([
				'status' => false,
				'message' => 'Unauthorized.'
			]);
			return;
		}

		$id = $this->session->userdata('id');

		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		$confirm  = trim($this->input->post('confirm_password'));

		if (empty($username)) {

			echo json_encode([
				'status' => false,
				'message' => 'Username is required.'
			]);
			return;

		}

		// Check duplicate username
		$exist = $this->db
				->where('username',$username)
				->where('id !=',$id)
				->get('tbl_collector')
				->row();

		if($exist){

			echo json_encode([
				'status'=>false,
				'message'=>'Username already exists.'
			]);
			return;

		}

		$data = [
			'username'=>$username
		];

		// Update password only when entered
		if(!empty($password)){

			if($password != $confirm){

				echo json_encode([
					'status'=>false,
					'message'=>'Password does not match.'
				]);
				return;

			}

			$data['password'] = password_hash($password,PASSWORD_DEFAULT);

		}

		$this->db->where('id',$id);

		if($this->db->update('tbl_collector',$data)){

			// Update session
			$this->session->set_userdata([
				'username'=>$username
			]);

			echo json_encode([
				'status'=>true,
				'message'=>'Account updated successfully.'
			]);

		}else{

			echo json_encode([
				'status'=>false,
				'message'=>'Unable to update account.'
			]);

		}

	}


}