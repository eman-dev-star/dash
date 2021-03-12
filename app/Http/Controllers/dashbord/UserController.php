<?php

namespace App\Http\Controllers\Dashbord;

use App\Http\Controllers\Controller;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Image;
use Storage;
use Auth;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:delete_users'])->only('destroy');


    }    
    public function index(Request $request)
    {
        $users=User::whereRoleIs('admin')->where(function($q) use ($request){
            return $q->when($request->search,function($q) use($request){
                return $q->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%');
                 });
        })->latest()->paginate('2');
    
       //  if($request->search){
       //      $users=User::where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->get();
       //  }else{
       // $users=User::whereRoleIs('admin')->get();
       // }
       return view('dashbord.user.index',compact('users'));
    }

   
    public function create()
    {
        return view('dashbord.user.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|unique:users',
            'image'=>'image',
            'password'=>'required|confirmed',
            'permissions'=>'required|min:1'


        ]);
        $request_data=$request->except(['password','password_confirmation','permissions','image']);
        $request_data['password']=bcrypt($request->password);
        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save(public_path('uploads/users/'.$request->image->hashName()));
            $request_data['image']=$request->image->hashName();

        }//end of if

        $user=User::create($request_data);
        $user->AttachRole('admin');
        $user->syncPermissions($request->permissions);
        session()->flash('success',__('site.added_successfuly'));
        return redirect()->route('dashbord.user.index');
    }




    public function edit(user $user)
    {
        return view('dashbord.user.edit',compact('user'));
        
    }

   
    public function update(Request $request, user $user)
    {
         $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required', Rule::unique('users')->ignore($user->id),],
            'image'=>'image',
            'permissions'=>'required|min:1'

        ]);
        $request_data=$request->except(['permissions','image']);
        if($request->image){
            if($user->image !='one.png'){
             Storage::disk('public_upload')->delete('/users/'.$user->image);
             }
            Image::make($request->image)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
            })->save(public_path('uploads/users/'.$request->image->hashName()));
            $request_data['image']=$request->image->hashName();

        }//end of if
        $user->update($request_data);
        $user->syncPermissions($request->permissions);
         session()->flash('success',__('site.update_successfuly'));
         return redirect()->route('dashbord.user.index');
    }

    public function destroy(user $user)
    {
        if($user->image !='one.png'){
            Storage::disk('public_upload')->delete('/users/'.$user->image);

        }//end if
        $user->delete();
         session()->flash('success',__('site.delete_successfuly'));
         return redirect()->route('dashbord.user.index');
    }
}
