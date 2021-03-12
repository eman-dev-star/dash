<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
class Clientcotroller extends Controller
{
    public function index(Request $request){
    	$clients=Client::when($request->search,function($q) use($request){
    		return $q->where('name','like','%'.$request->search.'%')->orWhere('phone','like','%'.$request->search.'%')->orWhere('adress','like','%'.$request->search.'%');
    	})->latest()->paginate(2);
    	return view('dashbord.clients.index',compact('clients'));
    }
      public function create(){

    	return view('dashbord.clients.create');
    }
     public function store(Request $request){
     	$request->validate([
     		'name'=>'required',
     		'phone'=>'required|array|min:1',
     		'phone.0'=>'required',

     		'adress'=>'required',

     	]);
     	$request_date=$request->all();
     	$request_date['phone']=array_filter($request->phone);
     	Client::create($request_date);
     	session()->flash('success',__('site.added_successfuly'));
     	return redirect()->route('dashbord.clients.index');

    
    }
     public function edit(Client $client){

    	return view('dashbord.clients.edit',compact('client'));
    }
     public function update(Request $request,Client $client){

    	$request->validate([
     		'name'=>'required',
     		'phone'=>'required|array|min:1',
     		'phone.0'=>'required',

     		'adress'=>'required',

     	]);
     	$request_date=$request->all();
     	$request_date['phone']=array_filter($request->phone);
     	$client->update($request_date);
        session()->flash('success',__('site.update_successfuly'));
        return redirect()->route('dashbord.clients.index');
    }
     public function destroy(Client $client){
     	$client->delete();
     	session()->flash('success',__('site.delete_successfuly'));
         return redirect()->route('dashbord.clients.index');

    	
    }
}
