<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportProduct implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Product::all();
    }
    public function headings() :array {
    	return ["STTNoImport", "id_type", "id_post", "product_quantity", "product_soid", "unit_price", "promotion_price", "image", "sub_image", "new", "date_sale", "hours_sale"];
    }
}
