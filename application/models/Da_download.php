<?php
			class Da_download extends MY_Model { 
			public $download_id;
			public $download_head;
			public $download_name;
			public $download_date;
			
			public function inserts() {
				$this->db->set('download_id', $this->download_id);
				$this->db->set('download_head', $this->download_head);
				$this->db->set('download_name', $this->download_name);
				$this->db->set('download_date', $this->download_date);
				
				$this->db->from('gcp_download');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('gcp_download');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('gcp_download', $data, $key);
			}
			public function updates() {
				
			$this->db->set('download_id', $this->download_id);
				$this->db->set('download_head', $this->download_head);
				$this->db->set('download_name', $this->download_name);
				$this->db->set('download_date', $this->download_date);
				
				$this->db->from('gcp_download');
				$this->db->where('download_id', $this->download_id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('gcp_download');
				$this->db->where('download_id', $this->download_id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('gcp_download');
				$this->db->order_by('download_id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('gcp_download');
				$this->db->where('download_id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}