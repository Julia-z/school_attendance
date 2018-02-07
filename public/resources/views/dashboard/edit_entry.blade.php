
@extends('layouts.dashboard')

@section('content')

<!--                        Volume Section                            -->
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
.hint{
  color: #0ac29d;
}
</style>

@if(in_array($page_selected_table, $dynamic_tables_list))
<button class="btn btn-success" onclick="location.href='/dashboard/dynamic_tables?table_name={{$page_selected_table}}'" style="float: left; width: 40%; margin-left: 30%; margin-right: 30%;">Go back to table view</button>
@else
<button class="btn btn-success" onclick="location.href='/dashboard/static_tables?table_name={{$page_selected_table}}'" style="float: left; width: 40%; margin-left: 30%; margin-right: 30%;">Go back to table view</button>
@endif
@if(in_array($page_selected_table, $supported_tables))
<form action="" method="post" class="main_form" id="main_form">
    <span style="font-size: x-large;">

        @if($sql_success)
            <span style="color: green;">Changes saved successfully!</span>
            <br/><br/>
        @endif
        @if($sql_error)
            <span style="color: red;">Error. Please check that all fields are full and have valid data.</span>
            <br/><br/>
        @endif
        You are currently <b><u>@if($page_selected_id == '0')adding to</u></b> @else editing</u></b> @endif table <b>{{ $page_selected_table }}</b>
        <br/><br/>

    </span>

    <input type="hidden" name="page_selected_table" value="{{ $page_selected_table }}"/>
    <input type="hidden" name="page_selected_id" value="{{ $page_selected_id }}"/>
    <input type="hidden" name="page_id_name" value="{{ $page_id_name }}"/>
    @foreach($page_col_name as $ind=>$col)
        <span class="col_name">{{  sanitize_static_names($col)  }}@if(sanitize_static_names($col) == 'Block')
          <span class="hint">(Bxx. i.e."B07", "B11"..)</span>
        @endif
        @if(sanitize_static_names($col) == 'Tank Number')
          <span class="hint">(Txx. i.e."T02", "T81"..)</span>
        @endif</span>

        @if($page_col_is_list[$ind])
            <span class="col_val_div">
                <select name="{{ $col }}" style="width: 100%; text-align: center;">
                    @for($opt = 0; $opt < count($page_col_value[$ind]); $opt++)
                        <option value="{{ $page_col_value[$ind][$opt] }}"
                        @if( $page_col_selected[$ind] == $page_col_value[$ind][$opt]) selected @endif>
                            {{ $page_col_display[$ind][$opt] }}
                        </option>
                    @endfor
                </select>
            </span>
            <br/><hr/>
        @else
            <span class="col_val_div">
                <input name="{{ $col }}" type="text" class="col_val" value="{{ $page_col_selected[$ind] }}"/>
            </span>
            <br/><hr/>
        @endif
    @endforeach
    <button class="btn btn-primary" id="submit_btn" onclick="document.getElementById('main_form').submit(); document.getElementById('submit_btn').disabled=true;" style="width: 100%; padding: 5px;">Submit Changes</button>
</form>
<button class="btn btn-success" onclick="location.href='/dashboard/edit_entry?page_selected_table={{ $page_selected_table }}'" style="float: left; width: 40%; margin-left: 30%; margin-right: 30%;">+ New Entry</button>
@else
    <h1> This table does not exist or is not yet supported for edit/add. </h1>
@endif
@endsection
