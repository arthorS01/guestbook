<?php

require "../vendor/autoload.php";
require "../config/config.php";

use App\Services\Router;
use App\Controllers\{Admin,Auth,Book,Message};
use App\App;

session_start();

//instantiate router 

try{
    $myRouter = new Router();

    $myRouter->get("/",[Auth::class,"login"])
            ->get("login/",[Auth::class,"login"])
            ->get("admin/dashboard",[Admin::class,"index"])
            ->get("register/",[Auth::class,"register"])
            ->post("create/",[Book::class, "create"])
            ->post("view/",[Book::class,"view"])
            ->post("publish/",[Book::class,"publish"])
            ->post("logout/",[Auth::class, "logout"])
            ->post("delete/",[Book::class, "delete"])
            ->post("message/delete",[Message::class, "delete"])
            ->post("message/post",[Message::class, "post"])
            ->post("login/",[Auth::class,"login_user"])
            ->post("register/",[Auth::class,"register_user"]);

    (new app($myRouter))->render($_SERVER["REQUEST_URI"],$_SERVER["REQUEST_METHOD"]);
    
}catch(Exception $e){
    echo $e->getMessage();
}