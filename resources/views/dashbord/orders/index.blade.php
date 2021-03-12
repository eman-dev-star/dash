@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.categories')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
                <li class="{{route('dashbord.categories.index')}}">@lang('site.categories')</li>

            </ol>
        </section>

      
        <section class="content">
             <div class="row">

                <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-bottom: 15px">@lang('site.orders')<small>{{$orders->total()}}</small></h3>
              <form action="{{route('dashbord.orders.index')}}" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                    </div>
                      <div class="col-md-4">
                         <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> @lang('site.search')</button>
                    </div>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
                @if($orders->count() >0)
                 <table class="table table-hover">
                  <thead>
                <tr>
                 
          
                  <th>@lang('site.client_name')</th>
                  <th>@lang('site.price')</th>
                  <th>@lang('site.created_at')</th>

                  <!-- <th>@lang('site.status')</th> -->


                  <td>@lang('site.action')</td>
              
                </tr>
                  </thead>
              <tbody>
                @foreach($orders as $index=>$order)
                <tr>
                  <td>{{$order->client->name}}</td>
                   <td>{{number_format($order->total_price,2)}}</td>
                  <td>{{$order->created_at->toFormattedDateString()}}</td>

                 
                


            
                


                  <td>
                     <button class="btn btn-primary btn-sm order-products" data-url="{{route('dashbord.orders.products',$order->id)}}" data-method="get"><i class="fa fa-list" aria-hidden="true"></i>  @lang('site.show')</button>
                       @if(auth()->user()->hasPermission('update_orders'))
                      <a href="{{route('dashbord.clients.orders.edit',['client'=>$order->client->id,'order'=>$order->id])}}" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>
                       @lang('site.edit')</a>
                        @else
                        <button class="btn btn-success btn-sm" disabled><i class="fa fa-pencil" aria-hidden="true"></i>  @lang('site.edit')</button>
                       @endif
                       @if(auth()->user()->hasPermission('delete_orders'))
                      <form  action="{{route('dashbord.orders.destroy',$order->id)}}" method="post" style="display: inline-block;">
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
              {{$orders->appends(request()->query())->links()}}
          </div>
              @else
              <h3>@lang('site.no_data_found')</h3>

              @endif
                </div><!-- end of box -->

                </div><!-- end of col -->
                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.show_products')</h3>
                        </div><!-- end of box header -->

                        <div class="box-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">@lang('site.loading')</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->
            
              </div>
              
              <!-- box-body -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection