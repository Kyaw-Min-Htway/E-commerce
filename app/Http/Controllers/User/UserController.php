<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;

class UserController extends Controller
{
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('pizza','category','cart','order'));
    }

    public function changePassword(){
        return view('user.account.password');
    }

    public function passwordUpdate(Request $request){
        $this-> PasswordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;

        if(Hash::check($request->oldPassword,$dbPassword)){

            $data = ['password' => Hash::make($request->newPassword)];

            User::where('id',Auth::user()->id)->update($data);


            return back()->with(['detail' => 'Change Password Success...']);

        }
        return back()->with(['detail'=> 'The old Password do not match.Try again!']);
    }
    private function PasswordValidationCheck($request){
        validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }

    public function details(){
        return view('user.account.details');
    }

    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('pizza','category','cart','order'));
    }

    public function pizzaDetails($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    public function update($id,Request $request){
        $this->AccountValidationCheck($request);
        $data = $this->getUserData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            };
        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        }

        User::where('id',$id)->update($data);
        return redirect()->route('user#details')->with(['info' => 'Profile Updated...' ]);
    }

    public function cartList(){
        $pizza = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                 ->leftJoin('products','products.id','carts.product_id')
                 ->where('carts.user_id',Auth::user()->id)->get();

        $totalPrice = 0;

        foreach($pizza as $p){
            $totalPrice += $p->pizza_price*$p->qty;
        }

        return view('user.main.list',compact('pizza','totalPrice'));
    }

    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.history',compact('order'));
    }

    public function contact(){
        return view('user.contact.contact');
    }

    public function aboutus(){
        return view('user.aboutus.aboutus');
    }

    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }
    private function AccountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ])->validate();
    }

}
