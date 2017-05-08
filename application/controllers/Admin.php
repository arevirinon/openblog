<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	protected $contactTable = 'contact_form';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('user_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$data['active'] = 'menu1';
			$data['main_content'] = 'admin_views/index_view';
			$data['query'] = $this->blog_model->get_entries('blog','users');
			// for badges in dashboard
			$data['blog_num'] = $this->blog_model->get_blog_nums('blog');
			$data['active_user_num'] = $this->user_model->get_active_user_nums('users');
			$data['msg_num'] = $this->user_model->get_msg_nums($this->contactTable);
			//$data['inactive_user_num'] = $this->user_model->get_inactive_user_nums('users');
			$this->load->view('admin_includes/template',$data);
		}
		else
		{
			$this->login();
		}
	}

	public function login()
	{
		$data['title'] = 'Welcome to OpenBlog';
		$data['main_content'] = 'admin_views/login_form';
		$this->load->view('admin_includes/login',$data);
	}

	public function validate_login()
	{
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			$query = $this->user_model->validate_login($username, $password);

			if($query == 1)
			{
				$data = array(
						'username' => $this->input->post('username'),
						'is_logged_in' => 1,
						'is_logged_in_admin' => TRUE
					);
				$this->session->set_userdata($data);
				echo 'YES';
			}
			else
			{
				echo 'NO';
			}
		}
	
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/index/');
	}

	public function blogs()
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$data['active'] = 'menu2';
			$data['main_content'] = 'admin_views/blog_list_view';
			$data['query'] = $this->blog_model->get_entries('blog','users');
			$this->load->view('admin_includes/template',$data);
		}
		else
		{
			$this->login();
		}
	}

	public function users($offset = 0, $state = NULL)
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			/*$config['total_rows'] = $this->user_model->totalUsers('users');
			$config['base_url'] = base_url('admin/users');
		 	$config['per_page'] = 3;
	 		$config['uri_segment'] = '3';

	 		$config['full_tag_open'] = '<ul class="pagination">';
     		$config['full_tag_close'] = '</ul>';
     		$config['first_link'] = false;
     		$config['last_link'] = false;
     		$config['first_tag_open'] = '<li>';
     		$config['first_tag_close'] = '</li>';
     		$config['prev_link'] = '&laquo';
     		$config['prev_tag_open'] = '<li class="prev">';
     		$config['prev_tag_close'] = '</li>';
     		$config['next_link'] = '&raquo';
     		$config['next_tag_open'] = '<li>';
     		$config['next_tag_close'] = '</li>';
     		$config['last_tag_open'] = '<li>';
     		$config['last_tag_close'] = '</li>';
     		$config['cur_tag_open'] = '<li class="active"><a href="#">';
     		$config['cur_tag_close'] = '</a></li>';
     		$config['num_tag_open'] = '<li>';
     		$config['num_tag_close'] = '</li>';*/

     		//$this->pagination->initialize($config);

			$data['active'] = 'menu3';
			//$data['query'] = $this->user_model->get_users('users','role_tbl', 3 , $this->uri->segment(3), $state);
			$data['query'] = $this->user_model->get_users('users', 'role_tbl', $state);
			$data['main_content'] = 'admin_views/users_view';
			$this->load->view('admin_includes/template',$data);
		}
		else
		{
			$this->login();
		}
	}


	public function add_user()
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			// set validation rules
			$this->form_validation->set_rules('firstname', 'First Name', 
				'trim|required');
			$this->form_validation->set_rules('lastname', 'Last Name', 
				'trim|required');
			$this->form_validation->set_rules('email_address', 'Email Address', 
				'trim|required|valid_email');
			$this->form_validation->set_rules('username', 'Username', 
				'trim|required|callback_username_not_exists');
			$this->form_validation->set_rules('password1', 'Password', 
				'trim|required');
			$this->form_validation->set_rules('password2', 'Password Confirmation', 
				'trim|required|matches[password1]');

			// run validation check
			if($this->form_validation->run() == FALSE)
			{
				// validation fails
				echo validation_errors();
			}
			else
			{
				$items = array(
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'username' => $this->input->post('username'),
						'password' => md5($this->input->post('password1')),
						'email_address' => $this->input->post('email_address'),
						'website' => $this->input->post('website'),
						'role' => $this->input->post('role'),
						'status' => $this->input->post('status')
					);
				$data['query'] = $this->user_model->add_user('users',$items);
				echo "YES";
			}
		}
		else
		{
			$this->login();
		}
	}

	public function username_not_exists($username)
	{
		$this->form_validation->set_message('username_not_exists','Username already exists!');

		if($this->user_model->check_username($username,'users'))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function view_user($id)
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$data['query'] = $this->user_model->view_user($id,'users','role_tbl');
			$data['main_content'] = 'admin_views/specific_user_view';
			$this->load->view('admin_includes/template',$data);
		}
		else
		{
			$this->login();
		}

	}

	public function viewblog($id)
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$data['query'] = $this->user_model->view_blog($id,'blog');
			$this->load->view('admin_views/blog_view',$data);
		}
		else
		{
			$this->login();
		}
	}

	public function update_user()
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[4]');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');

			if($this->form_validation->run() == FALSE)
			{
				echo '<div class="alert alert-danger text-center">' . validation_errors() . '</div>';
			}
			else
			{
				$items = array(
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'username' => $this->input->post('username'),
						'email_address' => $this->input->post('email_address'),
						'website' => $this->input->post('website'),
						'role' => $this->input->post('role'),
						'status' => $this->input->post('status')
					);
				$data['query'] = $this->user_model->update_user('users',$items,$this->input->post('author_id'));
				echo "YES";			
			}
		}
		else
		{
			$this->login();
		}
	}

	public function delete_user($id)
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$this->user_model->delete_user($id,'users');
			redirect('admin/users');
		}
		else
		{
			$this->login();
		}
	}

	public function delete_blog($id)
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$this->blog_model->delete_blog($id,'blog');
			redirect('admin/blogs');
		}
		else
		{
			$this->login();
		}
	}

	public function account($username)
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$data['active'] = 'menu4';
			$data['main_content'] = 'admin_views/my_account_view';
			$data['my_blog_posts'] = $this->blog_model->get_blog_num_by_author($this->session->userdata('username'),'blog','users');
			$data['query'] = $this->user_model->view_my_account($username,'users','role_tbl','blog');
			$this->load->view('admin_includes/template',$data);
		}
		else
		{
			$this->login();
		}
	}

	public function view_category()
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$data['active'] = 'menu5';
			$data['main_content'] = 'admin_views/category_view';
			$data['query'] = $this->blog_model->get_categories('blog_category');
			$this->load->view('admin_includes/template',$data);
		}
		else
		{
			$this->login();
		}
	}

	public function add_category()
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$this->form_validation->set_rules('categoryDesc','Category Name','trim|required|min_length[4]');
			
			if($this->form_validation->run() == FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$items = array('category_desc' => ucfirst($this->input->post('categoryDesc')));
				$this->blog_model->add_category('blog_category',$items);
				echo 'YES';
			}
		}	
		else
		{
			$this->login();
		}		
	}

	public function blogcomments($id = NULL)
	{
		if($this->session->userdata('is_logged_in_admin') == 1)
		{
			$data['main_content'] = 'admin_views/blog_comments_view';
			$data['query'] = $this->blog_model->get_comments($id, 'blog', 'blog_comments');
			$this->load->view('admin_includes/template',$data);
			//$this->load->view('admin_views/blog_comments_view', $data);
		}
		else
		{
			$this->login();
		}
	}

	function delete_blog_comment($id)
	{
		$this->blog_model->delete_blog_comment($id,'blog_comments');
		echo "Success";

	}


	public function view_messages(){
		if($this->session->userdata('is_logged_in_admin') == 1){
			// get total unread message
			$data['msg_num'] = $this->user_model->get_msg_nums($this->contactTable);

			$data['active'] = 'menu6';
			$data['main_content'] = 'admin_views/messages_view';
			$data['query'] = $this->user_model->get_messages($this->contactTable);
			$this->load->view('admin_includes/template',$data);
		}
		else{
			$this->login();
		}
	}

	public function view_form_message($id){
		$data['main_content'] = 'admin_views/contactform_msg_view';
		$data['query'] = $this->user_model->view_contact_form_message($id, $this->contactTable);
		$this->load->view("admin_includes/template", $data);
	}

	public function update_form_message(){
		$items = array(
				'status' => $this->input->post('status')
			);
		$data['query'] = $this->user_model->update_contact_form_message($this->contactTable, $items, $this->input->post('contact_form_id'));
		redirect('Admin/view_messages');
	}

	public function saveProfile(){
		$uid = $this->input->post('author_id');

		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');	

		if($this->form_validation->run() == FALSE){
			echo validation_errors();
		}
		else{
			$items = array(
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email_address' => $this->input->post('email_address'),
				'website' => $this->input->post('website'),
				);

			$this->user_model->update_user('users', $items, $uid);
			echo "UPDATED";			
		}
	}


}