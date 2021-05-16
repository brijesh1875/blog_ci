<?php 
date_default_timezone_set("asia/kolkata");
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontModel extends CI_Model
{

	public function fetch_blog($fields, $where='', $order_by,$order_by_type='ASC')
	{
		// die($order_by_type);
		$this->db->select($fields);
		$this->db->from("post");
		if($where != '')
			$this->db->where($where);
		$this->db->order_by($order_by,$order_by_type);
		$query = $this->db->get();
		return $query->result();
	}
}
?>
