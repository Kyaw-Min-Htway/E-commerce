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
                @if (session('info'))
                    <div class="alert alert-success">
                        {{session('info')}}
                    </div>
                @endif

                   <div class="row my-2">
                    <div class="col-5">
                        <h3><i class="fa-solid fa-database mr-2"></i>{{ count($order) }}</h3>
                    </div>
                   </div>

                   <form action="{{route('order#status')}}" method="get">
                    @csrf
                    <div class="d-flex">
                        <label for="" class="mt-2 mr-4">Order Status</label>
                        <select name="status" class="form-control col-2" id="status">
                            <option value="">All</option>
                            <option value="0"  @if(request('status') == "0") selected @endif>Pending</option>
                            <option value="1"  @if(request('status') == "1") selected @endif>Accept</option>
                            <option value="2"  @if(request('status') == "2") selected @endif>Reject</option>
                        </select>
                        <button type="submit" class="btn bg-dark text-white mb-1">Search</button>
                       </div>
                   </form>

               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Order Date</th>
                            <th>Order ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                        @foreach ($order as $o)
                        <tr class="tr-shadow">
                            <input type="hidden" id="orderId" value="{{$o->id}}">
                            <td>{{$o->user_id }}</td>
                            <td>{{$o->user_name }}</td>
                            <td>{{$o->created_at->format('F-j-Y') }}</td>
                            <td class="text-primary">
                                <a href="{{ route('list#info',$o->order_code) }}" class="text-primary">
                                    {{$o->order_code }}
                                </a>
                            </td>
                            <td>{{$o->price }} Kyats</td>
                            <td>
                                <select name="" id="statusChange" class="form-control">
                                    <option value="0" @if ($o->status == 0) selected @endif>
                                        Pending
                                    </option>
                                    <option value="1" @if ($o->status == 1) selected @endif>
                                        Accept
                                    </option>
                                    <option value="2" @if ($o->status == 2) selected @endif>
                                        Reject
                                    </option>
                                </select>
                            </td>
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

@section('scriptSection')
    <script>
        $(document).ready(function(){
            // $('#status').change(function(){
            //     $status = $('#status').val();

            //     $.ajax({
            //         type : 'get',
            //         url : 'http://localhost:8000/order/status',
            //         data : {
            //             'status' : $status ,
            //         },
            //         dataType : 'json',
            //         success : function(response){
            //             $list = "";
            //             for($i=0;$i<response.length;$i++){
            //                 $months = ['January','February','March','April','May','June','July','Auguest','September','October','November','December'];
            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = $months[$dbDate.getMonth()] +"-"+$dbDate.getDate() + "-"+ $dbDate.getFullYear();

            //                 if(response[$i].status == 0){
            //                     $statusMessage = `
            //                     <select name="" id="statusChange" class="form-control">
            //                         <option value="0" selected>
            //                             Pending
            //                         </option>
            //                         <option value="1">
            //                             Accept
            //                         </option>
            //                         <option value="2">
            //                             Reject
            //                         </option>
            //                     </select>`
            //                 }else if(response[$i].status == 1){
            //                     $statusMessage = `
            //                     <select name="" id="statusChange" class="form-control">
            //                         <option value="0">
            //                             Pending
            //                         </option>
            //                         <option value="1" selected>
            //                             Accept
            //                         </option>
            //                         <option value="2">
            //                             Reject
            //                         </option>
            //                     </select>
            //                     `
            //                 }else if(response[$i].status == 2){
            //                     $statusMessage = `
            //                     <select name="" id="statusChange" class="form-control">
            //                         <option value="0">
            //                             Pending
            //                         </option>
            //                         <option value="1">
            //                             Accept
            //                         </option>
            //                         <option value="2" selected>
            //                             Reject
            //                         </option>
            //                     </select>
            //                     `
            //                 }
            //                 $list += `
            //             <tr class="tr-shadow">
            //                 <td> ${response[$i].user_id} </td>
            //                 <td> ${response[$i].user_name} </td>
            //                 <td> ${$finalDate} </td>
            //                 <td> ${response[$i].order_code} </td>
            //                 <td> ${response[$i].total_price}  Kyats</td>
            //                 <td>
            //                     ${$statusMessage}
            //                 </td>
            //             </tr>
            //                 `
            //             }
            //             $('#dataList').html($list);
            //         }
            //     })

            // })

            $('#statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('#orderId').val();

                $data = {
                    'status' : $currentStatus,
                    'orderId' : $orderId
                };

                $.ajax({
                    type : 'get' ,
                    url : 'http://localhost:8000/order/change',
                    data : $data,
                    dataType : 'json' ,
                })

            })
        })
    </script>
@endsection
