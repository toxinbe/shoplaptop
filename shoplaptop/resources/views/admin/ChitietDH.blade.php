 @extends('admin/Admin')

@section('title-ad')   
    {{ trans('home_ad.ql_dh') }} / {{ trans('home.detail') }}
@endsection

 @section('content-ad')

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <h3 style="text-align: center;font-weight: bold;">Thông Tin Khách Hàng</h3>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên Khách Hàng</th>
                      <th scope="col">Địa Chỉ</th>
                      <th scope="col">Số Điện Thoại</th>
                      <th scope="col">Ghi Chú</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($thongtin_kh as $key => $dh_ct)
                    <tr>
                      <th scope="row">{{$key++}}</th>
                      <td>{{$dh_ct->name}}</td>
                      <td>{{$dh_ct->address}}</td>
                      <td>{{$dh_ct->phone_number}}</td>
                      <td>{{$dh_ct->note}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>

<!--     <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <h3 style="text-align: center;font-weight: bold;">Thông Tin Vận Chuyển</h3>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên Người Vận Chuyển</th>
                      <th scope="col">Địa Chỉ</th>
                      <th scope="col">Product Price</th>
                      <th scope="col">Product Amount </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($billdetaill as $key => $bd)
                    <tr>
                      <th scope="row">{{$key++}}</th>
                      <td>
                        @if(config('app.locale') != 'vi') 
                            {{$bd->sp_en}}
                        @else
                            {{$bd->sp_vi}}
                        @endif
                      </td>
                      <td><img height="50px" width="100px" src="{{ asset('source/image/product/'.$bd->image) }}" alt=""></td>
                      <td>{{$bd->unit_price}}</td>
                      <td>{{$bd->quantity}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div> -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <h3 style="text-align: center;font-weight: bold;">Thông Tin Đơn Hàng</h3>

                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên Sản Phẩm</th>
                      <th scope="col">Hình Ảnh</th>
                      <th scope="col">Giá Tiền</th>
                      <th scope="col">Số Lượng</th>
                      <th scope="col">Số Lượng Trong Kho</th>
                      <th scope="col">Tổng Tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($billdetaill as $key => $bd)
                    <tr class="color_qty_{{$bd->id_product}}">
                      <th scope="row">{{$key++}}</th>
                      <td>
                        @if(config('app.locale') != 'vi') 
                            {{$bd->sp_en}}
                        @else
                            {{$bd->sp_vi}}
                        @endif
                      </td>
                      <td><img height="50px" width="100px" src="{{ asset('source/image/product/'.$bd->image) }}" alt=""></td>
                      <td>{{number_format($bd->unit_price,0,',','.')}} VNĐ</td>
                      <td>
                        <form action="" method="post">
                        @csrf
                          <input class="order_qty_{{$bd->id_product }}" type="number" name="product_quantity_order" value="{{$bd->quantity}}" min="1" {{$dh_ct->status_bill != 0 ? 'disabled' : ''}} style="width: 40px; text-align: center;">
                          
                          <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$bd->id_product}}" value="{{$bd->product_quantity}}">
                          <input type="hidden" name="order_code" class="order_code" value="{{$bd->order_code}}">
                          <input type="hidden" name="order_product_id" class="order_product_id" value="{{$bd->id_product}}">

                          @if($dh_ct->status_bill == 0)
                          <button class="up_quantity_order"  name="up_quantity_order" data-product_id="{{$bd->id_product}}">Cập nhật</button>
                          @endif
                        </form>

                      </td>
                      <td>{{$bd->product_quantity}}</td>
                      <td>{{number_format($bd->quantity*$bd->unit_price,0,',','.')}} VNĐ </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

            </div>
            <div class="space40">&nbsp;</div>


            <div class="modal-footer">
              <div class="form-group" style="font-weight: bold; color: #000">
                 <label style="font-weight: bold; color: #000">Tổng Cộng: 
                  <span style="font-weight: normal;">{{number_format($dh_ct->total,0,',','.')}} VNĐ</span>
                </label>
              </div>
            </div>

        </div>
    </div>


    <div class="card shadow mb-4">
      <div class="card-body">
        @foreach($thongtin_kh as $key => $dh_ct)
        @if($dh_ct->status_bill==0)
          <form action="" method="post">
            @csrf
            <div class="form-group" style="font-weight: bold; color: #000">
              <!-- <label style="font-weight: bold; color: #000">Hình thức xử lý</label> -->
              <select name="status_bill_update" class="form-control oder_deltail">
                <option value="">-- {{ trans('home_ad.choose') }} --</option>
                <option id="{{$dh_ct->id_bill }}" selected value="0">Chưa Xử Lý</option>
                <option id="{{$dh_ct->id_bill }}" value="1">Đã Xử Lý</option>
                <option id="{{$dh_ct->id_bill }}" value="2">Hủy Đơn</option>
              </select>
            </div>
           <!--  <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
            </div> -->
          </form>
          @elseif($dh_ct->status_bill==1)
          <form action="" method="post">
            @csrf
            <div class="form-group" style="font-weight: bold; color: #000">
              <!-- <label style="font-weight: bold; color: #000">Hình thức xử lý</label> -->
              <select name="status_bill_update" class="form-control oder_deltail">
                <option value="">---Chọn hình thức---</option>
                <option id="{{$dh_ct->id_bill }}"  value="0">Chưa Xử Lý</option>
                <option id="{{$dh_ct->id_bill }}" selected value="1">Đã Xử Lý</option>
                <option id="{{$dh_ct->id_bill }}" value="2">Hủy Đơn</option>
              </select>
            </div>
           <!--  <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
            </div> -->
          </form>
          @else
          <form action="" method="post">
            @csrf
            <div class="form-group" style="font-weight: bold; color: #000">
              <!-- <label style="font-weight: bold; color: #000">Hình thức xử lý</label> -->
              <select name="status_bill_update" class="form-control oder_deltail">
                <option value="">---Chọn hình thức---</option>
                <option id="{{$dh_ct->id_bill }}" value="0">Chưa Xử Lý</option>
                <option id="{{$dh_ct->id_bill }}" value="1">Đã Xử Lý</option>
                <option id="{{$dh_ct->id_bill }}" selected value="2">Hủy Đơn</option>
              </select>
            </div>
          </form>
          @endif
          @endforeach
          @if($dh_ct->status_bill == 1)
          <div class="modal-footer">
            <a style="font-weight: normal;" target="_blank" ><i class="fas fa-print"> In Đơn Hàng</i></a>
          </div>
          @endif
      </div>
    </div>
@endsection