<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'qtd_users', 'qtd_imgs', 'qtd_properties', 'value', 'tasting'];
}
