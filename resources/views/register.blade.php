@extends('layouts.master')

@section('content')
@section('title','Register')
<div class="login-form">
    <form action="{{ route('register')}}" method="post">
        @csrf

        @error('terms')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Username</label>
            <input class="au-input au-input--full @error('name') is-invalid @enderror " type="text" name="name" value="{{old('name')}}" placeholder="Username">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email')}}" placeholder="Email">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input class="au-input au-input--full @error('phone') is-invalid @enderror" type="number" name="phone" value="{{old('phone')}}" placeholder="Phone">
            @error('phone')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="">Choose Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                @error('gender')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </select>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input class="au-input au-input--full @error('address') is-invalid @enderror" type="text" name="address" value="{{old('address')}}" placeholder="Address">
            @error('address')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Comfirm Password</label>
            <input class="au-input au-input--full @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <a href="{{ route('home')}}">
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
        </a>

    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ route('auth#loginpage') }}">Sign In</a>
        </p>
    </div>
</div>
@endsection
