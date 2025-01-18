<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = "social";
 	protected $primaryKey = 'social_id';
    public $timestamps = false;
 	
    protected $fillable = [
          'provider_user_id',  'provider', 'user'
    ];

    public function login(){
 		return $this->belongsTo('App\Models\Account','user');
 	}

}
