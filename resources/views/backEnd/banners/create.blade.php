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
                <h3><i class="material-icons">&#xe02e;</i> {{ trans('backLang.bannerAdd') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.adsBanners') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("Banners")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['BannersStore'],'method'=>'POST', 'files' => true ])}}
                {!! Form::hidden('section_id',$WebmasterBanner->id) !!}

                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                    <div class="form-group row">
                        <label for="title_ar"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerTitle') !!}
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
                               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerTitle') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('title_en','', array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                @endif

                @if($WebmasterBanner->type==2)
                    <div class="form-group row">
                        <label for="video_type"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerVideoType') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','0',true, array('id' => 'video_type1','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="block";document.getElementById("youtube_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.bannerVideoType1') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','1',false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="block";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("youtube_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.bannerVideoType2') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','2',false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("vimeo_link_div").style.display="block";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("vimeo_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ trans('backLang.bannerVideoType3') }}
                                </label>
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
                @endif


                @if($WebmasterBanner->type!=0)
                    @if($WebmasterBanner->type==1)
                        <?php
                        $ttile = "bannerPhoto";
                        $file1 = "file_ar";
                        $file2 = "file_en";
                        $file_allow = "image/*";
                        ?>
                    @else
                        <?php
                        $ttile = "topicVideo";
                        $file1 = "file2_ar";
                        $file2 = "file2_en";
                        $file_allow = "*'";
                        ?>
                    @endif

                    <div id="files_div">
                        @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                            <div class="form-group row">
                                <label for="file_ar"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.'.$ttile) !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::file($file1, array('class' => 'form-control','id'=>'file_ar','accept'=>$file_allow)) !!}
                                </div>
                            </div>
                        @endif
                        @if(Helper::GeneralWebmasterSettings("en_box_status"))
                            <div class="form-group row">
                                <label for="file_en"
                                       class="col-sm-2 form-control-label">{!!  trans('backLang.'.$ttile) !!}
                                    @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::file($file2, array('class' => 'form-control','id'=>'file_en','accept'=>$file_allow)) !!}
                                </div>
                            </div>
                        @endif
                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="col-sm-offset-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    @if($WebmasterBanner->type==1)
                                        {!!  trans('backLang.imagesTypes') !!}
                                    @else
                                        {!!  trans('backLang.videoTypes') !!}
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                @endif
                @if($WebmasterBanner->desc_status)

                    @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                        <div class="form-group row">
                            <label for="details_ar"
                                   class="col-sm-2 form-control-label">{!!  trans('backLang.bannerDetails') !!}
                                @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                            </label>
                            <div class="col-sm-10">
                                {!! Form::textarea('details_ar','', array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.rtl'),'rows'=>'3')) !!}
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
                                {!! Form::textarea('details_en','', array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'rows'=>'3')) !!}
                            </div>
                        </div>
                    @endif
                @endif

                @if($WebmasterBanner->link_status)
                    <div class="form-group row">
                        <label for="link_url"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerLinkUrl') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('link_url','', array('placeholder' => 'http://www.site.com','class' => 'form-control','id'=>'link_url', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                @endif

                @if($WebmasterBanner->type==0)
                    <div class="form-group row">
                        <label for="code"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.bannerCode') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::textarea('code','', array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'),'rows'=>'3')) !!}
                        </div>
                    </div>
                @endif

                @if($WebmasterBanner->icon_status)
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

                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                        <a href="{{route("Banners")}}"
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

