@extends('layouts.simple.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-lte/plugins/select2/css/select2.min.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Post Edit</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Posts</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    {!! Form::model($post, ['method' => 'PATCH', 'route' => ['posts.update', $post->id]]) !!}
        @include('posts.form')
    {!! Form::close() !!}

@endsection

@include('posts.script')
