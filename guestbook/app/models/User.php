<?php

namespace App\Models;

use App\Services\Db;
use App\App;

class User extends Model{
    
    //fields
    protected array $fields = [
        "fname",
        "lname",
        "email",
        "password"
    ];
  
}