@extends('admin.layouts.master')

@section('title', 'Edit Profile')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Edit</h3>
                        </div>
                        <hr>
                       <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4 offset-1">
                                <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                <div class="form-group mt-4">
                                    <label for="cc-payment" class="control-label ">Product's Name</label>
                                    <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$pizza->name) }}" aria-required="true" aria-invalid="false">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <img src="{{ asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm mt-1"/>
                                <div class="form-group mt-1">
                                    <label for="cc-payment" class="control-label mb-1">Edit product's image</label>
                                    <input type="file" name="image" id="" class="form-control">
                                </div>
                                <div class="mt-1">
                                    <button type="submit" class="btn bg-primary text-white col-12">
                                        <i class="fa-solid fa-arrow-right me-1"></i> Change
                                    </button>
                                </div>
                            </div>
                            <div class="row col-6">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label ">Price</label>
                                    <input id="cc-pament" name="price" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$pizza->price) }}" aria-required="true" aria-invalid="false">
                                    @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Choose Category</option>
                                        @foreach ( $category as $c)
                                            <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id)
                                                selected
                                            @endif>{{ $c->name }}</option>
                                        @endforeach
                                        @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label ">Description</label>
                                    <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ $pizza->description }}</textarea>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
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
