
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Contact extends Admin_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_builder');
			$this->load->library('form_validation');
			$this->load->model('mo_contact');
			$this->load->helper('url');
		}
		
		public function index() {
			
			$this->load->library('form_validation');
			$this->mPageTitle = 'Contact';
			$this->mViewData['data_cat'] = $this->mo_contact->get_all();
			$form = $this->form_builder->create_form();
			$this->mViewData['form'] = $form;
			$this->render('contact/v_contact');
		}

		public function create($id=NULL) {

			$this->load->library('form_validation');
				$this->form_validation->set_rules('email','Email', 'required');
				$this->form_validation->set_rules('tel','Tel', 'required');
				$this->form_validation->set_rules('phone','Phone', 'required');
				$this->form_validation->set_rules('fax','Fax', 'required');
				$this->form_validation->set_rules('address','Address', 'required');
				// $this->form_validation->set_rules('image','Image', 'required');
						
		$this->mViewData['contact'] = '';

		if($id!=NULL || !empty($this->input->post('id'))){
			if($this->form_validation->run() == FALSE){
				$this->mViewData['contact'] = $this->mo_contact->get_by_key($id);
			}
			else{

				$field_name		= "image";
				$path 			= "./assets/uploads/contact";
				$allowed_files	= "jpg|jpeg|png|gif";
				$img_name		= $this->upload_file($field_name, $path, $allowed_files);

				$this->mo_contact->id = $this->input->post('id');
				$this->mo_contact->email = $this->input->post('email');
				$this->mo_contact->tel = $this->input->post('tel');
				$this->mo_contact->phone = $this->input->post('phone');
				$this->mo_contact->fax = $this->input->post('fax');
				$this->mo_contact->address = $this->input->post('address');

				if (!empty($img_name)) {
					
					$this->mo_contact->image = $img_name;
				} else {
					$this->mo_contact->image = $this->input->post('old_image');
				}
				
				$this->mo_contact->updates();
				redirect('admin/contact/', 'refresh');
			}
		}
		else{
			if($this->form_validation->run() == FALSE){
				
			}
			else{

				$field_name		= "image";
				$path 			= "./assets/uploads/contact";
				$allowed_files	= "jpg|jpeg|png|gif";
				$img_name 		= $this->upload_file($field_name, $path, $allowed_files);

				$this->mo_contact->id = $this->input->post('id');
				$this->mo_contact->email = $this->input->post('email');
				$this->mo_contact->tel = $this->input->post('tel');
				$this->mo_contact->phone = $this->input->post('phone');
				$this->mo_contact->fax = $this->input->post('fax');
				$this->mo_contact->address = $this->input->post('address');
				$this->mo_contact->image = $img_name;
				
				$this->mo_contact->inserts();
				redirect('admin/contact/', 'refresh');
			}
		}

		$this->mPageTitle = 'Create contact';
		
		$form = $this->form_builder->create_form();
		$this->mViewData['form'] = $form;
		$this->render('contact/v_contact_create');
	}
	
	public function deletes($id=NULL) {
		if($id!=NULL){
			$this->mo_contact->id = $id;
			$this->mo_contact->deletes();
		}
		redirect('admin/contact/', 'refresh');
	}

}
						