@extends('backEnd.layout')

@section('content')

    @if($EStatus=="edit")
        <div id="mmn-edit" class="modal fade"
             data-backdrop="true">
            <div class="modal-dialog" id="animate">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title"><i class="material-icons">&#xe3c9;</i> {{ trans('backLang.edit') }}
                        </h5>
                    </div>
                    {{Form::open(['route'=>['calendarUpdate',$EditEvent->id],'method'=>'POST', 'files' => true])}}
                    <div class="modal-body p-lg">
                        <div class="p-a">
                            <div class="form-group row">
                                <label for="type"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.eventType') !!}</label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label class="ui-check ui-check-md" id="etype0l">
                                            {!! Form::radio('type','0',($EditEvent->type ==0) ? true : false, array('id' => 'type0','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <strong>{!!  trans('backLang.eventNote') !!}</strong>
                                        </label>
                                        &nbsp;
                                        <label class="ui-check ui-check-md text-success" id="etype1l">
                                            {!! Form::radio('type','1',($EditEvent->type ==1) ? true : false, array('id' => 'type1','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <strong>{!!  trans('backLang.eventMeeting') !!}</strong>
                                        </label>
                                        &nbsp;
                                        <label class="ui-check ui-check-md text-danger" id="etype2l">
                                            {!! Form::radio('type','2',($EditEvent->type ==2) ? true : false, array('id' => 'type2','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <strong>{!!  trans('backLang.eventEvent') !!}</strong>
                                        </label>
                                        &nbsp;
                                        <label class="ui-check ui-check-md text-info" id="etype3l">
                                            {!! Form::radio('type','3',($EditEvent->type ==3) ? true : false, array('id' => 'type3','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <strong>{!!  trans('backLang.eventTask') !!}</strong>
                                        </label>

                                    </div>
                                </div>
                            </div>

                            <div id="e_date"
                                 class="form-group row  {!! ($EditEvent->type !=0) ? "displayNone":"" !!}">
                                <label for="title"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.topicDate') !!}
                                </label>
                                <div class="col-sm-9">
                                    <div>
                                        <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                            {!! Form::text('date',date('Y-m-d', strtotime($EditEvent->start_date)), array('placeholder' => '','class' => 'form-control','id'=>'date')) !!}
                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="e_date_at"
                                 class="form-group row {!! ($EditEvent->type !=1) ? "displayNone":"" !!}">
                                <label for="date_at"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.eventAt') !!}
                                </label>
                                <div class="col-sm-9">
                                    <div>
                                        <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD hh:mm A',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                            {!! Form::text('date_at',date("Y-m-d H:i A", strtotime($EditEvent->start_date)), array('placeholder' => '','class' => 'form-control','id'=>'date_at')) !!}
                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="e_from_to_time" {!! ($EditEvent->type !=2) ? "class='displayNone'":"" !!}>

                                <div class="form-group row">
                                    <label for="time_start"
                                           class="col-sm-3 form-control-label">{!!  trans('backLang.eventStart') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD hh:mm A',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('time_start',date("Y-m-d H:i A", strtotime($EditEvent->start_date)), array('placeholder' => '','class' => 'form-control','id'=>'time_start')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="time_end"
                                           class="col-sm-3 form-control-label">{!!  trans('backLang.eventEnd') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD hh:mm A',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('time_end',date("Y-m-d H:i A", strtotime($EditEvent->end_date)), array('placeholder' => '','class' => 'form-control','id'=>'time_end')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="e_from_to_date" {!! ($EditEvent->type !=3) ? "class='displayNone'":"" !!}>

                                <div class="form-group row">
                                    <label for="date_start"
                                           class="col-sm-3 form-control-label">{!!  trans('backLang.eventStart2') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('date_start',date("Y-m-d", strtotime($EditEvent->start_date)), array('placeholder' => '','class' => 'form-control','id'=>'date_start')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date_end"
                                           class="col-sm-3 form-control-label">{!!  trans('backLang.eventEnd2') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('date_end',date("Y-m-d", strtotime($EditEvent->end_date)), array('placeholder' => '','class' => 'form-control','id'=>'date_end')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.eventTitle') !!}
                                </label>
                                <div class="col-sm-9">
                                    {!! Form::text('title',$EditEvent->title, array('placeholder' => '','class' => 'form-control','id'=>'title','required'=>'')) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="details"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.eventDetails') !!}
                                </label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('details',$EditEvent->details, array('placeholder' => '','class' => 'form-control','id'=>'details','rows'=>'3')) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-sm warning pull-left" data-toggle="modal"
                                data-target="#m-delete" ui-toggle-class="bounce"
                                ui-target="#animate" data-dismiss="modal">
                            <small><i class="material-icons">&#xe872;</i> {{ trans('backLang.eventDelete') }}
                            </small>
                        </button>

                        <button type="button"
                                class="btn dark-white p-x-md"
                                data-dismiss="modal">{{ trans('backLang.cancel') }}</button>
                        <button type="submit"
                                class="btn btn-primary p-x-md">{{ trans('backLang.save') }}</button>
                    </div>
                    {{Form::close()}}
                </div><!-- /.modal-content -->
            </div>
        </div>

        <!-- Delete modal -->
        <div id="m-delete" class="modal fade" data-backdrop="true">
            <div class="modal-dialog" id="animate">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                    </div>
                    <div class="modal-body text-center p-lg">
                        <p>
                            {{ trans('backLang.confirmationDeleteMsg') }}
                            <br>
                            <strong>[ {{ $EditEvent->title }} ]</strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark-white p-x-md"
                                data-dismiss="modal" data-toggle="modal"
                                data-target="#mmn-edit" ui-toggle-class="bounce"
                                ui-target="#animate">{{ trans('backLang.no') }}</button>
                        <a href="{{ route("calendarDestroy",["id"=>$EditEvent->id]) }}"
                           class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
        <!-- / .modal -->
        @endif


                <!-- Clear ALL modal -->
        <div id="m-deleteAll" class="modal fade" data-backdrop="true">
            <div class="modal-dialog" id="animate">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('backLang.confirmation') }}</h5>
                    </div>
                    <div class="modal-body text-center p-lg">
                        <p>
                            {{ trans('backLang.eventClear') }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark-white p-x-md"
                                data-dismiss="modal" data-toggle="modal"
                                data-target="#mmn-edit" ui-toggle-class="bounce"
                                ui-target="#animate">{{ trans('backLang.no') }}</button>
                        <a href="{{ route("calendarUpdateAll") }}"
                           class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
        <!-- / .modal -->

        <div id="mmn-new" class="modal fade"
             data-backdrop="true">
            <div class="modal-dialog" id="animate">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="material-icons">&#xe02e;</i> {{ trans('backLang.newEvent') }}
                        </h5>
                    </div>
                    {{Form::open(['route'=>['calendarStore'],'method'=>'POST'])}}
                    <div class="modal-body p-lg">
                        <div class="p-a">
                            <div class="form-group row">
                                <label for="type"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.eventType') !!}</label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label class="ui-check ui-check-md" id="type0l">
                                            {!! Form::radio('type','0',true, array('id' => 'type0','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <strong>{!!  trans('backLang.eventNote') !!}</strong>
                                        </label>
                                        &nbsp;
                                        <label class="ui-check ui-check-md text-success" id="type1l">
                                            {!! Form::radio('type','1',false, array('id' => 'type1','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <strong>{!!  trans('backLang.eventMeeting') !!}</strong>
                                        </label>
                                        &nbsp;
                                        <label class="ui-check ui-check-md text-danger" id="type2l">
                                            {!! Form::radio('type','2',false, array('id' => 'type2','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <strong>{!!  trans('backLang.eventEvent') !!}</strong>
                                        </label>
                                        &nbsp;
                                        <label class="ui-check ui-check-md text-info" id="type3l">
                                            {!! Form::radio('type','3',false, array('id' => 'type3','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <strong>{!!  trans('backLang.eventTask') !!}</strong>
                                        </label>

                                    </div>
                                </div>
                            </div>


                            <div id="date" class="form-group row">
                                <label for="title"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.topicDate') !!}
                                </label>
                                <div class="col-sm-9">
                                    <div>
                                        <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                            {!! Form::text('date',date("Y-m-d"), array('placeholder' => '','class' => 'form-control','id'=>'date')) !!}
                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="date_at" class="form-group row displayNone">
                                <label for="date_at"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.eventAt') !!}
                                </label>
                                <div class="col-sm-9">
                                    <div>
                                        <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD hh:mm A',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                            {!! Form::text('date_at',date("Y-m-d H:i A"), array('placeholder' => '','class' => 'form-control','id'=>'date_at')) !!}
                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="from_to_time" class="displayNone">

                                <div class="form-group row">
                                    <label for="time_start"
                                           class="col-sm-3 form-control-label">{!!  trans('backLang.eventStart') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD hh:mm A',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('time_start',date("Y-m-d H:i A"), array('placeholder' => '','class' => 'form-control','id'=>'time_start')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="time_end"
                                           class="col-sm-3 form-control-label">{!!  trans('backLang.eventEnd') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD hh:mm A',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('time_end',date("Y-m-d H:i A"), array('placeholder' => '','class' => 'form-control','id'=>'time_end')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="from_to_date" class="displayNone">

                                <div class="form-group row">
                                    <label for="date_start"
                                           class="col-sm-3 form-control-label">{!!  trans('backLang.eventStart2') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('date_start',date("Y-m-d"), array('placeholder' => '','class' => 'form-control','id'=>'date_start')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date_end"
                                           class="col-sm-3 form-control-label">{!!  trans('backLang.eventEnd2') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'YYYY-MM-DD',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('date_end',date("Y-m-d"), array('placeholder' => '','class' => 'form-control','id'=>'date_end')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.eventTitle') !!}
                                </label>
                                <div class="col-sm-9">
                                    {!! Form::text('title','', array('placeholder' => '','class' => 'form-control','id'=>'title','required'=>'')) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="details"
                                       class="col-sm-3 form-control-label">{!!  trans('backLang.eventDetails') !!}
                                </label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('details','', array('placeholder' => '','class' => 'form-control','id'=>'details','rows'=>'3')) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn dark-white p-x-md"
                                data-dismiss="modal">{{ trans('backLang.cancel') }}</button>
                        <button type="submit"
                                class="btn btn-primary p-x-md">{{ trans('backLang.add') }}</button>
                    </div>
                    {{Form::close()}}
                </div><!-- /.modal-content -->
            </div>
        </div>

        <div class="padding">
            <div class="row m-b">
                <div class="col-sm-4 m-b-sm">
                    <button type="button" class="btn btn-sm primary" id="btnNew" data-toggle="modal"
                            data-target="#mmn-new"
                            ui-toggle-class="bounce"
                            ui-target="#animate"><i class="material-icons">
                            &#xe02e;</i> {{ trans('backLang.newEvent') }}</button>
                    <button type="button" id="btnEdit" data-toggle="modal" class="displayNone"
                            data-target="#mmn-edit"
                            ui-toggle-class="bounce"
                            ui-target="#animate">{{ trans('backLang.edit') }}</button>

                </div>
                <div class="col-sm-8 text-sm-right">
                    <div class="btn-group m-l-xs">
                        <button class="btn btn-sm white" id="todayview">{{ trans('backLang.eventToday') }}</button>
                        <button class="btn btn-sm white" id="dayview">{{ trans('backLang.eventDay') }}</button>
                        <button class="btn btn-sm white" id="weekview">{{ trans('backLang.eventWeek') }}</button>
                        <button class="btn btn-sm white" id="monthview">{{ trans('backLang.eventMonth') }}</button>
                    </div>
                </div>
            </div>
            <div class="fullcalendar" ui-jp="fullCalendar" ui-options="{
        header: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        defaultDate: '{{ $DefaultDate }}',
        editable: true,
        eventLimit: false,
        events: [
        @foreach($Events as $Event)
            @if($Event->type ==3)
                    {
                  id: {!! $Event->id !!},
                  title: '{!! $Event->title !!}',
                  url: '{{ route("calendarEdit",["id"=>$Event->id]) }}',
                  start: '{{ date('Y-m-d', strtotime($Event->start_date)) }}',
                  end: '{{ date('Y-m-d', strtotime($Event->end_date)) }}',
                  className: ['info']
                },
        @elseif($Event->type ==2)
                    {
                  id: {!! $Event->id !!},
                  title: '{!! $Event->title !!}',
                  url: '{{ route("calendarEdit",["id"=>$Event->id]) }}',
                  start: '{{ date('Y-m-d H:i:s', strtotime($Event->start_date)) }}',
                  end: '{{ date('Y-m-d H:i:s', strtotime($Event->end_date)) }}',
                  className: ['danger']
                },
        @elseif($Event->type ==1)
                    {
                  id: {!! $Event->id !!},
                  title: '{!! $Event->title !!}',
                  url: '{{ route("calendarEdit",["id"=>$Event->id]) }}',
                  start: '{{ date('Y-m-d H:i:s', strtotime($Event->start_date)) }}',
                  className: ['green']
                },
        @else
                    {
                  id: {!! $Event->id !!},
                  title: '{!! $Event->title !!}',
                  url: '{{ route("calendarEdit",["id"=>$Event->id]) }}',
                  start: '{{ date('Y-m-d', strtotime($Event->start_date)) }}',
                  className: ['white']
                },
        @endif

            @endforeach
                    ],

            eventResize: function(event, delta, revertFunc) {
                if (!confirm('is this okay?')) {
                revertFunc();
                }else{
                    $(document).ready(function(){
                        $.ajax({
                        url: '{{ URL::to(env('BACKEND_PATH')."/calendar/") }}/' + event.id + '/extend',
                        type: 'post',
                        data: {'started_on': event.start.format(),'ended_on':event.end.format(),'_token':'{{ csrf_token() }}'},
                        success: function(data){

                            }
                        });
                    });
                }
            },
            eventDrop: function( event, delta, revertFunc, jsEvent, ui, view ) {
                if (!confirm('is this okay?')) {
                revertFunc();
                }else{
                     $(document).ready(function(){
                        $.ajax({
                        url: '{{ URL::to(env('BACKEND_PATH')."/calendar/") }}/' + event.id + '/extend',
                        type: 'post',
                        data: {'started_on': event.start.format(),'_token':'{{ csrf_token() }}'},
                        success: function(data){

                            }
                        });
                    });
                }
            }

        }">
            </div>
            <br>
            <small class="pull-right">{{ trans('backLang.eventTotal') }} : ( {{ count($Events) }} )</small>

            <small><a data-dismiss="modal" data-toggle="modal"
                      data-target="#m-deleteAll" ui-toggle-class="bounce"
                      ui-target="#animate">{{ trans('backLang.eventClear') }}</a></small>
        </div>

@endsection
@section('footerInclude')
    <script type="text/javascript">
        $("#type0l").click(function () {
            $('#date').show();
            $('#date_at').hide();
            $('#from_to_time').hide();
            $('#from_to_date').hide();
        });
        $("#type1l").click(function () {
            $('#date').hide();
            $('#date_at').show();
            $('#from_to_time').hide();
            $('#from_to_date').hide();
        });
        $("#type2l").click(function () {
            $('#date').hide();
            $('#date_at').hide();
            $('#from_to_time').show();
            $('#from_to_date').hide();
        });
        $("#type3l").click(function () {
            $('#date').hide();
            $('#date_at').hide();
            $('#from_to_time').hide();
            $('#from_to_date').show();
        });
        @if($EStatus=="edit")
            $("#btnEdit").click();
        @endif

             @if($EStatus=="new")
                $("#btnNew").click();
        @endif
    $("#etype0l").click(function () {
            $('#e_date').show();
            $('#e_date_at').hide();
            $('#e_from_to_time').hide();
            $('#e_from_to_date').hide();
        });
        $("#etype1l").click(function () {
            $('#e_date').hide();
            $('#e_date_at').show();
            $('#e_from_to_time').hide();
            $('#e_from_to_date').hide();
        });
        $("#etype2l").click(function () {
            $('#e_date').hide();
            $('#e_date_at').hide();
            $('#e_from_to_time').show();
            $('#e_from_to_date').hide();
        });
        $("#etype3l").click(function () {
            $('#e_date').hide();
            $('#e_date_at').hide();
            $('#e_from_to_time').hide();
            $('#e_from_to_date').show();
        });
    </script>
@endsection
