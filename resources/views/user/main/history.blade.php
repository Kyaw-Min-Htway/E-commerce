@extends('user.layouts.master')

@section('content')
     <!-- Cart Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0"  id="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o )
                            <tr>
                                <td class="align-middle">{{$o->created_at->format('j-F-Y')}}</td>
                                <td class="align-middle">{{$o->order_code}}</td>
                                <td class="align-middle">{{$o->total_price}}</td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <span class="text-warning"><i class="fa-solid fa-clock"></i> Pending...</span>
                                    @elseif ($o->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check"></i> Success</span>
                                    @elseif ($o->status == 2)
                                        <span class="text-dange"><i class="fa-solid fa-exclamation"></i> Reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <span class="mt-4">
                    {{ $order->links() }}
                </span>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
