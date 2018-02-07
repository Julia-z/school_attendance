@extends('layouts.dashboard')

@section('content')

<style>
    .zone {
        float: left;
        width: 16%;
        margin-right: 3%;
        margin-bottom: 10px;
    }

    .zone_input {
        text-align: center;
    }
</style>
<br/>
<form id="main_form" method="post" action="" style=" float: left; width: 100%;">
    @for($district = 1; $district < 13; $district++)
        <span style="float: left; width: 100%;">
            <h3> District {{ $district }} </h3>
            @foreach($all_zones as $zone)
                @if($zone->zone > $district*100 && $zone->zone < ($district+1)*100)
                    <span class="zone">
                        <span>Zone {{ $zone->zone - $district*100 }}:&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input class="zone_input" type="text" name="{{ $zone->zone }}" value="{{ $zone->cut_off }}"/>
                    </span>
                @endif
            @endforeach
        </span>
        <br/><hr/>
    @endfor

    <button class="btn btn-success" onclick="document.getElementById('main_form').submit()" style="float: left; width: 40%; margin-left: 30%; margin-right: 30%;">Save</button>
</form>

@endsection
