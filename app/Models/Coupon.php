<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
 	protected $table = 'coupon';

 	protected $primaryKey = 'coupon_id';
    public $timestamps = false;
    
    protected $fillable = [
          'coupon_name',  'coupon_qty', 'coupon_number', 'coupon_code', 'coupon_condition', 'coupon_date_start',
          'coupon_date_end', 'coupon_status', 'coupon_used'
    ];
}
