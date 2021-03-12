@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1><h1>@lang('site.dashboard')</h1></h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashbord.welcome')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            </ol>
        </section>

        <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        
                {{-- categories--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $categories_count }}</h3>

                            <p>@lang('site.categories')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('dashbord.categories.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--products--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $products_count }}</h3>

                            <p>@lang('site.products')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('dashbord.products.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--clients--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $clients_count }}</h3>

                            <p>@lang('site.clients')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="{{ route('dashbord.clients.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--users--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $users_count }}</h3>

                            <p>@lang('site.users')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('dashbord.user.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
      </div><!--end row-->
      <div class="box box-solid">

                <div class="box-header">
                    <h3 class="box-title">Sales Graph</h3>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
      </div><!--end containe fluid-->
</section><!-- end of content -->
</div><!-- end of content wrapper -->

@endsection
@push('scripts')
<script type="text/javascript">
  var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [
    @foreach($orders as $order)
      { ym : '{{$order->month}} - {{$order->year}}', total_price: '{{$order->total_price}}' }
   @endforeach
    ],
    xkey             : 'ym',
    ykeys            : ['total_price'],
    labels           : ['@lang('site.total')'],
    lineColors       : ['red'],
    lineWidth        : 5,
    hideHover        : 'auto',
    gridTextColor    : 'green',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['yellow'],
    gridLineColor    : 'yellow',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
    </script>
@endpush