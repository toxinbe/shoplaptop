<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\User;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Bill;
use App\Models\Cart;
use App\Models\Post;
use App\Models\Visitors;
use Session;
use Auth;
use Carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //cart
        view()->composer('*',function($view){
            if(Session('cart')){
                if (Auth::check()) {
                    $oldCart = Session::get('cart');
                    $cart = new Cart($oldCart);
                }elseif(Session::get('user_name_login')){
                    $oldCart = Session::get('cart');
                    $cart = new Cart($oldCart);
                }


                $view->with(['cart'=>Session::get('cart'), 'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty, 'coupon'=>Session::get('coupon') ]);
            }
        });

        //lang
        view()->composer('*',function($view){
               if(Session::has('locale')){
                    app()->setLocale(Session::get('locale'));
                }
                $posts = Post::get();
                $multisp = 'sp_' . app()->getLocale();
                $multi_description = 'description_' . app()->getLocale();


                $loai_sanpham = ProductType::all();
                $all_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->get();

                $url_canonical = Request()->url();


                $min_price = Product::min('unit_price');
                $max_price = Product::max('unit_price');

                $max_price_range = $max_price + 5000000;
                $min_price_range = $min_price + 2000000;


                $view->with(['posts'=>$posts, 'multisp'=>$multisp, 'multi_description'=>$multi_description, 'all_product'=>$all_product, 'loai_sanpham'=>$loai_sanpham, 'min_price'=>$min_price, 'max_price'=>$max_price, 'max_price_range'=>$max_price_range, 'min_price_range'=>$min_price_range, 'url_canonical'=>$url_canonical ]);
        });

        // admin
        view()->composer('*',function($view){
               
                $loai_count = ProductType::all()->count();
                $sp_count = Product::all()->count();
                $nd_count = User::all()->count();
                $dh_count = Bill::all()->count();
                $posts_count = Post::all()->count();
                $slide_count = Slide::all()->count();
                $dh_count_chuaduyet = Bill::where('status_bill', 0)->count();
                $dh_count_huy = Bill::where('status_bill', 2)->count();

                $user_ip_address = Request()->ip();
                //online hien tai
                $visitor_current = Visitors::where('ip_address', $user_ip_address)->get();
                $visitor_count = $visitor_current->count();

                if ($visitor_count<1) {
                    $visitor = new Visitors();
                    $visitor->ip_address = $user_ip_address;
                    $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                    $visitor->save();
                }


                // $now = Carbon::now('Asia/Ho_Chi_Minh');
                $now = date('d-m-Y H:i:s');
                
                $view->with(
                    [   
                        'now'=>$now,
                        'loai_count'=>$loai_count,
                        'sp_count'=>$sp_count,
                        'nd_count'=>$nd_count,
                        'dh_count'=>$dh_count,
                        'posts_count'=>$posts_count,
                        'slide_count'=>$slide_count,
                        'dh_count_chuaduyet'=>$dh_count_chuaduyet,
                        'dh_count_huy'=>$dh_count_huy,
                        'visitor_count'=>$visitor_count,
                    ]);

                

        });
        
    }
}
