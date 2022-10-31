<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFixedMovementRequest;
use App\Http\Requests\UpdateFixedMovementRequest;
use App\Models\FixedMovement;

class FixedMovementController extends Controller
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
     * @param  \App\Http\Requests\StoreFixedMovementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFixedMovementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FixedMovement  $fixedMovement
     * @return \Illuminate\Http\Response
     */
    public function show(FixedMovement $fixedMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FixedMovement  $fixedMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedMovement $fixedMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFixedMovementRequest  $request
     * @param  \App\Models\FixedMovement  $fixedMovement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFixedMovementRequest $request, FixedMovement $fixedMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FixedMovement  $fixedMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedMovement $fixedMovement)
    {
        //
    }
}
