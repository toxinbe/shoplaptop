<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Statistical;
use App\Models\Coupon;
use App\Models\Visitors;

use App\Imports\ImportCoupon;
use App\Exports\ExportCoupon;
use App\Imports\ImportPost;
use App\Exports\ExportPost;
use App\Imports\ImportSlide;
use App\Exports\ExportSlide;
use App\Imports\ImportNsx;
use App\Exports\ExportNsx;
// use App\Imports\ImportProduct;
use App\Exports\ExportProduct;
use App\Exports\ExportOrderApproved;
use App\Exports\ExportOrderUnapproved;
use App\Exports\ExportOrderCancel;
use App\Exports\ExportOrder;

use App\Imports\ImportAccount;
use App\Exports\ExportAllAccount;
use App\Exports\ExportAdminAccount;
use App\Exports\ExportUserAccount;

use Auth;
use DB;
use Session;
use Hash;
use File;
use PDF;
use Carbon\Carbon;
use DNS1D;
use DNS2D;
use Mail;
use Excel;

class admincontroller extends Controller
{

    public function getIndexAdminDash(Request $req){
    	if (Auth::check() && Auth::user()->level == 1) {
            
            $url_canonical = $req->url();
            // $user_ip_address = '192.168.1.42';

            $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
            $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
            $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

            //tong thang truoc
            $tong_thangtruoc = Visitors::whereBetween('date_visitor', [$dau_thangtruoc,$cuoi_thangtruoc])->get();
            $tong_thangtruoc_count = $tong_thangtruoc->count();

            //tong thang nay
            $tong_thangnay = Visitors::whereBetween('date_visitor', [$dauthangnay,$now])->get();
            $tong_thangnay_count = $tong_thangnay->count();

            //tong 1 nam
            $tong_motnam = Visitors::whereBetween('date_visitor', [$sub365ngay,$now])->get();
            $tong_motnam_count = $tong_motnam->count();

            //tat ca
            $tatca_count = Visitors::all()->count();


    		return view('admin.Dashboard', compact('tatca_count', 'tong_thangtruoc_count', 'tong_thangnay_count', 'tong_motnam_count', 'url_canonical'));
    	}
    	else
    		return redirect()->route('trang-chu');
    }

  

/*-----------------------------------------------User--------------------------------------------------------------------*/
    public function getQL_NguoiDung(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            $user = User::all();
            $url_canonical = $req->url();

            return view('admin.QL_nguoidung', compact('user','url_canonical' ));
        }
        else{
            return redirect()->route('trang-chu');
        }
        
    }

    public function getQL_NguoiDung_user(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            
            $taikhoan_user = User::where('level',2)->get();
            $url_canonical = $req->url();

            return view('admin.QL_nguoidung_user', compact('taikhoan_user','url_canonical'));
        }
        else{
            return redirect()->route('trang-chu');
        }
        
    }
    public function getQL_NguoiDung_ad(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            
            $taikhoan_ad = User::where('level',1)->get();
            $url_canonical = $req->url();

            return view('admin.QL_nguoidung_ad', compact('taikhoan_ad', 'url_canonical'));
        }
        else{
            return redirect()->route('trang-chu');
        }
        
    }

    public function DelAdmin($id)
    {
        $user = User::where('id', $id)->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công!');
    }

    public function AddAdmin(Request $req){
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
                [
                    'email'=>'required|email|unique:users,email',
                    'password'=>'required|min:6|max:20',
                    'name'=>'required',
                    're_password'=>'required|same:password'

                ],
                [
                    'name.required'=>'Vui lòng nhập full name',

                    'email.required'=>'Vui lòng nhập email',
                    'email.email'=>'Email không đúng định dạng',
                    'email.unique'=>'Email đã được sử dụng',

                    'password.required'=>'Vui lòng nhập mật khẩu',
                    'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                    'password.max'=>'Mật khẩu không quá 20 ký tự',

                    're_password.required'=>'Vui lòng nhập lại mật khẩu',
                    're_password.same'=>'Mật khẩu không giống nhau'

                ]);
        }else{
            $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'name'=>'required',
                're_password'=>'required|same:password'

            ]);
        }
        $user = new User();
        $user->full_name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->adress;
        $user->level = $req->level;
        $user->save();
        return redirect()->back()->with('thongbao', 'Thêm mới thành công!'); 
    }


    
    public function postUpdateAdmin(Request $req,$id){
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
            [
                'email'=>'required|email',
                
                'name'=>'required',

            ],
            [
                'name.required'=>'Vui lòng nhập full name',

                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',

            ]);
        }else{
            $this->validate($req,
            [
                'email'=>'required|email',
                
                'name'=>'required',

            ]);
        }
        $user_up=User::where('id',$id)->first();
        $user_up->full_name = $req->name;
        $user_up->email = $req->email;
        if ($req->password) {
            $user_up->password = Hash::make($req->password);
        }else{
            $user_up->password =$user_up->password;
        }
        $user_up->phone = $req->phone;
        $user_up->address = $req->adress;
        $user_up->level = $req->level;

        $user_up->save();
        return redirect()->back()->with('thongbao', 'Cập nhật thành công!');
    }

    public function active_user($id){
        User::where('id',$id)->update(['level'=>2]);
        return redirect()->back();
    }
    public function unactive_user($id){
        User::where('id',$id)->update(['level'=>1]);
        return redirect()->back();
    }

