<?php

	include('Da_product.php');

		class Mo_product extends Da_product {

			public function get_all_product ()
			{
				$this->db->from('tbl_product');
				$this->db->join('tbl_category', 'tbl_category.cate_id = tbl_product.cate_id', 'left');
				$this->db->order_by('pro_id', 'ASC');
				return $this->db->get()->result();
			}

		}
		