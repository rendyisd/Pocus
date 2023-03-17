<?php

namespace App\Http\Controllers\ToolsCont;

use App\Http\Controllers\Controller;
use App\Models\FlashcardsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlashcardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $loggedInUser = Auth::user();

        $userFcCategory = FlashcardsCategory::where('user_id', $loggedInUser->id)->get();

        return view('flashcards', ['fcCategory' => $userFcCategory]);
    }

    //TODO: make a new request controller class
    public function addCategorySubmit(Request $request)
    {
        $flashcards_category = new FlashcardsCategory();

        $validatedData = $request->validate([
            'categoryName' => 'required|max:16',
            'categoryColor' => 'required|max:7',
        ]);
        
        $flashcards_category->category = $validatedData['categoryName'];
        $flashcards_category->color = $validatedData['categoryColor'];
        $flashcards_category->user_id = Auth::id();

        $flashcards_category->save();
        $flashcards_category->refresh();

        return response()->json([
            'success' => true,
            'category' => $flashcards_category
        ]);
    }
}
