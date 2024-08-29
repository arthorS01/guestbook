<?php

namespace App\Controllers;

use App\Models\Message as MessageModel;
use App\App;
use App\Services\Sanitizer;

class Message{

    public function delete()
    {
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            extract($_POST);

            $msgId = Sanitizer::clean($id);

            $msg = (new MessageModel)->findOrFail(["id"=>$msgId]);

            if(is_bool($msg)){
                die("problem dey o");
            }else{
                $msg->delete();
                App::$view->setPath("success");
                return App::$view->render(true,["pageTitle"=>"success","message"=>"Message deleted"]);
            }
        }

    }
       
    public function post()
    {
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            extract($_POST);

            $bookId = Sanitizer::clean($bookId);
            $message = Sanitizer::clean($message);
            $sender = Sanitizer::clean($sender);

            $msg = new MessageModel;

            $msg->bookId = $bookId;
            $msg->message = $message;
            $msg->sender = $sender;

            if($msg->save()){
                App::$view->setPath("success");
                return App::$view->render(true,["pageTitle"=>"success","message"=>"Thank you, your message has been sent"]);
            }
        }else{
            die("problem");
        }
    }
}