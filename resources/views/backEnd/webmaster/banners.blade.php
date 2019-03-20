@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ trans('backLang.adsBannersSettings') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    {{ trans('backLang.webmasterTools') }} /
                    <a href="">{{ trans('backLang.adsBannersSettings') }}</a>
                </small>
            </div>
            <div class="row p-a">
                <div class="col-sm-12">
                    <a class="btn btn-fw primary" href="{{route("WebmasterBannersCreate")}}">
                        <i class="material-icons">&#xe02e;</i>
                        &nbsp; {{ trans('backLang.sectionNew') }}</a>
                </div>
            </div>
            @if($WebmasterBanners->total() == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center light ">
                            {{ trans('backLang.noData') }}
                        </div>
                    </div>
                </div>
            @endif

            @if($WebmasterBanners->total() > 0)
                {{Form::open(['route'=>'WebmasterBannersUpdateAll','method'=>'post'])}}
                <div class="table-responsive">
                    <table class="table table-striped  b-t">
                        <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>{{ trans('backLang.bannerTitle') }}</th>
                            <th>{{ trans('backLang.sectionType') }}</th>
                            <th>{{ trans('backLang.size') }}</th>
                            <th class="text-center" style="width:50px;">{{ trans('backLang.status') }}</th>
                            <th class="text-center" style="width:200px;">{{ trans('backLang.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($WebmasterBanners as $WebmasterBanner)
                            <tr>
                                <td><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $WebmasterBanner->id }}"><i
                                                class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$WebmasterBanner->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                                <td>
                                    {!! Form::text('row_no_'.$WebmasterBanner->id,$WebmasterBanner->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                    {!! trans('backLang.'.$WebmasterBanner->name)   !!}</td>
                                <td>{!! ($WebmasterBanner->type==2) ? "<span class='label red'><i class='material-icons'>&#xe63a;</i>  ".trans('backLang.sectionTypeVideo')."</span>":"" !!}
                                    {!! ($WebmasterBanner->type==1) ? "<span class='label green'><i class='material-icons'>&#xe251;</i>  ".trans('backLang.sectionTypePhoto')."</span>":"" !!}
                                    {!! ($WebmasterBanner->type==0) ? "<span class='label'><i class='material-icons'>&#xe86f;</i>  ".trans('backLang.sectionTypeCode')."</span>":"" !!}
                                </td>
                                <td>{{ $WebmasterBanner->width }}* {{ $WebmasterBanner->height }}</td>
                                <td class="text-center">
                                    <i class="fa {{ ($WebmasterBanner->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm success"
                                       href="{{ route("WebmasterBannersEdit",["id"=>$WebmasterBanner->id]) }}">
                                        <small><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.edit') }}
                                        </small>
                                    </a>

                                    <button class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#m-{{ $WebmasterBanner->id }}" ui-toggle-class="bounce"
                                            ui-target="#animate">
                                        <small><i class="material-icons">&#xe872;</i> {{ trans('backLang.delete') }}
                                        </small>
                                    </button>


                                </td>
                            </tr>
                            <!-- .modal -->
                            <div id="m-{{ $WebmasterBanner->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ trans('backLang.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {{ trans('backLang.'.$WebmasterBanner->name) }} ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                            <a href="{{ route("WebmasterBannersDestroy",["id"=>$WebmasterBanner->id]) }}"
                                               class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
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

                            <select name="action" id="action" class="input-sm form-control w-sm inline v-middle"
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
                            <small class="text-muted inline m-t-sm m-b-sm">{{ trans('backLang.showing') }} {{ $WebmasterBanners->firstItem() }}
                                -{{ $WebmasterBanners->lastItem() }} {{ trans('backLang.of') }}
                                <strong>{{ $WebmasterBanners->total()  }}</strong> {{ trans('backLang.records') }}
                            </small>
                        </div>
                        <div class="col-sm-6 text-right text-center-xs">
                            {!! $WebmasterBanners->links() !!}
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
