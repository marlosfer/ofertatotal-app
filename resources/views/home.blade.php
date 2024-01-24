@extends('layouts.app')

@section('content')
    <master-component :session_user="{{ Auth::user()->toJson() }}"></master-component>
@endsection
