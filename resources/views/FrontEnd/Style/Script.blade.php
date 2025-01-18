 
    <!-- jquery 3.2.1 -->
    <script src="{{asset('source/assets/frontend/js/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Countdown js -->
    <script src="{{asset('source/assets/frontend/js/jquery.countdown.min.js')}}"></script>
    <!-- Mobile menu js -->
    <script src="{{asset('source/assets/frontend/js/jquery.meanmenu.min.js')}}"></script>
    <!-- ScrollUp js -->
    <script src="{{asset('source/assets/frontend/js/jquery.scrollUp.js')}}"></script>
    <!-- Nivo slider js -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>  -->
    <script src="{{asset('source/assets/frontend/js/jquery.nivo.slider.js')}}"></script>
    <script src="{{asset('source/assets/frontend/js/jquery.nivo.slider.pack.js')}}"></script>
    <!-- Fancybox js -->
    <script src="{{asset('source/assets/frontend/js/jquery.fancybox.min.js')}}"></script>
    <!-- Jquery nice select js -->
    <script src="{{asset('source/assets/frontend/js/jquery.nice-select.min.js')}}"></script>
    <!-- Jquery ui price slider js -->
    <script src="{{asset('source/assets/frontend/js/jquery-ui.min.js')}}"></script>
    <!-- Owl carousel -->
    <script src="{{asset('source/assets/frontend/js/owl.carousel.min.js')}}"></script>
    <!-- Bootstrap popper js -->
    <script src="{{asset('source/assets/frontend/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('source/assets/frontend/js/bootstrap.min.js')}}"></script>
    <!-- Plugin js -->
    <script src="{{asset('source/assets/frontend/js/plugins.js')}}"></script>
    <!-- Main activaion js -->
    <script src="{{asset('source/assets/frontend/js/main.js')}}"></script>

    <script src="{{asset('source/assets/frontend/js/simple.money.format.js')}}"></script>

    <!-- Notification -->
    <script src="{{ asset('source/assets/dest/js/toastr.min.js') }}"></script>
    <script type="text/javascript">
    @if(session('thongbao'))
    
        toastr.success('{{ session('thongbao') }}', '{{trans('home.Notification')}}',{timeOut: 7000});

    @endif 
    @if(session('thongbaoloi'))
    
        toastr.error('{{ session('thongbaoloi') }}', '{{trans('home.Notification')}}',{timeOut: 7000});

    @endif
    @if($errors->any()) 
      @foreach($errors->all() as $err)
        
        toastr.error('{{$err}}', '{{trans('home.Notification')}}',{timeOut: 7000});
      @endforeach
    @endif
    </script>

    <!-- kiem tra tim kiem -->
    <script>
      function validate() {
        var n1 = document.getElementById("key");
        if(n1.value != "") {
          if(n1.value) {
            return true;
          }
        }
        // alert("Dư liệu không được để trống");
        return false;
      }
    </script>
    @yield('js')

  <script type="text/javascript">
      function remove_background(product_id)
       {
        for(var count = 1; count <= 5; count++)
        {
         $('#'+product_id+'-'+count).css('color', '#ccc');
        }
      }
      //hover chuột đánh giá sao
     $(document).on('mouseenter', '.rating', function(){
        var index = $(this).data("index");
        var product_id = $(this).data('product_id');
      // alert(index);
      // alert(product_id);
        remove_background(product_id);
        for(var count = 1; count<=index; count++)
        {
         $('#'+product_id+'-'+count).css('color', '#F39C11');
        }
      });
     //nhả chuột ko đánh giá
     $(document).on('mouseleave', '.rating', function(){
        var index = $(this).data("index");
        var product_id = $(this).data('product_id');
        var rating = $(this).data("rating");
        remove_background(product_id);
        // alert(rating);
        for(var count = 1; count<=rating; count++)
        {
         $('#'+product_id+'-'+count).css('color', '#F39C11');
        }
       });

      //click đánh giá sao
      $(document).on('click', '.rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
              var _token = $('input[name="_token"]').val();
            $.ajax({
             url:"{{url('insert-rating')}}",
             method:"POST",
             data:{index:index, product_id:product_id,_token:_token},
             success:function(data)
             {
              if(data == 'done')
              {
               alert("Bạn đã đánh giá "+index +" trên 5");
               location.reload();
              }
              else
              {
               alert("Lỗi đánh giá");
               location.reload();
              }
             }
      });
            // location.reload();
            
      });
  </script>




  <!-- so sanh trang chu -->
  <script type="text/javascript">

    function del_Compare(id){
      if (localStorage.getItem('compare')!=null) {
        var compare = JSON.parse(localStorage.getItem('compare'));
        var index = compare.findIndex(item => item.id == id);

        // alert(index);
        compare.splice(index, 1);
        localStorage.setItem('compare', JSON.stringify(compare));
        if (document.getElementById("del-td"+id)) {
          document.getElementById("del-td"+id).remove();
          document.getElementById("del-td1"+id).remove();
          document.getElementById("del-td2"+id).remove();
          document.getElementById("del-td3"+id).remove();
          document.getElementById("del-td4"+id).remove();
          document.getElementById("del-td5"+id).remove();
          document.getElementById("del-td6"+id).remove();
        }else{
          document.getElementById("del-tr"+id).remove();
        }
        
      }
    }

    view_compare();
    function view_compare(){
      if (localStorage.getItem('compare')!=null) {
        var compare = JSON.parse(localStorage.getItem('compare'));

        compare.reverse();
        for(i = 0; i<compare.length;i++){
          var name = compare[i].name;
          var price = compare[i].price;
          var insock = compare[i].insock;
          var image = compare[i].image;
          var url = compare[i].url;
          var id = compare[i].id;
          var page = compare[i].page;
          var mota = compare[i].mota;

          $('#td1').append(`                            
            <td class="product-description" id="del-td`+id+`">
                <div class="compare-details">
                    <div class="compare-detail-img">
                        <a><img style="height:294px; width: 294px; vertical-align: middle;"  src="`+image+`" alt="compare-product"></a>
                    </div>
                    <div class="compare-detail-content">
                        <span>Laptop</span>
                        <h4><a>`+name+`</a></h4>
                    </div>
                </div>
            </td>`
          );
          $('#td2').append(`                            
            <td class="product-description" id="del-td1`+id+`" style="vertical-align: top;">
                <p>`+mota+`</p>
            </td>`
          );
          $('#td3').append(`                            
            <td class="product-description" id="del-td2`+id+`">`+price+`</td>`
          );
          $('#td4').append(`                            
            <td class="product-description" id="del-td3`+id+`">`+insock+`</td>`
          );
          $('#td5').append(`                            
            <td class="product-description" id="del-td4`+id+`">
                <a class="compare-cart text-uppercase" href="`+url+`"> + {{ trans('home.addcart') }}</a>
            </td>`
          );
          $('#td6').append(`                            
            <td class="product-description" id="del-td5`+id+`"><a style="cursor: pointer;" onclick="del_Compare(`+id+`)"><i class="fa fa-trash-o"></i></a></td>`
          );
          $('#td7').append(`                            
            <td class="product-description" id="del-td6`+id+`">
                <div class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
            </td>`
          );
          $('#row_compare').find('tbody').append(`
            <tr id="del-tr`+id+`">
              <td style="vertical-align: middle;">`+name+`</td>
              <td style="vertical-align: middle; text-align: center;"><img style="vertical-align: middle; width: 200px; height:145px" src="`+image+`" alt=""></td>
              <td style="vertical-align: middle; text-align: center;"><a style="cursor: pointer;" onclick="del_Compare(`+id+`)"><i class="fa fa-trash-o"></i></a></td>
              <td style="vertical-align: middle; text-align: center;"><a class="btn btn-dark" href="`+page+`">Xem chi tiết >></a></td>
            </tr>
          `);
        }
      }
    }


    function add_Compare(product_id){
      var id = product_id;
      var name = document.getElementById('wishList_product_name'+id).value;
      var price = document.getElementById('wishList_price'+id).value;
      var insock = document.getElementById('instock'+id).value;
      var mota = document.getElementById('mota'+id).value;
      var image = document.getElementById('wishList_image'+id).src;
      var url = document.getElementById('addcart'+id).href;
      var page = document.getElementById('pagesosanh'+id).href;

      var newItemCompare = {
          'url':url,
          'page':page,
          'mota':mota,
          'id' :id,
          'name': name,
          'insock': insock,
          'price': price,
          'image': image
      }


      if(localStorage.getItem('compare')==null){
           localStorage.setItem('compare', '[]');
      }

      var old_data = JSON.parse(localStorage.getItem('compare'));

      var matches = $.grep(old_data, function(obj){
            return obj.id == id;
      })

      if(matches.length){
        alert('Sản phẩm bạn đã có,nên không thể thêm');

      }else{
        if (old_data.length<=2) {
          old_data.push(newItemCompare);
          $('#td1').append(`                            
            <td class="product-description" id="del-td`+id+`">
                <div class="compare-details">
                    <div class="compare-detail-img">
                        <a href="#"><img style="height:294px; width: 294px;vertical-align: middle;" src="`+image+`" alt="compare-product"></a>
                    </div>
                    <div class="compare-detail-content">
                        <span>Laptop</span>
                        <h4><a>`+name+`</a></h4>
                    </div>
                </div>
            </td>`
          );
          $('#td2').append(`                            
            <td class="product-description" id="del-td1`+id+`">
                <p>`+mota+`</p>
            </td>`
          );
          $('#td3').append(`                            
            <td class="product-description" id="del-td2`+id+`">`+price+`</td>`
          );
          $('#td4').append(`                            
            <td class="product-description" id="del-td3`+id+`">`+insock+`</td>`
          );
          $('#td5').append(`                            
            <td class="product-description" id="del-td4`+id+`">
                <a class="compare-cart text-uppercase" href="`+url+`"> + {{ trans('home.addcart') }}</a>
            </td>`
          );
          $('#td6').append(`                            
            <td class="product-description" id="del-td5`+id+`"><a style="cursor: pointer;" onclick="del_Compare(`+id+`)"><i class="fa fa-trash-o"></i></a></td>`
          );
          $('#td7').append(`                            
            <td class="product-description" id="del-td6`+id+`">
                <div class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
            </td>`
          );
          $('#row_compare').find('tbody').append(`
            <tr id="del-tr`+id+`">
              <td style="vertical-align: middle;">`+name+`</td>
              <td style="vertical-align: middle; text-align: center;"><img style="vertical-align: middle; width: 200px; height:145px" src="`+image+`" alt=""></td>
              <td style="vertical-align: middle;text-align: center;"><a style="cursor: pointer;" onclick="del_Compare(`+id+`)"><i class="fa fa-trash-o"></i></a></td>
              <td style="vertical-align: middle; text-align: center;"><a class="btn btn-dark" href="`+page+`">Xem chi tiết >></a></td>
            </tr>
          `);

        }else {
          alert('Chỉ thêm được 3 sản phẩm');
        }
      }

      localStorage.setItem('compare', JSON.stringify(old_data));
      $('#sosanhsp').modal();
        // alert(name);


    }
  </script>


  <!-- yeu thich -->
  <script type="text/javascript">

    function del_wishList(id){
      if (localStorage.getItem('data')!=null) {
        var data = JSON.parse(localStorage.getItem('data'));
        var index = data.findIndex(item => item.id == id);

        // alert(index);
        data.splice(index, 1);
        localStorage.setItem('data', JSON.stringify(data));

        if (document.getElementById("del-ggg"+id)) {
          document.getElementById("del-ggg"+id).remove(); 
        }
        else if (document.getElementById("del_product"+id)) {
          document.getElementById("del_product"+id).remove(); 
          if(data.length==0 && document.getElementById("sidebar_allproduct")){
            document.getElementById("sidebar_allproduct").remove(); 
          }
        } 
        else if (document.getElementById("delete_trall1"+id).remove()) {
          document.getElementById("delete_trall1"+id).remove()
          document.getElementById("delete_trall2"+id).remove()
          document.getElementById("delete_trall3"+id).remove()
          document.getElementById("delete_trall4"+id).remove()
          document.getElementById("delete_trall5"+id).remove()
        }else{
          document.getElementById("delete_trall"+id).remove()
        }
        if (data.length==0) {
          if (document.getElementById("maylike")) {
            document.getElementById("maylike").remove(); 
          }
          else if(document.getElementById("count_wish")){
            document.getElementById("count_wish").remove();
          }
          else if(document.getElementById("product_wishlist")){
            document.getElementById("product_wishlist").remove(); 
          }  
        }

      }
    }

    view();

    function view(){
      if (!localStorage.getItem('data')){
        $('#count_wish').append(`
          <i class="lnr lnr-heart"></i>
          <span class="my-cart" >
            <span>{{ trans('home.yeu') }}</span><span>{{ trans('home.thich') }} (0)</span>
          </span>
        `);
      }
      else if (localStorage.getItem('data')!=null) {
        var data = JSON.parse(localStorage.getItem('data'));

        data.reverse();
        // document.getElementById('single_product_like').style.overflow = 'scroll';
        // document.getElementById('single_product_like').style.height = '100%';
        if (data.length>0) {
          $('#maylike').append(`
              <div class="like-product ptb-95 off-white-bg pt-sm-50 pb-sm-55 " id="del-background`+id+`">
                  <div class="container" id="wish_top">
                      <div class="like-product-area" > 
                          <h2 class="section-ttitle2 mb-30">{{ trans('home.like') }} </h2>
                          <!-- Arrivals Product Activation Start Here -->
                          <div id="scrolllike" >
                          <!-- <div style="margin-left: 15%; height: 330px; overflow: scroll;"> -->
                              <!-- Double Product Start -->
                              <div  class="double-product" id="single_product_like" style="height: 100%;
                               width: 100%; ">
                                  <!-- Single Product Start -->
                                  
                                  <!-- Single Product End -->
                              </div>   
                          </div>
                          <!-- Arrivals Product Activation End Here -->
                      </div>
                      <!-- main-product-tab-area-->
                  </div>
                  <!-- Container End -->
              </div>
          `);
          $('#count_wish').append(`
            <i class="lnr lnr-heart"></i>
            <span class="my-cart" >
              <span>{{ trans('home.yeu') }}</span><span>{{ trans('home.thich') }} (`+data.length+`)</span>
            </span>
          `);
          $('#sidebar_allproduct').append(`
            <div id="del_sile">
            <h3 class="sidebar-title">WishList</h3>
            <ul class="sidbar-style" id="sidbar_product">

            </ul>
            </div>
          `);
        }else{
          $('#maylike').append(`<div></div>`);
          $('#count_wish').append(`
            <i class="lnr lnr-heart"></i>
            <span class="my-cart" >
              <span>{{ trans('home.yeu') }}</span><span>{{ trans('home.thich') }} (0)</span>
            </span>
          `);
          $('#sidebar_allproduct').append(`
            <div id="del_sile">

            </div>
          `);
        }
        
        for(i = 0; i<data.length;i++){
          var name = data[i].name;
          var price = data[i].price;
          var image = data[i].image;
          var url = data[i].url;
          var id = data[i].id;


        $('#single_product_like').append(`
          <div style="width:226px;height:100%; float:left; margin-right:1%" class="single-product" id="del-ggg`+id+`">
            <div class="pro-img">
                <a href="`+url+`">
                  <img style="height:200px" class="primary-img" src="`+image+`" alt="single-product">
                  <img style="height:200px" class="secondary-img" src="`+image+`" alt="single-product">
                </a>
                <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_`+id+`" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
            </div>
            <div style="background: #fff" class="pro-content">
              <div class="pro-info">
                <h4><a href="'+url+'">`+name+`</a></h4>
                <p><span class="price">`+price+`</span><del class="prev-price">$105.50</del></p>
                <div class="label-product l_sale">20<span class="symbol-percent">%</span></div>
              </div>
              <div class="pro-actions">
                  <div class="actions-primary">
                      <a href="`+url+`" title="{{ trans('home.addcart') }}">+ {{ trans('home.addcart') }}</a>
                  </div>
                  <div class="actions-secondary">
                      <a style="cursor: pointer;" onclick="del_wishList(`+id+`)" title="Remove"><i class="fa fa-trash-o"></i></a>
                      
                  </div>
              </div>
            </div>
          </div>
        `);

        $('#sidbar_product').append('<div class="single-product" id="del_product'+id+'"><div class="pro-img"><a href="'+url+'"><img style="height:150px" class="primary-img" src="'+image+'" alt="single-product"></a></div><div class="pro-content"><div class="pro-info"><h4><a href="'+url+'">'+name+'</a></h4><p><span class="price">'+price+'</span></p></div><div class="pro-actions"><div class="actions-primary"><a href="'+url+'" title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a></div><div class="actions-secondary"><a style="cursor: pointer;" onclick="del_wishList('+id+')" title="Remove"><i class="fa fa-trash-o"></i></a></div></div></div></div>');
          
        $('#product_wishlist').append('<tr id="delete_trall'+id+'"><td id="delete_trall1'+id+'" class="product-remove"><a style="cursor: pointer;" onclick="del_wishList('+id+')" title="Remove"><i class="fa fa-times" aria-hidden="true"></i></a></td><td id="delete_trall2'+id+'" class="product-thumbnail"><a href="#"><img src="'+image+'" alt="cart-image" /></a></td><td id="delete_trall3'+id+'" class="product-name"><a href="'+url+'">'+name+'</a></td> <td id="delete_trall4'+id+'" class="product-price"><span class="amount">'+price+'</span></td><td class="product-stock-status"><span>{{ trans('home.INSTOCK') }}</span></td><td id="delete_trall5'+id+'" class="product-add-to-cart"><a href="'+url+'">{{ trans('home.addcart') }}</a></td></tr>');

        }
      }
    }

    function add_wishList(clicked_id){
      var id = clicked_id;
      var name = document.getElementById('wishList_product_name'+id).value;
      var price = document.getElementById('wishList_price'+id).value;
      var image = document.getElementById('wishList_image'+id).src;
      var url = document.getElementById('wishList_producturl'+id).href;

      var newItem = {
          'url':url,
          'id' :id,
          'name': name,
          'price': price,
          'image': image
      }


      if(localStorage.getItem('data')==null){
           localStorage.setItem('data', '[]');
      }

      var old_data = JSON.parse(localStorage.getItem('data'));

      var matches = $.grep(old_data, function(obj){
            return obj.id == id;
      })

      if(matches.length){
        alert('Sản phẩm bạn đã yêu thích,nên không thể thêm');
        location.reload();
      }else{
        old_data.push(newItem);

        $('#maylike').append(`
            <div class="like-product ptb-95 off-white-bg pt-sm-50 pb-sm-55 ">
                <div class="container">
                    <div class="like-product-area" > 
                        <h2 class="section-ttitle2 mb-30">{{ trans('home.like') }} </h2>
                        <!-- Arrivals Product Activation Start Here -->
                        <div id="scrolllike">
                        <!-- <div style="margin-left: 15%; height: 330px; overflow: scroll;"> -->
                            <!-- Double Product Start -->
                            <div  class="double-product" id="single_product_like" style="height: 100%;
                             width: 100%; ">
                                <!-- Single Product Start -->
                                
                                <!-- Single Product End -->
                            </div>   
                        </div>
                        <!-- Arrivals Product Activation End Here -->
                    </div>
                    <!-- main-product-tab-area-->
                </div>
                <!-- Container End -->
            </div>
        `);
        $('#single_product_like').append(`
          <div style="width:226px;height:100%; float:left; margin-right:1%" class="single-product" id="del-ggg`+id+`">
            <div class="pro-img">
                <a href="`+url+`">
                  <img style="height:200px" class="primary-img" src="`+image+`" alt="single-product">
                  <img style="height:200px" class="secondary-img" src="`+image+`" alt="single-product">
                </a>
                <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_`+id+`" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
            </div>
            <div style="background: #fff" class="pro-content">
              <div class="pro-info">
                <h4><a href="'+url+'">`+name+`</a></h4>
                <p><span class="price">`+price+`</span><del class="prev-price">$105.50</del></p>
                <div class="label-product l_sale">20<span class="symbol-percent">%</span></div>
              </div>
              <div class="pro-actions">
                  <div class="actions-primary">
                      <a href="`+url+`" title="{{ trans('home.addcart') }}">+ {{ trans('home.addcart') }}</a>
                  </div>
                  <div class="actions-secondary">
                      <a style="cursor: pointer;" onclick="del_wishList(`+id+`)" title="Remove"><i class="fa fa-trash-o"></i></a>
                      
                  </div>
              </div>
            </div>
          </div>
        `);
        $('#sidbar_product').append('<div class="single-product" id="del_product'+id+'"><div class="pro-img"><a href="'+url+'"><img style="height:150px" class="primary-img" src="'+image+'" alt="single-product"></a></div><div class="pro-content"><div class="pro-info"><h4><a href="'+url+'">'+name+'</a></h4><p><span class="price">'+price+'</span></p></div><div class="pro-actions"><div class="actions-primary"><a href="'+url+'" title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a></div><div class="actions-secondary"><a style="cursor: pointer;" onclick="del_wishList('+id+')" title="Remove"><i class="fa fa-trash-o"></i></a></div></div></div></div>');

        $('#product_wishlist').append('<tr id="delete_trall'+id+'" ><td class="product-remove"><a style="cursor: pointer;" onclick="del_wishList('+id+')" title="Remove"><i class="fa fa-times" aria-hidden="true"></i></a></td><td class="product-thumbnail"><a href="#"><img src="'+image+'" alt="cart-image" /></a></td><td class="product-name"><a href="'+url+'">'+name+'</a></td> <td class="product-price"><span class="amount">'+price+'</span></td><td class="product-stock-status"><span>{{ trans('home.INSTOCK') }}</span></td><td class="product-add-to-cart"><a href="'+url+'">{{ trans('home.addcart') }}</a></td></tr>');
        if (old_data.length <=1 || old_data.length >4) {
            location.reload();
        }
      }


      localStorage.setItem('data', JSON.stringify(old_data));
      // alert(price);


    }
  </script>


  <!-- sap xep -->
  <script type="text/javascript">
    $(document).ready(function(){

      $('#sort').on('change',function(){

        var url = $(this).val(); 
        if (url) { 
          window.location = url;
        }
        return false;
      });

      // sap xep hien thi
      $('#showproduct').on('change',function(){

        var url_show = $(this).val(); 
        // alert(url_show);

        if (url_show) { 
            window.location = url_show;
        }
        return false;
      });


    }); 



  </script>

  <!-- sap xep theo tien -->
  <script type="text/javascript">
    $(document).ready(function(){

        $( "#slider-range" ).slider({
          orientation: "horizontal",
          range: true,

          min: <?php echo $min_price ?>,
          max: <?php echo $max_price_range ?>,

          steps:10000,
          values: [  <?php echo $min_price_range ?> ,  <?php echo $max_price ?>  ],
         
          slide: function( event, ui ) {
            $( "#amount_start" ).val(ui.values[ 0 ]).simpleMoneyFormat();
            $( "#amount_end" ).val(ui.values[ 1 ]).simpleMoneyFormat();


            $( "#start_price" ).val(ui.values[ 0 ]);
            $( "#end_price" ).val(ui.values[ 1 ]);

          }

        });

        $( "#amount_start" ).val($( "#slider-range" ).slider("values",0)).simpleMoneyFormat();
        $( "#amount_end" ).val($( "#slider-range" ).slider("values",1)).simpleMoneyFormat();

    }); 
  </script>
  
  <script type="text/javascript">
    $(window).on('load', function() {
        $('#slider').nivoSlider();
    });
  </script> 

  <script type="text/javascript">
    $('#key').keyup(function(){
        var query = $(this).val();

          if(query != '')
            {
             var _token = $('input[name="_token"]').val();

             $.ajax({
              url:"{{url('/autocomplete-ajax')}}",
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
                $('#search_ajax').fadeIn();  
                $('#search_ajax').html(data);
              }
             });

            }else{

                $('#search_ajax').fadeOut();  
            }
    });

    $(document).on('click', '.li_ajax', function(){  
        $('#key').val($(this).text());  
        $('#search_ajax').fadeOut();  
    }); 
  </script>
