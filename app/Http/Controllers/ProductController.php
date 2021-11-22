<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Location;
use Illuminate\Http\Request;
use Validator;
use Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() ){
            if(Auth::user()->role == 'User'){
                $user_id = Auth::user()->id;
                $products = Product::userProducts()->get();
                $locations = Location::pluck('name', 'id');
                $product_types = ProductType::pluck('type', 'id');
                return view('user/products')->with(compact('products','locations','product_types'));
            }else if(Auth::user()->role == 'Admin'){
                return redirect('/admin/dashboard');   
            }
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'name'=> 'required|max:255',
            'description' => 'required|max:500',
            'location_id' => 'required|integer|min:1|exists:locations,id',
            'product_type_id' => 'required|integer|min:1|exists:product_types,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => 'Error'], 200);
        }
        
        try{

            $product = $request->all();

            $product = Product::create($product);

            return response()->json(['message'=> 'Product has been created successfully','data' => $product, 'status' => 'Success'], 200);;


        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Auth::check() ){
            if(Auth::user()->role == 'User'){
                $user_id = Auth::user()->id;
                $products = Product::userProducts()->get();
                
                return view('user/products')->with(compact('products'));
            }else if(Auth::user()->role == 'Admin'){
                $user_id = Auth::user()->id;
                $products = Product::all();
                $locations = Location::pluck('name', 'id');
                $product_types = ProductType::pluck('type', 'id');
                //print_r($products);
                return view('admin/products')->with(compact('products','locations','product_types'));  
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->toArray(), [
            'name'=> 'required|max:255',
            'description' => 'required|max:500',
            'location_id' => 'required|integer|min:1|exists:locations,id',
            'product_type_id' => 'required|integer|min:1|exists:product_types,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => 'Error'], 200);
        }
        
        try{

            $product->name = $request->name;
            $product->description = $request->description;
            $product->location_id = $request->location_id;
            $product->product_type_id = $request->product_type_id;

            $product->save();

            return response()->json(['message'=> 'Product has been updated successfully','data' => $product, 'status' => 'Success'], 200);;


        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();

            return response()->json(['message'=> 'Product has been deleted successfully', 'status' => 'Success'], 200);;

        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }
}
