@extends('admin/Admin')
@section('title-ad')
    Tim kiem admin
@endsection
@section('content-ad')  

<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
       
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>{{$timkiem_ad}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection  