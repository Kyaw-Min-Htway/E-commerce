@extends('user.layouts.master')

@section('title', 'Edit Profile')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        <hr>
                       <form action="{{ route('user#update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <div class="form-group mt-4">
                                    <label for="cc-payment" class="control-label ">Name</label>
                                    <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name) }}" aria-required="true" aria-invalid="false">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if (Auth::user()->image == null)
                                @if (Auth::user()->gender == 'male')
                                <img src="{{ asset('image/user_profile.png')}}" class="img-thumbnail shadow-sm mt-5"/>
                                @else
                                <img src="{{ asset('image/images.png')}}" class="img-thumbnail shadow-sm mt-5"/>
                                @endif
                                @else
                                <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm mt-5"/>
                                @endif
                                <div class="form-group mt-1">
                                    <label for="cc-payment" class="control-label mb-1">Edit your profile picture</label>
                                    <input type="file" name="image" id="" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label ">Email</label>
                                    <input id="cc-pament" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email) }}" aria-required="true" aria-invalid="false">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label ">Phone</label>
                                    <input id="cc-pament" name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',Auth::user()->phone) }}" aria-required="true" aria-invalid="false">
                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Choose Gender</option>
                                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif >Male</option>
                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                        @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label ">Address</label>
                                    <input id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('phone',Auth::user()->address) }}" aria-required="true" aria-invalid="false">
                                    @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-1">
                                    <button type="submit" class="btn bg-primary text-white col-12">
                                        <i class="fa-solid fa-arrow-right me-1"></i> Change Profile
                                    </button>
                                </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
