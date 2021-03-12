@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
               
                <li><a href="{{route('dashbord.categories.index')}}"><i class="fa fa-dashboard"></i>@lang('site.categories')</a></li>
                <li class="active">@lang('site.add')</li>


            </ol>
        </section>

        <section class="content">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                @include('partials._error')
                <form action="{{route('dashbord.categories.update',$category->id)}}" method="post">
                  @CSRF
                  @method('PUT')
                 @foreach(config('translatable.locales') as $locale)
                <div class="form-group">
                  <!-- site.ar.name -->
                  <label>@lang('site.'.$locale.'.name')</label>
                  <!-- ar[name] -->
                  <input type="text" class="form-control" name="{{$locale}}[name]" value="{{$category->translate($locale)->name}}">
                </div>
                @endforeach
                  
      
                 

              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>@lang('site.edit')</button>
              </div>
              </form>
              </div>
              <!-- /.box-body -->

    
          </div>
          <!-- /.box -->

        

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection