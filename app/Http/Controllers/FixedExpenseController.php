<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFixedExpenseRequest;
use App\Http\Requests\UpdateFixedExpenseRequest;
use App\Models\Account;
use App\Models\Currency;
use App\Models\FixedExpense;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Request;

class FixedExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('FixedExpenses/Index', [
            'fixedExpenses' => FixedExpense::with(['currency', 'tag', 'account'])
                ->whereUserId(Auth::user()->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('description', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($fixedExpense) => [
                    'id' => $fixedExpense->id,
                    'description' => $fixedExpense->description,
                    'amount' => $fixedExpense->amount,
                    'currencySign' => $fixedExpense->currency->sign,
                    'currencyName' => $fixedExpense->currency->name,
                    'dueDate' => $fixedExpense->due_date,
                    'tag' => $fixedExpense->tag->name,
                    'account' => $fixedExpense->account,
                    'can' => [
                        'edit' => Auth::user()->can('update', $fixedExpense),
                        'view' => Auth::user()->can('view', $fixedExpense)
                    ]
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createFixedExpense' => Auth::user()->can('create', FixedExpense::class)
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('FixedExpenses/Create', [
            'currencies' => Currency::all(['id', 'name']),
            'tags' => Tag::query()->whereNull('user_id')->get(['id', 'name']),
            'accounts' => Account::query()->where('user_id', '=', Auth::user()->id)->get(['id', 'description'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFixedExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFixedExpenseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FixedExpense  $fixedExpense
     * @return \Illuminate\Http\Response
     */
    public function show(FixedExpense $fixedExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FixedExpense  $fixedExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedExpense $fixedExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFixedExpenseRequest  $request
     * @param  \App\Models\FixedExpense  $fixedExpense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFixedExpenseRequest $request, FixedExpense $fixedExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FixedExpense  $fixedExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedExpense $fixedExpense)
    {
        //
    }
}
