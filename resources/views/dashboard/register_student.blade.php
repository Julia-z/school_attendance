@extends('layouts.dashboard')

@section('pg')
<style>
  #error_field{
    padding: 10px;
    color: red;
  }
  #success_field{
    padding: 10px;
    color: green;
  }
</style>
<h1 class="title-bar-title">
  <span class="d-ib">@lang('titles.register_student')</span>
</h1>
<div class="row">
      <div class="col-md-8 col-md-offset-1">
        <div class="demo-form-wrapper">
          <form class="form form-horizontal" method="POST" action="{{ url('/post_student') }}">
            {{ csrf_field() }}

              @foreach ($filtered_fields as $i => $field)
               @if($visible[$i] == 1)
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-control-{{ $i+1 }}">@lang('messages.' . $field)@if($required[$i]) <span class="req">*</span> @endif</label>

                    <div class="col-sm-9">
                      @if($data_types[$i] == 'text' || $data_types[$i] == 'text-en' || $data_types[$i] == 'text-ar')
                        <input class="form-control" id="form-control-{{ $i+1 }}" type="text" @if($required[$i]) required @endif name="{{ $field }}">
                      @elseif($data_types[$i] == 'date')
                      <div class="input-with-icon">
                          <input class="form-control" name="date_of_birth" type="text" value="2005-11-05" data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" data-date-start-view="decade" >
                          <span class="icon icon-calendar input-icon"></span>
                        </div>

                      @else
                        <select class="form-control" name="{{ $field }}">
                          @if(!$required[$i])<option value="">Select -- </option>@endif
                          @foreach($data_list_values[$i] as $j => $val )
                            <option value= "{{ $val }}">@if($static_display[$i]) {{ $data_list_display[$i][$j] }} @else @lang('messages.' . $data_list_display[$i][$j])@endif</option>
                          @endforeach
                        </select>
                      @endif
                    </div>
                  </div>
                  @endif
                @endforeach
                <div class="center"style="margin-bottom:10px;">
                <button type="submit" class="btn btn-primary btn-success" disabled id="submit_student">@lang('messages.register_student')</button></br>
              </div>
          </form>
          <div class="center" style="margin-bottom:10px;">
          <button onclick="validate()" class="btn btn-primary btn-default">@lang('messages.validate_student')</button><br/>
          <div id="error_field"> </div>
          <div id="success_field"> </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function validate(){
        document.getElementById('error_field').innerHTML = '';
        var unique = [
          @foreach ($validate_check_against as $id=>$field)
          '{{ $field }}'
          @if($i !== count($validate_check_against) -1) ,
          @endif
          @endforeach
        ];
        var my_url = 'validate_student?';
        var values = [];
        for(var i = 0; i < unique.length; i++){
          values.push(document.getElementsByName(unique[i])[0].value);
          my_url += unique[i] + "=" + values[i];
          if(i < unique.length) my_url += "&";
        }

        $.ajax({
                 type:'GET',
                 url:my_url,
                 success:function(data){
                     if(data['valid'] == 1){
                      document.getElementById("submit_student").disabled = false;
                      document.getElementById('success_field').innerHTML = 'Student validated from the server';

                    }
                    else {
                      document.getElementById('error_field').innerHTML = 'Student already exists';
                    }
                 }
              });
      }
    </script>

@endsection
