@extends('admin.layouts.master')

@section('title', 'Order List')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                </div>

               <div class="table-responsive table-responsive-data2">
                <a href="{{route('admin#list')}}" class="text-dark"><i class="fa-solid fa-arrow-left-long"></i> Back</a>

                <div class="row col-5">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h3>Order Info
                                <small class="text-danger">
                                    (Include Delivery Charges)
                                </small>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user mx-3"></i> Name</div>
                                <div class="col"> {{ strtoupper($orderList[0]->user_name )}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-barcode mx-3"></i> Order Code</div>
                                <div class="col"> {{ $orderList[0]->order_code }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-regular fa-clock mx-3"></i> Order Date</div>
                                <div class="col"> {{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-money-bill mx-3"></i></i> Total price</div>
                                <div class="col"> {{ $order->total_price }} kyats</div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Order Date</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($orderList as $o)
                        <tr class="tr-shadow">
                            <th></th>
                            <td>{{$o->user_id }}</td>
                            <td>{{$o->user_name }}</td>
                            <td class="img-thumbnail shadow-sm align-middle col-2"><img src="{{asset('storage/'.$o->product_image)}}"></td>
                            <td>{{ $o->product_name }}</td>
                            <td>{{$o->created_at->format('F-j-Y') }}</td>
                            <td>{{$o->qty }}</td>
                            <td>{{$o->total }} Kyats</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
