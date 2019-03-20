@extends('backEnd.layout')

@section('content')

        <!-- .modal -->
<div id="m-all" class="modal fade" data-backdrop="true">
    <div class="modal-dialog" id="animate">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <p>
                    {{ trans('backLang.confirmationDeleteMsg') }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark-white p-x-md"
                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                <button type="button" onclick="document.getElementById('menusUpdateAll').submit()"
                        class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- / .modal -->

@foreach($ParentMenus as $ParentMenu)
        <!-- .modal -->
<div id="mg-{{ $ParentMenu->id }}" class="modal fade"
     data-backdrop="true">
    <div class="modal-dialog" id="animate">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <p>
                    {{ trans('backLang.confirmationDeleteMsg') }}
                    <br>
                    <strong>[ {{ $ParentMenu->title_ar }}
                        ]</strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn dark-white p-x-md"
                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                <a href="{{ route("parentMenusDestroy",["id"=>$ParentMenu->id]) }}"
                   class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- / .modal -->
@endforeach

<?php
try {
    $edt_id = $EditedMenu->id;
} catch (Exception $e) {
    $edt_id = 0;
}
$edt_title = "";
?>
<div class="row-col">
    <div class="col-sm ww-md w-auto-xs light lt bg-auto  hidden-print">
        <div class="padding pos-rlt">
            <div>
                <div class="nav-active-white">
                    <ul class="nav nav-pills nav-stacked nav-sm b-b">
                        <li class="nav-item">
                            <ul class="list p-b-1" style="list-style: none;">
                                <?php
                                $title_var = "title_" . trans('backLang.boxCode');
                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                ?>
                                @foreach($ParentMenus as $ParentMenu)
                                    <?php
                                    if ($ParentMenu->$title_var != "") {
                                        $title = $ParentMenu->$title_var;
                                    } else {
                                        $title = $ParentMenu->$title_var2;
                                    }
                                    ?>
                                    <?php
                                    if ($ParentMenu->id == $edt_id) {
                                        $edt_title = $title;
                                    }
                                    ?>
                                    <li style="margin-bottom: 5px"
                                        onmouseover="document.getElementById('grpRow{{ $ParentMenu->id }}').style.display='block'"
                                        onmouseout="document.getElementById('grpRow{{ $ParentMenu->id }}').style.display='none'">
                                        <a href="{{ route("menus",["ParentMenuId"=>$ParentMenu->id]) }}"
                                                {!!   ($ParentMenu->id == $edt_id) ? " style='font-weight: bold;color:#0cc2aa'":""  !!} >
                                            {!! $title !!}
                                        </a>

                                        <div id="grpRow{{ $ParentMenu->id }}"
                                             style="display: none"
                                             class="pull-right">
                                            <a class="btn btn-sm success p-a-0 m-a-0"
                                               title="{{ trans('backLang.edit') }}"
                                               href="{{ route("parentMenusEdit",["id"=>$ParentMenu->id]) }}">
                                                <small>&nbsp;<i class="material-icons">&#xe3c9;</i>&nbsp;
                                                </small>
                                            </a>

                                            <button class="btn btn-sm warning p-a-0 m-a-0"
                                                    data-toggle="modal"
                                                    data-target="#mg-{{ $ParentMenu->id }}"
                                                    ui-toggle-class="bounce"
                                                    title="{{ trans('backLang.delete') }}"
                                                    ui-target="#animate">
                                                <small>&nbsp;<i class="material-icons">&#xe872;</i>&nbsp;
                                                </small>
                                            </button>


                                        </div>

                                    </li>

                                @endforeach

                            </ul>
                        </li>
                    </ul>
                    <div class="p-y">
                        @if(Session::has('EditMenu'))
                            {{Form::open(['route'=>['parentMenusUpdate',"id"=>$EditedMenu->id,"ParentMenuId"=>"0"],'method'=>'POST'])}}
                            <div class="input-group input-group-sm">
                                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            {!! Form::text('title_ar',$EditedMenu->title_ar, array('placeholder' => trans('backLang.menuTitle').strip_tags(trans('backLang.arabicBox')),'class' => 'form-control','id'=>'title_ar','required'=>'')) !!}
                                        </div>
                                    </div>
                                @endif
                                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            {!! Form::text('title_en',$EditedMenu->title_en, array('placeholder' => trans('backLang.menuTitle').strip_tags(trans('backLang.englishBox')),'class' => 'form-control','id'=>'title_en','required'=>'')) !!}
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                    <span class="input-group-btn">
                <button class="btn btn-fw primary" type="submit">{!! trans('backLang.save') !!}</button>
              </span>
                                    </div>
                                </div>
                            </div>
                            {{Form::close()}}
                        @else
                            {{Form::open(['route'=>['parentMenusStore',$edt_id],'method'=>'POST'])}}
                            <div class="input-group input-group-sm">
                                {!! trans('backLang.newMenu') !!} :
                                @if(Helper::GeneralWebmasterSettings("ar_box_status"))
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            {!! Form::text('title_ar','', array('placeholder' => trans('backLang.menuTitle').strip_tags(trans('backLang.arabicBox')),'class' => 'form-control','id'=>'title_ar','required'=>'')) !!}
                                        </div>
                                    </div>
                                @endif
                                @if(Helper::GeneralWebmasterSettings("en_box_status"))
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            {!! Form::text('title_en','', array('placeholder' => trans('backLang.menuTitle').strip_tags(trans('backLang.englishBox')),'class' => 'form-control','id'=>'title_en','required'=>'')) !!}
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                    <span class="input-group-btn">
                <button class="btn btn-sm primary" type="submit">{!! trans('backLang.add') !!}</button>
              </span>
                                    </div>
                                </div>
                            </div>
                            {{Form::close()}}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm">
        <div ui-view class="padding">
            <div>
                <div class="box">
                    <div class="box-header dker">
                        <h3>{{ $edt_title }}</h3>
                        <small>
                            <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                            <a href="">{{ trans('backLang.settings') }}</a> /
                            <a href="">{{ trans('backLang.siteMenus') }}</a>

                        </small>
                    </div>
                    @if($Menus->total() >0)
                        <div class="row p-a">
                            <div class="col-sm-12">
                                <a class="btn btn-fw primary" href="{{route("menusCreate",$edt_id)}}">
                                    <i class="material-icons">&#xe02e;</i>
                                    &nbsp; {{ trans('backLang.newLink') }}
                                </a>
                            </div>
                        </div>
                    @endif
                    @if($Menus->total() == 0)
                        <div class="row p-a">
                            <div class="col-sm-12">
                                <div class=" p-a text-center ">
                                    {{ trans('backLang.noData') }}
                                    <br>
                                    @if(count($ParentMenus)>0)
                                        <br>
                                        <a class="btn btn-fw primary" href="{{route("menusCreate",$edt_id)}}">
                                            <i class="material-icons">&#xe02e;</i>
                                            &nbsp; {{ trans('backLang.newLink') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($Menus->total() > 0)
                        {{Form::open(['route'=>'menusUpdateAll','id'=>'menusUpdateAll','method'=>'post'])}}
                        {!! Form::hidden('ParentMenuId',$edt_id) !!}
                        <div class="table-responsive">
                            <table class="table table-striped  b-t">
                                <thead>
                                <tr>
                                    <th style="width:20px;">
                                        <label class="ui-check m-a-0">
                                            <input id="checkAll" type="checkbox"><i></i>
                                        </label>
                                    </th>
                                    <th>{{ trans('backLang.fullName') }}</th>
                                    <th class="text-center" style="width:50px;">{{ trans('backLang.status') }}</th>
                                    <th class="text-center"
                                        style="width:100px;">{{ trans('backLang.options') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $title_var = "title_" . trans('backLang.boxCode');
                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                ?>
                                @foreach($Menus as $Menu)
                                    <?php
                                    if ($Menu->$title_var != "") {
                                        $title = $Menu->$title_var;
                                    } else {
                                        $title = $Menu->$title_var2;
                                    }
                                    ?>
                                    <tr>
                                        <td><label class="ui-check m-a-0">
                                                <input type="checkbox" name="ids[]" value="{{ $Menu->id }}"><i
                                                        class="dark-white"></i>
                                                {!! Form::hidden('row_ids[]',$Menu->id, array('class' => 'form-control row_no')) !!}
                                            </label>
                                        </td>
                                        <td>
                                            {!! Form::text('row_no_'.$Menu->id,$Menu->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                            {!! $title  !!}</td>
                                        <td class="text-center">
                                            <i class="fa {{ ($Menu->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm success"
                                               href="{{ route("menusEdit",["ParentMenuId"=>$edt_id,"id"=>$Menu->id]) }}">
                                                <small><i class="material-icons">
                                                        &#xe3c9;</i> {{ trans('backLang.edit') }}
                                                </small>
                                            </a>

                                        </td>
                                    </tr>
                                    @foreach($Menu->subMenus as $subMenu)
                                        <?php
                                        if ($subMenu->$title_var != "") {
                                            $title = $subMenu->$title_var;
                                        } else {
                                            $title = $subMenu->$title_var2;
                                        }
                                        ?>
                                        <tr>
                                            <td><label class="ui-check m-a-0">
                                                    <input type="checkbox" name="ids[]" value="{{ $subMenu->id }}"><i
                                                            class="dark-white"></i>
                                                    {!! Form::hidden('row_ids[]',$subMenu->id, array('class' => 'form-control row_no')) !!}
                                                </label>
                                            </td>
                                            <td>
                                                <img src="{{ URL::to('backEnd/assets/images/treepart_'.trans('backLang.direction').'.png') }}" class="submenu_tree">
                                                {!! Form::text('row_no_'.$subMenu->id,$subMenu->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                                {!! $title  !!}</td>
                                            <td class="text-center">
                                                <i class="fa {{ ($subMenu->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-sm success"
                                                   href="{{ route("menusEdit",["ParentMenuId"=>$edt_id,"id"=>$subMenu->id]) }}">
                                                    <small><i class="material-icons">
                                                            &#xe3c9;</i> {{ trans('backLang.edit') }}
                                                    </small>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach

                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <footer class="dker p-a">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs">

                                    <select name="action" id="action"
                                            class="input-sm form-control w-sm inline v-middle"
                                            required>
                                        <option value="">{{ trans('backLang.bulkAction') }}</option>
                                        <option value="order">{{ trans('backLang.saveOrder') }}</option>
                                        <option value="activate">{{ trans('backLang.activeSelected') }}</option>
                                        <option value="block">{{ trans('backLang.blockSelected') }}</option>
                                        <option value="delete">{{ trans('backLang.deleteSelected') }}</option>
                                    </select>
                                    <button type="submit" id="submit_all"
                                            class="btn btn-sm white">{{ trans('backLang.apply') }}</button>
                                    <button id="submit_show_msg" class="btn btn-sm white" data-toggle="modal"
                                            style="display: none"
                                            data-target="#m-all" ui-toggle-class="bounce"
                                            ui-target="#animate">{{ trans('backLang.apply') }}
                                    </button>
                                </div>

                                <div class="col-sm-3 text-center">
                                    <small class="text-muted inline m-t-sm m-b-sm">{{ trans('backLang.showing') }} {{ $Menus->firstItem() }}
                                        -{{ $Menus->lastItem() }} {{ trans('backLang.of') }}
                                        <strong>{{ $Menus->total()  }}</strong> {{ trans('backLang.records') }}
                                    </small>
                                </div>
                                <div class="col-sm-6 text-right text-center-xs">
                                    {!! $Menus->links() !!}
                                </div>
                            </div>
                        </footer>
                        {{Form::close()}}

                        <script type="text/javascript">
                            $("#checkAll").click(function () {
                                $('input:checkbox').not(this).prop('checked', this.checked);
                            });
                            $("#action").change(function () {
                                if (this.value == "delete") {
                                    $("#submit_all").css("display", "none");
                                    $("#submit_show_msg").css("display", "inline-block");
                                } else {
                                    $("#submit_all").css("display", "inline-block");
                                    $("#submit_show_msg").css("display", "none");
                                }
                            });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footerInclude')
    <script type="text/javascript">
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });
    </script>
@endsection
