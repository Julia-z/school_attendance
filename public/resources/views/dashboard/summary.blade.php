@extends('layouts.dashboard')

@section('content')

<!--                      Excel Table Style                           -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->
<style>


    .gray-col{
      color: #AAA;
    }
    table.excel {
        width: 100%; float: left;
        text-align: right;
        font-size: initial;
        table-layout: fixed;
    }

    thead.excel {
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        font-weight: bold;
    }

    tfoot.excel {
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        font-weight: bold;
    }

    tr.excel>td {
         padding-top: 10px;
         padding-bottom: 10px;
    }

    tr.excel td:first-child {
        text-align: left;
    }
</style>

<!--                        Charts Section                            -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-3">
      <div class="card"  id="top1">
        <div class="card-body">
          <div class="media">
            <div class="media-middle media-left">
              <div class="media-chart">
                <canvas data-chart="doughnut" data-animation="false" data-labels='["Tasks Finished", "Tasks Remaining"]'
                  data-values='[{"backgroundColor": ["#555", "#0b88d5"], "data": [@if($charts_tasks_green + $charts_tasks_red == 0) 0, 1 @else {{ $charts_tasks_red }}, {{ $charts_tasks_green }} @endif]}]'
                  data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
              </div>
            </div>
            <div class="media-middle media-body">
              <h2 class="media-heading">
                <small><span  class="top-of-summary">Tasks</span></small>
              </h2>
              @if($charts_tasks_green + $charts_tasks_red != 0)
              <span style="font-size: 150%;">{{ $charts_tasks_green + $charts_tasks_red }} Total <br/> {{ number_format($charts_tasks_green / ($charts_tasks_green + $charts_tasks_red) * 100, 0) }}% Finished</span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card" id="top2">
        <div class="card-body">
          <div class="media">
            <div class="media-middle media-left">
              <div class="media-chart">
                <canvas data-chart="doughnut" data-animation="false" data-labels='["Tasks Finished", "Tasks Remaining"]'
                  data-values='[{"backgroundColor": ["#555", "#0b88d5"], "data": [@if($charts_volume_green + $charts_volume_red == 0) 0, 1 @else {{ $charts_volume_red }}, {{ $charts_volume_green }} @endif]}]'
                  data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
              </div>
            </div>
            <div class="media-middle media-body">
              <h2 class="media-heading">
                <small><span  class="top-of-summary">Volume</span></small>
              </h2>
              @if($charts_volume_green + $charts_volume_red != 0)
              <span style="font-size: 150%;">
                  {{ number_format($charts_volume_green + $charts_volume_red, 0) }} Total <br/>
                  {{ number_format($charts_volume_green / ($charts_volume_green + $charts_volume_red) * 100, 0) }}% Finished
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card" id="top3">
        <div class="card-body">
          <div class="media">
            <div class="media-middle media-left">
              <div class="media-chart">
                <canvas data-chart="doughnut" data-animation="false" data-labels='["Tasks Finished", "Tasks Remaining"]'
                  data-values='[{"backgroundColor": ["#555", "#0b88d5"], "data": [@if($charts_issues_green + $charts_issues_red == 0) 0, 1 @else {{ $charts_issues_red }}, {{ $charts_issues_green }} @endif]}]'
                  data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
              </div>
            </div>
            <div class="media-middle media-body">
              <h2 class="media-heading">
                <small><span  class="top-of-summary">Issues</span></small>
              </h2>
              <span style="font-size: 150%;">
                  {{ $charts_issues_green + $charts_issues_red }} Total <br/>
                  @if($charts_issues_green + $charts_issues_red != 0)
                  {{ number_format($charts_issues_green / ($charts_issues_green + $charts_issues_red) * 100, 0) }}% Finished
                  @else
                  100% Finished
                  @endif
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card" id="top4">
        <div class="card-body">
          <div class="media">
            <div class="media-middle media-left">
              <div class="media-chart">
                <canvas data-chart="doughnut" data-animation="false" data-labels='["Tasks Finished", "Tasks Remaining"]'
                  data-values='[{"backgroundColor": ["#555", "#0b88d5"], "data": [@if($charts_time_green + $charts_time_red == 0) 0, 1 @else {{ $charts_time_green }}, {{ $charts_time_red }} @endif]}]'
                  data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>

              </div>
            </div>
            <div class="media-middle media-body">
              <h2 class="media-heading">
                <small><span  class="top-of-summary">Time Left</span></small>
              </h2>
              <span style="font-size: 150%;">
                  @if($charts_time_green % 60 > 30)
                      {{ number_format($charts_time_green/60, 0) + 1 }} hours Left <br/>
                  @else
                      {{ number_format($charts_time_green/60, 0) }} hours Left <br/>
                  @endif
                      {{ number_format(100 - $charts_time_green / ($charts_time_green + $charts_time_red) * 100, 2) }}% Passed
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>

