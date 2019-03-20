<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //Relation to webmasterSections
    public function webmasterSection()
    {

        return $this->belongsTo('App\WebmasterSection', 'webmaster_id');
    }

    //Relation of father section
    public function fatherSection()
    {

        return $this->belongsTo('App\Section', 'father_id');
    }

    //Relation of father sections
    public function fatherSections()
    {

        return $this->hasMany('App\Section', 'father_id')->orderby('row_no', 'asc');
    }

    //Relation to Topics
    public function topics()
    {

        return $this->hasMany('App\Topic')->orderby('row_no', 'asc');
    }

    //Relation of TopicCategory
    public function selectedCategories()
    {

        return $this->hasMany('App\TopicCategory', 'section_id')->groupby('topic_id');
    }

}
