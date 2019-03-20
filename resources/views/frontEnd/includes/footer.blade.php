<?php
$footer_style = "";
if (Helper::GeneralSiteSettings("style_footer_bg") != "") {
    $bg_file = URL::to('uploads/settings/' . Helper::GeneralSiteSettings("style_footer_bg"));
    $bg_color = Helper::GeneralSiteSettings("style_color1");
    $footer_style = "style='background: $bg_color url($bg_file) repeat-x center top'";
}
if (Helper::GeneralSiteSettings("style_footer") != 1) {
    $footer_style = "style=padding:0";
}
?>
<footer {!!  $footer_style !!}>
    @if(Helper::GeneralSiteSettings("style_footer")==1)
        <?php
        $bx1w = 3;
        $bx2w = 3;
        $bx3w = 3;
        $bx4w = 3;
        if (count($LatestNews) == 0 && Helper::GeneralSiteSettings("style_subscribe") == 0) {
            $bx1w = 6;
            $bx2w = 6;
            $bx3w = 6;
            $bx4w = 6;
        } elseif (count($LatestNews) == 0 || Helper::GeneralSiteSettings("style_subscribe") == 0) {
            $bx1w = 4;
            $bx2w = 4;
            $bx3w = 4;
            $bx4w = 4;
        }

        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-{{$bx1w}}">
                    <div class="widget contacts">
                        <h4 class="widgetheading"><i
                                    class="fa fa-phone-square"></i>&nbsp; {{ trans('frontLang.contactDetails') }}</h4>
                        @if(Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) !="")
                            <address>
                                <strong>{{ trans('frontLang.address') }}:</strong><br>
                                <i class="fa fa-map-marker"></i>
                                &nbsp;{{ Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) }}
                            </address>
                        @endif
                        @if(Helper::GeneralSiteSettings("contact_t3") !="")
                            <p>
                                <strong>{{ trans('frontLang.callUs') }}:</strong><br>
                                <i class="fa fa-phone"></i> &nbsp;<a
                                        href="call:{{ Helper::GeneralSiteSettings("contact_t3") }}"><span
                                            dir="ltr">{{ Helper::GeneralSiteSettings("contact_t3") }}</span></a></p>
                        @endif
                        @if(Helper::GeneralSiteSettings("contact_t6") !="")
                            <p>
                                <strong>{{ trans('frontLang.email') }}:</strong><br>
                                <i class="fa fa-envelope"></i> &nbsp;<a
                                        href="mailto:{{ Helper::GeneralSiteSettings("contact_t6") }}">{{ Helper::GeneralSiteSettings("contact_t6") }}</a>
                            </p>
                        @endif
                    </div>
                </div>
                @if(count($LatestNews)>0)
                    <?php
                    $footer_title_var = "title_" . trans('backLang.boxCode');
                    $footer_title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                    $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                    ?>
                    <div class="col-lg-{{$bx2w}}">
                        <div class="widget">
                            <h4 class="widgetheading"><i
                                        class="fa fa-rss"></i>&nbsp; {{ trans('frontLang.latestNews') }}
                            </h4>
                            <ul class="link-list">
                                @foreach($LatestNews as $LatestNew)
                                    <?php
                                    if ($LatestNew->$footer_title_var != "") {
                                        $LatestNew_title = $LatestNew->$footer_title_var;
                                    } else {
                                        $LatestNew_title = $LatestNew->$footer_title_var2;
                                    }
                                    if ($LatestNew->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                            $topic_link_url = url(trans('backLang.code') . "/" . $LatestNew->$slug_var);
                                        } else {
                                            $topic_link_url = url($LatestNew->$slug_var);
                                        }
                                    } else {
                                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                            $topic_link_url = route('FrontendTopicByLang', ["lang" => trans('backLang.code'), "section" => $LatestNew->webmasterSection->name, "id" => $LatestNew->id]);
                                        } else {
                                            $topic_link_url = route('FrontendTopic', ["section" => $LatestNew->webmasterSection->name, "id" => $LatestNew->id]);
                                        }
                                    }
                                    ?>
                                    <li>
                                        <a href="{{ $topic_link_url }}">{{ $LatestNew_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="col-lg-{{$bx3w}}">
                    <div class="widget">
                        <?php
                        $link_title_var = "title_" . trans('backLang.boxCode');
                        $main_title_var = "FooterMenuLinks_name_" . trans('backLang.boxCode');
                        $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                        $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                        ?>
                        <h4 class="widgetheading"><i class="fa fa-bookmark"></i>&nbsp; {{$$main_title_var}}</h4>
                        <ul class="link-list">
                            @foreach($FooterMenuLinks as $FooterMenuLink)
                                @if($FooterMenuLink->type==3 || $FooterMenuLink->type==2)
                                    {{-- Get Section Name as a link --}}
                                    <li>
                                        <?php
                                        if ($FooterMenuLink->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $FooterMenuLink->webmasterSection->$slug_var);
                                            } else {
                                                $mmnnuu_link = url($FooterMenuLink->webmasterSection->$slug_var);
                                            }
                                        } else {
                                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                                $mmnnuu_link = url(trans('backLang.code') . "/" . $FooterMenuLink->webmasterSection->name);
                                            } else {
                                                $mmnnuu_link = url($FooterMenuLink->webmasterSection->name);
                                            }
                                        }
                                        ?>
                                        <a href="{{ $mmnnuu_link }}">{{ $FooterMenuLink->$link_title_var }}</a>
                                    </li>
                                @elseif($FooterMenuLink->type==1)
                                    {{-- Direct link --}}
                                    <?php
                                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                        $this_link_url = url(trans('backLang.code') . "/" . $FooterMenuLink->link);
                                    } else {
                                        $this_link_url = url($FooterMenuLink->link);
                                    }
                                    ?>
                                    <li>
                                        <a href="{{ $this_link_url }}">{{ $FooterMenuLink->$link_title_var }}</a>
                                    </li>
                                @else
                                    {{-- No link --}}
                                    <li><a>{{ $FooterMenuLink->$link_title_var }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @include('frontEnd.includes.subscribe')

            </div>
        </div>
    @endif
    <div id="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright">
                        <?php
                        $site_title_var = "site_title_" . trans('backLang.boxCode');
                        ?>
                        &copy; <?php echo date("Y") ?> {{ trans('frontLang.AllRightsReserved') }}
                        . <a>{{$WebsiteSettings->$site_title_var}}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="social-network">
                        @if($WebsiteSettings->social_link1)
                            <li><a href="{{$WebsiteSettings->social_link1}}" data-placement="top" title="Facebook"
                                   target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link2)
                            <li><a href="{{$WebsiteSettings->social_link2}}" data-placement="top" title="Twitter"
                                   target="_blank"><i
                                            class="fa fa-twitter"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link3)
                            <li><a href="{{$WebsiteSettings->social_link3}}" data-placement="top" title="Google+"
                                   target="_blank"><i
                                            class="fa fa-google-plus"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link4)
                            <li><a href="{{$WebsiteSettings->social_link4}}" data-placement="top" title="linkedin"
                                   target="_blank"><i
                                            class="fa fa-linkedin"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link5)
                            <li><a href="{{$WebsiteSettings->social_link5}}" data-placement="top" title="Youtube"
                                   target="_blank"><i
                                            class="fa fa-youtube-play"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link6)
                            <li><a href="{{$WebsiteSettings->social_link6}}" data-placement="top" title="Instagram"
                                   target="_blank"><i
                                            class="fa fa-instagram"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link7)
                            <li><a href="{{$WebsiteSettings->social_link7}}" data-placement="top" title="Pinterest"
                                   target="_blank"><i
                                            class="fa fa-pinterest"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link8)
                            <li><a href="{{$WebsiteSettings->social_link8}}" data-placement="top" title="Tumblr"
                                   target="_blank"><i
                                            class="fa fa-tumblr"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link9)
                            <li><a href="{{$WebsiteSettings->social_link9}}" data-placement="top" title="Flickr"
                                   target="_blank"><i
                                            class="fa fa-flickr"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link10)
                            <li><a href="whatsapp://call?number={{$WebsiteSettings->social_link10}}"
                                   data-placement="top"
                                   title="Whatsapp" target="_blank"><i
                                            class="fa fa-whatsapp"></i></a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>