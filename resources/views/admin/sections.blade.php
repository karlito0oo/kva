@extends((Auth::user()->role_id == 1 ? 'layouts.student' : 'layouts.admin'))

@section('content')

    <sections-datatable user="{{ Auth::user() }}"></sections-datatable>
@endsection
