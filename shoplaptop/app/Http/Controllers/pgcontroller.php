<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\User;
use App\Models\Post;
use App\Models\Visitors;
use App\Models\Coupon;
use App\Models\Rating;
use App\Models\Payments;

use Session;
use Hash;
use Auth;
use DB;
use Mail;
use Carbon\Carbon;
use App;


use Illuminate\Http\Request;

class pgcontroller extends Controller
{


    public function getIndex(Request $req){

        // $checkout_code = substr(md5(microtime()),rand(0,26),5);
        // dd(Session::get('locale'));

        $nowSale_hours = date('H:m:s');
        $nowSale = date('Y/m/d');
        $all_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->inRandomOrder()->get();
        
        $new_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->inRandomOrder()->get();
        $top_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',0)->inRandomOrder()->get();

    	$slide = Slide::where('status_slide',0)->inRandomOrder()->get();

        $sanpham_khuyenmai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('promotion_price','<>',0)->where('date_sale','>=' ,$nowSale)->inRandomOrder()->get();

        $user_ip_address = $req->ip();
        //online hien tai
        $visitor_current = Visitors::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitor_current->count();

        if ($visitor_count<1) {
            $visitor = new Visitors();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        $posts = Post::get();
        $multi_description = 'description_' . app()->getLocale();
        foreach ($new_product as $key => $value) {
            $meta_desc = $value->$multi_description;
            // $url_canonical = $req->url();
            $image_og = url('public/source/image/product/'.$value->image);
        }


    	return view('FrontEnd.TrangChu',compact('slide','new_product', 'sanpham_khuyenmai', 'image_og', 'top_product', 'all_product', 'nowSale_hours'


        ));
    }


    public function getLoaiSP(Request $req, $typesanpham){

        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();



        
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->orderBy('unit_price','DESC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='tang_dan') {
                $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->orderBy('unit_price','ASC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='kytu_za') {
                $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->orderBy($multisp,'DESC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='kytu_az') {
                $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->orderBy($multisp,'ASC')->paginate(6)->appends(request()->query());

            }

        }elseif (isset($_GET['start_price']) && $_GET['end_price'] ) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];

            $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->whereBetween('unit_price',[$min_price,$max_price])->orderBy('unit_price','ASC')->paginate(6);
            
        }else{
            $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->paginate(6);
        }

        if (count($sanpham_theoloai) >0) {
            $sanpham_new= Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->inRandomOrder()->paginate(3);
            $loai = ProductType::all();
            $loaisanpham = ProductType::where('id',$typesanpham)->first();

            $posts = Post::get();
            $multi_description = 'description_' . app()->getLocale();
            foreach ($sanpham_theoloai as $key => $value) {
                # code...
                $meta_desc = $value->$multi_description;
                // $url_canonical = $req->url();
                $image_og = url('source/image/product/'.$value->image);
            }
            return view('FrontEnd.TypeProduct',compact('sanpham_theoloai', 'sanpham_new', 'loai', 'loaisanpham', 'meta_desc', 'image_og'));
        }
        else{
            return redirect()->back();
        }
    	
    }
    public function getAllproduct(Request $req){
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();


        $sanpham_new = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->inRandomOrder()->paginate(3);
        
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                $tacca_sanpham = Product::orderBy('unit_price','DESC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='tang_dan') {
                $tacca_sanpham = Product::orderBy('unit_price','ASC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='kytu_za') {
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->orderBy($multisp,'DESC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='kytu_az') {
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->orderBy($multisp,'ASC')->paginate(6)->appends(request()->query());

            }

        }elseif (isset($_GET['start_price']) && $_GET['end_price'] ) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];

            $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->whereBetween('unit_price',[$min_price,$max_price])->orderBy('unit_price','ASC')->paginate(6)->appends(request()->query());
            
        }elseif(isset($_GET['sort_by_show'])){
            $sort_by_show = $_GET['sort_by_show'];

            if($sort_by_show=='10'){
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->paginate(10)->appends(request()->query());

            }elseif($sort_by_show=='25'){
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->paginate(25)->appends(request()->query());

            }elseif($sort_by_show=='50'){
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->paginate(50)->appends(request()->query());

            }elseif($sort_by_show=='75'){
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->paginate(75)->appends(request()->query());

            }elseif($sort_by_show=='100'){
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->paginate(100)->appends(request()->query());
            }
        }else{
            $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->paginate(6)->appends(request()->query());
        }

