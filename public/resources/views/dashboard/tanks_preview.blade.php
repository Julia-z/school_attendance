<div id="tank_map" style="width: 100%; height: 100%;"></div>
<div id="legend"><h3>Legend</h3></div>
<style>
html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
      }
      #tank_map {
        height: 400px;
        width: 100%;
      }
      #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #AAA;
      }
      #legend h3 {
        margin-top: 0;
      }
      #legend img {
        vertical-align: middle;
        margin: 5px;
      }
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    var all_markers_icons = ['/imgs/add.png', '/imgs/60_new.png', '/imgs/80_new.png', '/imgs/100_new.png', '/imgs/60_fin.png',  '/imgs/80_fin.png', '/imgs/100_fin.png'];
    var all_markers_names = ['Added Task', '< 80%', '80%-100%', '> 100%', '< 80% done', '80%-100% done', '> 100% done'];
    var all_markers_found = [0, 0, 0, 0, 0, 0, 0];

    var all_markers_latlng = [
        @foreach($task_data as $ind => $data)
        {lat: {{$data->lat}}, lng: {{$data->lon}}}
        @if($ind !== count($task_data) -1) , @endif
        @endforeach
    ];
    var all_markers = [];
    var marker_added = [
        @foreach($task_data as $ind => $data)
        {{ $data->added }}
        @if($ind !== count($task_data) -1) , @endif
        @endforeach
    ];
    var marker_fill = [
        @foreach($task_data as $ind => $data)
        '{{ $data->fill_level }}'
        @if($ind !== count($task_data) -1) , @endif
        @endforeach
    ];
    var marker_done = [
        @foreach($task_data as $ind => $data)
        '{{ $data->done }}'
        @if($ind !== count($task_data) -1) , @endif
        @endforeach
    ];
    var marker_name = [
        @foreach($task_data as $ind => $data)
        '{{ $data->tank_name }}'
        @if($ind !== count($task_data) -1) , @endif
        @endforeach
    ];
    function load_map() {
//        google.maps.event.addListener(map, 'tilesloaded', tilesLoaded);
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
        add_all_markers();
        var legend = document.getElementById('legend');
        for (var i =0; i< 7; i++) {
          if(all_markers_found[i] == 0){
      //    var type = icons[key];
            var name = all_markers_names[i];//type.name;
            var icon = all_markers_icons[i];//"http://maps.google.com/mapfiles/ms/icons/green.png";//type.icon;
            var div = document.createElement('div');
            div.innerHTML = '<img width=10 src="' + icon + '"> ' + name;
          legend.appendChild(div);
        }
      }
      //  }
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
    }
    function add_all_markers() {
        for(var i = 0; i < all_markers_latlng.length; i++) {
            if(marker_added[i] == 1) {
                icon_link = "/imgs/add.png";
            } else {
                icon_link = "/imgs/" + marker_fill[i] + "_" + marker_done[i] + ".png";
            }
            console.log(icon_link);
            var icon = {
                url: icon_link, // url
                scaledSize: new google.maps.Size(24, 50), // scaled size
            };
            var curr_marker = new google.maps.Marker({
                icon: icon,
                title: marker_name[i],
                position: all_markers_latlng[i]
            });
            curr_marker.setMap(map);
            all_markers.push(curr_marker);
        }
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp3oeV3i5tiCbfYRFu_AGw2ldnut8Iryc&callback=load_map" type="text/javascript"></script>
