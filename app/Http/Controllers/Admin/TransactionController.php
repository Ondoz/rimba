<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('id', 'desc')->get();
        $products = Product::orderBy('name', 'asc')->get();
        $users = User::get();
        return view('admin.transaction', compact('transactions', 'products', 'users'));
    }

    public function store(Request $request)
    {
        $user = User::where('id', $request->users)->first();

        if ($user) {
            $arr = [];
            $subtotal = [];
            foreach ($request->products as $key => $value) {
                $prices = Product::where('uuid', $value)->first();
                if ($prices) {
                    $price = $prices->after_price_regular;
                    $total = $price * $request->qty[$key];
                    $arr[] = [
                        'prices' => [
                            'uuid' => $value,
                            'id' => $prices->id,
                            'price' => str_replace(',', '', number_format($price))
                        ],
                        'qty' => $request->qty[$key],
                        'total' => str_replace(',', '', number_format($total))
                    ];
                    $subtotal[] = str_replace(',', '', number_format($total));
                } else {
                    $subtotal[] = 0;
                }
            }
            $sub = array_sum($subtotal);


            $order = $user->transaction()->create(['total' => $sub]);

            if ($order) {
                foreach ($arr as $item) {
                    $order->transaction_item()->create([
                        'product_id' => $item['prices']['id'],
                        'qty' => $item['qty'],
                        'price' => $item['prices']['price'],
                        'total' => $item['total']
                    ]);
                    $product = Product::where('id', $item['prices']['id'])->first();
                    $subStock = ($product->stock - $item['qty']);
                    $product->update([
                        'stock' => $subStock
                    ]);
                }
            } else {
                return false;
            }
            return back();
        } else {
            return false;
        }
    }
}
