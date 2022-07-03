<?php

class Session {
    private $signed_in = false;
    public $user_id;
    public $message;
    public $count;

    function __construct() {
        //starts sessions
        session_start();
        $this->check_the_login();
        $this->check_message();
        $this->visitor_count();
    }

    public function visitor_count() {
        if(isset($_SESSION['count'])) {
            return $this->count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 1;
        }
    }

    //getter
    public function is_signed_in() {
        return $this->signed_in;
    }
    
    //logins the user
    public function login($user) {
        if($user) {
            //this assigns two things to $this->user_id
            //$user->id is from the User class id property
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }

    //logouts the user
    public function logout() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;   
    }

    //check if session user ID is set
    private function check_the_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    //outputs messages
    public function message($msg="") {
        if(!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    //checks if $_SESSION['message'] is set
    public function check_message() {
        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }

    }

}

$session = new Session();
$message = $session->message();

?>