<meta charset="utf-8"/>
<title>{{ trans('backLang.control') }} | {{ Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode')) }}</title>
<meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- for ios 7 style, multi-resolution icon of 152x152 -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
<link rel="apple-touch-icon" href="{{ URL::to('public/backEnd/assets/images/logo.png') }}">
<meta name="apple-mobile-web-app-title" content="Flatkit">
<!-- for Chrome on Android, multi-resolution icon of 196x196 -->
<meta name="mobile-web-app-capable" content="yes">
<link rel="shortcut icon" sizes="196x196" href="{{ URL::to('public/backEnd/assets/images/logo.png') }}">

<!-- style -->
<link rel="stylesheet" href="{{ URL::to('public/backEnd/assets/animate.css/animate.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ URL::to('public/backEnd/assets/glyphicons/glyphicons.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ URL::to('public/backEnd/assets/font-awesome/css/font-awesome.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ URL::to('public/backEnd/assets/material-design-icons/material-design-icons.css') }}"
      type="text/css"/>

<link rel="stylesheet" href="{{ URL::to('public/backEnd/assets/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ URL::to('public/backEnd/assets/styles/app.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('public/backEnd/assets/styles/font.css') }}" type="text/css"/>

@if( trans('backLang.direction')=="rtl")
    <link rel="stylesheet" href="{{ URL::to('public/backEnd/assets/styles/rtl.css') }}">
@endif

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">