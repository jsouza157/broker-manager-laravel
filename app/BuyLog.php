<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyLog extends Model
{
    protected $fillable = ['token', 'payerID'];
}
