@extends('layouts.simple.master')

@section('css')
@endsection

@section('breadcrumb-title')
    <h3>Category Edit</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    {!! Form::model($category, ['method' => 'PATCH', 'route' => ['categories.update', $category->id]]) !!}
        @include('categories.form')
    {!! Form::close() !!}

@endsection

@section('script')
@endsection
