<?php
			class Da_slide extends MY_Model { 
			public $slide_id;
			public $silde_name;
			public $silde_link;
			public $silde_img;
			
			public function inserts() {
				$this->db->set('slide_id', $this->slide_id);
				$this->db->set('silde_name', $this->silde_name);
				$this->db->set('silde_link', $this->silde_link);
				$this->db->set('silde_img', $this->silde_img);
				
				$this->db->from('tbl_slide');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('tbl_slide');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('tbl_slide', $data, $key);
			}
			public function updates() {
				
			$this->db->set('slide_id', $this->slide_id);
				$this->db->set('silde_name', $this->silde_name);
				$this->db->set('silde_link', $this->silde_link);
				$this->db->set('silde_img', $this->silde_img);
				
				$this->db->from('tbl_slide');
				$this->db->where('slide_id', $this->slide_id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('tbl_slide');
				$this->db->where('slide_id', $this->slide_id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('tbl_slide');
				$this->db->order_by('slide_id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('tbl_slide');
				$this->db->where('slide_id', $key);
				$query = $this->db->get()->result();
				return $query;
			}
			public function add_slide($data)
			{
				$this->db->insert('tbl_slide', $data);
			}

		}