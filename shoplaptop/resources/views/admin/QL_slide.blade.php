@extends('admin/Admin')
@section('title-ad')
    {{ trans('home_ad.ql_slide') }}
@endsection
 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_slide') }}</h6>
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
                    <button class="btn btn-outline-primary" data-toggle="modal"  data-target="#slideAdd" type="button">
                        <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
                    </button>
                </tr>
                <tr>
                    {{-- <button style="margin-left: 10px" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#ExcelSlide"><i class="fas fa-file-excel"></i>
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
                            <th>Url</th>
                            <th>{{ trans('Ql_sp.hinhanh') }}</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>Url</th>
                            <th>{{ trans('Ql_sp.hinhanh') }}</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <br>
                    <tbody style="text-align: center;">
                    @foreach($slide as $key => $sl)
                       <tr>
                            <td>{{$key+=1}}</td>
                            <td class="hiden-text"><p>{{$sl->link }}</p></td>
                            <td><img src="source/image/slide/{{$sl->image}}" alt="" width="200px"></td>
                            <td>
                                <?php
                                   if($sl->status_slide==0){
                                    ?>
                                    <a href="{{url('/active-slide/'.$sl->id)}}"><span class="fas fa-eye"></span></a>
                                    <?php
                                     }else{
                                    ?>  
                                     <a href="{{url('/unactive-slide/'.$sl->id)}}"><span style="color: #e74a3b;" class="fas fa-eye-slash"></span></a>
                                    <?php
                                   }
                                  ?>
                            </td>

                            <td>
                                <!-- <a href="{{route('update_slide',$sl->id )}}"> -->
                                    <button class="btn btn-outline-primary edit" data-toggle="modal" data-target="#slideUpdate_{{$sl->id}}" type="button"><i class="fas fa-pencil-alt"></i></button>
                                <!-- </a> -->
                                <!-- <a href="{{route('deleteslide',$sl->id )}}"> -->
                                <button class="btn btn-outline-danger delete" data-toggle="modal" data-target="#slideDel_{{$sl->id}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>
                            

                            <!-- Modal Delete-->
                            <div class="modal fade" id="slideDel_{{$sl->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                            <form method="" action="{{ route('deleteslide', $sl->id  )}}">
                                                
                                                
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Update-->
                            <div class="modal fade" id="slideUpdate_{{$sl->id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_slide', $sl->id )}}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >Url</label>
                                                    <input type="text" id="e_link_{{$sl->id}}" name="link_slide" class="form-control" value="{{$sl->link}}" />

                                                </div>
                                                <div class="form-group" style="font-weight: bold; color: #000">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.trangthai') }}</label>
                                                    <select name="status_slide" class="form-control">
                                                        <option value="0" <?php if($sl->status_slide==0)echo 'selected' ?> >Hiển Thị</option>
                                                        <option value="1" <?php if($sl->status_slide==1)echo 'selected' ?> >Ẩn</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hinhanh') }}</label>
                                                    <input type="file" id="e_image_{{$sl->id}}" name="image" class="form-control" multiple/><br>
                                                    <img src="source/image/slide/{{$sl->image}}" alt="" width="200px">
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
    <div class="modal" id="ExcelSlide">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">{{ trans('home_ad.import') }} / {{ trans('home_ad.export') }} Excel</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <style type="text/css">
                .tabledh{
                    margin-right: 22px;
                    margin-bottom: 22px;
                }
                .tableright{
                    margin-bottom: 22px;
                }
            </style>
            <!-- Modal body -->
            <div class="modal-body">
                <div style="margin-top: 15px; margin-bottom: 10px; margin-left: 2px">
                    <table>
                        <tr>
                            <form action="{{url('/import-excel-slide')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- <input type="file" name="file" id="file" accept=".xlsx" required><br><br> -->
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="file" accept=".xlsx" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div><br><br>
                                <button class="btn btn-outline-primary" type="submit" name="import_slide" style="margin-right: 10px;">
                                    <i class="fas fa-file-import" aria-hidden="true"></i> {{ trans('home_ad.import') }} Excel
                                </button>
                            </form>
                        </tr>

                        <tr>
                            <form action="{{url('/export-excel-slide')}}" method="POST">
                                @csrf
                                <!-- <input type="submit" value="{{ trans('home_ad.export') }} Excel" name="export_slide" class="btn btn-success"> -->
                                <button class="btn btn-outline-success" type="submit" name="export_slide">
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
    <div class="modal fade" id="slideAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('addnewslide')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Url</label>
                            <input type="text" id="e_link" name="link_slide" class="form-control"  />

                        </div>
                        <div class="form-group" style="font-weight: bold; color: #000">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.trangthai') }}</label>
                            <select name="status_slide" class="form-control">
                                <option value="0">Hiển Thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hinhanh') }}</label>
                            <input type="file" id="e_image" name="image_file" class="form-control" multiple onchange="ImageFileUrl()"/>
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
        width: 200px;
        margin-top: 10px;
    }

</style>



@endsection