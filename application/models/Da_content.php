<?php
			class Da_content extends MY_Model { 
			public $content_id;
			public $content_head;
			public $content_head2;
			public $content_titleen;
			public $content_titleth;
			public $content_phone;
			public $content_logo;
			public $content_line;
			
			public function inserts() {
				$this->db->set('content_id', $this->content_id);
				$this->db->set('content_head', $this->content_head);
				$this->db->set('content_head2', $this->content_head2);
				$this->db->set('content_titleen', $this->content_titleen);
				$this->db->set('content_titleth', $this->content_titleth);
				$this->db->set('content_phone', $this->content_phone);
				$this->db->set('content_logo', $this->content_logo);
				$this->db->set('content_line', $this->content_line);
				
				$this->db->from('gcp_content');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('gcp_content');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('gcp_content', $data, $key);
			}
			public function updates() {
				
			$this->db->set('content_id', $this->content_id);
				$this->db->set('content_head', $this->content_head);
				$this->db->set('content_head2', $this->content_head2);
				$this->db->set('content_titleen', $this->content_titleen);
				$this->db->set('content_titleth', $this->content_titleth);
				$this->db->set('content_phone', $this->content_phone);
				$this->db->set('content_logo', $this->content_logo);
				$this->db->set('content_line', $this->content_line);
				
				$this->db->from('gcp_content');
				$this->db->where('content_id', $this->content_id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('gcp_content');
				$this->db->where('content_id', $this->content_id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('gcp_content');
				$this->db->order_by('content_id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('gcp_content');
				$this->db->where('content_id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}