@extends('admin/Admin')
@section('title-ad')
    {{ trans('home_ad.ql_coupon') }}
@endsection
 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_coupon') }}</h6>
        </div>
        
        @if(session()->has('failures'))
        <div>
           <table class="table table-danger classs-style">
               <tr>
                   <th>row</th>
                   <th>attribute</th>
                   <th>errors</th>
                   <th>values</th>
               </tr>
                @foreach(session()->get('failures') as $erroo)
                <tr>
                    <td>{{ $erroo->row() }}</td>
                    <td>{{ $erroo->attribute() }}</td>
                    <td>
                        <ul>
                            @foreach($erroo->errors() as $e)
                                <li>{{$e}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{ $erroo->values()[$erroo->attribute()] }}
                    </td>
                </tr>
                @endforeach
           </table>
        </div>
        @endif

        <div style="margin-top: 25px; margin-bottom: 1px; margin-left: 22px">
            <table>
                <tr>
                    <button class="btn btn-outline-primary" data-toggle="modal"  data-target="#couponAdd" type="button" style="margin-right: 10px">
                        <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
                    </button>
                </tr>
                <tr>
                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#sendCoupon"><i class="fas fa-mail-bulk"></i>
                        {{ trans('Ql_sp.guimagiamgia') }}
                    </button>
                </tr>
                {{-- <tr>
                    <button style="margin-left: 10px" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#ExcelCoupon"><i class="fas fa-file-excel"></i>
                        {{ trans('home_ad.import') }} / {{ trans('home_ad.export') }} Excel
                    </button>
                </tr> --}}
            </table>
        </div>
        <div class="card-body">

            <div class="table-responsive class-product">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.namecoupon') }}</th>
                            <th>{{ trans('Ql_sp.qtycoupon') }}</th>
                            <th>{{ trans('Ql_sp.sophamtram') }}</th>
                            <th>{{ trans('Ql_sp.codecoupon') }}</th>
                            <th>{{ trans('Ql_sp.tinhnang') }}</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th>Hạn Sử Dụng</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.namecoupon') }}</th>
                            <th>{{ trans('Ql_sp.qtycoupon') }}</th>
                            <th>{{ trans('Ql_sp.sophamtram') }}</th>
                            <th>{{ trans('Ql_sp.codecoupon') }}</th>
                            <th>{{ trans('Ql_sp.tinhnang') }}</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th>Hạn Sử Dụng</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <br>
                    <tbody style="text-align: center;">
                    @foreach($coupon as $key => $cp)
                       <tr>
                            <td>{{$key+=1}}</td>
                            <td>{{$cp->coupon_name }}</td>
                            <td>{{$cp->coupon_qty }}</td>
                            <td>
                                @if($cp->coupon_condition == 0)
                                    Giảm {{$cp->coupon_number }}%
                                @else
                                    Giảm {{number_format($cp->coupon_number,0,',','.') }} VNĐ
                                @endif
                            </td>
                            <td>{{$cp->coupon_code }}</td>
                            <td>
                                @if($cp->coupon_condition == 0)
                                    <span style="color: #4e73df;" class="fas fa-percent"></span>
                                @else
                                    <span style="color: #e74a3b;" class="far fa-money-bill-alt"></span>
                                @endif
                            </td>
                            <td>{{$cp->coupon_date_start }}</td>
                            <td>{{$cp->coupon_date_end }}</td>
                            <td><?php $date_end = date_create($cp->coupon_date_end); ?>
                                 @if(date_format($date_end, "m") >= $month_now && date_format($date_end, "Y") >= $year_now && $cp->coupon_date_end >= $today) 
                                    <span class="still-term tag-style">Còn Hạn</span>
                                 @else
                                    <span class="expired tag-style">Hết Hạn</span>
                                 @endif
                            </td>
                            <td>
                                @if($cp->coupon_status == 0)
                                <a href="{{url('/unactive-coupon/'.$cp->coupon_id )}}"><span class="fas fa-eye"></span></a>
                                @else
                                <a href="{{url('/active-coupon/'.$cp->coupon_id )}}"><span style="color: #e74a3b;" class="fas fa-eye-slash"></span></a>
                                @endif
                            </td>
                            <td style="width: 100px">
                                <!-- <a href="{{route('update_coupon', $cp->coupon_id  )}}"> -->
                                    <button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#couponUpdate_{{$cp->coupon_id}}" type="button"><i class="fas fa-pencil-alt"></i></button>
                                <!-- </a> -->
                                <!-- <a href="{{route('deletecoupon', $cp->coupon_id  )}}"> -->
                                <button class="btn btn-outline-danger delete" data-toggle="modal" data-target="#couponDel_{{$cp->coupon_id}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>
                       
                            <!-- Modal Delete-->
                            <div class="modal fade" id="couponDel_{{$cp->coupon_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Chọn "Delete" bên dưới nếu bạn đã chắc chắn muốn xóa.</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ</button>
                              
                                            <form method="" action="{{route('deletecoupon', $cp->coupon_id  )}}">
                                                
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Update  -->
                            <div class="modal fade" id="couponUpdate_{{$cp->coupon_id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <input type="hidden" name="coupon_product_id" value="{{$cp->coupon_id}}">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_coupon', $cp->coupon_id)}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.namecoupon') }}</label>
                                                    <input type="text" id="coupon_name_{{$cp->coupon_id}}" name="coupon_name" class="form-control" value="{{$cp->coupon_name}}" />

                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.qtycoupon') }}</label>
                                                    <input type="text" id="coupon_time_{{$cp->coupon_id}}" name="coupon_time" class="form-control" multiple value="{{$cp->coupon_qty}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">Ngày Bắt Đầu</label>
                                                    <input type="text" id="coupon_date_start_{{$cp->coupon_id}}" name="coupon_date_start" class="form-control" multiple value="{{$cp->coupon_date_start}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">Ngày Kết Thúc</label>
                                                    <input type="text" id="coupon_date_end_{{$cp->coupon_id}}" name="coupon_date_end" class="form-control" multiple value="{{$cp->coupon_date_end}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.codecoupon') }}</label>
                                                    <input type="text" id="coupon_code_{{$cp->coupon_id}}" name="coupon_code" class="form-control" multiple value="{{$cp->coupon_code}}"/>
                                                </div>
                                                <div class="form-group" style="font-weight: bold; color: #000">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.tinhnang') }}</label>
                                                    <select name="coupon_condition" class="form-control">
                                                        <option <?php if($cp->coupon_condition==0)echo 'selected' ?> value="0">{{ trans('Ql_sp.tinhnangphantram') }}</option>
                                                        <option <?php if($cp->coupon_condition==1)echo 'selected' ?> value="1">{{ trans('Ql_sp.tinhnangtien') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.sophamtram') }}</label>
                                                    <input type="text" id="coupon_number_{{$cp->coupon_id}}" name="coupon_number" class="form-control" multiple value="{{$cp->coupon_number}}"/>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                                                <button type="submit"  class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>

        </div>
    </div>


    <!-- Import Export Excel -->
    <div class="modal" id="ExcelCoupon">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">{{ trans('home_ad.import') }} / {{ trans('home_ad.export') }} Excel</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <div style="margin-top: 15px; margin-bottom: 10px; margin-left: 2px">
                    <table>
                        <tr>
                            <form action="{{url('/import-excel-coupon')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- <input type="file" name="file" id="file" accept=".xlsx" required><br><br> -->
                                <!-- <input type="submit" value="{{ trans('home_ad.import') }} Excel" name="import_coupon" class="btn btn-primary" style="margin-right: 10px;"> -->
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="file" accept=".xlsx" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div><br><br>
                                <button class="btn btn-outline-primary" type="submit" name="import_coupon" style="margin-right: 10px;">
                                    <i class="fas fa-file-import" aria-hidden="true"></i> {{ trans('home_ad.import') }} Excel
                                </button>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{url('/export-excel-coupon')}}" method="POST">
                                @csrf
                                <!-- <input type="submit" value="{{ trans('home_ad.export') }} Excel" name="export_coupon" class="btn btn-success"> -->
                                <button class="btn btn-outline-success" type="submit" name="export_coupon">
                                    <i class="fas fa-file-export" aria-hidden="true"></i> {{ trans('home_ad.export') }} Excel
                                </button>
                            </form>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
    </div>
    {{-- Sen Coupon --}}
    <div class="modal" id="sendCoupon">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">{{ trans('Ql_sp.guimagiamgia') }}</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('sendcoupon') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div style="margin-top: 15px; margin-bottom: 10px; margin-left: 2px">
                        <table>
                            <tr>
                                <select class="form-control" name="code_cou">
                                    @foreach($sendcou as $send)
                                    <option value="{{ $send->coupon_code }}">{{ $send->coupon_code }}</option>
                                    @endforeach
                                </select>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <!-- Modal Add-->
    <div class="modal fade" id="couponAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('addnewcoupon')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.namecoupon') }}</label>
                            <input type="text" id="coupon_name" name="coupon_name" class="form-control"  />

                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.qtycoupon') }}</label>
                            <input type="text" id="coupon_time" name="coupon_time" class="form-control" multiple />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">Ngày Bắt Đầu</label>
                            <input type="text" id="coupon_date_start" name="coupon_date_start" class="form-control" multiple />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">Ngày Kết Thúc</label>
                            <input type="text" id="coupon_date_end" name="coupon_date_end" class="form-control" multiple />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.codecoupon') }}</label>
                            <input type="text" id="coupon_code" name="coupon_code" class="form-control" multiple />
                        </div>
                        <div class="form-group" style="font-weight: bold; color: #000">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.tinhnang') }}</label>
                            <select name="coupon_condition" class="form-control">
                                <option value="0">{{ trans('Ql_sp.tinhnangphantram') }}</option>
                                <option value="1">{{ trans('Ql_sp.tinhnangtien') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.sophamtram') }}</label>
                            <input type="text" id="coupon_number" name="coupon_number" class="form-control" multiple />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                        <button type="submit"  class="btn btn-primary"><i class="icofont icofont-check-circled"></i>Add</button>

                    </div>
                </form>
            </div>
        </div>
    </div> 
<style type="text/css">

    .classs-style li{
        list-style-type: none;
    }
</style>
@endsection