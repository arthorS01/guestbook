<?php

namespace App\Controllers;

use App\App;
use App\Models\{Book as BookModel,Model};
use App\Services\{Auth,Sanitizer};


class Book{

use Auth;

    public function create()
    {
       if($_SERVER["REQUEST_METHOD"]=="POST"){

            extract($_POST);

            $book = new BookModel;

            $book->name = $name;

            if($book->save()){
                //success message
                App::$view->setPath("success");
                return App::$view->render(false,["pageTitle"=>"success","message"=>"Your guestbook '{$name}' was added successfully"]);
            }else{
                die("problem dey o");
            }

       }else{
        die("invalid method");
       }   
    }

    public function delete(){
       
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            extract($_POST);

            $book_id = Sanitizer::clean($id);

            $book = (new BookModel)->findOrFail(["id"=>$book_id]);

            if(is_bool($book)){
                die("problem dey o");
            }else{
               $book->delete();
                header("location:/guestbook/admin/dashboard");
            }
        }
    }

    public function view()
    {
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            extract($_POST);

            $book_id = Sanitizer::clean($bookId);

            $msgs = (new Message)->all(["bookId"=>$book_id]);

           App::$view->setPath("messages");
           return App::$view->render(true,["pageTitle"=>"GuestBook | Messages","messages"=>$msgs]);
        }
    }
}