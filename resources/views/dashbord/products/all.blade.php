 <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                @include('partials._error')
                <form action="{{route('dashbord.products.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  <div class="form-group">
                  <label>@lang('site.categories')</label>
                  <select name="category_id" class="form-control">
                     <option value="">@lang('site.allcat')</option>

                     @foreach($categories as $category)
                     <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                     @endforeach
                  </select>
                   </div>
                  @foreach(config('translatable.locales') as $locale)
                <div class="form-group">
                  <!-- site.ar.name -->
                  <label>@lang('site.'.$locale.'.name')</label>
                  <!-- ar[name] -->
                  <input type="text" class="form-control" name="{{$locale}}[name]" value="{{old($locale.'.name')}}">
                </div>
                 <div class="form-group">
                  <label>@lang('site.'.$locale.'.desc')</label>
                  <!-- ar[name] -->
                  <textarea  class="form-control ckeditor" name="{{$locale}}[desc]">{{old($locale.'.desc')}}</textarea>
                </div>
                @endforeach
                 <div class="form-group">
                  <label>@lang('site.image')</label>
                  <input type="file" class="form-control image" name="image">
                </div>
                 <div class="form-group">
                  <img src="{{asset('uploads/products/one.png')}}" width="100px" class="img-thubnail img-preview">
                </div>
                <div class="form-group">
                  <label>@lang('site.purchase_price')</label>
                  <input type="number" class="form-control" name="purchase_price" value="{{old('purchase_price')}}">
                </div>
                <div class="form-group">
                  <label>@lang('site.sale_price')</label>
                  <input type="number" class="form-control" name="sale_price" value="{{old('sale_price')}}">
                </div>
                <div class="form-group">
                  <label>@lang('site.stock')</label>
                  <input type="number" class="form-control" name="stock" value="{{old('stock')}}">
                </div>
            
      
                 

              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
              </div>
              </form>
              </div>
              <!-- /.box-body -->

    
          </div>
          <!-- /.box -->