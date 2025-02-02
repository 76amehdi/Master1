<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function checkLowStock()
    {
        // Get all products where quantity is less than 5
        $products = Product::where('qty', '<', 5)->with('images')->get();

         if ($products->isNotEmpty()) {
             // Map products with necessary details, including the first image path with asset public
             $productDetails = $products->map(function ($product) {
                 return [
                     'id' => $product->id,
                     'title' => $product->title,
                     'image_path' => $product->images->first() && $product->images->first()->image_path
                         ? asset($product->images->first()->image_path)
                         : null,
                 ];
             });

             return response()->json(['status' => 'low_stock', 'products' => $productDetails]);
         } else {
             return response()->json(['status' => 'ok']);
         }
    }
}