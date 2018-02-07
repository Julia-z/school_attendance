<!DOCTYPE html>
<html dir="auto">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>School Attendance</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="">
	<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <meta name="theme-color" content="#ffffff">

	<!-- css for rtl and ltr-->
	@if(App::isLocale('en'))
      <link rel="stylesheet" href="{{ URL::asset('/css/vendor.min.css') }}">
    @else
      <link rel="stylesheet" href="{{ URL::asset('/css/vendor-rtl.min.css') }}">
    @endif
    @if(App::isLocale('en'))
      <link rel="stylesheet" href="{{ URL::asset('/css/elephant.min.css') }}">
    @else
      <link rel="stylesheet" href="{{ URL::asset('/css/elephant-rtl.min.css') }}">
    @endif
    @if(App::isLocale('en'))
      <link rel="stylesheet" href="{{ URL::asset('/css/application.min.css') }}">
    @else
      <link rel="stylesheet" href="{{ URL::asset('/css/application-rtl.min.css') }}">
    @endif
    @if(App::isLocale('en'))
      <link rel="stylesheet" href="{{ URL::asset('/css/dashboard.min.css') }}">
    @else
      <link rel="stylesheet" href="{{ URL::asset('/css/dashboard-rtl.min.css') }}">
    @endif
    @if(App::isLocale('en'))
      <link rel="stylesheet" href="{{ URL::asset('/css/demo.min.css') }}">
    @else
      <link rel="stylesheet" href="{{ URL::asset('/css/demo-rtl.min.css') }}">
    @endif

    @yield('headers')

        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

        <style>
          .req{
            color: red;
          }
          .title-bar-title{
            margin-bottom: 20px;
          }
          .center{
            text-align: center;
          }
        </style>
</head>

    @yield('content')


</html>
