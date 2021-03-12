@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
               
                <li><a href="{{route('dashbord.user.index')}}"><i class="fa fa-dashboard"></i>@lang('site.users')</a></li>
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
                <form action="{{route('dashbord.user.update',$user->id)}}" method="post" enctype="multipart/form-data">
                  @CSRF
                  @method('PUT')
                <div class="form-group">
                  <label>@lang('site.first_name')</label>
                  <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                </div>
                   <div class="form-group">
                  <label>@lang('site.last_name')</label>
                  <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                </div>
                   <div class="form-group">
                  <label>@lang('site.email')</label>
                  <input type="email" class="form-control" name="email" value="{{$user->email}}">
                </div>
                  <div class="form-group">
                  <label>@lang('site.image')</label>
                  <input type="file" class="form-control image" name="image">
                </div>
                 <div class="form-group">
                  <img src="{{$user->image_path}}" width="100px" class="img-thubnail img-preview">
                </div>
                <div class="form-group">
                   <label >@lang('site.permissions')</label>
                   <div class="nav-tabs-custom">
                      <?php
                         $models=['users','categories','products','clients','orders'];
                         $maps=['create','read','update','delete']
                      ?>
                     <ul class="nav nav-tabs">
                      @foreach($models as $index=>$model)
                     <li class="$index==0?active:''"><a href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>
                     @endforeach
                    </ul>
                <div class="tab-content">
                @foreach($models as $index=>$model)
                 <div class="tab-pane {{$index==0?'active':''}}" id="{{$model}}">
                  @foreach($maps as $map)
                  <label><input type="checkbox" name="permissions[]" {{$user->hasPermission($map.'_'.$model) ? 'checked':''}} value="{{$map.'_'.$model}}">@lang('site.'.$map)</label>
                  @endforeach
                </div>
                @endforeach
               </div><!--end of tab content-->
               </div><!--end of tab tab-->
               </div><!--end of form group-->
                 

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</button>
              </div>
              </form>
              </div>
              <!-- /.box-body -->

    
          </div>
          <!-- /.box -->

        

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection