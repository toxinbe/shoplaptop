<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Customer;
use App\Models\User;

use Session;
use Hash;
use Auth;
use DB;
use Mail;
class passController extends Controller
{
    //
    public function quen_mat_khau(Request $req){
	    if(Session::has('locale')){
	    	app()->setLocale(Session::get('locale'));
	    }
	    $posts = Post::get();
	    $multisp = 'sp_' . app()->getLocale();
        $url_canonical = $req->url();
        $image_og =  $req->url();


	    return view('Reset.ForgotPassword',compact('posts', 'multisp', 'url_canonical', 'image_og'));
    }

    public function recover_pass(Request $req){
        $data = $req->all();
        $now = date('Y-m-d');

        $tile_mail = "Lấy lại mật khẩu ShopPV".' '.$now;
        $user = User::where('email', '=', $data['email_account'])->get();
        foreach ($user as $key => $value) {
            $user_id = $value->id;
        }

        if ($user) {
            $count_user = $user->count();
            if ($count_user==0) {
                return redirect()->back()->with('error', 'Email chưa được đăng ký');
            }else{
                $token_random = Str::random();
                $user = User::find($user_id);
                $user->user_token = $token_random;
                $user->save();

                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array('name' =>$tile_mail, "body" =>$link_reset_pass, 'email' =>$data['email_account']);

                Mail::send('Reset.forget_pass_notify', ['data'=>$data] ,function($message) use ($tile_mail, $data){
                    $message->to($data['email'])->subject($tile_mail);
                    $message->from($data['email'],$tile_mail);
                });


                return redirect()->back()->with('message', 'Gửi email thành công, vui lòng check email');
            }
        }

    }
    public function getupdate_new_pass(Request $req){
        if(Session::has('locale')){
            app()->setLocale(Session::get('locale'));
        }
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();
        $url_canonical = $req->url();
        $image_og =  $req->url();


        return view('Reset.NewPassword',compact('posts', 'multisp', 'url_canonical', 'image_og'));
    }
    public function postupdate_new_pass(Request $req){
        $data = $req->all();
        $token_random = Str::random();
        $user_up = User::where('email', '=', $data['email'])->where('user_token', '=', $data['token'])->get();
        $count_user = $user_up->count();

        if ($count_user>0) {
            foreach ($user_up as $key => $cus) {
                $user_id = $cus->id;
            }
            $reset = User::find($user_id);
            $reset->password = Hash::make($data['password_account']);
            $reset->user_token = $token_random;
            $reset->save();

            return redirect()->route('trang-chu')->with('message', 'Mật khẩu đã cập nhật mới');
        }else{
            return redirect('quen-mat-khau')->with('error', 'Vui lòng nhập lại email vì link quá hạn');
        }

    }


}
