<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
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
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/sync.php');
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }
    public function exact_target() {

        if ($this->session->userdata('logged_in')) {
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/exact_target.php');
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

}
