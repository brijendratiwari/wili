<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sync extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sync_model');
        $this->load->model('et_model');
        require_once('exact_target.php');
    }

    public function StartAutoSync() {
        $status = $this->sync_model->stratautosync();
        if ($status == 1) {
            echo 'yes';
        }
        die();
    }

    public function StopAutoSyc() {
        $status = $this->sync_model->stopautosync();
        if ($status == 1) {
            echo 'yes';
        }
        die();
    }

    public function StartSync() {
        $storeid = $this->input->post('sync');
        $type = $this->input->post('type');
        $str_id = $this->sync_model->setTempSync($storeid);
        $this->ExactTargetSync($str_id,$type,$storeid);
    }

    public function ExactTargetSync($id,$type,$storeid) {

        $controller_et = new Exact_target();
        $data = array();
        
        if ($this->sync_model->check($id))
            $et_list = $controller_et->getList();

        if ($this->sync_model->check($id))
            $get_Subscriber_detail = $controller_et->get_Subscriber_detail();

        if ($this->sync_model->check($id))
            $getSubscribersbylist = $controller_et->getSubscribersbylist();

        if ($this->sync_model->check($id))
            $get_unSubscribe_list = $controller_et->get_unSubscribe_list();

        if ($this->sync_model->check($id)) {
            $this->et_model->insertList($et_list);  // updating the list

            $old_sub = $this->et_model->get_count('et_subscriber');    // counting the old sub data
            $this->et_model->blank_tab('et_subscriber');    // updating the sus
            $this->et_model->insert_tab('et_subscriber', $get_Subscriber_detail);

            if($old_sub > 0){
            $data['SubscribedCount'] = count($get_Subscriber_detail) - $old_sub;
            }else{
                $data['SubscribedCount'] = 0;
            }
            $this->et_model->blank_tab('et_subscriber_list_rel');
            $this->et_model->insert_tab('et_subscriber_list_rel', $getSubscribersbylist);

            if (count($get_unSubscribe_list) && is_array($get_unSubscribe_list)) {
                foreach ($get_unSubscribe_list as $key => $value) {

                    $arr[$key]['email'] = $value->EmailAddress;
                    $arr1[$key]['email'] = $value->EmailAddress;

                    $arr[$key]['unsubscribed_date'] = $value->UnsubscribedDate;
                    $arr1[$key]['status'] = 0;
                    $arr[$key]['unsubscriber_from'] = $storeid;

                    if (is_array($value->Attributes)) {
                        foreach ($value->Attributes as $val) {

                            if ($val->Name == 'Date of Birth') {
                                $arr[$key]['DOB'] = $val->Value;
                                $arr1[$key]['DOB'] = $val->Value;
                            }
                            if ($val->Name == 'First Name') {
                                $arr[$key]['firstname'] = $val->Value;
                                $arr1[$key]['firstname'] = $val->Value;
                            }
                            if ($val->Name == 'Last Name') {
                                $arr[$key]['lastname'] = $val->Value;
                                $arr1[$key]['lastname'] = $val->Value;
                            }
                        }
                    }
                    $mid = $this->et_model->insert_mastersubscriber($value->EmailAddress, $arr1[$key]);
                    $arr[$key]['ms_id'] = $mid;
                }
            }
            
            $old_unsub = $this->et_model->get_count('all_unsubscriber',$storeid);    // counting the old sub data
//            $this->et_model->blank_tab('all_unsubscriber');
            $this->et_model->insert_all_unsubscriber($arr);
            $data['UnSubscribedCount'] = count($arr) - $old_unsub ;
            $data['type'] = $type;
            $data['SyncTime'] = date('Y-m-d h:m:s', time());
            $data['store_id'] = $storeid;
            
            $controller_et->et_mdb_update();
            $this->sync_model->delTempSync($id);
            $this->sync_model->insert_sync_updates($data);
            $data['SyncTime'] = date('h:ma', time());
        }
        echo json_encode($data);
        die;
    }

}
