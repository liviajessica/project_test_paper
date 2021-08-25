<?php

namespace App\Http\Controllers;

use App\FinanceTransaction;
use App\FinanceAccount;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use JWTAuth;
use App\User;
use Illuminate\Support\Facades\DB;
use Charts;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        return view('login');
    }

    // public function register()
    // {
    //     return view('register');
    // }

    public function dashboard(Request $request)
    {
        $transaction = FinanceTransaction::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $chart = Charts::database($transaction, 'bar', 'highcharts')
            ->title("Monthly Transaction")
            ->elementLabel("Total Transaction")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupByMonth(date('Y'), true);

        $account = FinanceAccount::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $chart2 = Charts::database($account, 'bar', 'highcharts')
            ->title("Monthly Account")
            ->elementLabel("Total Account")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupByMonth(date('Y'), true);
        return view('welcome', ['chart' => $chart, 'chart2' => $chart2]);
        // return view('welcome');
    }

    public function chart()
    {
        $query = DB::table('agreement')->select('val_agrement')->get();
        $result = $query->toArray();

        return view('your-blade', [
            'result' => $result
        ]);
    }

    public function finance()
    {
        return view('finance');
    }

    public function account_modal_create()
    {
        return view('finance_modal\account\create');
    }
}
