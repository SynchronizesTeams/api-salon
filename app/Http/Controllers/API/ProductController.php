<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProducts() {
        $products = DB::table('products')->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function getProduct($id) {
        $product = DB::table('products')->where('id', '=', $id)->first();
        return response()->json([
            'success' => $product ? true : false,
            'data' => $product
        ]);
    }

    public function addProduct(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
        ]);
        $product = null;

        DB::transaction(function () use ($request, &$product) {
            $product = Product::create([
                'name' => $request->name,
                'image' => $request->image,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        });

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}
