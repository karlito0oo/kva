@extends('layouts.admin')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          
        <student-enrollment enrollment_id="{{ $enrollment_id }}" accessing="admin"></student-enrollment>
          
        </div>

        <!-- /page content -->
@endsection
