<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::all();
        return response()->json(['success' => true, 'products' => $products]);
    }

    public function getProductById($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }
        return response()->json(['success' => true, 'product' => $product]);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'offerPrice' => 'required|numeric',
            'category' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imageUrls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $imageUrls[] = $uploadedFileUrl;
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => explode("\n", $request->description), // Assuming newline separated as it was array in schema
            'price' => $request->price,
            'offerPrice' => $request->offerPrice,
            'image' => $imageUrls,
            'category' => $request->category,
            'inStock' => true,
        ]);

        return response()->json(['success' => true, 'message' => 'Product Added Successfully', 'product' => $product]);
    }

    public function changeStock(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $product->inStock = !$product->inStock;
        $product->save();

        return response()->json(['success' => true, 'message' => 'Stock status updated', 'product' => $product]);
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product Deleted']);
    }
}
