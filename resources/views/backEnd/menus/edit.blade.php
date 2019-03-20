@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.editSection') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.settings') }}</a> /
                    <a href="">{{ trans('backLang.siteMenus') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route("menus",["ParentMenuId"=>$ParentMenuId])  }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['menusUpdate',$Menus->id],'method'=>'POST', 'files' => true])}}
                {!! Form::hidden('ParentMenuId',$ParentMenuId) !!}


                <div class="form-group row">
                    <label for="father_id"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.fatherSection') !!} </label>
                    <div class="col-sm-10">
                        <select name="father_id" id="father_id" class="form-control c-select">
                            <option value="{{$ParentMenuId}}">- - {!!  trans('backLang.sectionNoFather') !!} - -
                            </option>
                            <?php
                            $title_var = "title_" . trans('backLang.boxCode');
                            $title_var2 = "title_" . trans('backLang.boxCodeOther');
                            ?>
                            @foreach ($FatherMenus as $FatherMenu)
                                <?php
                                if ($FatherMenu->$title_var != "") {
                                    $title = $FatherMenu->$title_var;
                                } else {
                                    $title = $FatherMenu->$title_var2;
                                }
                                ?>
                                <option value="{{ $FatherMenu->id  }}" {{ ($FatherMenu->id == $Menus->father_id) ? "selected='selected'":""  }}>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                    <div class="form-group row">
                        <label for="title_ar"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionTitle') !!}
                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.arabicBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('title_ar',$Menus->title_ar, array('placeholder' => '','class' => 'form-control','id'=>'title_ar','required'=>'', 'dir'=>trans('backLang.rtl'))) !!}
                        </div>
                    </div>
                @endif
                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                    <div class="form-group row">
                        <label for="title_en"
                               class="col-sm-2 form-control-label">{!!  trans('backLang.sectionTitle') !!}

                            @if(Helper::GeneralWebmasterSettings("ar_box_status") && Helper::GeneralWebmasterSettings("en_box_status")){!!  trans('backLang.englishBox') !!}@endif
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('title_en',$Menus->title_en, array('placeholder' => '','class' => 'form-control','id'=>'title_en','required'=>'', 'dir'=>trans('backLang.ltr'))) !!}
                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.linkType') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','0',($Menus->type==0) ? true : false, array('id' => 'status1','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="none"')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.linkType1') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','1',($Menus->type==1) ? true : false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="block";document.getElementById("cat_div").style.display="none"')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.linkType2') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','2',($Menus->type==2) ? true : false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="block"')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.linkType3') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','3',($Menus->type==3) ? true : false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="block"')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.linkType4') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div id="link_div" class="form-group row" style="{{ ($Menus->type ==1)? "":"display: none" }}">
                    <label for="link"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.linkURL') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('link',$Menus->link, array('placeholder' => '','class' => 'form-control','id'=>'title_ar', 'dir'=>trans('backLang.ltr'))) !!}
                    </div>
                </div>
                <div id="cat_div" class="form-group row" style="{{ ($Menus->type <2)? "display: none":"" }}">
                    <label for="link"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.linkSection') !!}
                    </label>
                    <div class="col-sm-10">
                        <select name="cat_id" id="cat_id" class="form-control c-select">
                            <option value="{{$ParentMenuId}}">- - {!!  trans('backLang.linkSection') !!} - -
                            </option>

                            @foreach ($GeneralWebmasterSections as $WSection)
                                <option value="{{ $WSection->id  }}" {{ ($WSection->id == $Menus->cat_id) ? "selected='selected'":""  }}>{!!  str_replace("backLang.","",trans('backLang.'.$WSection->name)) !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-2 form-control-label">{!!  trans('backLang.status') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('status','1',($Menus->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.active') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('status','0',($Menus->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ trans('backLang.notActive') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! trans('backLang.update') !!}</button>
                        <a href="{{ route("menus",["ParentMenuId"=>$ParentMenuId])  }}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>



@endsection
