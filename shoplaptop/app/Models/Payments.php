<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = "payments";
 	protected $primaryKey = 'id_payment';
    public $timestamps = false;
 	
    protected $fillable = [
          'id_customer',  'id_post_payment', 'order_code', 'code_bank', 'time'
    ];
    // public function product(){
    // 	return $this->hasMany('App\Product','id_post', 'id_post');
    // }
}
