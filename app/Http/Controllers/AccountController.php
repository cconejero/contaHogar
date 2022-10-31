<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use App\Models\AccountSpend;
use App\Models\AccountType;
use App\Models\Bank;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Accounts/Index', [
            'accounts' => Account::query()
                ->whereUserId(Auth::user()->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('description', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($account) => [
                    'id' => $account->id,
                    'description' => $account->description,
                    'alias' => $account->alias,
                    'cbu' => $account->cbu,
                    'actualCycleId' => $account->actualBillingCycle()->id,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $account),
                        'view' => Auth::user()->can('view', $account)
                    ]
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createAccount' => Auth::user()->can('create', Account::class)
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
        return Inertia::render('Accounts/Create', [
            'banks' => Bank::all(['id', 'name']),
            'accounts_type' => AccountType::all(['id', 'name']),
            'currencies' => Currency::all(['id', 'name', 'sign'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreAccountRequest $request)
    {
        $attributes = Request::validate([
            'description' => 'required',
            'alias' => 'nullable',
            'cbu' => 'nullable',
            'bank_id' => 'required',
            'account_type_id' => 'required',
            'currency_id' => 'required'
        ]);

        $attributes['user_id'] = Auth::user()->id;

        Account::create($attributes);

        return redirect('/accounts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Inertia\Response
     */
    public function show(Account $account)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountRequest  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
