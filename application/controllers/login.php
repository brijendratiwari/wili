<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index() {


        $this->form_validation->set_rules('email_address', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check');
        if ($this->form_validation->run() == FALSE && $this->session->userdata('logged_in') == FALSE) {
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/login.php');
            $this->load->view('/common/footer.php');
        } else {
//               var_dump($this->session->userdata('logged_in'));
//                $this->session->unset_userdata('logged_in');  
            redirect('home/index');
        }
    }

    public function check($password) {
        //Field validation succeeded.&nbsp; Validate against database
        $email = $this->input->post('email_address');

        //query the database
        $result = $this->login_model->check_login($email, $password);

        if (!empty($result)) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'email' => $row->email,
                );

                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check', 'Invalid username or password');
            return false;
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('login/index');
    }
    
    public function createuser(){
        var_dump($_POST);
    }

}
