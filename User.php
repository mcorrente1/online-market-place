<?php

/**
 * Created by PhpStorm.
 * User: mattcorrente
 * Date: 6/11/17
 * Time: 9:50 AM
 */
class User
{
    private $userId;

    # default constructor sets user to guest
    function __construct()
    {
        $this->userId = "guest";
    }

    public function getUserId(){
        return $this->userId;
    }

    protected function setUserId($id){
        $this->userId = $id;
    }

}