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
     public function insert_bb_customer($customer_data){
//          $this->blank_tab('bb_customer');
          $res=$this->db->insert('bb_customer',$customer_data);
          return $res;
    }
     public function get_where($table_name,$where = FALSE){
//          $this->blank_tab('bb_customer');
         $this->db->from($table_name);
//         $this->db->from($table_name);
         if($where != FALSE){
          $this->db->where($where);   
         }
          $res = $this->db->get();
          if($res->num_rows() > 0){
              return $res->num_rows();
          }else{
              return FALSE;
          }
          
    }
    
}