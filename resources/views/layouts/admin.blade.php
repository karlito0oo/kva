
@php
  $levels = \App\Level::activeLevel();
  $sections = \App\Section::activeSection();
@endphp

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Karunungan Village Academy</title>

    <!-- Bootstrap -->
    <link href="{{asset('template/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('template/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('template/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('template/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{asset('template/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('template/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('template/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('template/build/css/custom.min.css')}}" rel="stylesheet">

    <style>
     /* Dropdown Button */
.dropbtn {
  background-color: transparent;
  color: black;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  right: 0; 
  left: auto;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown:hover .dropdown-content {display: block;}

  
h2 {
      color:black;
     }
  td:empty::after {
      content: "N/A";
  }

  .side-menu, .x_title {
    text-transform: uppercase;
  }

    </style>
  </head>

  <body class="nav-md">
    <div class="container body" id="app">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
              <user-info baseurl="{{ asset('images/StudentImage') }}"></user-info>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                  <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Home</a></li>

                  <!-- @if(Auth::user()->role_id == 3)

                    <li><a href="{{ url('/home/advisers') }}"><i class="fa fa-user-md"></i> Advisers</a></li>

                    <li><a href="{{ url('/home/levels') }}"><i class="fa fa-level-up"></i> Levels</a></li>

                    <li><a href="{{ url('/home/school-years') }}"><i class="fa fa-book"></i> School Years</a></li>

                    <li><a href="{{ url('/home/sections') }}"><i class="fa fa-list-alt"></i> Section</a></li>
                    
                    <li><a href="{{ url('/home/students') }}"><i class="fa fa-group"></i> Students</a></li>

                    <li><a href="{{ url('/home/subjects') }}"><i class="fa fa-file"></i> Subjects</a></li>

                  @elseif(Auth::user()->role_id == 4)

                    <li><a href="{{ url('/home/sections') }}"><i class="fa fa-list-alt"></i> Section</a></li>

                  @endif -->
                </ul>
              </div>

              
              <div class="menu_section">
                <h3>Data</h3>
                <ul class="nav side-menu">

                  @if(Auth::user()->role_id == 3)
                  <li><a><i class="fa fa-group"></i> Students <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      @foreach($levels as $level)
                        <li><a href="{{ url('/home/students/level/' . $level->id) }}">{{$level->name}}</a></li>
                      @endforeach

                      <li><a href="{{ url('/home/students') }}">All Students</a></li>
                    </ul>
                  </li>

                  <!-- <li><a href="{{ url('/home/students') }}"><i class="fa fa-group"></i> Students</a></li> -->

                  <li><a href="{{ url('/home/advisers') }}"><i class="fa fa-user-md"></i> Teachers</a></li>

                  <li><a href="{{ url('/home/levels') }}"><i class="fa fa-level-up"></i> Grade Levels</a></li>

                  <li><a href="{{ url('/home/subjects') }}"><i class="fa fa-file"></i> Subjects</a></li>

                  <li><a href="{{ url('/home/sections') }}"><i class="fa fa-list-alt"></i> Sections</a></li>

                  <li><a href="{{ url('/home/school-years') }}"><i class="fa fa-book"></i> School Years</a></li>
                  
                  <li><a href="{{ url('/home/requests') }}"><i class="fa fa-file"></i> Request Credentials</a></li>

                  @elseif(Auth::user()->role_id == 4)

                  <li><a href="{{ url('/home/sections') }}"><i class="fa fa-list-alt"></i> Section</a></li>

                  @endif

                  <li><a href="{{ url('/about-us') }}"><i class="fa fa-info-circle"></i> About KVA</a></li>
                    
                </ul>
              </div>

              @if(Auth::user()->role_id == 3)
              <div class="menu_section">
                <h3>Printable Reports</h3>
                <ul class="nav side-menu">

                  <li><a><i class="fa fa-group"></i> Students <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <!-- All students -->
                        <li><a class="confirmDownload" data-url="{{ url('/print/exportStudents/all/na/0') }}">All Students<span class="fa fa-download"></span></a></li>
                        <!-- Per Level -->
                        </li
                        ><li class=""><a>Per level<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none;">
                            @foreach($levels as $level)
                              <li><a class="confirmDownload" data-url="{{ url('/print/exportStudents/level/' . $level->id) . '/0'}}">{{$level->name}}<span class="fa fa-download"></span></a></li>
                            @endforeach
                          </ul>
                        </li>
                        <!-- Per Section -->
                        </li><li class=""><a>Per Section<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none;">
                            @foreach($sections as $section)
                              <li><a class="confirmDownload" data-url="{{ url('/print/exportStudents/section/' . $section->id) . '/0' }}">{{$section->code}}<span class="fa fa-download"></a></li>
                            @endforeach
                          </ul>
                        </li>
                    </ul>
                  </li>
                </ul>
              </div>
              @endif

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="{{ url('home/settings') }}" data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>

              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile " aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('images/kvalogo.jfif')}}" alt="">Karunungan Village Academy!
                  </a>
                </li>

            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        @yield('content')

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Karunungan Village Academy
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
     
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <!-- Vue app.ks -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery -->
    <script src="{{asset('template/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('template/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('template/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('template/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('template/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('template/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('template/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('template/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('template/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('template/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('template/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('template/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('template/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('template/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('template/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('template/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('template/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('template/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('template/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('template/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('template/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('template/vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('template/vendors/morris.js/morris.min.js')}}"></script>
    <script src="{{asset('template/build/js/custom.min.js')}}"></script>

  </body>
    <script>
    if ($('#student_chart').length) {
        Morris.Bar({
            element: 'student_chart',
            data: [
                { device: 'Total Student', geekbench: "{{!empty($data) ? count($data['students']) : 0}}" },
                { device: 'Total Teachers', geekbench: "{{!empty($data) ? count($data['instructors']) : 0}}" },
                { device: 'Enrolled', geekbench: "{{!empty($data) ? count($data['enrolledStudents']) : 0}}" },
                { device: 'Pre-enrolled', geekbench: "{{!empty($data) ? count($data['preEnrolledStudents']) : 0}}" },
            ],
            xkey: 'device',
            ykeys: ['geekbench'],
            labels: ['Count'],
            barRatio: 0.4,
            barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
            xLabelAngle: 0,
            hideHover: 'auto',
            resize: true
        });

    }
    $('.confirmDownload').click(function () {
        var url = $(this).data('url');
        noty({
          text: 'Are you sure to download this list?',
          buttons: [
            {addClass: 'btn btn-primary', text: 'Yes', onClick: function($noty) {
                window.open(url);
                $noty.close();
              }
            },
            {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
                $noty.close();
              }
            }
          ]
        });
    });
    </script>
</html>