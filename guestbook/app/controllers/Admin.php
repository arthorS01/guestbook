<?php

namespace App\Controllers;

use App\App;
use App\Services\Auth;
use App\Models\Book;


class Admin{

use Auth;

    public function index()
    {

        if($this->isLoggedIn()){
            App::$view->setPath("dashboard");
            $books = (new Book)->all(["userId"=>$_SESSION["user"]->id]);
            return   App::$view->render(true,["pageTitle"=>"Dashboard","user"=>$_SESSION["user"],"books"=>$books]);

        }

        header("location:/guestbook/login");
        
      
    }
}