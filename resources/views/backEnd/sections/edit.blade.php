@extends('backEnd.layout')

@section('headerInclude')
    <link href="{{ URL::to("backEnd/libs/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
@endsection
@section('content')
    <div class="padding">
        <div class="box m-b-0">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.sectionEdit') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a>{!! trans('backLang.'.$WebmasterSection->name) !!}</a> /
                    <a>{{ trans('backLang.sectionsOf') }}  {!! trans('backLang.'.$WebmasterSection->name) !!}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route('sections',$WebmasterSection->id) }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <?php
        $tab_1 = "active";
        $tab_2 = "";
        if (Session::has('activeTab')) {
            if (Session::get('activeTab') == "seo") {
                $tab_1 = "";
                $tab_2 = "active";
            }
        }
        ?>
        <div class="box nav-active-border b-info">
            <ul class="nav nav-md">
                <li class="nav-item inline">
                    <a class="nav-link {{ $tab_1 }}" href data-toggle="tab" data-target="#tab_details">
                        <span class="text-md"><i class="material-icons">
                                &#xe31e;</i> {{ trans('backLang.topicTabSection') }}</span>
                    </a>
                </li>
                @if(Helper::GeneralWebmasterSettings("seo_status"))
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_2 }}" href data-toggle="tab" data-target="#tab_seo">
                    <span class="text-md"><i class="material-icons">
                            &#xe8e5;</i> {{ trans('backLang.seoTabTitle') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
            <div class="tab-content clear b-t">
                <div class="tab-pane  {{ $tab_1 }}" id="tab_details">
                    <div class="box-body">
                        {{Form::open(['route'=>['sectionsUpdate',"webmasterId"=>$WebmasterSection->id,"id"=>$Sections->id],'method'=>'POST', 'files' => true])}}

                        @if($WebmasterSection->sections_status==2)
                            <div class="form-group row">
                                <label for="father_id"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.sectionFather') !!} </label>
                                <div class="col-sm-10">
                                    <select name="father_id" id="father_id" class="form-control c-select">
                                        <option value="0">- - {!!  trans('backLang.sectionNoFather') !!} - -</option>
                                        <?php
                                        $title_var = "title_" . trans('backLang.boxCode');
                                        $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                        ?>
                                        @foreach ($fatherSections as $fatherSection)
                                            <?php
                                            if ($fatherSection->$title_var != "") {
                                                $title = $fatherSection->$title_var;
                                            } else {
                                                $title = $fatherSection->$title_var2;
                                            }
                                            ?>
                                            <option value="{{ $fatherSection->id  }}" {{ ($fatherSection->id == $Sections->father_id) ? "selected='selected'":""  }}>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        @else
                            {!! Form::hidden('father_id',$Sections->father_id) !!}
                        @endif

                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group row">
                                <label for="title_ar"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.sectionName') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('title_ar',$Sections->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                                </div>
                            </div>
                        @endif
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group row">
                                <label for="title_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.sectionName') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('title_en',$Sections->title_en, array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="photo"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.sectionIcon') !!}</label>
                            <div class="col-sm-10">
                                @if($Sections->photo!="")
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="section_photo" class="col-sm-4 box p-a-xs">
                                                <a target="_blank"
                                                   href="{{ URL::to('uploads/sections/'.$Sections->photo) }}"><img
                                                            src="{{ URL::to('uploads/sections/'.$Sections->photo) }}"
                                                            class="img-responsive">
                                                    {{ $Sections->photo }}
                                                </a>
                                                <br>
                                                <a onclick="document.getElementById('section_photo').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                                                   class="btn btn-sm btn-default">{!!  trans('backLang.delete') !!}</a>
                                            </div>
                                            <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                                                <a onclick="document.getElementById('section_photo').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                                                    <i class="material-icons">
                                                        &#xe166;</i> {!!  trans('backLang.undoDelete') !!}</a>
                                            </div>

                                            {!! Form::hidden('photo_delete','0', array('id'=>'photo_delete')) !!}
                                        </div>
                                    </div>

                                @endif
                                {!! Form::file('photo', array('class' => 'form-control','id'=>'photo','accept'=>'image/*')) !!}
                            </div>
                        </div>

                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="col-sm-offset-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!!  trans('backLang.imagesTypes') !!}
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link_status"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.status') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('status','1',($Sections->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.active') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('status','0',($Sections->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ trans('backLang.notActive') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if($WebmasterSection->section_icon_status)
                            <div class="form-group row">
                                <label for="icon"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.sectionIcon') !!}</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        {!! Form::text('icon',$Sections->icon, array('placeholder' => '','class' => 'form-control icp icp-auto','id'=>'icon', 'data-placement'=>'bottomRight')) !!}
                                        <span class="input-group-addon"></span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row m-t-md">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                        &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                                <a href="{{ route('sections',$WebmasterSection->id) }}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                </div>
                @if(Helper::GeneralWebmasterSettings("seo_status"))
                    <div class="tab-pane  {{ $tab_2 }}" id="tab_seo">

                        <div class="box-body">
                            {{Form::open(['route'=>['sectionsSEOUpdate',"webmasterId"=>$WebmasterSection->id,"id"=>$Sections->id],'method'=>'POST'])}}
                            <div class="row">
                                <div class="col-sm-6">
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEOTitle') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                                {!! Form::text('seo_title_ar',$Sections->seo_title_ar, array('class' => 'form-control','id'=>'seo_title_ar','maxlength'=>'65', 'dir'=>trans('backLang.rtl'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.friendlyURL') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                                {!! Form::text('seo_url_slug_ar',$Sections->seo_url_slug_ar, array('class' => 'form-control','id'=>'seo_url_slug_ar', 'dir'=>trans('backLang.rtl'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEODesc') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small> @endif

                                                {!! Form::textarea('seo_description_ar',$Sections->seo_description_ar, array('class' => 'form-control','id'=>'seo_description_ar','maxlength'=>'165', 'dir'=>trans('backLang.rtl'),'rows'=>'2')) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEOKeywords') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small>@endif

                                                {!! Form::textarea('seo_keywords_ar',$Sections->seo_keywords_ar, array('class' => 'form-control','id'=>'seo_keywords_ar', 'dir'=>trans('backLang.rtl'),'rows'=>'2')) !!}
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    @endif
                                </div>
                                <div class="col-sm-6">

                                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                        <?php
                                        $seo_example_title = $Sections->title_ar;
                                        $seo_example_desc = Helper::GeneralSiteSettings("site_desc_ar");
                                        if ($Sections->seo_title_ar != "") {
                                            $seo_example_title = $Sections->seo_title_ar;
                                        }
                                        if ($Sections->seo_description_ar != "") {
                                            $seo_example_desc = $Sections->seo_description_ar;
                                        }
                                        if ($Sections->seo_url_slug_ar != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            $seo_example_url = url($Sections->seo_url_slug_ar);
                                        } else {
                                            $seo_example_url = route('FrontendTopicsByCat', ["section" => $Sections->webmasterSection->name, "cat" => $Sections->id]);
                                        }
                                        ?>
                                        <div class="form-group">
                                            <div>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.arabicBox') !!}</small> @endif
                                                &nbsp;
                                                <div class="search-example" dir="rtl">
                                                    <a id="title_in_engines_ar" href="{{ $seo_example_url }}"
                                                       target="_blank">{{ $seo_example_title }}</a>
                                                    <span id="url_in_engines_ar">{{ $seo_example_url }}</span>
                                                    <div id="desc_in_engines_ar">{{ $seo_example_desc }} ...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <i class="material-icons">&#xe8fd;</i>
                                                <small>{!!  trans('backLang.seoTabSettings') !!}</small>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">

                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEOTitle') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                                {!! Form::text('seo_title_en',$Sections->seo_title_en, array('class' => 'form-control','id'=>'seo_title_en','maxlength'=>'65', 'dir'=>trans('backLang.ltr'))) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.friendlyURL') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                                {!! Form::text('seo_url_slug_en',$Sections->seo_url_slug_en, array('class' => 'form-control','id'=>'seo_url_slug_en', 'dir'=>trans('backLang.ltr'))) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEODesc') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                                {!! Form::textarea('seo_description_en',$Sections->seo_description_en, array('class' => 'form-control','id'=>'seo_description_en','maxlength'=>'165', 'dir'=>trans('backLang.ltr'),'rows'=>'2')) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <div class="form-group">
                                            <div>
                                                <small>{!!  trans('backLang.topicSEOKeywords') !!}</small>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif

                                                {!! Form::textarea('seo_keywords_en',$Sections->seo_keywords_en, array('class' => 'form-control','id'=>'seo_keywords_en', 'dir'=>trans('backLang.ltr'),'rows'=>'2')) !!}
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                                    &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                                            <a href="{{ route('sections',$WebmasterSection->id) }}"
                                               class="btn btn-default m-t"><i class="material-icons">
                                                    &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                </div>

                                <div class="col-sm-6">
                                    @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                        <?php
                                        $seo_example_title = $Sections->title_en;
                                        $seo_example_desc = Helper::GeneralSiteSettings("site_desc_en");
                                        if ($Sections->seo_title_en != "") {
                                            $seo_example_title = $Sections->seo_title_en;
                                        }
                                        if ($Sections->seo_description_en != "") {
                                            $seo_example_desc = $Sections->seo_description_en;
                                        }
                                        if ($Sections->seo_url_slug_en != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            $seo_example_url = url($Sections->seo_url_slug_en);
                                        } else {
                                            $seo_example_url = route('FrontendTopicsByCat', ["section" => $Sections->webmasterSection->name, "cat" => $Sections->id]);
                                        }
                                        ?>
                                        <div class="form-group">
                                            <div>
                                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status"))
                                                    <small>{!!  trans('backLang.englishBox') !!}</small> @endif
                                                &nbsp;
                                                <div class="search-example" dir="ltr">
                                                    <a id="title_in_engines_en" href="{{ $seo_example_url }}"
                                                       target="_blank">{{ $seo_example_title }}</a>
                                                    <span id="url_in_engines_en">{{ $seo_example_url }}</span>
                                                    <div id="desc_in_engines_en">{{ $seo_example_desc }} ...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <i class="material-icons">&#xe8fd;</i>
                                                <small>{!!  trans('backLang.seoTabSettings') !!}</small>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    @endif
                                </div>
                            </div>


                            {{Form::close()}}
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('footerInclude')

    <script src="{{ URL::to("backEnd/libs/js/iconpicker/fontawesome-iconpicker.js") }}"></script>
    <script>
        $(function () {
            $('.icp-auto').iconpicker({placement: '{{ (trans('backLang.direction')=="rtl")?"topLeft":"topRight" }}'});
        });

        // Js Slug
        function slugify(string) {
            return string
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/[^\w\-]+/g, "")
                .replace(/\-\-+/g, "-")
                .replace(/^-+/, "")
                .replace(/-+$/, "");
        }

        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
        $("#seo_title_ar").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#title_in_engines_ar").text($(this).val());
            } else {
                $("#title_in_engines_ar").text("<?php echo $Sections->title_ar; ?>");
            }
        });
        $("#seo_description_ar").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#desc_in_engines_ar").text($(this).val());
            } else {
                $("#desc_in_engines_ar").text("<?php echo Helper::GeneralSiteSettings("site_desc_ar"); ?>");
            }
        });
        $("#seo_url_slug_ar").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#url_in_engines_ar").text("<?php echo url(''); ?>/" + slugify($(this).val()));
            } else {
                $("#url_in_engines_ar").text("<?php echo route('FrontendTopicsByCat', ["section" => $Sections->webmasterSection->name, "cat" => $Sections->id]); ?>");
            }
        });
        @endif
        @if(Helper::GeneralWebmasterSettings("en_box_status"))
        $("#seo_title_en").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#title_in_engines_en").text($(this).val());
            } else {
                $("#title_in_engines_en").text("<?php echo $Sections->title_en; ?>");
            }
        });
        $("#seo_description_en").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#desc_in_engines_en").text($(this).val());
            } else {
                $("#desc_in_engines_en").text("<?php echo Helper::GeneralSiteSettings("site_desc_en"); ?>");
            }
        });
        $("#seo_url_slug_en").on('keyup change', function () {
            if ($(this).val() != "") {
                $("#url_in_engines_en").text("<?php echo url(''); ?>/" + slugify($(this).val()));
            } else {
                $("#url_in_engines_en").text("<?php echo route('FrontendTopicsByCat', ["section" => $Sections->webmasterSection->name, "cat" => $Sections->id]); ?>");
            }
        });
        @endif
    </script>
@endsection