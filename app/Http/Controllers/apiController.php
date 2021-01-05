<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;

class apiController extends Controller
{
    public function all() {
        return response()->json(Meeting::all());
    }
}
