@extends('layouts.dashboard')

@section('content')

<!--                        Limiters Selection                        -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-xs-12">
        <div class="form-group">
          <label class="col-sm-2 control-label" style="text-align: center;">District</label>
          <label class="col-sm-2 control-label" style="text-align: center;">Block</label>
          <label class="col-sm-2 control-label" style="text-align: center;">Number</label>
          <label class="col-sm-2 control-label" style="text-align: center;">Tank Type</label>
          <label class="col-sm-2 control-label" style="text-align: center;">Fill Rate</label>
      </div>
    </div>
</div>
<div class="row gutter-xs">
    <div class="col-xs-12">
        <form id="limiter_form" action="" method="get">
            <div class="form-group">
              @for($limiter = 0; $limiter < 5; $limiter++)
                  <select class="col-sm-2 control-label" style="text-align: center; padding: 6px 12px;" name="page_selected_limiter_{{ $limiter }}">
                      @for($i = 0; $i < count($page_limiter_val[$limiter]); $i++)
                          <option value="{{ $page_limiter_val[$limiter][$i] }}" @if($page_limiter_val[$limiter][$i] == $page_selected_limiter[$limiter]) selected @endif>
                              {{ $page_limiter_disp[$limiter][$i] }}
                          </option>
                      @endfor
                  </select>
              @endfor
              <button class="btn btn-primary col-sm-2" style="width: 10%" onclick="document.getElementById('limiter_form').submit();"> Submit </button>
          </div>
      </form>
    </div>
</div>
<br/>

<!--                        Map & Summary                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<form id="form_select_tank" action="" method="get">
    @for($limiter = 0; $limiter < 5; $limiter++)
    <input type="hidden" name="page_selected_limiter_{{ $limiter }}" value="{{ $page_selected_limiter[$limiter] }}">
    @endfor
    <input type="hidden" id="page_selected_tank_id" name="page_selected_tank_id" value="{{ $page_selected_tank_id }}" />
</form>
<div class="row gutter-xs">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
              <div class="card-actions">
                <button type="button" class="card-action card-toggler" title="Collapse"></button>
              </div>
               Tanks (Select one to view data)
            </div>
            <div class="card-body">
                <div class="row">
                    <div id="tank_map" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <div class="card-actions">
            <button type="button" class="card-action card-toggler" title="Collapse"></button>
          </div>
           Tank Details
        </div>
        <div class="card-body" data-toggle="match-height" style="height: 218px;">
          <table class="table table-borderless table-middle">
            <tbody>
              <tr>
                <td class="col-xs-6">District</td>
                <td class="col-xs-6" id="tank_data_district">{{ $tank_data_district }}</td>
              </tr>
              <tr>
                <td class="col-xs-6">Block</td>
                <td class="col-xs-6" id="tank_data_block">{{ $tank_data_block }}</td>
              </tr>
              <tr>
                <td class="col-xs-6">Number</td>
                <td class="col-xs-6" id="tank_data_number">{{ $tank_data_number }}</td>
              </tr>
              <tr>
                <td class="col-xs-6">Tank Type</td>
                <td class="col-xs-6" id="tank_data_type">{{ $tank_data_tank_type }}</td>
              </tr>
              <tr>
                <td class="col-xs-6">Fill Rate (daily)</td>
                <td class="col-xs-6" id="tank_data_fill_rate">{{ $tank_data_fill_rate }}</td>
              </tr>
            </tbody>
          </table>
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
         All events related to this tank
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

