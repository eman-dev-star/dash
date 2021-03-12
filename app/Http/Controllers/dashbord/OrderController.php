<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    public function index(Request $request)
    {
    	 $orders=Order::whereHas('client',function($q) use($request){
            return $q->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(3);
        return view('dashbord.orders.index',compact('orders'));
    	// $orders=Order::paginate(3);
     //    return view('dashbord.orders.index',compact('orders'));
    }//end of index
    public function products(Order $order){
    	$products=$order->products;
    	// dd($products);
        return view('dashbord.orders._products',compact('products','order'));

    }//end of products

    public function destroy(Order $order){
        foreach($order->products as $product){
            $product->update([
                'stock'=>$product->stock+$product->pivot->quantity
            ]);
        }
        // dd('done');
        $order->delete();
        session()->flash('success',__('site.delete_successfuly'));
         return redirect()->route('dashbord.orders.index');
      }//end of destroy

}
