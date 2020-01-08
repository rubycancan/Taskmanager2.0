@extends('layouts.app')

@section('content')
    <div class=" row">
        <div class="container col-md-3">
            <canvas id="pieChart" width="50" height="50"></canvas>
            <div id="pie-data" data-todo="{{ $todoCount }}" data-done="{{ $doneCount }}" data-total="{{ $total }}"></div>
        </div>

        <div class="container col-md-3">
            <canvas id="barChart" width="50" height="50"></canvas>
            <div id="bar-data" data-names={!! json_encode($names, JSON_UNESCAPED_UNICODE) !!}
                 data-counts={!! json_encode(TaskCountArray($projects)) !!}></div>
        </div>
        <div class="container col-md-3">
            <canvas id="radarChart" width="50" height="50"></canvas>
        </div>
    </div>


@endsection

@section('customJS')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/pie.js') }}"></script>
    <script src="{{ asset('js/bar.js') }}"></script>
    <script>
        options = {
            title: {
              display: true,
              text: '项目之间的任务完成情况'
            },
            legend: {
              display: true,
              position: "bottom"
            },
            scale: {
                angleLines: {
                    display: false
                },
                ticks: {
                    suggestedMin: 1,
                    suggestedMax: 10
                }
            }
        };

        var ctxBarr = $('#radarChart');

        var data = {
            labels: ['任务总数', '未完成的', '完成的'],
            datasets: [
                <?php
                    foreach ($projects as $project):
                        $i = 0;
                        $name = $project->name;
                        $totalPP = count( $project->tasks()->get());
                        $todoPP = count($project->tasks()->where('completion',0)->get());
                        $donePP = $project->tasks()->where('completion',1)->count();
                        echo '{';
                        ?>
                    label: "<?php echo $name;?>",
                    backgroundColor: "{{ rand_color() }}",
                    borderColor: "rgba(179,181,198,1)",
                    pointBackgroundColor: "rgba(179,181,198,1)",
                    pointBoderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(179,181,198,1)",
                    data: [<?php echo $totalPP.','.$todoPP.','.$donePP ?>]

                <?php
                    ($i+1) == $projects->count() ? print '}':print '},';
                    $i++;
                    endforeach;
                ?>
            ]
        }

        var myRadarChart = new Chart(ctxBarr, {
            type: 'radar',
            data: data,
            options: options
        });
    </script>
@endsection