/*-----------------------------------------------Slide-------------------------------------------------------------------*/
    public function getQL_Slide(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            $slide = Slide::all();
            // $slide = Slide::where('status_slide',0)->get();
            $url_canonical = $req->url();
        


            return view('admin.QL_slide', compact('slide', 'url_canonical'));
        }else{
            return redirect()->route('trang-chu');
            
        }
    }

    public function DelAdmin_Slide($id)
    {
        $slide = Slide::where('id', $id)->first();

        $image_path = "public/source/image/slide/" . $slide->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $slide = Slide::where('id', $id)->first()->delete();


        return redirect()->back()->with('thongbao', 'Xóa thành công!');
    }

    public function AddAdmin_Slide(Request $req){
        $slide = new Slide();
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
            [
                // 'link_slide'=>'required',
                'image_file' => 'required|mimes:jpg,jpeg,png,gif|max:4096',

            ],
            [
                // 'link_slide.required'=>'Vui lòng nhập link',

                'image_file.required'=>'Vui lòng chọn hình',
                'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                'image_file.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',

            ]);
        }else{
            $this->validate($req,
            [
                // 'link_slide'=>'required',
                'image_file' => 'required|mimes:jpg,jpeg,png,gif|max:4096',

            ]);
        }

        $slide->link = $req->link_slide;
        $slide->status_slide = $req->status_slide;

        if ($req->hasFile('image_file')) {
            $file = $req->file('image_file');
            $get_name_img = $file->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));  
            $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
            $filename =time() .'.'. $new_img;
            $file->move('public/source/image/slide/', $filename);
            $slide->image = $filename;
        }else{
            return $req;
            $slide->image = '';
        }
        $slide->status_slide = $req=0;
        

        $slide->save();
        return redirect()->back()->with('thongbao', 'Thêm mới thành công!');
    }


    public function postUpdateSlide(Request $req, $id){
        if (Auth::check() && Auth::user()->level == 1) {
            // dd($id);
            $slide_update = Slide::where('id',$id)->first();
            $slide_update->link = $req->link_slide;
            $slide_update->status_slide = $req->status_slide;

            if($req->hasFile('image')){
                if(Session::get('locale') == 'vi' || Session::get('locale') == null){
                    $this->validate($req, 
                    [
                        
                        'image' => 'mimes:jpg,jpeg,png,gif|max:4096',
                    ],          
                    [
                        
                        // 'image.required' => 'Vui lòng chọn hình',
                        'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                        'image.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',
                    ]);
                }else{
                    $this->validate($req, 
                    [
                        
                        'image' => 'mimes:jpg,jpeg,png,gif|max:4096',
                    ]);
                }

            }
            if ($req->hasFile('image')) {
                $getHA = Slide::select('image')->where('id',$req->id)->first();

                $image_path = "public/source/image/slide/" . $getHA->image;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                if ($req->hasFile('image')) {
                    $file = $req->file('image');
                    $get_name_img = $file->getClientOriginalName();
                    $name_img = current(explode('.', $get_name_img));  
                    $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
                    $filename =time() .'.'. $new_img;
                    $file->move('public/source/image/slide/', $filename);
                    $slide_update->image = $filename;
                }else{
                    return $req;
                    $slide_update->image = '';
                }

                // $slide_update->save();

            }
            $slide_update->save();

            return redirect()->route('quanlyslide')->with('thongbao', 'Cập nhật thành công!');
        }else{
            return redirect()->route('trang-chu');
        }
        
    }

    public function active_slide($id){
        Slide::where('id',$id)->update(['status_slide'=>1]);
        return redirect()->back();
    }
    public function unactive_slide($id){
        Slide::where('id',$id)->update(['status_slide'=>0]);
        return redirect()->back();
    }

/*-----------------------------------------------NSX--------------------------------------------------------------------*/
    public function getQL_Nsx(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            $nsx = ProductType::orderBy('id', 'desc')->get();
            $url_canonical = $req->url();

            return view('admin.QL_Nsx', compact('nsx', 'url_canonical'));
        }else{
            return redirect()->route('trang-chu');
        }
    }

    public function DelAdmin_NSX($id, Request $req)
    {
        $image = ProductType::where('id', $id)->first();
        $sp1 = Product::where('id_type', $image->id)->get();
        if(empty($sp1[0])){
            Product::where('id_type', $image->id)->delete();
            $image_path = "public/source/image/type_product/" . $image->image;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            ProductType::where('id', $id)->first()->delete();
            return redirect()->back()->with('thongbao', 'Xóa thành công!');
            return redirect()->back();
        }
        return redirect()->back()->with('thongbao', 'Loại SP có chứa '.sizeof($sp1).' SP, Xóa KHÔNG thành công!');
        return redirect()->back();
    }

    public function AddAdmin_NSX(Request $req){
        $nsx = new ProductType();
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
            [
                'name'=>'required',
                'image_file' => 'required|mimes:jpg,jpeg,png,gif|max:4096',

            ],
            [
                'name.required'=>'Vui lòng nhập tên',
                'image_file.required'=>'Vui lòng chọn hình',
                'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                'image_file.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',

            
            ]);
        }else{
            $this->validate($req,
            [
                'name'=>'required',
                'image_file' => 'required|mimes:jpg,jpeg,png,gif|max:4096',

            ]);
        }

        $nsx->name_type  = $req->name;
        if ($req->hasFile('image_file')) {
            $file = $req->file('image_file');
            $get_name_img = $file->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));  
            $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
            $filename =time() .'.'. $new_img;
            $file->move('public/source/image/type_product/', $filename);
            $nsx->image = $filename;
        }else{
            return $req;
            $nsx->image = '';
        }
        

        $nsx->save();
        return redirect()->route('quanlynsx')->with('thongbao', 'Thêm mới thành công!'); 
    }



    public function postUpdateNsx(Request $req, $id){
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
            [
                'name'=>'required',
                'image' => 'mimes:jpg,jpeg,png,gif|max:4096',

            ],
            [
                'name.required'=>'Vui lòng nhập tên',
                // 'image.required'=>'Vui lòng chọn hình',
                'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                'image.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',

            ]);
        }else{
            $this->validate($req,
            [
                'name'=>'required',
                'image' => 'mimes:jpg,jpeg,png,gif|max:4096',

            ]);
        }
        $nsx_update = ProductType::where('id',$id)->first();

        $nsx_update->name_type = $req->name;

        if ($req->hasFile('image')) {
            $getHA = ProductType::select('image')->where('id',$req->id)->first();

            $image_path = "public/source/image/type_product/" . $getHA->image;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $get_name_img = $file->getClientOriginalName();
                $name_img = current(explode('.', $get_name_img));  
                $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
                $filename =time() .'.'. $new_img;
                $file->move('public/source/image/type_product/', $filename);
                $nsx_update->image = $filename;
            }else{
                return $req;
                $nsx_update->image = '';
            }

            // $nsx_update->save();

        }


        $nsx_update->save();

        return redirect()->route('quanlynsx')->with('thongbao', 'Cập nhật thành công!'); 


    }


