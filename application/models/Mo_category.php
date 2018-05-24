<?php

	include('Da_category.php');

	class Mo_category extends Da_category {

		public function get_by_main ()
		{
			$this->db->select('*');
			$this->db->from ('tbl_category');
			$this->db->where('cate_main', 0);
			$query = $this->db->get()->result();
			return $query;
		}

		public function get_by_sub ($key)
		{
			$this->db->select('*');
			$this->db->from('tbl_category');
			$this->db->where('cate_sub', $key);
			$query = $this->db->get()->result();
			return $query;
		}


		public function get_category_tree($id=null, $level=0) {
			$array = array();
			$sub_cate = $this->mo_category->get_by_sub($id);
			if (!empty($sub_cate)) {
				foreach ($sub_cate as $row) {
					$array[] = array(
						'cate_id' => $row->cate_id,
						'cate_name' => $row->cate_name,
						'level'     => $level+1);

				if ($this->get_category_tree($row->cate_id,$level+1) != NULL) {
					$array_dummy =$this->get_category_tree($row->cate_id,$level+1);
					$array = array_merge($array,$array_dummy);
					$array_dummy = array();	
				  }
				}

				return $array;

			} else {

				return null;
			}
		}

		public function get_sub_category($key) {
		
			$this->db->select('cate_main');
			$this->db->from('tbl_category');
			$this->db->where('cate_id', $key);
			$query = $this->db->get()->result();
			return $query;
		}

	}
	