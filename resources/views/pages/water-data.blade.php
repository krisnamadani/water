@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Water Data</h5>
    <table id="water-data" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Water Source</th>
          <th>Water PH</th>
          <th>Water Temperature</th>
          <th>Turbidity</th>
          <th>Ambient Temperature</th>
          <th>Ambient Humidity</th>
          <th>Eligibility</th>
          <th>Water Status</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
let water_data = null;

$(document).ready(function() {
  water_data = $('#water-data').DataTable({
    ajax: "{{ route('water-data.get') }}",
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
      {data: 'water_source', name: 'water_source'},
      {data: 'water_ph', name: 'water_ph'},
      {data: 'water_temperature', name: 'water_temperature'},
      {data: 'turbidity', name: 'turbidity'},
      {data: 'ambient_temperature', name: 'ambient_temperature'},
      {data: 'ambient_humidity', name: 'ambient_humidity'},
      {data: 'eligibility', name: 'eligibility'},
      {data: 'water_status', name: 'water_status'},
      {data: 'created_at', name: 'created_at'},
    ]
  });

  setInterval( function () {
    water_data.ajax.reload();
  }, 3000 );
});
</script>
@endsection