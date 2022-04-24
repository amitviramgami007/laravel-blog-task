@extends('layouts.simple.master')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
    {{-- <li class="breadcrumb-item">Dashboard</li> --}}
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                @if(auth()->user()->role == "Admin")
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <a href="{{ route('users.index') }}"><span class="info-box-text">Users</span></a>
                                <span class="info-box-number">{{ $userCount }}</span>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div><!-- /.col -->
                @endif

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-sticky-note"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('posts.index') }}"><span class="info-box-text">Posts</span></a>
                            @if(auth()->user()->role == "Admin")
                                <span class="info-box-number">{{ $postCount }}</span>
                            @else
                                <span class="info-box-number">{{ $userWiesPostCount }}</span>
                            @endif
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list-alt"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('categories.index') }}"><span class="info-box-text">Categories</span></a>
                            <span class="info-box-number">{{ $categoryCount }}</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('script')
@endsection
