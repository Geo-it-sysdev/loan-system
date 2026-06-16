<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_DB_query_builder $db */
class LoginController extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}



	public function login()
	{
		$this->load->view('template/login');
	}



}
