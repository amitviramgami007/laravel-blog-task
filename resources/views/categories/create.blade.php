@extends('layouts.simple.master')

@section('css')
@endsection

@section('breadcrumb-title')
    <h3>Category Create</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

    {!! Form::open(['route' => 'categories.store', 'method'=>'POST']) !!}
        @include('categories.form')
    {!! Form::close() !!}

@endsection

@section('script')
@endsection
