<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	// public function get_users($table1,$table2,$limit = NULL, $offset = NULL, $state)
	// {
	// 	/*$query = $this->db->query("SELECT a.firstname, a.lastname, a.website, a.username, 
	// 								a.email_address, a.status, b.role_desc 
	// 								FROM $table1 as a 
	// 								INNER JOIN $table2 as b 
	// 								on a.role = b.role_id");*/
	// 	if($state=='inactive'):
	// 		$state = 1;
	// 	elseif($state=='active'):
	// 		$state = 2;
	// 	endif;

	// 	$this->db->select('*');
	// 	$this->db->from($table1);
	// 	$this->db->join($table2, 'role = role_id');
	// 	if(isset($state)){
	// 		$this->db->where('status',$state);
	// 	}
	// 	else{
	// 		// no where clause -> get all users
	// 	}
	// 	$this->db->limit($limit, $offset);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	public function get_users($table1, $table2, $state){
		if($state=='inactive'):
			$state = 1;
		elseif($state=='active'):
			$state = 2;
		endif;
		
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, 'role = role_id');
		if(isset($state)){
			$this->db->where('status',$state);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function totalUsers($table)
	{
		return $this->db->count_all_results($table);
	}

	public function view_blog($id,$table)
	{
		$this->db->where('blog_id',$id);
		$query = $this->db->get($table);
		return $query->result();
	}

	public function view_user($id,$table1,$table2)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, 'role = role_id');
		$this->db->where('author_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function view_my_account($username, $table1, $table2)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, 'role = role_id');
		$this->db->where('username',$username);
		$query = $this->db->get();
		return $query->result();
	}

	public function add_user($table,$items)
	{
		$this->db->insert($table,$items);
	}

	public function validate_login($username, $password)
	{
		$this->db->where('username',$this->db->escape_str($username));
		$this->db->where('password',$this->db->escape_str($password));
		$this->db->where('role',2);
		$this->db->where('status',2);
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function check_username($username,$table)
	{
		$this->db->where('username',$username);
		$query = $this->db->get($table);

		if($query->num_rows() > 0)
		{
			//username exists
			return TRUE;

		}
		else
		{
			return FALSE;
		}
	}

	public function update_user($table, $items, $id)
	{
		$this->db->where('author_id',$id);
		$this->db->update($table,$items);
	}

	public function delete_user($id,$table)
	{
		$this->db->where('author_id',$id);
		$this->db->delete($table);
	}

	// ***** A BIT TRICKY ATM, FETCHING ALL ROWS FOR NOW INSTEAD
	function get_active_user_nums($table)
	{
		//$this->db->where('status',2);
		$active_user_num = $this->db->get($table);
		return $active_user_num->num_rows();
	}

	/*function get_inactive_user_nums($table)
	{
		$this->db->where('status',1);
		$inactive_user_num = $this->db->get($table);
		return $inactive_user_num->num_rows();
	}*/

	public function get_messages($table){
		$query = $this->db->order_by('contact_form_id', 'desc');
		$query = $this->db->get($table);
		return $query->result();
	}

	public function view_contact_form_message($id, $table){
		$this->db->where('contact_form_id', $id);
		$query = $this->db->get($table);
		return $query->result();
	}

	public function update_contact_form_message($table, $items, $id){
		$this->db->where('contact_form_id', $id);
		$this->db->update($table, $items);
	}

	public function get_msg_nums($table){
		$this->db->where('status', 1);
		$msg_num = $this->db->get($table);
		return$msg_num->num_rows();
	}
}