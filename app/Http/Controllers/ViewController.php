<?php

namespace App\Http\Controllers;

use Redirect;
use Auth;
use App\BudgetType;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetType $budget)
    {
        return view('views.main', compact('budget'));
    }

}
