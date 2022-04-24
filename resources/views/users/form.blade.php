<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name: <span class='text-danger'>*</span></label>
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'id' => 'name']) !!}
                            @error('name')
                                <span class="invalid feedback text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email: <span class='text-danger'>*</span></label>
                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email']) !!}
                            @error('email')
                                <span class="invalid feedback text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Password: <span class='text-danger'>*</span></label>
                            {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control']) !!}
                            @error('password')
                                <span class="invalid feedback text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Confirm Password:</label>
                            {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password','class' => 'form-control']) !!}
                            @error('confirm-password')
                                <span class="invalid feedback text-danger" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Phone Number:</label>
                            {!! Form::text('phone_number', null, ['placeholder' => 'Phone Number', 'class' => 'form-control numbersOnly', 'id' => 'phone_number', 'maxlength' => '10', 'size' => '10', 'pattern' => '[6789][0-9]{9}']) !!}
                            <span class="invalid text-danger errmsg"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role">Role: <span class='text-danger'>*</span></label>
                            {!! Form::select('role', $roles, null, ['class' => 'form-control single-select', 'placeholder' => 'Select Role', 'id' => 'role', 'required']) !!}
                        </div>
                    </div>

                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
