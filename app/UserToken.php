<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserToken extends Model
{
    use SoftDeletes;
    protected $table = 'user_token';
    protected $fillable = ['email', 'token'];
}
