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
            $data = $res->result_array();

            foreach ($data as $key => $value) {
                $cou = $this->db->get_where('et_subscriber_list_rel', 'ListID =' . $value['ListID']);
                $data[$key]['total'] = $cou->num_rows();
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function blank_tab($table_name) {
        $this->db->truncate($table_name);
    }

    public function get_count($table_name,$storeid = FALSE){
        if($storeid != FALSE){
            $this->db->where('unsubscriber_from', $storeid);
        }
        $res = $this->db->get($table_name);
        return $res->num_rows();
    }

        public function insert_tab($table_name, $data) {
        if (is_array($data) && $data != NULL && (count($data) > 0)) {
            $this->db->insert_batch($table_name, $data);
        }
    }

    public function update_mdb() {
        $res = $this->db->query('SELECT FirstName,LastName,EmailAddress as email,DOB,1 as status FROM et_subscriber WHERE et_subscriber.EmailAddress NOT IN (SELECT email FROM master_subscriber)');

        if ($res->num_rows() > 0) {
            $data = $res->result_array();
         
            $rel_data = array();
            foreach ($data as $key => $val) {
                $this->db->insert('master_subscriber', $val);
                $rel_data[$key]['subscriber_id'] = $this->db->insert_id();
                $rel_data[$key]['store_id'] = '2';
            }
            $this->db->insert_batch('ms_to_store_rel', $rel_data);
        }
    }

    public function get_etSubscriber() {
        $res = $this->db->get('et_subscriber');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }
    public function get_UnSubscriber() {
        $res = $this->db->get('all_unsubscriber');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function get_etFilterSubscriber() {

        $data = array();
        $query = "select * from et_subscriber where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01'";
        $query1 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m", strtotime("-1 months")) . "-01' and '" . date("Y-m", strtotime("-0 months")) . "-01'";
        $query2 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m", strtotime("-2 months")) . "-01' and '" . date("Y-m", strtotime("-1 months")) . "-01'";
        $query3 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "'";
        $query4 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "'";
//        $query1 = "select count(id) from et_subscriber where CreatedDate >= DATEADD(MONTH, -1, GETDATE()) " ;

        $res = $this->db->query($query);
        $res1 = $this->db->query($query1);
        $res2 = $this->db->query($query2);
        $res3 = $this->db->query($query3);
        $res4 = $this->db->query($query4);
        $data['year'] = $res->num_rows();
        $data['month'] = $res1->num_rows();
        $data['previous_month'] = $res2->num_rows();
        $data['last_thirty'] = $res3->num_rows();
        $data['previous_thirty'] = $res4->num_rows();

        return $data;
    }

    public function insert_mastersubscriber($email = FALSE, $data) {
        $this->db->where('email', $email);
        $res = $this->db->get('master_subscriber');
        if ($res->num_rows() > 0) {
            $arr = array('status' => 0);
            $this->db->where('email', $email)
                     ->update('master_subscriber', $arr);
            $data = $res->result_array();
            return $data[0]['id'];
        } else {
            $this->db->insert('master_subscriber', $data);
            return $this->db->insert_id();
        }
    }

    public function insert_all_unsubscriber($data) {
//      var_dump($data);die;
        foreach ($data as $unsubscribed) {
            $this->db->where('email', $unsubscribed["email"]);
            $this->db->where('unsubscriber_from', $unsubscribed["unsubscriber_from"]);
            $res = $this->db->get('all_unsubscriber');
            if ($res->num_rows() > 0) {
                
            } else {
                $this->db->insert('all_unsubscriber', $unsubscribed);
               
            }
        }
    }

}

?>
