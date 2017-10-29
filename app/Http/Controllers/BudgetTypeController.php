<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity;
use App\BudgetType;

class BudgetTypeController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Entity $entity)
    {
        return view('budget_types.create', compact('entity')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'budget_name' => 'required'
        ]);

        $budget_type = BudgetType::create(
            [
                'budget_name' => $request->budget_name,
                'data' => $request->data,
                'entity_id' => $request->entity_id
            ]
        );

        return redirect('home/' . $request->entity_id . '/' . $budget_type->id)
            ->with([
                'status' => 'Budget Type added with success.'
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $budget_type = BudgetType::findOrFail($id);

        return view('budget_types.edit', compact('budget_type'))->with('create', 0);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'budget_name' => 'required'
        ]);

        $budget_type = BudgetType::findOrFail($id);

        $budget_type->update(
            [
                'budget_name' => $request->budget_name,
                'data' => $request->data
            ]
        );

        return redirect('home/' . $budget_type->entity_id . '/' . $budget_type->id)
            ->with([
                'status' => 'Budget Type edited with success.'
            ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request, $id)
    {
        $request->validate([
            'data' => 'required'
        ]);

        $budget_type = BudgetType::findOrFail($id);

        $budget_type->update(
            [
                'data' => $request->data
            ]
        );

        return redirect('home/' . $budget_type->entity_id . '/' . $budget_type->id)
            ->with([
                'status' => 'Budget Type edited with success.'
            ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $budget_type = BudgetType::findOrFail($id);

        $entity = $budget_type->entity_id;

        $budget_type->delete();

        return redirect('home/' . $entity)->with([
            'status' => 'Budget Type removed with success.'
        ]);
    }

}
