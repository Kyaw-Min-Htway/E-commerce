<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Storage;
class ProductController extends Controller
{
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('name','like', '%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('created_at','desc')->paginate(3);


        $pizzas->appends(request()->all());

        return view('admin.products.productList', compact('pizzas'));


    }

    public function delete($id){
        Product::where('id',$id)->delete();

        return redirect()->route('product#list')->with(['info' => 'Pizza deleted']);
    }

    public function details($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->where('id',$id)->first();
        return view('admin.products.details',compact('pizza'));
    }

    public function edit($id){
        $pizza  = Product::where('id',$id)->first();
        $category = Category::get();

        return view('admin.products.edit',compact('pizza','category'));
    }

    public function update(request $request){
        $this->productValidationCheck($request,'update');
        $data = $this->requestProductData($request);

        if($request->hasFile('image')){
            $dbImage = Product::where('id',$request->pizzaId)->first();
            $oldImage = $dbImage->image;

            if($oldImage != null){
                Storage::delete('public/'.$oldImage);

                $fileName = uniqid().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$fileName);
                $data['image'] = $fileName;
            }


        }

        Product::where('id',$request->pizzaId)->update($data);

        return redirect()->route('product#list')->with(['info' => 'Pizza Updated']);
    }

    public function create(){
        $categories = Category::paginate(5);
        return view('admin.products.create',compact('categories'));
    }

    public function createPizza(Request $request){
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductData($request);


        $fileName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] = $fileName;


        Product::create($data);


        return redirect()->route('product#list')->with(['info' => 'Pizza Created']);
    }

    private function productValidationCheck($request,$action){

        $validationRule = [
            'name' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
        ];

        $validationRule['image'] = $action == 'create' ? 'required|mimes:jpg,png,jpeg' : 'mimes:jpg,png,jpeg';

        validator::make($request->all(), $validationRule)->validate();
    }
    private function requestProductData($request){
        return [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ];
    }


}
