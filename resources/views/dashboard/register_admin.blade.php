@extends('layouts.dashboard')
<style>

</style>
@section('pg')
<div class="row">
      <div class="col-md-8 col-md-offset-1">
        <div class="demo-form-wrapper">

                    <form  id="register_student_form" action="/post_admin" method="post">
                      <div class="input-group2">
                        <!-- name English -->
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="col-sm-12 form-group">
                            <label>@lang('messages.first_name_en')</label><span class="lang_error" id="error_en1"></span>
                            <input type="text" required="true" name="first_name" placeholder=@lang('messages.first_name_en_holder') class="form-control must-english">
                          </div>
                          <div class="col-sm-12 form-group">
                            <label>@lang('messages.last_name_en')</label><span class="lang_error" id="error_en1"></span>
                            <input type="text" required="true" name="last_name" placeholder=@lang('messages.last_name_en_holder') class="form-control must-english">
                          </div>
                          <div class="col-sm-12 form-group">
                            <label>@lang('messages.email_address')</label><span class="lang_error" id="error_en1"></span>
                            <input type="email" required="true" name="email" placeholder=@lang('messages.email_address_holder') class="form-control must-english">
                          </div>
                          <div class="col-sm-12 form-group">
                            <label>@lang('messages.password')</label><span class="lang_error" id="error_en1"></span>
                            <input type="password" required="true" name="password" placeholder=@lang('messages.password_holder') class="form-control must-english">
                          </div>
                          <div class="col-sm-12 form-group">
                            <select name="permissions" class="form-control">
                              @if(Auth::user()->school_id == null) <option value="unrwa_admin">@lang('messages.unrwa_admin')</option> @endif
                              <option value="school_principle">@lang('messages.school_principle')</option>
                            </select>
                          </div>
                          @if(Auth::user()->school_id == null)
                          <div class="col-sm-12 form-group">
                            <label>@lang('messages.school')</label>
                            <select name="school_id" class="form-control">
                              <option value="-"> -- </option>
                              @foreach($schools_names as $i=>$name)<option value="{{ $schools_ids[$i] }}">{{ $name }}</option>@endforeach
                            </select>
                          </div>
                          @endif
                          <button type="submit" class="col-md-2 col-md-offset-5 btn indigo">@lang('messages.submit')</button>
                        </div>
                    </form>
            </div>
    </div>
</div>
<script src="http://malsup.github.com/jquery.form.js"></script>

<script type="text/javascript">
  // prepare the form when the DOM is ready
  $(document).ready(function() {
      $('#register_student_form').ajaxForm( { beforeSubmit: validate } );
  });
  function validate_form(){
    var all_errors = $(".lang_error");
    all_errors.html("");
    valide = true;
    var arabics = $(".must-arabic");
    for(var i = 0; i < arabics.length; i++){
      s = arabics[i].value;
      if(s.match(".*[a-z].*")) {
        error_msg = $(".hidden_message_ar").html();

        $("#error_ar"+(i+1)).html(error_msg);
        valid = false;
      }
    }
    var en = $(".must-english");
    for(var i = 0; i < en.length; i++){
      s = en[i].value;
      if(!s.match(".*[a-z].*")) {
        error_msg = $(".hidden_message_en").html();
        $("#error_en"+(i+1)).html(error_msg);
        valid = false;
      }
    }
    return valid;
  }
</script>

@endsection
