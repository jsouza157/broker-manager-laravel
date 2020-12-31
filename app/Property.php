<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['name', 'address', 'city', 'state', 'cep', 'type', 'floor', 'garage',
        'garage_vacancy', 'contact_phone', 'contact_email', 'price', 'rentals', 'property_detail', 'user_id'];


    public function Image()
    {
        return $this->hasMany(Image::class, 'property_id', 'id');
    }
}
