<?php

namespace App\Http\Controllers;

use Redirect;
use Auth;
use App\Entity;
use App\BudgetType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entity = Auth::user()->entities()->first();

        if($entity) {
            $budget_type = $entity->budgetTypes()->first();
        }
        else {
            $entities = [];
            $entity = null;
            $budget_type = null;
            $budget_types = [];
            return view('home', compact('entities', 'entity', 'budget_types', 'budget_type'));
        }

        return $this->show($entity, $budget_type);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Entity $entity, $budget_type = null)
    {
        $entities = Auth::user()->entities()->get(['id', 'organization_name']);

        if($entity !== null){
            $budget_types = $entity->budgetTypes()->with('views')->get();
        } else {
            $budget_types = [];
        }

        if($budget_type === null && $entity !== null){
            $budget_type = $entity->budgetTypes()->with('views')->first();
        } else if($entity !== null) {
            $budget_type = $entity->budgetTypes()->with('views')->find($budget_type)->first();
        }

        if($entity !== null && Auth::user()->id != $entity->user_id){
            return view('error')->withErrors(['You don\'t have permissions to access this resource.']);
        }

        return view('home', compact('entities', 'entity', 'budget_types', 'budget_type'));
    }

}
