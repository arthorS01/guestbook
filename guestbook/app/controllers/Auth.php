<?php

namespace App\Controllers;

use resources\view\View;
use App\Models\{Category,Task};
use App\Services\Sanitizer;
use App\Models\User;
use App\App;
use App\Services\Auth as ServiceAuth;

class Auth{

    use ServiceAuth;

    public function login(){
        
        App::$view->setPath("login");
        return App::$view->render(true,["pageTitle"=>"Guest|login"]);
    }

    public function register(){

        App::$view->setPath("register");
        return App::$view->render(true,["pageTitle"=>"Guest|login"]);
       
    }

    public function register_user(){
       
            extract($_POST);
            
            //validate details

            $user = new User;

            $user->fname = Sanitizer::clean($fname);
            $user->lname = Sanitizer::clean($lname);
            $user->email = Sanitizer::clean($email);
            $user->password = password_hash(Sanitizer::clean($password),PASSWORD_DEFAULT);

            if($user->save()){
                App::$view->setPath("success");
                return App::$view->render(false,["message"=>"your account has been created successfully"]);
            }else{
                die("Error trying to create your account");
            }


    }


    public function login_user(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            extract($_POST);
           
            $email = Sanitizer::clean($email);
            $password = Sanitizer::clean($password);

            $user = new User;

            $user = $user->findOrFail(["email"=>$email]);
            
            if(password_verify($password,$user->password)){
                
                $_SESSION["user"]= $user;
                $_SESSION["active"] = true;

                //redirect to dashboard
                header("location:/guestbook/admin/dashboard");
            }else{
                die("in valid details");
            }
        }
        
    }

    
}