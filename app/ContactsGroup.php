<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactsGroup extends Model
{
    //
    public function contacts()
    {

        return $this->hasMany('App\Contact', 'group_id');
    }
}
