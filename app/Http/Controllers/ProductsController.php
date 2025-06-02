<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ProductsController extends Controller
{
    // GET /api/products
    public function index()
    {
        return response()->json(Product::all());
    }

    // POST /api/products
    public function store(Request $request)
    {
         $validated = $request->validate([
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

        $product = Product::create($validated);
        // return response()->json($product, 201);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::find($id);
        return $product
            ? response()->json($product)
            : response()->json(['message' => 'Product not found'], 404);
    }

    // PUT /api/products/{id}
    // public function update(Request $request, $id)
    // {
    //     $product = Product::find($id);
    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found'], 404);
    //     }

    //     $product->ProductID = $request->ProductID ?? $product->ProductID;
    //     $product->Name = $request->Name ?? $product->Name;
    //     $product->Description = $request->Description ?? $product->Description;
    //     $product->Price = $request->Price ?? $product->Price;
    //     $product->StockQuantity = $request->StockQuantity ?? $product->StockQuantity;
    //     $product->Brand = $request->Brand ?? $product->Brand;
    //     $product->Category = $request->Category ?? $product->Category;
    //     $product->Discount_Price = $request->Discount_Price ?? $product->Discount_Price;

    //     $product->save();

    //     return response()->json($product);
    // }

    // DELETE /api/products/{id}
    // public function destroy($id)
    // {
    //     $product = Product::find($id);
    //     if (!$product) return response()->json(['message' => 'Product not found'], 404);

    //     $product->delete();
    //     return response()->json(['message' => 'Product deleted']);
    // }
    public function showProductPage()
    {
    $products = Product::all();
    return view('products.index', compact('products'));
    }
public function update(Request $request, $id)
{
    $request->validate([
        'Name' => 'required|string|max:255',
        'Brand' => 'required|string|max:255',
        'Price' => 'required|numeric|min:0',
        'Description' => 'nullable|string',
        'img_url' => 'nullable|url',
    ]);

    $product = Product::findOrFail($id);
    $product->Name = $request->input('Name');
    $product->Brand = $request->input('Brand');
    $product->Price = $request->input('Price');
    $product->Description = $request->input('Description');
    $product->img_url = $request->input('img_url');
    $product->save();

    return redirect()->route('product.viewall')->with('message', 'Product updated successfully!');
}
public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('addProducts', compact('product')); // reuse the same form view
}
    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->back()->with('message', 'Product deleted successfully.');
}
}