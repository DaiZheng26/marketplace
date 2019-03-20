@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ trans('backLang.sectionsOf') }}  {!! trans('backLang.'.$WebmasterSection->name) !!}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a>{!! trans('backLang.'.$WebmasterSection->name) !!}</a> /
                    <a>{{ trans('backLang.sectionsOf') }}  {!! trans('backLang.'.$WebmasterSection->name) !!}</a>
                </small>
            </div>
            @if($Sections->total() > 0)
                @if(@Auth::user()->permissionsGroup->add_status)
                    <div class="row p-a">
                        <div class="col-sm-12">
                            <a class="btn btn-fw primary" href="{{route("sectionsCreate",$WebmasterSection->id)}}">
                                <i class="material-icons">&#xe02e;</i>
                                &nbsp; {{ trans('backLang.sectionNew') }}</a>
                        </div>
                    </div>
                @endif
            @endif
            @if($Sections->total() == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center ">
                            {{ trans('backLang.noData') }}
                            <br>
                            <br>
                            @if(@Auth::user()->permissionsGroup->add_status)
                                <a class="btn btn-fw primary" href="{{route("sectionsCreate",$WebmasterSection->id)}}">
                                    <i class="material-icons">&#xe02e;</i>
                                    &nbsp; {{ trans('backLang.sectionNew') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if($Sections->total() > 0)
                {{Form::open(['route'=>['sectionsUpdateAll',$WebmasterSection->id],'method'=>'post'])}}
                <div class="table-responsive">
                    <table class="table table-striped  b-t">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>{{ trans('backLang.sectionName') }}</th>
                            <th class="text-center" style="width:100px;">{{ trans('backLang.contents') }}</th>
                            <th class="text-center" style="width:100px;">{{ trans('backLang.visits') }}</th>
                            <th class="text-center" style="width:50px;">{{ trans('backLang.status') }}</th>
                            <th class="text-center" style="width:200px;">{{ trans('backLang.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $title_var = "title_" . trans('backLang.boxCode');
                        $title_var2 = "title_" . trans('backLang.boxCodeOther');
                        ?>
                        @foreach($Sections as $Section)
                            <?php
                            if ($Section->$title_var != "") {
                                $title = $Section->$title_var;
                            } else {
                                $title = $Section->$title_var2;
                            }
                            ?>
                            <tr>
                                <td><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $Section->id }}"><i
                                                class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$Section->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                                <td>
                                    @if($Section->photo !="")
                                        <div class="pull-right">
                                            <img src="{{ URL::to('uploads/sections/'.$Section->photo) }}"
                                                 style="height: 30px" alt="{{ $title }}">
                                        </div>
                                    @endif
                                    {!! Form::text('row_no_'.$Section->id,$Section->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                    @if($Section->icon !="")
                                        <i class="fa {!! $Section->icon !!} "></i>
                                    @endif
                                    {{ $title }}</td>
                                <td class="text-center">
                                    {!! count($Section->topics) !!}
                                </td>
                                <td class="text-center">
                                    {!! $Section->visits  !!}
                                </td>

                                <td class="text-center">
                                    <i class="fa {{ ($Section->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    @if(@Auth::user()->permissionsGroup->edit_status)
                                        <a class="btn btn-sm success"
                                           href="{{ route("sectionsEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$Section->id]) }}">
                                            <small><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.edit') }}
                                            </small>
                                        </a>
                                    @endif
                                        @if(@Auth::user()->permissionsGroup->delete_status)
                                        <button class="btn btn-sm warning" data-toggle="modal"
                                                data-target="#m-{{ $Section->id }}" ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small><i class="material-icons">&#xe872;</i> {{ trans('backLang.delete') }}
                                            </small>
                                        </button>
                                    @endif

                                </td>
                            </tr>
                            <!-- .modal -->
                            <div id="m-{{ $Section->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ trans('backLang.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {{ $title }} ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                            <a href="{{ route("sectionsDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Section->id]) }}"
                                               class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->


                            @foreach($Section->fatherSections as $subSection)
                                <?php
                                if ($subSection->$title_var != "") {
                                    $title = $subSection->$title_var;
                                } else {
                                    $title = $subSection->$title_var2;
                                }
                                ?>
                                <tr>
                                    <td><label class="ui-check m-a-0">
                                            <input type="checkbox" name="ids[]" value="{{ $subSection->id }}"><i
                                                    class="dark-white"></i>
                                            {!! Form::hidden('row_ids[]',$subSection->id, array('class' => 'form-control row_no')) !!}
                                        </label>
                                    </td>
                                    <td>
                                        @if($subSection->photo !="")
                                            <div class="pull-right">
                                                <img src="{{ URL::to('uploads/sections/'.$subSection->photo) }}"
                                                     style="height: 30px" alt="{{ $title }}">
                                            </div>
                                        @endif
                                        <img src="{{ URL::to('backEnd/assets/images/treepart_'.trans('backLang.direction').'.png') }}"
                                             class="submenu_tree">
                                        {!! Form::text('row_no_'.$subSection->id,$subSection->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                        @if($subSection->icon !="")
                                            <i class="fa {!! $subSection->icon !!} "></i>
                                        @endif
                                        {!! $title   !!}</td>
                                    <td class="text-center">
                                        {!! $subSection->visits  !!}
                                    </td>
                                    <td class="text-center">
                                        {!! $subSection->visits !!}
                                    </td>
                                    <td class="text-center">
                                        <i class="fa {{ ($subSection->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>
                                    <td class="text-center">
                                        @if(@Auth::user()->permissionsGroup->edit_status)
                                            <a class="btn btn-sm success"
                                               href="{{ route("sectionsEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$subSection->id]) }}">
                                                <small><i class="material-icons">
                                                        &#xe3c9;</i> {{ trans('backLang.edit') }}
                                                </small>
                                            </a>
                                        @endif
                                            @if(@Auth::user()->permissionsGroup->delete_status)
                                            <button class="btn btn-sm warning" data-toggle="modal"
                                                    data-target="#m-{{ $subSection->id }}" ui-toggle-class="bounce"
                                                    ui-target="#animate">
                                                <small><i class="material-icons">
                                                        &#xe872;</i> {{ trans('backLang.delete') }}
                                                </small>
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                                <!-- .modal -->
                                <div id="m-{{ $subSection->id }}" class="modal fade" data-backdrop="true">
                                    <div class="modal-dialog" id="animate">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <p>
                                                    {{ trans('backLang.confirmationDeleteMsg') }}
                                                    <br>
                                                    <strong>[ {{ $title }} ]</strong>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white p-x-md"
                                                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                                <a href="{{ route("sectionsDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$subSection->id]) }}"
                                                   class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div>
                                </div>
                                <!-- / .modal -->
                            @endforeach
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <footer class="dker p-a">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs">
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
                                            <button type="submit"
                                                    class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->

                            @if(@Auth::user()->permissionsGroup->edit_status)
                                <select name="action" id="action" class="input-sm form-control w-sm inline v-middle"
                                        required>
                                    <option value="">{{ trans('backLang.bulkAction') }}</option>
                                    <option value="order">{{ trans('backLang.saveOrder') }}</option>
                                    <option value="activate">{{ trans('backLang.activeSelected') }}</option>
                                    <option value="block">{{ trans('backLang.blockSelected') }}</option>
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <option value="delete">{{ trans('backLang.deleteSelected') }}</option>
                                    @endif
                                </select>
                                <button type="submit" id="submit_all"
                                        class="btn btn-sm white">{{ trans('backLang.apply') }}</button>
                                <button id="submit_show_msg" class="btn btn-sm white" data-toggle="modal"
                                        style="display: none"
                                        data-target="#m-all" ui-toggle-class="bounce"
                                        ui-target="#animate">{{ trans('backLang.apply') }}
                                </button>
                            @endif
                        </div>

                        <div class="col-sm-3 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">{{ trans('backLang.showing') }} {{ $Sections->firstItem() }}
                                -{{ $Sections->lastItem() }} {{ trans('backLang.of') }}
                                <strong>{{ $Sections->total()  }}</strong> {{ trans('backLang.records') }}</small>
                        </div>
                        <div class="col-sm-6 text-right text-center-xs">
                            {!! $Sections->links() !!}
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
