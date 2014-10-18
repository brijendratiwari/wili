<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('et_model');
        $this->load->model('sync_model');
    }

    public function index() {

        if ($this->session->userdata('logged_in')) {
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/home.php');
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function sync() {
        if ($this->session->userdata('logged_in')) {
            $data['autosync'] = $this->sync_model->checkautosync();
            $data['getLastSystemSyncsub'] = $this->sync_model->getLastSystemSyncsub();
             $data['UnSubscriber'] = $this->sync_model->get_UnSubscriber();
             $data['getAutoSyncUpdate'] = $this->sync_model->get_getAutoSyncUpdate();
//            var_dump($data['getAutoSyncUpdate']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/sync.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function exact_target() {

        if ($this->session->userdata('logged_in')) {

            $data['list'] = $this->et_model->getList();
            $data['Subscriber'] = $this->et_model->get_etSubscriber();
            $data['UnSubscriber'] = $this->et_model->get_UnSubscriber();
            $data['FilterSubscriber'] = $this->et_model->get_etFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
//            var_dump($data['getLastSystemSyncsub']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/exact_target.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }
    public function black_boxx() {

        if ($this->session->userdata('logged_in')) {

            $data['list'] = $this->et_model->getList();
            $data['Subscriber'] = $this->et_model->get_etSubscriber();
            $data['UnSubscriber'] = $this->et_model->get_UnSubscriber();
            $data['FilterSubscriber'] = $this->et_model->get_etFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
//            var_dump($data['getLastSystemSyncsub']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/blackboxx.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

}
