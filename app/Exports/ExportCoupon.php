<?php

namespace App\Exports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportCoupon implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Coupon::all();
    }
    public function headings() :array {
    	return ["STT Not Import", "coupon_name", "coupon_qty", "coupon_number", "coupon_code", "coupon_condition", "coupon_date_start", "coupon_date_end", "coupon_status", "coupon_used Not Import"];
    }
}
