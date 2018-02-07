
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

<!--                       Districts & Types                          -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-8">
      <div class="card" id="left1">
        <div class="card-body">
          <h4 class="card-title">Volume By District (m<sup>3</sup>)</h4>
        </div>
        <div class="card-body">
          <div class="card-chart">
            <canvas data-chart="bar" data-animation="false" data-labels='["1", "2", "3", "4", "5", "6", "7", "9", "10", "11", "12"]'
            data-values='[{"label": "Volume", "backgroundColor": "#0ac29d", "borderColor": "#0ac29d", "data":[ {{ $district_data[0] }}
            @for($i = 1; $i < count($district_data); $i++) ,{{ $district_data[$i] }} @endfor ]}]'
            data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
    <div class="card" id="right1">
      <div class="card-header">
           Volume Statistics
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 m-y">
            <ul class="list-group list-group-divided">
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Daily Average</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ round($average_per_day,2) }} m<sup>3</sup>

                    </h4>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Daily Maximum</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ $max_volume }} m<sup>3</sup>
                    </h4>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Daily Minimum</span>
                    </span></h6>
                    <h4 class="media-heading">{{ $min_volume }} m<sup>3</sup>
                    </h4>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--                      Graph 1 & 2 Section                         -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-8">
        <div class="card" id="left2">
          <div class="card-body">
            <h4 class="card-title">ZWWTP vs Akaider (m<sup>3</sup>)</h4>
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="line" data-animation="false" data-labels='[ "{{ $x_axis_data[0] }}"
              @for($i = 1; $i < count($x_axis_data); $i++) ,"{{ $x_axis_data[$i] }}" @endfor ]'
              data-values='[{"label": "ZWWTP", "backgroundColor": "transparent", "borderColor": "#0ac29d", "pointBackgroundColor": "#0ac29d", "data": [ {{ $graph1_data[0] }}
              @for($i = 1; $i < count($graph1_data); $i++) ,{{ $graph1_data[$i] }} @endfor ]},
              {"label": "Akaider", "backgroundColor": "transparent", "borderColor": "#0b88d5", "borderDash": [5, 5], "pointBackgroundColor": "#0b88d5", "data": [ {{ $graph2_data[0] }}
              @for($i = 1; $i < count($graph2_data); $i++) ,{{ $graph2_data[$i] }} @endfor ]}]'
              data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
            </div>
          </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-body text-center" data-toggle="match-height" id="right2">
          <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
              <canvas data-chart="doughnut" data-labels='["ZWWTP", "Akaider"]' data-values='[{"backgroundColor": ["#50b432", "#058dc7"],
                "data": [ @if($dest_zwwtp_val + $dest_akaider_val != 0 ) {{ $dest_zwwtp_val }}, {{ $dest_akaider_val }} @else 1,0 @endif ]}]' data-hide='["scalesX", "scalesY", "legend"]' data-cutout-percentage="80" height="150" width="150"></canvas>
            </div>
          </div>
          <h6 class="m-b-0">
            <span class="nowrap">
              <span class="p-x">
                  <span class="icon icon-square icon-fw" style="color: #50b432"></span>
                ZWWTP @if($dest_zwwtp_val + $dest_akaider_val == 0) 0%
                @else {{ number_format(100*$dest_zwwtp_val/($dest_zwwtp_val + $dest_akaider_val), 2) }}% @endif
              </span>
              <span class="p-x">
                  <span class="icon icon-square icon-fw" style="color: #058dc7"></span>
                Akaider @if($dest_zwwtp_val + $dest_akaider_val == 0) 0%
                @else {{ number_format(100*$dest_akaider_val/($dest_zwwtp_val + $dest_akaider_val), 2) }}% @endif
              </span>
            </span>
            </h6>
        </div>
    </div>
</div>

<!--                      Graph 3 & 4 Section                         -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->
<div class="row gutter-xs">
    <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Wadi Volume (m<sup>3</sup>)</h4>
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="line" data-animation="false" data-labels='[ "{{ $x_axis_data[0] }}"
              @for($i = 1; $i < count($x_axis_data); $i++) ,"{{ $x_axis_data[$i] }}" @endfor ]'
              data-values='[{"label": "Wadi", "backgroundColor": "transparent", "borderColor": "#0ac29d", "pointBackgroundColor": "#0ac29d", "data": [ {{ $graph3_data[0] }}
              @for($i = 1; $i < count($graph3_data); $i++) ,{{ $graph3_data[$i] }} @endfor ]}]'
              data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sludge Volume (m<sup>3</sup>)</h4>
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="line" data-animation="false" data-labels='[ "{{ $x_axis_data[0] }}"
              @for($i = 1; $i < count($x_axis_data); $i++) ,"{{ $x_axis_data[$i] }}" @endfor ]'
              data-values='[{"label": "Sludge", "backgroundColor": "transparent", "borderColor": "#0ac29d", "pointBackgroundColor": "#0ac29d", "data": [ {{ $graph4_data[0] }}
              @for($i = 1; $i < count($graph4_data); $i++) ,{{ $graph4_data[$i] }} @endfor ]}]'
              data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
            </div>
          </div>
        </div>
    </div>
</div>

<!--                        Graph 4 Section                           -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function try_set() {

    document.getElementById('left1').style.paddingBottom = '0px';
    document.getElementById('left2').style.paddingBottom = '0px';
    document.getElementById('right1').style.paddingBottom = '0px';
    document.getElementById('right2').style.paddingBottom = '0px';

    var r1s = document.getElementById('right1').offsetHeight;
    var r2s = document.getElementById('right2').offsetHeight;
    var l1s = document.getElementById('left1').offsetHeight;
    var l2s = document.getElementById('left2').offsetHeight;


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
}

setTimeout(try_set, 2000);

$(window).on('resize', function(){
    setTimeout(try_set, 2000);
});
</script>


@endsection
