<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dbtest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->_auth();
		//$this->lang->load('site',userLang());
	}
	public function index()
	{	
		//$this->developer();
		//$this->this_project();
		$this->load->view('dbtest/dbtest');
	}
	
}