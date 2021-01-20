@extends('layouts.admin')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">

          <div class="row">

          <student-profile baseurl="{{ asset('images/StudentImage') }}" student="{{ $user }}" settings="{{$settings}}"></student-profile>


          <student-basic user="{{ $user }}"></student-basic>

            


          </div>
        </div>
        <!-- /page content -->
@endsection
