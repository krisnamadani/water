@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Dashboard</h5>
    <p class="mb-0">This is a dashboard page </p>
  </div>
</div>

<div class="row">
  <div class="col-lg-4">
    <div class="card overflow-hidden">
      <div class="card-body p-4">
        <h5 class="card-title mb-9 fw-semibold">Total Data</h5>
        <h4 class="fw-semibold mb-3">{{ $count['total_data'] }}</h4>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card overflow-hidden">
      <div class="card-body p-4">
        <h5 class="card-title mb-9 fw-semibold">Water Source</h5>
        <h4 class="fw-semibold mb-3">{{ $count['water_source_count'] }}</h4>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card overflow-hidden">
      <div class="card-body p-4">
        <h5 class="card-title mb-9 fw-semibold">Fit to Drink</h5>
        <h4 class="fw-semibold mb-3">{{ $count['water_fit'] }}</h4>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">Data Overview</h5>
          </div>
        </div>
        <div id="chart"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
$(function () {
  var chart = {
    series: [
      { name: "data this month:", data: {{ $bar_chart['data'] }} },
    ],
    chart: {
      type: "bar",
      height: 345,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },
    colors: ["#5D87FF", "#49BEFF"],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },
    xaxis: {
      type: "category",
      categories: {!! $bar_chart['label'] !!},
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },
    yaxis: {
      show: true,
      min: 0,
      tickAmount: 4,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },
    tooltip: { theme: "light" },
    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]
  };
  var chart = new ApexCharts(document.querySelector("#chart"), chart);
  chart.render();
});
</script>
@endsection