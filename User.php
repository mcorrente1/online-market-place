<?php

/**
 * Class Name: User
 * Date: 07/27/17
 * Programmer: Matthew Corrente
 * Description: This class is used to manage a User object. A User is the parent class of more specific users (such as
 * customer and admin).  It only manages the id, which is defaulted to guest until a User logs in.
 * Explanation of important functions: All of the methods are getters and setters.
 * Important data structures: None.
 * Algorithm choice: this class contains very basic functionality, so no specific algorithms were required.
 */

class User
{
    private $userId;

    # default constructor sets user to guest
    function __construct()
    {
        # -1 represents a guest
        $this->userId = -1;
    }

    public function getUserId(){
        return $this->userId;
    }

    protected function setUserId($id){
        $this->userId = $id;
    }

}