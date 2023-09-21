<?php

namespace App\Http\Controllers;

use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    Public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                ->LeftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();
        return view('admin.order.list',compact('order'));
    }

    public function orderStatus(Request $request){

        $order = Order::select('orders.*','users.name as user_name')
                ->LeftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');

        if($request->status == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->status)->get();
        }

        return view('admin.order.list',compact('order'));
    }

    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
                    ->LeftJoin('users','users.id','order_lists.user_id')
                    ->LeftJoin('products','products.id','order_lists.product_id')
                    ->where('order_code',$orderCode)
                    ->get();

        return view('admin.order.orderList',compact('orderList','order'));
    }

    public function statusChange(Request $request){

        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*','users.name as user_name')
                ->LeftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();
    }
}
