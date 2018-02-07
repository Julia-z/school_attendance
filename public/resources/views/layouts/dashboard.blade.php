<!DOCTYPE html>
<html lang="en" dir="rtl">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $page_title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="{{ URL::asset('/css/vendor-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/elephant-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/application-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/dashboard-3.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/demo-rtl.min.css') }}">
    <style>
        .card-title {
            font-size: 180%;
            color: #0b88d5;

        }
        .cent{
          text-align: center;
        }
        .btn-cust{
          background-color: #0ac29d;
          border-color: #0ac29d;
          margin: 5px;
        }


        .card-header {
            font-size: 180%;
            color: #0b88d5;

        }
        .title-bar{
          color: #0b88d5;

        }
        .top-of-summary {
            font-weight: normal;
            font-size: 110%;
            color: #555;
        }
        #error_log{
          margin-left: 10px;
          color: #FF8880;
          font-weight: bold;
        }
    </style>
  </head>
  <body class="layout layout-sidebar-fixed layout-header-fixed ">

    <div class="layout-header">
      <div class="navbar navbar-default">
        <div class="navbar-header">
          <a class="navbar-brand navbar-brand-center" href="/dashboard">@lang('titles.title')</a>
          <button class="navbar-toggler collapsed visible-xs-block" type="button" data-toggle="collapse" data-target="#sidenav">
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
          <button class="navbar-toggler collapsed visible-xs-block" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="arrow-up"></span>
            <span class="ellipsis ellipsis-vertical"></span>
          </button>
        </div>
        <div class="navbar-toggleable">
          <nav id="navbar" class="navbar-collapse collapse">
            <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" type="button">
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
            <ul class="nav navbar-nav navbar-right">
              <li class="hidden-xs hidden-sm">
                  <h43 class="navbar-text text-center">@lang('messages.welcome') , {{ Auth::user()->name }}</h4>
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
          <nav id="sidenav" class="sidenav-collapse collapse">
            <ul class="sidenav">
              <li class="sidenav-heading">UFOW Navigation</li>
              <li class="sidenav-item @if(strpos(\Request::route()->getName(), 'summary') !== false) active @endif">
                <a href="/summary">
                  <span class="sidenav-icon icon icon-th"></span>
                  <span class="sidenav-label">Dashboard Summary</span>
                </a>
              </li>
              @if(access_level(2))
              <li class="sidenav-item has-subnav @if(strpos(\Request::route()->getName(), 'table') !== false) active @endif">
                <a href="#" aria-haspopup="true">
                  <span class="sidenav-icon icon icon-table"></span>
                  <span class="sidenav-label">Tabulated Data</span>
                </a>
                <ul class="sidenav-subnav collapse">
                  <li class="sidenav-subheading">Tabulated Data</li>
                  <li class="@if(strpos(\Request::route()->getName(), 'static_tables') !== false) active @endif">
                      <a href="/dashboard/static_tables">Static Tables</a>
                  </li>
                  <li class="@if(strpos(\Request::route()->getName(), 'dynamic_tables') !== false) active @endif">
                      <a href="/dashboard/dynamic_tables">Dynamic Tables</a>
                  </li>
                </ul>
              </li>
              <li class="sidenav-item has-subnav @if(strpos(\Request::route()->getName(), 'drivers') !== false || strpos(\Request::route()->getName(), 'truck_activity') !== false) || strpos(\Request::route()->getName(), 'trucks') !== false) active @endif">
                <a href="#" aria-haspopup="true">
                  <span class="sidenav-icon icon icon-truck"></span>
                  <span class="sidenav-label">Trucks & Drivers</span>
                </a>
                <ul class="sidenav-subnav collapse">
                  <li class="sidenav-subheading">Trucks & Drivers</li>
                  <li class="@if(strpos(\Request::route()->getName(), 'drivers') !== false) active @endif">
                      <a href="/dashboard/drivers">Driver Attendance</a>
                  </li>
                  <li class="@if(strpos(\Request::route()->getName(), 'trucks') !== false) active @endif">
                      <a href="/dashboard/trucks">Truck Attendance</a>
                  </li>
                  <li class="@if(strpos(\Request::route()->getName(), 'truck_activity') !== false) active @endif">
                      <a href="/dashboard/truck_activity">Truck Activity</a>
                  </li>
                </ul>
              </li>
              <li class="sidenav-item @if(strpos(\Request::route()->getName(), 'tanks') !== false) active @endif">
                <a href="/dashboard/tanks">
                  <span class="sidenav-icon icon icon-map-marker"></span>
                  <span class="sidenav-label">Tank Data</span>
                </a>
              </li>
              <li class="sidenav-item @if(strpos(\Request::route()->getName(), 'hotline') !== false) active @endif">
                <a href="/dashboard/hotline">
                  <span class="sidenav-icon icon icon-phone"></span>
                  <span class="sidenav-label">Hotline Data</span>
                </a>
              </li>
              <li class="sidenav-item @if(strpos(\Request::route()->getName(), 'volume') !== false) active @endif">
                <a href="/dashboard/volume">
                  <span class="sidenav-icon icon icon-bars"></span>
                  <span class="sidenav-label">Volume Data</span>
                </a>
              </li>
            @endif
            <li class="sidenav-item has-subnav @if(strpos(\Request::route()->getName(), 'heatmap') !== false || strpos(\Request::route()->getName(), 'tasker_report') !== false)  active @endif">
              <a href="#" aria-haspopup="true">
                  <span class="sidenav-icon icon icon-check"></span>
                  <span class="sidenav-label">Tasks Data</span>
              </a>
              <ul class="sidenav-subnav collapse">
                <li class="sidenav-subheading">Tasks Data</li>
                <li class="@if(strpos(\Request::route()->getName(), 'heatmap') !== false) active @endif">
                    <a href="/dashboard/heatmap">Tank Heatmap</a>
                </li>
                <li class="@if(strpos(\Request::route()->getName(), 'tasker_report') !== false) active @endif">
                    <a href="/dashboard/tasker_report">Tasker Report</a>
                </li>
              </ul>
              @if(access_level(1))
              <li class="sidenav-item has-subnav @if(strpos(\Request::route()->getName(), 'add_users') !== false || strpos(\Request::route()->getName(), 'delete_users') !== false || strpos(\Request::route()->getName(), 'change_app_pwd') !== false) ||  strpos(\Request::route()->getName(), 'alerts') !== false) active @endif">
                <a href="#" aria-haspopup="true">
                  <span class="sidenav-icon icon icon-user"></span>
                  <span class="sidenav-label">Management</span>
                </a>
                <ul class="sidenav-subnav collapse">
                  <li class="sidenav-subheading">Management</li>
                  <li class="@if(strpos(\Request::route()->getName(), 'add_users') !== false) active @endif">
                      <a href="/dashboard/add_users">Add User</a>
                  </li>
                  <li class="@if(strpos(\Request::route()->getName(), 'delete_users') !== false) active @endif">
                      <a href="/dashboard/delete_users">Delete User</a>
                  </li>
                  <li class="@if(strpos(\Request::route()->getName(), 'change_permissions') !== false) active @endif">
                      <a href="/dashboard/change_permissions">Change User Permissions</a>
                  </li>
                  <li class="@if(strpos(\Request::route()->getName(), 'change_app_pwd') !== false) active @endif">
                      <a href="/dashboard/change_app_pwd">Change AppUser Password</a>
                  </li>
                  <li class="@if(strpos(\Request::route()->getName(), 'alerts') !== false) active @endif">
                      <a href="/dashboard/alerts">Alerts</a>
                  </li>
                </ul>
                <li class="sidenav-item has-subnav @if(strpos(\Request::route()->getName(), 'set_cutoff') !== false || strpos(\Request::route()->getName(), 'set_min_tasks') !== false)  active @endif">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-check-square-o"></span>
                    <span class="sidenav-label">Control</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">Control</li>
                    <li class="@if(strpos(\Request::route()->getName(), 'set_cutoff') !== false) active @endif">
                        <a href="/dashboard/set_cutoff">Set Cuttoff</a>
                    </li>
                    <li class="@if(strpos(\Request::route()->getName(), 'set_min_tasks') !== false) active @endif">
                        <a href="/dashboard/set_min_tasks">Tasker Constants</a>
                    </li>
                    <li class="@if(strpos(\Request::route()->getName(), 'set_capacity_curve') !== false) active @endif">
                        <a href="/dashboard/set_capacity_curve">ZWWTP Capacity Curve</a>
                    </li>
                    <li class="@if(strpos(\Request::route()->getName(), 'sweep_selector') !== false) active @endif">
                        <a href="/dashboard/sweep_selector">Sweep Settings</a>
                    </li>
                  </ul>
              @endif
            </ul>
          </nav>
        </div>
      </div>
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
          @if($page_picker_top_right == true)
            <form action="" method="get" id="select_day_form">
                <div class="title-bar-actions">
                    <div class="input-with-icon">
                      <input class="form-control" type="text" data-provide="datepicker" data-date-today-btn="linked" id="selected_day" name="selected_date" value="{{ $selected_day }}"
                      onchange="consume_first_on_click();"/>
                      <span class="icon icon-calendar input-icon"></span>
                    </div>
                </div>
            </form>
            @endif

            <h1 class="title-bar-title" style="font-size: 200%;">{{ $page_title }}</h1>
          </div>
                @yield('content')
        </div>
      </div>
    </div>
    <script src="{{ URL::asset('/js/vendor.min.js') }}"></script>
    <script src="{{ URL::asset('/js/elephant.min.js') }}"></script>
    <script src="{{ URL::asset('/js/application.min.js') }}"></script>
    <script src="{{ URL::asset('/js/demo.js') }}"></script>
    <script src="{{ URL::asset('/js/table_export.js') }}" /></script>
    <script lang="js">
        first_consumed = false;
        function consume_first_on_click() {
            if(first_consumed) {
                document.getElementById('select_day_form').submit();
            } else {
                first_consumed = true;
            }
        }
    </script>
    @yield('scripts')

  </body>
</html>
