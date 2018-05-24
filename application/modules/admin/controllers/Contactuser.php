
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Contactuser extends Admin_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_builder');
			$this->load->library('form_validation');
			$this->load->model('mo_contactuser');
			$this->load->helper('url');
		}
		
		public function index() {
			
			$this->load->library('form_validation');
			$this->mPageTitle = 'CONTACTUSER';
			$this->mViewData['data_cat'] = $this->mo_contactuser->get_all();
			$form = $this->form_builder->create_form();
			$this->mViewData['form'] = $form;
			$this->render('contactuser/v_contactuser');
		}

		public function create($id=NULL) {

			$this->load->library('form_validation');
				$this->form_validation->set_rules('contactuser_name','Contactuser_name', 'required');
				$this->form_validation->set_rules('contactuser_email','Contactuser_email', 'required');
				$this->form_validation->set_rules('contactuser_detail','Contactuser_detail', 'required');
				// $this->form_validation->set_rules('contactuser_dateime','Contactuser_dateime', 'required');
						
		$this->mViewData['contactuser'] = '';

		if($id!=NULL || !empty($this->input->post('contactuser_id'))){
			if($this->form_validation->run() == FALSE){
				$this->mViewData['contactuser'] = $this->mo_contactuser->get_by_key($id);
			}
			else{
			$this->mo_contactuser->contactuser_id = $this->input->post('contactuser_id');
				$this->mo_contactuser->contactuser_name = $this->input->post('contactuser_name');
				$this->mo_contactuser->contactuser_email = $this->input->post('contactuser_email');
				$this->mo_contactuser->contactuser_detail = $this->input->post('contactuser_detail');
				$this->mo_contactuser->contactuser_dateime = date('Y-m-d H:i:s',now());
				
				$this->mo_contactuser->updates();
				redirect('admin/contactuser/', 'refresh');
			}
		}
		else{
			if($this->form_validation->run() == FALSE){
				
			}
			else{
			$this->mo_contactuser->contactuser_id = $this->input->post('contactuser_id');
				$this->mo_contactuser->contactuser_name = $this->input->post('contactuser_name');
				$this->mo_contactuser->contactuser_email = $this->input->post('contactuser_email');
				$this->mo_contactuser->contactuser_detail = $this->input->post('contactuser_detail');
				$this->mo_contactuser->contactuser_dateime = date('Y-m-d H:i:s',now());
				
				$this->mo_contactuser->inserts();
				redirect('admin/contactuser/', 'refresh');
			}
		}

		$this->mPageTitle = 'CREATE CONTACTUSER';
		
		$form = $this->form_builder->create_form();
		$this->mViewData['form'] = $form;
		$this->render('contactuser/v_contactuser_create');
	}
	
	public function deletes($id=NULL) {
		if($id!=NULL){
			$this->mo_contactuser->contactuser_id = $id;
			$this->mo_contactuser->deletes();
		}
		redirect('admin/contactuser/', 'refresh');
	}

}
						