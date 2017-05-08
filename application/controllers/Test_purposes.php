<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_purposes extends CI_Controller{

	public function test()
	{
		$data['main_content'] = 'test_views/ajax_test_view';
		$this->load->view('public_includes/template',$data);
	}

	public function ajaxtest()
	{
		$fullname = $this->input->post('fullname');
		if($fullname != "")
		{
			echo 'You typed: <b>'.$fullname.'</b>';
		}
		else
		{
			echo 'You didn\'t type anything!';
		}
	}

	public function hello()
	{
		echo 'hello';
	}


}