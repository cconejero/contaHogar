<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountSpendRequest;
use App\Http\Requests\UpdateAccountSpendRequest;
use App\Models\Account;
use App\Models\AccountSpend;
use App\Models\Movement;
use Inertia\Inertia;
use Request;

class AccountSpendController extends Controller
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
    public function create(Account $account)
    {
        return Inertia::render('Accounts/Spends/Create', [
            'account' => $account->only('id', 'description'),
            'movements' => Movement::all(['id', 'name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountSpendRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Account $account)
    {
        $attributes = Request::validate([
            'description' => 'required',
            'amount' => ['required', 'numeric'],
            'movement_id' => ['required'],
            'month' => ['required', 'numeric', 'between:1,12'],
            'year' => ['required', 'numeric', 'between:2020,2025'],
        ]);

        $attributes['account_id'] = $account->id;

        AccountSpend::create($attributes);

        return redirect('/accounts/' . $account->id . '?mes=' . $attributes['month'] . '&anio' . $attributes['year']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountSpend  $accountSpend
     * @return \Illuminate\Http\Response
     */
    public function show(AccountSpend $accountSpend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountSpend  $accountSpend
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountSpend $accountSpend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountSpendRequest  $request
     * @param  \App\Models\AccountSpend  $accountSpend
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountSpendRequest $request, AccountSpend $accountSpend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountSpend  $accountSpend
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountSpend $accountSpend)
    {
        //
    }
}
