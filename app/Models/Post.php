<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";
 	protected $primaryKey = 'id_post';
    public $timestamps = false;
 	
    protected $fillable = [
          'sp_vi',  'sp_en', 'product_slug', 'description_vi' ,'description_en'
    ];
    // public function product(){
    // 	return $this->hasMany('App\Product','id_post', 'id_post');
    // }
}
