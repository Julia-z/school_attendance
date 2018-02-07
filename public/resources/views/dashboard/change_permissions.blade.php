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


<form action="" method="get" class="main_form" id="sub_form">
    <span class="col_name">Select user to change permissions</span>
    <span class="col_val_div">
        <select name="user_id" id="sel_user" style="width: 100%; font-size: large;" onchange="fire_away()">
            @foreach($users as $user)
                @if($selected_user == $user->id)
                    <option value="{{ $user->id }}" selected>{{$user->name}} {{$user->lname}}</option>
                @else
                    <option value="{{ $user->id }}">{{$user->name}} {{$user->lname}}</option>
                @endif
            @endforeach
        </select>
    </span>
    <br/><br/>
    <button class="btn btn-primary" onclick="document.getElementById('sub_form').submit()" style="width: 100%; padding: 5px;">Choose User</button>
</form>

@if(!is_null($selected_user))
<form action="" method="post" class="main_form" id="main_form">
    <span class="col_name">Select new permission</span>
    <span class="col_val_div">
        <select name="permission" style="width: 100%; font-size: large;">
            @foreach($permissions as $permission)
                @if($permission->id == $selected_permission)
                    <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                @else
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endif
            @endforeach
        </select>
    </span>
    <br/><br/>
    <input type="hidden" name="user_id" id="hid_user" value="{{ $selected_user }}" />
    <button class="btn btn-primary" onclick="document.getElementById('main_form').submit()" style="width: 100%; padding: 5px;">Change Permission</button>
</form>
@endif


@endsection

@section('scripts')
<script lang="js">

    function fire_away() {
        document.getElementById('hid_user').value = document.getElementById('sel_user').value;
    }

</script>
@endsection
