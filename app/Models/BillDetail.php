<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = "bill_detail";
    public $timestamps = false;

    protected $primaryKey = 'id_bill_detail';
    protected $fillable = [
          'id_bill ',  'id_product ', 'order_code', 'quantity', 'unit_price'
    ];

    public function product(){
    	return $this->belongsTo('App\Models\Product','id_product', 'id');
    }

    public function bill(){
    	return $this->belongsTo('App\Models\Bill','id_bill', 'id_bill');
    }
}
