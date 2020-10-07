<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Coverage Center Admin Area</title>
        <link href="/css/admin/bootstrap.css" rel="stylesheet" />
        <link href="/css/admin/font-awesome.css" rel="stylesheet" />
        <link href="/css/admin/custom.css" rel="stylesheet" />
        <link
            href="http://fonts.googleapis.com/css?family=Open+Sans"
            rel="stylesheet"
            type="text/css"
        />
        @notifyCss
    </head>
    <body>
        <div id="wrapper">
            <div class="navbar navbar-inverse navbar-fixed-top" style="z-index: 2">
                <div class="adjust-nav">
                    <div class="navbar-header">
                        <button
                            type="button"
                            class="navbar-toggle"
                            data-toggle="collapse"
                            data-target=".sidebar-collapse"
                        >
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/admin/dashboard" style="color:#fff;">
                            {{-- <img src="/images/admin/logo.png" /> --}}
                            Coverage Center Admin Area
                        </a>
                    </div>

                    <span class="logout-spn">
                        <a href="/logout" style="color:#fff;">Logout</a>
                    </span>
                </div>
            </div>

            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li class="active-link">
                            <a href="/admin/dashboard"
                                ><i class="fa fa-desktop "></i>Dashboard</a
                            >
                        </li>

                        {{-- <li>
                            <a href="/admin/ui"
                                ><i class="fa fa-table "></i>UI Elements</a
                            >
                        </li> --}}
                        <li>
                            <a href="/admin/users"
                                ><i class="fa fa-users "></i>Users</a
                            >
                        </li>
                        <li>
                            <a href="/admin/recent-activities"
                                ><i class="fa fa-bar-chart-o"></i>Recent Activities</a
                            >
                        </li>
                        <li>
                            <a href="/admin/email-log"
                                ><i class="fa fa-bar-chart-o"></i>Email Log</a
                            >
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">
                @yield('content')
            </div>

        </div>
        <div class="footer">
            <div class="row">
                <div class="col-lg-12">
                    &copy; 2020 coveragecentre.net
                </div>
            </div>
        </div>

        <script src="/js/admin/jquery-1.10.2.js"></script>
        <script src="/js/admin/bootstrap.min.js"></script>
        <script src="/js/admin/custom.js"></script>
        @include('notify::messages')
        @notifyJs
    </body>
</html>
