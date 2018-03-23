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
		if($username != "") {
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

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('home/index'),'refresh');
	}

}

/* End of file home.php */
/* Location: .//var/www/html/shareany/app/controllers/home.php */