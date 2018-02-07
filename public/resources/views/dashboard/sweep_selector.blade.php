@extends('layouts.dashboard')

@section('content')

<style>
.zone {
    font-size: large;
    float: left;
    width: 16%;
    margin-right: 3%;
    margin-bottom: 10px;
}

.zone_input {
    text-align: center;
    width: 55%;
}
</style>
<br/>
<form id="main_form" method="post" action="" style=" float: left; width: 100%;">
    <span style="float: left; width: 100%;">
    @for($district = 0; $district < 12; $district++)
        <span class="zone">
            @if($district < 9)
                <span>District 0{{ $district + 1}}:&nbsp;&nbsp;&nbsp;&nbsp;</span>
            @else
                <span>District {{ $district + 1}}:&nbsp;&nbsp;&nbsp;&nbsp;</span>
            @endif
            <select class="zone_input" type="text" name="{{ $district + 1 }}">
                @if($districts_opt[$district] == 0)
                    <option value="0" selected>Full</option>
                @else
                    <option value="0">Full</option>
                @endif
                @if($districts_opt[$district] == 1)
                    <option value="1" selected>Odd & Even</option>
                @else
                    <option value="1">Odd & Event</option>
                @endif
                @if($districts_opt[$district] == 2)
                    <option value="2" selected>Automatic</option>
                @else
                    <option value="2">Automatic</option>
                @endif
            </select>
        </span>
    @endfor
    </span>
<br/><hr/>

    <button class="btn btn-success" onclick="document.getElementById('main_form').submit()" style="float: left; width: 40%; margin-left: 30%; margin-right: 30%;">Save</button>
</form>

@endsection
