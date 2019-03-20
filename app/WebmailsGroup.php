<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebmailsGroup extends Model
{
    //
    public function webmails()
    {

        return $this->hasMany('App\Webmail', 'group_id');
    }
}

