<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";
    public $timestamps = false;

    protected $primaryKey = 'id_bill';
    protected $fillable = [
          'id_customer ',  'date_order', 'total', 'payment', 'status_bill'
    ];

    public function bill_detail(){
    	return $this->hasMany('App\Models\BillDetail','id_bill', 'id_bill_detail');
    }

    public function customer(){
    	return $this->belongsTo('App\Models\Customer','id_customer', 'id');
    }
}
