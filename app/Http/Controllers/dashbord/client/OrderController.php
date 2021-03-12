<?php

namespace App\Http\Controllers\dashbord\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\Order;
use App\Product;
use App\Category;
class OrderController extends Controller
{

    public function create(Client $client)
    {
        $categories=Category::with('products')->get();
        $orders=$client->orders()->with('products')->paginate('5');
        return view('dashbord.clients.orders.create',compact('categories','client','orders'));
    }

    
    public function store(Request $request,Client $client)
    {
        // dd($request->all());
        $request->validate([
            'product'=>'required|array',
        ]);
        $this->attach_order($request,$client);
        session()->flash('success',__('site.added_successfuly'));
        return redirect()->route('dashbord.orders.index');
    }//end of store


    public function edit(Client $client,Order $order)
    {
        $categories=Category::with('products')->get();
        $orders=$client->orders()->with('products')->paginate('5');


        return view('dashbord.clients.orders.edit',compact('client','order','categories','orders'));
        
    }

    public function update(Request $request,Client $client,Order $order)
    {
          $request->validate([
            'product'=>'required|array',
        ]);
          $this->detach_order($order);
         
          $this->attach_order($request,$client);
         session()->flash('success',__('site.update_successfuly'));
        return redirect()->route('dashbord.orders.index');
    }

   private function attach_order($request,$client){
      $order=$client->orders()->create([]);
        $order->products()->attach($request->product);
        $total_price=0;
        foreach($request->product as $id=>$quantity){
            // dd($quantity);
            $product=Product::findOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];
            $product->update(['stock'=>$product->stock - $quantity['quantity']]);
        }
        $order->update(['total_price'=>$total_price]);

   }//end of attach_order
   private function detach_order($order){
     foreach($order->products as $product){
            $product->update([
                'stock'=>$product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
   }//end of detach_order
    
}
