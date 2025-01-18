<?php

namespace App\Imports;

use App\Models\ProductType;
use Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ImportNsx implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function headingRow() : int
    {
        return 1;
    }
    public function model(array $row)
    {
        return new ProductType([
            'name_type' => $row[0] ?? $row['name_type'],   
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name_type' => ['required', 'unique:type_products'],
        ];
    }

    public function customValidationMessages()
    {
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            return [
                '*.name_type.required' => 'Vui lòng không để trống !',
                '*.name_type.unique' => 'Đã được sử dụng !'
            ];
        }else{
            return [];
        }
    }
}
