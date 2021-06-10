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
}
