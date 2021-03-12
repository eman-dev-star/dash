@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
               
                <li><a href="{{route('dashbord.clients.index')}}"><i class="fa fa-dashboard"></i>@lang('site.clients')</a></li>
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
                <form action="{{route('dashbord.clients.update',$client->id)}}" method="post">
                  @CSRF
                  @method('PUT')
                  <div class="form-group">
                  <label>@lang('site.name')</label>
                  <input type="text" class="form-control" name="name" value="{{$client->name}}">
                </div>
                @for($i=0;$i<2;$i++)
                <div class="form-group">
                  <label>@lang('site.phone')</label>
                  <input type="text" class="form-control" name="phone[]" value="{{$client->phone[$i]?? ''}}">
                </div>
                @endfor
              
                <div class="form-group">
                  <label>@lang('site.adress')</label>
                  <textarea class="form-control" name="adress">{{$client->adress}}</textarea>
                </div>
                  
      
                 

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