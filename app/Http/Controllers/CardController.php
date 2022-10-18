<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Bank;
use App\Models\Card;
use App\Models\CardBrand;
use App\Models\CardSpend;
use Carbon\Traits\Date;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Cards/Index', [
            'cards' => Card::with(['bank', 'brand'])
                ->whereUserId(Auth::user()->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($card) => [
                    'id' => $card->id,
                    'name' => $card->name,
                    'bankName' => $card->bank->name,
                    'brand' => $card->brand->name,
                    'can' => [
                        'edit' => Auth::user()->can('update', $card),
                        'view' => Auth::user()->can('view', $card)
                    ]
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createCard' => Auth::user()->can('create', Card::class)
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Cards/Create', [
            'banks' => Bank::all(['id', 'name']),
            'brands' => CardBrand::all(['id', 'name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCardRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCardRequest $request)
    {
        $attributes = Request::validate([
            'name' => 'required',
            'bank_id' => 'required',
            'card_brand_id' => 'required'
        ]);

        $attributes['user_id'] = Auth::user()->id;

        Card::create($attributes);

        return redirect('/cards');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Inertia\Response
     */
    public function show(Card $card)
    {
        if (Auth::user()->can('view', $card)){
            return Inertia::render('Cards/Show', [
                'card' => $card->only(
                    'id', 'name'
                ),
                'brand' => $card->brand->only(
                    'name'
                ),
                'bank' => $card->bank->only(
                    'name'
                ),
                'spends' => CardSpend::query()
                    ->where('card_id', $card->id)
                    ->when(Request::input('anio'), function ($query, $year) {
                        $query->where('year', $year);
                    })
                    ->when(Request::input('mes'), function ($query, $month) {
                        $query->where('month', $month);
                    })
                    ->paginate(10)
                    ->withQueryString()
                    ->through(fn($spend) => [
                        'description' => $spend->description,
                        'amount' => $spend->amount,
                        'actual_due' => $spend->actual_due,
                        'total_due' => $spend->total_due,
                    ]
                ),
                'month' => Request::input('mes') ? Request::input('mes') : now()->month,
                'year' => Request::input('anio') ? Request::input('anio') : now()->year,
            ]);
        } else {
            return abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardRequest  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }
}
