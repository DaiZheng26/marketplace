<?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
?>

<div id="aside" class="app-aside modal fade folded md nav-expand">
    <div class="left navside dark dk" layout="column">
        <div class="navbar navbar-md no-radius">
            <!-- brand -->
            <a class="navbar-brand" href="{{ route('adminHome') }}">
                <img src="{{ URL::to('backEnd/assets/images/logo.png') }}" alt="Control">
                <span class="hidden-folded inline">{{ trans('backLang.control') }}</span>
            </a>
            <!-- / brand -->
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-active-primary">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ trans('backLang.main') }}</small>
                    </li>

                    <li>
                        <a href="{{ route('adminHome') }}" onclick="location.href='{{ route('adminHome') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe3fc;</i>
                  </span>
                            <span class="nav-text">{{ trans('backLang.dashboard') }}</span>
                        </a>
                    </li>


                    @if(Helper::GeneralWebmasterSettings("analytics_status"))
                        @if(@Auth::user()->permissionsGroup->analytics_status)
                            <?php
                            $currentFolder = "analytics"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                            $currentFolder2 = "ip"; // Put folder name here
                            $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                            $currentFolder3 = "visitors"; // Put folder name here
                            $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder3));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder || $PathCurrentFolder2==$currentFolder2  || $PathCurrentFolder3==$currentFolder3) ? 'class=active' : '' }}>
                                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                                    <span class="nav-icon">
                    <i class="material-icons">&#xe1b8;</i>
                  </span>
                                    <span class="nav-text">{{ trans('backLang.visitorsAnalytics') }}</span>
                                </a>
                                <ul class="nav-sub">
                                    <li>
                                        <a onclick="location.href='{{ route('analytics', 'date') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsBydate') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/country"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'country') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByCountry') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/city"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'city') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByCity') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/os"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'os') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByOperatingSystem') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/browser"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'browser') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByBrowser') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/referrer"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'referrer') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByReachWay') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "analytics/hostname"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'hostname') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByHostName') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "analytics/org"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'org') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByOrganization') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "visitors"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('visitors') }}'">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsVisitorsHistory') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "ip"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('visitorsIP') }}">
                                            <span class="nav-text">{{ trans('backLang.visitorsAnalyticsIPInquiry') }}</span>
                                        </a>
                                    </li>


                                </ul>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("newsletter_status"))
                        @if(@Auth::user()->permissionsGroup->newsletter_status)
                            <?php
                            $currentFolder = "contacts"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('contacts') }}">
<span class="nav-icon">
<i class="material-icons">&#xe7ef;</i>
</span>
                                    <span class="nav-text">{{ trans('backLang.newsletter') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('webmails') }}">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe156;</i>
                  </span>
                                    <span class="nav-text">{{ trans('backLang.siteInbox') }}
                                        @if( Helper::webmailsNewCount() >0)
                                            <badge class="label warn m-l-xs">{{ Helper::webmailsNewCount() }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("calendar_status"))
                        @if(@Auth::user()->permissionsGroup->calendar_status)
                            <?php
                            $currentFolder = "calendar"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('calendar') }}" onclick="location.href='{{ route('calendar') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe5c3;</i>
                  </span>
                                    <span class="nav-text">{{ trans('backLang.calendar') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ trans('backLang.siteData') }}</small>
                    </li>

                    <?php
                    $data_sections_arr = explode(",", Auth::user()->permissionsGroup->data_sections);
                    ?>
                    @foreach($GeneralWebmasterSections as $GeneralWebmasterSection)
                        @if(in_array($GeneralWebmasterSection->id,$data_sections_arr))
                            <?php
                            $LiIcon = "&#xe2c8;";
                            if ($GeneralWebmasterSection->type == 3) {
                                $LiIcon = "&#xe050;";
                            }
                            if ($GeneralWebmasterSection->type == 2) {
                                $LiIcon = "&#xe63a;";
                            }
                            if ($GeneralWebmasterSection->type == 1) {
                                $LiIcon = "&#xe251;";
                            }
                            if ($GeneralWebmasterSection->type == 0) {
                                $LiIcon = "&#xe2c8;";
                            }
                            if ($GeneralWebmasterSection->name == "sitePages") {
                                $LiIcon = "&#xe3e8;";
                            }
                            if ($GeneralWebmasterSection->name == "articles") {
                                $LiIcon = "&#xe02f;";
                            }
                            if ($GeneralWebmasterSection->name == "services") {
                                $LiIcon = "&#xe540;";
                            }
                            if ($GeneralWebmasterSection->name == "news") {
                                $LiIcon = "&#xe307;";
                            }
                            if ($GeneralWebmasterSection->name == "products") {
                                $LiIcon = "&#xe8f6;";
                            }

                            // get 9 char after root url to check if is "webmaster"
                            $is_webmaster = substr($urlAfterRoot, 0, 9);
                            ?>
                            @if($GeneralWebmasterSection->sections_status > 0)
                                <li {{ ($GeneralWebmasterSection->id == @$WebmasterSection->id && $is_webmaster != "webmaster") ? 'class=active' : '' }}>
                                    <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                                        <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span class="nav-text">{!! str_replace("backLang.","",trans('backLang.'.$GeneralWebmasterSection->name)) !!}</span>
                                    </a>
                                    <ul class="nav-sub">
                                        @if($GeneralWebmasterSection->sections_status > 0)

                                            <?php
                                            $currentFolder = "sections"; // Put folder name here
                                            $PathCurrentFolder = substr($urlAfterRoot,
                                                (strlen($GeneralWebmasterSection->id) + 1), strlen($currentFolder));
                                            ?>
                                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >
                                                <a href="{{ route('sections',$GeneralWebmasterSection->id) }}">
                                                    <span class="nav-text">{{ trans('backLang.sectionsOf') }} {{ str_replace("backLang.","",trans('backLang.'.$GeneralWebmasterSection->name)) }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        <?php
                                        $currentFolder = "topics"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot,
                                            (strlen($GeneralWebmasterSection->id) + 1), strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >
                                            <a href="{{ route('topics',$GeneralWebmasterSection->id) }}">
                                                <span class="nav-text">{!! str_replace("backLang.","",trans('backLang.'.$GeneralWebmasterSection->name)) !!}</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                            @else
                                <li {{ ($GeneralWebmasterSection->id== @$WebmasterSection->id) ? 'class=active' : '' }}>
                                    <a href="{{ route('topics',$GeneralWebmasterSection->id) }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span class="nav-text">{!! str_replace("backLang.","",trans('backLang.'.$GeneralWebmasterSection->name)) !!}</span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach



                    @if(Helper::GeneralWebmasterSettings("banners_status"))
                        @if(@Auth::user()->permissionsGroup->banners_status)
                            <?php
                            $currentFolder = "banners"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >
                                <a href="{{ route('Banners') }}">
<span class="nav-icon">
<i class="material-icons">&#xe433;</i>
</span>
                                    <span class="nav-text">{{ trans('backLang.adsBanners') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("settings_status"))
                        @if(@Auth::user()->permissionsGroup->settings_status)
                            <li class="nav-header hidden-folded">
                                <small class="text-muted">{{ trans('backLang.settings') }}</small>
                            </li>

                            <?php
                            $currentFolder = "settings"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                            $currentFolder2 = "menus"; // Put folder name here
                            $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                            $currentFolder3 = "users"; // Put folder name here
                            $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder2));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder || $PathCurrentFolder2==$currentFolder2 || $PathCurrentFolder3==$currentFolder3 ) ? 'class=active' : '' }}>
                                <a>
