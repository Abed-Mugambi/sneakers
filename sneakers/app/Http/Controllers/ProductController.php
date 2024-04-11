<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  ProductCollection::collection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'detail'=> 'required|string|max:255',
            'price'=> 'required|numeric|min:0',
            'stock'=> 'required|numeric|min:0|max:6',
            'discount'=> 'required|numeric|min:0|max:2',
            // Add validation rules for other fields as needed
        ]);

        // Create a new product
        $product = Product::create([
            'name' => $request->name,
            'detail' => $request->detail,

            'price' => $request->price,
            'stock' => $request->stock,
            'discount' => $request->discount,

            // Set other fields as needed
        ]);

        // Return a JSON response with the created product
        return response()->json(['product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // return $product = Product::find($id);
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        
        return response()->json(['product' => $product], 200);


        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
