<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
 	protected $table = 'users';

 	protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
          'full_name',  'email', 'password', 'phone', 'address', 'level',
    ];
}
