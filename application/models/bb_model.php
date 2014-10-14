<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bb_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    public function insert_customer($customer_data){
          $this->blank_tab('bb_customer');
          $this->db->insert_batch('bb_customer',$customer_data);
    }
    public function insert_merchant($merchant_data){
          $this->blank_tab('merchant');
          $this->db->insert_batch('merchant',$merchant_data);
    }
    public function blank_tab($table_name){
        $this->db->truncate($table_name);
    }
    
    
}