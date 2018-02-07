@extends('layouts.app')
@section('headers')
  @if(App::isLocale('en'))
    <link rel="stylesheet" href="{{ URL::asset('/css/login-2.min.css') }}">
  @else
    <link rel="stylesheet" href="{{ URL::asset('/css/login-2-rtl.min.css') }}">
  @endif
@endsection
@section('content')
<body>
  <div class="login">
    <div class="login-body">
      <a class="login-brand" href="/">
          <h4>@lang('titles.title')</h4>
      </a>
    <div class="login-form">
        {!! Form::open(array('url' => url('password/email'), 'method' => 'post', 'files'=> true)) !!}
            <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', "E-Mail Address", array('class' => 'control-label')) !!}
            <div class="controls">
        {!! Form::text('email', null, array('class' => 'form-control')) !!}
        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
          </div>
          </div>
          <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                      Send Password Reset Link
                  </button>
              </div>
          </div>
          {!! FOrm::close() !!}
      </div>
    </div>
  </div>
</body>
@endsection
