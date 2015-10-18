<?php

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
}