 @extends('admin/Admin')

@section('title-ad')   
    {{ trans('home_ad.ql_dh') }}
@endsection

 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_dh') }} Đã Duyệt</h6>
        </div>
<!--         <div style="margin-top: 25px; margin-bottom: 1px; margin-left: 22px">
            <table>
                <tr>
                    <form action="{{url('/export-excel-don-hang-da-duyet')}}" method="POST">
                        @csrf
                        <input type="submit" value="{{ trans('home_ad.export') }} Excel" name="export_dh_da_duyet" class="btn btn-outline-success">
                        <button class="btn btn-outline-success" type="submit" name="export_dh_da_duyet">
                            <i class="fas fa-file-export" aria-hidden="true"></i> {{ trans('home_ad.export') }} Excel
                        </button>
                    </form>
                </tr>
            </table>
        </div> -->
        <div class="card-body">
            <div class="table-responsive class-product">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>STT </th>
                            <th>{{ trans('Ql_sp.tenkh') }}</th>
                            <th>Email</th>
                            <th>{{ trans('Ql_sp.pay') }}</th>
                            <!-- <th style="width: 15em;word-wrap:break-word;">Address</th> -->
                            <!-- <th>Phone Number</th> -->
                            <th>{{ trans('home_ad.codeorder') }}</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                           <!--  <th>Created At </th>
                            <th>Total Money</th>
                            <th>Payment Methods</th>
                            <th>Note</th> -->
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT </th>
                            <th>{{ trans('Ql_sp.tenkh') }}</th>
                            <th>Email</th>
                            <th>{{ trans('Ql_sp.pay') }}</th>
                            <!-- <th style="width: 15em;word-wrap:break-word;">Address</th> -->
                            <!-- <th>Phone Number</th> -->
                            <th>{{ trans('home_ad.codeorder') }}</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                           <!--  <th>Created At </th>
                            <th>Total Money</th>
                            <th>Payment Methods</th>
                            <th>Note</th> -->
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($donhang_daduyet as $key => $dh)
                        <tr>
                            <td>{{$key+=1}}</td>
                            <td>{{$dh->name}}</td>
                            
                            <td>{{$dh->email}}</td>
                            <td>{{$dh->payment}}</td>
                            <td>{{$dh->order_code}}</td>
                            <!-- <td style="width: 15em; word-wrap:break-word;">{{$dh->address}}</td> -->
                            <!-- <td>{{$dh->phone_number}}</td> -->
                            <td>
                                <?php
                                   if($dh->status_bill==1){
                                    ?>
                                    <span class="xanhla tag-style"> Đang vận chuyển</span>
                                    <?php
                                     }elseif($dh->status_bill==0){
                                    ?>  
                                     <span class="still-term tag-style">Đang xử lý...</span>
                                    <?php
                                    }else{
                                    ?> 
                                    <a ><span class="expired tag-style">Hủy đơn</span></a>
                                    <?php
                                   }
                                  ?>
                            </td>
 <!--                            <td>{{$dh->date_order}}</td>
                            <td>{{number_format($dh->total)}}</td>
                            <td>{{$dh->payment}}</td>
                            <td>{{$dh->note}}</td> -->

                            <td>
                                 <a href="{{route('donhangchitiet', $dh->id_bill)}}">
                                    <button class="btn btn-outline-primary"  type="button">&nbsp;<i class="fas fa-info">&nbsp;</i></button>
                                </a>
                                <!-- <a href="{{route('deletedh', $dh->id_bill)}}"> -->
                                <button class="btn btn-outline-danger delete" data-toggle="modal" data-target="#dhDaduyetDel_{{$dh->id_bill}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>

                            <!-- Modal Delete-->
                            <div class="modal fade" id="dhDaduyetDel_{{$dh->id_bill}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ </button>
                                            
                                             <form method="" action="{{route('deletedh', $dh->id_bill)}}">

                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>                          
                                           
                                            
                                        </div>
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


@endsection