<!--                      By District and Type                        -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-8">
      <div class="card" id="left1">
        <div class="card-body">
          <h4 class="card-title">Volume By District (in m<sup>3</sup>)</h4>
        </div>
        <div class="card-body">
          <div class="card-chart">
            <canvas data-chart="bar" data-animation="false" data-labels='["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"]'
            data-values='[{"label": "Today", "backgroundColor": "#0ac29d", "borderColor": "#0ac29d", "data":[ {{ $chart_today_array[0] }}
            @for($i = 1; $i < count($chart_today_array); $i++) ,{{ $chart_today_array[$i] }} @endfor ]},
            {"label": "Average", "backgroundColor": "#0b88d5", "borderColor": "#0b88d5", "data": [ {{ number_format($chart_average_array[0], 2) }}
            @for($i = 1; $i < count($chart_average_array); $i++) ,{{ number_format($chart_average_array[$i], 2) }} @endfor ]}]'
            data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
        <div class="card" id="right1">
            <div class="card-header">
              <div class="media">
                <div class="media-middle media-body">
                  <h6 class="media-heading">
                    <span style="font-size: 180%;">Truck Attendance</span>
                  </h6>
                </div>
              </div>
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-12 m-y">
                  <table class="excel">
                      <thead class="excel">
                          <tr class="excel">
                              <td style="width: 30%;">Type</td>
                              <td style="width: 19%;">East Gate Log</td>
                              <td style="width: 20%;">UFOW Log</td>
                              <td style="width: 20%;">Max</td>
                          </tr>
                      </thead>
                      <tbody>
                          <tr class="excel gray-col">
                              <td>Small</td>
                              <td>{{ $small_trucks_incamp_count }}</td>
                              <td>{{ $active_small_truck_count }}</td>
                              <td>{{ count($small_trucks_arr)}}</td>
                          </tr>
                          <tr class="excel gray-col">
                              <td>Large</td>
                              <td>{{ $large_trucks_incamp_count }}</td>
                              <td>{{ $active_large_truck_count }}</td>
                              <td>{{ count($large_trucks_arr)}}</td>
                          </tr>
                      </tbody>
                      <tfoot class="excel">
                          <tr class="excel">
                              <td>Total</td>
                              <td>{{ $small_trucks_incamp_count + $large_trucks_incamp_count }}</td>
                              <td>{{ $active_small_truck_count + $active_large_truck_count }}</td>
                              <td>{{ count($small_trucks_arr) + count($large_trucks_arr)}}</td>
                          </tr>
                      </tfoot>
                  </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<!--                        Station Stuff                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
  <div class="col-md-8">
    <div class="card" id="left2">
      <div class="card-body">
        <h4 class="card-title">ZWWTP Volume vs Capacity (in m<sup>3</sup>)</h4>
      </div>
      <div class="card-body">
        <div class="card-chart">
          <canvas data-chart="line" data-animation="false" data-labels='[
          @for($i = 0; $i < max($graph_max_time, 22); $i++) "{{ $graph_times_array[$i] }}",  @endfor "{{ $graph_times_array[max($graph_max_time, 22)] }}" ]'
          data-values='[{"label": "Volume", "backgroundColor": "transparent", "borderColor": "#0ac29d", "pointBackgroundColor": "#0ac29d", "data": [
          @for($i = 0; $i < $graph_max_time; $i++) {{ $graph_volume_array[$i] }},  @endfor {{ $graph_volume_array[$graph_max_time] }} ]},
          {"label": "Capacity", "backgroundColor": "transparent", "borderColor": "#0b88d5", "borderDash": [5, 5], "pointBackgroundColor": "#0b88d5", "data": [
          @for($i = 0; $i < max($graph_max_time, 22); $i++) {{ $graph_capacity_array[$i] }},  @endfor {{ $graph_capacity_array[max($graph_max_time, 22)] }} ]}]'
          data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
        </div>
      </div>
    </div>
  </div>
    <div class="col-md-4">
      <div class="card" id="right2">
        <div class="card-header">
            <div class="media">
              <div class="media-middle media-body">
                <h6 class="media-heading">
                  <span style="font-size: 180%;">Disposal</span>
                </h6>
              </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 m-y">
                <table class="excel">
                    <thead class="excel">
                        <tr class="excel">
                            <td style="width: 39%;">Destination</td>
                            <td style="width: 30%;">Volume (m<sup>3</sup>)</td>
                            <td style="width: 39%;">Percentage (%)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="excel gray-col">
                            <td>ZWWTP</td>
                            <td>{{ number_format($tasks_zwwtp_val, 0) }}</td>
                            <td>{{ number_format($tasks_zwwtp_per, 0) }}%</td>
                        </tr>
                        <tr class="excel gray-col">
                            <td>Akaider<br/>Wastewater</td>
                            <td>{{ number_format($tasks_akaider_val, 0) }}</td>
                            <td>{{ number_format($tasks_akaider_per, 0) }}%</td>
                        </tr>
                        <tr class="excel gray-col">
                            <td>Akaider<br/>Sludge</td>
                            <td>{{ number_format($tasks_sludge_val, 0) }}</td>
                            <td>{{ number_format($tasks_sludge_per, 0) }}%</td>
                        </tr>
                        <tr class="excel gray-col">
                            <td>Wadi</td>
                            <td>{{ number_format($tasks_wadi_val, 0) }}</td>
                            <td>{{ number_format($tasks_wadi_per, 0) }}%</td>
                        </tr>
                    </tbody>
                    <tfoot class="excel">
                        <tr class="excel">
                            <td>Total</td>
                            <td>{{ number_format($tasks_zwwtp_val + $tasks_akaider_val + $tasks_sludge_val + $tasks_wadi_val, 0) }}</td>
                            <td>{{ number_format($tasks_zwwtp_per + $tasks_akaider_per + $tasks_sludge_per + $tasks_wadi_per, 0) }}%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!--                        Issues Section                            -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">
        All issues raised
      </div>
      <div class="card-body">
        <table id="demo-datatables-4" data-length-menu='[[10, 25, 50, 100, -1], ["10", "25", "50", "100", "All"]]' class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
                @foreach($issues_table_req_cols as $col)
                    <th>{{ sanitize_static_names($col) }}</th>
                @endforeach
            </tr>
          </thead>
          <tfoot>
              <tr>
                  @foreach($issues_table_req_cols as $col)
                      <th>{{$col}}</th>
                  @endforeach
              </tr>
          </tfoot>
          <tbody>
              @foreach($issues_table_data as $issue)
                  <tr>
                  @foreach($issues_table_req_cols as $col)
                      <th>{{$issue->{$col} }}</th>
                  @endforeach
                </tr>
              @endforeach
          </tbody>
        </table>
        <div class="cent">
          <button class="btn btn-success btn-cust"  onclick="export_data('demo-datatables-4')">Export Data</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!--                        Comment Section                           -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">
        All comments
      </div>
      <div class="card-body">
        <table id="demo-datatables-5" data-length-menu='[[10, 25, 50, 100, -1], ["10", "25", "50", "100", "All"]]' class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
                @foreach($comments_table_req_cols as $col)
                    <th>{{ sanitize_static_names($col) }}</th>
                @endforeach
            </tr>
          </thead>
          <tfoot>
              <tr>
                  @foreach($comments_table_req_cols as $col)
                      <th>{{$col}}</th>
                  @endforeach
              </tr>
          </tfoot>
          <tbody>
              @foreach($comments_table_data as $comment)
                  <tr>
                  @foreach($comments_table_req_cols as $col)
                      <th>{{$comment->{$col} }}</th>
                  @endforeach
                </tr>
              @endforeach
          </tbody>
        </table>
        <div class="cent">
          <button class="btn btn-success btn-cust"  onclick="export_data('demo-datatables-5')">Export Data</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--                         Export Forms                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<form id="export_data_form" method="post" action="/dashboard/export_table" target="_blank">
    <input type="hidden" id="table_name" name="table_name" value="" />
    <input type="hidden" id="row_length" name="row_length" value="" />
    <input type="hidden" id="table_data" name="table_data" value="" />
