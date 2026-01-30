<?php

namespace App\Http\Controllers;

use App\Models\ProductQuestion;
use Illuminate\Http\Request;

class ProductAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(ProductQuestion $question){
        $request = request();

        //VALIDATE
        $validatedAnswer = $request->validate([
            'answer' => 'required|string|max:255',
        ]);

        //CREATE PRODUCT
        $question->answers()->create([
            'user_id' => auth()->user()->id,
            'answer' => $validatedAnswer['answer'],
            'active' => true,
        ]);

        //REDIRECT
        return back();
    }
}