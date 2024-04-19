@extends('layouts.master')

@section('content')
@section('title','Login')
<div class="login-form">
    <form action="{{ route('login') }}" method="post">
        @csrf
        @error('terms')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" value="{{old('email ')}}" placeholder="Email">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        </div>

        <a href="{{ route('home')}}">
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Login</button>
        </a>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{ route('auth#registerpage') }}">Sign Up Here</a>
        </p>
    </div>
</div>
@endsection
