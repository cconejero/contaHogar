<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardSpendRequest;
use App\Http\Requests\UpdateCardSpendRequest;
use App\Models\Card;
use App\Models\CardSpend;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Request;

class CardSpendController extends Controller
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
     * @return \Inertia\Response
     */
    public function create(Card $card)
    {
        return Inertia::render('Cards/Spends/Create', [
            'card' => $card->only(
                'id', 'name'
            )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Card $card
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Card $card)
    {
        $attributes = Request::validate([
            'description' => 'required',
            'amount' => ['required', 'numeric'],
            'actual_due' => ['required', 'numeric'],
            'total_due' => ['required', 'numeric'],
            'month' => ['required', 'numeric', 'between:1,12'],
            'year' => ['required', 'numeric', 'between:2020,2025'],
        ]);

        $attributes['card_id'] = $card->id;

        CardSpend::create($attributes);

        return redirect('/cards/' . $card->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CardSpend  $cardSpend
     * @return \Illuminate\Http\Response
     */
    public function show(CardSpend $cardSpend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CardSpend  $cardSpend
     * @return \Illuminate\Http\Response
     */
    public function edit(CardSpend $cardSpend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardSpendRequest  $request
     * @param  \App\Models\CardSpend  $cardSpend
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardSpendRequest $request, CardSpend $cardSpend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CardSpend  $cardSpend
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardSpend $cardSpend)
    {
        //
    }
}
