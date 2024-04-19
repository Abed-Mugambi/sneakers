<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        Log::info('GET /products', ['products' => Product::all()]);
        return  ProductCollection::collection(Product::paginate(60));
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
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'detail' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0|max:1000',
                'discount' => 'required|numeric|min:0|max:1000',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // Add validation rules for other fields as needed
            ]
        );

        // Create a new product
        $product = Product::create([
            'name' => $request->name,
            'detail' => $request->detail,

            'price' => $request->price,
            'stock' => $request->stock,
            'discount' => $request->discount,
            'image' => $request->image,

            // Set other fields as needed
        ]);

        // Return a JSON response with the created product
        return response()->json(['product' => $product], 201);
    }

    

    // get product image
    public function getImage($productId)
    {
        $product = Product::findOrFail($productId);
        $imagePath = $product->image_path; // Assuming the image path is stored in the database

        // Load the image file from storage
        $imageData = Storage::get($imagePath);

        // return the image data as a response
        return response($imageData)->header('Content-Type', 'image/jpeg'); // Adjust Content-Type as needed

        }
    // {
    //     $product = Product::findOrFail($productId);
    //     $imagePath = $product->image_path; // Assuming the image path is stored in the database

    //     // Load the image file from storage
    //     $imageData = Storage::get($imagePath);

    //     // Return the image data as a response
    //     return response($imageData)->header('Content-Type', 'image/jpeg'); // Adjust Content-Type as needed
    // }

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
    public function destroy(Product $product)
    // waas password Murithi1234!

    {
        $product->delete();

        // Product::find($id)->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
