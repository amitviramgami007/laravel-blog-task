@extends('layouts.simple.master')

@section('breadcrumb-title')
    <h3>Post Detail</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Posts</li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Title:</label>
                                {{ $post->title }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Category:</label>
                                @foreach($post->categories as $category)
                                    <div class="badge badge-info">{{ $category->title }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Created By:</label>
                                {{ getUserName($post->created_by) }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Updated By:</label>
                                {{ getUserName($post->updated_by) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
