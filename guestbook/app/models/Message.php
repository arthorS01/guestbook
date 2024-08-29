<?php

namespace App\Models;

use App\Services\Db;
use App\App;

class Message extends Model{
    
    
    //fields
    protected array $fields = [
        "bookId",
        "sender",
        "message"
    ];

    
    
  
}