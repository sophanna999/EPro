<?php
			class Da_contactuser extends MY_Model { 
			public $contactuser_id;
			public $contactuser_name;
			public $contactuser_email;
			public $contactuser_detail;
			public $contactuser_dateime;
			
			public function inserts() {
				$this->db->set('contactuser_id', $this->contactuser_id);
				$this->db->set('contactuser_name', $this->contactuser_name);
				$this->db->set('contactuser_email', $this->contactuser_email);
				$this->db->set('contactuser_detail', $this->contactuser_detail);
				$this->db->set('contactuser_dateime', $this->contactuser_dateime);
				
				$this->db->from('gcp_contactuser');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('gcp_contactuser');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('gcp_contactuser', $data, $key);
			}
			public function updates() {
				
			$this->db->set('contactuser_id', $this->contactuser_id);
				$this->db->set('contactuser_name', $this->contactuser_name);
				$this->db->set('contactuser_email', $this->contactuser_email);
				$this->db->set('contactuser_detail', $this->contactuser_detail);
				$this->db->set('contactuser_dateime', $this->contactuser_dateime);
				
				$this->db->from('gcp_contactuser');
				$this->db->where('contactuser_id', $this->contactuser_id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('gcp_contactuser');
				$this->db->where('contactuser_id', $this->contactuser_id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('gcp_contactuser');
				$this->db->order_by('contactuser_id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('gcp_contactuser');
				$this->db->where('contactuser_id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}