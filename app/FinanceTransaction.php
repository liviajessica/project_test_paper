<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceTransaction extends Model
{
    use SoftDeletes;
    protected $table = 'finance_transaction';
    protected $fillable = ['finance_name', 'finance_account_id', 'description', 'amount'];
}
