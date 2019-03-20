<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedTopic extends Model
{
    //Relation to Related Topics one topic
    public function topic()
    {
        return $this->belongsTo('App\Topic', 'topic2_id');
    }
}
