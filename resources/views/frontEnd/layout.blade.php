<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    @include('frontEnd.includes.head')
    @include('frontEnd.includes.colors')
</head>
<?php
$bdy_class = "";
$bdy_bg_color = "";
$bdy_bg_image = "";
if (Helper::GeneralSiteSettings("style_type")) {
    $bdy_class = "boxed-layout";
    if (Helper::GeneralSiteSettings("style_bg_type") == 0) {
        $bdy_bg_color = "background-color: #000;";
        if (Helper::GeneralSiteSettings("style_bg_color") != "") {
            $bdy_bg_color = "background-attachment: fixed;background-color: " . Helper::GeneralSiteSettings("style_bg_color") . ";";
        }
        $bdy_bg_image = "";
    } elseif (Helper::GeneralSiteSettings("style_bg_type") == 1) {
        $bdy_bg_color = "";
        $bdy_bg_image = "background-attachment: fixed;background-image:url(" . URL::to('uploads/pattern/' . Helper::GeneralSiteSettings("style_bg_pattern")) . ")";
    } elseif (Helper::GeneralSiteSettings("style_bg_type") == 2) {
        $bdy_bg_color = "";
        $bdy_bg_image = "background-attachment: fixed;background-image:url(" . URL::to('uploads/settings/' . Helper::GeneralSiteSettings("style_bg_image")) . ")";
    }
}
?>

<body class="js {!!  $bdy_class !!}" style=" {!!  $bdy_bg_color !!} {!! $bdy_bg_image !!}">
<div id="wrapper">
    <!-- start header -->
    @include('frontEnd.includes.header')
            <!-- end header -->

    <!-- Content Section -->
    @yield('content')
            <!-- end of Content Section -->

    <!-- start footer -->
    @include('frontEnd.includes.footer')
            <!-- end footer -->
</div>
@include('frontEnd.includes.foot')
@yield('footerInclude')

@if(Helper::GeneralSiteSettings("style_preload"))
    <div id="preloader"></div>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(window).load(function () {
                $('#preloader').fadeOut('slow', function () {
                    // $(this).remove();
                });
            });
        });
    </script>
@endif
</body>
</html>