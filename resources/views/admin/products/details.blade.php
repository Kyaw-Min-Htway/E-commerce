@extends('admin.layouts.master')

@section('title', 'View Details')

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
                        <div class="ms-5">
                            <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                        </div>
                        <div class="row">
                            <div class="col-3 offset-2">
                            <img src="{{ asset('storage/'. $pizza->image)}}" class="img-thumbnail shadow-sm mt-5"/>
                            </div>
                            <div class="col-7">
                                <span class="my-3 btn bg-primary text-white d-block fs-5 text-center"> {{ $pizza->name }}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-money-bill-wave fs-5 me-2"></i> {{ $pizza->price}}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-eye me-2"></i> {{ $pizza->view_count}}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-clone me-2"></i> {{ $pizza->category_name}}</span>
                                <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-6 fa-user-clock me-2"></i> {{ $pizza->created_at->format('j-F-Y')}} </span>
                            <div class="my-3"><i class="fa-solid fs-4 fa-file-lines me-2"> </i> Description</div>
                            <div class="">{{ $pizza->description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
