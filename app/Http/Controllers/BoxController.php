<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BoxController extends Controller
{
    public function index()
    {
        $boxes = Box::all();
        $colors = ['red', 'yellow', 'green', 'blue', 'pink', 'grey'];

        return view('boxes.index',get_defined_vars());
    }

    public function runScheduler()
{
    Artisan::call('boxes:generate');
    return redirect()->back()->with('success', 'Scheduler ran successfully!');
}
}
