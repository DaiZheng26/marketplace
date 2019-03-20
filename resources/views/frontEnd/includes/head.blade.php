<meta charset="utf-8">
<title>{{$PageTitle}} {{($PageTitle !="")? "|":""}} {{ Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode')) }}</title>
<meta name="description" content="{{$PageDescription}}"/>
<meta name="keywords" content="{{$PageKeywords}}"/>
<meta name="author" content="{{ URL::to('') }}"/>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="{{ URL::asset('frontEnd/css/bootstrap.min.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('frontEnd/css/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
<link href="{{ URL::asset('frontEnd/css/jcarousel.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('frontEnd/css/flexslider.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('frontEnd/css/style.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('frontEnd/css/color.css') }}" rel="stylesheet"/>

@if( trans('backLang.direction')=="rtl")
<link href="{{ URL::asset('frontEnd/css/rtl.css') }}" rel="stylesheet"/>
@endif

<!-- Favicon and Touch Icons -->
@if(Helper::GeneralSiteSettings("style_fav") !="")
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_fav")) }}" rel="shortcut icon"
          type="image/png">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="shortcut icon" type="image/png">
@endif
@if(Helper::GeneralSiteSettings("style_apple") !="")
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="144x144">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="144x144">
@endif
