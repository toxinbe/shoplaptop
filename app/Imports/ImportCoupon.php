<?php

namespace App\Imports;

use App\Models\Coupon;
use Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;


class ImportCoupon implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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
        return new Coupon([
            'coupon_name' => $row[0] ?? $row['coupon_name'],   
            'coupon_qty' => $row[1] ?? $row['coupon_qty'],   
            'coupon_number' => $row[2] ?? $row['coupon_number'],   
            'coupon_code' => $row[3] ?? $row['coupon_code'],   
            'coupon_condition' => $row[4] ?? $row['coupon_condition'],   
            'coupon_date_start' => $row[5] ?? $row['coupon_date_start'],   
            'coupon_date_end' => $row[6] ?? $row['coupon_date_end'],   
            'coupon_status' => $row[7] ?? $row['coupon_status'],   
        ]);
    }

    public function rules(): array
    {
        return [
            '*.coupon_name' => ['required'],
            '*.coupon_qty' => ['required', 'numeric'],
            '*.coupon_number' => ['required', 'numeric'],
            '*.coupon_code' => ['required', 'unique:coupon'],
            '*.coupon_condition' => ['required', 'numeric', 'min:0', 'max:1'],
            '*.coupon_date_start' => ['required', 'date_format:d-m-Y'],
            '*.coupon_date_end' => ['required', 'date_format:d-m-Y'],
            '*.coupon_status' => ['required', 'numeric', 'min:0', 'max:1'],
        ];
    }

    public function customValidationMessages()
    {
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            return [
                '*.coupon_name.required' => 'Vui lòng không để trống !',

                '*.coupon_qty.required' => 'Vui lòng không để trống !',
                '*.coupon_qty.numeric' => 'Vui lòng nhập số!',

                '*.coupon_number.required' => 'Vui lòng không để trống !',
                '*.coupon_number.numeric' => 'Vui lòng nhập số!',

                '*.coupon_code.required' => 'Vui lòng không để trống !',
                '*.coupon_code.unique' => 'Đã được sử dụng',

                '*.coupon_condition.required' => 'Vui lòng không để trống !',
                '*.coupon_condition.numeric' => 'Vui lòng nhập số!',
                '*.coupon_condition.min' => 'Vui lòng nhập 0 (phần trăm) hoặc 1 (tiền)',
                '*.coupon_condition.max' => 'Vui lòng nhập 0 (phần trăm) hoặc 1 (tiền)',

                '*.coupon_date_start.required' => 'Vui lòng không để trống !',
                '*.coupon_date_start.date_format' => 'Không khớp với định dạng d-m-Y',

                '*.coupon_date_end.required' => 'Vui lòng không để trống!',
                '*.coupon_date_end.date_format' => 'Không khớp với định dạng d-m-Y',


                '*.coupon_status.required' => 'Vui lòng không để trống !',
                '*.coupon_status.numeric' => 'Vui lòng nhập số !',
                '*.coupon_status.min' => 'Vui lòng nhập 0 (Hiện) hoặc 1 (Ẩn)',
                '*.coupon_status.max' => 'Vui lòng nhập 0 (Hiện) hoặc 1 (Ẩn)',
            ];
        }else{
            return[];
        }
    }


}
