@extends('templates.master')
@section('title', 'Dashboard | BanMas')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Perbandingan Warga Yang Mendapatkan Bantuan Atau Tidaknya</h4>
              <p class="card-category">Tahun. 2021</p>
              <?= '&quot;' ?>
            </div>
            <div class="card-body">
              <center>
                <div class="chartWrapper">
                  <div class="chartAreaWrapper">
                  <div class="chartAreaWrapper2">
                      <canvas id="chart_1" height="700" width="1500"></canvas>
                  </div>
                  </div>
                  <canvas id="axis-Test" height="700" width="0"></canvas>
                </div>
              </center>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')

<script>
$(function () {
  var rectangleSet = false;
  var ctx = document.getElementById("chart_1").getContext("2d");
  var myChart = new Chart(ctx, {
    type: 'line',
    options: {
      scales: {
        xAxes: [{
          type: 'time',
        }]
      }
    },
    data: {
      labels: [ @foreach ($dataS as $itemS) "{{ $itemS }}", @endforeach],
      datasets: [{
        label: 'Jumlah Orang Dapat Bantuan',
        data: [<?php
          foreach ($dataJumlahPenerimaPerTanggal as $key) {
            echo '{t: "' . $key->tanggal_bantuan . '", y: ' . $key->total . '},';
          }
          ?>
        ],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    animation: {
              onComplete: function () {
                  if (!rectangleSet) {
                      var scale = window.devicePixelRatio;                       

                      var sourceCanvas = myChart.chart.canvas;
                      var copyWidth = myChart.scales['y-axis-0'].width - 10;
                      var copyHeight = myChart.scales['y-axis-0'].height + myChart.scales['y-axis-0'].top + 10;

                      var targetCtx = document.getElementById("axis-Test").getContext("2d");

                      targetCtx.scale(scale, scale);
                      targetCtx.canvas.width = copyWidth * scale;
                      targetCtx.canvas.height = copyHeight * scale;

                      targetCtx.canvas.style.width = `${copyWidth}px`;
                      targetCtx.canvas.style.height = `${copyHeight}px`;
                      targetCtx.drawImage(sourceCanvas, 0, 0, copyWidth * scale, copyHeight * scale, 0, 0, copyWidth * scale, copyHeight * scale);

                      var sourceCtx = sourceCanvas.getContext('2d');

                      // Normalize coordinate system to use css pixels.

                      sourceCtx.clearRect(0, 0, copyWidth * scale, copyHeight * scale);
                      rectangleSet = true;
                  }
              },
              onProgress: function () {
                  if (rectangleSet === true) {
                      var copyWidth = myChart.scales['y-axis-0'].width;
                      var copyHeight = myChart.scales['y-axis-0'].height + myChart.scales['y-axis-0'].top + 10;

                      var sourceCtx = myChart.chart.canvas.getContext('2d');
                      sourceCtx.clearRect(0, 0, copyWidth, copyHeight);
                  }
              }
          }
  });
});
</script>
@endsection
