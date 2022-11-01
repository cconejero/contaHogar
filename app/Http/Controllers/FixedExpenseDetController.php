<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFixedExpenseDetRequest;
use App\Http\Requests\UpdateFixedExpenseDetRequest;
use App\Models\FixedExpenseDet;

class FixedExpenseDetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFixedExpenseDetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFixedExpenseDetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FixedExpenseDet  $fixedExpenseDet
     * @return \Illuminate\Http\Response
     */
    public function show(FixedExpenseDet $fixedExpenseDet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FixedExpenseDet  $fixedExpenseDet
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedExpenseDet $fixedExpenseDet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFixedExpenseDetRequest  $request
     * @param  \App\Models\FixedExpenseDet  $fixedExpenseDet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFixedExpenseDetRequest $request, FixedExpenseDet $fixedExpenseDet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FixedExpenseDet  $fixedExpenseDet
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedExpenseDet $fixedExpenseDet)
    {
        //
    }
}
