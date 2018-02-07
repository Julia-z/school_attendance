@extends('layouts.dashboard')

@section('content')

<style>
    .zone {
        width: 20%;
        margin-right: 4%;
    }

    .zone_input {
        text-align: center;
    }
</style>
<br/>
<form id="main_form" method="post" action="">
    <h3>Minimum tasks per batch</h3>
    <span class="zone">
        <span>Small trucks (<= 15 m<sup>3</sup>): &nbsp;&nbsp; </span>
        <input class="zone_input" type="text" name="min_tasks_small_truck" value="{{ $all_info['min_tasks_small_truck'] }}"/>
    </span>

    <span class="zone">
        <span>Large trucks (> 15 m<sup>3</sup>): &nbsp;&nbsp; </span>
        <input class="zone_input" type="text" name="min_tasks_large_truck" value="{{ $all_info['min_tasks_large_truck'] }}"/>
    </span>

    <br/><hr/>

    <button class="btn btn-success" onclick="document.getElementById('main_form').submit()" style="float: left; width: 20%; margin-left: 30%; margin-right: 30%;">Save</button>
</form>

@endsection
