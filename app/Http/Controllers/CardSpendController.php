<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCardSpendRequest;
use App\Models\Card;
use App\Models\CardBillingCycle;
use App\Models\CardSpend;
use App\Models\Currency;
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
    public function create(CardBillingCycle $cardBillingCycle)
    {
        return Inertia::render('Cards/Spends/Create', [
            'card' => $cardBillingCycle->card->only(
                'id', 'name'
            ),
            'cardBillingCycle' => $cardBillingCycle->only(
                'id', 'year', 'month'
            ),
            'currencies' => Currency::all(['id', 'name', 'sign'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Card $card
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CardBillingCycle $cardBillingCycle)
    {
        $attributes = Request::validate([
            'description' => 'required',
            'amount' => ['required', 'numeric'],
            'currency_id' => ['required'],
            'fixed' => ['required'],
            'actual_due' => ['required', 'numeric'],
            'total_due' => ['required', 'numeric'],
        ]);

        $attributes['card_billing_cycle_id'] = $cardBillingCycle->id;

        CardSpend::create($attributes);

        return redirect('/billing_cycle/' . $cardBillingCycle->id);
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
