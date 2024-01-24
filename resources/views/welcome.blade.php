@extends('layouts.app')

@section('content')
    <master-component session_user="{{ Auth::user() ? Auth::user()->toJson() : null }}"></master-component>
@endsection
