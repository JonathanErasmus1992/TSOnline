<?php

/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */

class Customer
{

    private $id = "";
    private $IDNumber = "";
    private $username = "";
    private $password = "";
    private $firstNames = "";
    private $lastName = "";
    private $contact = "";

    public function createCustomer($tmpID, $tmpIDNumber, $tmpUsername, $tmpPassword, $tmpFirstNames, $tmpLastName, $tmpContact){
        $this->id = $tmpID;
        $this->IDNumber = $tmpIDNumber;
        $this->username = $tmpUsername;
        $this->password = $tmpPassword;
        $this->firstNames = $tmpFirstNames;
        $this->lastName = $tmpLastName;
        $this->contact = $tmpContact;
    }

    public function setID($newVal){
        $this->id = $newVal;
    }
    public function getID(){
        return $this->id;
    }

    public function setIDNumber($newVal){
        $this->IDNumber = $newVal;
    }
    public function getIDNumber(){
        return $this->IDNumber;
    }

    public function setUsername($newVal){
        $this->username = $newVal;
    }
    public function getUsername(){
        return $this->username;
    }

    public function setPassword($newVal){
        $this->password = $newVal;
    }
    public function getPassword(){
        return $this->password;
    }

    public function setFirstNames($newVal){
        $this->firstNames = $newVal;
    }
    public function getFirstNames(){
        return $this->firstNames;
    }

    public function setLastName($newVal){
        $this->lastName = $newVal;
    }
    public function getLastName(){
        return $this->lastName;
    }

    public function setContact($newVal){
        $this->contact = $newVal;
    }
    public function getContact(){
        return $this->contact;
    }

    public function changePassword($tmpCustomerID, $tmpNewPassword){
        $service_url = "http://toystore-jsme.rhcloud.com/customer/changepassword?customerID=".$tmpCustomerID.
            "&newPassword=".$tmpNewPassword;
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error has occurred during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $json_array = array();
        unset($json_array);
        $json_array = json_decode($curl_response, false, 512, JSON_BIGINT_AS_STRING);
        if (isset($json_array->response->status) && $json_array->response->status == 'ERROR') {
            die('error occurred: ' . $json_array->response->errormessage);
        }

        if(isset($curl_response)) {
            session_start();
            $_SESSION['password'] = $tmpNewPassword;
            session_write_close();
        }
    }

    public function deactivateAccount($tmpCustomerID){
        $service_url = "http://toystore-jsme.rhcloud.com/customer/delete?customerid=".$tmpCustomerID;
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error has occurred during curl exec. Additional info: ' . var_export($info));
        }
        curl_close($curl);
        $json_array = json_decode($curl_response, true, 512, JSON_BIGINT_AS_STRING);
        if (isset($json_array->response->status) && $json_array->response->status == 'ERROR') {
            die('error occurred: ' . $json_array->response->errormessage);
        }
    }
}