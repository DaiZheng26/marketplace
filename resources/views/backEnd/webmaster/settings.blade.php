@extends('backEnd.layout')

@section('content')
    <div class="padding">

        {{Form::open(['route'=>['webmasterSettingsUpdate'],'method'=>'POST'])}}

        <div class="col-md-6">
            <div class="form-group">
                <label><h5><i class="material-icons">&#xe8c0;</i> {{ trans('backLang.appsSettings') }}</h5></label>
                <hr>
            </div>

            <div class="checkbox">
                <label class="ui-check">
                    {!! Form::checkbox('analytics_status','1',$WebmasterSetting->analytics_status, array('id' => 'analytics_status')) !!}
                    <i class="dark-white"></i><label
                            for="analytics_status">{{ trans('backLang.visitorsAnalytics') }}</label>
                </label>
            </div>

            <div class="checkbox">
                <label class="ui-check">
                    {!! Form::checkbox('inbox_status','1',$WebmasterSetting->inbox_status, array('id' => 'inbox_status')) !!}
                    <i class="dark-white"></i><label for="inbox_status">{{ trans('backLang.siteInbox') }}</label>
                </label>
            </div>

            <div class="checkbox">
                <label class="ui-check">
                    {!! Form::checkbox('calendar_status','1',$WebmasterSetting->calendar_status, array('id' => 'calendar_status')) !!}
                    <i class="dark-white"></i><label for="calendar_status">{{ trans('backLang.calendar') }}</label>
                </label>
            </div>

            <div class="checkbox">
                <label class="ui-check">
                    {!! Form::checkbox('banners_status','1',$WebmasterSetting->banners_status, array('id' => 'banners_status')) !!}
                    <i class="dark-white"></i><label for="banners_status">{{ trans('backLang.adsBanners') }}</label>
                </label>
            </div>


            <div class="checkbox">
                <label class="ui-check">
                    {!! Form::checkbox('newsletter_status','1',$WebmasterSetting->newsletter_status, array('id' => 'newsletter_status')) !!}
                    <i class="dark-white"></i><label for="newsletter_status">{{ trans('backLang.newsletter') }}</label>
                </label>
            </div>

            <div class="checkbox">
                <label class="ui-check">
                    {!! Form::checkbox('settings_status','1',$WebmasterSetting->settings_status, array('id' => 'settings_status')) !!}
                    <i class="dark-white"></i><label
                            for="settings_status">{{ trans('backLang.generalSettings') }}</label>
                </label>
            </div>
            <br/>

        </div>
        <div class="col-md-6">

            <div class="form-group">
                <label><h5><i class="material-icons">&#xe8a4;</i> {{ trans('backLang.fieldsSettings') }}</h5></label>
                <hr>
            </div>
            <div class="form-group">
                <label>{{ trans('backLang.arabicLanguageFields') }} : </label>
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('ar_box_status','1',$WebmasterSetting->ar_box_status ? true : false , array('id' => 'ar_box_status1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.active') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('ar_box_status','0',$WebmasterSetting->ar_box_status ? false : true , array('id' => 'ar_box_status2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.notActive') }}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('backLang.englishLanguageFields') }} : </label>
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('en_box_status','1',$WebmasterSetting->en_box_status ? true : false , array('id' => 'en_box_status1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.active') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('en_box_status','0',$WebmasterSetting->en_box_status ? false : true , array('id' => 'en_box_status2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.notActive') }}
                    </label>
                </div>
            </div>

        </div>

        <div class="col-md-12">
        </div>
        <div class="col-md-6">

            <div class="form-group">
                <br/>
                <label><h5><i class="material-icons">&#xe52e;</i> {{ trans('backLang.seoTabTitle') }}</h5></label>
                <hr>
            </div>
            <div class="form-group">
                <label>{{ trans('backLang.seoTab') }} : </label>
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('seo_status','1',$WebmasterSetting->seo_status ? true : false , array('id' => 'seo_status1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.active') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('seo_status','0',$WebmasterSetting->seo_status ? false : true , array('id' => 'seo_status2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.notActive') }}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('backLang.friendlyURLinks') }} : </label>
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('links_status','0',$WebmasterSetting->links_status ? false : true , array('id' => 'links_status1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.friendlyURLinks1') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('links_status','1',$WebmasterSetting->links_status ? true : false , array('id' => 'links_status2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.friendlyURLinks2') }}
                    </label>
                </div>
            </div>
        </div>


        <div class="col-md-6">

            <div class="form-group">
                <br/>
                <label><h5><i class="material-icons">&#xe7fb;</i> {{ trans('backLang.registrationSettings') }}</h5>
                </label>
                <hr>
            </div>
            <div class="form-group">
                <label>{{ trans('backLang.allowRegister') }} : </label>
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('register_status','1',$WebmasterSetting->register_status ? true : false , array('id' => 'register_status1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.active') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('register_status','0',$WebmasterSetting->register_status ? false : true , array('id' => 'register_status2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ trans('backLang.notActive') }}
                    </label>
                </div>
            </div>
            <div class="form-group" id="permission_group_div"
                 style="display: {{ ($WebmasterSetting->register_status==1)?"block":"none" }}">
                <label>{{ trans('backLang.permissionForNewUsers') }} : </label>
                <select name="permission_group" id="permission_group" class="form-control c-select">
                    @foreach ($PermissionsGroups as $PermissionsGroup)
                        <?php
                        ?>
                        <option value="{{ $PermissionsGroup->id  }}" {{ ($PermissionsGroup->id == $WebmasterSetting->permission_group) ? "selected='selected'":""  }}>{!! $PermissionsGroup->name   !!}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">

            <div class="form-group">
                <br/>
                <label><h5><i class="material-icons">&#xe895;</i> {{ trans('backLang.frontSettings') }}</h5></label>
                <hr>
            </div>
        </div>
        <div class="col-md-4">

            <div class="form-group">
                <label>{{ trans('backLang.headerMenu') }} : </label>
                <select name="header_menu_id" id="header_menu_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    <?php
                    $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    ?>
                    @foreach ($ParentMenus as $ParentMenu)
                        <?php
                        if ($ParentMenu->$title_var != "") {
                            $title = $ParentMenu->$title_var;
                        } else {
                            $title = $ParentMenu->$title_var2;
                        }
                        ?>
                        <option value="{{ $ParentMenu->id  }}" {{ ($ParentMenu->id == $WebmasterSetting->header_menu_id) ? "selected='selected'":""  }}>{{ $title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('backLang.footerMenu') }} : </label>
                <select name="footer_menu_id" id="footer_menu_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    <?php
                    $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    ?>
                    @foreach ($ParentMenus as $ParentMenu)
                        <?php
                        if ($ParentMenu->$title_var != "") {
                            $title = $ParentMenu->$title_var;
                        } else {
                            $title = $ParentMenu->$title_var2;
                        }
                        ?>
                        <option value="{{ $ParentMenu->id  }}" {{ ($ParentMenu->id == $WebmasterSetting->footer_menu_id) ? "selected='selected'":""  }}>{{ $title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ trans('backLang.homeSlideBanners') }} : </label>
                <select name="home_banners_section_id" id="home_banners_section_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    @foreach ($WebmasterBanners as $WebmasterBanner)
                        <?php
                        ?>
                        <option value="{{ $WebmasterBanner->id  }}" {{ ($WebmasterBanner->id == $WebmasterSetting->home_banners_section_id) ? "selected='selected'":""  }}>{!! trans('backLang.'.$WebmasterBanner->name)   !!}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label>{{ trans('backLang.homeTextBanners') }} : </label>
                <select name="home_text_banners_section_id" id="home_text_banners_section_id"
                        class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    @foreach ($WebmasterBanners as $WebmasterBanner)
                        <?php
                        ?>
                        <option value="{{ $WebmasterBanner->id  }}" {{ ($WebmasterBanner->id == $WebmasterSetting->home_text_banners_section_id) ? "selected='selected'":""  }}>{!! trans('backLang.'.$WebmasterBanner->name)   !!}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ trans('backLang.sideBanners') }} : </label>
                <select name="side_banners_section_id" id="side_banners_section_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    @foreach ($WebmasterBanners as $WebmasterBanner)
                        <?php
                        ?>
                        <option value="{{ $WebmasterBanner->id  }}" {{ ($WebmasterBanner->id == $WebmasterSetting->side_banners_section_id) ? "selected='selected'":""  }}>{!! trans('backLang.'.$WebmasterBanner->name)   !!}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ trans('backLang.newsletterGroup') }} : </label>
                <select name="newsletter_contacts_group" id="newsletter_contacts_group" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    @foreach ($ContactsGroups as $ContactsGroup)
                        <?php
                        ?>
                        <option value="{{ $ContactsGroup->id  }}" {{ ($ContactsGroup->id == $WebmasterSetting->newsletter_contacts_group) ? "selected='selected'":""  }}>{!! $ContactsGroup->name   !!}</option>
                    @endforeach
                </select>
            </div>


        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans('backLang.homeRow1') }} : </label>
                <select name="home_content1_section_id" id="home_content1_section_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    @foreach ($GeneralWebmasterSections as $Webmaster_Section)
                        <?php
                        ?>
                        <option value="{{ $Webmaster_Section->id  }}" {{ ($Webmaster_Section->id == $WebmasterSetting->home_content1_section_id) ? "selected='selected'":""  }}>{!! str_replace("backLang.","",trans('backLang.'.$Webmaster_Section->name))   !!}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ trans('backLang.homeRow2') }} : </label>
                <select name="home_content2_section_id" id="home_content2_section_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    @foreach ($GeneralWebmasterSections as $Webmaster_Section)
                        <?php
                        ?>
                        <option value="{{ $Webmaster_Section->id  }}" {{ ($Webmaster_Section->id == $WebmasterSetting->home_content2_section_id) ? "selected='selected'":""  }}>{!! str_replace("backLang.","",trans('backLang.'.$Webmaster_Section->name))   !!}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ trans('backLang.homeRow_3') }} : </label>
                <select name="home_content3_section_id" id="home_content3_section_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    @foreach ($GeneralWebmasterSections as $Webmaster_Section)
                        <?php
                        ?>
                        <option value="{{ $Webmaster_Section->id  }}" {{ ($Webmaster_Section->id == $WebmasterSetting->home_content3_section_id) ? "selected='selected'":""  }}>{!! str_replace("backLang.","",trans('backLang.'.$Webmaster_Section->name))   !!}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ trans('backLang.homeRow3') }} : </label>
                <select name="latest_news_section_id" id="latest_news_section_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    @foreach ($GeneralWebmasterSections as $Webmaster_Section)
                        <?php
                        ?>
                        <option value="{{ $Webmaster_Section->id  }}" {{ ($Webmaster_Section->id == $WebmasterSetting->latest_news_section_id) ? "selected='selected'":""  }}>{!! str_replace("backLang.","",trans('backLang.'.$Webmaster_Section->name))  !!}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{ trans('backLang.contactPageId') }} : </label>
                <select name="contact_page_id" id="contact_page_id" class="form-control c-select">
                    <option value="0">- - {!!  trans('backLang.none') !!} - -</option>
                    <?php
                    $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    ?>
                    @foreach ($SitePages as $SitePage)
                        <?php
                        if ($SitePage->$title_var != "") {
                        $title = $SitePage->$title_var;
                        } else {
                        $title = $SitePage->$title_var2;
                        }
                        ?>
                        <option value="{{ $SitePage->id  }}" {{ ($SitePage->id == $WebmasterSetting->contact_page_id) ? "selected='selected'":""  }}>{{ $title }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans('backLang.commentsStatus') }} : </label>
                <div class="radio">
                    <div>
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('new_comments_status','1',$WebmasterSetting->new_comments_status ? true : false , array('id' => 'new_comments_status1','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ trans('backLang.automaticPublish') }}
                        </label>
                    </div>
                    <div style="margin-top: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('new_comments_status','0',$WebmasterSetting->new_comments_status ? false : true , array('id' => 'new_comments_status2','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ trans('backLang.manualByAdmin') }}
                        </label>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="form-group">
                <label>{{ trans('backLang.activeLanguages') }} : </label>
                <div class="radio">
                    <div>
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('languages_count','2',($WebmasterSetting->languages_count == 2)? true : false , array('id' => 'languages_count2','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ trans('backLang.activeLanguages2') }}
                        </label>
                    </div>
                    <div style="margin-top: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('languages_count','1',($WebmasterSetting->languages_count == 1) ? true : false , array('id' => 'languages_count1','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ trans('backLang.activeLanguages1') }}
                        </label>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="form-group">
                <label>{{ trans('backLang.APIStatus') }} : </label>
                <div class="radio">
                    <div>
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('api_status','0',$WebmasterSetting->api_status ? false : true , array('id' => 'api_status2','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ trans('backLang.notActive') }}
                        </label>
                    </div>
                    <div style="margin-top: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('api_status','1',$WebmasterSetting->api_status ? true : false , array('id' => 'api_status1','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ trans('backLang.active') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group" id="api_key_div" style="display: {{ ($WebmasterSetting->api_status==1)?"block":"none" }}">
                <label>{!!  trans('backLang.APIKey') !!} : </label>
                {!! Form::text('api_key',$WebmasterSetting->api_key, array('id' => 'api_key','readonly'=>'','class' => 'form-control')) !!}
                <a href="javascript:void(0)" onclick="generate_key()" ><small>{!!  trans('backLang.APIKeyGenerate') !!}</small></a>
            </div>

        </div>
        <div class="col-md-12">
            <hr>
            <button type="submit" class="btn btn-info m-t">{{ trans('backLang.update') }}</button>
        </div>
        {{Form::close()}}
        <div class="row">
            <br>
        </div>
    </div>


    <script type="text/javascript">
        $("input:radio[name=register_status]").click(function () {
            if ($(this).val() == 1) {
                $("#permission_group_div").css("display", "block");
            } else {
                $("#permission_group_div").css("display", "none");
            }
        });
        $("input:radio[name=api_status]").click(function () {
            if ($(this).val() == 1) {
                $("#api_key_div").css("display", "block");
            } else {
                $("#api_key_div").css("display", "none");
            }
        });
        function generate_key() {
            if (! confirm('{!!  trans('backLang.APIKeyConfirm') !!}')) { return false; }else {
                $("#api_key").val(Math.floor(Math.random() * 1000000000000000));
            }
        }
    </script>
@endsection
@section('footerInclude')
    <script type="text/javascript">
        $("input:radio[name=register_status]").click(function () {
            if ($(this).val() == 1) {
                $("#permission_group_div").css("display", "block");
            } else {
                $("#permission_group_div").css("display", "none");
            }
        });
        $("input:radio[name=api_status]").click(function () {
            if ($(this).val() == 1) {
                $("#api_key_div").css("display", "block");
            } else {
                $("#api_key_div").css("display", "none");
            }
        });
        function generate_key() {
            if (! confirm('{!!  trans('backLang.APIKeyConfirm') !!}')) { return false; }else {
                $("#api_key").val(Math.floor(Math.random() * 1000000000000000));
            }
        }
    </script>
@endsection
