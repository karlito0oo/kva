@extends((Auth::user()->role_id == 1 ? 'layouts.student' : 'layouts.admin'))

@section('content')

    <requests-datatable is-enrolled="{{!empty(Auth::user()->currentEnrollment) ? 1 : 0}}" is-admin="{{Auth::user()->role_id == 3  ? 1 : 0}}" />
@endsection