<span class="nav-caret">
<i class="fa fa-caret-down"></i>
</span>
                                    <span class="nav-icon">
<i class="material-icons">&#xe8b8;</i>
</span>
                                    <span class="nav-text">{{ trans('backLang.generalSiteSettings') }}</span>
                                </a>
                                <ul class="nav-sub">
                                    <?php
                                    $currentFolder = "settings"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('settings') }}"
                                           onclick="location.href='{{ route('settings') }}'">
                                            <span class="nav-text">{{ trans('backLang.generalSettings') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "menus"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('menus') }}">
                                            <span class="nav-text">{{ trans('backLang.siteMenus') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "users"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('users') }}">
                                            <span class="nav-text">{{ trans('backLang.usersPermissions') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif


                    @if(@Auth::user()->permissionsGroup->webmaster_status)
                        <?php
                        $currentFolder = "webmaster"; // Put folder name here
                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                        ?>
                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                            <a>
<span class="nav-caret">
<i class="fa fa-caret-down"></i>
</span>
                                <span class="nav-icon">
<i class="material-icons">&#xe8be;</i>
</span>
                                <span class="nav-text">{{ trans('backLang.webmasterTools') }}</span>
                            </a>
                            <ul class="nav-sub">
                                <?php
                                $PathCurrentSubFolder = substr($urlAfterRoot, 0, (strlen($currentFolder) + 1));
                                ?>
                                <li {{ ($PathCurrentFolder==$PathCurrentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('webmasterSettings') }}">
                                        <span class="nav-text">{{ trans('backLang.generalSettings') }}</span>
                                    </a>
                                </li>
                                <?php
                                $currentSubFolder = "sections"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('WebmasterSections') }}">
                                        <span class="nav-text">{{ trans('backLang.siteSectionsSettings') }}</span>
                                    </a>
                                </li>
                                <?php
                                $currentSubFolder = "banners"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('WebmasterBanners') }}">
                                        <span class="nav-text">{{ trans('backLang.adsBannersSettings') }}</span>
                                    </a>
                                </li>

                                <?php
                                $currentSubFolder = "translations"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ url(env('BACKEND_PATH').'/webmaster/translations') }}">
                                        <span class="nav-text">{{ trans('backLang.translations') }}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    @endif
                </ul>
            </nav>
        </div>
        <div flex-no-shrink>
            <div>
                <nav ui-nav>
                    <ul class="nav">

                        <li>
                            <div class="b-b b m-t-sm"></div>
                        </li>
                        <li class="no-bg"><a href="{{ url('/logout') }}"
                                             onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="nav-icon"><i class="material-icons">&#xe8ac;</i></span>
                                <span class="nav-text">{{ trans('backLang.logout') }}</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>