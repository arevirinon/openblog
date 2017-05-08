<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_site extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('user_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		 $data['active'] = 'menu1';
		 $data['title'] = 'Welcome to OpenBlog';
		 $this->load->view("public_views/splash_view", $data);
	}

	public function blogs($offset = 0)
	{
		$config['total_rows'] = $this->blog_model->totalBlogs('blog');
  
		 $config['base_url'] = base_url('public_site/blogs');
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
         $config['num_tag_close'] = '</li>';

		 $this->pagination->initialize($config);

		$data['active'] = 'menu5';
		$data['title'] = 'OpenBlog Entries';
		$data['query'] = $this->blog_model->get_entries('blog', 'users', 3, $this->uri->segment(3));
		$data['main_content'] = 'public_views/index_view';
		$this->load->view('public_includes/template',$data);
	}

	public function blog($id)
	{
		$data['title'] = 'OpenBlog';
		$data['query'] = $this->blog_model->view_by_id($id,'blog','users','blog_category');
		$data['comments'] = $this->blog_model->get_comments($id, 'blog', 'blog_comments');
		$data['get_comment_num'] = $this->blog_model->get_comment_num($id,'blog_comments');
		$data['main_content'] = 'public_views/blog_view';
		$this->load->view('public_includes/template',$data);
	}

	public function blog_edit($id)
	{
		$data['title'] = "Edit Blog Post";
		$data['query'] = $this->blog_model->view_by_id($id,'blog','users','blog_category');
		$data['main_content'] = 'public_views/blog_edit_view';
		$this->load->view('public_includes/template', $data);
	}

	public function blog_updated()
	{
		$this->form_validation->set_rules('blogtitle','Title','trim|required');
		$this->form_validation->set_rules('blog_content','Content','trim|required');
		$uid = $this->input->post('blog_id');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$items = array(
				'title' => $this->input->post('blogtitle'),
				'content' => $this->input->post('blog_content'),
				'author_id' => $this->input->post('author_id'),
				'category_id' => $this->input->post('category')
				);
			$this->blog_model->updateBlog('blog', $items, $uid);
			echo 'ADDED';
		}
	}

	function blog_comment_submit()
	{
		$this->form_validation->set_rules('comment_username','Name/Username','trim|required');
		$this->form_validation->set_rules('comment_text','Comment','required');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$items = array(
				'blog_id' => $this->input->post('blog_id'),
				'comment_username' => $this->input->post('comment_username'),
				'comment_text' => $this->input->post('comment_text'),
				'comment_date' => $this->input->post('comment_date')
				);

			$this->blog_model->insert_comment('blog_comments',$items);
			echo 'COMMENTSUBMIT';
		}
	}

	public function validate_login()
	{
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 
			'trim|required');
		$this->form_validation->set_rules('password', 'Password', 
			'trim|required');

		// run validation check
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$username = $this->input->post("username");
        	$password = md5($this->input->post("password"));

        	$query = $this->blog_model->validate_login($username, $password);

        	if($query == 1)
        	{
        		$data = array(
        					'username' => $this->input->post('username'),
        					'is_logged_in' => TRUE
        			);
        		$this->session->set_userdata($data);
        		echo 'YES';
        	}
        	else
        	{
        		echo 'Wrong username/password combination!';
        	}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Public_site/');
	}

	public function about()
	{
		$data['title'] = 'About | OpenBlog';
		$data['active'] = 'menu3';
		$data['main_content'] = 'public_views/about_view';
		$this->load->view('public_includes/template',$data);
	}

	public function authors() 
	{
		if($this->session->userdata('is_logged_in') == 1):
			$data['title'] = 'Welcome to Authors Page';
			$data['query'] = $this->blog_model->get_blog_entries_by_author($this->session->userdata('username'),'blog','users');
			$data['get_blog_num'] = $this->blog_model->get_blog_num_by_author($this->session->userdata('username'),'blog','users');
			$data['profile'] = $this->user_model->view_my_account($this->session->userdata('username'), 'users', 'role_tbl');
			$data['main_content'] = 'public_views/authors_view';
			$this->load->view('public_includes/template',$data);
		else:
			show_404();
		endif;
	}

	public function add_entry()
	{
		if($this->session->userdata('is_logged_in') == 1):
			$data['title'] = 'New Blog Post | OpenBlog';
			$data['main_content'] = 'public_views/add_blog_view';
			$data['categoryList'] = $this->blog_model->get_categories('blog_category');
			$data['query'] = $this->blog_model->get_author_name($this->session->userdata('username'),'users');
			$this->load->view('public_includes/template',$data);
		else:
			show_404();
		endif;
	}

	public function blog_added()
	{
		$this->form_validation->set_rules('title','Title','trim|required|min_length[5]');
		$this->form_validation->set_rules('blog_content','Content','required|min_length[15]');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$items = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('blog_content'),
				'date_of_publish' => $this->input->post('date_of_publish'),
				'author_id' => $this->input->post('author_id'),
				'category_id' => $this->input->post('category_id')
			);
			$this->blog_model->insert_blog_entry('blog',$items);
			echo 'ADDED';
		}
	
	}

	public function register()
	{
		$data['main_content'] = 'public_views/register_view';
		$data['title'] = 'Register to OpenBlog';
		$this->load->view('public_includes/template',$data);
	}

	public function register_submit()
	{
		// set validation
		$this->form_validation->set_rules('rfirstname', 'First Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('rlastname', 'Last Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('remail_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('rusername', 'Username', 'trim|required|min_length[4]|callback_username_not_exists');
		$this->form_validation->set_rules('rpassword1', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('rpassword2', 'Confirm Password', 'trim|required|min_length[4]|matches[rpassword1]');

		// run validation
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$items = array(
					'firstname' => ucfirst($this->input->post('rfirstname')),
					'lastname' => ucfirst($this->input->post('rlastname')),
					'email_address' => $this->input->post('remail_address'),
					'username' => $this->input->post('rusername'),
					'password' => md5($this->input->post('rpassword1')),
					'website' => $this->input->post('rwebsite'),
					'role' => $this->input->post('rrole'),
					'status' => $this->input->post('rstatus')
				);
			$data['query'] = $this->user_model->add_user('users',$items);
			echo "YES";
		}
	}

	public function username_not_exists($username)
	{
		$this->form_validation->set_message('username_not_exists', 'Username already exists!');

		if($this->user_model->check_username($username,'users'))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function category($id)
	{
			//$data['title'] = 'Welcome to OpenBlog';
			//$data['main_content'] = 'public_views/index_view';
			//$this->load->view('public_includes/template',$data);

		if($this->input->is_ajax_request())
		{
			$data['query'] = $this->blog_model->get_entries_by_category('blog','blog_category', $id);
			$this->load->view('public_views/index_view',$data);
		}
		else
		{
			$data['title'] = 'Welcome to OpenBlog';
			$data['query'] = $this->blog_model->get_entries_by_category('blog','blog_category', $id);
			$data['main_content'] = 'public_views/index_view';
			$this->load->view('public_includes/template',$data);
		}
	}

	public function archives()
	{
		$data['active'] = 'menu2';
		$data['title'] = 'OpenBlog | Archives';
		$data['categoryList'] = $this->blog_model->get_categories('blog_category');
		$data['main_content'] = 'public_views/archives_view';
		$this->load->view('public_includes/template',$data);
	}

	public function contact()
	{
		$data['active'] = 'menu4';
		$data['title'] = 'OpenBlog | Contact Us';
		$data['main_content'] = 'public_views/contact_view';
		$this->load->view('public_includes/template',$data);
	}

	public function contact_submit()
	{
		$this->form_validation->set_rules('contactName','Name','trim|required');
		$this->form_validation->set_rules('contactEmail','Email Address','trim|required|valid_email');
		$this->form_validation->set_rules('contactContent','Message','trim|required');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$items = array(
				'contact_form_name' => $this->input->post('contactName'),
				'contact_form_email' => $this->input->post('contactEmail'),
				'contact_form_content' => $this->input->post('contactContent'),
				'contact_form_date_posted' => $this->input->post('contact_form_date_posted'),
				'status' => 1
				);
			$this->blog_model->insert_contact_form_message('contact_form',$items);
			echo 'CONTACTSUBMIT';
		}
	}

	public function updateProfile()
	{
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$uid = $this->input->post('author_id');
			$items = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email_address' => $this->input->post('email_address'),
					'website' => $this->input->post('website'),
				);
			$this->user_model->update_user('users', $items, $uid);
			echo 'UPDATED';
		}
	}

}