        $posts = Post::get();
        $multi_description = 'description_' . app()->getLocale();
        foreach ($tacca_sanpham as $key => $all) {
                $meta_desc = $all->$multi_description;
                // $url_canonical = $req->url();
                $image_og = url('source/image/product/'.$all->image);
        }

          

        return view('FrontEnd.AllProduct', compact('tacca_sanpham','meta_desc','image_og','sanpham_new'));
    }

    public function getChitiet(Request $req){


        $sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id',$req->id)->first();

        $tuongtu = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$sanpham->id_type)->get();

        $new_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->paginate(4);

        $sanpham_khuyenmai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('promotion_price','<>',0)->paginate(4);


        

        $sanpham_id = Product::where('id',$req->id)->get();

        $posts = Post::get();
        $multi_description = 'description_' . app()->getLocale();
        foreach ($sanpham_id as $key => $value) {
            # code...
            $meta_desc = $value->$multi_description;
            // $url_canonical = $req->url();
            $image_og = url('source/image/product/'.$value->image);
            $product_id = $value->id;
        }
        $rating = Rating::where('product_id',$product_id)->avg('rating_number');
        $rating = round($rating);
    	return view('FrontEnd.DetailProduct',compact('sanpham', 'tuongtu', 'new_product', 'sanpham_khuyenmai', 'meta_desc', 'image_og', 'rating', 'sanpham_id'));
    }

    public function getLienHe(Request $req){

        $image_og = $req->url();


    	return view('FrontEnd.Contact',compact('image_og'));
    }
    public function postLienHe(Request $req){
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
                [
                    'name'=>'required',
                    'email'=>'required|email'

                ],
                [
                    'name.required'=>'Vui lòng nhập tên',
                    'email.required'=>'Vui lòng nhập email',
                    'email.email'=>'Email không đúng định dạng',

                ]);
        }else{
            $this->validate($req,
            [
                'name'=>'required',
                'email'=>'required|email'

            ]);
        }

 
        //send mail lien he
        $to_email =  "npn020899@gmail.com";

        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $tile_mail = "Liên Hệ từ ShopPv".' '.$now;
        $data['email'] = $req->email;

        $name_mail = $req->name;
        $email_mail = $req->email;
        $content_mail = $req->content;


        Mail::send('email.contact',
            [
                'name_mail' => $name_mail,
                'email_mail' => $email_mail,
                'content_mail' => $content_mail,
            ],
            function($message) use ($tile_mail, $name_mail, $data, $content_mail, $email_mail, $to_email){
                    $message->to($to_email)->subject($tile_mail);
                    $message->from($data['email'],$tile_mail);
                });

        return redirect()->back()->with('thongbao','Gửi email thành công, Shop sẽ phản hồi trong thời gian sớm nhất có thể');


    }

    public function getGioiThieu(Request $req){

        // $url_canonical = $req->url();
        $image_og = $req->url();

    	return view('FrontEnd.About',compact('image_og'));
    }

    public function getAddToCart(Request $req,$id){
    	// $product = Product::find($id);
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();

        $product = Product::join('post', 'products.id_post', '=', 'post.id_post')->find($id);


    	$oldCart = Session('cart')?Session::get('cart'):null;
    	$cart = new Cart($oldCart);
    	$cart->add($product,$id);
    	$req->Session()->put('cart',$cart);
    	return redirect()->back();
    }

    public function getDelCart($id){
    	$oldCart = Session::has('cart')?Session::get('cart'):null;
    	$cart = new Cart($oldCart);
    	$cart->removeItem($id);
    	if(count($cart->items)>0){
    		Session::put('cart',$cart);
    	}
    	else{
            Session::forget('cart');
    		Session::forget('coupon');
    	}
    	return redirect()->back();
    }

    public function getshoppingcart(Request $req){
        // if(Auth::check() || Session::get('user_name_login')){

            $image_og = $req->url();

            return view('FrontEnd.CartDetail',compact('image_og'));
        // }
        return redirect()->route('trang-chu');  

    }


    public function getDatHang(Request $req){

        if(Auth::check() || Session::get('user_name_login')){
            // $url_canonical = $req->url();
            // dd(Session::get('pay'));
            $image_og = $req->url();
            if (!Session::get('user_name_login')) {
                $user_dh=  User::find(Auth::user()->id );
            }else{
                $user_dh=  User::find(Session::get('user_id_login') );
            }
            

            return view('FrontEnd.OrderCart',compact( 'image_og', 'user_dh'));
        }
        else{
            return redirect()->route('trang-chu');
        }

    }
    
    public function postDatHang(Request $req){
        
    	$cart = Session::get('cart');
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,[
                'name23131' => 'required',
                'email' => 'required|email',
                'address11223' => 'required',
                'phone' => 'required|min:11|numeric',
            ],
            [
                'name.required'=>'Vui lòng nhập tên',
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',

                'address11223.required'=>'Vui lòng nhập địa chỉ',
                'phone.required'=>'Vui lòng nhập số diện thoại',

                'phone.min'=>'Số diện thoại không đúng',
                'phone.numeric'=>'Vui lòng nhập số diện thoại'

            ]);
        }else{
            $this->validate($req,[
                'name23131' => 'required',
                'email' => 'required|email',
                'address11223' => 'required',
                'phone' => 'required|min:11|numeric',
            ]);
        }
    	$customer = new Customer();
    	$customer->name = $req->name23131;
    	$customer->gender = $req->gender;
    	$customer->email = $req->email;
    	$customer->address = $req->address11223;
    	$customer->phone_number = $req->phone;
    	$customer->note = $req->notes;
    	$customer->save();

        $checkout_code = substr(md5(microtime()),rand(0,26),5);
    	$bill = new Bill();
    	$bill->id_customer = $customer->id;
    	$bill->date_order = date('Y-m-d');
        if (Session::get('coupon')) {
            foreach(Session::get('coupon') as $key => $coun){
                if($coun['coupon_condition']==0){
                    $total_coupon = ($cart->totalPrice*$coun['coupon_number'])/100;
                    $total_pre = $cart->totalPrice-$total_coupon;
                    $totalPrice = $total_pre;
                }else{
                    $total_coupon = $cart->totalPrice-$coun['coupon_number'];
                    $totalPrice = $total_coupon;
                }
            }
            $bill->total = $totalPrice;    
        }else{
            $bill->total = $cart->totalPrice;
        }
    	$bill->payment = $req->payment_method;
        $bill->status_bill = $req=0;
    	$bill->order_code = $checkout_code;
    	$bill->save();

    	foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id_bill;
            $bill_detail->id_product = $key;
            $bill_detail->id_post_bill_detail = $value['item']['id_post'];
            $bill_detail->order_code = $checkout_code;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price'] / $value['qty']);
            $bill_detail->save();
        }
        if (Session::get('coupon')) {
            foreach(Session::get('coupon') as $key => $coun){
                $coupon_qty = Coupon::where('coupon_code',$coun['coupon_code'])->first();
                if (!Session::get('user_name_login')) {
                    $coupon_qty->coupon_used = ','.Auth::user()->id;
                }else{
                    $coupon_qty->coupon_used = ','.Session::get('user_id_login');
                }
                $coupon_qty->coupon_qty--;
                $coupon_qty->save(); 
            }
        }

        //send mail xac nhan dat hang
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $to_email =  "npn020899@gmail.com";
        $title_mail = 'Xác Nhận Đơn Hàng'. ' ' .$now;
        $data['email'][] = $customer->email;

        if(Session::has('locale')){
            app()->setLocale(Session::get('locale'));
        }
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();


        $shipping_array = array('name' =>$customer->name,
                                'address' =>$customer->address,
                                'phone_number' =>$customer->phone_number
                                 );


        Mail::send('email.mail_oder', 
            [
                'items' => $cart->items,
                'multisp' => $multisp,
                'shipping_array' => $shipping_array
            ],
            function($message) use ($title_mail, $data, $to_email){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($to_email, $title_mail);
        });
        Session::forget('cart');
        Session::forget('coupon');
        
        return redirect()->back()->with('thongbao','Đặt hàng thành công');


    }


    public function postDangNhap(Request $req){
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
        	$this->validate($req,
        		[
        			'email'=>'required|email',
        			'password'=>'required|min:6|max:20'

        		],
        		[
        			'email.required'=>'Vui lòng nhập email',
        			'email.email'=>'Email không đúng định dạng',

        			'password.required'=>'Vui lòng nhập mật khẩu',
        			'password.min'=>'Mật khẩu ít nhất 6 ký tự',
        			'password.max'=>'Mật khẩu không quá 20 ký tự'
        		]);
        }else{
            $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'

            ]);
        }
    	
    	$credentials = array('email'=>$req->email, 'password'=>$req->password);
    	if(Auth::attempt($credentials) && Auth::user()->level == 2 ){
			return redirect()->back();
    	}
    	else
    	{
    		return redirect()->route('trang-chu-admin');

    	}
    	
    }

    public function postTimKiem(Request $req){



    	$product = Product::join('post', 'products.id_post', '=', 'post.id_post')
        // ->join('type_products', 'type_products.id', '=', 'products.id_type')
        ->where('unit_price','like','%'.$req->search.'%')
    								// ->orWhere('name_type',$req->key)
                                    ->orWhere('sp_vi',$req->search)
                                    ->orWhere('sp_en',$req->search)
    								->paginate(6);
        // $url_canonical = $req->url();
        $image_og = $req->url();


        $sanpham_new= Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->inRandomOrder()->paginate(3);

		return view('FrontEnd.Search',compact('product',  'image_og', 'sanpham_new'));

    }
    public function autocomplete_ajax(Request $request){
        $data = $request->all();
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();


        if($data['query']){

            $product = Product::join('post', 'products.id_post', '=', 'post.id_post')
                                    
                                    ->where($multisp,'LIKE','%'.$data['query'].'%')
                                    // ->orWhere('name_type',$req->key)
                                    ->orWhere('unit_price',$data['query'])
                                    // ->orWhere('sp_en',$data['query'])
                                    ->get();

            // dd($product);
            $output = '
            <ul class="dropdown-menu" style="display:block; position:absolute; width:100%;height: 300px;overflow-y: scroll;">'
            ;

            foreach($product as $key => $val){
                if (is_numeric($data['query'])) {

                    $output .= '<li class="li_ajax" style="cursor: pointer;padding-bottom: 8px;margin-left: 8px;">'.$val->unit_price.'</li>';
                }else{

                    $output .= '<li class="li_ajax" style="cursor: pointer;padding-bottom: 8px;margin-left: 8px;">'.$val->$multisp.'</li>';
                }
            }

            $output .= '</ul>';
            echo $output;
        }


    }



    public function pay_order(Request $req){
        if ($req->payorderonline == 2) {
            $pay = Session::get('pay');
            $cont[] = array('pay' =>$req->payorderonline);

            Session::put('pay', $cont);

            return redirect()->route('dathang');
        }else{
            Session::forget('pay');
            return redirect()->route('dathang');
        }

    }

    public function check_coupon(Request $req){
        $data = $req->all();
        $today =  Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        if (Session::get('user_name_login')) {
            $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',0)->where('coupon_date_end', '>=', $today)->where('coupon_used', 'LIKE', '%'.Session::get('user_id_login').'%')->first();
        }else{
            $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',0)->where('coupon_date_end', '>=', $today)->where('coupon_used', 'LIKE', '%'.Auth::user()->id.'%')->first();
        }
        
        if ($used_coupon) {
            return redirect()->back()->with('message_err', 'Mã giảm giá đã sử dụng, vui lòng nhập mã khác');
        }else{

            $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',0)->where('coupon_date_end', '>=', $today)->first();
            if ($coupon) {
                $coupon_count = $coupon->count();
                if ($coupon_count>0) {
                    $coupon_session = Session::get('coupon');
                    if ($coupon_session==true) {
                        $is_avaiable = 0;
                        if ($is_avaiable==0) {
                            $coun[] = array(
                                'coupon_code' => $coupon->coupon_code, 
                                'coupon_condition' => $coupon->coupon_condition, 
                                'coupon_number' => $coupon->coupon_number, 
                            );
                            Session::put('coupon',$coun);
                        }
                    }else{
                        $coun[] = array(
                                'coupon_code' => $coupon->coupon_code, 
                                'coupon_condition' => $coupon->coupon_condition, 
                                'coupon_number' => $coupon->coupon_number, 
                            );
                        Session::put('coupon',$coun);
                    }
                    Session::save();

                    return redirect()->back()->with('message', 'Thêm Mã Giảm Giá Thành Công');

                }
            }else{
                return redirect()->back()->with('message_err', 'Mã giảm giá không đúng hoặc đã hết hạn');
            }
        }
    }

    public function getWishlist(Request $req){

        // $url_canonical = $req->url();

        $image_og = $req->url();

        return view('FrontEnd.WishList', compact('image_og'));
    }

    public function getCompare(Request $req){

        // $url_canonical = $req->url();

        $image_og = $req->url();

        return view('FrontEnd.Compare', compact( 'image_og'));
    }

    public function insert_rating(Request $req){
        $data = $req->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating_number = $data['index'];
        $rating->save();
        echo 'done';
    }


    // public function getVnpay(Request $req){

    //     $image_og = $req->url();
    //     $user_dh=  User::find(Auth::user()->id );
    //     return view('vnpay.index',compact( 'image_og', 'user_dh'));
    // }

    public function postVnpay_online(Request $req){
        // dd($req->all());
        $cart = Session::get('cart');
        $vnp_TxnRef = substr(md5(microtime()),rand(0,26),5); 
        $vnp_OrderInfo = "Xem nao";
        $vnp_OrderType = "Đoán xem";

        if (Session::get('coupon')) {
            foreach(Session::get('coupon') as $key => $coun){
                if($coun['coupon_condition']==0){
                    $total_coupon = ($cart->totalPrice*$coun['coupon_number'])/100;
                    $total_pre = $cart->totalPrice-$total_coupon;
                    $totalPrice = $total_pre;
                }else{
                    $total_coupon = $cart->totalPrice-$coun['coupon_number'];
                    $totalPrice = $total_coupon;
                }
            }
            $vnp_Amount = $totalPrice * 100;    
        }else{
            $vnp_Amount = ($cart->totalPrice) * 100;
        }
        $vnp_Locale = config('app.locale');
        $vnp_BankCode = $req->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $order_session = Session::get('order_customer');
        $name_order = $req->name23131;
        $gender_order = $req->gender;
        $email_order = $req->email;
        $address_order = $req->address11223;
        $phone_number_order = $req->phone;
        $note_order = $req->notes;
        $code_order = $vnp_TxnRef;
        $BankCode_order = $vnp_BankCode;

        
        $count_order[] = array(
            'name_order' => $name_order, 
            'gender_order' => $gender_order, 
            'email_order' => $email_order, 
            'address_order' => $address_order, 
            'phone_number_order' => $phone_number_order, 
            'note_order' => $note_order, 
            'code_order' => $code_order, 
            'BankCode_order' => $BankCode_order, 
        );
        Session::put('order_customer',$count_order);

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('VNP_TMN_CODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('vnpayreturn'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);

        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
       

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASH_SECRET')) {
            $vnpSecureHash = hash('sha256', env('VNP_HASH_SECRET') . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);

    }

    public function getVnpay_return(Request $req){
        // dd($req->toArray());
        if ($req->vnp_ResponseCode == "00") {
            
        
        $cart = Session::get('cart');
        $ordercart = Session::get('order_customer');
        

        foreach ($ordercart as $key => $value1) {
            $bank = $value1['BankCode_order'];
            $customer = new Customer();
            $customer->name = $value1['name_order'];
            $customer->gender = $value1['gender_order'];
            $customer->email = $value1['email_order'];
            $customer->address = $value1['address_order'];
            $customer->phone_number = $value1['phone_number_order'];
            $customer->note = $value1['note_order'];
            $customer->save();

            $bill = new Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            if (Session::get('coupon')) {
                foreach(Session::get('coupon') as $key => $coun){
                    if($coun['coupon_condition']==0){
                        $total_coupon = ($cart->totalPrice*$coun['coupon_number'])/100;
                        $total_pre = $cart->totalPrice-$total_coupon;
                        $totalPrice = $total_pre;
                    }else{
                        $total_coupon = $cart->totalPrice-$coun['coupon_number'];
                        $totalPrice = $total_coupon;
                    }
                }
                $bill->total = $totalPrice;    
            }else{
                $bill->total = $cart->totalPrice;
            }
            $bill->payment = $req->vnp_CardType;
            $bill->status_bill = $req=0;
            $bill->order_code = $value1['code_order'];;
            $bill->save();
        }


        

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id_bill;
            $bill_detail->id_product = $key;
            $bill_detail->id_post_bill_detail = $value['item']['id_post'];
            $bill_detail->order_code = $bill->order_code;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price'] / $value['qty']);
            $bill_detail->save();

            $pay = new Payments();
            $pay->id_customer = $customer->id;
            $pay->id_post_payment = $value['item']['id_post'];
            $pay->order_code = $bill->order_code;
            $pay->code_bank = $bank;
            $pay->time = date('d-m-Y H:i:s');
            $pay->save();
        }
        if (Session::get('coupon')) {
            foreach(Session::get('coupon') as $key => $coun){
                $coupon_qty = Coupon::where('coupon_code',$coun['coupon_code'])->first();
                if (!Session::get('user_name_login')) {
                    $coupon_qty->coupon_used = ','.Auth::user()->id;
                }else{
                    $coupon_qty->coupon_used = ','.Session::get('user_id_login');
                }
                $coupon_qty->coupon_qty--;
                $coupon_qty->save(); 
            }
        }

        //send mail xac nhan dat hang
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $to_email =  "npn020899@gmail.com";
        $title_mail = 'Xác Nhận Đơn Hàng'. ' ' .$now;
        $data['email'][] = $customer->email;

        if(Session::has('locale')){
            app()->setLocale(Session::get('locale'));
        }
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();


        $shipping_array = array('name' =>$customer->name,
                                'address' =>$customer->address,
                                'phone_number' =>$customer->phone_number
                                 );


        Mail::send('email.mail_oder', 
            [
                'items' => $cart->items,
                'multisp' => $multisp,
                'shipping_array' => $shipping_array
            ],
            function($message) use ($title_mail, $data, $to_email){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($to_email, $title_mail);
        });
        Session::forget('cart');
        Session::forget('coupon');
        Session::forget('order_customer');
        Session::forget('pay');

        
        return redirect()->route('dathang')->with('thongbao','Đặt hàng thành công');
        }

    }


}
