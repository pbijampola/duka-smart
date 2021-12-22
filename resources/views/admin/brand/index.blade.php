@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
      <div class="card">

        <div class="card-body">
          <div class="section-title mt-0">All Brand</div>
          <div>
            <a href="{{ route('brand.create') }}" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i>Add New Brand</a>
          </div>
          <p class="float-right">
             Total Number of Brands <span class="badge badge-primary">{{ $brands->count() }}</span>
          </p>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Photo</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $brands as $key => $brand )
             <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $brand->title }}</td>
                <td><img src="{{$brand->photo }}" alt="{{ $brand->title }}" style="max-height: 90px; max-width:120px"></td>

                <td>

                  @if ( $brand->status == 'active' )
                    <span class="badge badge-success">{{ $brand->status }}</span>
                  @else
                    <span class="badge badge-danger">{{ $brand->status }}</span>
                  @endif
                </td>
                <td>
                    <div class="d-flex">
                        <div>
                            <a href="{{ route('brand.edit',$brand->id) }}"  data-toggle="tooltip" title="Edit" data-placement="bottom" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>

                        </div>
                        <div>
                            <form action="{{ route('brand.destroy',$brand->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-toggle="tooltip" title="Delete" data-placement="bottom" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </td>
             </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>

  </div>


@endsection

@section('scripts')

<script>
    $('input[name=toggle]').change(function(){
        var mode= $(this).prop('checkrd');
        var id = $(this).val();
        $.ajax({
            url: "{{ route('category.status') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "mode": mode
            },
            success: function(response) {
                if (response.status){
                    alert(response.message);
                }
                else{
                    alert('Trt Again');
                }
            }
        });
        alert(mode)
    })
</script>

@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@endsection

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.dltBtn').click(function(e){
    e.preventDefault();
    var form = $(this).closest('form');
    var dataID=$(this).data('id');

    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      form.submit();
    swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
  } else {
    swal("Your imaginary file is safe!");
  }
});
</script>
