<?php

namespace App\Imports;

use App\Models\Post;
use Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ImportPost implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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
        return new Post([
            'sp_vi' => $row[0] ?? $row['sp_vi'],   
            'sp_en' => $row[1] ?? $row['sp_en'],   
            'description_vi' => $row[2] ?? $row['description_vi'],   
            'description_en' => $row[3] ?? $row['description_en'],   
            'product_slug' => $row[4] ?? $row['product_slug'],   
        ]);
    }

    public function rules(): array
    {
        return [
            '*.sp_vi' => ['required'],
            '*.sp_en' => ['required'],
            '*.description_vi' => ['required'],
            '*.description_en' => ['required'],
            '*.product_slug' => ['required'],
        ];
    }

    public function customValidationMessages()
    {
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            return [
                '*.sp_vi.required' => 'Vui lòng không để trống !',
                '*.sp_en.required' => 'Vui lòng không để trống !',
                '*.description_vi.required' => 'Vui lòng không để trống !',
                '*.description_en.required' => 'Vui lòng không để trống !',
                '*.product_slug.required' => 'Vui lòng không để trống !',

            ];
        }else{
            return[];
        }
    }
}
