<?php 
date_default_timezone_set("asia/kolkata");
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{

	public function auth_user($username,$pass)
	{
		$this->db->select('id, status');
		$this->db->from('admin_user');
		$this->db->where('username',$username);
		$this->db->where('pass',$pass);
		$query=$this->db->get();
		return json_encode($query->result());
	}
	public function insert_category($name)
	{
		$field=array(
			"category_name"=>$name,
			"status" => 0,
			"added_on" => date("Y-m-d H:i:s")
		);
		$this->db->insert("category",$field);
		return true;
	}
	public function insert($table,$fields)
	{
		if($this->db->insert($table,$fields))
			return true;
		else
			return false;

	}
	public function fetch_all($table)
	{
		$query=$this->db->get($table);
		return $query->result();
	}
	public function update_status($table,$status,$id)
	{
		$this->db->set('status', $status);
		$this->db->where('id', $id);
		$this->db->update($table);
		return true;
	}
	public function delete_record($table,$id)
	{
		$this->db->delete($table,["id"=>$id]);
		return true;
	}

	public function fetch_data($table,$where,...$fields)
	{
		$field='';
		if(count($fields) > 0)
		{
			for($i=0; $i<count($fields); $i++)
			{
				$field.=$fields[$i].", ";
			}
			$field=rtrim($field,", ");
		}
		else
		{
			$field='*';
		}
		$this->db->select($field);
		$this->db->from($table);
		$this->db->where($where);
		$query=$this->db->get();
		return $query->result();
	}
	public function update_data($table, $where, $fields)
	{   
		$this->db->where($where);
		if($this->db->update($table, $fields))
			return true;
		else
			return false;
	}

	public function fetch_all_with_joins($prefrences)
	{
		$table = $prefrences['table'];
		$table = str_replace(" ", "", $table);
		$table_list=explode(",",$table);

		$data=$this->db->select($prefrences['fields'])->from($table_list[0])->join($table_list[1],$prefrences['join_condition'], $prefrences['join_type'])->get()->result();

		return $data;
	}
}
?>