/*-----------------------------------------------Sản-Phẩm----------------------------------------------------------------*/
    public function getQL_Sanpham(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {

            // dd(config('app.locale'));
            $sanpham = Product::orderby('id', 'desc')->get();
            $type = ProductType::all();
            $url_canonical = $req->url();


            $sanpham1 = DB::select("SELECT sp.id,sp.sub_image, sp.product_soid ,sp.id_type, type_products.name_type as loai,
                sp.product_quantity,sp.unit_price,sp.hours_sale,sp.date_sale, sp.promotion_price,sp.image,sp.new,sp.id_post, post.sp_vi as sp_vi,  post.sp_en as sp_en, post.description_en as description_en, post.description_vi as description_vi, post.product_slug 
                        FROM products as sp
                        INNER JOIN type_products ON sp.id_type = type_products.id
                        INNER JOIN post ON sp.id_post = post.id_post");

            $nameproduct = Post::orderby('id_post', 'asc')->get();
            $type = ProductType::orderby('id', 'desc')->get();
      

            return view('admin.QL_sanpham', compact('sanpham','sanpham1', 'type', 'nameproduct','url_canonical'));

        }else{
            return redirect()->route('trang-chu');
        }
    }


    public function DelAdmin_Sp($id, Request $req)
    {

        $sp1 = Product::where('id', $id)->first();

        $image_path = "public/source/image/product/" . $sp1->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $sp1 = Product::where('id', $id)->first()->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công!');
    }

    public function AddAdmin_Sp(Request $req){
        $sp = new Product();
        $nn_add = new Post();

        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
            [
                'hours_sale'=>'required|max:23|integer',
                'mins_sale'=>'required|max:60|integer',
                'secs_sale'=>'required|max:60|integer',
                'quantity'=>'required',
                'unit_price'=>'required',
                'promotion_price'=>'required',
                'image_file' => 'required|mimes:jpg,jpeg,png,gif|max:4096',

            ],
            [
                'hours_sale.required'=>'Vui lòng nhập giờ',
                'hours_sale.max'=>'Vui lòng nhập không quá 23',
                'mins_sale.required'=>'Vui lòng nhập phút',
                'mins_sale.max'=>'Vui lòng nhập không quá 60',
                'secs_sale.required'=>'Vui lòng nhập giây',
                'secs_sale.max'=>'Vui lòng nhập không quá 60',

                'hours_sale.integer'=>'Vui lòng nhập số',
                'mins_sale.integer'=>'Vui lòng nhập số',
                'secs_sale.integer'=>'Vui lòng nhập số',

                'quantity.required'=>'Vui lòng nhập tên',

                'unit_price.required'=>'Vui lòng nhập số tiền',

                'promotion_price.required'=>'Vui lòng nhập số tiền khuyến mãi',

                'image_file.required' => 'Vui lòng chọn hình',
                'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                'image_file.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',

            
            ]);
        }else{
            $this->validate($req,
            [
                'hours_sale'=>'required|max:23|integer',
                'mins_sale'=>'required|max:60|integer',
                'secs_sale'=>'required|max:60|integer',
                'quantity'=>'required',
                'unit_price'=>'required',
                'promotion_price'=>'required',
                'image_file' => 'required|mimes:jpg,jpeg,png,gif|max:4096',

            ]);
        }


        // $sp->id_post = $req->name;
        $nn_add->sp_vi = $req->sp_vi;
        $nn_add->sp_en = $req->sp_en;
        $nn_add->description_vi = $req->description_vi;
        $nn_add->description_en = $req->description_en;
        $nn_add->product_slug = $req->slug;
        $nn_add->save();

        $sp->id_post = $nn_add->id_post;
        $sp->product_quantity = $req->quantity;
        $sp->unit_price = $req->unit_price;
        $sp->promotion_price = $req->promotion_price;
        $sp->new = $req->new;
        $sp->product_soid = 0;
        $sp->id_type  = $req->type;
        $sp->date_sale  = $req->date_sale;
        $sp->hours_sale  = $req->hours_sale.':'.$req->mins_sale.':'.$req->secs_sale;

        if ($req->hasFile('image_file')) {

            $file = $req->file('image_file');
            $get_name_img = $file->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));  
            $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
            $filename =time() .'.'. $new_img;
            $file->move('public/source/image/product/', $filename);
            $sp->image = $filename;
        }else{
            return $req;
            $sp->image = '';
        }

        $sp->save();

        return redirect()->back()->with('thongbao', 'Cập nhật thành công!');
    }



    public function postUpdateSp(Request $req, $id){
        if (Auth::check()) {
            $sp_update = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id',$id)->first();
            $up_nn = Post::where('id_post',$sp_update->id_post)->first();
            // dd($up_nn);
            if(Session::get('locale') == 'vi' || Session::get('locale') == null){
                $this->validate($req,
                [
                    'sp_vi'=>'required',
                    'sp_en'=>'required',
                    'unit_price'=>'required',
                    'promotion_price'=>'required',
                    'image' => 'mimes:jpg,jpeg,png,gif|max:4096',

                ],
                [
                    'sp_vi.required'=>'Vui lòng nhập tên Vi',
                    'sp_en.required'=>'Vui lòng nhập tên En',

                    'unit_price.required'=>'Vui lòng nhập số tiền',

                    'promotion_price.required'=>'Vui lòng nhập số tiền khuyến mãi',

                    // 'image.required' => 'Vui lòng chọn hình',
                    'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'image.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',

                
                ]);
            }else{
                $this->validate($req,
                [
                    'sp_vi'=>'required',
                    'sp_en'=>'required',
                    'unit_price'=>'required',
                    'promotion_price'=>'required',
                    'image' => 'mimes:jpg,jpeg,png,gif|max:4096',

                ]);
            }

            $up_nn->sp_vi = $req->sp_vi;
            $up_nn->sp_en = $req->sp_en;
            $up_nn->description_vi = $req->description_vi;
            $up_nn->description_en = $req->description_en;
            $up_nn->product_slug = $req->slug;
            $up_nn->save();

            $sp_update->unit_price = $req->unit_price;
            $sp_update->promotion_price = $req->promotion_price;
            $sp_update->new = $req->new;
            $sp_update->product_quantity = $req->quantity;
            $sp_update->product_soid = $req->product_soid;
            $sp_update->id_type  = $req->type;
            $sp_update->date_sale  = $req->date_sale;
            $sp_update->hours_sale  = $req->hour_sale.':'.$req->min_sale.':'.$req->sec_sale;

            if ($req->hasFile('image')) {
                $getHT = Product::select('image')->where('id',$req->id)->first();

                $image_path = "public/source/image/product/" . $getHT->image;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                 if ($req->hasFile('image')) {

                    $file = $req->file('image');
                    $get_name_img = $file->getClientOriginalName();
                    $name_img = current(explode('.', $get_name_img));  
                    $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
                    $filename =time() .'.'. $new_img;
                    $file->move('public/source/image/product/', $filename);
                    $sp_update->image = $filename;
                }else{
                    return $req;
                    $sp_update->image = '';
                }
                // $sp_update->save();

            }

            $sp_update->save();
            return redirect()->route('quanlysanpham')->with('thongbao', 'Cập nhật thành công!');
        }else {
            return redirect()->route('trang-chu');
        }
    }

    public function active_sp($id){
        Product::where('id',$id)->update(['new'=>0]);
        return redirect()->back();
    }
    public function unactive_sp($id){
        Product::where('id',$id)->update(['new'=>1]);
        return redirect()->back();
    }

