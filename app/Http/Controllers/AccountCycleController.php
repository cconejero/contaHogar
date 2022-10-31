<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountCycleRequest;
use App\Http\Requests\UpdateAccountCycleRequest;
use App\Models\AccountCycle;
use App\Models\AccountSpend;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Request;

class AccountCycleController extends Controller
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
     * @param  \App\Http\Requests\StoreAccountCycleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountCycleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountCycle  $accountCycle
     * @return \Inertia\Response
     */
    public function show(AccountCycle $accountCycle)
    {
        if (Auth::user()->can('view', $accountCycle)){

            $accountCycle->import();

            return Inertia::render('Accounts/Show', [
                'account' => $accountCycle->account->only(
                    'id', 'description', 'alias', 'cbu'
                ),
                'bank' => $accountCycle->account->bank->only(
                    'name'
                ),
                'currency' => $accountCycle->account->currency->only(
                    'name', 'sign'
                ),
                'accountType' => $accountCycle->account->accountType->only(
                    'name'
                ),
                'accountCycle' => $accountCycle->only(
                    'id', 'year', 'month'
                ),
                'nextAccountCycle' => $accountCycle->nextMonth()->only(
                    'id', 'year', 'month'
                ),
                'prevAccountCycle' => $accountCycle->prevMonth()->only(
                    'id', 'year', 'month'
                ),
                'spends' => $accountCycle->spends()
                    ->orderByDesc('created_at')
                    ->paginate(10)
                    ->withQueryString()
                    ->through(fn($spend) => [
                        'description' => $spend->description,
                        'amount' => ($spend->movement_id === 2) ? (-1 * $spend->amount) : $spend->amount,
                        'movement_id' => $spend->movement_id,
                        'tag' => $spend->tag->name,
                    ])
            ]);
        } else {
            return abort(403);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountCycle  $accountCycle
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountCycle $accountCycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountCycleRequest  $request
     * @param  \App\Models\AccountCycle  $accountCycle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountCycleRequest $request, AccountCycle $accountCycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountCycle  $accountCycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountCycle $accountCycle)
    {
        //
    }
}
