<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardBillingCycleRequest;
use App\Http\Requests\UpdateCardBillingCycleRequest;
use App\Models\Account;
use App\Models\AccountSpend;
use App\Models\Card;
use App\Models\CardBillingCycle;
use App\Models\CardSpend;
use App\Models\Exchange;
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
            $cardBillingCycle->calculateImpuesto4815();
            $cardBillingCycle->calculateImpuestoPais();
            $cardBillingCycle->getTotals();

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
                    'id', 'year', 'month', 'generation_date', 'due_date', 'paid'
                ),
                'nextBillingCycle' => $cardBillingCycle->nextMonth()->only(
                    'id', 'year', 'month', 'generation_date', 'due_date'
                ),
                'prevBillingCycle' => $cardBillingCycle->prevMonth()->only(
                    'id', 'year', 'month', 'generation_date', 'due_date'
                ),
                'dolar' => Exchange::where([
                    ['currency_id', '=', 2],
                    ['date', '=', $cardBillingCycle->generation_date]
                ])->first(['id', 'value']),
                'accounts' => Account::where([
                    ['user_id', '=', Auth::user()->id],
                    ['currency_id', '=', 1]
                ])->get([
                    'id', 'description'
                ]),
                'totals' => $cardBillingCycle->getTotals(),
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

    public function paywithaccount(CardBillingCycle $cardBillingCycle, Account $account)
    {
        if (($cardBillingCycle->card->user_id === Auth::user()->id) and ($account->user_id === Auth::user()->id)){

            $cardBillingCycle->paid = true;

            $description = $cardBillingCycle->card->name . ' ' . $cardBillingCycle->month . '/' . $cardBillingCycle->year;

            AccountSpend::create([
                'account_cycle_id' => $account->actualBillingCycle()->id,
                'description' => $description,
                'amount' => $cardBillingCycle->getTotals()[0]['amount'],
                'movement_id' => 2,
            ]);

            $cardBillingCycle->save();
        }

        return redirect('/billing_cycle/' . $cardBillingCycle->id);
    }

    public function closecycle(CardBillingCycle $cardBillingCycle)
    {
        $dolarValue = Exchange::where([
            ['currency_id', '=', 2],
            ['date', '=', $cardBillingCycle->generation_date]
        ])->first(['value'])?->value;

        foreach ($cardBillingCycle->spends as $spend){

            if ($spend->currency_id === 2 and $dolarValue !== null){

                $spend->amount = $spend->amount * $dolarValue;
                $spend->currency_id = 1;
                $spend->save();
            }
        }

        return redirect('/billing_cycle/' . $cardBillingCycle->id);
    }

}
