<?php
			class Da_news extends MY_Model { 
			public $news_id;
			public $news_title;
			public $news_detail;
			public $news_document;
			public $news_image;
			
			public function inserts() {
				$this->db->set('news_id', $this->news_id);
				$this->db->set('news_title', $this->news_title);
				$this->db->set('news_detail', $this->news_detail);
				$this->db->set('news_document', $this->news_document);
				$this->db->set('news_image', $this->news_image);
				
				$this->db->from('tbl_news');
				return $this->db->insert();
			}
			
			public function inserts_array($data=null) {
				$this->db->set($data);
				$this->db->from('tbl_news');
				return $this->db->insert();
			}
			public function updates_array($data=null,$key=null) {
				return $this->db->update('tbl_news', $data, $key);
			}
			public function updates() {
				
			$this->db->set('news_id', $this->news_id);
				$this->db->set('news_title', $this->news_title);
				$this->db->set('news_detail', $this->news_detail);
				$this->db->set('news_document', $this->news_document);
				$this->db->set('news_image', $this->news_image);
				
				$this->db->from('tbl_news');
				$this->db->where('news_id', $this->news_id);
				return $this->db->update();
			}

			public function deletes() {
				$this->db->from('tbl_news');
				$this->db->where('news_id', $this->news_id);
				$this->db->delete();
			}

			public function get_all() {
				$this->db->from('tbl_news');
				$this->db->order_by('news_id', 'ASC');
				return $this->db->get()->result();
			}

			public function get_by_key($key) {
				$this->db->select('*');
				$this->db->from('tbl_news');
				$this->db->where('news_id', $key);
				$query = $this->db->get()->result();
				return $query;
			}

		}