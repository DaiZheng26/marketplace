<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public function contactsGroup()
    {

        return $this->belongsTo('App\ContactsGroup', 'group_id');
    }
}
