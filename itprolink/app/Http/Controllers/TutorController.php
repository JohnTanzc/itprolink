<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function tutor()
    {
        return view('tutor');
    }
}
