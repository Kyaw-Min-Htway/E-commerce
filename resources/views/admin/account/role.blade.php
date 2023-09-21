@extends('admin.layouts.master')

@section('title', 'Change Role')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('admin#list')}}"><button class="btn bg-dark text-white my-3">User List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                       <form action="{{ route('changed',$admin->id) }}" method="POST">
                        @csrf
                                <label>Role</label>
                                <select name="admin_role" class="form-control">
                                    <option value="admin" @if ($admin->role == 'admin') selected @endif>Admin</option>
                                    <option value="user" @if ($admin->role == 'user') selected @endif>User</option>
                                </select>
                            <div class="mt-5">
                                <button type="submit" class="btn bg-primary text-white col-12">
                                    <i class="fa-solid fa-arrow-right me-1"></i> Change Role
                                </button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
