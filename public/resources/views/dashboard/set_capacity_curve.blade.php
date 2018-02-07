@extends('layouts.dashboard')

@section('content')

<style>
    .zone {
        float: left;
        width: 45%;
        margin-right: 4%;
    }

    .zone_info {
        width: 30%;
        float: left;
    }

    .zone_input {
        text-align: center;
    }
</style>
<br/>
<form id="main_form" method="post" action="">
    <h3>Phase 1 Constants</h3>
    <div class="inside">
        <span class="zone">
            <span class="zone_info">Initial volume at 7am: &nbsp;&nbsp; </span>
            <input class="zone_input" type="text" name="zwwtp_b_1" id="zwwtp_b_1" value="{{ $all_info['zwwtp_b_1'] }}"/>
        </span>

        <span class="zone">
            <span class="zone_info">Slope of first phase: &nbsp;&nbsp; </span>
            <input class="zone_input" type="text" name="zwwtp_a_1" id="zwwtp_a_1" value="{{ $all_info['zwwtp_a_1'] }}"/>
        </span>
    </div>

    <br/><br/><br/><hr/>

    <h3>Phase 2 Constants</h3>
    <div class="inside">
        <span class="zone">
            <span class="zone_info">Time of second phase start: &nbsp;&nbsp; </span>
            <select name="zwwtp_b_2" id="zwwtp_b_2" style="width: 35%; text-align-last: center;">
                @if($all_info['zwwtp_b_2'] == 0)
                    <option value="0" selected>7:00 am</option>
                @else
                    <option value="0">7:00 am</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 1)
                    <option value="1" selected>8:00 am</option>
                @else
                    <option value="1">8:00 am</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 2)
                    <option value="2" selected>9:00 am</option>
                @else
                    <option value="2">9:00 am</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 3)
                    <option value="3" selected>10:00 am</option>
                @else
                    <option value="3">10:00 am</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 4)
                    <option value="4" selected>11:00 am</option>
                @else
                    <option value="4">11:00 am</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 5)
                    <option value="5" selected>12:00 pm</option>
                @else
                    <option value="5">12:00 pm</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 6)
                    <option value="6" selected>1:00 pm</option>
                @else
                    <option value="6">1:00 pm</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 7)
                    <option value="7" selected>2:00 pm</option>
                @else
                    <option value="7">2:00 pm</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 8)
                    <option value="8" selected>3:00 pm</option>
                @else
                    <option value="8">3:00 pm</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 9)
                    <option value="9" selected>4:00 pm</option>
                @else
                    <option value="9">4:00 pm</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 10)
                    <option value="10" selected>5:00 pm</option>
                @else
                    <option value="10">5:00 pm</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 11)
                    <option value="11" selected>6:00 pm</option>
                @else
                    <option value="11">6:00 pm</option>
                @endif
                @if ($all_info['zwwtp_b_2'] == 12)
                    <option value="12" selected>7:00 pm</option>
                @else
                    <option value="12">7:00 pm</option>
                @endif
            </select>
        </span>

        <span class="zone">
            <span class="zone_info">Slope of second phase: &nbsp;&nbsp; </span>
            <input class="zone_input" type="text" id="zwwtp_a_2" name="zwwtp_a_2" value="{{ $all_info['zwwtp_a_2'] }}"/>
        </span>
    </div>

    <br/><hr/>

    <button class="btn btn-success" onclick="document.getElementById('main_form').submit()" style="float: left; width: 40%; margin-left: 30%; margin-right: 30%;">Save</button>
</form>
<br/><br/>
<button class="btn btn-success" onclick="load_graph()" style="float: left; width: 40%; margin-left: 30%; margin-right: 30%;">See On Graph</button>

<canvas id="canvas"></canvas>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
<script>
    var MONTHS = ["7:00am", "8:00am", "9:00am", "10:00am", "11:00am", "12:00pm",
     "1:00pm", "2:00pm", "3:00pm", "4:00pm", "5:00pm", "6:00pm", "7:00pm"];
    var config = {
        type: 'line',
        data: {
            labels: ["7:00am", "8:00am", "9:00am", "10:00am", "11:00am", "12:00pm",
             "1:00pm", "2:00pm", "3:00pm", "4:00pm", "5:00pm", "6:00pm", "7:00pm"],
            datasets: []
        },
        options: {
            responsive: true,
            title:{
                display:true,
                text:'ZWWTP Capacity'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            }
        }
    };

    window.onload = function() {
        document.getElementById('canvas').style.width = '50%';
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, config);
        add_data();
    };

    function load_graph() {
        remove_data();
        add_data();
    }

    function add_data() {
        var newDataset = {
            label: 'ZWWTP Capacity',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [],
            fill: false
        };

        var zwwtp_b_1 = parseInt(document.getElementById('zwwtp_b_1').value);
        var zwwtp_a_1 = parseInt(document.getElementById('zwwtp_a_1').value);
        var zwwtp_a_2 = parseInt(document.getElementById('zwwtp_a_2').value);
        var zwwtp_b_2 = parseInt(document.getElementById('zwwtp_b_2').value);
        var old_final = 0;

        for (var index = 0; index <= zwwtp_b_2; ++index) {
            old_final = zwwtp_b_1 + (zwwtp_a_1*index);
            newDataset.data.push(old_final) ;
        }

        for (var index = zwwtp_b_2+1; index < MONTHS.length; ++index) {
            newDataset.data.push(old_final + (index - zwwtp_b_2)*zwwtp_a_2) ;
        }


        config.data.datasets.push(newDataset);
        window.myLine.update();
    }

    function remove_data() {
        config.data.datasets.splice(0, 1);
        window.myLine.update();
    }

</script>

@endsection
