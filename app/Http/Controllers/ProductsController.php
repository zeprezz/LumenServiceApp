<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);

        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'brand' => 'required|string|max:255',
            'status' => 'required|string|max:255'
        ]);

        $product = Product::create($request->only([
            'name',
            'description',
            'category',
            'price',
            'stock',
            'brand',
            'status'
        ]));

        return response()->json($product, 201);
    }

    public function show($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json($product, 200);
    }

    public function update(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $this->validate($request, [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'category' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'brand' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|max:255'
        ]);

        $product->update($request->only([
            'name',
            'description',
            'category',
            'price',
            'stock',
            'brand',
            'status'
        ]));

        return response()->json($product, 200);
    }

    public function destroy($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus',
            'product_id' => $productId
        ], 200);
    }
}