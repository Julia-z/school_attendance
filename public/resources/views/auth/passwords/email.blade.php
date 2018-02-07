@extends('layouts.app')

<!-- Main Content -->
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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default login">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="login-inner">
                      <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
