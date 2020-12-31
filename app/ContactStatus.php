<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactStatus extends Model
{
    protected $table = 'contact_status';
    protected $fillable = ['contact_id', 'status', 'broker_id', 'property_id'];
}
