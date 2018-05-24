<?php

		include('Da_download.php');

		class Mo_download extends Da_download {
			public function paditionpage($limit,$offset){
				$this->db->select('*');
				$this->db->from('gcp_download');
				$this->db->order_by("download_id","asc");
				$this->db->limit($limit,$offset);
				$query = $this->db->get()->result();
				return $query;
			}

			public function record_count() {
        		$this->db->select('*');
				$this->db->from('gcp_download');
				$query = $this->db->get()->num_rows();
				return $query;
    		}

    		 public function fetch_product($limit, $start) {
	        $this->db->limit($limit, $start);
	        $query = $this->db->get("gcp_download");
	 
	        if ($query->num_rows() > 0) {
	            foreach ($query->result() as $row) {
	                $data[] = $row;
	            }
	            return $data;
	        	}
	        	return false;
	   		}
				
		}
		