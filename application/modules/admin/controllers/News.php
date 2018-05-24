
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class News extends Admin_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_builder');
			$this->load->library('form_validation');
			$this->load->model('mo_news');
			$this->load->helper('url');
		}
		
		public function index() {
			
			$this->load->library('form_validation');
			$this->mPageTitle = 'News';
			$this->mViewData['data_cat'] = $this->mo_news->get_all();
			$form = $this->form_builder->create_form();
			$this->mViewData['form'] = $form;
			$this->render('news/v_news');
		}

		public function create($id=NULL) {

				$this->load->library('form_validation');
				$this->form_validation->set_rules('news_title','News_title', 'required');
				$this->form_validation->set_rules('news_detail','News_detail', 'required');
				$this->form_validation->set_rules('news_document','News_document', 'required');
				$this->form_validation->set_rules('news_image','News_image', 'required');
						
		$this->mViewData['news'] = '';

		if($id!=NULL || !empty($this->input->post('news_id'))){

			if(empty($this->input->post())){
			   $this->mViewData['news'] = $this->mo_news->get_by_key($id);
			}
			else{

				$field_name = "news_image";
				$path		= "./assets/uploads/news/";
				$allowed_types = "jpg|png|jpeg|gif";
				$img_name 	   = $this->upload_file($field_name, $path, $allowed_types);

				$this->mo_news->news_id = $this->input->post('news_id');
				$this->mo_news->news_title = $this->input->post('news_title');
				$this->mo_news->news_detail = $this->input->post('news_detail');
				$this->mo_news->news_document = $this->input->post('news_document');
				// $this->mo_news->news_image = $this->input->post('news_image');
				if($img_name) {
					$this->mo_news->news_image = $img_name;
				} else {
					$this->mo_news->news_image = $this->input->post('old_image');

				}
					$this->mo_news->updates();
					redirect('admin/news/', 'refresh');
			}
				
			} else {
			if($this->input->post() == null ){
				
			}
			else{

				$field_name = "news_image";
				$path       = "./assets/uploads/news/";
				$allowed_types	= "jpg|png|jpeg|gif";
				$img_name	= $this->upload_file($field_name,$path,$allowed_types);

				$this->mo_news->news_id = $this->input->post('news_id');
				$this->mo_news->news_title = $this->input->post('news_title');
				$this->mo_news->news_detail = $this->input->post('news_detail');
				$this->mo_news->news_document = $this->input->post('news_document');
				$this->mo_news->news_image = $img_name;
				// if ($img_name != "") {
				// 	$this->mo_news->news_image ->$img_name;
				// }
				
				$this->mo_news->inserts();
				redirect('admin/news/', 'refresh');
			}
		}

		$this->mPageTitle = 'Create news';
		
		$form = $this->form_builder->create_form();
		$this->mViewData['form'] = $form;
		$this->render('news/v_news_create');
	}
	
	public function deletes($id=NULL) {
		if($id!=NULL){
			$this->mo_news->news_id = $id;
			$this->mo_news->deletes();
		}
		redirect('admin/news/', 'refresh');
	}

}
						