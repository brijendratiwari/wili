<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Et_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertList($data) {

        if (is_array($data) && $data != NULL && (count($data) > 0)) {
            $this->blank_tab('et_list');
            $this->db->insert_batch('et_list', $data);
        }
    }

    public function getList() {

        $res = $this->db->get('et_list');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    public function blank_tab($table_name) {
        $this->db->truncate($table_name);
    }

    public function insert_tab($table_name, $data) {
        if (is_array($data) && $data != NULL && (count($data) > 0)) {
            $this->db->insert_batch($table_name, $data);
        }
    }

    public function update_mdb() {
        $res = $this->db->query('SELECT FirstName,LastName,EmailAddress as email,DOB,1 as status FROM et_subscriber WHERE et_subscriber.EmailAddress NOT IN (SELECT email FROM master_subscriber)');
        
        if ($res->num_rows() > 0)
        {
            $data = $res->result_array();
            $rel_data = array();
            foreach ($data as $key => $val){
                $this->db->insert('master_subscriber', $val);
                $rel_data[$key]['subscriber_id'] = $this->db->insert_id();
                $rel_data[$key]['store_id'] = '2';
            }
            $this->db->insert_batch('ms_to_store_rel', $rel_data);
            
        }
    }

}

?>
