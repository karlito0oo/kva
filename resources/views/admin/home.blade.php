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
                      <span class="count_top"><i class="fa fa-user"></i> Current School Year</span>
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
                      <span class="count_top"><i class="fa fa-user"></i> Instructors</span>
                      <div class="count green">{{count($data['instructors'])}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4  tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i> Pre-enrolled</span>
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

          


          
        </div>
        <!-- /page content -->
@endsection
