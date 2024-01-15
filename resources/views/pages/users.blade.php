@extends('layouts.app')

@section('content')
@if (session('success'))
  <div class="alert alert-success mt-4" role="alert">
    {{ session('success') }}
  </div>
@endif
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Users</h5>
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addUserModal" id="addUserButton">
      Add User
    </button>
    <table id="users" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('users.store') }}" id="addUserForm">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" class="form-control" id="name" name="name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addUserSubmit">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    let users = $('#users').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('users.get') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
    });

    $('#addUserButton').click(function() {
      $('#addUserForm').trigger('reset');
    });

    $('#addUserSubmit').click(function() {
      $('#addUserForm').submit();
    });

    $('#addUserForm').submit(function(e) {
      e.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      var data = form.serialize();
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(response) {
          $('#addUserModal').modal('hide');
          $('#addUserForm').trigger('reset');
          users.draw();
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message
          });
        },
        error: function(error) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.responseJSON.message
          });
        }
      });
    });
  });
</script>
@endsection