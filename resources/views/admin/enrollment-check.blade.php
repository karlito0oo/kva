@extends('layouts.admin')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          
        <student-enrollment student="{{ $student }}" accessing="admin"></student-enrollment>
          
        </div>

        <!-- /page content -->
@endsection
