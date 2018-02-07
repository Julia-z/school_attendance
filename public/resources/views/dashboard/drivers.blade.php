@extends('layouts.dashboard')

@section('content')

<!--                       Day & Driver Selector                      -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-xs-12">
        <div class="form-group">
          <label class="col-sm-3 control-label" for="nothing" style="text-align: center;"></label>
          <label class="col-sm-2 control-label" style="text-align: center;">Day</label>
          <label class="col-sm-2 control-label" style="text-align: center; visibility: hidden;">Driver</label>
          <label class="col-sm-2 control-label" style="text-align: center;">Truck</label>
      </div>
    </div>
</div>
<div class="row gutter-xs">
    <div class="col-xs-12">
        <div class="form-group">
            <form id="driver_select_form" action="" method="get">
                <label class="col-sm-3 control-label" for="nothing"></label>
                <div class="col-sm-2">
                    <div class="input-with-icon">
                        <input class="form-control" type="text" data-provide="datepicker" data-date-today-btn="linked" id="page_selected_day" name="page_selected_day" value="{{ $page_selected_day }}" onchange="consume_first_on_click();"/>
                        <span class="icon icon-calendar input-icon"></span>
                    </div>
                </div>

                <div class="col-sm-2" style="visibility: hidden;">
                    <select id="page_driver_id" name="page_driver_id" class="form-control" @if(!$page_is_date_selected) disabled @endif onchange="document.getElementById('driver_select_form').submit()">
                        @foreach($page_all_drivers as $driver)
                            <option value="{{$driver->driver_user_id}}" @if($page_selected_driver == $driver->driver_user_id) selected @endif>
                                {{ app\Http\ORM\SystemUsers::get_by_id($driver->driver_user_id) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-2">
                    <select id="page_truck_id" name="page_truck_id" class="form-control" @if(!$page_is_date_selected) disabled @endif onchange="document.getElementById('driver_select_form').submit()">
                        @foreach($page_all_trucks as $truck)
                            <option value="{{ $truck }}" @if($page_selected_truck == $truck) selected @endif>
                                {{ app\Http\ORM\Truck::get_by_id($truck) }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>
    </div>
</div>
<br/>

<!--                        Map & Summary                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                 Truck Route
            </div>

            <div class="card-body">
                <div class="row">
                    <div id="truck_map" style="height: 400px;"></div>
                </div>
                <br/>
                <div class="row" style="padding-left: 20px; padding-right: 20px;">
                    <div class="slider slider-circle" data-slider="danger" data-start="10" data-target="#map_slider_target"></div>
                    <select id="start_time" style="float: left;">
                        <option value="6:00">6:00 am</option>
                        <option value="6:15">6:15 am</option>
                        <option value="6:30">6:30 am</option>
                        <option value="6:45">6:45 am</option>
                        <option value="7:00" selected>7:00 am</option>
                        <option value="7:15">7:15 am</option>
                        <option value="7:30">7:30 am</option>
                        <option value="7:45">7:45 am</option>
                        <option value="8:00">8:00 am</option>
                        <option value="8:15">8:15 am</option>
                        <option value="8:30">8:30 am</option>
                        <option value="8:45">8:45 am</option>
                        <option value="9:00">9:00 am</option>
                        <option value="9:15">9:15 am</option>
                        <option value="9:30">9:30 am</option>
                        <option value="9:45">9:45 am</option>
                        <option value="10:00">10:00 am</option>
                        <option value="10:15">10:15 am</option>
                        <option value="10:30">10:30 am</option>
                        <option value="10:45">10:45 am</option>
                        <option value="11:00">11:00 am</option>
                        <option value="11:15">11:15 am</option>
                        <option value="11:30">11:30 am</option>
                        <option value="11:45">11:45 am</option>
                        <option value="12:00">12:00 pm</option>
                        <option value="12:15">12:15 pm</option>
                        <option value="12:30">12:30 pm</option>
                        <option value="12:45">12:45 pm</option>
                        <option value="13:00">1:00 pm</option>
                        <option value="13:15">1:15 pm</option>
                        <option value="13:30">1:30 pm</option>
                        <option value="13:45">1:45 pm</option>
                        <option value="14:00">2:00 pm</option>
                        <option value="14:15">2:15 pm</option>
                        <option value="14:30">2:30 pm</option>
                        <option value="14:45">2:45 pm</option>
                        <option value="15:00">3:00 pm</option>
                        <option value="15:15">3:15 pm</option>
                        <option value="15:30">3:30 pm</option>
                        <option value="15:45">3:45 pm</option>
                        <option value="16:00">4:00 pm</option>
                        <option value="16:15">4:15 pm</option>
                        <option value="16:30">4:30 pm</option>
                        <option value="16:45">4:45 pm</option>
                        <option value="17:00">5:00 pm</option>
                        <option value="17:15">5:15 pm</option>
                        <option value="17:30">5:30 pm</option>
                        <option value="17:45">5:45 pm</option>
                        <option value="18:00">6:00 pm</option>
                        <option value="18:15">6:15 pm</option>
                        <option value="18:30">6:30 pm</option>
                        <option value="18:45">6:45 pm</option>
                    </select>

                    <select id="end_time" style="float: right;">
                        <option value="6:00">6:00 am</option>
                        <option value="6:15">6:15 am</option>
                        <option value="6:30">6:30 am</option>
                        <option value="6:45">6:45 am</option>
                        <option value="7:00">7:00 am</option>
                        <option value="7:15">7:15 am</option>
                        <option value="7:30">7:30 am</option>
                        <option value="7:45">7:45 am</option>
                        <option value="8:00">8:00 am</option>
                        <option value="8:15">8:15 am</option>
                        <option value="8:30">8:30 am</option>
                        <option value="8:45">8:45 am</option>
                        <option value="9:00">9:00 am</option>
                        <option value="9:15">9:15 am</option>
                        <option value="9:30">9:30 am</option>
                        <option value="9:45">9:45 am</option>
                        <option value="10:00">10:00 am</option>
                        <option value="10:15">10:15 am</option>
                        <option value="10:30">10:30 am</option>
                        <option value="10:45">10:45 am</option>
                        <option value="11:00">11:00 am</option>
                        <option value="11:15">11:15 am</option>
                        <option value="11:30">11:30 am</option>
                        <option value="11:45">11:45 am</option>
                        <option value="12:00">12:00 pm</option>
                        <option value="12:15">12:15 pm</option>
                        <option value="12:30">12:30 pm</option>
                        <option value="12:45">12:45 pm</option>
                        <option value="13:00">1:00 pm</option>
                        <option value="13:15">1:15 pm</option>
                        <option value="13:30">1:30 pm</option>
                        <option value="13:45">1:45 pm</option>
                        <option value="14:00">2:00 pm</option>
                        <option value="14:15">2:15 pm</option>
                        <option value="14:30">2:30 pm</option>
                        <option value="14:45">2:45 pm</option>
                        <option value="15:00">3:00 pm</option>
                        <option value="15:15">3:15 pm</option>
                        <option value="15:30">3:30 pm</option>
                        <option value="15:45">3:45 pm</option>
                        <option value="16:00" selected>4:00 pm</option>
                        <option value="16:15">4:15 pm</option>
                        <option value="16:30">4:30 pm</option>
                        <option value="16:45">4:45 pm</option>
                        <option value="17:00">5:00 pm</option>
                        <option value="17:15">5:15 pm</option>
                        <option value="17:30">5:30 pm</option>
                        <option value="17:45">5:45 pm</option>
                        <option value="18:00">6:00 pm</option>
                        <option value="18:15">6:15 pm</option>
                        <option value="18:30">6:30 pm</option>
                        <option value="18:45">6:45 pm</option>
                    </select>

                    <input type="hidden" id="map_slider_target" value="10" onchange="redraw_markers()"/>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
      <div class="card-header">
         Tasks Completed
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 m-y">
            <ul class="list-group list-group-divided">
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Number of Requested Batches</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ $number_of_batches }}
                    </h4>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Number of Assigned Tasks</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ $number_of_assigned_tasks }}
                    </h4>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Number of Completed Tasks</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ $number_of_completed_tasks }}
                    </h4>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Zones</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ $zones }}
                    </h4>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="media-middle media-body">
                    <h6 class="media-heading"> <span style="font-size: 180%;">
                      <span class="text-muted">Total Volume</span>
                    </span></h6>
                    <h4 class="media-heading"> {{ $volume }} m<sup>3</sup>
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

