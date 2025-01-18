<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportUserAccount implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return User::where('level',2)->get();;
    }
    public function headings() :array {
    	return ["STTNoImport", "full_name", "email ", "phone", "address", "user_token_NotImport", "level"];
    }
}
