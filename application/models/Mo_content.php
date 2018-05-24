<?php

		include('Da_content.php');

		class Mo_content extends Da_content {

		public function get_content() {
			$this->db->select('*');
			$this->db->from('gcp_content');
			$query = $this->db->get()->result();
			return $query;
		}
	}
		