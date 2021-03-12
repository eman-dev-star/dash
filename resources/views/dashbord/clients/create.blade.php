@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
               
                <li><a href="{{route('dashbord.clients.index')}}"><i class="fa fa-dashboard"></i>@lang('site.clients')</a></li>
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
                <form action="{{route('dashbord.clients.store')}}" method="post" enctype="multipart/form-data">
                  @CSRF
                  @method('POST')
                   <div class="form-group">
                  <label>@lang('site.name')</label>
                  <input type="text" class="form-control" name="name" value="{{old('name')}}">
                </div>
                @for($i=0;$i<2;$i++)
                <div class="form-group">
                  <label>@lang('site.phone')</label>
                  <input type="text" class="form-control" name="phone[]" value="{{old('phone')}}">
                </div>
                @endfor
              
                <div class="form-group">
                  <label>@lang('site.adress')</label>
                  <textarea class="form-control" name="adress">{{old('adress')}}</textarea>
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