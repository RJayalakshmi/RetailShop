<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Route;
use Illuminate\Validation\Rule;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ProductTypes = ProductType::all();
        return view('admin/product_types')->with(compact('ProductTypes'));
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
            'type'=> 'required|max:255|unique:product_types'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => 'Error'], 200);
        }
        
        try{

            $productType = $request->all();

            $productType = ProductType::create($productType);

            return response()->json(['message'=> 'Product Type has been created successfully','data' => $productType, 'status' => 'Success'], 200);;


        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        $validator = Validator::make($request->toArray(), [
            'type'=> ['required','max:255',Rule::unique('product_types')->ignore($productType->id)]
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => 'Error'], 200);
        }
        
        try{

            $productType->type = $request->type;

            $productType->save();

            return response()->json(['message'=> 'Product Type has been updated successfully','data' => $productType, 'status' => 'Success'], 200);;


        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        try{
            // Delete products of product type
            $productType->products()->delete();
            $productType->delete();

            return response()->json(['message'=> 'Product Type has been deleted successfully', 'status' => 'Success'], 200);;

        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status' => 'Error'], 200);
        }
    }
}
