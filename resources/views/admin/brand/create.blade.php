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
          <h4>Add Brand</h4>
        </div>
        <form action="{{ route('brand.store') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="card-body">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                  <label>Slug</label>
                  <input type="text" class="form-control inputtags" name="slug" value='{{ old('slug') }}'>
                </div>

                <div class="form-group">
                    <label>Photo</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                          </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo">
                      </div>
                      <div id="holder" style="margin-top:15px;max-height:100px;"></div>
               </div>

            <div class="form-group">
                <label> Select Status</label>
                <select class="form-control" name="status">
                  <option>--status--</option>
                  <option value='active' {{ old('status')=='active' ? 'selected': '' }}>Active</option>
                  <option value='inactive'{{ old('status')=='inactive' ? 'selected': '' }}>Inactive</option>
                </select>
              </div>
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Create</button>
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
