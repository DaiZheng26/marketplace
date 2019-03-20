@extends('backEnd.layout')

@section('content')
    <div class="padding">
        <div class="app-body-inner">
            <div class="row-col row-col-xs">
                <!-- column -->
                <div class="col-sm-2 col-md-2 w w-auto-sm b-r">
                    <div class="row-col">
                        <div class="row-row">
                            <div class=" hover">
                                <div class="row-inner"><br>
                                    <div class="nav nav-pills nav-stacked m-t-sm">
                                        <div class="row-row">
                                            <div class="col-sm-9 p-a-0">
                                                <br>
                                                <ul class="list">
                                                    <?php
                                                    if (Session::has('ContactToEdit')) {
                                                        $group_id = Session::get('ContactToEdit')->group_id;
                                                    }
                                                    ?>
                                                    <li class="marginBottom5"><a
                                                                href="{{ route('contacts') }}" {!!   ($group_id=="") ? " style='font-weight: bold;color:#0cc2aa'":""  !!}> {{ trans('backLang.allContacts') }}

                                                            <small>({{ $AllContactsCount }})</small>

                                                        </a>
                                                    </li>

                                                    @foreach($ContactsGroups as $ContactsGroup)
                                                        <li class="marginBottom5"
                                                            onmouseover="document.getElementById('grpRow{{ $ContactsGroup->id }}').style.display='block'"
                                                            onmouseout="document.getElementById('grpRow{{ $ContactsGroup->id }}').style.display='none'">
                                                            <a href="{{ route("contacts",["group_id"=>$ContactsGroup->id]) }}" {!!   ($ContactsGroup->id == $group_id) ? " style='font-weight: bold;color:#0cc2aa'":""  !!} > {!! $ContactsGroup->name !!}

                                                                <small>({{ count($ContactsGroup->contacts) }})</small>

                                                            </a>

                                                            <div id="grpRow{{ $ContactsGroup->id }}"
                                                                 class="pull-right displayNone">
                                                                <a class="btn btn-sm success p-a-0 m-a-0"
                                                                   title="{{ trans('backLang.edit') }}"
                                                                   href="{{ route("contactsEditGroup",["id"=>$ContactsGroup->id]) }}">
                                                                    <small>&nbsp;<i class="material-icons">&#xe3c9;</i>&nbsp;
                                                                    </small>
                                                                </a>
                                                                @if(@Auth::user()->permissionsGroup->delete_status)
                                                                    <button class="btn btn-sm warning p-a-0 m-a-0"
                                                                            data-toggle="modal"
                                                                            data-target="#mg-{{ $ContactsGroup->id }}"
                                                                            ui-toggle-class="bounce"
                                                                            title="{{ trans('backLang.delete') }}"
                                                                            ui-target="#animate">
                                                                        <small>&nbsp;<i class="material-icons">
                                                                                &#xe872;</i>&nbsp;
                                                                        </small>
                                                                    </button>

                                                                @endif
                                                            </div>
                                                            <!-- .modal -->
                                                            <div id="mg-{{ $ContactsGroup->id }}" class="modal fade"
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
                                                                                <strong>[ {{ $ContactsGroup->name }}
                                                                                    ]</strong>
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    class="btn dark-white p-x-md"
                                                                                    data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                                                            <a href="{{ route("contactsDestroyGroup",["id"=>$ContactsGroup->id]) }}"
                                                                               class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div>
                                                            </div>
                                                            <!-- / .modal -->
                                                        </li>
                                                    @endforeach


                                                    <li class="marginBottom5"><a
                                                                {!!   ($group_id=="wait") ? " style='font-weight: bold;color:#0cc2aa'":""  !!}
                                                                href="{{ route("contacts",["group_id"=>"wait"]) }}"> {{ trans('backLang.waitActivation') }}

                                                            <small>({{ $WaitContactsCount }})</small>

                                                        </a></li>
                                                    <li>
                                                        <a {!!   ($group_id=="blocked") ? " style='font-weight: bold;color:#0cc2aa'":""  !!} href="{{ route("contacts",["group_id"=>"blocked"]) }}"> {{ trans('backLang.blockedContacts') }}

                                                            <small>( {{ $BlockedContactsCount }})</small>

                                                        </a></li>
                                                </ul>
                                                <div class="p-y">
                                                    @if(Session::has('EditContactsGroup'))
                                                        {{Form::open(['route'=>['contactsUpdateGroup',Session::get('EditContactsGroup')->id],'method'=>'POST'])}}
                                                        <div class="input-group input-group-sm">
                                                            {!! Form::text('name',Session::get('EditContactsGroup')->name, array('placeholder' => trans('backLang.newGroup'),'class' => 'form-control','id'=>'name','required'=>'')) !!}
                                                            <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit">{!! trans('backLang.save') !!}</button>
              </span>
                                                        </div>
                                                        {{Form::close()}}
                                                    @else
                                                        @if(@Auth::user()->permissionsGroup->add_status)
                                                            {{Form::open(['route'=>['contactsStoreGroup'],'method'=>'POST'])}}
                                                            <div class="input-group input-group-sm">
                                                                {!! Form::text('name','', array('placeholder' => trans('backLang.newGroup'),'class' => 'form-control','id'=>'name','required'=>'')) !!}
                                                                <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit">{!! trans('backLang.add') !!}</button>
              </span>
                                                            </div>
                                                        @endif
                                                        {{Form::close()}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('contacts') }}"
                                           class="btn btn-sm white btn-addon primary m-b-1"><i class="material-icons">
                                                &#xe02e;</i> {{ trans('backLang.newContacts') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>


                        </div>
                    </div>
                </div>
                <!-- /column -->
                @if($Contacts->total() > 0)
                        <!-- column -->
                <div class="col-sm-4 col-md-3 bg b-r">
                    <div class="row-col">
                        <div class="p-a-xs b-b">
                            {{Form::open(['route'=>['contactsSearch'],'method'=>'POST'])}}
                            <div class="input-group">
                                <button type="submit" style="padding-top: 10px;"
                                        class="input-group-addon no-border no-bg pull-left"><i class="fa fa-search"></i>
                                </button>
                                <input type="text" style="width: 85%" name="q" required value="{{ $search_word }}"
                                       class="form-control no-border no-bg"
                                       placeholder="{{ trans('backLang.searchAllContacts') }}">
                            </div>
                            {{Form::close()}}
                        </div>
                        <div class="row-row">
                            <div class="row-body scrollable hover">
                                <div class="row-inner">
                                    <div class="list inset">

                                        @foreach($Contacts as $Contact)

                                            <?php
                                            $active_cls = "";
                                            ?>
                                            @if(Session::has('ContactToEdit'))
                                                @if(Session::get('ContactToEdit')->id == $Contact->id)
                                                    <?php
                                                    $active_cls = "primary";
                                                    ?>
                                                @endif
                                            @endif

                                            <div class="list-item pointer {{$active_cls}}"
                                                 onclick="javascript: location.href='{{ route("contactsEdit",["id"=>$Contact->id]) }}'">
                                                <div class="list-left">
                    <span class="w-40 avatar">
                        <a href="{{ route("contactsEdit",["id"=>$Contact->id]) }}">
                            @if($Contact->photo!="")
                                <img src="{{ URL::to('uploads/contacts/'.$Contact->photo) }}" class="img-circle">
                            @else
                                <img src="{{ URL::to('uploads/contacts/profile.jpg') }}" class="img-circle"
                                     style="opacity: 0.5">
                            @endif
                        </a>
                    </span>
                                                </div>
                                                <div class="list-body">
                                                    <a href="{{ route("contactsEdit",["id"=>$Contact->id]) }}">
                                                        @if($Contact->first_name !="" || $Contact->last_name !="")
                                                            {{ $Contact->first_name }} {{ $Contact->last_name }}
                                                        @else
                                                            {{ substr($Contact->email,0, strpos($Contact->email, "@")) }}
                                                        @endif
                                                        <small class="block"><i
                                                                    class="fa fa-phone m-r-sm text-muted"></i>
                                                            <span dir="ltr">
                                                                @if($Contact->phone !="")
                                                                    {{ $Contact->phone }}
                                                                @else
                                                                    {{ substr($Contact->email, strpos($Contact->email, "@")) }}
                                                                @endif
                                                            </span>
                                                        </small>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($Contacts->total() > env('BACKEND_PAGINATION'))
                            <div class="p-a b-t text-center">
                                {!! $Contacts->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /column -->
                @endif

                @if(Session::has('ContactToEdit'))
                        <!-- column -->
                <div class="col-sm-6 col-md-7">
                    <div class="row-col">
                        <div class="p-a-sm">
                            <div>
                                <a class="btn btn-sm white"><i class="material-icons">
                                        &#xe3c9;</i> {{ trans('backLang.editContacts') }}</a>

                            </div>
                        </div>
                        <div class="row-row">
                            <div class="row-body">
                                <div class="row-inner">
                                    <div class="padding">
                                        @if(Session::has('doneMessage2'))
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        {{ Session::get('doneMessage2') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{Form::open(['route'=>['contactsUpdate',Session::get('ContactToEdit')->id],'method'=>'POST', 'files' => true])}}
                                        <div class="row-col h-auto m-b-1">
                                            <div class="col-sm-3">
                                                <div class="avatar w-64 inline">
                                                    @if(Session::get('ContactToEdit')->photo !="")
                                                        <img id="photo_preview"
                                                             src="{{ URL::to('uploads/contacts/'.Session::get('ContactToEdit')->photo) }}">
                                                    @else
                                                        <img id="photo_preview"
                                                             src="{{ URL::to('uploads/contacts/profile.jpg') }}"
                                                             style="opacity: 0.2">
                                                    @endif
                                                </div>
                                                <div class="form-file">
                                                    <input id="photo_file" type="file" name="file" accept="image/*">
                                                    <button class="btn white btn-sm">
                                                        <small>
                                                            <small>{{ trans('backLang.selectFile') }} ..</small>
                                                        </small>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 v-m h2 _300">
                                                <div class="p-l-xs">
                                                    {!! Form::text('first_name',Session::get('ContactToEdit')->first_name, array('placeholder' =>trans('backLang.firstName'),'class' => 'form-control w-sm inline','id'=>'first_name','required'=>'')) !!}
                                                    {!! Form::text('last_name',Session::get('ContactToEdit')->last_name, array('placeholder' =>trans('backLang.lastName'),'class' => 'form-control w-sm inline','id'=>'last_name','required'=>'')) !!}
                                                    @if(count($ContactsGroups) >0)
                                                        <select name="group_id" id="country_id"
                                                                class="form-control c-select w-sm inline"
                                                                style="margin-top: 6px;">
                                                            <option value="">- - {!!  trans('backLang.group') !!} - -
                                                            </option>

                                                            @foreach ($ContactsGroups as $Group)
                                                                <option value="{{ $Group->id  }}" {{ ($Group->id == Session::get('ContactToEdit')->group_id) ? "selected='selected'":""  }}>{{ $Group->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fields -->
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.contactPhone') }}</label>
                                                <div class="col-sm-6">
                                                    {!! Form::text('phone',Session::get('ContactToEdit')->phone, array('placeholder' =>'','class' => 'form-control','id'=>'phone')) !!}
                                                </div>
                                                @if(Session::get('ContactToEdit')->phone !="")
                                                    <div class="col-sm-3">
                                                        <a href="tel:{{Session::get('ContactToEdit')->phone}}"
                                                           class="btn white pull-right" style="width: 100%">
                                                            <small>
                                                                <i class="material-icons">
                                                                    &#xe0b1;</i> {{ trans('backLang.callNow') }}
                                                            </small>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.contactEmail') }}</label>
                                                <div class="col-sm-6">
                                                    {!! Form::email('email',Session::get('ContactToEdit')->email, array('placeholder' =>'','class' => 'form-control','id'=>'email','required'=>'')) !!}
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="{{ route("webmails",["group_id"=>"create","stat"=>"email","wid"=>'new',"contact_email"=>Session::get('ContactToEdit')->email]) }}"
                                                       style="width: 100%" class="btn white pull-right">
                                                        <small>
                                                            <i class="material-icons">
                                                                &#xe151;</i> {{ trans('backLang.sendEmail') }}
                                                        </small>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.companyName') }}</label>
                                                <div class="col-sm-9">
                                                    {!! Form::text('company',Session::get('ContactToEdit')->company, array('placeholder' =>'','class' => 'form-control','id'=>'company')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{!!  trans('backLang.country') !!}</label>
                                                <div class="col-sm-6">
                                                    <select name="country_id" id="country_id"
                                                            class="form-control c-select">
                                                        <option value="">- - {!!  trans('backLang.country') !!} - -
                                                        </option>
                                                        <?php
                                                        $title_var = "title_" . trans('backLang.boxCode');
                                                        $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                                        ?>
                                                        @foreach ($Countries as $country)
                                                            <?php
                                                            if ($country->$title_var != "") {
                                                                $title = $country->$title_var;
                                                            } else {
                                                                $title = $country->$title_var2;
                                                            }
                                                            ?>
                                                            <option value="{{ $country->id  }}" {{ ($country->id == Session::get('ContactToEdit')->country_id) ? "selected='selected'":""  }}>{{ $title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    {!! Form::text('city',Session::get('ContactToEdit')->city, array('placeholder' =>trans('backLang.city'),'class' => 'form-control','id'=>'city')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.notes') }}</label>
                                                <div class="col-sm-9">
                                                    {!! Form::textarea('notes',Session::get('ContactToEdit')->notes, array('placeholder' => '','class' => 'form-control','rows'=>'3')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.status') }}</label>
                                                <div class="col-sm-9">
                                                    <div class="radio">
                                                        <label class="ui-check ui-check-md">
                                                            {!! Form::radio('status','1',(Session::get('ContactToEdit')->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                                            <i class="dark-white"></i>
                                                            {{ trans('backLang.active') }}
                                                        </label>

                                                        &nbsp; &nbsp;
                                                        <label class="ui-check ui-check-md">
                                                            {!! Form::radio('status','2',(Session::get('ContactToEdit')->status==2) ? true : false, array('id' => 'status3','class'=>'has-value')) !!}
                                                            <i class="dark-white"></i>
                                                            {{ trans('backLang.waitActivation') }}
                                                        </label>
                                                        &nbsp; &nbsp;
                                                        <label class="ui-check ui-check-md">
                                                            {!! Form::radio('status','0',(Session::get('ContactToEdit')->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                                            <i class="dark-white"></i>
                                                            {{ trans('backLang.notActive') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                                        <button class="btn warning pull-right" data-toggle="modal"
                                                                data-target="#mc-{{ Session::get('ContactToEdit')->id }}"
                                                                ui-toggle-class="bounce"
                                                                ui-target="#animate">
                                                            <small><i class="material-icons">
                                                                    &#xe872;</i> {{ trans('backLang.deleteContacts') }}
                                                            </small>
                                                        </button>
                                                        @endif
                                                                <!-- .modal -->
                                                        <div id="mc-{{ Session::get('ContactToEdit')->id }}"
                                                             class="modal fade"
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
                                                                            <strong>[ {{ Session::get('ContactToEdit')->first_name }}  {{ Session::get('ContactToEdit')->last_name }}
                                                                                ]</strong>
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn dark-white p-x-md"
                                                                                data-dismiss="modal">{{ trans('backLang.no') }}</button>
                                                                        <a href="{{ route("contactsDestroy",["id"=>Session::get('ContactToEdit')->id]) }}"
                                                                           class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                        <!-- / .modal -->

                                                        <button type="submit" class="btn btn-primary"><i
                                                                    class="material-icons">
                                                                &#xe31b;</i> {!! trans('backLang.save') !!}</button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- / fields -->
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /column -->

                @else

                        <!-- column -->
                <div class="col-sm-6 col-md-7">
                    <div class="row-col">
                        <div class="p-a-sm">
                            <div>
                                <a class="btn btn-sm white"><i class="material-icons">
                                        &#xe02e;</i> {{ trans('backLang.newContacts') }}</a>
                            </div>
                        </div>
                        <div class="row-row">
                            <div class="row-body">
                                <div class="row-inner">
                                    <div class="padding">
                                        {{Form::open(['route'=>['contactsStore'],'method'=>'POST', 'files' => true ])}}
                                        <div class="row-col h-auto m-b-1">
                                            <div class="col-sm-3">
                                                <div class="avatar w-64 inline">
                                                    <img id="photo_preview"
                                                         src="{{ URL::to('uploads/contacts/profile.jpg') }}"
                                                         style="opacity: 0.2">
                                                </div>
                                                <div class="form-file">
                                                    <input id="photo_file" type="file" name="file" accept="image/*">
                                                    <button class="btn white btn-sm">
                                                        <small>
                                                            <small>{{ trans('backLang.selectFile') }} ..</small>
                                                        </small>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 v-m h2 _300">
                                                <div class="p-l-xs">
                                                    {!! Form::text('first_name','', array('placeholder' =>trans('backLang.firstName'),'class' => 'form-control w-sm inline','id'=>'first_name','required'=>'')) !!}
                                                    {!! Form::text('last_name','', array('placeholder' =>trans('backLang.lastName'),'class' => 'form-control w-sm inline','id'=>'last_name','required'=>'')) !!}

                                                    @if(count($ContactsGroups) >0)
                                                        <select name="group_id" id="country_id"
                                                                class="form-control c-select w-sm inline"
                                                                style="margin-top: 6px;">
                                                            <option value="">- - {!!  trans('backLang.group') !!} - -
                                                            </option>
                                                            @foreach ($ContactsGroups as $Group)
                                                                <option value="{{ $Group->id  }}" {{ ($Group->id == $group_id) ? "selected='selected'":""  }}>{{ $Group->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fields -->
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.contactPhone') }}</label>
                                                <div class="col-sm-9">
                                                    {!! Form::text('phone','', array('placeholder' =>'','class' => 'form-control','id'=>'phone')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.contactEmail') }}</label>
                                                <div class="col-sm-9">
                                                    {!! Form::email('email','', array('placeholder' =>'','class' => 'form-control','id'=>'email','required'=>'')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.companyName') }}</label>
                                                <div class="col-sm-9">
                                                    {!! Form::text('company','', array('placeholder' =>'','class' => 'form-control','id'=>'company')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{!!  trans('backLang.country') !!}</label>
                                                <div class="col-sm-9">
                                                    <select name="country_id" id="country_id"
                                                            class="form-control c-select">
                                                        <option value="">- - {!!  trans('backLang.country') !!} - -
                                                        </option>
                                                        <?php
                                                        $title_var = "title_" . trans('backLang.boxCode');
                                                        $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                                        ?>
                                                        @foreach ($Countries as $country)
                                                            <?php
                                                            if ($country->$title_var != "") {
                                                                $title = $country->$title_var;
                                                            } else {
                                                                $title = $country->$title_var2;
                                                            }
                                                            ?>
                                                            <option value="{{ $country->id  }}">{{ $title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.city') }}</label>
                                                <div class="col-sm-9">
                                                    {!! Form::text('city','', array('placeholder' =>'','class' => 'form-control','id'=>'city')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label">{{ trans('backLang.notes') }}</label>
                                                <div class="col-sm-9">
                                                    {!! Form::textarea('notes','', array('placeholder' => '','class' => 'form-control','rows'=>'3')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary"><i
                                                                class="material-icons">
                                                            &#xe31b;</i> {!! trans('backLang.add') !!}</button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- / fields -->
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /column -->
                @endif

            </div>
        </div>
    </div>
    <style>
        .app-footer {
            display: none;
        }
    </style>
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#photo_file").change(function () {
            readURL(this);
            $('#photo_preview').css("opacity", 1);
        });
    </script>
@endsection
@section('footerInclude')
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#photo_file").change(function () {
            readURL(this);
            $('#photo_preview').css("opacity", 1);
        });
    </script>
@endsection
