@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div classd="col-sm-12">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-header">
          <h4>Add Product</h4>
        </div>
        <form action="{{ route('product.update',$products->id) }}" method="POST" enctype='multipart/form-data'>
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="title" value="{{ $products->title }}">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" class="form-control inputtags" name="slug" value='{{ $products->slug }}'>
                  </div>

                <div class="form-group">
                    <label>summary</label>
                    <textarea class="form-control" name="summary" cols="30" rows="20">{{ $products->summary}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" cols="30" rows="20">{{ $products->description}}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Stock</label>
                    <input type="number" class="form-control" name="stock" value="{{ $products->stock }}">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="any" class="form-control" name="price" value="{{ $products->price }}">
                  </div>
                  <div class="form-group">
                    <label>Discount</label>
                    <input type="number" step="any"  min="0" max="100" class="form-control" name="discount" value="{{ $products->discount }}">
                  </div>


                  <div class="form-group">
                    <label>Weight</label>
                    <input type="text" class="form-control" name="weight" value="{{ $products->weight }}">
                  </div>
                  <div class="form-group">
                    <label>Photo</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo" value=""{{ $products->photo }}>
                      </div>
                      <div id="holder" style="margin-top:15px;max-height:100px;"></div>
               </div>
               <div class="form-group">
                <label> Brand</label>
                <select class="form-control" name="brand_id">
                  <option>--Select Brand--</option>
                  @foreach ($brands as $brand)
                  <option value='{{ $brand->id }}'>{{ $brand->title}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                  <option>--Select category--</option>
                  @foreach ($categories as $category)
                  <option value='{{ $category->id }}'>{{ $category->title}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Size</label>
                <select class="form-control" name="size">
                  <option>--Select Size--</option>
                  <option value='S' {{ $products->size=='S' ? 'selected': '' }}>Small</option>
                  <option value='L'{{ $products->size=='L' ? 'selected': '' }}>Large</option>
                  <option value='M'{{ $products->size=='M' ? 'selected': '' }}>Medium</option>
                  <option value='XL'{{ $products->size=='XL' ? 'selected': '' }}>ExtraLarge</option>
                </select>
              </div>
            <div class="form-group">
                <label>Condition</label>
                <select class="form-control" name="condition">
                  <option>--conditions--</option>
                  <option value='new' {{ $products->condition=='new' ? 'selected': '' }}>New</option>
                  <option value='used'{{ $products->condition=='used' ? 'selected': '' }}>Used</option>
                  <option value='popular'{{ $products->condition=='popular' ? 'selected': '' }}>Popular</option>
                  <option value='hot'{{ $products->condition=='hot' ? 'selected': '' }}>Hot</option>
                  <option value='winter'{{ $products->condition=='winter' ? 'selected': '' }}>Winter</option>
                </select>
              </div>
              <div class="form-group">
                <label>Vendors</label>
                <select class="form-control" name="vendor_id">
                  <option>--Select Vendor--</option>
                  @foreach (\App\Models\User::where('role','vendor')->get() as $vendor)
                  <option value='{{ $vendor->id }}'>{{ $vendor->name}}</option>
                  @endforeach
                </select>
              </div>
            <div class="form-group">
                <label> Select Status</label>
                <select class="form-control" name="status">
                  <option>--status--</option>
                  <option value='active' {{ $products->status=='active' ? 'selected': '' }}>Active</option>
                  <option value='inactive'{{ $products->status=='inactive' ? 'selected': '' }}>Inactive</option>
                </select>
              </div>
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <button type="submit" class="btn btn-outline-danger">Cancel</button>
              </div>
        </form>

    </div>

  </div>

@endsection

@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endsection
