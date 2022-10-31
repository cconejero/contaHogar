<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountSpendRequest;
use App\Http\Requests\UpdateAccountSpendRequest;
use App\Models\Account;
use App\Models\AccountCycle;
use App\Models\AccountSpend;
use App\Models\Movement;
use App\Models\Tag;
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
    public function create(AccountCycle $accountCycle)
    {
        return Inertia::render('Accounts/Spends/Create', [
            'account' => $accountCycle->account->only('id', 'description'),
            'accountCycle' => $accountCycle->only(
                'id', 'year', 'month'
            ),
            'movements' => Movement::all(['id', 'name'])->sortBy('name')->values()->all(),
            'tags' => Tag::query()->whereNull('user_id')->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountSpendRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AccountCycle $accountCycle)
    {
        $attributes = Request::validate([
            'description' => 'required',
            'amount' => ['required', 'numeric'],
            'tag_id' => 'required',
            'movement_id' => ['required'],
        ]);

        $attributes['account_cycle_id'] = $accountCycle->id;

        AccountSpend::create($attributes);

        return redirect('/account_cycle/' . $accountCycle->id);
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
