<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicCategory extends Model
{
    //Relation to Sections
    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }

}
