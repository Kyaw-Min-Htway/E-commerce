@extends('user.layouts.master')

@section('content')
     <!-- Cart Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0"  id="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($pizza as $p)
                        <tr>
                            <td class="align-middle"><img src="{{asset('storage/'.$p->pizza_image)}}" alt="" style="height: 50px;"> {{ $p->pizza_name }}</td>
                            <input type="hidden" id="productId" class="" value="{{$p->product_id}}">
                            <input type="hidden" id="userId" class="" value="{{$p->user_id}}">
                            <input type="hidden" id="Id" class="" value="{{$p->id}}">
                            <td class="align-middle" id="price">{{$p->pizza_price}} kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$p->qty}}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{$p->pizza_price*$p->qty}} kyats</td>
                           <td><a href="#" class="btn btn-danger text-center btnRemove "><i class="fa-solid fa-x"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $totalPrice }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{ $totalPrice+3000 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 text-white" id="orderBtn"><span class="text-white">Proceed To Checkout</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('jsScript')
    <script>
        $(document).ready(function(){
        $('.btn-plus').click(function(){
            $parentNode = $(this).parents("tr");
            $price = Number($parentNode.find("#price").html().replace("kyats",""));
            $qty = Number($parentNode.find('#qty').val());

            $total = $price*$qty;

            $parentNode.find("#total").html($total+" kyats");
            summary();

        })

        $('.btn-minus').click(function(){
            $parentNode = $(this).parents("tr");
            $price = Number($parentNode.find("#price").html().replace("kyats",""));
            $qty = Number($parentNode.find('#qty').val());

            $total = $price*$qty;

            $parentNode.find("#total").html($total+" kyats");
            summary();
        })

        $(".btnRemove").click(function(){
            $parentNode = $(this).parents("tr");
            $productId = $parentNode.find('#productId').val();
            $Id = $parentNode.find('#Id').val();
            $.ajax({
                type : 'get' ,
                url  : 'http://localhost:8000/ajax/product/remove' ,
                data : {'productId' : $productId, 'Id' : $Id} ,
                dataType : 'json' ,
            });
            $parentNode.remove();
            summary();
        })

        function summary(){
            $totalPrice = 0 ;
            $("#table tr").each(function(index,row){
                $totalPrice += Number($(row).find("#total").text().replace("kyats",""));
            })

            $("#subTotal").html(`${$totalPrice} kyats`);
            $("#finalTotal").html(`${$totalPrice + 3000} kyats`);
        }

        $('#orderBtn').click(function(){
           $orderList = [];

           $random = Math.floor(Math.random() * 100001);

           $('#table tbody tr').each(function(index,row){
                $orderList.push({
                    'user_id' : $(row).find('#userId').val(),
                    'product_id': $(row).find('#productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : $(row).find('#total').text().replace('kyats','')*1,
                    'order_code' : 'kmh0000' + $random
                });
           });


           $.ajax({
            type : 'get' ,
            url  : 'http://localhost:8000/ajax/pizzas/order' ,
            data : Object.assign({}, $orderList) ,
            dataType : 'json' ,
            success : function(response){
                if(response.status == 'true'){
                    window.location.href = 'http://localhost:8000/user/home';
                }
            }
           })
        })

    });
    </script>
@endsection