/*-----------------------------------------------Đơn-Hàng----------------------------------------------------------------*/
    
    public function getDonHang(Request $req)
    {
        if (Auth::check()) {


            $donhang = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->orderby('id_bill', 'DESC')->get();
            $url_canonical = $req->url();
           

            return view('admin.QL_donhang', compact('donhang','url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }
    public function getDonHang_daduyet(Request $req)
    {
        if (Auth::check()) {
            
            $donhang_daduyet = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('status_bill',1)->orderby('id_bill', 'desc')->get();
            $url_canonical = $req->url();
           

            return view('admin.QL_donhang_daduyet', compact('donhang_daduyet','url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }
    public function getDonHang_chuaduyet(Request $req)
    {
        if (Auth::check()) {
            
            $donhang_chuaduyet = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('status_bill',0)->orderby('id_bill', 'desc')->get();
            $url_canonical = $req->url();
           

            return view('admin.QL_donhang_chuaduyet', compact('donhang_chuaduyet', 'url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }
    public function getDonHang_huy(Request $req)
    {
        if (Auth::check()) {
            
            $donhang_huy = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('status_bill',2)->orderby('id_bill', 'desc')->get();
            $url_canonical = $req->url();
           

            return view('admin.QL_donhang_huy', compact('donhang_huy','url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }


    public function DelAdmin_DonHang($id)
    {

        $bill = Bill::where('id_bill', $id)->first();

        Customer::where('id', $bill->id_customer)->first()->delete();

        $billdetail = BillDetail::where('id_bill', $bill->id_bill)->delete();

        
        Bill::where('id_bill',$id)->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công!');
    }

    public function getChiTietDonHang($id, Request $req)
    {
        if (Auth::check()) {


            $billdetaill =DB::select("SELECT bt.id_bill_detail, bt.id_bill, bt.id_product, bt.id_post_bill_detail, bt.order_code, bt.quantity,
        bt.unit_price,p.sub_image,p.image,p.hours_sale,p.date_sale, p.product_quantity ,p.id_post, post.sp_vi as sp_vi,  post.sp_en as sp_en
        FROM bill_detail bt, products p
        INNER JOIN post ON p.id_post = post.id_post
         WHERE bt.id_product=p.id AND id_bill=$id ");
            $url_canonical = $req->url();

            $thongtin_kh = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('id_bill',$id)->get();




            return view('admin.ChitietDH', compact('billdetaill', 'thongtin_kh', 'url_canonical'));
        } else {
            return redirect()->route('trang-chu');
        }
    }
    public function postChiTietDonHang($id, Request $req){

        $qty_update = BillDetail::where('id_bill', $id)->where('order_code',$req->order_code)->first();
        // dd( $qty_update);
        $qty_update->quantity = $req->product_quantity_order;
        $qty_update->save();

        $total_update = Bill::where('id_bill', $id)->where('order_code',$req->order_code)->first();
        $total_update->total = $req->product_quantity_order * $qty_update->unit_price;
        $total_update->save();

        return redirect()->back();
    }


    public function update_order_qty(Request $req){
        $data = $req->all();

        $bill = Bill::find($data['order_id']);
        $bill->status_bill = $data['order_status'];
        $bill->save();

        //order date
        $order_date  = $bill->date_order;
        $statistic = Statistical::where('order_date',$order_date)->get();
        if($statistic){
            $statistic_count = $statistic->count(); 
        }else{
            $statistic_count = 0;
        }


        if ($bill->status_bill == 1) {
            //them
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;

            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_qty = $product->product_quantity;
                $product_soid = $product->product_soid;

                $product_price = $product->unit_price;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key==$key2) {
                        $pro_remain = $product_qty - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_soid = $product_soid + $qty;
                        $product->save();

                        //update doanh thu
                        $quantity+=$qty;
                        $total_order+=1;
                        $sales+=$product_price*$qty;
                        $profit = $sales - 1000;
                    }
                }
            }
            //update doanh so db
            if($statistic_count > 0){
                $statistic_update = Statistical::where('order_date',$order_date)->first();
                $statistic_update->sales = $statistic_update->sales + $sales;
                $statistic_update->profit =  $statistic_update->profit + $profit;
                $statistic_update->quantity =  $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + $total_order;
                $statistic_update->save();

            }else{
                
                $statistic_new = new Statistical();
                $statistic_new->order_date = $order_date;
                $statistic_new->sales = $sales;
                $statistic_new->profit =  $profit;
                $statistic_new->quantity =  $quantity;
                $statistic_new->total_order = $total_order;
                $statistic_new->save();
            }
        }else if ($bill->status_bill == 0 || $bill->status_bill == 2) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_qty = $product->product_quantity;
                $product_soid = $product->product_soid;

                if ($product->product_soid !=0) {
                    foreach ($data['quantity'] as $key2 => $qty) {
                        if ($key==$key2) {
                            $pro_remain = $product_qty + $qty;
                            $product->product_quantity = $pro_remain;
                            $product->product_soid = $product_soid - $qty;
                            $product->save();
                        }
                    }
                }
            }
        }

    }

    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        
        $billdetaill_print = BillDetail::where('order_code',$checkout_code)->join('post', 'post.id_post', 'bill_detail.id_post_bill_detail')->get();
        $bill_print = Bill::where('order_code',$checkout_code)->get();
 
        foreach($billdetaill_print as $key => $bd){
            $namepro = $bd->sp_vi;
        }

        $day = date('d');
        $month = date('m');
        $year = date('Y');

        $kh_print = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('order_code',$checkout_code)->first();

        $date_order_create = date_create($kh_print->date_order);
        if ($kh_print->payment == 'ATM') {
            $kq_pay = 'Chuyển khoản';
        }else{
            $kq_pay = 'Tiền mặt';
        }

        $tonghop = "$namepro - $kh_print->order_code";
        $output = '';
        $soid = 1;


        $output.='
        <meta charset="UTF-8">
        <div style="width:100%; float:left; margin: 40px 0px;font-family: DejaVu Sans; line-height: 200%; font-size:12px">
        <p style="float: right; text-align: right; padding-right:20px; line-height: 140%">
          Ngày đặt hàng: '.date_format($date_order_create, "d-m-Y").'<br><br>
          <span text-align: center>'.DNS2D :: getBarcodeHTML ( $tonghop, 'QRCODE',6.5,5).' </span>
        </p>
        <div style="float: left; margin: 0 0 1.5em 0; ">
         <strong style="font-size: 18px;">PhongVu</strong>
          <br />
          <strong>Địa chỉ:</strong> 1XX Bình Dương, TDM.
          <br/>
          <strong>Điện thoại:</strong> 0773654031
          <br/>
          <strong>Website:</strong> PhongVu.demo
          <br/>
          <strong>Email:</strong> npn0208@gmail.com
        </div>
        <div style="clear:both"></div>
        <table style="width: 100%"><tr><td valign="top" style="width: 65%">
        <h3 style="font-size: 14px;margin: 1.5em 0 1em 0;">Chi tiết đơn hàng</h3>
        <hr style="border: none; border-top: 2px solid #0975BD;"/>

        <table style="margin: 0 0 1.5em 0;font-size: 12px;" width="100%">
          <thead>
            <tr>
              <th style="width:25%;text-align: left;padding: 5px 0px">STT</th>
              <th style="width:35%;text-align: left;padding: 5px 0px">Sản phẩm</th>
              <th style="width:15%;text-align: right;padding: 5px 0px">Số lượng</th>
              <th style="width:25%;text-align: right;padding: 5px 0px">Giá</th>
            </tr>
          </thead>
          <tbody>';
            foreach($billdetaill_print as $key => $bd){
                foreach($bill_print as $key2 => $b_print){
                    if ($kh_print->payment == 'ATM') {
                        # code...
                        $toto = 0;
                    }else{
                        $toto = number_format($bd->unit_price,0,',','.');
                    }
                    $output.='
                    <tr valign="top" style="border-top: 1px solid #d9d9d9;">
                      <td align="left" style="padding: 5px 0px">'.$soid++.'</td>
                      <td align="left" style="padding: 5px 5px 5px 0px;white-space: pre-line;">'.$bd->sp_vi.'</td>
                      <td align="center" style="padding: 5px 0px">'.$bd->quantity.'</td>
                      <td align="right" style="padding: 5px 0px">'.number_format($bd->unit_price,0,',','.').'</td>
                    </tr>';
                }
            }
            $output.='
          </tbody>
        </table>
        <h3 style="font-size: 14px;margin: 0 0 1em 0;">Thông tin thanh toán</h3>
        <table style="font-size: 12px;width: 100%; margin: 0 0 1.5em 0;">
          <tr>
            <td style="padding: 5px 0px">Tổng giá sản phẩm:</td>
            <td style="text-align:right">'.number_format($b_print->total,0,',','.').'</td>
          </tr>
          <tr>
              <td style="width: 50%;padding: 5px 0px">Phí vận chuyển:</td>
              <td style="text-align:right;padding: 5px 0px">0</td>
            </tr>
          <tr>
            <td style="padding: 5px 0px"><strong>Tổng tiền:</strong></td>
            <td style="text-align:right;padding: 5px 0px"><strong><p>'.$toto.' VNĐ</td>
          </tr>
        </table>
        <h3 style="font-size: 14px;margin: 0 0 1em 0;">Ghi chú:</h3>
        <p style="line-height: 30px">'.$kh_print->note.'</p>
        </td><td valign="top" style="padding: 0px 20px">
         <h3 style="font-size: 14px;margin: 1.5em 0 1em 0;">Thông tin đơn hàng</h3>
        <hr style="border: none; border-top: 2px solid #0975BD;"/>
          <div style="margin: 0 0 1em 0; padding: 1em; border: 1px solid #d9d9d9;">
            <strong>Mã đơn hàng:</strong><br>#'.$kh_print->order_code.'<br>
              <strong>Ngày đặt hàng:</strong><br>'.date_format($date_order_create, "d-m-Y").'<br>
            <strong>Phương thức thanh toán</strong><br>'.$kq_pay.'
            <br>
            <strong>Phương thức vận chuyển</strong><br>Shipper
          </div>
          <h3 style="font-size: 14px;margin: 1.5em 0 1em 0;">Thông tin mua hàng</h3>
        <hr style="border: none; border-top: 2px solid #0975BD;"/>
          <div style="margin: 0 0 1em 0; padding: 1em; border: 1px solid #d9d9d9;  white-space: normal;">
            <strong>'.$kh_print->name.'</strong><br/>
            '.$kh_print->address.'<br/>
            Điện thoại: '.$kh_print->phone_number.'<br/>
            Email:'.$kh_print->email.'
          </div>
        </td></tr></table><br/><br/><br/><p>Nếu bạn có thắc mắc, vui lòng liên hệ chúng tôi qua email <u>npn0208@gmail.com</u> hoặc 0773654031</p></div>
        ';

        return $output;


    }

 



/*-----------------------------------------------Lang---------------------------------------------------------------*/

    public function getQL_NN(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            $ngonngu = Post::all();
            $url_canonical = $req->url();

            
            return view('admin.QL_post', compact('ngonngu','url_canonical'));
        }else{
            return redirect()->route('trang-chu');
        }
    }
    public function AddAdmin_NN(Request $req){
        $addnn = new Post();
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
            [
                'sp_vi'=>'required',
                'sp_en'=>'required',

            ],
            [
                'sp_vi.required'=>'Vui lòng nhập vi',
                'sp_en.required'=>'Vui lòng nhập en',

            
            ]);
        }else{
            $this->validate($req,
            [
                'sp_vi'=>'required',
                'sp_en'=>'required',

            ]);
        }

        $addnn->sp_vi  = $req->sp_vi;
        $addnn->sp_en  = $req->sp_en;
        $addnn->description_vi  = $req->description_vi;
        $addnn->description_en  = $req->description_en;
        $addnn->product_slug  = $req->slug;

        $addnn->save();
        return redirect()->route('quanlynn')->with('thongbao', 'Thêm mới thành công'); 
    }

    public function DelAdmin_NN($id)
    {
        $delnn = Post::where('id_post', $id)->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }



    public function postUpdateNn(Request $req, $id){
        if (Auth::check()) {
            if(Session::get('locale') == 'vi' || Session::get('locale') == null){
                $this->validate($req,
                [
                    'sp_vi'=>'required',
                    'sp_en'=>'required',

                ],
                [

                    'sp_vi.required'=>'Vui lòng nhập tên vi',
                    'sp_en.required'=>'Vui lòng nhập tên en',
                ]);
            }else{
                $this->validate($req,
                [
                    'sp_vi'=>'required',
                    'sp_en'=>'required',

                ]);
            }
            $updatenn = Post::where('id_post',$id)->first();
            $updatenn->sp_vi = $req->sp_vi;
            $updatenn->sp_en = $req->sp_en;
            $updatenn->description_vi  = $req->description_vi;
            $updatenn->description_en  = $req->description_en;
            $updatenn->product_slug = $req->slug;


            $updatenn->save();
            return redirect()->route('quanlynn')->with('thongbao', 'Cập nhật thành công');
        }else {
            return redirect()->route('trang-chu');
        }
    }



    public function filter_by_date(Request $req){
        $data = $req->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistical::whereBetween('order_date', [$from_date,$to_date])->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->sales, 
                'profit' => $val->profit, 
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $req){
        $data = $req->all();
        // echo $today = Carbon::now('Asia/Ho_Chi_Minh');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value']=='7ngay') {
            $get = Statistical::whereBetween('order_date', [$sub7ngay,$now])->orderBy('order_date','ASC')->get();

        }elseif ($data['dashboard_value']=='thangtruoc') {
            $get = Statistical::whereBetween('order_date', [$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();

        }elseif ($data['dashboard_value']=='thangnay') {
            $get = Statistical::whereBetween('order_date', [$dauthangnay,$now])->orderBy('order_date','ASC')->get();

        }else{
            $get = Statistical::whereBetween('order_date', [$sub365ngay,$now])->orderBy('order_date','ASC')->get();

        }

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->sales, 
                'profit' => $val->profit, 
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);


    }

    public function days_order(){
        $sub30ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(40)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date', [$sub30ngay,$now])->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->sales, 
                'profit' => $val->profit, 
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    // coupon
    public function getCoupon(Request $req){

        if (Auth::check()) {

            $month_now = Carbon::now('Asia/Ho_Chi_Minh')->month;
            $day_now = Carbon::now('Asia/Ho_Chi_Minh')->day;
            $year_now = Carbon::now('Asia/Ho_Chi_Minh')->year;

            
            $coupon = Coupon::orderBy('coupon_id', 'desc')->get();
            $today =  Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
            $coupon_send_new = Coupon::where('coupon_status', 0)->where('coupon_date_end', '>=', $today)->first();
            $url_canonical = $req->url();
            $sendcou = Coupon::where('coupon_status',0)->get();

            return view('admin.QL_coupon', compact('coupon', 'today', 'coupon_send_new','url_canonical','month_now','day_now','year_now','sendcou'));


        } else {
            return redirect()->route('trang-chu');
        }
    }

    public function AddAdmin_Coupon(Request $req){
        $addcoupon = new Coupon();
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $this->validate($req,
            [
                'coupon_time'=>'required',
                'coupon_number'=>'required',
                'coupon_code'=>'required|unique:coupon,coupon_code',

            ],
            [
                'coupon_time.required'=>'Vui lòng nhập coupon_time',
                'coupon_number.required'=>'Vui lòng nhập coupon_number',
                'coupon_code.required'=>'Vui lòng nhập coupon_code',
                'coupon_code.unique'=>'coupon_code đã tồn tại',
            
            ]);
        }else{
            $this->validate($req,
            [
                'coupon_time'=>'required',
                'coupon_number'=>'required',
                'coupon_code'=>'required|unique:coupon,coupon_code',

            ]);
        }

        $addcoupon->coupon_name  = $req->coupon_name;
        $addcoupon->coupon_qty  = $req->coupon_time;
        $addcoupon->coupon_number  = $req->coupon_number;
        $addcoupon->coupon_code  = $req->coupon_code;
        $addcoupon->coupon_condition  = $req->coupon_condition;
        $addcoupon->coupon_date_start  = $req->coupon_date_start;
        $addcoupon->coupon_date_end  = $req->coupon_date_end;
        $addcoupon->coupon_status  = $req=0;

        $addcoupon->save();
        return redirect()->route('quanlycoupon')->with('thongbao', 'Thêm mới thành công!'); 
    }

    public function DelAdmin_Coupon($id)
    {   
        $delcoupon = Coupon::where('coupon_id', $id)->delete();


        return redirect()->back()->with('thongbao', 'Xóa thành công!');
    }



    public function postUpdate_Coupon(Request $req, $id){
        if (Auth::check()) {
            if(Session::get('locale') == 'vi' || Session::get('locale') == null){
                $this->validate($req,
                [
                    'coupon_time'=>'required',
                    'coupon_number'=>'required',
                    'coupon_code'=>'required',

                ],
                [
                    'coupon_time.required'=>'Vui lòng nhập coupon_time',
                    'coupon_number.required'=>'Vui lòng nhập coupon_number',
                    'coupon_code.required'=>'Vui lòng nhập coupon_code',
                    // 'coupon_code.unique'=>'coupon_code đã tồn tại',
                
                ]);
            }else{
                $this->validate($req,
                [
                    'coupon_time'=>'required',
                    'coupon_number'=>'required',
                    'coupon_code'=>'required',

                ]);
            }
            $update_cp = Coupon::where('coupon_id',$id)->first();
            $update_cp->coupon_name  = $req->coupon_name;
            $update_cp->coupon_qty  = $req->coupon_time;
            $update_cp->coupon_number  = $req->coupon_number;
            $update_cp->coupon_code  = $req->coupon_code;
            $update_cp->coupon_condition  = $req->coupon_condition;
            $update_cp->coupon_date_start  = $req->coupon_date_start;
            $update_cp->coupon_date_end  = $req->coupon_date_end;
            $update_cp->coupon_status  = $req=0;


            $update_cp->save();
            return redirect()->route('quanlycoupon')->with('thongbao', 'Cập nhật -'.$update_cp->coupon_name.'- thành công!');
        }else {
            return redirect()->route('trang-chu');
        }
    }

    public function send_coupon(){
        $user_coupon = User::where('level', 2)->get();
        $today =  Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $coupon_send_new = Coupon::where('coupon_code', request()->code_cou)->first();
        $now_send = date('d-m-Y H:i:s');
        $to_email =  "npn020899@gmail.com";
        $title_mail = "Mã Khuyến Mãi".' '.$now_send;

        $data = [];
        foreach ($user_coupon as $key => $send) {
            $data['email'][] = $send->email;
        }
        $coupon_array =  array(
            'coupon_send_new' => $coupon_send_new, 
        );

        Mail::send('email.send_mail_coupon', ['coupon_array'=>$coupon_array]  ,function($message) use ($title_mail, $data, $to_email){
            $message->to($data['email'])->subject($title_mail);
            $message->from($to_email, $title_mail);
        });

        return redirect()->back()->with('thongbao', 'Gửi mã giảm giá thành công!');
    }

    public function active_coupon($id){
        Coupon::where('coupon_id',$id)->update(['coupon_status'=>0]);
        return redirect()->back();
    }
    public function unactive_coupon($id){
        Coupon::where('coupon_id',$id)->update(['coupon_status'=>1]);
        return redirect()->back();
    }



// -----------------------------------------------------------Excel---------------------------------------------------

    //coupon
    public function export_excel_coupon(){
        return Excel::download(new ExportCoupon , 'coupon.xlsx');
    }
    public function import_excel_coupon(Request $req){

        $file = $req->file('file')->getRealPath();
        $import = new ImportCoupon;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()->with('thongbao', 'Cập nhật thành công!');
    }

    //lang
    public function export_excel_lang(){
        return Excel::download(new ExportPost , 'post.xlsx');
    }
    public function import_excel_lang(Request $req){
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $resuft_tb = trans('home_ad.importexcel', [], 'vi');

        }else{
            $resuft_tb = trans('home_ad.importexcel', [], 'en');
        }        
        $file = $req->file('file')->getRealPath();
        $import = new ImportPost;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return back()->with('thongbao', ''.$resuft_tb.'');
    }

    //slide
    public function export_excel_slide(){
        return Excel::download(new ExportSlide , 'slide.xlsx');
    }
    public function import_excel_slide(Request $req){
        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $resuft_tb = trans('home_ad.importexcel', [], 'vi');

        }else{
            $resuft_tb = trans('home_ad.importexcel', [], 'en');
        }
        $file = $req->file('file')->getRealPath();
        $import = new ImportSlide;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()->with('thongbao', ''.$resuft_tb.'');
    }

    //nsx
    public function export_excel_nsx(){
        return Excel::download(new ExportNsx , 'type_products.xlsx');
    }
    public function import_excel_nsx(Request $req){

        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $resuft_tb = trans('home_ad.importexcel', [], 'vi');

        }else{
            $resuft_tb = trans('home_ad.importexcel', [], 'en');
        }
        $file = $req->file('file')->getRealPath();
        $import = new ImportNsx;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()->with('thongbao', ''.$resuft_tb.'');
    }

    //san pham
    public function export_excel_product(){
        return Excel::download(new ExportProduct , 'products.xlsx');
    }
    // public function import_excel_product(Request $req){
    //     $path = $req->file('file')->getRealPath();
    //     Excel::import(new ImportProduct, $path);
    //     return back()->with('thongbaoupdate', 'Update Successful');
    // }


    //don hang 
    public function export_excel_dh(){
        return Excel::download(new ExportOrder , 'Order.xlsx');
    }
    //don hang da duyet
    public function export_excel_dh_da_duyet(){
        return Excel::download(new ExportOrderApproved , 'OrderApproved.xlsx');
    }
    //don hang chua duyet
    public function export_excel_dh_chua_duyet(){
        return Excel::download(new ExportOrderUnapproved , 'OrderUnapproved.xlsx');
    }
    //don hang huy
    public function export_excel_dh_huy(){
        return Excel::download(new ExportOrderCancel , 'OrderCancel.xlsx');
    }

    // nhap xuat tai khoan
    public function import_account(Request $req){

        if(Session::get('locale') == 'vi' || Session::get('locale') == null){
            $resuft_tb = trans('home_ad.importexcel', [], 'vi');

        }else{
            $resuft_tb = trans('home_ad.importexcel', [], 'en');
        }
        $file = $req->file('file')->getRealPath();
        $import = new ImportAccount;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()->with('thongbao', ''.$resuft_tb.'');
    }
    public function export_excel_all_account(){
        return Excel::download(new ExportAllAccount , 'users.xlsx');
    }
    public function export_admin_account(){
        return Excel::download(new ExportAdminAccount , 'users_admin.xlsx');
    }
    public function export_excel_user_account(){
        return Excel::download(new ExportUserAccount , 'users_user.xlsx');
    }

}