</form>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function try_set() {

    document.getElementById('left1').style.paddingBottom = '0px';
    document.getElementById('left2').style.paddingBottom = '0px';
    document.getElementById('right1').style.paddingBottom = '0px';
    document.getElementById('right2').style.paddingBottom = '0px';
    document.getElementById('top1').style.paddingBottom = '0px';
    document.getElementById('top2').style.paddingBottom = '0px';
    document.getElementById('top3').style.paddingBottom = '0px';
    document.getElementById('top4').style.paddingBottom = '0px';

    var r1s = document.getElementById('right1').offsetHeight;
    var r2s = document.getElementById('right2').offsetHeight;
    var l1s = document.getElementById('left1').offsetHeight;
    var l2s = document.getElementById('left2').offsetHeight;
    var t1 = document.getElementById('top1').offsetHeight;
    var t2 = document.getElementById('top2').offsetHeight;
    var t3 = document.getElementById('top3').offsetHeight;
    var t4 = document.getElementById('top4').offsetHeight;

    if(r1s > l1s) {
        document.getElementById('left1').style.paddingBottom = (r1s - l1s) + 'px';
    } else {
        document.getElementById('right1').style.paddingBottom = (l1s - r1s) + 'px';
    }

    if(r2s > l2s) {
        document.getElementById('left2').style.paddingBottom = (r2s - l2s) + 'px';
    } else {
        document.getElementById('right2').style.paddingBottom = (l2s - r2s) + 'px';
    }

    var m1 = Math.max(t1, t2);
    var m2 = Math.max(t3, t4);
    var m = Math.max(m1, m2);
    document.getElementById('top1').style.paddingBottom = (m - t1) + 'px';
    document.getElementById('top2').style.paddingBottom = (m - t2) + 'px';
    document.getElementById('top3').style.paddingBottom = (m - t3) + 'px';
    document.getElementById('top4').style.paddingBottom = (m - t4) + 'px';
}

setTimeout(try_set, 2000);

$(window).on('resize', function(){
    setTimeout(try_set, 2000);
});

</script>


@endsection