<!--                        Comments Table                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">
        <div class="card-actions">
          <button type="button" class="card-action card-toggler" title="Collapse"></button>
        </div>
         All comments related to this tank
      </div>
      <div class="card-body">
        <table id="demo-datatables-5" data-length-menu='[[10, 25, 50, 100, -1], ["10", "25", "50", "100", "All"]]' class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
                @foreach($comments_req_cols as $col)
                    <th>{{ sanitize_static_names($col) }}</th>
                @endforeach
            </tr>
          </thead>
          <tfoot>
              <tr>
                  @foreach($comments_req_cols as $col)
                      <th>{{$col}}</th>
                  @endforeach
              </tr>
          </tfoot>
          <tbody>
              @foreach($comments_response as $comment)
                  <tr>
                  @foreach($comments_req_cols as $col)
                      <th>{{$comment->{$col} }}</th>
                  @endforeach
                </tr>
              @endforeach
          </tbody>
        </table>
        <div class="cent">
          <button class="btn btn-success" onclick="export_data('demo-datatables-5')">Export Data</button>
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
<script></script>
<script>
    function submit_form_with_district(dist) {
        document.getElementById('page_selected_district').value = parseInt(dist);
        document.getElementById('form_select_district').submit();
    }
    function submit_form_with_tank(tank_id) {
      $.ajax({
               type:'GET',
               url:'/dashboard/tank_details2?page_selected_tank_id='+tank_id,
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data){
                 $("#tank_data_district").html(data.tank_data_district);
                 $("#tank_data_block").html(data.tank_data_block);
                 $("#tank_data_zone").html(data.tank_data_zone);
                 $("#tank_data_number").html(data.tank_data_number);
                 $("#tank_data_type").html(data.tank_data_tank_type);
                 $("#tank_data_fill_rate").html(Number(Math.round(data.tank_data_fill_rate+'e2')+'e-2')+"%");
               }
            });
    }
    var min_distance_not_pip = 0.0000023315914999942545;
    var pip = {lat: 32.28820167, lng: 36.31507};
    var curr_at_pip = false;
    var prev_marker = null;
    var prev_marker_icon = null;
    var trip_number = 0;
    var map;
    var start = 0;
    var end = 0;
    var all_markers_latlng = [
        @foreach($tank_locations as $ind => $loc)
        {lat: {{$loc[1]}}, lng: {{$loc[0]}}}
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var all_markers = [];
    var marker_ids = [
        @foreach($tank_locations as $ind => $loc)
        '{{ $loc[2] }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    function tilesLoaded() {
        google.maps.event.clearListeners(map, 'tilesloaded');
        google.maps.event.addListener(map, 'zoom_changed', saveMapState);
        google.maps.event.addListener(map, 'dragend', saveMapState);
    }
        function loadMapState() {
            var gotCookieString = getCookie("map_state_cookie");
            var splitStr =  gotCookieString.split("_");
            var savedMapLat = parseFloat(splitStr[0]);
            var savedMapLng = parseFloat(splitStr[1]);
            var savedMapZoom = parseFloat(splitStr[2]);
            if ((!isNaN(savedMapLat)) && (!isNaN(savedMapLng)) && (!isNaN(savedMapZoom))) {
                map.setCenter(new google.maps.LatLng(savedMapLat,savedMapLng));
                map.setZoom(savedMapZoom);
            }
        }
        function setCookie(cname, cvalue, exdays) {
          var d = new Date();
          d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
          var expires = "expires="+d.toUTCString();
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        // functions below
        function saveMapState() {
            var mapZoom=map.getZoom();
            var mapCentre=map.getCenter();
            var mapLat=mapCentre.lat();
            var mapLng=mapCentre.lng();
            var cookiestring=mapLat+"_"+mapLng+"_"+mapZoom;
            setCookie("map_state_cookie",cookiestring);
        }
    function load_map() {
        $('#tank_map').height($('#tank_map').width() * 0.4 + 'px')
        var centerv = {lat: 32.29097333333333, lng: 36.32356666666667};
         map = new google.maps.Map(document.getElementById('tank_map'), {
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
             maxZoom: 21
         }));
         google.maps.event.addListener(map, 'tilesloaded', tilesLoaded);
        add_all_markers();
    }
    function add_all_markers() {
        var icon = {
          url: "/imgs/tanks.png",
          scaledSize: new google.maps.Size(20, 30), // scaled size
          // url: 'http://maps.google.com/mapfiles/ms/icons/red.png',
          // scaledSize: new google.maps.Size(50, 50), // scaled size
        };
        var icon_click = {
         url: "/imgs/tanks_selected.png",
        scaledSize: new google.maps.Size(20, 30), // scaled size
          // url : 'http://maps.google.com/mapfiles/ms/icons/blue.png',
          // scaledSize: new google.maps.Size(50, 50), // scaled size
        };
        for(var i = 0; i < all_markers_latlng.length; i++) {
            var curr_marker = new google.maps.Marker({
              position: all_markers_latlng[i],
              icon: icon
            });
            curr_marker.marker_id = marker_ids[i];
            curr_marker.addListener('click', function() {
              if(prev_marker!=null){
                prev_marker.setIcon(prev_marker_icon);
              }
              prev_marker = this;
              prev_marker_icon = this.getIcon();
              this.setIcon(icon_click);
              submit_form_with_tank(this.marker_id);
            });
            curr_marker.setMap(map);
            all_markers.push(curr_marker);
        }
        loadMapState();
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp3oeV3i5tiCbfYRFu_AGw2ldnut8Iryc&callback=load_map" type="text/javascript"></script>

@endsection
