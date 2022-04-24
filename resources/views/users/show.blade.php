@extends('layouts.simple.master')

@section('breadcrumb-title')
    <h3>User Detail</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Users</li>
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
                                <label>Name:</label>
                                {{ $user->name }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email:</label>
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Phone Number:</label>
                                {{ $user->phone_number }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Role:</label>
                                <label class="badge badge-success">{{ $user->role }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
