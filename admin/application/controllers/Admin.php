<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('adminmodel');
		parent::__construct();
		$this->load->library('session');
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

	private function file_name_generator($file_name)
	{
		$file_name=str_replace(' ', "_",$file_name);
		$file_name=str_replace("-","_",$file_name);
		$file_name=str_replace(",","_",$file_name);
		$file_name=str_replace("'","_",$file_name);
		$file_name=str_replace('"',"_",$file_name);
		$file_name=date("j_m_y_his").$file_name;
		$file_name="CI_BLOG".$file_name;
		return $file_name;
	}

	// private function insert_newline($str)
	// {
	// 	$str=str_replace("\n", "</p><p>", $str);
	// 	$str=$str."</p>";
	// 	return "<p>".$str;
	// }
	
	// private function remove_new_line($str)
	// {
	// 	$str=str_re
	// }


/*
	----------------------------------------------------
	**
		Controllers Method
	**
	-----------------------------------------------------
*/
	public function index()
	{	
		if($this->validate_session())
			$this->redirect("post");
	}

	public function login()
	{
		if($this->validate_session())
			$this->redirect("post");
	}

	public function auth_user()
	{
		$username = $this->input->post('username');
		$pass=$this->input->post('password');
		$res=json_decode($this->adminmodel->auth_user($username,$pass));
		if(isset($res['0']))
		{
			// die($res[0]->status);
			if($res[0]->status==1)
			{
				$this->session->set_userdata('IS_LOGIN', true);
				$this->redirect('post');
			}
			else
			{
				$arr=array("status_code"=>403);
				$this->load_view_args("login",$arr);
			}
		}
		else
		{
			$arr=array("status_code"=>404);
			$this->load_view_args("login",$arr);
		}

	}
	public function logout()
	{
		$this->session->unset_userdata('IS_LOGIN');
		$this->redirect("login");
	}

	public function category()
	{	
		if($this->validate_session())
		{
			$arr['data']=$this->adminmodel->fetch_all("category");
			if(isset($arr['data'][0]))
				$this->load_view_args_with_left('category',$arr);
			
			else
				$this->load_view_with_left('category');
		}
	}

	public function post()
	{
		if($this->validate_session())
		{
			$pref=array(
				"table"=>"post, category",
				"fields"=>"post.*, category.category_name",
				"join_type"=>"left",
				"join_condition"=>"post.cat_id=category.id"
			);
			$data['data']=$this->adminmodel->fetch_all_with_joins($pref);
			if(isset($data['data'][0]))
				$this->load_view_args_with_left('post',$data);
			else
				$this->load_view_with_left('post');
		}
	}

	public function add_post($id='')
	{
		if($this->validate_session())
		{
			$result=$this->adminmodel->fetch_data("category",['status'=>1],"id","category_name");
			if($id != '')
			{
				$post_data=$this->adminmodel->fetch_data("post",['id'=>$id]);
				$data=array(
					"category_name"=>$result,
					"id" => $post_data[0]->id,
					"cat_id" => $post_data[0]->cat_id,
					"title" => $post_data[0]->title,
					"img" => $post_data[0]->image,
					"description" => $post_data[0]->description,
					"section" => "Edit",
					"error" => ""
				);
				// echo "<pre>";
				// print_r($data);
				// die();
			}
			else
			{ 
				$data=array(
					"category_name"=>$result,
					"id" => '',
					"cat_id" => '',
					"title" => '',
					"img" => '',
					"description" => '',
					"section" => "Add",
					"error" => ""
				);
			}
			$this->load_view_args_with_left('add_post',$data);
		}
	}

	public function add_category($id='')
	{
		if($this->validate_session())
		{
			if($id != '')
			{
				$result=$this->adminmodel->fetch_data("category",['id'=>$id],"id","category_name");
				$data=array(
					"category_name" => $result[0]->category_name,
					"id" => $result[0]->id,
					"section" => "Edit"
				);
			}
			else
			{ 
				$data=array(
					"category_name" => '',
					"id" => '',
					"section" => "Add"
				);
			}
			$this->load_view_args_with_left('add_category',$data);	

		}
	}


	public function insert_category()
	{
		if($this->validate_session())
		{
			if($this->input->post('id'))
			{
				if($this->adminmodel->update_data("category",["id"=>$this->input->post('id')],["category_name"=>$this->input->post('name')]))
					$this->redirect("category");
			}
			else
			{
				if($this->adminmodel->insert_category($this->input->post("name")))
				{
					$this->redirect("category");
				}
				else
				{
					die("ERROR : Unable to insert");
				}
			}
		}
	}

	public function insert_post()
	{
		if($this->validate_session())
		{
			if($this->input->post('id'))
			{

				if($_FILES['img']['name'] !='')
				{
					$post=$this->adminmodel->fetch_data("post",['id' => $this->input->post("id")],'image');
					if(unlink(IMAGE.$post[0]->image))
					{
						$config=[
							"upload_path" => IMAGE_PATH.'uploads/',
							"allowed_types" => "gif|jpg|jpeg|png|svg",
							"file_name" => $this->file_name_generator($_FILES['img']['name'])
						];
				         $this->load->library("upload",$config);
				         if(!$this->upload->do_upload('img'))
				         {
				         	$error = array("error"=>$this->upload->display_errors());
				         	$this->load_view_args_with_left("add_post",$error);
				         }
				        else
				        {
				         	$success=$this->upload->data();
				         	$update_field_details=[
				         		"title"=>$this->input->post("title"),
				         		"cat_id"=>$this->input->post("category_id"),
				         		"description"=>$this->input->post("description"),
				         		"image"=>$success['file_name']
				         	];
				         	if($this->adminmodel->update_data("post",["id"=>$this->input->post("id")],$update_field_details))
				         	{
				         		$this->redirect("post");
				         	}
				        }
					}

				}
				else
				{
					$update_field_detail = array(
						"title"=>$this->input->post("title"),
		         		"cat_id"=>$this->input->post("category_id"),
		         		"description"=>$this->$this->input->post("description")
		         	);
		         	// print_r($update_field_detail);	
		         	// die();
					if($this->adminmodel->update_data("post",["id" => $this->input->post("id")], $update_field_detail))	
					{
						$this->redirect("post");
					}
				}
			}
			else
			{
				$config=[
					"upload_path" => IMAGE_PATH.'uploads/',
					"allowed_types" => "gif|jpg|jpeg|png|svg",
					"file_name" => $this->file_name_generator($_FILES['img']['name'])
				];
		         $this->load->library("upload",$config);
		         if(!$this->upload->do_upload('img'))
		         {
		         	$error = array("error"=>$this->upload->display_errors());
		         	$this->load_view_args_with_left("add_post",$error);
		         }
		         else
		         {
		         	$success=$this->upload->data();
		         	$fields=[
		         		"title"=>$this->input->post("title"),
		         		"cat_id"=>$this->input->post("category_id"),
		         		"description"=>$this->input->post("description"),
		         		"image"=>$success['file_name'],
		         		"status"=>0,
		         		"added_on" => date("Y-m-d H:i:s")
		         	];
		         	if($this->adminmodel->insert("post",$fields))
		         	{
		         		$this->redirect("post");
		         	}
		         }
			}
		}
	}

	public function update_status($table,$status,$id)
	{
		if($this->validate_session())
		{
			if($this->adminmodel->update_status($table,$status,$id))
				$this->redirect($table);
		}
	}

	public function delete_category($table, $id, $img='false')
	{
		if($img == 'true')
		{
			$post=$this->adminmodel->fetch_data($table,['id' => $id],'image');
			if(unlink(IMAGE.$post[0]->image))
				$this->adminmodel->delete_record($table,$id);
		}
		else
		{
			$this->adminmodel->delete_record($table,$id);
		}
		$this->redirect($table);

	}
}

