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
          <h3 style="text-align:center;">School Attendance System</h3>
        </a>
        <div class="login-form">
          <form data-toggle="validator" role="form" method="POST" action="{{ url('/login') }}">
		{{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email">@lang('login.email')</label>
              <input id="email" class="form-control" type="email" name="email" spellcheck="false" value="{{ old('email') }}" data-msg-required="Please enter your email address." required>
				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password">@lang('login.password')</label>
              <input id="password" class="form-control" type="password" name="password" minlength="4" data-msg-minlength="Password must be 4 characters or more." data-msg-required="Please enter your password." required>
				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</div>
            <div class="form-group">
              <label class="custom-control custom-control-primary custom-checkbox">
                <input class="custom-control-input" type="checkbox" checked="checked" name="remember">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-label">@lang('login.remember')</span>
              </label>
              <span aria-hidden="true"> · </span>
              <a href="{{ url('/password/reset') }}">@lang('login.forgot')</a>
            </div>
            <button class="btn btn-primary btn-block" type="submit">@lang('login.login')</button>
          </form>
        </div>
      </div>

    </div>
    <script src="{{ URL::asset('/js/vendor.min.js') }}"></script>
    <script src="{{ URL::asset('/js/elephant.min.js') }}"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-83990101-1', 'auto');
      ga('send', 'pageview');
    </script>
  </body>
@endsection
