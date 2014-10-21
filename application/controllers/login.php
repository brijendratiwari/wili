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
        $this->load->model('bb_model');
        require_once('black_boxx.php');
        require_once('exact_target.php');
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

    public function sign_up() {
        $this->load->view('sign-up/sign_up.php');
    }

    public function thank_you() {
        $this->load->view('sign-up/thankyou.php');
    }

    public function createuser() {
        $black_boxx = new Black_boxx();
        $exact_target = new Exact_target();
        $res = $this->bb_model->get_where('bb_customer', array("email" => $_POST['email']));
        if ($res) {
//            var_dump($res);die;
//            $this->session->set_flashdata('msg', "user allready registered");
//            redirect('login/sign_up');
            //update subscriber if exist in BB..
            $data = array("firstname" => $_POST['firstname'], "lastname" => $_POST['lastname'], "dob" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] . "/" . $_POST['birthYear'], "mobile_number" => $_POST['mobile_number']);
            $update_info = $this->bb_model->update_bb_customer($_POST['email'], $data);
            //*********************************
            if ($update_info) {
                 redirect('login/thank_you');
            }
        } else {
            // add customer in BB .....
            $data = array("first_name" => $_POST['firstname'], "last_name" => $_POST['lastname'], "date_of_birth" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] . "/" . $_POST['birthYear'], "password" => $_POST['password'], "email" => $_POST['email'], "phone_number" => "", "mobile_number" => $_POST['mobile_number']);
            $response = $black_boxx->add_user($data);
            //********************** 
            $user_data = json_decode($response, TRUE);
//            var_dump($user_data);
            $bb_customer = array(
                "customer_id" => $user_data["id"],
                "firstname" => $user_data["first_name"],
                "lastname" => $user_data["last_name"],
                "merchant_id" => $user_data["merchant_id"],
                "email" => $user_data["email"],
                "dob" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] . "/" . $_POST['birthYear'],
                "mobile_number" => $_POST['mobile_number'],
                "created" => $user_data["updated_at"],
                "bb_id" => 2,
               "Status" => "Active"
            );
            $res = $this->bb_model->insert_bb_customer($bb_customer);
            if ($res) {
//                $this->et_model->insert_mastersubscriber(array("email"=>$_POST["email"],"firstname"=>$_POST["firstname"],"lastname"=>$_POST["lastname"],"DOB" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] . "/" . $_POST['birthYear'],"status"=>1,"CreatedDate" => $user_data["updated_at"]),$user_data["email"]);
                $this->bb_model->insert_bb_customer_rel($_POST['pref'],$user_data["email"],$user_data["id"]);
                // add subscriber in ET...... if exist then upadate status to "Active"
                $res1 = $this->et_model->get_et_subscriber($user_data["email"]);
                if ($res1) {
                    $data = array("EmailAddress" => $_POST['email'], "SubscriberKey" => $res1[0]['SubscriberID']);
                    $response = $exact_target->add_email_list($_POST['pref'], $data);
                    var_dump($response);
                    if ($response[0]->StatusCode == "OK") {
                        $this->et_model->add_etsubscriber_rel($_POST['pref'],$res1[0]['SubscriberID']);
                    }
                } else {
                    $subkey=time();
                    $subs[] = array("EmailAddress" => $_POST['email'], "SubscriberKey" => $subkey, "Attributes" => array(array("Name" => "First Name", "Value" => $_POST['firstname']), array("Name" => "Last Name", "Value" => $_POST['lastname'])));
                    $response = $exact_target->add_email_list($_POST['pref'], $subs);
//                    var_dump($response);die;
                    if ($response[0]->StatusCode == "OK") {
                        $data = array("FirstName" => $_POST['firstname'], "LastName" => $_POST['lastname'], "DOB" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] . "/" . $_POST['birthYear'], "SubscriberID" => $subkey, "EmailAddress" => $_POST['email'], "Status" => "Active", "CreatedDate" => date("Y-m-d h:m:s", time()));
                        $this->et_model->add_etsubscriber($data);
                        $this->et_model->add_etsubscriber_rel($_POST['pref'],$subkey);
                    }
                }
            }
        }
        redirect('login/thank_you');
    }

}
