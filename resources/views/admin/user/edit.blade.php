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
          <h4>Add User</h4>
        </div>
        <form action="{{ route('user.update',$users->id) }}" method="POST" enctype='multipart/form-data'>
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $users->name }}">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control inputtags" name="username" value='{{ $users->username }}'>
                </div>

                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control inputtags" name="phone" value='{{ $users->phone }}'>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control inputtags" name="address" value='{{ $users->address }}'>
                  </div>
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" class="form-control inputtags" name="email" value='{{ $users->email }}'>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control inputtags" name="password" value='{{ $users->password }}'>
                  </div>
                  <div class="form-group">
                    <label>Role<span class="text-danger">*</span></label>
                    <select class="form-control" name="role">
                      <option>--Role--</option>
                      <option value='admin' {{ $users->role=='admin' ? 'selected': '' }}>Admin</option>
                      <option value='vendor'{{ $users->role=='vendor' ? 'selected': '' }}>vendor</option>
                      <option value='customer'{{$users->role=='customer' ? 'selected': '' }}>Customer</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option>--Select status--</option>
                      <option value='active' {{ $users->status=='active' ? 'selected': '' }}>Active</option>
                      <option value='inactive'{{ $users->status=='inactive' ? 'selected': '' }}>Inactive</option>
                    </select>
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
