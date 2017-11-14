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

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request, $budget)
    {
        $budget = BudgetType::find($budget);

        // remove all related views
        $budget->views()->delete();
        $views = $request->v;


        foreach ($views as $key => $view) {
            $t = [];
            
            foreach ($view as $k => $v) {
                $t[] = json_decode($k);
            }
            
            $budget->views()->create([
                "data" => json_encode($t)
            ]);
        }

        return redirect('home/' . $request->entity . '/' . $budget->id);
    }

}
