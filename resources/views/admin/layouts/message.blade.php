@if (Session('success'))

<div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
    <strong>{{Session('success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @elseif (Session('error'))
  <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
    <strong>{{Session('error')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
