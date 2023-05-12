@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ asset('resources/assets/js/chartv2.8.0.js') }}"></script>
<h1>{{ $display['heading'] }}</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><i class="fas fa-tachometer-alt mr-1 mt-1"></i>{{ trans('messages.lbl_dashboard') }}</li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ol>
<div class="row">
    <div class="col-sm-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar mr-1"></i>
                {{ trans('messages.lbl_students_mark_range') }} ( {{ trans('messages.lbl_total_no_of_students')." ".$percent->count() }} )
            </div>
            <div class="card-body">
                <canvas id="stuRangeBarChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar mr-1"></i>
                {{ trans('messages.lbl_students_subject_class_average') }}
            </div>
            <div class="card-body">
                <canvas id="subjClsBarChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-pie mr-1"></i>{{ trans('messages.lbl_students_score_pie_chart') }}
            </div>
            <div class="card-body">
                <canvas id="passFailPieChart" width="400" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var bar_ctx = document.getElementById("stuRangeBarChart");
    var myLineChart = new Chart(bar_ctx, {
      type: 'horizontalBar',
      data: {
        labels: ["91-100%", "81-90%", "71-80%", "61-70%", "51-60%", "41-50%", "0-40%"],
        datasets: [{
          label: "<?php echo trans('messages.lbl_students'); ?>",
          data: [<?php echo $stuPerRange; ?>],
          backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [],
            borderWidth: 1
        }],
      },
      options: {
        scales: {
          xAxes: [{
            gridLines: {
              display: true
            },
            ticks: {
              min: 0,
              max: <?php echo count($percent); ?>,
              maxTicksLimit: 15,
              stepSize: 1
            },
          }],
          yAxes: [{
            // barThickness: 6,  // number (pixels) or 'flex'
            // maxBarThickness: 6, // number (pixels)
            ticks: {
              min: 0,
              max: 100,
              maxTicksLimit: 10,
            },
            gridLines: {
              display: true
            },
          }],
        },
        responsive: true,
        legend: {
          display: false
        }
      }
    });

    var bar_ctx = document.getElementById("subjClsBarChart");
    var myLineChart = new Chart(bar_ctx, {
      type: 'bar',
      data: {
        labels: [<?php echo implode(', ', $clsNameArr);?>], // 授業名
        datasets: [{
          label: "<?php echo trans('messages.lbl_subjects'); ?>",
          data: [<?php echo implode(', ', $subjectArr);?>], //　科目カウント
          backgroundColor: [],
            borderColor: [],
            borderWidth: 1
        }],
      },
      options: {
        scales: {
          xAxes: [{
            gridLines: {
              display: true
            },
            ticks: {
              min: 0,
              max: <?php echo count($clsNameArr); ?>, // class count
              maxTicksLimit: 15,
              stepSize: 1
            },
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: <?php echo count($subjectArr); ?>, //subject count
              maxTicksLimit: 15,
              stepSize: 1
            },
            gridLines: {
              display: true
            },
          }],
        },
        responsive: true,
        legend: {
          display: false
        }
      }
    });

    var pie_ctx = document.getElementById("passFailPieChart");
    var myChart = new Chart(pie_ctx, {
        type: 'pie',
        data: {
            labels: ['<?php echo trans('messages.lbl_fail'); ?>', '<?php echo trans('messages.lbl_pass'); ?>'],
            datasets: [{
                label: '# of Followers',
                data: [<?php echo $passFailRange; ?>],
                backgroundColor: ['rgb(255, 0, 0)',
                    'rgb(0,128,0)',
                    'rgba(54, 162, 235, 0.9)',
                    'rgba(255, 206, 86, 0.9)',
                    'rgba(75, 192, 192, 0.9)',
                    'rgba(153, 102, 255, 0.9)',
                    'rgba(255, 159, 64, 0.9)'
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
        options: {
            responsive: true,
            tooltips: {
                enabled: true
            }
        }
    });
</script>
@endsection