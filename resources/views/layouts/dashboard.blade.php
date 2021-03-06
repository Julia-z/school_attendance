@extends('layouts.app')

@section('content')

  <body class="layout layout-header-fixed">
    <div class="layout-header">
      <div class="navbar navbar-default">
        <div class="navbar-header">
          <a class="navbar-brand navbar-brand-center" href="/summary">
            <span>School Attendance </span>
          </a>
          <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
            <span class="sr-only">Toggle navigation</span>
            <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
            <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
          </button>
          <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="arrow-up"></span>
            <span class="ellipsis ellipsis-vertical">
              <img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson">
            </span>
          </button>
        </div>
        <div class="navbar-toggleable">
          <nav id="navbar" class="navbar-collapse collapse">
            <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
            </button>
            <!-- navbar elements -->
            <ul class="nav navbar-nav navbar-right">
              <li><h4  class="navbar-text text-center">@lang('messages.welcome'), {{ Auth::user()->user_first_name }}</h4></li>
              <li class="visible-xs-block">
                <h4 class="navbar-text text-center">Hi {{  Auth::user()->user_first_name}}</h4>
              </li>
              <li><a href="/logout">Sign out</a></li>

              <li class="visible-xs-block">
                <a href="/logout">
                  <span class="icon icon-power-off icon-lg icon-fw"></span>
                  @lang('messages.signout')
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="layout-main">
      <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
          <div class="custom-scrollbar">
            <nav id="sidenav" class="sidenav-collapse collapse">
              <ul class="sidenav">
                <li class="sidenav-search hidden-md hidden-lg">
                  <form class="sidenav-form" action="/">
                    <div class="form-group form-group-sm">
                      <div class="input-with-icon">
                        <input class="form-control" type="text" placeholder="Search…">
                        <span class="icon icon-search input-icon"></span>
                      </div>
                    </div>
                  </form>
                </li>
                <li class="sidenav-heading">@lang('titles.dashboard')</li>
                <li class="sidenav-item">
                  <a href="/dashboard">
                    <span class="sidenav-icon icon icon-user"></span>
                    <span class="sidenav-label">@lang('titles.dashboard')</span>
                  </a>
                </li>
                @if(Auth::user()->school_id != null)
                <li class="sidenav-heading">@lang('titles.student_registration')</li>
                <li class="sidenav-item">
                  <a href="/register_student">
                    <span class="sidenav-icon icon icon-user"></span>
                    <span class="sidenav-label">@lang('titles.register_student')</span>
                  </a>
                </li>
                <li class="sidenav-item">
                  <a href="/register_family">
                    <span class="sidenav-icon icon icon-users"></span>
                    <span class="sidenav-label">@lang('titles.register_family')</span>
                  </a>
                </li>
                @endif
                <li class="sidenav-heading">@lang('titles.administration')</li>
                <li class="sidenav-item">
                  <a href="/register_admin">
                    <span class="sidenav-icon icon icon-lock"></span>
                    <span class="sidenav-label">@lang('titles.register_admin')</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div class="layout-content">
        <div class="layout-content-body">
          @yield('pg')
        </div>
      </div>

    </div>
    <script src="{{ URL::asset('/js/vendor.min.js') }}"></script>
    <script src="{{ URL::asset('/js/elephant.min.js') }}"></script>
    <script src="{{ URL::asset('/js/application.min.js') }}"></script>
    <script src="{{ URL::asset('/js/demo.js') }}"></script>

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
