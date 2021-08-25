<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceAccount extends Model
{
    use SoftDeletes;
    protected $table = 'finance_account';
    protected $fillable = ['account_name', 'account_type', 'description'];
}
