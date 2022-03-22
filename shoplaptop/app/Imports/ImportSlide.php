<?php

namespace App\Imports;

use App\Models\Slide;
use Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ImportSlide implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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
        return new Slide([
            'link' => $row[0] ?? $row['link'],   
            'image' => $row[1] ?? $row['image'],   
            'status_slide' => $row[2] ?? $row['status_slide'],   
        ]);
    }

    public function rules(): array
    {
        return [
            '*.link' => ['url'],
            '*.image' => ['required'],
            '*.status_slide' => ['required', 'numeric', 'min:0', 'max:1'],
        ];
    }

    public function customValidationMessages()
    {
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            return [
                '*.link.url' => 'Định dạng url không hợp lệ !',
                '*.image.required' => 'Vui lòng không để trống !',

                '*.status_slide.required' => 'Vui lòng không để trống !',
                '*.status_slide.numeric' => 'Vui lòng knhập số !',
                '*.status_slide.min' => 'Vui lòng nhập 0 hoặc 1',
                '*.status_slide.max' => 'Vui lòng nhập 0 hoặc 1',
            ];
        }else{
            return[];
        }
    }
}