<!--                         Events Table                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">
        <div class="card-actions">
          <button type="button" class="card-action card-toggler" title="Collapse"></button>
        </div>
         All events related to driver on this day
      </div>
      <div class="card-body">
        <table id="demo-datatables-4" data-length-menu='[[10, 25, 50, 100, -1], ["10", "25", "50", "100", "All"]]' class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
                @foreach($events_req_cols as $col)
                    <th>{{ sanitize_static_names($col) }}</th>
                @endforeach
            </tr>
          </thead>
          <tfoot>
              <tr>
                  @foreach($events_req_cols as $col)
                      <th>{{$col}}</th>
                  @endforeach
              </tr>
          </tfoot>
          <tbody>
              @foreach($events_response as $event)
                  <tr>
                  @foreach($events_req_cols as $col)
                      <th>{{$event->{$col} }}</th>
                  @endforeach
                </tr>
              @endforeach
          </tbody>
        </table>
        <div class="cent">
          <button class="btn btn-success"  onclick="export_data('demo-datatables-4')">Export Data</button>
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


@endsection

@section('scripts')

<script>
    var min_distance_not_pip = 0.0000023315914999942545;
    var pip = {lat: 32.28820167, lng: 36.31507};
    var curr_at_pip = false;
    var trip_number = 0;
    var material_colors = [
        '#f44336',
        '#e91e63',
        '#9c27b0',
        '#673ab7',
        '#3f51b5',
        '#2196f3',
        '#03a9f4',
        '#00bcd4',
        '#009688',
        '#4caf50',
        '#8bc34a',
        '#cddc39',
        '#ffeb3b',
        '#ffc107',
        '#ff9800',
        '#ff5722',
        '#795548',
        '#9e9e9e',
        '#607d8b'
    ];
    var images = [
        'http://slashh.emadyehya.com/js/marker1.png',
        'http://slashh.emadyehya.com/js/marker2.png',
        'http://slashh.emadyehya.com/js/marker3.png',
        'http://slashh.emadyehya.com/js/marker4.png',
        'http://slashh.emadyehya.com/js/marker5.png',
        'http://slashh.emadyehya.com/js/marker6.png',
        'http://slashh.emadyehya.com/js/marker7.png',
        'http://slashh.emadyehya.com/js/marker8.png',
        'http://slashh.emadyehya.com/js/marker9.png',
        'http://slashh.emadyehya.com/js/marker10.png'
    ]
    var map;
    var start = 0;
    var end = 0;
    var all_markers = []
    var poss = [
        @foreach($map_locations as $ind => $loc)
        {lat: {{$loc->latitude}}, lng: {{$loc->longitude}}}
        @if($ind !== count($map_locations) -1) , @endif
        @endforeach
    ]
    var times = [
        @foreach($map_locations as $ind => $loc)
            {{ $loc->hms }}
            @if($ind !== count($map_locations) -1) , @endif
            @endforeach
            ]
            var markers_on = []

            function clear_with_id(id) {
                document.getElementById(id).value = '';
            }

            function euclid_distance_2(fst, scd) {
                return (fst.lat - scd.lat)*(fst.lng - scd.lng);
            }

            function load_map() {
                MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

                var trackChange = function(element) {
                    var observer = new MutationObserver(function(mutations, observer) {
                        if(mutations[0].attributeName == "value") {
                            $(element).trigger("change");
                        }
                    });
                    observer.observe(element, {
                        attributes: true
                    });
                }

                // Just pass an element to the function to start tracking
                trackChange( $("input[id='map_slider_target']")[0] );

                var centerv = {lat: 32.29097333333333, lng: 36.32356666666667};

                map = new google.maps.Map(document.getElementById('truck_map'), {
                    zoom: 14,
                    center: centerv,
                    mapTypeId: "OSM",
                    mapTypeControl: false,
                    streetViewControl: false
                });

                map.mapTypes.set("OSM", new google.maps.ImageMapType({
                    getTileUrl: function(coord, zoom) {
                        // "Wrap" x (logitude) at 180th meridian properly
                        // NB: Don't touch coord.x because coord param is by reference, and changing its x property breakes something in Google's lib
                        var tilesPerGlobe = 1 << zoom;
                        var x = coord.x % tilesPerGlobe;
                        if (x < 0) {
                            x = tilesPerGlobe+x;
                        }
                        // Wrap y (latitude) in a like manner if you want to enable vertical infinite scroll

                        return "http://tile.openstreetmap.org/" + zoom + "/" + x + "/" + coord.y + ".png";
                    },
                    tileSize: new google.maps.Size(256, 256),
                    name: "OpenStreetMap",
                    maxZoom: 16
                }));
                add_all_markers();
            }

            function add_all_markers() {

                for(var i = 0; i < poss.length; i++) {
                    if(curr_at_pip && euclid_distance_2(poss[i], pip) > min_distance_not_pip) {
                        //we are on next trip
                        if(trip_number < 9) { trip_number++;}
                        curr_at_pip = false;
                    }

                    if(!curr_at_pip && euclid_distance_2(poss[i], pip) < min_distance_not_pip) {
                        curr_at_pip = true;
                    }

                    console.log(images[trip_number]);

                    all_markers.push(new google.maps.Marker({position: poss[i], icon: images[trip_number], optimized: false, zIndex: i}));
                    markers_on.push(false);
                }
            }

            function show_markers_range(range_s, range_e) {
                for(var i = 0; i < all_markers.length; i++) {
                    // if the time is within the range, it should be on.
                    if(times[i] >= range_s && times[i] <= range_e) {
                        // is it on?
                        if(!markers_on[i]) {
                            // turn it on
                            all_markers[i].setMap(map);
                            markers_on[i] = true;
                        }
                    } else {
                        // should be off
                        if(markers_on[i]) {
                            all_markers[i].setMap(null);
                            markers_on[i] = false;
                        }
                    }
                }
            }


            function redraw_markers() {
                // change start and end.
                var start_s = document.getElementById('start_time').value.split(':');
                start = parseInt(start_s[0])*3600 + parseInt(start_s[1])*60;
                var end_s = document.getElementById('end_time').value.split(':');
                end = parseInt(end_s[0])*3600 + parseInt(end_s[1])*60;
                var perc = document.getElementById('map_slider_target').value;
                var eff_change = (end-start)*perc/100.0;
                console.log(start + " " + end + " " + perc + " " +eff_change);
                show_markers_range(start, start+eff_change);
            }


            first_consumed = false;
            function consume_first_on_click() {
                if(first_consumed) {
                    document.getElementById('driver_select_form').submit();
                } else {
                    first_consumed = true;
                }
            }


        </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp3oeV3i5tiCbfYRFu_AGw2ldnut8Iryc&callback=load_map"type="text/javascript"></script>


@endsection
