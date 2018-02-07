@extends('layouts.dashboard')
<style>
</style>
@section('pg')
<h1 class="title-bar-title">
  <span class="d-ib">@lang('titles.register_student')</span>
</h1>
<div class="row">
      <div class="col-md-8 col-md-offset-1">
        <div class="demo-form-wrapper">
          <form class="form form-horizontal" method="POST" action="{{ url('/post_family') }}">
            {{ csrf_field() }}

              @foreach ($filtered_fields as $i => $field)
               @if($visible[$i] == 1)
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-control-{{ $i+1 }}">@lang('messages.' . $field)@if($required[$i]) <span class="req">*</span> @endif</label>

                    <div class="col-sm-9">
                      @if($data_types[$i] == 'text' || $data_types[$i] == 'text-en' || $data_types[$i] == 'text-ar')
                        <input class="form-control" id="form-control-{{ $i+1 }}" type="text" @if($required[$i]) required @endif name="{{ $field }}">
                      @elseif($data_types[$i] == 'date' || $data_types[$i] == 'phone')
                        <div class='input-group date' id='datetimepicker10'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar">
                                </span>
                            </span>
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
                <button type="submit" class="btn btn-primary btn-success" id="submit_student">@lang('messages.register')</button></br>
              </div>
          </form>
          <div id="error_field"> </div>
          </div>
        </div>
      </div>
    </div>
@endsection
