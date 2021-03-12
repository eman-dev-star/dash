@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="{{route('dashbord.clients.index')}}">@lang('site.clients')</li>

            </ol>
        </section>

      
        <section class="content">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-bottom: 15px">@lang('site.clients')<small>{{$clients->total()}}</small></h3>
              <form action="{{route('dashbord.clients.index')}}" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                    </div>
                      <div class="col-md-4">
                         <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> @lang('site.search')</button>
                          @if(auth()->user()->hasPermission('create_clients'))
                         <a href="{{route('dashbord.clients.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>@lang('site.add')</a>
                          @else
                         <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus" aria-hidden="true"></i>@lang('site.add')</a>
                         @endif
                    </div>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
                @if($clients->count() >0)
                 <table class="table table-hover">
                  <thead>
                <tr>
                  <th style="width: 10px">#</th>
          
                  <th>@lang('site.name')</th>
                  <th>@lang('site.phone')</th>
                  <th>@lang('site.adress')</th>
                  <th>@lang('site.add_order')</th>


                  <td>@lang('site.action')</td>
              
                </tr>
                  </thead>
              <tbody>
                @foreach($clients as $index=>$client)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$client->name}}</td>
                  <td>{{is_array($client->phone)?implode($client->phone,'-'):$client->phone}}</td>

                  <td>{{$client->adress}}</td>
                  <td>
                    @if(auth()->user()->hasPermission('create_orders'))
                      <a href="{{route('dashbord.clients.orders.create',$client->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>
                       @lang('site.add_order')</a>
                        @else
                        <button class="btn btn-primary btn-sm" disabled><i class="fa fa-plus" aria-hidden="true"></i> @lang('site.add_order')</button>
                       @endif
                     </td>
                       <td>
                       @if(auth()->user()->hasPermission('update_clients'))
                      <a href="{{route('dashbord.clients.edit',$client->id)}}" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>
                       @lang('site.edit')</a>
                        @else
                        <button class="btn btn-success btn-sm" disabled><i class="fa fa-pencil" aria-hidden="true"></i>  @lang('site.edit')</button>
                       @endif
                       @if(auth()->user()->hasPermission('delete_clients'))
                      <form  action="{{route('dashbord.clients.destroy',$client->id)}}" method="post" style="display: inline-block;">
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
              {{$clients->appends(request()->query())->links()}}
              <!-- box-body -->

          </div>
          <!-- box -->

        

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection