@extends('layouts.admin')

@section('content')

    <sections-datatable user="{{ Auth::user() }}"></sections-datatable>
@endsection
