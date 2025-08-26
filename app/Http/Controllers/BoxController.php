<?php
namespace App\Http\Controllers;

use App\Models\Box;

class BoxController extends Controller
{
    public function index()
    {
        return response()->json(Box::all());
    }
}
