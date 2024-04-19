<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // function to add product to cart
    public function cart(Request $request, $productId)
    {
        // $product = Product::findOrFail($productId);
        // $request->user()->cart()->attach($product);
        // return response()->json(['message' => 'Product added to cart successfully']);
        // alert('Product added to cart successfully', 'success');
          // Validate the incoming request, ensure required fields are present
          $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'name' => 'required|string|max:255', 
            'details' => 'nullable|string', 
            'price' => 'required|numeric|min:0'
            // Add more validation rules as needed
        ]);

        // Retrieve product details from the request
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Add product to cart - here you can store it in the session or database
        // Example: Storing in the session
        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        if (array_key_exists($productId, $cart)) {
            // If the product already exists, update the quantity
            $cart[$productId] += $quantity;
        } else {
            // If the product doesn't exist, add it to the cart
            $cart[$productId] = $quantity;
        }

        // Store the updated cart in the session
        session()->put('cart', $cart);

        // You can return a response to indicate success or failure
        return response()->json(['message' => 'Product added to cart successfully']);
    }


    // function to get products from cart
    public function getProductsFromCart(Request $request, $productId)
    {

    }

       
    
}
