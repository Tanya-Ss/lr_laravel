<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        
        return view('orders.create', compact('products', 'cart'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        
        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id]['quantity'];
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total,
            'notes' => $request->notes,
        ]);

        foreach ($products as $product) {
            $order->products()->attach($product->id, [
                'quantity' => $cart[$product->id]['quantity'],
                'price' => $product->price
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.success', $order);
    }

    public function success(Order $order)
    {
        return view('orders.success', compact('order'));
    }
}