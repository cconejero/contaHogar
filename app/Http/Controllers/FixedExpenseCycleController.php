<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFixedExpenseCycleRequest;
use App\Http\Requests\UpdateFixedExpenseCycleRequest;
use App\Models\Account;
use App\Models\AccountSpend;
use App\Models\FixedExpenseCycle;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FixedExpenseCycleController extends Controller
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
     * @param  \App\Http\Requests\StoreFixedExpenseCycleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFixedExpenseCycleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Inertia\Response
     */
    public function show(FixedExpenseCycle $fixedExpenseCycle)
    {
        $fixedExpenseCycle->createDue();
        $fixedExpense = $fixedExpenseCycle->fixedExpense;

        if (Auth::user()->can('view', $fixedExpenseCycle)){

            return Inertia::render('FixedExpenses/Show', [
                'fixedExpenseCycle' => $fixedExpenseCycle
                    ->only([
                        'id', 'year', 'month', 'paid', 'due_date'
                    ]),
                'fixedExpense' => [
                    'id' => $fixedExpense->id,
                    'description' => $fixedExpense->description,
                    'amount' => $fixedExpense->amount,
                    'currency' => $fixedExpense->currency->only([
                        'sign', 'name'
                    ]),
                    'due_date' => $fixedExpense->due_date,
                    'tag' => $fixedExpense->tag->name,
                    'account' => $fixedExpense->account?->description,
                    'account_id' => $fixedExpense->account?->id
                ],
                'total' => $fixedExpenseCycle->getTotal(),
                'accounts' => Account::where([
                    ['user_id', '=', Auth::user()->id],
                    ['currency_id', '=', 1]
                ])->get([
                    'id', 'description'
                ]),
                'spends' => $fixedExpenseCycle->spends
                    ->map(fn($spend) => [
                        'fixed_expense_cycle_id' => $spend->fixed_expense_cycle_id,
                        'description' => $spend->description,
                        'amount' => $spend->amount,
                        'tag_name' => $spend->tag->name
                    ])
            ]);
        } else {
            return abort(403);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedExpenseCycle $fixedExpenseCycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFixedExpenseCycleRequest  $request
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFixedExpenseCycleRequest $request, FixedExpenseCycle $fixedExpenseCycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FixedExpenseCycle  $fixedExpenseCycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedExpenseCycle $fixedExpenseCycle)
    {
        //
    }

    public function paywithaccount(FixedExpenseCycle $fixedExpenseCycle, Account $account)
    {
        if (($fixedExpenseCycle->fixedExpense->user_id === Auth::user()->id) and ($account->user_id === Auth::user()->id)){

            $fixedExpenseCycle->pay($account);
        }

        return redirect('/fixed_expense_cycles/' . $fixedExpenseCycle->id);
    }

}
