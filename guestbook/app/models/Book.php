<?php

namespace App\Models;

use App\Services\Db;
use App\App;

class Book extends Model{
    
    
    //fields
    protected array $fields = [
        "name",
        "userId"
    ];

    public function __construct()
    {
        $this->userId = $_SESSION["user"]->id;
    }
  
}