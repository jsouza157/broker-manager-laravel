<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ContactStatus;

class Contact extends Model
{
  protected $fillable = ['font_id', 'property_id', 'user_id', 'name', 'email',
  'company', 'address', 'phone', 'twitter', 'linkedin', 'skype', 'description'];

  public function ContactStatus()
  {
    return $this->hasOne(ContactStatus::class, 'contact_id', 'id');
  }
}
