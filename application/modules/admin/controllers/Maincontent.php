
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Maincontent extends Admin_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_builder');
			$this->load->library('form_validation');
			$this->load->model('mo_maincontent');
			$this->load->helper('url');
		}
		
		public function index() {
			
			$this->load->library('form_validation');
			$this->mPageTitle = 'HOME CONTENT';
			$this->mViewData['data_cat'] = $this->mo_maincontent->get_all();
			$form = $this->form_builder->create_form();
			$this->mViewData['form'] = $form;
			$this->render('maincontent/v_maincontent');
		}

		public function create($id=NULL) {

			$this->load->library('form_validation');
				$this->form_validation->set_rules('maincontent_texthead','Maincontent_texthead', 'required');
				$this->form_validation->set_rules('maincontent_texttitle','Maincontent_texttitle', 'required');
				$this->form_validation->set_rules('maincontent_textdetail','Maincontent_textdetail', 'required');
				$this->form_validation->set_rules('maincontent_textslide','Maincontent_textslide', 'required');
				$this->form_validation->set_rules('maincontent_headcontent','Maincontent_headcontent', 'required');
				$this->form_validation->set_rules('maincontent_detail','Maincontent_detail', 'required');
				$this->form_validation->set_rules('maincontent_email','Maincontent_email', 'required');
				$this->form_validation->set_rules('maincontent_phone','Maincontent_phone', 'required');
				// $this->form_validation->set_rules('maincontent_image','Maincontent_image', 'required');
				$this->form_validation->set_rules('maincontent_concat','Maincontent_concat', 'required');
						
		$this->mViewData['maincontent'] = '';

		if($id!=NULL || !empty($this->input->post('maincontent_id'))){
			if($this->form_validation->run() == FALSE){
				$this->mViewData['maincontent'] = $this->mo_maincontent->get_by_key($id);
			}
			else{
				$field_name = "maincontent_image";
				$path = "./assets/uploads/maincontent/";
				$allowed_types = "png|jpg|jpeg|gif";
				$img_name = $this->upload_file($field_name, $path, $allowed_types); 

				$this->mo_maincontent->maincontent_id = $this->input->post('maincontent_id');
				$this->mo_maincontent->maincontent_texthead = $this->input->post('maincontent_texthead');
				$this->mo_maincontent->maincontent_texttitle = $this->input->post('maincontent_texttitle');
				$this->mo_maincontent->maincontent_textdetail = $this->input->post('maincontent_textdetail');
				$this->mo_maincontent->maincontent_textslide = $this->input->post('maincontent_textslide');
				$this->mo_maincontent->maincontent_headcontent = $this->input->post('maincontent_headcontent');
				$this->mo_maincontent->maincontent_detail = $this->input->post('maincontent_detail');
				$this->mo_maincontent->maincontent_email = $this->input->post('maincontent_email');
				$this->mo_maincontent->maincontent_phone = $this->input->post('maincontent_phone');

				if($img_name)
					$this->mo_maincontent->maincontent_image = $img_name;
				else
					$this->mo_maincontent->maincontent_image = $this->input->post('maincontent_image_old');
				$this->mo_maincontent->maincontent_concat = $this->input->post('maincontent_concat');
				
				$this->mo_maincontent->updates();
				redirect('admin/maincontent/', 'refresh');
			}
		}
		else{
			if($this->form_validation->run() == FALSE){
				
			}
			else{
				$field_name = "maincontent_image";
				$path = "./assets/uploads/maincontent/";
				$allowed_types = "png|jpg|jpeg|gif";
				$img_name = $this->upload_file($field_name, $path, $allowed_types); 

				$this->mo_maincontent->maincontent_id = $this->input->post('maincontent_id');
				$this->mo_maincontent->maincontent_texthead = $this->input->post('maincontent_texthead');
				$this->mo_maincontent->maincontent_texttitle = $this->input->post('maincontent_texttitle');
				$this->mo_maincontent->maincontent_textdetail = $this->input->post('maincontent_textdetail');
				$this->mo_maincontent->maincontent_textslide = $this->input->post('maincontent_textslide');
				$this->mo_maincontent->maincontent_headcontent = $this->input->post('maincontent_headcontent');
				$this->mo_maincontent->maincontent_detail = $this->input->post('maincontent_detail');
				$this->mo_maincontent->maincontent_email = $this->input->post('maincontent_email');
				$this->mo_maincontent->maincontent_phone = $this->input->post('maincontent_phone');

				if($img_name!="")
					$this->mo_maincontent->maincontent_image = $img_name;
				$this->mo_maincontent->maincontent_concat = $this->input->post('maincontent_concat');
				
				$this->mo_maincontent->inserts();
				redirect('admin/maincontent/', 'refresh');
			}
		}

		$this->mPageTitle = 'CREATE HOME CONTENT';
		
		$form = $this->form_builder->create_form();
		$this->mViewData['form'] = $form;
		$this->render('maincontent/v_maincontent_create');
	}
	
	public function deletes($id=NULL) {
		if($id!=NULL){
			$this->mo_maincontent->maincontent_id = $id;
			$this->mo_maincontent->deletes();
		}
		redirect('admin/maincontent/', 'refresh');
	}

}
						