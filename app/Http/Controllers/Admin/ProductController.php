<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product', compact('products'));
    }

    public function store(Request $request)
    {
        // dd($request->product_image);

        $request->validate([
            'name' => ['required'],
            'regular_price' => ['required'],
            'discount_type' => ['required'],
            'discount' => ['required'],
            'unit_type' => ['required'],
            'unit' => ['required'],
            'stock' => ['required'],
            'product_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => ['required']
        ]);

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $name = time();
            $ext = $file->getClientOriginalExtension();
            $newName = $name . '.' . $ext;
            Storage::putFileAs('public/product', $request->file('product_image'), $newName);
        }

        Product::create([
            'name' => $request->name,
            'regular_price' => $request->regular_price,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'unit_type' => $request->unit_type,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'product_image' =>  $newName,
            'description' => $request->description,
        ]);

        return back();
    }
}
