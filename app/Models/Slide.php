<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = "slide";
 	protected $primaryKey = 'id';
    public $timestamps = false;
 	
    protected $fillable = [
          'link',  'image', 'status_slide'
    ];
}
