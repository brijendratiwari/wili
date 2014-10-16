<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sync_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function stratautosync() {
        $this->db->truncate('autosyncdetail');
        $this->db->insert('autosyncdetail', array('sync_flag' => 1));
        return $this->db->insert_id();
    }

    public function stopautosync() {
        $this->db->truncate('autosyncdetail');
        $this->db->insert('autosyncdetail', array('sync_flag' => 0));
        return $this->db->insert_id();
    }

    public function checkautosync() {

        $res = $this->db->select('sync_flag')
                ->from('autosyncdetail')
                ->get();
        if ($res->num_rows() > 0) {
            $data = $res->result_array();
            return $data[0]['sync_flag'];
        } else {
            return 0;
        }
    }

    public function setTempSync($store_id) {
        $res = $this->db->get_where('temp_sync_check', array('store_id' => $store_id));
        if ($res->num_rows() == 0) {
            $this->db->insert('temp_sync_check', array('store_id' => $store_id, 'status' => 1));
            return $this->db->insert_id();
        } else {
            $this->db->update('temp_sync_check', array('status' => 1), array('store_id' => $store_id));
            $data = $res->result_array();
            return $data[0]['id'];
        }
    }
    public function delTempSync($id) {
        $this->db->delete('temp_sync_check', array('id'=>$id));
    }

    public function check($id) {
        $res = $this->db->get_where('temp_sync_check', array('id' => $id));
        if ($res->num_rows > 0)
        {
            $data = $res->result_array();
            return $data[0]['status'];
        }
        else
            return 0;
    }

   public function insert_sync_updates($data){
       $this->db->insert("sync_updates",$data);
   }
    
}
