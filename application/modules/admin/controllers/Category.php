
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Category extends Admin_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('form_builder');
			$this->load->library('form_validation');
			$this->load->model('mo_category');
			$this->load->helper('url');
		}
		
		public function index() {
			
			$this->load->library('form_validation');
			$this->mPageTitle = 'Category';
			$this->mViewData['data_cat'] = $this->mo_category->get_all();

			$this->mViewData['data_cat2'] = $this->mo_category->get_by_main();

			$array = array();
			$level = 0;
			foreach($this->mViewData['data_cat2'] as $row){
				
				$array[] = array(
					'cate_id'=>$row->cate_id,
					'cate_name'=>$row->cate_name,
					'level'=>$level);
				
				if($this->get_category_tree($row->cate_id,$level)!=NULL){
					$array_dummy = $this->get_category_tree($row->cate_id,$level);
					$array = array_merge($array,$array_dummy);
					$array_dummy = array();
				}
				
			}

			$this->mViewData['data_cat2'] = $array;

			$form = $this->form_builder->create_form();
			$this->mViewData['form'] = $form;
			$this->render('category/v_category');
		}

		public function get_category_tree($id=null,$level=0) {
			$array = array();
			$sub = $this->mo_category->get_by_sub($id);
			if(!empty($sub)){
				foreach($sub as $row){
					$array[] = array('cate_id'=>$row->cate_id,'cate_name'=>$row->cate_name,
						'level'=>$level+1);

					if($this->get_category_tree($row->cate_id,$level+1)!=NULL){
						$array_dummy = $this->get_category_tree($row->cate_id,$level+1);
						$array = array_merge($array,$array_dummy);
						$array_dummy = array();
					}
				}
				return $array;
			}
			else{
				return null;
			}
		}

		public function get_cat_all(){
			$data_cat = $this->mo_category->get_by_main();
			$array = array();
			$level=0;
			foreach($data_cat as $row){
				
				$array[] = array(
					'cate_id'=>$row->cate_id,
					'cate_name'=>$row->cate_name,
					'level'=>$level);
				
				if($this->mo_category->get_category_tree($row->cate_id,$level)!=NULL){
					$array_dummy = $this->mo_category->get_category_tree($row->cate_id,$level);
					$array = array_merge($array,$array_dummy);
					$array_dummy = array();
				}
				
			}
			return $array;
		}

		public function create($id=NULL) {

			$this->load->library('form_validation');
				$this->form_validation->set_rules('cate_name','Cate_name', 'required');
				// $this->form_validation->set_rules('cate_sub','Cate_sub', 'required');
				// $this->form_validation->set_rules('cate_main','Cate_main', 'required');
						
		$this->mViewData['category'] = '';

		if($id!=NULL || !empty($this->input->post('cate_id'))){
			if($this->form_validation->run() == FALSE){
				$this->mViewData['category'] = $this->mo_category->get_by_key($id);
			}
			else{
			$this->mo_category->cate_id = $this->input->post('cate_id');
				$this->mo_category->cate_name = $this->input->post('cate_name', TRUE);

			if($this->input->post('cate_sub') == 0){
					$this->mo_category->cate_sub = 0;
					$this->mo_category->cate_main = 0;
				} else {
				
				$this->mo_category->cate_sub = $this->input->post('cate_sub');
				$sub_row = $this->mo_category->cate_sub;
				$this->mViewData['sub_test'] = $this->mo_category->get_sub_category($sub_row);
				$sub_main = $this->mViewData['sub_test'];
				foreach($sub_main as $row){
					$this->mViewData['main_test'] = $row->cate_main;
				}
				$main = $this->mViewData['main_test'];
				if($main == 0){
					$this->mo_category->cate_main = $sub_row;
				}else{
					$this->mo_category->cate_main = $this->mViewData['main_test'];
					}
				
				}

				
				$this->mo_category->updates();
				redirect('admin/category/', 'refresh');
			}
		}
		else{
			if($this->form_validation->run() == FALSE){
				
			}
			else{
			$this->mo_category->cate_id = $this->input->post('cate_id');
				$this->mo_category->cate_name = $this->input->post('cate_name', TRUE);

				if($this->input->post('cate_sub') == 0){
					$this->mo_category->cate_sub = 0;
					$this->mo_category->cate_main = 0;
				} else {
				$this->mo_category->cate_sub = $this->input->post('cate_sub');
				
				$sub_row = $this->mo_category->cate_sub;
				$this->mViewData['sub_test'] = $this->mo_category->get_sub_category($sub_row);
				$sub_main = $this->mViewData['sub_test'];
				foreach($sub_main as $row){
					$this->mViewData['main_test'] = $row->cate_main;
				}
				$main = $this->mViewData['main_test'];
				if($main == 0){
					$this->mo_category->cate_main = $sub_row;
				}else{
					$this->mo_category->cate_main = $this->mViewData['main_test'];
				}
					
			}
				
				$this->mo_category->inserts();
				redirect('admin/category/', 'refresh');
			}
		}

		$this->mViewData['all_cate'] = $this->get_cat_all();
		$this->mViewData['all_cate2'] = $this->get_cat_all();

		$this->mPageTitle = 'Create category';
		
		$form = $this->form_builder->create_form();
		$this->mViewData['form'] = $form;
		$this->render('category/v_category_create');
	}
	
	public function deletes($id=NULL) {
		if($id!=NULL){
			$this->mo_category->cate_id = $id;
			$this->mo_category->deletes();
		}
		redirect('admin/category/', 'refresh');
	}

}
						