<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Client;

use App\Product;
use App\Category;
use DB;
class WelcomeController extends Controller
{
    public function index(){
    	$categories_count=Category::count();
    	$products_count=Product::count();
    	$clients_count=Client::count();
    	$orders_count=Order::count();
        $users_count=User::whereRoleIs('admin')->count();
    	$orders=Order::select(
    		DB::raw("YEAR(created_at) as year"),
    		DB::raw("MONTH(created_at) as month"),
    		DB::raw("SUM(total_price) as total_price"),
    	)->groupBy('month')->get();
    	
    	return view('dashbord.welcome',compact('users_count','categories_count','orders_count','products_count','clients_count','orders'));
    }//end of index
}
