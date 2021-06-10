<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getProductByid(Request $request)
    {
        $product = Product::where('uuid', $request->uuid)->first();
        if ($product) {
            return $product;
        } else {
            return null;
        }
    }
}
