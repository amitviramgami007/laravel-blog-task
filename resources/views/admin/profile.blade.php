@extends('layouts.simple.master')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit Profile</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ Auth::user()->avatar ? asset('/storage/images/'.Auth::user()->avatar) : asset('images/avatar.png') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ Auth::user()->full_name }}</h3>

                            <form action="{{ route('updateAvatar') }}" method="post" enctype="multipart/form-data" class="theme-form text-center" id="updateAvatarForm">
                                @csrf
                                <input class="form-control mb-3" name="avatar_image" type="file" data-bs-original-title="" title="" id="avatar_image">
                                @error('avatar_image')
                                    <span class="invalid feedback text-danger mb-3" role="alert">{{ $message }}</span>
                                @enderror
                                <input type="submit" value="Change Picture" class="btn btn-primary btn-block">
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#information" data-toggle="tab">Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#changePassword" data-toggle="tab">Password</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="information">
                                    <form class="form-horizontal" method="POST" action="{{ route('updateProfileInfo') }}" id="adminInfoForm">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                {!! Form::text('name', Auth::user()->full_name ?? null, ['placeholder' => 'Name', 'class' => 'form-control', 'id' => 'name']) !!}
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                {!! Form::text('email', Auth::user()->email ??null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email', 'readonly']) !!}
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="changePassword">
                                    <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}" id="changePasswordForm">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="oldPassword" class="col-sm-3 col-form-label">Old Password</label>
                                            <div class="col-sm-9">
                                                {!! Form::password('oldpassword', ['placeholder' => 'Enter Current Password', 'class' => 'form-control', 'id' => 'oldPassword']) !!}
                                                <input type="checkbox" onclick="showPassword('oldPassword')"> Show Current Password
                                                <span class="text-danger error-text oldpassword_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                                            <div class="col-sm-9">
                                                {!! Form::password('newpassword', ['placeholder' => 'Enter New Password', 'class' => 'form-control', 'id' => 'newPassword']) !!}
                                                <input type="checkbox" onclick="showPassword('newPassword')"> Show New Password
                                                <span class="text-danger error-text newpassword_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                                            <div class="col-sm-9">
                                                {!! Form::password('cnewpassword', ['placeholder' => 'ReEnter New Password', 'class' => 'form-control', 'id' => 'confirmPassword']) !!}
                                                <input type="checkbox" onclick="showPassword('confirmPassword')"> Show Confirm Password
                                                <span class="text-danger error-text cnewpassword_error"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button class="btn btn-primary" type="submit">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('script')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
