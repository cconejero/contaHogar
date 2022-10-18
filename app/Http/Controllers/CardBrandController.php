<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardBrandRequest;
use App\Http\Requests\UpdateCardBrandRequest;
use App\Models\CardBrand;

class CardBrandController extends Controller
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
     * @param  \App\Http\Requests\StoreCardBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardBrandRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CardBrand  $cardBrand
     * @return \Illuminate\Http\Response
     */
    public function show(CardBrand $cardBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CardBrand  $cardBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(CardBrand $cardBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardBrandRequest  $request
     * @param  \App\Models\CardBrand  $cardBrand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardBrandRequest $request, CardBrand $cardBrand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CardBrand  $cardBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardBrand $cardBrand)
    {
        //
    }
}
