<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webmail extends Model
{
    //
    public function webmailsGroup()
    {

        return $this->belongsTo('App\WebmailsGroup', 'group_id')->orderby('id', 'asc');
    }

    //Relation to files
    public function files()
    {

        return $this->hasMany('App\WebmailsFile', 'webmail_id')->orderby('id', 'asc');
    }
}
