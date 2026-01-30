<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductQuestion;
use Illuminate\Http\Request;

class ProductQuestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product){
        $request = request();

        //VALIDATE
        $validatedQuestion = $request->validate([
            'question' => 'required|string|max:255',
        ]);

        //CREATE PRODUCT
        $product->questions()->create([
            'user_id' => auth()->user()->id,
            'question' => $validatedQuestion['question'],
            'active' => true,
        ]);

        //REDIRECT
        return back();
    }

    //-- NON CRUD METHODS --
    public function toggleEnable(ProductQuestion $question){
        $user = auth()->user();

        if (!$user->is($question->user) && !$user->hasAnyRole(['owner', 'admin'])) 
            abort(403);

        $question->update([
            'active' => !$question->active
        ]);
        return back();
    }
}
