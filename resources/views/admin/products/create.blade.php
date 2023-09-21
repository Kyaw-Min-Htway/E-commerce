@extends('admin.layouts.master')

@section('title', 'Create Pizza')

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
                            <h3 class="text-center title-2">Create your product</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#createPizza')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                @error('name')
                                 <div class="invalid-feedback">
                                    <small class="text-danger">{{ $message }}</small>
                                 </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="category_id" id="" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Choose category</option>
                                    @foreach ($categories as $c )
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                 <div class="invalid-feedback">
                                    <small class="text-danger">{{ $message }}</small>
                                 </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                 <div class="invalid-feedback">
                                    <small class="text-danger">{{ $message }}</small>
                                 </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input id="cc-pament" name="image"type="file" class="form-control @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                @error('image')
                                 <div class="invalid-feedback">
                                    <small class="text-danger">{{ $message }}</small>
                                 </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" value="{{old('price')}}" type="number" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                @error('price')
                                 <div class="invalid-feedback">
                                    <small class="text-danger">{{ $message }}</small>
                                 </div>
                                @enderror
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
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
