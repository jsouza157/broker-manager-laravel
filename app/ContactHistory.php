<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactHistory extends Model
{
    protected $fillable = ['property_id', 'broker_id', 'description'];
}
