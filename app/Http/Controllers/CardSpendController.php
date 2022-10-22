<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCardSpendRequest;
use App\Models\Card;
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
    public function create(Card $card)
    {
        return Inertia::render('Cards/Spends/Create', [
            'card' => $card->only(
                'id', 'name'
            ),
            'currencies' => Currency::all(['id', 'name', 'sign']),
            'month' => Request::input('mes') ? Request::input('mes') : now()->month,
            'year' => Request::input('anio') ? Request::input('anio') : now()->year
        ]);
    }

    public function import(Card $card)
    {
        $attributes = Request::validate([
            'actualMonth' => 'required',
            'actualYear' => 'required',
            'prevMonth' => 'required',
            'prevYear' => 'required',
        ]);

        $attributes['card_id'] = $card->id;

        if ($card->user->id === Auth::user()->id){
            $prevSpends = CardSpend::query()
                ->where([
                    ['year', '=', $attributes['prevYear']],
                    ['month', '=', $attributes['prevMonth']],
                    ['card_id', '=', $attributes['card_id']]
                ])
                ->where(function ($query) {
                    $query->whereColumn('actual_due', '<', 'total_due')
                        ->orWhere('fixed', true);
                })
                ->get();

            foreach ($prevSpends as $spend){

                $actual_due = $spend->actual_due;

                if ((!$spend->fixed) && ($spend->actual_due < $spend->total_due)){
                    $actual_due ++;
                }

                $cardSpend = CardSpend::firstOrCreate([
                    'year' => $attributes['actualYear'],
                    'month' => $attributes['actualMonth'],
                    'card_id' => $card->id,
                    'description' => $spend->description,
                    'amount' => $spend->amount,
                    'currency_id' => $spend->currency_id,
                    'fixed' => $spend->fixed,
                    'actual_due' => $actual_due,
                    'total_due' => $spend->total_due
                ]);
            }
        }


        $month = $attributes['actualMonth'];
        $year = $attributes['actualYear'];

        return redirect('/cards/' . $card->id . '?mes=' . $month . '&anio=' . $year);
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
            'currency_id' => ['required'],
            'fixed' => ['required'],
            'actual_due' => ['required', 'numeric'],
            'total_due' => ['required', 'numeric'],
            'month' => ['required', 'numeric', 'between:1,12'],
            'year' => ['required', 'numeric', 'between:2020,2025'],
        ]);

        $attributes['card_id'] = $card->id;

        CardSpend::create($attributes);

        $month = $attributes['month'];
        $year = $attributes['year'];

        return redirect('/cards/' . $card->id . '?mes=' . $month . '&year=' . $year);
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
