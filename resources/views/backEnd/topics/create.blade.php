@extends('backEnd.layout')

@section('headerInclude')
    <link href="{{ URL::to("backEnd/libs/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
@endsection
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">
                        &#xe02e;</i> {{ trans('backLang.topicNew') }} {!! trans('backLang.'.$WebmasterSection->name) !!}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a>{!! trans('backLang.'.$WebmasterSection->name) !!}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route('topics',$WebmasterSection->id) }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['topicsStore',$WebmasterSection->id],'method'=>'POST', 'files' => true ])}}

                @if($WebmasterSection->date_status)
                    <div class="form-group row">
                        <label for="date"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.topicDate') !!}
                        </label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                    {!! Form::text('date',date("Y-m-d"), array('placeholder' => '','class' => 'form-control','id'=>'date','required'=>'')) !!}
                                    <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    {!! Form::hidden('date',date("Y-m-d"), array('placeholder' => '','class' => 'form-control','id'=>'date')) !!}
                @endif

                @if($WebmasterSection->expire_date_status)
                    <div class="form-group row">
                        <label for="date"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.expireDate') !!}
                        </label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                    {!! Form::text('expire_date','', array('placeholder' => '','class' => 'form-control','id'=>'expire_date')) !!}
                                    <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                @if($WebmasterSection->sections_status!=0)
                    <div class="form-group row">
                        <label for="section_id"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.hasCategories') !!} </label>
                        <div class="col-sm-10">
                            <select name="section_id[]" id="section_id" class="form-control select2-multiple" multiple
                                    ui-jp="select2"
                                    ui-options="{theme: 'bootstrap'}" required>
                                <?php
                                $title_var = "title_" . trans('backLang.boxCode');
                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                $t_arrow = "&laquo;";
                                if (trans('backLang.direction') == "ltr") {
                                    $t_arrow = "&raquo;";
                                }
                                ?>
                                @foreach ($fatherSections as $fatherSection)
                                    <?php
                                    if ($fatherSection->$title_var != "") {
                                        $ftitle = $fatherSection->$title_var;
                                    } else {
                                        $ftitle = $fatherSection->$title_var2;
                                    }
                                    ?>
                                    <option value="{{ $fatherSection->id  }}">{{ $ftitle }}</option>
                                    @foreach ($fatherSection->fatherSections as $subFatherSection)
                                        <?php
                                        if ($subFatherSection->$title_var != "") {
                                            $title = $subFatherSection->$title_var;
                                        } else {
                                            $title = $subFatherSection->$title_var2;
                                        }
                                        ?>
                                        <option value="{{ $subFatherSection->id  }}">{{ $ftitle }} {{$t_arrow}} {{ $title }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    {!! Form::hidden('section_id','0') !!}
                @endif

                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                    <div class="form-group row">
                        <label for="title_ar"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('title_ar','', array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>
                @endif
                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                    <div class="form-group row">
                        <label for="title_en"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.topicName') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('title_en','', array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                @endif

                @if($WebmasterSection->longtext_status)

                    @if($WebmasterSection->editor_status)
                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group row">
                                <label for="details_ar"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.bannerDetails') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    <div class="box p-a-xs">
                                        {!! Form::textarea('details_ar','<div dir=rtl><br></div>', array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control summernote', 'dir'=>trans('backLang.rtl'),'ui-options'=>'{height: 300}')) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group row">
                                <label for="details_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.bannerDetails') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    <div class="box p-a-xs">
                                        {!! Form::textarea('details_en','<div dir=ltr><br></div>', array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'ui-options'=>'{height: 300}')) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group row">
                                <label for="details_ar"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.bannerDetails') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::textarea('details_ar','', array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.rtl'),'rows'=>'5')) !!}
                                </div>
                            </div>
                        @endif
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group row">
                                <label for="details_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.bannerDetails') !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::textarea('details_en','', array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'rows'=>'5')) !!}
                                </div>
                            </div>
                        @endif
                    @endif
                @endif

                @if($WebmasterSection->type==2)
                    <div class="form-group row">
                        <label for="video_type"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoType') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','0',true, array('id' => 'video_type1','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="none";document.getElementById("embed_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="block";document.getElementById("youtube_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.bannerVideoType1') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','1',false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="block";document.getElementById("embed_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("youtube_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.bannerVideoType2') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','2',false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("vimeo_link_div").style.display="block";document.getElementById("embed_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("vimeo_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.bannerVideoType3') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','3',false, array('id' => 'video_type3','class'=>'has-value','onclick'=>'document.getElementById("embed_link_div").style.display="block";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("embed_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    Embed
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="files_div">
                        <div class="form-group row">
                            <label for="video_file"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.topicVideo') !!}</label>
                            <div class="col-sm-10">
                                {!! Form::file('video_file', array('class' => 'form-control','id'=>'video_file','accept'=>'*')) !!}
                            </div>
                        </div>

                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="col-sm-offset-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!!  trans('backLang.videoTypes') !!}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="youtube_link_div" style="display: none">
                        <label for="youtube_link"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoUrl') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('youtube_link','', array('placeholder' => 'https://www.youtube.com/watch?v=JQs4QyKnYMQ','class' => 'form-control','id'=>'youtube_link', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                    <div class="form-group row" id="vimeo_link_div" style="display: none">
                        <label for="youtube_link"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoUrl2') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('vimeo_link','', array('placeholder' => 'https://vimeo.com/131766159','class' => 'form-control','id'=>'vimeo_link', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                    <div class="form-group row" id="embed_link_div" style="display: none">
                        <label for="embed_link"
                               class="col-sm-2 form-control-label">Embed Code</label>
                        <div class="col-sm-10">
                            {!! Form::textarea('embed_link','', array('placeholder' => '','class' => 'form-control','id'=>'embed_link', 'dir'=>trans('backLang.ltr'),'rows'=>'3')) !!}
                        </div>
                    </div>
                @endif

                @if($WebmasterSection->type==3)
                    <div class="form-group row">
                        <label for="audio_file"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.topicAudio') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::file('audio_file', array('class' => 'form-control','id'=>'audio_file','accept'=>'audio/*')) !!}
                        </div>
                    </div>

                    <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <small>
                                <i class="material-icons">&#xe8fd;</i>
                                {!!  trans('backLang.audioTypes') !!}
                            </small>
                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <label for="photo_file"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.topicPhoto') !!}</label>
                    <div class="col-sm-10">
                        {!! Form::file('photo_file', array('class' => 'form-control','id'=>'photo_file','accept'=>'image/*')) !!}
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

                @if($WebmasterSection->icon_status)
                    <div class="form-group row">
                        <label for="icon"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionIcon') !!}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                {!! Form::text('icon','', array('placeholder' => '','class' => 'form-control icp icp-auto','id'=>'icon', 'data-placement'=>'bottomRight')) !!}
                                <span class="input-group-addon"></span>
                            </div>
                        </div>
                    </div>
                @endif

                @if($WebmasterSection->attach_file_status)
                    <div class="form-group row">
                        <label for="attach_file"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.topicAttach') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::file('attach_file', array('class' => 'form-control','id'=>'attach_file')) !!}
                        </div>
                    </div>
                    <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <small>
                                <i class="material-icons">&#xe8fd;</i>
                                {!!  trans('backLang.attachTypes') !!}
                            </small>
                        </div>
                    </div>
                @endif


                {{--Additional Feilds--}}
                @if(count($WebmasterSection->customFields) >0)
                    <?php
                    $cf_title_var = "title_" . trans('backLang.boxCode');
                    $cf_title_var2 = "title_" . trans('backLang.boxCodeOther');
                    ?>
                    @foreach($WebmasterSection->customFields as $customField)
                        <?php
                        if ($customField->$cf_title_var != "") {
                            $cf_title = $customField->$cf_title_var;
                        } else {
                            $cf_title = $customField->$cf_title_var2;
                        }

                        // check field language status
                        $cf_land_identifier = "";
                        $cf_land_active = false;
                        $cf_land_dir = trans('backLang.direction');
                        if (Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")) {
                            if ($customField->lang_code == "ar") {
                                $cf_land_identifier = trans('backLang.arabicBox');
                            } elseif ($customField->lang_code == "en") {
                                $cf_land_identifier = trans('backLang.englishBox');
                            }
                        }
                        if (Helper::GeneralWebmasterSettings("ar_box_status") && $customField->lang_code == "ar") {
                            $cf_land_active = true;
                            $cf_land_dir = "rtl";
                        }
                        if (Helper::GeneralWebmasterSettings("en_box_status") && $customField->lang_code == "en") {
                            $cf_land_active = true;
                            $cf_land_dir = "ltr";
                        }
                        if ($customField->lang_code == "all") {
                            $cf_land_active = true;
                        }
                        // required Status
                        $cf_required = "";
                        if ($customField->required) {
                            $cf_required = "required";
                        }

                        ?>

                        @if($cf_land_active)
                            @if($customField->type ==12)
                                {{--Vimeo Video Link--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!} <i class="fa fa-vimeo"></i>
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::text('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>'ltr')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==11)
                                {{--Youtube Video Link--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!} <i class="fa fa-youtube"></i>
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::text('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>'ltr')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==10)
                                {{--Video File--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        {!! Form::file('customField_'.$customField->id, array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','accept'=>'*')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==9)
                                {{--Attach File--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        {!! Form::file('customField_'.$customField->id, array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','accept'=>'*')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==8)
                                {{--Photo File--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        {!! Form::file('customField_'.$customField->id, array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','accept'=>'image/*')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==7)
                                {{--Multi Check--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        <select name="{{'customField_'.$customField->id}}[]"
                                                id="{{'customField_'.$customField->id}}"
                                                class="form-control select2-multiple" multiple
                                                ui-jp="select2"
                                                ui-options="{theme: 'bootstrap'}" {{$cf_required}}>
                                            <?php
                                            $cf_details_var = "details_" . trans('backLang.boxCode');
                                            $cf_details_var2 = "details_en" . trans('backLang.boxCodeOther');
                                            if ($customField->$cf_details_var != "") {
                                                $cf_details = $customField->$cf_details_var;
                                            } else {
                                                $cf_details = $customField->$cf_details_var2;
                                            }
                                            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                            $line_num = 1;
                                            ?>
                                            @foreach ($cf_details_lines as $cf_details_line)
                                                <option value="{{ $line_num  }}" {{ ($customField->default_value == $line_num) ? "selected='selected'":""  }}>{{ $cf_details_line }}</option>
                                                <?php
                                                $line_num++;
                                                ?>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @elseif($customField->type ==6)
                                {{--Select--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        <select name="{{'customField_'.$customField->id}}"
                                                id="{{'customField_'.$customField->id}}"
                                                class="form-control c-select" {{$cf_required}}>
                                            <option value="">- - {!!  $cf_title !!} - -</option>
                                            <?php
                                            $cf_details_var = "details_" . trans('backLang.boxCode');
                                            $cf_details_var2 = "details_en" . trans('backLang.boxCodeOther');
                                            if ($customField->$cf_details_var != "") {
                                                $cf_details = $customField->$cf_details_var;
                                            } else {
                                                $cf_details = $customField->$cf_details_var2;
                                            }
                                            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                            $line_num = 1;
                                            ?>
                                            @foreach ($cf_details_lines as $cf_details_line)
                                                <option value="{{ $line_num  }}" {{ ($customField->default_value == $line_num) ? "selected='selected'":""  }}>{{ $cf_details_line }}</option>
                                                <?php
                                                $line_num++;
                                                ?>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @elseif($customField->type ==5)
                                {{--Date & Time--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD hh:mm A',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($customField->type ==4)
                                {{--Date--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @elseif($customField->type ==3)
                                {{--Email Address--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::email('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                    </div>
                                </div>

                            @elseif($customField->type ==2)
                                {{--Number--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::number('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','min'=>0, 'dir'=>$cf_land_dir)) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==1)
                                {{--Text Area--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::textarea('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control',$cf_required=>'', 'dir'=>$cf_land_dir,'rows'=>'5')) !!}
                                    </div>
                                </div>
                            @else
                                {{--Text Box--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::text('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                    </div>
                                </div>
                            @endif
                        @endif

                    @endforeach
                @endif
                {{--End of -- Additional Feilds--}}

                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                        <a href="{{ route('topics',$WebmasterSection->id) }}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                    </div>
                </div>


                {{Form::close()}}
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
    </script>
@endsection