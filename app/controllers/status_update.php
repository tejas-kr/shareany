<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_update extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('status_update_m');
	}

	public function index()
	{
		echo "<h1>Unable to Access!</h1>";
	}

	public function save_status_update() {
		$post_description = $this->input->post('add_description');

		// FILES UPLOAD - MOST HECTIC THING...
		$new_file = "defualt.png";

		if(!empty($_FILES['userfile']['name']))
		{
			$random = rand(1, 10000000).$_FILES['userfile']['name'];
			$config['upload_path'] ="./uploads/userposts";
			$config['allowed_types'] = 'gif|jpg|png|pdf';
			$config['file_name'] = time().$random;
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userfile'))
			{
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
				// echo $picture; die();
			}
			else
			{
				$picture = '';
			}
		}
		else
		{
			// var_dump($_FILES['image']['name']);
			$picture = '';
		}
		$attachment = /*"./uploads/attach/" . */$picture;



		$save_status_update_arr = array(
			"user_id" => $this->session->userdata('userID'),
			"post_content" => $post_description,
			"post_attach" => $attachment
		);

		$status_flag = 0;
		if ($this->status_update_m->save_status_update($save_status_update_arr)) {
			$status_flag = 1;
		}

		// $html_data have to write...

		$data = array();
		$data["status_flag"] = $status_flag;

		echo json_encode($data);
	}

	function delete_post() {
		$post_id = $this->input->post('post_id');
		$this->status_update_m->delete_post($post_id);
		echo 1;
	}

}

/* End of file status_update.php */
/* Location: .//var/www/html/shareany/app/controllers/status_update.php */
