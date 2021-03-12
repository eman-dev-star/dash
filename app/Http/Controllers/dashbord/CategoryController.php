<?php

namespace App\Http\Controllers\dashbord;
use Illuminate\Validation\Rule;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index(Request $request)
    {
        $categories=Category::when($request->search,function($q) use ($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%');

        })->latest()->paginate('3');
        return view('dashbord.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('dashbord.categories.create');
    }

   
    public function store(Request $request)
    {
        $rules=[];
        foreach(config('translatable.locales') as $locale){
            // name en ar required and  name en ar uniqed
            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];
        }
        $data=$request->validate($rules);

        // $data=$request->validate(['name'=>'required|unique:categories,name']);
        // $data=$request->validate(['ar.name'=>'required|unique:category_translations,name','en.*'=>'required']);

        $category=Category::create($data);
        session()->flash('success',__('site.added_successfuly'));
        return redirect()->route('dashbord.categories.index');
    }



   
    public function edit(Category $category)
    {
        return view('dashbord.categories.edit',compact('category'));
    }

   
    public function update(Request $request, Category $category)
    {
         $rules=[];
        foreach(config('translatable.locales') as $locale){
            // name en ar required and  name en ar uniqed
            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id,'category_id')]];
        }
        $data=$request->validate($rules);
        // $data=$request->validate(['ar.name'=>'required|unique:category_translations,name','en.*'=>'required']);

         // $data=$request->validate(['name'=>'required|unique:categories,name,'.$category->id,]);
        $category->update($data);
        session()->flash('success',__('site.update_successfuly'));
        return redirect()->route('dashbord.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
         session()->flash('success',__('site.delete_successfuly'));
         return redirect()->route('dashbord.categories.index');
    }
}
