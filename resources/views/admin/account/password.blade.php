@extends('admin.layouts.master')

@section('title', 'Change Password')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        @if (session('detail'))
                        <div class="alert alert-danger">
                            {{session('detail')}}
                        </div>
                    @endif
                        <form action="{{ route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                @error('oldPassword')
                                 <div class="invalid-feedback">
                                    <small class="text-danger">{{ $message }}</small>
                                 </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                @error('newPassword')
                                <div class="invalid-feedback">
                                   <small class="text-danger">{{ $message }}</small>
                                </div>
                               @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Retype Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                @error('confirmPassword')
                                <div class="invalid-feedback">
                                   <small class="text-danger">{{ $message }}</small>
                                </div>
                               @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-info btn-block">
                                    Change Password
                                </button>
                            </div>
                        </form>
                        <div class="password-link mt-2">
                            <p>
                                <a href="{{ route('auth#registerpage') }}">forgotten your password?</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
