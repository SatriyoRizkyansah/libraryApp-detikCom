<!-- resources/views/auther/register.blade.php -->
@extends('layouts.guest')

@section('content')
<div id="wrapper-register">
    <div class="container mt-5">
        <div class="row">
            <div class="offset-md-4 col-md-4">
                <form class="yourform" action="{{ route('register') }}" method="post">
                    @csrf
                    <h3 class="heading">Register</h3>
                    <p class="text-danger">*Note : if you success create account, you will redirect to login form</p>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                        <div class='alert alert-danger'>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                        @error('username')
                        <div class='alert alert-danger'>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                        <div class='alert alert-danger'>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <input type="submit" name="register" class="btn btn-primary" value="Register" />
                    <p class="mt-2">Already have an account? login <a href="/">here</a></p>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
