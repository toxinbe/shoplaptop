<?php

namespace App\Imports;

use Hash;
use Session;
use App\Models\Account;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ImportAccount implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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
        return new Account([
            'full_name' => $row[0] ?? $row['full_name'],   
            'email' => $row[1] ?? $row['email'],   
            'password' => Hash::make($row[2] ?? $row['password']),
            'phone' => $row[1] ?? $row['phone'],   
            'address' => $row[1] ?? $row['address'],   
            'level' => $row[1] ?? $row['level'],    
        ]);
    }

    public function rules(): array
    {
        return [
            '*.full_name' => ['required'],
            '*.email' => ['required', 'email', 'unique:users'],
            '*.password' => ['required','min:6', 'max:20'],
            '*.phone' => ['numeric'],
            '*.level' => ['required', 'numeric', 'min:1', 'max:2'],
        ];
    }

    public function customValidationMessages()
    {
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            return [
                '*.full_name.required' => 'Vui lòng không để trống!',
                '*.email.required' => 'Vui lòng không để trống!',
                '*.email.email' => 'Không đúng định dạng email!',
                '*.email.unique' => 'Đã được sử dụng!',

                '*.password.required' => 'Vui lòng không để trống!',
                '*.password.min' => 'Mật khẩu tối thiểu 6 ký tự',
                '*.password.max' => 'Mật khẩu tối đa 20 ký tự',

                '*.phone.numeric' => 'Vui lòng nhập số!',

                '*.level.required' => 'Vui lòng không để trống!',
                '*.level.numeric' => 'Vui lòng nhập số!',
                '*.level.min' => 'Vui lòng nhập 1 (Admin) hoặc 2 (User)',
                '*.level.max' => 'Vui lòng nhập 1 (Admin) hoặc 2 (User)',
            ];
        }else{
            return[];
        }
    }
}
