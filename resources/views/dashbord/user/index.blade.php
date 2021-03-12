@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
                <li class="{{route('dashbord.user.index')}}">@lang('site.users')</li>

            </ol>
        </section>

      
        <section class="content">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-bottom: 15px">@lang('site.users')<small>{{$users->total()}}</small></h3>
              <form action="{{route('dashbord.user.index')}}" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                    </div>
                      <div class="col-md-4">
                         <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> @lang('site.search')</button>
                          @if(auth()->user()->hasPermission('create_users'))
                         <a href="{{route('dashbord.user.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>@lang('site.add')</a>
                          @else
                         <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus" aria-hidden="true"></i>@lang('site.add')</a>
                         @endif
                    </div>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
                @if($users->count() >0)
                 <table class="table table-hover">
                  <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>@lang('site.first_name')</th>
                  <th>@lang('site.last_name')</th>
                  <th>@lang('site.email')</th>
                  <th>@lang('site.image')</th>

                    <td>@lang('site.action')</td>
                </tr>
                  </thead>
              <tbody>
                @foreach($users as $index=>$user)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$user->first_name}}</td>
                  <td>{{$user->last_name}}</td>
                  <td>{{$user->email}}</td>
                  <td><img src="{{$user->image_path}}" width="100px" class="img-thumbnail"></td>
                


                  <td>
                       @if(auth()->user()->hasPermission('update_users'))
                      <a href="{{route('dashbord.user.edit',$user->id)}}" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>
                       @lang('site.edit')</a>
                        @else
                        <button class="btn btn-success btn-sm" disabled><i class="fa fa-pencil" aria-hidden="true"></i>  @lang('site.edit')</button>
                       @endif
                       @if(auth()->user()->hasPermission('delete_users'))
                      <form  action="{{route('dashbord.user.destroy',$user->id)}}" method="post" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> @lang('site.delete')</button>
                    </form>
                    @else
                    <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash-o" aria-hidden="true"></i> @lang('site.delete')</button>

                    @endif
                     

                  
                  </td>
                </tr>
                @endforeach
            </tbody>
              
              </table>
              @else
              <h3>@lang('site.no_data_found')</h3>

              @endif
            
              </div>
              {{$users->appends(request()->query())->links()}}
              <!-- box-body -->

          </div>
          <!-- box -->

        

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection