<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\Account;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $accounts = auth()->user()->accounts;
        $cards = auth()->user()->cards;
        $fixedExpenses = auth()->user()->fixedExpenses;

        return Inertia::render('Dashboard/Index', [
            'accounts' => $accounts
                ->map(fn($account) => [
                    'id' => $account->id,
                    'description' => $account->description,
                    'actualCycleId' => $account->actualBillingCycle()->id,
                    'sign' => $account->currency->sign,
                    'currency_name' => $account->currency->name,
                    'actualCycleTotal' => $account->actualBillingCycle()->getTotal(),
                ]),
            'cards' => $cards
                ->map(fn($card) => [
                    'id' => $card->id,
                    'name' => $card->name,
                    'actualBillingCycleId' => $card->dueThisMonth()->id,
                    'paid' => $card->dueThisMonth()?->paid,
                    'totals' => $card->dueThisMonth()?->getTotals(),
                    'due_date' => $card->dueThisMonth()?->due_date
                ]),
            'fixedExpenses' => $fixedExpenses
                ->map(fn($fixedExpense) => [
                    'id' => $fixedExpense->id,
                    'description' => $fixedExpense->description,
                    'current_cycle_id' => $fixedExpense->currentCycle()->id,
                    'amount' => $fixedExpense->currentCycle()->getTotal(),
                    'paid' => $fixedExpense->currentCycle()->paid,
                    'due_date' => $fixedExpense->currentCycle()->due_date,
                ]),
        ]);
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
     * @param  \App\Http\Requests\StoreDashboardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDashboardRequest  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDashboardRequest $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
