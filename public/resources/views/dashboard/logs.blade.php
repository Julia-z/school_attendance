<style>
    table.excel {
        width: 100%; float: left;
        text-align: right;
        font-size: initial;
        table-layout: fixed;
    }
    .excel:nth-child(even) {background: #CCC}
    .excel:nth-child(odd) {background: #EEE}


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
        padding-left: 10px;
        padding-right: 10px;
         padding-top: 10px;
         padding-bottom: 10px;
    }

    tr.excel td:first-child {
        text-align: left;
    }
</style>
@extends('layouts.dashboard')

@section('content')

<div class="card">
  <div class="card-header">
      <div class="media">
        <div class="media-middle media-body">
          <h6 class="media-heading" style="font-size: larger;">
             Speed Logs
          </span></h6>
        </div>
        <div class="card-actions">
          <button type="button" class="card-action card-toggler" title="Collapse"></button>
        </div>
      </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 m-y">
          <table class="excel">
              <thead class="excel">
                  <tr class="excel excel-title">
                      <td style="width: 20%;">Timestamp1</td>
                      <!-- <td style="width: 15%; text-align: left;">(long1, lat1)</td> -->
                      <td style="width: 20%;">Timestamp2</td>
                      <!-- <td style="width: 15%;">(long2, lat2)</td> -->
                      <td style="width: 20%;">Time difference (sec)</td>
                      <td style="width: 20%;">Distance (meters)</td>
                      <td style="width: 20%;">Speed (km/hr)</td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($logs_array as $log)
                      <tr class="excel">
                          <td>{{ $log->time1 }}</td>
                          <!-- <td>({{ $log->long1 }}, {{ $log->lat1 }})</td> -->
                          <td>{{ $log->time2 }}</td>
                          <!-- <td>({{ $log->long2 }}, {{ $log->lat2 }})</td> -->
                          <td>{{ $log->timeDiff }}</td>
                          <td>{{ round($log->dist, 2) }}</td>
                          <td>{{ round($log->speed, 4) }}</td>
                      </tr>
                  @endforeach
              </tbody>

          </table>
      </div>
    </div>
  </div>
</div>

@endsection
