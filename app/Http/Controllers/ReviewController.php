<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10'
        ]);

        Review::create($request->only([
            'product_id', 'author_name', 'rating', 'content'
        ]));

        return redirect()->back()->with('success', 'Отзыв успешно добавлен');
    }
}