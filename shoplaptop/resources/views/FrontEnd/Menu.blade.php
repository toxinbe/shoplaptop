<div class="col-xl-3 col-lg-4 d-none d-lg-block">
    <div class="vertical-menu mb-all-30">
        <nav>
            <ul class="vertical-menu-list">
                
                @foreach($loai_sanpham as $sl)
                <li><a href="{{route('loaisanpham',$sl->id)}}"><span><img width="20px" height="20px" src="source/image/type_product/{{$sl->image}}" alt="menu-icon"></span>Laptop {{$sl->name_type}}</a></li>
                @endforeach
                <!-- More Categoies Start -->
                <li id="cate-toggle" class="category-menu v-cat-menu">
                    <ul>
                        <li class="has-sub"><a href="#">More</a>
                            <ul class="category-sub">
                                <li><a href="shop.html"><span><img width="20px" height="20px" src="source/image/type_product/{{$sl->image}}" alt="menu-icon"></span>Laptop</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- More Categoies End -->
            </ul>
        </nav>
    </div>
</div>