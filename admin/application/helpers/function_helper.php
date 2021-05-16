<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	----------------------------------------------------
	**
		supporting methods
	**
	-----------------------------------------------------
*/

	function redirect($url)
	{
		header("location:".SITE_PATH.$url);
	}

	function load_view($controller)
	{
		$this->load->view('header');
		$this->load->view($controller);
		$this->load->view('footer');
	}
	function load_view_args($controller,$args)
	{
		$this->load->view("header");
		$this->load->view($controller,$args);
		$this->load->view("footer");
	}
	function load_view_with_left($controller)
	{
		$this->load->view('header');
		$this->load->view('left');
		$this->load->view($controller);
		$this->load->view('footer');
	}
	function load_view_args_with_left($controller,$args)
	{
		$this->load->view('header');
		$this->load->view('left');
		$this->load->view($controller,$args);
		$this->load->view('footer');
	}
	

?>