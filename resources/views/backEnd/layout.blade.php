<!DOCTYPE html>
<html  lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    @include('backEnd.includes.head')
    @yield('headerInclude')
</head>
<body>

<div class="app" id="app">

    <!-- ############ LAYOUT START-->

    <!-- aside -->
    @include('backEnd.includes.menu')
            <!-- / aside -->

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
        @include('backEnd.includes.header')
        @include('backEnd.includes.footer')
        <div ui-view class="app-body" id="view">

            <!-- ############ PAGE START-->
                @include('backEnd.includes.errors')
                @yield('content')
            <!-- ############ PAGE END-->

        </div>
    </div>
    <!-- / -->

    <!-- theme switcher -->
    @include('backEnd.includes.settings')
            <!-- / -->

    <!-- ############ LAYOUT END-->

</div>


@include('backEnd.includes.foot')
@yield('footerInclude')

</body>
</html>
