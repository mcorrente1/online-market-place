<?php

/**
 * Class Name: Customer
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This class is used to manage a customer object. A Customer is a child or the User class which allows
 * for the management of specific, registered customer attributes and allows user activities to be tracked through
 * their specific user id.
 * Explanation of important functions: All of the methods are getters and setters.
 * Important data structures: None.
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required.
 */

require_once("User.php");

class Customer extends User
{
    private $firstName;
    private $lastName;
    private $email;
    private $address;
    private $phoneNumber;

    public function __construct($id, $fName, $lName, $eAddress, $newAddress, $pNum){
        $this->setUserId($id);
        $this->firstName = $fName;
        $this->lastName = $lName;
        $this->email = $eAddress;
        $this->address = $newAddress;
        $this->phoneNumber = $pNum;
    }

    public function initializeCustomer($fName, $lName, $eAddress, $newAddress, $pNum){
        $this->firstName = $fName;
        $this->lastName = $lName;
        $this->email = $eAddress;
        $this->address = $newAddress;
        $this->phoneNumber = $pNum;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }


    public function setFirstName($name){
        $this->firstName = $name;
    }

    public function setLastName($name){
        $this->lastName = $name;
    }

    public function setEmail($newEmail){
        $this->email = $newEmail;
    }

    public function setAddress($newAddress){
        $this->address = $newAddress;
    }

    public function setPhoneNumber($newPhone){
        $this->phoneNumber = $newPhone;
    }

    public function setPass($newPass){
        # @todo write method to update data base with new password
    }

}