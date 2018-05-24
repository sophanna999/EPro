<?php
			class Da_product extends MY_Model { 
			public $pro_id;
			public $pro_name;
			public $pro_price;
			public $pro_detail;
			public $pro_image;
			public $type_id;
			
			public function inserts() {
				$this->db->set('pro_id', $this->pro_id);
				$this->db->set('pro_name', $this->pro_name);
				$this->db->set('pro_price', $this->pro_price);
				$this->db->set('pro_detail', $this->pro_detail);
				$this->db->set('pro_image', $this->pro_image);
				$this->db->set('cate_id', $this->cate_id);
				
				$this->db->from('tbl_product');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('tbl_product');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('tbl_product', $data, $key);
			}
			public function updates() {
				
			$this->db->set('pro_id', $this->pro_id);
				$this->db->set('pro_name', $this->pro_name);
				$this->db->set('pro_price', $this->pro_price);
				$this->db->set('pro_detail', $this->pro_detail);
				$this->db->set('pro_image', $this->pro_image);
				$this->db->set('cate_id', $this->cate_id);
				
				$this->db->from('tbl_product');
				$this->db->where('pro_id', $this->pro_id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('tbl_product');
				$this->db->where('pro_id', $this->pro_id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('tbl_product');
				$this->db->order_by('pro_id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('tbl_product');
				$this->db->where('pro_id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}