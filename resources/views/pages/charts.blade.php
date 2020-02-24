@extends('layouts.base')

@include('components.header')
@section('search')
<div class="container-fluid d-lg-flex mt-5">
  <div class="chart-container mt-5" style="position: relative; margin:auto; width:50vw">
    <canvas id="viewsChart"></canvas>
  </div>
  <div class="chart-container mt-5" style="position: relative; margin:auto; width:50vw">
    <canvas id="messagesChart"></canvas>
  </div>
</div>

<script>
  var viewsChart = $("#viewsChart");
  new Chart(viewsChart, {

    type: "bar",
    data: {
      labels: moment.months(),
      datasets: [{
        label: "Views",
        data: [5, 10, 45, 25, 8, 20, 7, 30, 25, 12, 22, 18],
        backgroundColor: [
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(75, 192, 192, 0.6)',
          'rgba(153, 102, 255, 0.6)',
          'rgba(163, 174, 24, 0.6)',
          'rgba(68, 122, 247, 0.6)',
          'rgba(232, 34, 209, 0.6)',
          'rgba(21, 51, 221, 0.6)',
          'rgba(194, 139, 128, 0.6)',
          'rgba(87, 4, 131, 0.6)',
          'rgba(169, 26, 127, 0.6)'
        ]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Apartment Views',
        fontSize: 30
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });


  var messagesChart = $("#messagesChart");
  new Chart(messagesChart, {

    type: "pie",
    data: {
      labels: moment.months(),
      datasets: [{
        label: "Messages",
        data: [5, 10, 45, 25, 8, 20, 7, 30, 25, 12, 22, 18],
        backgroundColor: [
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(75, 192, 192, 0.6)',
          'rgba(153, 102, 255, 0.6)',
          'rgba(163, 174, 24, 0.6)',
          'rgba(68, 122, 247, 0.6)',
          'rgba(232, 34, 209, 0.6)',
          'rgba(21, 51, 221, 0.6)',
          'rgba(194, 139, 128, 0.6)',
          'rgba(87, 4, 131, 0.6)',
          'rgba(169, 26, 127, 0.6)'
        ]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Messages',
        fontSize: 30
      }
    }
  });
</script>
@endsection
