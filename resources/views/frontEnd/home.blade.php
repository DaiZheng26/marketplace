@extends('frontEnd.layout')

@section('content')

    <!-- start Home Slider -->
    @include('frontEnd.includes.slider')
    <!-- end Home Slider -->


    @if(count($TextBanners)>0)
        @foreach($TextBanners->slice(0,1) as $TextBanner)
            <?php
            try {
                $TextBanner_type = $TextBanner->webmasterBanner->type;
            } catch (Exception $e) {
                $TextBanner_type = 0;
            }
            ?>
        @endforeach
        <?php
        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');

        $col_width = 12;
        if (count($TextBanners) == 2) {
            $col_width = 6;
        }
        if (count($TextBanners) == 3) {
            $col_width = 4;
        }
        if (count($TextBanners) > 3) {
            $col_width = 3;
        }
        ?>
        <section class="content-row-no-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" style="margin-bottom: 0;">
                            @foreach($TextBanners as $TextBanner)
                                <div class="col-lg-{{$col_width}}">
                                    <div class="box">
                                        <div class="box-gray aligncenter">
                                            @if($TextBanner->code !="")
                                                {!! $TextBanner->code !!}
                                            @else
                                                @if($TextBanner->icon !="")
                                                    <div class="icon">
                                                        <i class="fa {{$TextBanner->icon}} fa-3x"></i>
                                                    </div>
                                                @elseif($TextBanner->$file_var !="")
                                                    <img src="{{ URL::to('uploads/banners/'.$TextBanner->$file_var) }}"
                                                         alt="{{ $TextBanner->$title_var }}"/>
                                                @endif
                                                <h4>{!! $TextBanner->$title_var !!}</h4>
                                                @if($TextBanner->$details_var !="")
                                                    <p>{!! nl2br($TextBanner->$details_var) !!}</p>
                                                @endif
                                            @endif

                                        </div>
                                        @if($TextBanner->link_url !="")
                                            <div class="box-bottom">
                                                <a href="{!! $TextBanner->link_url !!}">{{ trans('frontLang.moreDetails') }}</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($HomeTopics)>0)
        <section class="content-row-bg">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-row-head">
                            <!-- <h2 class="heading">Our Services</h2> -->
                            <h2 class="heading">{{ trans('frontLang.homeContents1Title') }}</h2>
                            <!-- <small> The our services from our blog, you can browse more</small> -->
                            <small>{{ trans('frontLang.homeContents1desc') }}</small>
                        </div>
                        <div class="row">
                            <?php
                            $title_var = "title_" . trans('backLang.boxCode');
                            $title_var2 = "title_" . trans('backLang.boxCodeOther');
                            $details_var = "details_" . trans('backLang.boxCode');
                            $details_var2 = "details_" . trans('backLang.boxCodeOther');
                            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                            $section_url = "";
                            ?>
                            @foreach($HomeTopics as $HomeTopic)
                                <?php
                                if ($HomeTopic->$title_var != "") {
                                    $title = $HomeTopic->$title_var;
                                } else {
                                    $title = $HomeTopic->$title_var2;
                                }
                                if ($HomeTopic->$details_var != "") {
                                    $details = $details_var;
                                } else {
                                    $details = $details_var2;
                                }
                                if ($HomeTopic->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $section_url = url(trans('backLang.code') . "/" . $HomeTopic->webmasterSection->$slug_var);
                                    } else {
                                        $section_url = url($HomeTopic->webmasterSection->$slug_var);
                                    }
                                } else {
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $section_url = url(trans('backLang.code') . "/" . $HomeTopic->webmasterSection->name);
                                    } else {
                                        $section_url = url($HomeTopic->webmasterSection->name);
                                    }
                                }

                                if ($HomeTopic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $topic_link_url = url(trans('backLang.code') . "/" . $HomeTopic->$slug_var);
                                    } else {
                                        $topic_link_url = url($HomeTopic->$slug_var);
                                    }
                                } else {
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $topic_link_url = route('FrontendTopicByLang', ["lang" => trans('backLang.code'), "section" => $HomeTopic->webmasterSection->name, "id" => $HomeTopic->id]);
                                    } else {
                                        $topic_link_url = route('FrontendTopic', ["section" => $HomeTopic->webmasterSection->name, "id" => $HomeTopic->id]);
                                    }
                                }

                                ?>
                                <div class="col-lg-4">
                                    <h4>
                                        @if($HomeTopic->icon !="")
                                            <i class="fa {!! $HomeTopic->icon !!} "></i>&nbsp;
                                        @endif
                                        {{ $title }}
                                    </h4>
                                    @if($HomeTopic->photo_file !="")
                                        <img src="{{ URL::to('uploads/topics/'.$HomeTopic->photo_file) }}"
                                             alt="{{ $title }}"/>
                                    @endif

                                    {{--Additional Feilds--}}
                                    @if(count($HomeTopic->webmasterSection->customFields) >0)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div>
                                                    <?php
                                                    $cf_title_var = "title_" . trans('backLang.boxCode');
                                                    $cf_title_var2 = "title_" . trans('backLang.boxCodeOther');
                                                    ?>
                                                    @foreach($HomeTopic->webmasterSection->customFields as $customField)
                                                        <?php
                                                        if ($customField->$cf_title_var != "") {
                                                            $cf_title = $customField->$cf_title_var;
                                                        } else {
                                                            $cf_title = $customField->$cf_title_var2;
                                                        }


                                                        $cf_saved_val = "";
                                                        $cf_saved_val_array = array();
                                                        if (count($HomeTopic->fields) > 0) {
                                                            foreach ($HomeTopic->fields as $t_field) {
                                                                if ($t_field->field_id == $customField->id) {
                                                                    if ($customField->type == 7) {
                                                                        // if multi check
                                                                        $cf_saved_val_array = explode(", ", $t_field->field_value);
                                                                    } else {
                                                                        $cf_saved_val = $t_field->field_value;
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        ?>

                                                        @if(($cf_saved_val!="" || count($cf_saved_val_array) > 0) && ($customField->lang_code == "all" || $customField->lang_code == trans('backLang.boxCode')))
                                                            @if($customField->type ==12)
                                                                {{--Vimeo Video Link--}}
                                                            @elseif($customField->type ==11)
                                                                {{--Youtube Video Link--}}
                                                            @elseif($customField->type ==10)
                                                                {{--Video File--}}
                                                            @elseif($customField->type ==9)
                                                                {{--Attach File--}}
                                                            @elseif($customField->type ==8)
                                                                {{--Photo File--}}
                                                            @elseif($customField->type ==7)
                                                                {{--Multi Check--}}
                                                                <div class="row field-row">
                                                                    <div class="col-lg-3">
                                                                        {!!  $cf_title !!} :
                                                                    </div>
                                                                    <div class="col-lg-9">
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
                                                                            @if (in_array($line_num,$cf_saved_val_array))
                                                                                <span class="badge">
                                                            {!! $cf_details_line !!}
                                                        </span>
                                                                            @endif
                                                                            <?php
                                                                            $line_num++;
                                                                            ?>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @elseif($customField->type ==6)
                                                                {{--Select--}}
                                                                <div class="row field-row">
                                                                    <div class="col-lg-3">
                                                                        {!!  $cf_title !!} :
                                                                    </div>
                                                                    <div class="col-lg-9">
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
                                                                            @if ($line_num == $cf_saved_val)
                                                                                {!! $cf_details_line !!}
                                                                            @endif
                                                                            <?php
                                                                            $line_num++;
                                                                            ?>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @elseif($customField->type ==5)
                                                                {{--Date & Time--}}
                                                                <div class="row field-row">
                                                                    <div class="col-lg-3">
                                                                        {!!  $cf_title !!} :
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        {!! date('Y-m-d H:i:s', strtotime($cf_saved_val)) !!}
                                                                    </div>
                                                                </div>
                                                            @elseif($customField->type ==4)
                                                                {{--Date--}}
                                                                <div class="row field-row">
                                                                    <div class="col-lg-3">
                                                                        {!!  $cf_title !!} :
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        {!! date('Y-m-d', strtotime($cf_saved_val)) !!}
                                                                    </div>
                                                                </div>
                                                            @elseif($customField->type ==3)
                                                                {{--Email Address--}}
                                                                <div class="row field-row">
                                                                    <div class="col-lg-3">
                                                                        {!!  $cf_title !!} :
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        {!! $cf_saved_val !!}
                                                                    </div>
                                                                </div>
                                                            @elseif($customField->type ==2)
                                                                {{--Number--}}
                                                                <div class="row field-row">
                                                                    <div class="col-lg-3">
                                                                        {!!  $cf_title !!} :
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        {!! $cf_saved_val !!}
                                                                    </div>
                                                                </div>
                                                            @elseif($customField->type ==1)
                                                                {{--Text Area--}}
                                                            @else
                                                                {{--Text Box--}}
                                                                <div class="row field-row">
                                                                    <div class="col-lg-3">
                                                                        {!!  $cf_title !!} :
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        {!! $cf_saved_val !!}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{--End of -- Additional Feilds--}}
                                    <p class="text-justify">{{ str_limit(strip_tags($HomeTopic->$details), $limit = 400, $end = '...') }}
                                        &nbsp; <a href="{{ $topic_link_url }}">{{ trans('frontLang.readMore') }}
                                            <i
                                                    class="fa fa-caret-{{ trans('backLang.right') }}"></i></a>
                                    </p>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="more-btn">
                            <a href="{{ url($section_url) }}" class="btn btn-theme"><i
                                        class="fa fa-angle-left"></i>&nbsp; {{ trans('frontLang.viewMore') }}
                                &nbsp;<i
                                        class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif


    @if(count($HomePhotos)>0)
        <section class="content-row-no-bg">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-row-head">
                            <h2 class="heading">{{ trans('frontLang.homeContents2Title') }}</h2>
                            <!-- <h2 class="heading">Fresh Vegetable</h2> -->
                            <small>{{ trans('frontLang.homeContents2desc') }}</small>
                            <!-- <small>Some of our Fresh vegetable, you can browse more</small> -->
                        </div>
                        <div class="row">
                            <section id="projects">
                                <ul id="thumbs" class="portfolio">
                                    <?php
                                    $title_var = "title_" . trans('backLang.boxCode');
                                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                    $section_url = "";
                                    $ph_count = 0;
                                    ?>
                                    @foreach($HomePhotos as $HomePhoto)
                                        <?php
                                        if ($HomePhoto->$title_var != "") {
                                            $title = $HomePhoto->$title_var;
                                        } else {
                                            $title = $HomePhoto->$title_var2;
                                        }
                                        if ($HomePhoto->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $section_url = url(trans('backLang.code') . "/" . $HomePhoto->webmasterSection->$slug_var);
                                            } else {
                                                $section_url = url($HomePhoto->webmasterSection->$slug_var);
                                            }
                                        } else {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $section_url = url(trans('backLang.code') . "/" . $HomePhoto->webmasterSection->name);
                                            } else {
                                                $section_url = url($HomePhoto->webmasterSection->name);
                                            }
                                        }
                                        ?>
                                        @foreach($HomePhoto->photos as $photo)
                                            @if($ph_count<12)
                                                <li class="col-lg-2 design" data-id="id-0" data-type="web">
                                                    <div class="relative">
                                                        <div class="item-thumbs">
                                                            <a class="hover-wrap fancybox" data-fancybox-group="gallery"
                                                               title="{{ $title }}"
                                                               href="{{ URL::to('uploads/topics/'.$photo->file) }}">
                                                                <span class="overlay-img"></span>
                                                                <span class="overlay-img-thumb"><i
                                                                            class="fa fa-search-plus"></i></span>
                                                            </a>
                                                            <!-- Thumb Image and Description -->
                                                            <img src="{{ URL::to('uploads/topics/'.$photo->file) }}"
                                                                 alt="{{ $title }}" width="1100px" height="763px">
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            <?php
                                            $ph_count++;
                                            ?>
                                        @endforeach
                                    @endforeach

                                </ul>
                            </section>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="more-btn">
                                    <a href="{{ url($section_url) }}" class="btn btn-theme"><i
                                                class="fa fa-angle-left"></i>&nbsp; {{ trans('frontLang.viewMore') }}
                                        &nbsp;<i
                                                class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($HomePartners)>0)
        <section class="content-row-no-bg top-line">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-row-head">
                            <h2 class="heading">{{ trans('frontLang.partners') }}</h2>
                            <small>{{ trans('frontLang.partnersMsg') }}</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="partners_carousel slide" id="myCarousel" style="direction: ltr">
                        <div class="carousel-inner">
                            <div class="item active">
                                <ul class="thumbnails">
                                    <?php
                                    $ii = 0;
                                    $title_var = "title_" . trans('backLang.boxCode');
                                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                    ?>

                                    @foreach($HomePartners as $HomePartner)
                                        <?php
                                        if ($HomePartner->$title_var != "") {
                                            $title = $HomePartner->$title_var;
                                        } else {
                                            $title = $HomePartner->$title_var2;
                                        }
                                        if ($HomePartner->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $section_url = url(trans('backLang.code') . "/" . $HomePartner->webmasterSection->$slug_var);
                                            } else {
                                                $section_url = url($HomePartner->webmasterSection->$slug_var);
                                            }
                                        } else {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $section_url = url(trans('backLang.code') . "/" . $HomePartner->webmasterSection->name);
                                            } else {
                                                $section_url = url($HomePartner->webmasterSection->name);
                                            }
                                        }

                                        if ($ii == 6) {
                                            echo "
                                                    </ul>
                                </div><!-- /Slide -->
                                <div class='item'>
                                    <ul class='thumbnails'>
                                                    ";
                                            $ii = 0;
                                        }
                                        ?>
                                        <li class="col-sm-2">
                                            <div>
                                                <div class="thumbnail">
                                                    <img src="{{ URL::to('uploads/topics/'.$HomePartner->photo_file) }}"
                                                         data-placement="bottom" title="{{ $title }}"
                                                         alt="{{ $title }}">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </li>
                                        <?php
                                        $ii++;
                                        ?>
                                    @endforeach

                                </ul>
                            </div><!-- /Slide -->
                        </div>
                        <nav>
                            <ul class="control-box pager">
                                <li><a data-slide="prev" href="#myCarousel" class=""><i
                                                class="fa fa-angle-left"></i></a></li>
                                {{--<li><a href="{{ url($section_url) }}">{{ trans('frontLang.viewMore') }}</a>--}}
                                {{--</li>--}}
                                <li><a data-slide="next" href="#myCarousel" class=""><i
                                                class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
                        <!-- /.control-box -->

                    </div><!-- /#myCarousel -->
                </div>

            </div>

        </section>
    @endif

@endsection