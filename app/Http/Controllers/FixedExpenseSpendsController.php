<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFixedExpenseSpendsRequest;
use App\Http\Requests\UpdateFixedExpenseSpendsRequest;
use App\Models\FixedExpenseSpends;

class FixedExpenseSpendsController extends Controller
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
     * @param  \App\Http\Requests\StoreFixedExpenseSpendsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFixedExpenseSpendsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FixedExpenseSpends  $fixedExpenseSpends
     * @return \Illuminate\Http\Response
     */
    public function show(FixedExpenseSpends $fixedExpenseSpends)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FixedExpenseSpends  $fixedExpenseSpends
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedExpenseSpends $fixedExpenseSpends)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFixedExpenseSpendsRequest  $request
     * @param  \App\Models\FixedExpenseSpends  $fixedExpenseSpends
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFixedExpenseSpendsRequest $request, FixedExpenseSpends $fixedExpenseSpends)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FixedExpenseSpends  $fixedExpenseSpends
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedExpenseSpends $fixedExpenseSpends)
    {
        //
    }
}
