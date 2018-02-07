
@extends('layouts.dashboard')

@section('content')

<!--                       Selector Section                           -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-xs-12">
        <div class="form-group">
            <form id="range_select_form" action="" method="get">
                <label class="col-sm-3 control-label" for="nothing"></label>
                <div class="col-sm-2">
                    <div class="input-with-icon">
                        <input class="form-control" type="text" data-provide="datepicker" data-date-today-btn="linked" id="page_selected_from" name="page_selected_from" value="{{ $page_selected_from }}"/>
                        <span class="icon icon-calendar input-icon"></span>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-with-icon">
                        <input class="form-control" type="text" data-provide="datepicker" data-date-today-btn="linked" id="page_selected_to" name="page_selected_to" value="{{ $page_selected_to }}"/>
                        <span class="icon icon-calendar input-icon"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-primary" onclick="document.getElementById('range_select_form').submit();"> Submit </button>
                </div>
            </form>
        </div>
    </div>
</div>
<br/>

<!--                         Graph By Time                            -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Total Drivers Inside Camp by Time (Average)</h4>
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="bar" data-animation="false" data-labels='[
              "6 am"
              @for($i = 7; $i <= 18; $i++)
                  ,
                  @if($i < 12) "{{$i}} am" @endif
                  @if($i == 12) "12 pm" @endif
                  @if($i > 12) "{{ $i - 12 }} pm" @endif
              @endfor ]'
              data-values='[{"label": "Drivers", "backgroundColor": "#0ac29d", "borderColor": "#0ac29d", "pointBackgroundColor": "#0ac29d", "data": [ {{ number_format($count_by_hour[6], 2) }}
              @for($i = 7; $i <= 18; $i++) ,{{ number_format($count_by_hour[$i], 2) }} @endfor ]}]'
              data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
            </div>
          </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Driver Attendance by Day</h4>
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="line" data-animation="false" data-labels='[ "{{ $count_by_day_x_axis[0] }}"
              @for($i = 1; $i < count($count_by_day_x_axis); $i++) ,"{{ $count_by_day_x_axis[$i] }}" @endfor ]'
              data-values='[{"label": "Drivers", "backgroundColor": "transparent", "borderColor": "#0ac29d", "pointBackgroundColor": "#0ac29d", "data": [ {{ $count_by_day[0] }}
              @for($i = 1; $i < count($count_by_day); $i++) ,{{ $count_by_day[$i] }} @endfor ]}]'
              data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
            </div>
          </div>
        </div>
    </div>
</div>

<!--                        Pie Chart & List                          -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-xs-12 col-md-6">
      <div class="panel panel-body" data-toggle="match-height">
        <h4 class="text-center m-t-0">Average Attendance Distribution (Hover for Names)</h4>
        <div class="row">
            <div class="col-xs-3">
              <ul class="list-unstyled">
                  @for($i = 0; $i < 7; $i++)
                      <li class="m-b">
                          <small class="nowrap">
                              <span class="icon icon-square icon-fw" style="color: {{ $color_list[$i] }}"></span>
                              {{ $i }}-{{ $i+1 }} days a week ({{ number_format($distribution_per[$i], 2) }}%)
                          </small>
                      </li>
                  @endfor
              </ul>
            </div>
          <div class="col-xs-6">
            <canvas id="dist_chart" data-chart="pie" data-hide='["scalesX", "scalesY", "legend"]' height="300" width="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-actions">
            <button type="button" class="card-action card-toggler" title="Collapse"></button>
          </div>
           Driver List <span id="user_list_id"></span>
        </div>
        <div class="card-body" data-toggle="match-height" style="height: 218px;">
          <table class="table table-borderless table-middle">
            <tbody>
                @for($avg = 0; $avg < 7; $avg++)
                    @foreach($distributed_driver_list[$avg] as $driver)
                    <tr class="names_for_{{ $avg }}" style="display: none;">
                        <td class="col-xs-6"> {{ $driver->name }}</td>
                        <td class="col-xs-6">{{ number_format($driver->avg_attend, 2) }}/7 average</td>
                    </tr>
                    @endforeach
                @endfor
            </tbody>
          </table>
        </div>
      </div>
    </div>

</div>


@endsection

@section('scripts')

<script>
    var data = {
      datasets: [{
        data: [{{ count($distributed_driver_list[0]) }} @for($i = 1; $i < 7; $i++), {{count($distributed_driver_list[$i]) }} @endfor],
        backgroundColor: [
            '{{ $color_list[0] }}' @for($i = 1; $i < 7; $i++), '{{ $color_list[$i] }}' @endfor ]
      }],
      labels: [
        "0-1, {{ number_format($distribution_per[0],2) }}%"
         @for($i = 1; $i < 7; $i ++)
         ,"{{ $i }}-{{ $i+1 }}, {{ number_format($distribution_per[$i],2) }}%"
         @endfor
        ]
    };

    $(document).ready(
      function () {
        var canvas = document.getElementById("dist_chart");
        var ctx = canvas.getContext("2d");
        Chart.defaults.global.legend.display = false;
        var myNewChart = new Chart(ctx, {
          type: 'pie',
          data: data
        });

        canvas.onclick = function (evt) {
          var activePoints = myNewChart.getElementsAtEvent(evt);
          var chartData = activePoints[0]['_chart'].config.data;
          var idx = activePoints[0]['_index'];

          var label = chartData.labels[idx];
          var value = chartData.datasets[0].data[idx];

          document.getElementById("user_list_id").innerHTML = '(' + label + ')';

          for(avg = 0; avg < 7; avg++) {
              if(avg == parseInt(label[0])) {
                  var appBanners = document.getElementsByClassName('names_for_' + avg);

                  for (var i = 0; i < appBanners.length; i ++) {
                      appBanners[i].style.display = 'table-row';
                  }
              } else {
                  var appBanners = document.getElementsByClassName('names_for_' + avg), i;

                  for (var i = 0; i < appBanners.length; i ++) {
                      appBanners[i].style.display = 'none';
                  }
              }
          }
        };
      }
    );

</script>

@endsection
