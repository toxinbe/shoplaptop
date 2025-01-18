<?php

namespace App\Exports;

use App\Models\Slide;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportSlide implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Slide::all();
    }
    public function headings() :array {
    	return ["STTNoImport", "link", "image", "status_slide"];
    }
}
