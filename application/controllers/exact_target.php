<?php

require 'application/libraries/ET_Client.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exact_target extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function getList() {

        $myclient = new ET_Client();
        $list = new ET_List();
        $list->authStub = $myclient;
        $response = $list->get();
//        echo '<pre>';
//        print_r($response->results);
//        echo '</pre>';

        $arr = array();
        if (count($response->results) && is_array($response->results)) {
            foreach ($response->results as $key => $value) {

                $arr[$key]['ListID'] = $value->ID;
                $arr[$key]['CustomerKey'] = $value->CustomerKey;
                $arr[$key]['ListName'] = $value->ListName;
                $arr[$key]['Category'] = $value->Category;
                $arr[$key]['Type'] = $value->Type;
                $arr[$key]['CreatedDate'] = $value->CreatedDate;
                $arr[$key]['ModifiedDate'] = $value->ModifiedDate;
                $arr[$key]['ListClassification'] = $value->ListClassification;
                $arr[$key]['Description'] = $value->Description;
                $arr[$key]['CleintID'] = $value->Client->ID;
            }
        }

        return $arr;  
       // $this->et_model->insertList($arr);
    }

    public function getSubscribersbylist($ListID = FALSE) {
        // Retrieve all Subscribers on the List

        $myclient = new ET_Client();
        $getList = new ET_List_Subscriber();
        $getList->authStub = $myclient;

//        $getList->filter = array('Property' => 'ListID', 'SimpleOperator' => 'equals', 'Value' => $ListID);

        $getList->props = array("SubscriberKey", "CreatedDate", "Client.ID", "ListID", "Status");
        $response = $getList->get();
//        var_dump($response);die;
        $arr = array();
        if (count($response->results) && is_array($response->results)) {
            foreach ($response->results as $key => $value) {

                $arr[$key]['ListID'] = $value->ListID;
                $arr[$key]['SubscriberID'] = $value->SubscriberKey;
                $arr[$key]['Status'] = $value->Status;
                $arr[$key]['CreatedDate'] = $value->CreatedDate;
            }
        }

        return $arr;
//        $this->et_model->blank_tab('et_subscriber_list_rel');
//        $this->et_model->insert_tab('et_subscriber_list_rel', $arr);
    }

    public function get_unSubscribe_list() {

        $myclient = new ET_Client();
        $retSub = new ET_Subscriber();
        $arr = array();
        $retSub->authStub = $myclient;
        $retSub->filter = array('Property' => 'Status', 'SimpleOperator' => 'equals', 'Value' => 'Unsubscribed');
        $getResult = $retSub->get();
       
        return $getResult->results;

    }

    public function get_Subscriber_detail() {
        $myclient = new ET_Client();


        $retSub = new ET_Subscriber();
        $retSub->authStub = $myclient;
        $retSub->filter = array('Property' => 'Status', 'SimpleOperator' => 'equals', 'Value' => 'Active');
        $arr = array();
        $response = $retSub->get();
//        echo '<pre>';
//        print_r($response->results);
//        echo '</pre>';
        if (count($response->results) && is_array($response->results)) {
            foreach ($response->results as $key => $value) {

                $arr[$key]['EmailAddress'] = $value->EmailAddress;
                $arr[$key]['CreatedDate'] = $value->CreatedDate;
                $arr[$key]['SubscriberID'] = $value->SubscriberKey;
                $arr[$key]['Status'] = $value->Status;

                if (is_array($value->Attributes)) {
                    foreach ($value->Attributes as $val) {

                        if ($val->Name == 'Date of Birth') {
                            $arr[$key]['DOB'] = $val->Value;
                        }
                        if ($val->Name == 'First Name') {
                            $arr[$key]['FirstName'] = $val->Value;
                        }
                        if ($val->Name == 'Last Name') {
                            $arr[$key]['LastName'] = $val->Value;
                        }
                        if ($val->Name == 'Full Name') {
                            $arr[$key]['FullName'] = $val->Value;
                        }
                    }
                }
            }
        }
        return $arr;
//        $this->et_model->blank_tab('et_subscriber');
//        $this->et_model->insert_tab('et_subscriber', $arr);
    }

    public function updateemail() {

        $myclient = new ET_Client();
        $patchEmail = new ET_Email();
        $patchEmail->authStub = $myclient;
        $patchEmail->props = array("CustomerKey" => $NameOfTestEmail, "Name" => $NameOfTestEmail, "Subject" => "Created with the SDK!!! Now with more !!!!", "HTMLBody" => "<b>Some HTML Content Goes here. NOW WITH NEW CONTENT</b>");
        $patchResult = $patchEmail->patch();
        print_r('Patch Status: ' . ($patchResult->status ? 'true' : 'false') . "\n");
        print 'Code: ' . $patchResult->code . "\n";
        print 'Message: ' . $patchResult->message . "\n";
        print 'Results Length: ' . count($patchResult->results) . "\n";
        print 'Results: ' . "\n";
        print_r($patchResult->results);
        print "\n---------------\n";
// Retrieve Updated Email
        print "Retrieve Updated Email \n";
        $getEmail = new ET_Email();
        $getEmail->authStub = $myclient;
        $getEmail->filter = array('Property' => 'CustomerKey', 'SimpleOperator' => 'equals', 'Value' => $NameOfTestEmail);
        $getEmail->props = array("ID", "PartnerKey", "CreatedDate", "ModifiedDate", "Client.ID", "Name", "Folder", "CategoryID", "HTMLBody", "TextBody", "Subject", "IsActive", "IsHTMLPaste", "ClonedFromID", "Status", "EmailType", "CharacterSet", "HasDynamicSubjectLine", "ContentCheckStatus", "Client.PartnerClientKey", "ContentAreas", "CustomerKey");
        $getResponse = $getEmail->get();
        print_r('Get Status: ' . ($getResponse->status ? 'true' : 'false') . "\n");
        print 'Code: ' . $getResponse->code . "\n";
        print 'Message: ' . $getResponse->message . "\n";
        print_r('More Results: ' . ($getResponse->moreResults ? 'true' : 'false') . "\n");
        print 'Results Length: ' . count($getResponse->results) . "\n";
        print 'Results: ' . "\n";
        print_r($getResponse->results);
        print "\n---------------\n";
    }

    public function create_list($listname, $desc = 'This list was created with the PHPSDK', $type = 'Private') {
        $myclient = new ET_Client();
        $postContent = new ET_List();
        $postContent->authStub = $myclient;
        $postContent->props = array("ListName" => $listname, "Description" => $desc, "Type" => $type);
        $postResponse = $postContent->post();
        if ($postResponse->status) {
            echo $postResponse->results[0]->NewID;
        } else {
            echo 'failed to create list';
        }
    }

    public function delete_list($list_id) {
        // Delete List

        $deleteList = new ET_List();
        $deleteList->authStub = $myclient;
        $deleteList->props = array("ID" => $list_id);
        $deleteResponse = $deleteList->delete();

        print_r($deleteResponse->results);
    }

    public function add_email_list($list_id = FALSE, $data = FALSE) {
        try {
            $myclient = new ET_Client();
            $subs[] = array("EmailAddress" => "SDKTest9091@bh.exacttarget.com", "SubscriberKey" => '99999', "Attributes" => array(array("Name" => "First Name", "Value" => "Mac"), array("Name" => "List Name", "Value" => "Testing")));
            $subs[] = array("EmailAddress" => "SDKTest9092@bh.exacttarget.com", "SubscriberKey" => '99989', "Attributes" => array(array("Name" => "First Name", "Value" => "Mac"), array("Name" => "List Name", "Value" => "Testing")));

            $newListID = $list_id;
//            $myclient->props = array("CustomerKey" => 'All Subscribers - 2435727');
            // Adding Multiple Subscribers To a List in Bulk
            $response = $myclient->AddSubscribersToLists($subs, array('340876'));
            print 'Code: ' . $response->code . "\n";
            print 'Message: ' . $response->message . "\n";
            print 'Results Length: ' . count($response->results) . "\n";
            print "Results: \n";
            echo '<pre>';
            print_r($response->results);
            echo '</pre>';
            print "\n---------------\n";
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function add() {
        $myclient = new ET_Client();
// NOTE: These examples only work in accounts where the SubscriberKey functionality is not enabled
// SubscriberKey will need to be included in the props if that feature is enabled
        $SubscriberTestEmail = "test@mail.com";
// Create Subscriber
        print "Create Subscriber \n";
        $subCreate = new ET_Subscriber();
        $subCreate->authStub = $myclient;
        $subCreate->props = array("EmailAddress" => $SubscriberTestEmail);
        $postResult = $subCreate->post();
        print_r('Post Status: ' . ($postResult->status ? 'true' : 'false') . "\n");
        print 'Code: ' . $postResult->code . "\n";
        print 'Message: ' . $postResult->message . "\n";
        print 'Results Length: ' . count($postResult->results) . "\n";
        print 'Results: ' . "\n";
        print_r($postResult->results);
        print "\n---------------\n";
    }

    public function et_mdb_update() {
        $this->et_model->update_mdb();
    }

    public function unsubscribe_email($email = 'danielbowling@gmail.com') {

        $myclient = new ET_Client();
        $subPatch = new ET_Subscriber();
        $subPatch->authStub = $myclient;
        $subPatch->props = array("EmailAddress" => $email, "SubscriberKey" => '0000002', "Status" => "Unsubscribed");
        $patchResult = $subPatch->patch();
        print_r('Patch Status: ' . ($patchResult->status ? 'true' : 'false') . "\n");
        print 'Code: ' . $patchResult->code . "\n";
        print 'Message: ' . $patchResult->message . "\n";
        print 'Results Length: ' . count($patchResult->results) . "\n";
        print 'Results: ' . "\n";
        print_r($patchResult->results);
    }

}

/* End of file exact_target.php */
/* Location: ./application/controllers/exact_target.php */