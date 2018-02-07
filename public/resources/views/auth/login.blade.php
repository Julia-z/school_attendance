@extends('layouts.app')

@section('content')
<style>

  .login-inner{
    border: solid 1px #0b88d5;
    border-radius: 20px;
    background-color: white;
    padding: 10px;
    margin: 20px;
  }
  .login{
      margin-top:50px;
      border: solid 1px #0b88d5;
      border-radius: 20px;
  }
  body{
    background-color: #0b88d5;
  }
  .brand{
    text-align: center;
    margin: 20px;
    margin-bottom: 50px;
    font-weight: 900;
    color: #0b88d5;
  }
  .left-al{
    text-align: right;
  }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default login" >
              <div class="login-inner">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <h1 class="brand">UFOW</h1>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password*</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 left-al">
                                <button type="submit" class="btn btn-primary" style="width:55%">
                                     Login
                                </button>
                                <br>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>

<script>
    if(navigator.cookieEnabled) {
        document.cookie = "cookies=1";
    }
</script>
@endsection
