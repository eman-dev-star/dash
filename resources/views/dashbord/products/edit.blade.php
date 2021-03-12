@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
               
                <li><a href="{{route('dashbord.products.index')}}"><i class="fa fa-dashboard"></i>@lang('site.products')</a></li>
                <li class="active">@lang('site.edit')</li>


            </ol>
        </section>

        <section class="content">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('site.edit')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                @include('partials._error')
                <form action="{{route('dashbord.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                  <label>@lang('site.categories')</label>
                  <select name="category_id" class="form-control">
                     <option value="">@lang('site.allcat')</option>

                     @foreach($categories as $category)
                     <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                     @endforeach
                  </select>
                  @foreach(config('translatable.locales') as $locale)
                <div class="form-group">
                  <!-- site.ar.name -->
                  <label>@lang('site.'.$locale.'.name')</label>
                  <!-- ar[name] -->
                  <input type="text" class="form-control" name="{{$locale}}[name]" value="{{$product->name}}">
                </div>
                 <!-- site.ar.name -->
                  <label>@lang('site.'.$locale.'.desc')</label>
                  <!-- ar[name] -->
                  <textarea  class="form-control ckeditor" name="{{$locale}}[desc]">{{$product->desc}}</textarea>
                </div>
                @endforeach
                 <div class="form-group">
                  <label>@lang('site.image')</label>
                  <input type="file" class="form-control image" name="image">
                </div>
                 <div class="form-group">
                  <img src="{{$product->image_path}}" width="100px" class="img-thubnail img-preview">
                </div>
                <div class="form-group">
                  <label>@lang('site.purchase_price')</label>
                  <input type="number" class="form-control" name="purchase_price" value="{{$product->purchase_price}}" step="0.01">
                </div>
                <div class="form-group">
                  <label>@lang('site.sale_price')</label>
                  <input type="number" step="0.01" class="form-control" name="sale_price" value="{{$product->sale_price}}">
                </div>
                <div class="form-group">
                  <label>@lang('site.stock')</label>
                  <input type="number" class="form-control" name="stock" value="{{$product->stock}}">
                </div>
            
      
                 

              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
              </div>
              </form>
              </div>
              <!-- /.box-body -->

    
          </div>
          <!-- /.box -->

        

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection