@extends('layouts.dashboard')

@section('content')

<!--                      Excel Table Style                           -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->
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
    .clickable, .clickable_all, truck_clickable{
      cursor:pointer;
      color: #04604e;
    }
    .clickable, .clickable_all, truck_clickable: hover{
      color: white;

    }
</style>


<!--                        Map & Summary                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<form id="form_select_tank" action="" method="get">
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
                <td class="col-xs-6" >District</td>
                <td class="col-xs-6" id="tank_data_district">{{ $tank_data_district }}</td>
              </tr>
              <tr>
                <td class="col-xs-6">Block</td>
                <td class="col-xs-6" id="tank_data_block">{{ $tank_data_block }}</td>
              </tr>
              <tr>
                <td class="col-xs-6">Zone</td>
                <td class="col-xs-6" id="tank_data_zone">{{ $tank_data_zone }}</td>
              </tr>
              <tr>
                <td class="col-xs-6">Number</td>
                <td class="col-xs-6" id="tank_data_number">{{ $tank_data_number }}</td>
              </tr>
              <tr>
                <td class="col-xs-6">Tank Fill Percentage</td>
                <td class="col-xs-6" id="tank_data_fill_per">{{ $tank_data_fill_per }}</td>
              </tr>
<!--              <tr>
                <td class="col-xs-6">Fill Rate</td>
                <td class="col-xs-6"></td>
            </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <div class="card-actions">
            <button type="button" class="card-action card-toggler" title="Collapse"></button>
          </div>
           Truck Details
        </div>
        <div class="card-body" data-toggle="match-height" style="height: 218px;">
          <table class="table table-borderless table-middle">
            <tbody>
              <tr>
                <td class="col-xs-6" >Truck Number</td>
                <td class="col-xs-6" id="truck_number"></td>
              </tr>
              <tr>
                <td class="col-xs-6">Capacity</td>
                <td class="col-xs-6" id="truck_capacity"></td>
              </tr>
              <tr>
                <td class="col-xs-6">Driver</td>
                <td class="col-xs-6" id="truck_driver"></td>
              </tr>
              <tr>
                <td class="col-xs-6">cfw</td>
                <td class="col-xs-6" id="truck_cfw"></td>
              </tr>
<!--              <tr>
                <td class="col-xs-6">Fill Rate</td>
                <td class="col-xs-6"></td>
            </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

<!--                       Fill % distribution                        -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
    <div class="col-md-12">
    <div class="card">
      <div class="card-header">
          <div class="media">
            <div class="media-middle media-body">
              <h6 class="media-heading" style="font-size: larger;">
                 Tanks fill level
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
                          <td style="width: 13%;">District</td>
                          <td style="width: 13%; text-align: left;">Zone</td>
                          <td style="width: 7%;">Cutoff</td>
                          <td  style="width: 19%;"><a class="clickable_all" id="all_1"> Greater than 100%</a><span  style="visibility:hidden" id="close_1"  class="icon icon-close closee"/></td>
                          <td  style="width: 13%;"><a class="clickable_all" id="all_2">80% to 100%</a><span  style="visibility:hidden" id="close_2" class="icon icon-close closee"/></td>
                          <td  style="width: 13%;"><a class="clickable_all" id="all_3"> 60% to 80%</a><span  style="visibility:hidden" id="close_3" class="icon icon-close closee"/></td>
                          <td style="width: 22%;"><a class="clickable_trucks" >Assigned Trucks</a><span  style="visibility:hidden" id="close_all_trucks" class="icon icon-close closee"/></td>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($fill_per_distr as $ind=>$fill_per)
                          <tr class="excel">
                              <td>{{ number_format($fill_per->district, 0) }}</td>
                              <td style="text-align: left;">{{ number_format($fill_per->zone, 0) }}</td>
                              <td>{{ $fill_per->cutoff }}</td>
                              <td>
                                <a style="margin-right:40px" class="clickable" id = {{ number_format($fill_per->district, 0) . "-" . $fill_per->zone ."-1"  }}> {{ $fill_per->p100 }}
                                </a>
                                <span  style="visibility:hidden" id={{ "close" . number_format($fill_per->district, 0) . "-" . $fill_per->zone ."-1"  }} class="icon icon-close closee"/></td>
                              <td>
                                <a style="margin-right:40px" class="clickable" id = {{ number_format($fill_per->district, 0) . "-" . $fill_per->zone ."-2"  }}> {{ $fill_per->p80 }}
                                </a>
                                <span  style="visibility:hidden" id={{ "close" . number_format($fill_per->district, 0) . "-" . $fill_per->zone ."-2"  }} class="icon icon-close closee"/></td>
                              <td>
                                <a style="margin-right:40px" class="clickable" id = {{ number_format($fill_per->district, 0) . "-" . $fill_per->zone ."-3"  }}> {{ $fill_per->p60 }}
                                 </a>
                                 <span style="visibility:hidden" id={{ "close" . number_format($fill_per->district, 0) . "-" . $fill_per->zone ."-3"  }} class="icon icon-close closee"/></td>
                              <td>
                                @foreach($fill_per->trucks as $ind => $tr)
                                <span class="truck_clickable" id= {{ "truck_" . $tr}}>{{$tr}}</span>
                                @endforeach
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                  <tfoot class="excel">
                      <tr class="excel">
                          <td>Total</td>
                          <td></td>
                          <td></td>
                          <td>{{ $fill_per_sum->p100 }}</td>
                          <td>{{ $fill_per_sum->p80 }}</td>
                          <td>{{ $fill_per_sum->p60 }}</td>
                          <td>{{ $fill_per_sum->trucks }}</td>
                      </tr>
                  </tfoot>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    function submit_form_with_district(dist) {
        document.getElementById('page_selected_district').value = parseInt(dist);
        document.getElementById('form_select_district').submit();
    }

    function submit_form_with_tank(tank_id) {
      $.ajax({
               type:'GET',
               url:'/dashboard/tank_details?page_selected_tank_id='+tank_id,
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data){
                 $("#tank_data_district").html(data.tank_data_district);
                 $("#tank_data_block").html(data.tank_data_block);
                 $("#tank_data_zone").html(data.tank_data_zone);
                 $("#tank_data_number").html(data.tank_data_number);
                 $("#tank_data_fill_per").html(Number(Math.round(data.tank_data_fill_per+'e2')+'e-2')+"%");
               }
            });
    }

    var min_distance_not_pip = 0.0000023315914999942545;
    var pip = {lat: 32.28820167, lng: 36.31507};
    var prev_marker = null;
    var prev_marker_icon = null;

    var prev_truck_marker = null;
    var prev_truck_icon = null;

    var curr_at_pip = false;
    var trip_number = 0;
    var map;
    var start = 0;
    var end = 0;
    var all_markers_latlng = [
        @foreach($tank_locations as $ind => $loc)
        {lat: {{$loc->lat}}, lng: {{$loc->long}}}
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var all_markers = [];
    var truck_markers = [];
    var marker_ids = [
        @foreach($tank_locations as $ind => $loc)
        '{{ $loc->tank_id }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var truck_ids = [
        @foreach($truck_ids as $ind => $id)
        '{{ $ind }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var truck_numbers = [
        @foreach($truck_numbers as $ind => $id)
        '{{ $id }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var truck_capacities = [
        @foreach($truck_capacities as $ind => $id)
        '{{ $id }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var truck_cfws = [
        @foreach($truck_cfws as $ind => $id)
        '{{ $id }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var truck_drivers = [
        @foreach($truck_drivers as $ind => $id)
        '{{ $id }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var trucks_latlng = [
        @foreach($truck_locs as $ind => $loc)
        {lat: {{$loc->lat}}, lng: {{$loc->long}}}
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];

    var marker_fill_per = [
        @foreach($tank_locations as $ind => $loc)
        '{{ $loc->fill_per }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var marker_districts = [
        @foreach($tank_locations as $ind => $loc)
        '{{ $loc->district }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];
    var marker_zones = [
        @foreach($tank_locations as $ind => $loc)
        '{{ $loc->zone }}'
        @if($ind !== count($tank_locations) -1) , @endif
        @endforeach
    ];


    function tilesLoaded() {
        google.maps.event.clearListeners(map, 'tilesloaded');
        google.maps.event.addListener(map, 'zoom_changed', saveMapState);
        google.maps.event.addListener(map, 'dragend', saveMapState);
    }


    function loadMapState() {

        var gotCookieString = getCookie("heatmap_state_cookie");
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
        setCookie("heatmap_state_cookie",cookiestring);
    }


    function load_map() {


        $('#tank_map').height($('#tank_map').width() * 0.4 + 'px')
        var centerv = {lat: 32.29097333333333, lng: 36.32356666666667};

         map = new google.maps.Map(document.getElementById('tank_map'), {
            zoom: 14,
            center: centerv,
            rotation: Math.PI / 6,
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
        // var path = "{{ URL::asset('/imgs') }}"+"/"; //local markers
        var path = "http://maps.google.com/mapfiles/ms/icons/"; //old path
        var icon_click_link = path + 'blue.png';
        for(var i = 0; i < truck_ids.length; i++){

          icon_link = "{{ URL::asset('/imgs') }}"+"/truck.png";
          var icon = {
              url: icon_link, // url
              scaledSize: new google.maps.Size(20, 20), // scaled size
          };
          
          var curr_marker = new google.maps.Marker({
              icon: icon,
              position: trucks_latlng[i]
          });
          curr_marker.marker_id = truck_ids[i];
          curr_marker.addListener('click', function() {
            if(prev_truck_marker!=null){
              prev_truck_marker.setIcon(prev_truck_icon);
            }
            prev_truck_marker = this;
            prev_truck_icon = this.getIcon();
            var icon_click = {
              url: "{{ URL::asset('/imgs') }}"+"/truck_selected.png",
              scaledSize: new google.maps.Size(20, 20), // scaled size
            }
            this.setIcon(icon_click);
            document.getElementById("truck_number").innerHTML  = truck_numbers[this.marker_id];
            document.getElementById("truck_capacity").innerHTML  =  truck_capacities[this.marker_id];
            document.getElementById("truck_driver").innerHTML  =  truck_drivers[this.marker_id];
            document.getElementById("truck_cfw").innerHTML  = truck_cfws[this.marker_id];

          });
          curr_marker.setMap(map);
          curr_marker.setVisible(false);
          truck_markers.push(curr_marker);
        }
        for(var i = 0; i < all_markers_latlng.length; i++) {
                icon_link = path + 'yellow.png'; //"/imgs/60_new.png";
            if(marker_fill_per[i] > 100) {
                icon_link = path + 'red.png'; //"/imgs/80_new.png";
            } else if(marker_fill_per[i] > 80) {
                icon_link = path + 'orange.png'; //"/imgs/100_new.png";
            }

            var icon = {
                url: icon_link, // url
                scaledSize: new google.maps.Size(20, 20), // scaled size
            };

            var curr_marker = new google.maps.Marker({
                icon: icon,
                position: all_markers_latlng[i]
            });
            curr_marker.marker_id = marker_ids[i];
            curr_marker.addListener('click', function() {
                if(prev_marker!=null){
                  prev_marker.setIcon(prev_marker_icon);
                }
                prev_marker = this;
                prev_marker_icon = this.getIcon();
                var icon_click = {
                  url: icon_click_link,
                  scaledSize: new google.maps.Size(20, 20), // scaled size
                }
                this.setIcon(icon_click);
                submit_form_with_tank(this.marker_id);
            });
            curr_marker.setMap(map);
            all_markers.push(curr_marker);
        }
        loadMapState();
    }

</script>
<script>
$(document).ready(function(){
    $(".clickable").click(function(){
      var id = $(this).attr('id');
      $(".icon-close").css("visibility", "hidden");
      $("#close"+id).css("visibility", "visible");

      var district = id.split("-")[0];
      var zone = id.split("-")[1];
      var level = id.split("-")[2];
      for(var i = 0; i < all_markers.length; i++) {
            all_markers[i].setVisible(true);
      }
      for(var i = 0; i < truck_markers.length; i++){
        truck_markers[i].setVisible(false);
      }
      for(var i = 0; i < all_markers.length; i++) {
        // district
        if(marker_districts[i] != district)all_markers[i].setVisible(false);
        // zones
        if(marker_zones[i] != zone)all_markers[i].setVisible(false);

        // levels
        if(level == 1 && marker_fill_per[i] <= 100) all_markers[i].setVisible(false);
        if(level == 2 && (marker_fill_per[i] >= 100 || marker_fill_per[i] <=80)) all_markers[i].setVisible(false);
        if(level == 3 && (marker_fill_per[i] >= 80 || marker_fill_per[i] <=60)) all_markers[i].setVisible(false);


      }
    });
    $(".clickable_all").click(function(){
      var id = $(this).attr('id');
      $(".icon-close").css("visibility", "hidden");
      $("#close"+id).css("visibility", "visible");

      var level = id.split("_")[1];
      $(".icon-close").css("visibility", "hidden");
      $("#close_"+level).css("visibility", "visible");
      for(var i = 0; i < all_markers.length; i++) {
            all_markers[i].setVisible(true);
      }
      for(var i = 0; i < all_markers.length; i++) {

        // levels
        if(level == 1 && marker_fill_per[i] <= 100) all_markers[i].setVisible(false);
        if(level == 2 && (marker_fill_per[i] >= 100 || marker_fill_per[i] <=80)) all_markers[i].setVisible(false);
        if(level == 3 && (marker_fill_per[i] >= 80 || marker_fill_per[i] <=60)) all_markers[i].setVisible(false);


      }
      for(var i = 0; i < truck_markers.length; i++){
        truck_markers[i].setVisible(false);
      }
    });

    $(".closee").click(function(){
      $(this).css("visibility", "hidden");
      for(var i = 0; i < all_markers.length; i++) {
            all_markers[i].setVisible(true);
      }
      for(var i = 0; i < truck_markers.length; i++){
        truck_markers[i].setVisible(false);
      }
    });


    $(".truck_clickable").click(function(){


    });
    $(".clickable_trucks").click(function(){
      //hide all tanks
      for(var i = 0; i < all_markers.length; i++) {
            all_markers[i].setVisible(false);
      }

      //show all trucks
      for(var i = 0; i < truck_markers.length; i++){
        truck_markers[i].setVisible(true);
      }
      $(".icon-close").css("visibility", "hidden");
      $("#close_all_trucks").css("visibility", "visible");
    });
});
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp3oeV3i5tiCbfYRFu_AGw2ldnut8Iryc&callback=load_map" type="text/javascript"></script>

@endsection
