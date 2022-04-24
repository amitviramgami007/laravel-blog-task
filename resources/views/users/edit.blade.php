@extends('layouts.simple.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-lte/plugins/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>User Edit</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
        @include('users.form')
    {!! Form::close() !!}

@endsection

@include('users.script')
