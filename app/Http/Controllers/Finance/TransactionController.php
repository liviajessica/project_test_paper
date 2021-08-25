<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FinanceAccount;
use App\FinanceTransaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
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
            ->where('a.deleted_at', null)
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
        $account = FinanceAccount::all();
        return view('finance_modal.transaction.create', compact('account'));
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
            'finance_name' => 'required',
            'finance_account_id' => 'required',
            'amount' => 'required'
        ]);

        FinanceTransaction::create($request->all());
        return redirect('/transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FinanceTransaction $financeTransaction)
    {
        $rfinanceTransaction = DB::table('finance_transaction as a')
            ->select(
                'a.finance_name',
                'a.finance_account_id',
                'b.account_name',
                'a.description',
                'a.amount'
            )
            ->join('finance_account as b', 'a.finance_account_id', '=', 'b.id')
            ->where('a.id', $financeTransaction->id)
            ->first();

        return view('finance_modal.transaction.detail')->with('financeTransaction', $rfinanceTransaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FinanceTransaction $financeTransaction)
    {
        $rfinanceTransaction = DB::table('finance_transaction as a')
            ->select(
                'a.id',
                'a.finance_name',
                'a.finance_account_id',
                'b.account_name',
                'a.description',
                'a.amount'
            )
            ->join('finance_account as b', 'a.finance_account_id', '=', 'b.id')
            ->where('a.id', $financeTransaction->id)
            ->first();
        $account = FinanceAccount::all();
        return view('finance_modal.transaction.update', ['financeTransaction' => $rfinanceTransaction, 'account' => $account]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinanceTransaction $financeTransaction)
    {
        $request->validate([
            'finance_name' => 'required',
            'finance_account_id' => 'required',
            'amount' => 'required'
        ]);

        FinanceTransaction::where('id', $financeTransaction->id)
            ->update([
                'finance_name' => $request->finance_name,
                'finance_account_id' => $request->finance_account_id,
                'amount' => $request->amount,
                'description' => $request->description
            ]);
        return redirect('/transaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinanceTransaction $financeTransaction)
    {
        FinanceTransaction::destroy($financeTransaction->id);
        return redirect('/transaction');
    }

    public function restoreAll()
    {
        FinanceTransaction::withTrashed()->restore();
        return redirect('/transaction');
    }
}
