<?php
			class Da_test extends MY_Model { 
			public $id;
			public $name;
			public $title;
			public $price;
			
			public function inserts() {
				$this->db->set('id', $this->id);
				$this->db->set('name', $this->name);
				$this->db->set('title', $this->title);
				$this->db->set('price', $this->price);
				
				$this->db->from('gcp_test');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('gcp_test');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('gcp_test', $data, $key);
			}
			public function updates() {
				
			$this->db->set('id', $this->id);
				$this->db->set('name', $this->name);
				$this->db->set('title', $this->title);
				$this->db->set('price', $this->price);
				
				$this->db->from('gcp_test');
				$this->db->where('id', $this->id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('gcp_test');
				$this->db->where('id', $this->id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('gcp_test');
				$this->db->order_by('id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('gcp_test');
				$this->db->where('id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}