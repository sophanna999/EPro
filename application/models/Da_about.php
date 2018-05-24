<?php
			class Da_about extends MY_Model { 
			public $id;
			public $title;
			public $detail;
			public $image;
			public $create_date;
			public $update_date;
			
			public function inserts() {
				$this->db->set('id', $this->id);
				$this->db->set('title', $this->title);
				$this->db->set('detail', $this->detail);
				$this->db->set('image', $this->image);
				$this->db->set('create_date', $this->create_date);
				$this->db->set('update_date', $this->update_date);
				
				$this->db->from('tbl_about');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('tbl_about');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('tbl_about', $data, $key);
			}
			public function updates() {
				
			$this->db->set('id', $this->id);
				$this->db->set('title', $this->title);
				$this->db->set('detail', $this->detail);
				$this->db->set('image', $this->image);
				$this->db->set('create_date', $this->create_date);
				$this->db->set('update_date', $this->update_date);
				
				$this->db->from('tbl_about');
				$this->db->where('id', $this->id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('tbl_about');
				$this->db->where('id', $this->id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('tbl_about');
				$this->db->order_by('id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('tbl_about');
				$this->db->where('id', $key);
				$query = $this->db->get()->result();
				return $query;
			}
			public function get_least(){
				$this->db->from('tbl_about');
				$this->db->order_by('id','DESC');
				$this->db->limit(1);
				return $this->db->get()->result();
			}
		}