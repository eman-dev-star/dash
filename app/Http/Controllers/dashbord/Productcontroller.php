<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Validation\Rule;
use Image;
use Storage;
class Productcontroller extends Controller
{
   
    public function index(Request $request)
    {
      $categories=Category::all();

        $products=Product::when($request->search,function($q) use($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%.');
        })->when($request->category_id,function($q) use($request){
           return $q->where('category_id',$request->category_id);
        })->latest()->paginate(2);
        return view('dashbord.products.index',compact('products','categories'));
    }

  
    public function create()
    {
        $categories=Category::all();
        return view('dashbord.products.create',compact('categories'));
        
    }

  
    public function store(Request $request)
    {
        // dd($request->all());
        $rules=['category_id'=>'required'];
        foreach(config('translatable.locales') as $locale){
            $rules +=[$locale.'.name'=>'required'];
            $rules +=[$locale.'.desc'=>'required'];
             }
        $rules +=[
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required'

        ];
        $request->validate($rules);
        $request_data=$request->all();
        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save(public_path('uploads/products/'.$request->image->hashName()));
            $request_data['image']=$request->image->hashName();

        }//end of if
        Product::create($request_data);
        session()->flash('success',__('site.added_successfuly'));
        return redirect()->route('dashbord.products.index');



    }

   public function edit(Product $product)
    {
        $categories=Category::all();

        return view('dashbord.products.edit',compact('categories','product'));
        
    }

   
    public function update(Request $request, Product $product)
    {
        $rules=['category_id'=>'required'];
        foreach(config('translatable.locales') as $locale){
            $rules +=[$locale.'.name'=> ['required', Rule::unique('product_translations', 'name')->ignore($product->id,'product_id')]];
            $rules +=[$locale.'.desc'=>'required'];
             }
        $rules +=[
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required'

        ];
        $request->validate($rules);
        $request_data=$request->all();
        if($request->image){
            if($product->image !== 'one.jpg'){
                Storage::disk('public_upload')->delete('/products/'. $product->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save(public_path('uploads/products/'.$request->image->hashName()));
            $request_data['image']=$request->image->hashName();

        }//end of if
        $product->update($request_data);
        session()->flash('success',__('site.update_successfuly'));
         return redirect()->route('dashbord.products.index');
    }

   
    public function destroy(Product $product)
    {
        if($product->image !== 'one.jpg'){
                Storage::disk('public_upload')->delete('/products/'. $product->image);
            }
            $product->delete();
            
            session()->flash('success',__('site.delete_successfuly'));
         return redirect()->route('dashbord.products.index');
    }
}
