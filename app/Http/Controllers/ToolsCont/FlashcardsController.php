<?php

namespace App\Http\Controllers\ToolsCont;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlashcardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('flashcards');
    }
}
