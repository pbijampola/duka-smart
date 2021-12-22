@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
      <div class="card">

        <div class="card-body">
          <div class="section-title mt-0">All Products</div>
          <div>
            <a href="{{ route('product.create') }}" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i>Add New Product</a>
          </div>
          <p class="float-right">
             Total Number of Products <span class="badge badge-primary">{{ $products->count() }}</span>
          </p>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Photo</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Offer Price</th>
                <th>Size</th>
                <th>Condition</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ( $products as $key => $product )
             <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $product->title }}</td>
                <td><img src="{{$product->photo }}" alt="{{ $product->title }}" style="max-height: 90px; max-width:120px"></td>
                <td>${{ number_format($product->price,2) }}</td>
                <td>{{$product->discount}}%</td>
                <td>{{$product->offer_price}}</td>
                <td>{{ $product->size }}</td>
                <td>{{ $product->condition }}</td>
                <td>

                  @if ( $product->status == 'active' )
                    <span class="badge badge-success">{{ $product->status }}</span>
                  @else
                    <span class="badge badge-danger">{{ $product->status }}</span>
                  @endif
                </td>
                <td>
                    <div class="d-flex">
                        <div>
                            <a href="{{ route('product.edit',$product->id) }}"  data-toggle="tooltip" title="Edit" data-placement="bottom" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>

                        </div>
                        <div>
                            <form action="{{ route('product.destroy',$product->id) }}" method="POST">
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
