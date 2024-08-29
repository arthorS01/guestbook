<?php


namespace App\Services;

trait Auth{

    public function isLoggedIn(){
        if(isset($_SESSION["active"]) && $_SESSION["active"]== true){
            return true;
        }
        return false;
    }
    
    public function logout(){
        //check if user is logged in
        if($this->isLoggedIn()){
             //clear the session
             session_destroy();
             header("location:/guestbook/login");
        }else{
            die("error trying to logout");
        }
     }
}