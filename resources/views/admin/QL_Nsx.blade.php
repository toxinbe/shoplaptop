 @extends('admin/Admin')
 @section('title-ad')
    {{ trans('home_ad.ql_nsx') }}
@endsection
 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_nsx') }}</h6>
        </div>


        @if(session()->has('failures'))
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
        @endif

        <div style="margin-top: 25px; margin-bottom: 1px; margin-left: 22px">
            <table>
                <tr>
                    <button class="btn btn-outline-primary" data-toggle="modal"  data-target="#nsxAdd" type="button">
                        <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
                    </button>
                </tr>
                <tr>
                    {{-- <button style="margin-left: 10px" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#ExcelType"><i class="fas fa-file-excel"></i>
                        {{ trans('home_ad.import') }} / {{ trans('home_ad.export') }} Excel
                    </button> --}}
                </tr>
            </table>
        </div>
        <div class="card-body">
            <div class="table-responsive class-product">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('home.hinhanh') }}</th>
                            <th>{{ trans('Ql_sp.tenthuonghieu') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('home.hinhanh') }}</th>
                            <th>{{ trans('Ql_sp.tenthuonghieu') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <tbody style="text-align: center;">
                    @foreach($nsx as $key => $nsxx)
                       <tr>
                            <td>{{$key+=1}}</td>
                            <td><img src="source/image/type_product/{{$nsxx->image}}" alt="" width="50px"></td>
                            <td>{{$nsxx->name_type}}</td>

                            <td>
                                <!-- <a href="{{route('update_nsx', $nsxx->id )}}"> -->
                                    <button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#nsxUpdate_{{$nsxx->id}}" type="button"><i class="fas fa-pencil-alt"></i></button>
                                <!-- </a> -->
                                <!-- <a href="{{route('deletensx', $nsxx->id )}}"> -->
                                <button class="btn btn-outline-danger delete" data-toggle="modal" data-target="#nsxDel_{{$nsxx->id}}"  type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>

                            <!-- Modal Delete-->
                            <div class="modal fade" id="nsxDel_{{$nsxx->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          
                                            <form method="" action="{{route('deletensx', $nsxx->id )}}">
                                                
                                                
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Update-->
                            <div class="modal fade" id="nsxUpdate_{{$nsxx->id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_nsx', $nsxx->id )}}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.tenthuonghieu') }}</label>
                                                    <input type="text" id="e_name_{{$nsxx->id}}" name="name" class="form-control" value="{{$nsxx->name_type}}" />

                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hinhanh') }}</label>
                                                    <input type="file" id="e_image_{{$nsxx->id}}" name="image" class="form-control" multiple  /><br>
                                                    <img src="source/image/type_product/{{$nsxx->image}}" alt="" width="100px">
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
    <div class="modal" id="ExcelType">
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
                            <form action="{{url('/import-excel-nsx')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- <input type="file" name="file" id="file" accept=".xlsx" required><br><br> -->
                                <!-- <input type="submit" value="{{ trans('home_ad.import') }} Excel" name="import_nsx" class="btn btn-primary" style="margin-right: 10px;"> -->
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="file" accept=".xlsx" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div><br><br>
                                <button class="btn btn-outline-primary" type="submit" name="import_nsx" style="margin-right: 10px;">
                                    <i class="fas fa-file-import" aria-hidden="true"></i> {{ trans('home_ad.import') }} Excel
                                </button>
                            </form>
                        </tr>
                        <tr>
                            <form action="{{url('/export-excel-nsx')}}" method="POST">
                                @csrf
                                <!-- <input type="submit" value="{{ trans('home_ad.export') }} Excel" name="export_nsx" class="btn btn-success"> -->
                                <button class="btn btn-outline-success" type="submit" name="export_nsx">
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


    <!-- Modal Add-->
    <div class="modal fade" id="nsxAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('addnewnsx')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Manufacturers Name</label>
                            <input type="text" id="e_name" name="name" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hinhanh') }}</label>
                            <input type="file" id="e_image" name="image_file" class="form-control" multiple onchange="ImageFileUrl()"  />
                            <div id="displayimg"></div>
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
    #displayimg img{
        margin-top: 10px;
        width: 200px;
    }
</style>

@endsection