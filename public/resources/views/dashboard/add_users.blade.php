@extends('layouts.dashboard')

@section('content')

<!--                         Select Form                              -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

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

@if($sql_error == false && $sql_success == false)
    The new user will be given viewer permissions.
    <br/><br/>
@endif
<form action="" method="post" class="main_form" id="main_form">
    <span style="font-size: larger;">
        @if($sql_success)
            <span style="color: green;">Changes saved successfully!</span>
            <br/><br/>
        @endif
        @if($sql_error)
            <span style="color: red;">Error. Please check that all fields are full, have valid data, and that email is unique</span>
            <br/><br/>
        @endif
    </span>

    <span class="col_name">First Name (English)</span>
    <span class="col_val_div">
        <input name="fname" type="text" value="{{ $fname }}" class="col_val" />
    </span>
    <br/><br/>
    <span class="col_name">Last Name (English)</span>
    <span class="col_val_div">
        <input name="lname" type="text" value="{{ $lname }}" class="col_val" />
    </span>
    <br/><br/>
    <span class="col_name">Email</span>
    <span class="col_val_div">
        <input name="email" type="text" value="{{ $email }}" class="col_val" />
    </span>
    <br/><br/>
    <span class="col_name">Password</span>
    <span class="col_val_div">
        <input name="password" type="password" class="col_val" />
    </span>
    <br/><br/>

    <button class="btn btn-primary" onclick="document.getElementById('main_form').submit()" style="width: 100%; padding: 5px;">Add User</button>
</form>


@endsection

@section('scripts')

@endsection
