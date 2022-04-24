@extends('layouts.simple.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-lte/plugins/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Post Create</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Posts</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

    {!! Form::open(['route' => 'posts.store', 'method'=>'POST']) !!}
        @include('posts.form')
    {!! Form::close() !!}

@endsection

@include('posts.script')
