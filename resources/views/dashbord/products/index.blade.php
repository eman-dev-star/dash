@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="{{route('dashbord.products.index')}}">@lang('site.products')</li>

            </ol>
        </section>

      
        <section class="content">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products')<small>{{$products->total()}}</small></h3>
              <form action="{{route('dashbord.products.index')}}" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                    </div>
                     <div class="col-md-4">
                     <select name="category_id" class="form-control">
                      <option>@lang('site.allcat')</option>
                     @foreach($categories as $category)
                     <option value="{{$category->id}}" {{request()->category_id == $category->id?' selected':''}}>{{$category->name}}</option>
                     @endforeach
                   </select>
                    </div>
                      <div class="col-md-4">
                         <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> @lang('site.search')</button>
                          @if(auth()->user()->hasPermission('create_products'))
                         <a href="{{route('dashbord.products.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>@lang('site.add')</a>
                          @else
                         <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus" aria-hidden="true"></i>@lang('site.add')</a>
                         @endif
                    </div>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
                @if($products->count() >0)
                 <table class="table table-hover">
                  <thead>
                <tr>
                  <th style="width: 10px">#</th>
          
                  <th>@lang('site.name')</th>
                  <th>@lang('site.desc')</th>
                  <th>@lang('site.category')</th>

                  <th>@lang('site.image')</th>
                  <th>@lang('site.purchase_price')</th>
                  <th>@lang('site.sale_price')</th>
                  <th>@lang('site.profit_percent') %</th>

                  <th>@lang('site.stock')</th>
                  <td>@lang('site.action')</td>
                </tr>
                  </thead>
              <tbody>
                @foreach($products as $index=>$product)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$product->name}}</td>
                  <td>{{$product->desc}}</td>
                  <td>{{$product->category->name}}</td>

                  <td><img src="{{$product->image_path}}" width="100px" class="img-thumbnail"></td>

                  <td>{{$product->purchase_price}}</td>
                  <td>{{$product->sale_price}}</td>
                  <td>{{$product->profit_percent}} %</td>

                  <td>{{$product->stock}}</td>
                  <td>
                       @if(auth()->user()->hasPermission('update_products'))
                      <a href="{{route('dashbord.products.edit',$product->id)}}" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>
                       @lang('site.edit')</a>
                        @else
                        <button class="btn btn-success btn-sm" disabled><i class="fa fa-pencil" aria-hidden="true"></i>  @lang('site.edit')</button>
                       @endif
                       @if(auth()->user()->hasPermission('delete_products'))
                      <form  action="{{route('dashbord.products.destroy',$product->id)}}" method="post" style="display: inline-block;">
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
              {{$products->appends(request()->query())->links()}}
              <!-- box-body -->

          </div>
          <!-- box -->

        

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection