<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardBillingCycleRequest;
use App\Http\Requests\UpdateCardBillingCycleRequest;
use App\Models\Card;
use App\Models\CardBillingCycle;
use App\Models\CardSpend;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Request;

class CardBillingCycleController extends Controller
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
     * @param  \App\Http\Requests\StoreCardBillingCycleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardBillingCycleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CardBillingCycle  $cardBillingCycle
     * @return \Inertia\Response
     */
    public function show(CardBillingCycle $cardBillingCycle)
    {
        if (Auth::user()->can('view', $cardBillingCycle)){

            $cardBillingCycle->import();
            $cardBillingCycle->calculateImpuestoSellos();
            //$cardBillingCycle->calculateImpuestoPais();

            return Inertia::render('Cards/Show', [
                'card' => $cardBillingCycle->card->only(
                    'id', 'name'
                ),
                'brand' => $cardBillingCycle->card->brand->only(
                    'name'
                ),
                'bank' => $cardBillingCycle->card->bank->only(
                    'name'
                ),
                'billingCycle' => $cardBillingCycle->only(
                    'id', 'year', 'month', 'generation_date', 'due_date'
                ),
                'nextBillingCycle' => $cardBillingCycle->nextMonth()->only(
                    'id', 'year', 'month', 'generation_date', 'due_date'
                ),
                'prevBillingCycle' => $cardBillingCycle->prevMonth()->only(
                    'id', 'year', 'month', 'generation_date', 'due_date'
                ),
                'spends' => $cardBillingCycle->spends()
                    ->orderByDesc('fixed')
                    ->orderBy('tax')
                    ->orderByDesc('created_at')
                    ->paginate(10)
                    ->withQueryString()
                    ->through(fn($spend) => [
                        'description' => $spend->description,
                        'amount' => $spend->amount,
                        'actual_due' => $spend->actual_due,
                        'total_due' => $spend->total_due,
                        'fixed' => $spend->fixed,
                        'tag' => $spend->tag->name,
                        'sign' => $spend->currency->sign,
                        'currency_name' => $spend->currency->name,
                        'tax' => $spend->tax
                    ]
                    )
            ]);
        } else {
            return abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CardBillingCycle  $cardBillingCycle
     * @return \Illuminate\Http\Response
     */
    public function edit(CardBillingCycle $cardBillingCycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardBillingCycleRequest  $request
     * @param  \App\Models\CardBillingCycle  $cardBillingCycle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardBillingCycleRequest $request, CardBillingCycle $cardBillingCycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CardBillingCycle  $cardBillingCycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardBillingCycle $cardBillingCycle)
    {
        //
    }
}
