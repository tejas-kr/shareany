<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('home_m');
		$this->load->library('form_validation');
	}

	public function index() {
		// echo "print";
		$username = $this->session->userdata('username');
		$user_id = $this->session->userdata('userID');
		if($username != "" && isset($user_id)) {
			$shared_posts = $this->home_m->get_shareed_posts($user_id);
			if($shared_posts != 0) {
				$this->data['shared_posts'] = $shared_posts;
				// echo "<pre>";print_r($shared_posts); die();
			}
			$this->data['username'] = $username;

			$this->data['page_title'] = "Shareany | Home";
			$this->data['sub_view'] = "home/index";
			$this->load->view('common_view/common_view', $this->data);
		} else {
			$this->data['page_title'] = "Shareany | Sign up";
			$this->data['sub_view'] = "signup/signup";
			$this->load->view('common_view/common_view', $this->data);
		}
	}

	public function sign_up_new_user() {
		$data = array();
		$message = 0;
		if($_POST) {
			if($this->input->post('username') == "" || $this->input->post('password') == "" || $this->input->post('full_name') == "") {
				$data['message'] = $message;
			} else {

				$arr = array();
				$arr['username'] = $this->input->post('username');
				$arr['password'] = md5($this->input->post('password'));
				$arr['full_name'] = $this->input->post('full_name');

				$new_user = $this->home_m->sign_up_new_user($arr);

				// set session
				$session_array = array(
					'username' => $arr['username'],
					'userID' => $new_user->userID,
					'added_on' => $new_user->added_on
				);
				$this->session->set_userdata($session_array);

				$message = 1;
				$data['message'] = $message;

			}
		}
		echo json_encode($data);
	}

	public function check_if_username_exists() {
		$u_name = $this->input->post('u_name');
		$data = array();
		$message = 0;
		if($this->home_m->check_if_username_exists($u_name)) {
			$message = 0;
		} else {
			$message = 1;
		}
		$data['message'] = $message;
		echo json_encode($data);
	}

	public function validate_password() {
		$pass = $this->input->post('pass');
		$data = array();
		$message = 0;
		//WILL ASK
		if(preg_match('/[a-zA-Z][0-9][#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $pass)) {
			$message = 1;
		}
		$data['message'] = $message;
		echo json_encode($data);
	}

	public function sign_in_user() {
		$data = array();
		$message = 0;
		if($_POST) {
			if($this->input->post('username') == "" || $this->input->post('password') == "") {
				$data['message'] = $message;
			} else {


				$arr = array();
				$arr['username'] = $this->input->post('username');
				$arr['password'] = md5($this->input->post('password'));

				$log_in_user_data = $this->home_m->sign_in_user($arr);

				if($log_in_user_data['user_authenticated']) {
					$user_data = $this->home_m->get_all_userdata($log_in_user_data['userID']);
					$session_array = array(
						'username' => $user_data->username,
						'userID' => $user_data->userID,
						'added_on' => $user_data->added_on
					);
					$this->session->set_userdata($session_array);

					$message = 1;
					$data['message'] = $message;
				} else {
					$message = 0;
					$data['message'] = $message;
				}

			}
		}
		echo json_encode($data);
	}

	public function profile($username) {
		$username_sess = $this->session->userdata('username');
		$user_id = $this->session->userdata('userID');
		if($this->user_exists($username)) {
			$user_data = $this->home_m->get_user_data($username);
			// print_r($user_data); die();

			//Get the followers data...
			$follows_data = $this->home_m->get_follows_data($username_sess);
			// print_r($follows_data); die();
			$follows_arr = array();
			foreach ($follows_data as $k => $v) {
				array_push($follows_arr, $v->follow_user_id);
			}
			// print_r($follows_arr); die();

			//Get user posts
			$user_posts = $this->home_m->get_user_posts($username);
			if (isset($user_posts) && !empty($user_posts)) {
				$this->data['user_posts'] = $user_posts;
			}
			// print_r($user_posts); die();

			$this->data['follows_data'] = $follows_data;
			$this->data['follows_arr'] = $follows_arr;
			$this->data['user_data'] = $user_data;
			$this->data['username'] = $username;
			$this->data['page_title'] = "Shareany | Home";
			$this->data['sub_view'] = "home/profile";
			$this->load->view('common_view/common_view', $this->data);
		} else {
			$this->data['page_title'] = "Shareany | Sign up";
			$this->data['sub_view'] = "error/404error";
			$this->load->view('common_view/common_view', $this->data);
		}
	}

	public function follow_user() {
		$userID = $this->input->post("userID");
		$this->home_m->follow_user($userID);
		echo 1;
	}

	public function unfollow_user() {
		$userID = $this->input->post("userID");
		$this->home_m->unfollow_user($userID);
		echo 1;
	}

	public function user_exists($username) {
		if($this->home_m->user_exists($username)) {
			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('home/index'),'refresh');
	}

}

/* End of file home.php */
/* Location: .//var/www/html/shareany/app/controllers/home.php */
