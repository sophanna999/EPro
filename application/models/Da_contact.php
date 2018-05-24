<?php
			class Da_contact extends MY_Model { 
			public $id;
			public $email;
			public $tel;
			public $phone;
			public $fax;
			public $address;
			public $image;
			
			public function inserts() {
				$this->db->set('id', $this->id);
				$this->db->set('email', $this->email);
				$this->db->set('tel', $this->tel);
				$this->db->set('phone', $this->phone);
				$this->db->set('fax', $this->fax);
				$this->db->set('address', $this->address);
				$this->db->set('image', $this->image);
				
				$this->db->from('tbl_contact');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('tbl_contact');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('tbl_contact', $data, $key);
			}
			public function updates() {
				
			$this->db->set('id', $this->id);
				$this->db->set('email', $this->email);
				$this->db->set('tel', $this->tel);
				$this->db->set('phone', $this->phone);
				$this->db->set('fax', $this->fax);
				$this->db->set('address', $this->address);
				$this->db->set('image', $this->image);
				
				$this->db->from('tbl_contact');
				$this->db->where('id', $this->id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('tbl_contact');
				$this->db->where('id', $this->id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('tbl_contact');
				$this->db->order_by('id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('tbl_contact');
				$this->db->where('id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}