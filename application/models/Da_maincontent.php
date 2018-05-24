<?php
			class Da_maincontent extends MY_Model { 
			public $maincontent_id;
			public $maincontent_texthead;
			public $maincontent_texttitle;
			public $maincontent_textdetail;
			public $maincontent_textslide;
			public $maincontent_headcontent;
			public $maincontent_detail;
			public $maincontent_email;
			public $maincontent_phone;
			public $maincontent_image;
			public $maincontent_concat;
			
			public function inserts() {
				$this->db->set('maincontent_id', $this->maincontent_id);
				$this->db->set('maincontent_texthead', $this->maincontent_texthead);
				$this->db->set('maincontent_texttitle', $this->maincontent_texttitle);
				$this->db->set('maincontent_textdetail', $this->maincontent_textdetail);
				$this->db->set('maincontent_textslide', $this->maincontent_textslide);
				$this->db->set('maincontent_headcontent', $this->maincontent_headcontent);
				$this->db->set('maincontent_detail', $this->maincontent_detail);
				$this->db->set('maincontent_email', $this->maincontent_email);
				$this->db->set('maincontent_phone', $this->maincontent_phone);
				$this->db->set('maincontent_image', $this->maincontent_image);
				$this->db->set('maincontent_concat', $this->maincontent_concat);
				
				$this->db->from('gcp_maincontent');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('gcp_maincontent');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('gcp_maincontent', $data, $key);
			}
			public function updates() {
				
			$this->db->set('maincontent_id', $this->maincontent_id);
				$this->db->set('maincontent_texthead', $this->maincontent_texthead);
				$this->db->set('maincontent_texttitle', $this->maincontent_texttitle);
				$this->db->set('maincontent_textdetail', $this->maincontent_textdetail);
				$this->db->set('maincontent_textslide', $this->maincontent_textslide);
				$this->db->set('maincontent_headcontent', $this->maincontent_headcontent);
				$this->db->set('maincontent_detail', $this->maincontent_detail);
				$this->db->set('maincontent_email', $this->maincontent_email);
				$this->db->set('maincontent_phone', $this->maincontent_phone);
				$this->db->set('maincontent_image', $this->maincontent_image);
				$this->db->set('maincontent_concat', $this->maincontent_concat);
				
				$this->db->from('gcp_maincontent');
				$this->db->where('maincontent_id', $this->maincontent_id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('gcp_maincontent');
				$this->db->where('maincontent_id', $this->maincontent_id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('gcp_maincontent');
				$this->db->order_by('maincontent_id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('gcp_maincontent');
				$this->db->where('maincontent_id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}