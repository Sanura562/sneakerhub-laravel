<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class apiController extends Controller
{
 public function getProducts(Request $request)
 {
     $products = Product::all();
     return response()->json($products);
 }
 public function getProductById($id)
 {
     $product = Product::find($id);
     if ($product) {
         return response()->json($product);
     } else {
         return response()->json(['message' => 'Product not found'], 404);
     }
 }
 public function store(Request $request)
 {
     $validatedData = $request->validate([
         'ProductID' => 'required|string|unique:products,ProductID',
        'Name' => 'required|string',
        'Description' => 'nullable|string',
        'Price' => 'required|numeric',
        'StockQuantity' => 'required|integer',
        'Brand' => 'nullable|string',
        'Category' => 'nullable|string',
        'Discount_Price' => 'nullable|numeric',
        'img_url' => 'nullable|url', 
     ]);

     $product = Product::create($validatedData);

     return response()->json($product, 201);
 }
 public function update(Request $request, $id)
 {
     $product = Product::find($id);
     if (!$product) {
         return response()->json(['message' => 'Product not found'], 404);
     }

     $validatedData = $request->validate([
         'ProductID' => 'required|string|unique:products,ProductID',
        'Name' => 'required|string',
        'Description' => 'nullable|string',
        'Price' => 'required|numeric',
        'StockQuantity' => 'required|integer',
        'Brand' => 'nullable|string',
        'Category' => 'nullable|string',
        'Discount_Price' => 'nullable|numeric',
        'img_url' => 'nullable|url', 
     ]);

     $product->update($validatedData);

     return response()->json($product);
 }
 public function destroy($id)
 {
     $product = Product::find($id);
     if (!$product) {
         return response()->json(['message' => 'Product not found'], 404);
     }

     $product->delete();
     return response()->json(['message' => 'Product deleted successfully']);
 }

 
}