<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Bank;
use App\Models\Card;
use App\Models\CardBrand;
use App\Models\CardSpend;
use Carbon\Traits\Date;
use Illuminate\Support\Carbon;
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
                    'actualBillingCycleId' => $card->actualBillingCycle()->id,
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
            'brands' => CardBrand::all(['id', 'name']),
            'dayNames' => [
                'Monday' => 'Lunes',
                'Tuesday' => 'Martes',
                'Wednesday' => 'Miercoles',
                'Thursday' => 'Jueves',
                'Friday' => 'Viernes'
            ]
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
            'name' => ['required', 'max:255'],
            'bank_id' => 'required',
            'card_brand_id' => 'required',
            'generation_day_number' => 'between:1,28'
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
