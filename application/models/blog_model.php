<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model{

	public function get_entries($table1, $table2, $limit = NULL, $offset = NULL)
	{
		
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $table1 . '.author_id = ' . $table2 . '.author_id');
		$this->db->order_by('blog_id','DESC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	function get_comments($id, $table1, $table2)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $table1.'.blog_id = '.$table2.'.blog_id');
		$this->db->where($table2.'.blog_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_comment_num($id, $table)
	{
		$this->db->where('blog_id',$id);
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	function insert_comment($table,$items)
	{
		$this->db->insert($table, $items);
	}

	function delete_blog_comment($id,$table)
	{
		$this->db->where('comment_id',$id);
		$this->db->delete($table);
	}

	function totalBlogs($table){
	  return $this->db->count_all_results($table);
	 }

	public function get_entries_by_category($table1, $table2, $id)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $table1 . '.category_id = ' . $table2 . '.category_id');
		$this->db->where('blog.category_id',$id);
		$this->db->order_by('blog_id','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	function get_blog_num_by_author($author, $table1, $table2)
	{
		$get_blog_num = $this->db->query("SELECT a.blog_id, a.title, a.content, b.username
									FROM $table1 AS a
									INNER JOIN $table2 AS b ON a.author_id = b.author_id
									WHERE b.username = '$author' ");
		return $get_blog_num->num_rows();
	}

	public function insert_blog_entry($table,$items)
	{
		$this->db->insert($table,$items);
	}

	public function validate_login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('status',2);
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function get_blog_entries_by_author($author, $table1, $table2)
	{
		$query = $this->db->query("SELECT a.blog_id, a.title, a.content, a.date_of_publish, b.username
									FROM $table1 AS a
									INNER JOIN $table2 AS b ON a.author_id = b.author_id
									WHERE b.username = '$author' ");
		return $query->result();
	}

	public function view_by_id($id, $table1, $table2, $table3)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $table1 . '.author_id = ' . $table2 . '.author_id');
		$this->db->join($table3, $table1 . '.category_id = '. $table3 . '.category_id');
		$this->db->where(array('blog_id' => $id));
		$query = $this->db->get();
		return $query->result();
	}

	public function get_author_name($username, $table)
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$query = $this->db->get($table);
		return $query->result();
	}

	function get_blog_nums($table)
	{
		$blog_num = $this->db->get($table);
		return $blog_num->num_rows();
	}

	function delete_blog($id,$table)
	{
		$this->db->where('blog_id',$id);
		$this->db->delete($table);
	}

	public function get_categories($table)
	{
		$query = $this->db->get($table);
		return $query->result();
	}

	public function add_category($table,$item)
	{
		$query = $this->db->insert($table,$item);
	}

	public function latest_entries($table)
	{
		$this->db->order_by('blog_id DESC');
		$query = $this->db->get($table);
		return $query->result();
	}

	public function insert_contact_form_message($table, $items)
	{
		$this->db->insert($table, $items);
	}

	// UPDATE BLOG
	public function updateBlog($table, $items, $id)
	{
		$this->db->where('blog_id', $id);
		$this->db->update($table,$items);
	}
}