@extends('layouts.dashboard')

@section('content')

<style>
    table.excel {
        width: 100%; float: left;
        text-align: left;
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

<div class="row gutter-xs">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <div class="media">
                <div class="media-middle media-body">
                  <h6 class="media-heading" style="font-size: larger;">Type Explanation</h6>
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
                          <tr class="excel">
                              <td style="width: 20%;">Type Number</td>
                              <td style="width: 80%;">Meaning</td>
                          </tr>
                      </thead>
                      <tbody>
                          <tr class="excel">
                              <td style="width: 20%;">1</td>
                              <td style="width: 80%;">In a batch with multiple tasks assigned, the driver emptied a tank not in the batch while there were assigned tanks not yet emptied.</td>
                          </tr>
                          <tr class="excel">
                              <td style="width: 20%;">2</td>
                              <td style="width: 80%;">In an emptying event, the measure2 indicated a higher volume than measure1. This means an error in measurement has occured.</td>
                          </tr>
                          <tr class="excel">
                              <td style="width: 20%;">3</td>
                              <td style="width: 80%;">In two successive measures, the volume indicated by the first is lower than that by the second. This means there is either an incorrect measure, or an emptying has occured in between without being recorded.</td>
                          </tr>
                          <tr class="excel">
                              <td style="width: 20%;">4</td>
                              <td style="width: 80%;">In an emptying event, the measure2 volume and measure1 volume are almost equal, which means no empting actually occured.</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



<div class="row gutter-xs">
    <div class="col-md-12">
    @if(count($alert_data) > 0)
    <div class="card">
      <div class="card-header">
          <div class="media">
            <div class="media-middle media-body">
              <h6 class="media-heading" style="font-size: larger;">
              Alert Details</h6>
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
                      <tr class="excel">
                          @foreach($alert_data[0] as $info)
                              <td style="width: 12.5%">{{ $info }}</td>
                          @endforeach
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($alert_data as $ind=>$instance)
                          @if($ind != 0)
                              <tr>
                                  @foreach($instance as $info)
                                      <td style="width: 12.5%">{{ $info }}</td>
                                  @endforeach
                            </tr>
                          @endif
                      @endforeach
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>



<div class="row gutter-xs">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-body">
        <table id="demo-datatables-4" data-length-menu='[[10, 25, 50, 100, -1], ["10", "25", "50", "100", "All"]]' class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
                @foreach($table_titles as $title)
                    <th>{{ $title }}</th>
                @endforeach
                <th> Expand </th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                @foreach($table_titles as $title)
                    <th>{{ $title }}</th>
                @endforeach
                <th></th>
            </tr>
          </tfoot>
          <tbody>
              @foreach($table_alerts as $ind=>$alert_instance)
                  <tr>
                      @foreach($alert_instance as $ind2=>$info)
                          @if($ind2 < 4)
                              <th>{{ $info }}</th>
                          @endif
                      @endforeach

                      @if($alert_instance[1] != 1)
                          <th><a href="?selected_date={{ $selected_day }}& alert_id={{ $alert_ids[$ind] }}">Details</a></th>
                      @else
                          <th><a onclick="window.open(this.href, 'preview','left=20,top=20,width=800,height=500,toolbar=1,resizable=0'); return false;" href="{{ $alert_instance[4] }}">Details</a></th>
                      @endif
                  </tr>

              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
