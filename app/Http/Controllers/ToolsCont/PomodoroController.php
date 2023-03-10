<?php

namespace App\Http\Controllers\ToolsCont;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    public function index()
    {
        return view('pomodoro');
    }
}
