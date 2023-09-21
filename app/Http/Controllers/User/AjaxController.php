<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzaList(Request $request){

        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }

         return response()->json($data, 200);
    }
    public function message(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        Content::create($data);
    }


    public function cart(Request $request){


        $data = $this->getCountData($request);

        Cart::create($data);

        $response = [
            'message' => 'Add to card complete' ,
            'status' => 'success'
        ];

        return response()->json($response, 200);
    }

    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            $total += $data->total ;
        }


        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000
        ]);

        return response()->json([
            'status' => 'true' ,
            'message' => 'Order Completed'
        ]);
    }

    public function productRemove(Request $request){
        Cart::where('user_id',Auth::user()->id)->where('product_id',$request->productId)->where('id',$request->Id)->delete();
    }

    public function viewCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];

        Product::where('id',$request->productId)->update($viewCount);
    }

    private function getCountData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
