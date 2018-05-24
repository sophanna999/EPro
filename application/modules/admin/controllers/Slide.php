
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Slide extends Admin_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_builder');
			$this->load->library('form_validation');
			$this->load->model('mo_slide');
			$this->load->helper('url');
		}
		
		public function index() {
			
			$this->load->library('form_validation');
			$this->mPageTitle = 'Slide';
			$this->mViewData['data_cat'] = $this->mo_slide->get_all();
			$form = $this->form_builder->create_form();
			$this->mViewData['form'] = $form;
			$this->render('slide/v_slide');
		}

		public function create($id=NULL) {

			$this->load->library('form_validation');
				$this->form_validation->set_rules('silde_name','Silde_name', 'required');
				$this->form_validation->set_rules('silde_link','Silde_link', 'required');
				$this->form_validation->set_rules('silde_img','Silde_img', 'required');
						
		$this->mViewData['slide'] = '';

		if($id!=NULL || !empty($this->input->post('slide_id'))){
			if(empty($this->input->post())){
				$this->mViewData['slide'] = $this->mo_slide->get_by_key($id);
			}
			else{
				$field_name   	 = "silde_img";
				$path 			 = "./assets/uploads/slide/";
				$allowed_files   = "jpg|png|jpeg|gif";
				$img_name 		 = $this->upload_file($field_name, $path, $allowed_files);		

				$this->mo_slide->slide_id = $this->input->post('slide_id');
				$this->mo_slide->silde_name = $this->input->post('silde_name');
				$this->mo_slide->silde_link = $this->input->post('silde_link');
				// $this->mo_slide->silde_img = $this->input->post('silde_img');

				if ($img_name) {
					$this->mo_slide->silde_img = $img_name;
				} else {
					$this->mo_slide->silde_img = $this->input->post('old_silde_img');
				}
				
				$this->mo_slide->updates();
				redirect('admin/slide/', 'refresh');
			}
		} else {
			if ($this->input->post()) {

				$field_name   	 = "silde_img";
				$path 			 = "./assets/uploads/slide/";
				$allowed_files   = "jpg|png|jpeg|gif";
				$img_name 		 = $this->upload_file($field_name, $path, $allowed_files);

				$this->mo_slide->slide_id = $this->input->post('slide_id');
				$this->mo_slide->silde_name = $this->input->post('silde_name');
				$this->mo_slide->silde_link = $this->input->post('silde_link');
				$this->mo_slide->silde_img = $img_name;

				$this->mo_slide->inserts();
				redirect('admin/slide/', 'refresh');
			}

		}

		$this->mPageTitle = 'Create slide';
		
		$form = $this->form_builder->create_form();
		$this->mViewData['form'] = $form;
		$this->render('slide/v_slide_create');
	}
	
	public function deletes($id=NULL) {
		if($id!=NULL){
			$this->mo_slide->slide_id = $id;
			$this->mo_slide->deletes();
		}
		redirect('admin/slide/', 'refresh');
	}

	public function add_slide ()
	{
		// if ($_POST["submit"] == "Submit") {
			$data = array(
				'silde_name' => $this->input->post('slide_name'),
				'silde_link' => $this->input->post('slide_link'),
				'silde_img' => $this->upload()
				);
			$this->mo_slide->add_slide($data);
			redirect('admin/slide/', 'refresh');

	}
	public function upload()
	{
		if (isset($_FILES['slide_img'])) {
			$extension = explode('.', $_FILES['slide_img']['name']);
			$new_name  = rand(). '.'. $extension[1];
			$destination = './upload/' . $new_name;
			move_uploaded_file($_FILES['slide_img']['name'], $destination);
			return $new_name;
		}
	}

}
						