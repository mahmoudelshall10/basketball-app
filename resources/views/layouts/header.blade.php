<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Basketball">
    <meta name="keyword" content="Basketball, Hashcode">
    <link rel="shortcut icon" href="{{asset('img/faviconx.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>System Control Panel</title>

    @if (Request::segment(1) == 'search')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    @endif
    <link href="{{url('css')}}/bootstrap.min.css" rel="stylesheet">
    

    <!-- Bootstrap core CSS -->
    <link href="{{url('css')}}/bootstrap-reset.css" rel="stylesheet">

    <!--external css-->
    <link href="{{url('assets')}}/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{url('assets')}}/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{url('css')}}/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{url('css')}}/style.css" rel="stylesheet">
    <link href="{{url('css')}}/style-responsive.css" rel="stylesheet" />
    <link href="{{url('css')}}/navbar-style.css" rel="stylesheet" />

    <link href="{{url('assets')}}/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{url('css')}}/gallery.css" />
    

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/gritter/css/jquery.gritter.css" />
    <link href="{{url('assets')}}/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{url('assets')}}/data-tables/DT_bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/bootstrap-fileupload/bootstrap-fileupload.css" />

    <script src="{{url('js')}}/jquery.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
  <link rel="stylesheet" type="text/css" href="{{url('assets')}}/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/bootstrap-daterangepicker/daterangepicker-bs3.css" />
      <link rel="stylesheet" type="text/css" href="{{url('assets')}}/bootstrap-datetimepicker/css/datetimepicker.css" />
      <link rel="stylesheet" type="text/css" href="{{url('assets')}}/select2/css/select2.min.css"/>

      
    
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-messaging.js"></script>
    <link rel="manifest" href="manifest.json">
      @stack('admincss')
  </head>

  <body>
  <section id="container" >
      <!--header start-->
      
<header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            
              <a href="#" class="logo"><img src="{{url('img')}}/Logo(3).png"></a>
            <!--logo end-->
            
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    
                <!-- notification dropdown start-->
                <li id="header_notification_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="navbarDropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge badge-warning" id="bell-notification"></span>
                    </a>
                    <ul class="dropdown-menu extended notification">
                        <div class="notify-arrow notify-arrow-yellow"></div>
                        <li id="dropdownmeun">
                            <p class="yellow">Notifications (<span id="notification_count"></span>)</p>
                        </li>
                    </ul>
                </li>
                                        <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>

            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            
                            <span class="username" style="text-transform: capitalize;">{{Auth::user()->admin_username}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout dropdown-menu-right">
                            <div class="log-arrow-up"></div>
                           <!-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="fa fa-bell-o"></i> FAQ</a></li>
                             -->
                              <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-key"></i> Log Out</a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                                    </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        @push('adminjs')
        <script type="text/javascript">
                        $.ajax({
                            type:"GET",
                            url:"{{url('getallnotifications')}}",
                            success:function(response){
                                // console.log(response);
                                if (response) {
            var notification_id = [];
            var notificationCount = response.length;
                $("#bell-notification").append(`${notificationCount}`);
                $("#notification_count").append(`${notificationCount}`);
            $.each(response,function (key, value) {
                // console.log(value);
                $(`
                    <li>
                        <a href="#" class="notification-box" id="${value.referee_id}">
                            <span class="label label-danger"><i class="fa fa-bell"></i></span>
                            ${value.referee.referee_fullname} ${value.message}
                            <span class="small italic">${value.created_at}</span>
                        </a>
                    </li>
                `).insertAfter('#dropdownmeun');

                notification_id.push($('.notification-box').attr('id'));

                });

                $('#navbarDropdown').click((e)=>{
                e.preventDefault();                                            
                $.each(notification_id ,function(key,value){
                    $.ajax({
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        type:'post',
                        url:"{{url('updatenotificationstoread')}}"+"/"+value,
                        success:function(response){
                            // console.log(response);
                        },
                    });
                });

            });
        }
                            },
                        });
        </script>
        @endpush

