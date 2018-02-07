@extends('layouts.dashboard')

@section('content')

<style>
.main_form {
    float: left; width: 100%; padding-left: 30%; padding-right: 30%;
    padding-top: 25px;
}
.col_name {
    float: left; width: 49%;
}
.col_val_div {
    float: right; width: 49%;
}
.col_val {
    width: 100%;
}

hr {
    border-color: black;
}
</style>


<form action="" method="post" class="main_form" id="main_form">
    <span class="col_name">Select user to delete</span>
    <span class="col_val_div">
        <select name="user_id" style="width: 100%; font-size: large;">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{$user->name}} {{$user->lname}}</option>
            @endforeach
        </select>
    </span>
    <br/><br/>
    <button class="btn btn-primary" onclick="document.getElementById('main_form').submit()" style="width: 100%; padding: 5px;">Delete User</button>
</form>

@endsection

@section('scripts')

@endsection
