<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('frontmodel');
		// parent::__construct();
		// $this->load->library('session');
	}

/*
	----------------------------------------------------
	**
		supporting methods
	**
	-----------------------------------------------------
*/


	private function redirect($url)
	{
		header("location:".SITE_PATH.$url);
	}

	private function load_view($controller)
	{
		$this->load->view('header');
		$this->load->view($controller);
		$this->load->view('footer');
	}
	private function load_view_args($controller,$args)
	{
		$this->load->view("header");
		$this->load->view($controller,$args);
		$this->load->view("footer");
	}
	private function load_view_with_left($controller)
	{
		$this->load->view('header');
		$this->load->view('left');
		$this->load->view($controller);
		$this->load->view('footer');
	}
	private function load_view_args_with_left($controller,$args)
	{
		$this->load->view('header');
		$this->load->view('left');
		$this->load->view($controller,$args);
		$this->load->view('footer');
	}
	private function validate_session()
	{
		if(!$this->session->has_userdata('IS_LOGIN'))
		{
			$this->load_view('login');
		}
		else
		{
			return true;
		}
	}
	private function char_limit($str,$limit='200')
	{
		if(strlen($str) > 200)
		{
			return substr($str,0,$limit)."...";
		}
	}
	private function date_convert($date)
	{
		$time = strtotime($date);
		return date("l d, Y",$time);
	}
	


/*
	----------------------------------------------------
	**
		Controllers Method
	**
	-----------------------------------------------------
*/
	public function index()
	{
		$posts= $this->frontmodel->fetch_blog("id, title, description, added_on",['status'=>1], 'added_on', 'DESC');
		foreach($posts as $post)
		{
			$limited = $this->char_limit($post->description,150);
			$post->description = $limited;
			$strdate = $this->date_convert($post->added_on);
			$post->added_on = $strdate;
		}

		$data['posts']=$posts;
		$this->load_view_args("home",$data);
	}
	public function home()
	{

		$posts= $this->frontmodel->fetch_blog("id, title, description, added_on",['status'=>1], 'added_on', 'DESC');
		foreach($posts as $post)
		{
			$limited = $this->char_limit($post->description,150);
			$post->description = $limited;
			$strdate = $this->date_convert($post->added_on);
			$post->added_on = $strdate;
		}

		$data['posts']=$posts;
		$this->load_view_args("home",$data);	
	}
	public function about()
	{
		$this->load_view("about");
	}
	public function post($id='')
	{
		if($id=='')
		{
			$this->redirect("home");
		}
		else
		{
			$post = $this->frontmodel->fetch_blog("*",["id"=>$id]);
			$strdate = $this->date_convert($post[0]->added_on);
			$post[0]->added_on = $strdate;

			$data['post'] = $post;
			$this->load_view_args("post",$data);
		}
	}
	public function contact()
	{
		$this->load_view("contact");
	}
}

