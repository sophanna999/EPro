<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fontend_model
 *
 * @author USER-PC05
 */
class fontend_model extends MY_Model {
    //put your code here
    public function get_demo_blog_categories(){
        return $this->db->get('demo_blog_categories')->result();
    }
}
