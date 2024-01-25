@extends('layouts.app')

@section('content')
    <admin-component session_user="{{ Auth::user() ? Auth::user()->toJson() : null }}"></admin-component>
@endsection
