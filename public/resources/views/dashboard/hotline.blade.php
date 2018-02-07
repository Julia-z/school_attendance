
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

<!--                      By District and Type                        -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Hotline calls by district</h4>
        </div>
        <div class="card-body">
          <div class="card-chart">
            <canvas data-chart="bar" data-animation="false" data-labels='["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"]'
            data-values='[{"label": "Hotline Calls", "backgroundColor": "#0ac29d", "borderColor": "#0ac29d", "data":[ {{ $count_by_district[1] }}
            @for($i = 2; $i < count($count_by_district); $i++) ,{{ $count_by_district[$i] }} @endfor ]}]'
            data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
    <div class="card">
      <div class="card-header">
          <div class="media">
            <div class="media-middle media-body">
              <h6 class="media-heading"> <span style="font-size: 180%;">
                 Tank Types
              </span></h6>
            </div>
          </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 m-y">
            <ul class="list-group list-group-divided">
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">PRC</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ number_format($per_by_tank_type[1], 2) }}%
                      <small> {{ $count_by_tank_type[1] }}</small>
                    </h4>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Education</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ number_format($per_by_tank_type[2], 2) }}%
                      <small>{{ $count_by_tank_type[2] }}</small>
                    </h4>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Others</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ number_format($per_by_tank_type[3], 2) }}%
                      <small>{{ $count_by_tank_type[3] }}</small>
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
<!--                        By Day and Time                           -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Hotline Calls By Time</h4>
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
              data-values='[{"label": "Time", "backgroundColor": "#0ac29d", "borderColor": "#0ac29d", "pointBackgroundColor": "#0ac29d", "data": [ {{ $count_by_hour[0] }}
              @for($i = 1; $i < count($count_by_hour); $i++) ,{{ $count_by_hour[$i] }} @endfor ]}]'
              data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Hotline Calls By Day</h4>
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="line" data-animation="false" data-labels='[ "{{ $count_by_day_x_axis[0] }}"
              @for($i = 1; $i < count($count_by_day_x_axis); $i++) ,"{{ $count_by_day_x_axis[$i] }}" @endfor ]'
              data-values='[{"label": "Calls", "backgroundColor": "transparent", "borderColor": "#0ac29d", "pointBackgroundColor": "#0ac29d", "data": [ {{ $count_by_day[0] }}
              @for($i = 1; $i < count($count_by_day); $i++) ,{{ $count_by_day[$i] }} @endfor ]}]'
              data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="75"></canvas>
            </div>
          </div>
        </div>
    </div>
</div>


@endsection
