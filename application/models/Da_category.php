<?php
			class Da_category extends MY_Model { 
			public $cate_id;
			public $cate_name;
			public $cate_sub;
			public $cate_main;
			
			public function inserts() {
				$this->db->set('cate_id', $this->cate_id);
				$this->db->set('cate_name', $this->cate_name);
				$this->db->set('cate_sub', $this->cate_sub);
				$this->db->set('cate_main', $this->cate_main);
				
				$this->db->from('tbl_category');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('tbl_category');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('tbl_category', $data, $key);
			}
			public function updates() {
				
			$this->db->set('cate_id', $this->cate_id);
				$this->db->set('cate_name', $this->cate_name);
				$this->db->set('cate_sub', $this->cate_sub);
				$this->db->set('cate_main', $this->cate_main);
				
				$this->db->from('tbl_category');
				$this->db->where('cate_id', $this->cate_id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('tbl_category');
				$this->db->where('cate_id', $this->cate_id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('tbl_category');
				$this->db->order_by('cate_id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('tbl_category');
				$this->db->where('cate_id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}