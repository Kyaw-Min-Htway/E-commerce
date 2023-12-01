@extends('user.layouts.master');

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary p-3">Filter by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="text-dark d-flex align-items-center justify-content-between mb-3">
                            <label class="mt-2">Categories</label>
                            <span class="badge border font-weight-normal text-dark">{{ count($category) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between mb-3 pt-1">
                            <a href="{{ route('user#home') }}" class="form-control text-decoration-none text-center"><label for="price-1" class="">All categories</label></a>
                        </div>
                        @foreach ($category as $c )
                        <div class="d-flex align-items-center justify-content-between mb-3 pt-1">
                            <a href="{{ route('user#filter',$c->id) }}" class="form-control text-decoration-none text-center"><label for="price-1" class="">{{ $c->name }}</label></a>
                        </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{route('user#cart')}}">
                                    <button type="button" class="btn btn-dark position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i> My Cart
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($cart)}}
                                        </span>
                                      </button>
                                </a>
                                <a href="{{route('user#history')}}" class="ms-2">
                                    <button type="button" class="btn btn-dark position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i> History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($order)}}
                                        </span>
                                      </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button> --}}
                                    {{-- <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div> --}}
                                    <select name="sorting" id="sortingOption" class="form-select">
                                        <option value="">Order By Sorting</option>
                                        <option value="desc">Latest</option>
                                        <option value="asc">Popularity</option>
                                    </select>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                <span class="row" id="dataList">
                    @if (count($pizza) != 0)
                    @foreach ($pizza as $p )
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image)}}" alt="" style="height: 290px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{route('pizza#details',$p->id)}}"><i class="fa-solid fa-eye fa-beat-fade  mt-1"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <h2 class="text-center">There is no pizza <i class="fa-solid fa-pizza-slice ms-3"></i></h2>
                    @endif
                </span>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('jsScript')
   <script>
     $(document).ready(function(){

        $('#sortingOption').change(function(){
            $eventOption = $('#sortingOption').val();

            if($eventOption == 'desc'){
                $.ajax({
                type : 'get' ,
                url  : 'http://localhost:8000/ajax/pizza/list' ,
                data : {'status' : 'desc'} ,
                dataType : 'json' ,
                success  : function(response){

                    $list = '';
                    for($i=0;$i<response.length;$i++){
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 290px" src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    }
                    $('#dataList').html($list);
            }
        })
            }else if($eventOption == 'asc'){
                $.ajax({
                type : 'get' ,
                url  : 'http://localhost:8000/ajax/pizza/list' ,
                data : {'status' : 'asc'} ,
                dataType : 'json' ,
                success  : function(response){
                    $list = "";
                    for($i=0;$i<response.length;$i++){
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 290px" src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    }
                    $('#dataList').html($list);
            }
        })
            }
        })
    });
   </script>
@endsection

