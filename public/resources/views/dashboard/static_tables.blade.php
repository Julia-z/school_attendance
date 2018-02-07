
@extends('layouts.dashboard')

@section('content')

<!--                         Select Form                              -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
  <div class="col-xs-12">
      <div class="form-group">
          <form id="table_name_form" action="/dashboard/static_tables" method="get">
              <label class="col-sm-4 control-label" for="nothing"></label>
              <div class="col-sm-3">
                <select id="table_name" name="table_name" class="form-control" onchange="document.getElementById('table_name_form').submit();">
                    @foreach($req_cols_for_db as $db_name => $db_cols)
                        <option value="{{$db_name}}" @if($page_table_name == $db_name) selected @endif>{{ sanitize_static_names($db_name) }}</option>
                    @endforeach
                </select>
              </div>
          </form>
        </div>
  </div>
</div>
<br/>

<!--                           Limiters                               -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

@if($page_req_limiter == 1)

    <div class="row gutter-xs">
        <div class="col-xs-12">
            <div class="form-group">
                @for($i = 1; $i < 13; $i++)
                    <button class="col-sm-1 btn @if($page_selected_district == $i) btn-success @else btn-primary @endif" onclick="submit_form_with_district({{ $i }});">{{ $i }}</button>
                @endfor
                <form id="form_select_district" action="/dashboard/static_tables" method="get">
                    <input type="hidden" id="page_selected_district" name="page_selected_district" value="{{ $page_selected_district }}"/>
                    <input type="hidden" id="table_name" name="table_name" value="{{ $page_table_name }}" />
                </form>
          </div>
        </div>
    </div>


@elseif($page_req_limiter == 2)

    <div class="row gutter-xs">
        <div class="col-xs-12">
            <div class="form-group">
                <form id="range_select_form" action="/dashboard/static_tables" method="get">
                    <input type="hidden" id="table_name" name="table_name" value="{{ $page_table_name }}" />
                    <label class="col-sm-3 control-label" for="nothing"></label>
                    <div class="col-sm-2">
                        <div class="input-with-icon">
                            <input class="form-control" type="text" data-provide="datepicker" data-date-today-btn="linked" id="page_selected_from" name="page_selected_from" value="{{ $page_selected_from }}"/>
                            <span class="icon icon-calendar input-icon"></span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-with-icon">
                            <input class="form-control" type="text" data-provide="datepicker" data-date-today-btn="linked" id="page_selected_to" name="page_selected_to" value="{{ $page_selected_to }}"/>
                            <span class="icon icon-calendar input-icon"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" onclick="document.getElementById('range_select_form').submit();"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br/>

@endif


<!--                         Return Table                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->
<div class="row gutter-xs">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-body">
        <table id="demo-datatables-4" data-length-menu='[[10, 25, 50, 100, -1], ["10", "25", "50", "100", "All"]]' class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
                @foreach($req_cols_for_db[$page_table_name] as $col_name)
                    <th>{{ sanitize_static_names($col_name) }}</th>
                @endforeach
                <th>Table Control</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                @foreach($req_cols_for_db[$page_table_name] as $col_name)
                    <th>{{$col_name}}</th>
                @endforeach
            </tr>
          </tfoot>
          <tbody>
              @foreach($table_out_query as $row)
              <tr>
                  @foreach($req_cols_for_db[$page_table_name] as $col_name)
                  <th>{{ $row->{$col_name} }}</th>
                  @endforeach
                  @if(access_level(2))
                  <th><a href="#" onclick="edit('{{ $row->{$id_col_name[$page_table_name]} }}')">Edit</a>
                @if($page_table_name != 'event_type' && $page_table_name != 'privilege')
                      -
                  <a href="#" onclick="confirm_delete('{{$row->{$id_col_name[$page_table_name]} }}');">Delete</a></th>
                @endif
                  @else
                      <th>Permission Denied</th>
                  @endif
              </tr>
              @endforeach
          </tbody>
        </table>
        @if(access_level(2))
        <div class="cent">
          <button class="btn btn-primary btn-cust"  onclick="edit('0')">+ New Entry</button><br/>
          @endif
          <button class="btn btn-success btn-cust"  style="background-color: #0b88d5" onclick="export_data('demo-datatables-4', true, '{{ sanitize_static_names($page_table_name) }}')">Export Data</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--                         Control Forms                            -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<form id="edit_row_form" method="get" action="/dashboard/edit_entry">
    <input type="hidden" name="page_selected_table" value="{{ $page_table_name }}" />
    <input type="hidden" id="page_selected_edit_id" name="page_selected_id" value="" />
</form>
<form id="delete_row_form" method="post" action="/dashboard/static_tables/delete">
    <input type="hidden" name="table_name" value="{{ $page_table_name }}" />
    <input type="hidden" name="col_name" value="{{ $id_col_name[$page_table_name] }}"/>
    <input type="hidden" id="page_selected_delete_id" name="page_selected_delete_id" value="" />
    <input type="hidden" name="page_selected_district" value="{{ $page_selected_district }}" />
    <input type="hidden" name="page_selected_from" value="{{ $page_selected_from }}" />
    <input type="hidden" name="page_selected_to" value="{{ $page_selected_to }}" />
</form>

<!--                         Export Forms                             -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<form id="export_data_form" method="post" action="/dashboard/export_table" target="_blank">
    <input type="hidden" id="export_table_name" name="table_name" value="" />
    <input type="hidden" id="row_length" name="row_length" value="" />
    <input type="hidden" id="table_data" name="table_data" value="" />
</form>



@endsection

@section('scripts')

<script>
    function confirm_delete(id) {
        document.getElementById('page_selected_delete_id').value = id;
        if(confirm('Are you sure you want to delete this entry?')) {
            document.getElementById('delete_row_form').submit();
        }
    }
    function edit(id) {
        document.getElementById('page_selected_edit_id').value = id;
        document.getElementById('edit_row_form').submit();
    }
    function submit_form_with_district(dist) {
        document.getElementById('page_selected_district').value = parseInt(dist);
        document.getElementById('form_select_district').submit();
    }

</script>


@endsection
