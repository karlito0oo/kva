@extends('layouts.admin')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">
                <div class="col-md-12 col-sm-12 ">
                  <!-- top tiles -->
                  <div class="tile_count">
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i> School Year</span>
                      <div class="count green" style="font-size:24px;">{{$data['schoolyear']}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i> Total Students</span>
                      <div class="count green">{{count($data['students'])}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                      <span class="count_top"><i class="fa fa-clock-o"></i> Enrolled this school year</span>
                      <div class="count green">{{count($data['enrolledStudents'])}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i> Teachers</span>
                      <div class="count green">{{count($data['instructors'])}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i> Pre-enrolled Students</span>
                      <div class="count green">{{count($data['preEnrolledStudents'])}}</div>
                    </div>
                    <!-- <div class="col-md-2 col-sm-4  tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i> Enrollment Date</span>
                      <div class="count green" style="font-size:24px;">{{$data['enrollmentDate']}}</div>
                    </div> -->
                  </div>
                  <!-- /top tiles -->
                </div>
                

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">
              <!-- bar chart -->
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bar Chart </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="student_chart" style="width:100%; height:500px;"></div>
                  </div>
                </div>
              </div>
              <!-- /bar charts -->
            </div>
        </div>
        <!-- /page content -->
@endsection

