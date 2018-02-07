
@extends('layouts.dashboard')

@section('content')

<!--                         Select Form                              -->
<!---------------------------------------------------------------------->
<!---------------------------------------------------------------------->

<div class="row gutter-xs">
  <div class="col-xs-12">
      <div class="form-group">
          <form id="table_name_form" action="/dashboard/tables" method="get">
              <label class="col-sm-4 control-label" for="nothing"></label>
              <div class="col-sm-3">
                <select id="table_name" name="table_name" class="form-control" onchange="document.getElementById('table_name_form').submit();">
                    @foreach($req_cols_for_db as $db_name => $db_cols)
                        <option value="{{$db_name}}" @if($page_table_name == $db_name) selected @endif>{{$db_name}}</option>
                    @endforeach
                </select>
              </div>
          </form>
        </div>
  </div>
</div>
<br/>


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
                    <th>{{$col_name}}</th>
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
                  <th><a href="#">Edit</a> - <a href="#" onclick="confirm_delete('{{$row->{$id_col_name[$page_table_name]} }}');">Delete</a></th>
                  <form id="{{$row->{$id_col_name[$page_table_name]} }}" action="/dashboard/tables/delete" method="post">
                      <input type="hidden" name="action" value="delete" />
                      <input type="hidden" name="table_name" value="{{ $page_table_name }}" />
                      <input type="hidden" name="col_name" value="{{ $id_col_name[$page_table_name] }}"/>
                      <input type="hidden" name="id_val" value="{{ $row->{$id_col_name[$page_table_name]} }}"/>
                  </form>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>




    <script>
        function confirm_delete(id) {
            if(confirm('Are you sure you want to delete this entry?')) {
                document.getElementById(id).submit();
            }
        }
    </script>

@endsection
