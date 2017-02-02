<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index()
	{
		$data['app_title']='Title';
		$this->load->view('inc/header',$data);
		$this->load->view('pages/index',$data);
		$this->load->view('inc/footer',$data);
	}
	
	public function new_report()
	{
		$data['app_title']='Add Daily Report';
		$this->load->view('inc/header',$data);
		$this->load->view('pages/report_new',$data);
		$this->load->view('inc/footer',$data);
	}
}