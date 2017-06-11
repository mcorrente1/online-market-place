<?php

/**
 * Created by PhpStorm.
 * User: mattcorrente
 * Date: 6/11/17
 * Time: 9:56 AM
 */
class Customer extends User
{
    private $firstName;
    private $lastName;
    private $creditCard;
    private $email;
    private $address;
    private $phoneNumber;

    public function __construct($fName, $lName, $cc, $eAddress, $newAddress, $pNum){
        $this->firstName = $fName;
        $this->lastName = $lName;
        $this->creditCard = $cc;
        $this->email = $eAddress;
        $this->address = $newAddress;
        $this->phoneNumber = $pNum;
    }

    public function initializeCustomer($fName, $lName, $cc, $eAddress, $newAddress, $pNum){
        $this->firstName = $fName;
        $this->lastName = $lName;
        $this->creditCard = $cc;
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

    public function getCreditCard(){
        return $this->creditCard;
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
        return $this->firstName = $name;
    }

    public function setLastName($name){
        return $this->lastName = $name;
    }

    public function setCreditCard($cardInfo){
        return $this->creditCard= $cardInfo;
    }

    public function setEmail($newEmail){
        return $this->email = $newEmail;
    }

    public function setAddress($newAddress){
        return $this->address = $newAddress;
    }

    public function setPhoneNumber($newPhone){
        return $this->phoneNumber = $newPhone;
    }

    public function setPass($newPass){
        # @todo write method to update data base with new password
    }

}