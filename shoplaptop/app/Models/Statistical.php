<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
 	protected $table = 'statistical';

 	protected $primaryKey = 'id_statistic';
    public $timestamps = false;
    protected $fillable = [
          'order_date',  'sales',  'profit', 'quantity', 'total_order'
    ];
}
