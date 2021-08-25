<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FinanceAccount;
use App\FinanceTransaction;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = DB::table('finance_transaction as a')
            ->select(
                'a.id',
                'a.finance_name',
                'a.finance_account_id',
                'b.account_name',
                'a.description',
                'a.amount',
                'a.created_at'
            )
            ->join('finance_account as b', 'a.finance_account_id', '=', 'b.id')
            ->get();
        $account = FinanceAccount::all();
        return view('finance', ['transaction' => $transaction, 'account' => $account]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance_modal.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_name' => 'required',
            'account_type' => 'required'
        ]);

        FinanceAccount::create($request->all());
        return redirect('/account');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FinanceAccount $financeAccount)
    {
        return view('finance_modal.account.detail', compact('financeAccount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FinanceAccount $financeAccount)
    {
        return view('finance_modal.account.update', compact('financeAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinanceAccount $financeAccount)
    {
        $request->validate([
            'account_name' => 'required',
            'account_type' => 'required'
        ]);

        FinanceAccount::where('id', $financeAccount->id)
            ->update([
                'account_name' => $request->account_name,
                'account_type' => $request->account_type,
                'description' => $request->description
            ]);
        return redirect('/account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinanceAccount $financeAccount)
    {
        FinanceAccount::destroy($financeAccount->id);
        return redirect('/account');
    }

    public function restoreAll()
    {
        FinanceAccount::withTrashed()->restore();
        return redirect('/account');
    }
}
