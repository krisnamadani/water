@extends('layouts.app')

@section('content')
@if (session('success'))
  <div class="alert alert-success mt-4" role="alert">
    {{ session('success') }}
  </div>
@endif
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Profile</h5>
    <form action="{{ route('profile.save') }}" id="profile">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="name" class="form-control" id="name" name="name" value="{{ $profile->name }}">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $profile->email }}">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <div id="passwordHelp" class="form-text">Leave blank if you don't want to change your password.</div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    getProfile();
    
    $('#profile').submit(function(e) {
      e.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      var data = form.serialize();
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message,
            timer: 1500
          });
          getProfile();
        },
        error: function(response) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.responseJSON.message
          });
        }
      });
    });

    function getProfile() {
      $.ajax({
        url: '{{ route('profile.get') }}',
        type: 'GET',
        success: function(response) {
          if (response.status == 'success') {
            $('#name').val(response.data.name);
            $('#email').val(response.data.email);
            $('#password').val('');
          }
        }
      });
    }
  });
</script>
@endsection