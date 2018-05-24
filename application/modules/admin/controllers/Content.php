
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Content extends Admin_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_builder');
			$this->load->library('form_validation');
			$this->load->model('mo_content');
			$this->load->helper('url');
		}
		
		public function index() {
			
			$this->load->library('form_validation');
			$this->mPageTitle = 'CONTENT HEAD';
			$this->mViewData['data_cat'] = $this->mo_content->get_all();
			$form = $this->form_builder->create_form();
			$this->mViewData['form'] = $form;
			$this->render('content/v_content');
		}

		public function create($id=NULL) {

			$this->load->library('form_validation');
				$this->form_validation->set_rules('content_head','Content_head', 'required');
				$this->form_validation->set_rules('content_head2','Content_head2', 'required');
				$this->form_validation->set_rules('content_titleen','Content_titleen', 'required');
				$this->form_validation->set_rules('content_titleth','Content_titleth', 'required');
				$this->form_validation->set_rules('content_phone','Content_phone', 'required');
				// $this->form_validation->set_rules('content_logo','Content_logo', 'required');
				// $this->form_validation->set_rules('content_line','Content_line', 'required');
						
		$this->mViewData['content'] = '';

		if($id!=NULL || !empty($this->input->post('content_id'))){
			if($this->form_validation->run() == FALSE){
				$this->mViewData['content'] = $this->mo_content->get_by_key($id);
			}
			else{
				$field_name = "content_logo";
				$field_name2 = "content_line";
				$path = "./assets/uploads/content/";
				$allowed_types = "png|jpg|jpeg|gif";
				$img_name = $this->upload_file($field_name, $path, $allowed_types);
				$img_name2 = $this->upload_file($field_name2, $path, $allowed_types);

				$this->mo_content->content_id = $this->input->post('content_id');
				$this->mo_content->content_head = $this->input->post('content_head');
				$this->mo_content->content_head2 = $this->input->post('content_head2');
				$this->mo_content->content_titleen = $this->input->post('content_titleen');
				$this->mo_content->content_titleth = $this->input->post('content_titleth');
				$this->mo_content->content_phone = $this->input->post('content_phone');

				if($img_name){
					$this->mo_content->content_logo = $img_name;
				}
				else{
					$this->mo_content->content_logo = $this->input->post('content_logo_old');
				}

				if($img_name2){
					$this->mo_content->content_line = $img_name2;
				}
				else{
					$this->mo_content->content_line = $this->input->post('content_line_old');
				}

				
				
				$this->mo_content->updates();
				redirect('admin/content/create/1', 'refresh');
			}
		}
		else{
			if($this->form_validation->run() == FALSE){
				
			}
			else{
				$field_name = "content_logo";
				$field_name2 = "content_line";
				$path = "./assets/uploads/content/";
				$allowed_types = "png|jpg|jpeg|gif";
				$img_name = $this->upload_file($field_name, $path, $allowed_types);
				$img_name2 = $this->upload_file($field_name2, $path, $allowed_types);

				$this->mo_content->content_id = $this->input->post('content_id');
				$this->mo_content->content_head = $this->input->post('content_head');
				$this->mo_content->content_head2 = $this->input->post('content_head2');
				$this->mo_content->content_titleen = $this->input->post('content_titleen');
				$this->mo_content->content_titleth = $this->input->post('content_titleth');
				$this->mo_content->content_phone = $this->input->post('content_phone');
				$this->mo_content->content_logo = $img_name;
				$this->mo_content->content_line = $img_name2;
				
				$this->mo_content->inserts();
				redirect('admin/content/', 'refresh');
			}
		}

		$this->mPageTitle = 'CREATE CONTENT HEAD';
		
		$form = $this->form_builder->create_form();
		$this->mViewData['form'] = $form;
		$this->render('content/v_content_create');
	}
	
	public function deletes($id=NULL) {
		if($id!=NULL){
			$this->mo_content->content_id = $id;
			$this->mo_content->deletes();
		}
		redirect('admin/content/', 'refresh');
	}

}
						