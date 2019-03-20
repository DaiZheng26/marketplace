<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    //Relation to Topics
    public function topics()
    {
        return $this->belongsTo('App\Topic', 'topic_id');
    }

}