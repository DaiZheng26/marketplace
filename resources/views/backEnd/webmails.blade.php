@extends('backEnd.layout')

@section('content')

@foreach($WebmailsGroups as $WebmailsGroup)
        <!-- .modal -->
<div id="mg-{{ $WebmailsGroup->id }}" class="modal fade"
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
                    <strong>[ {{ $WebmailsGroup->name }}
                        ]</strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn dark-white p-x-md"
                        data-dismiss="modal">{{ trans('backLang.no') }}</button>
                <a href="{{ route("webmailsDestroyGroup",["id"=>$WebmailsGroup->id]) }}"
                   class="btn danger p-x-md">{{ trans('backLang.yes') }}</a>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- / .modal -->
@endforeach
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
                <button type="button"
                        onclick="document.getElementById('action').value='delete';document.getElementById('UpdateAll').submit()"
                        class="btn danger p-x-md">{{ trans('backLang.yes') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- / .modal -->

<?php
$connectEmailAddress = "";
$connectEmailPassword = "";
$connectDomainURL = "";
$nMsgCount = "";
if (Auth::user()->connect_email != "" && Auth::user()->connect_password) {
    try {
        $connectEmailAddress = Auth::user()->connect_email; // Full email address
        $connectEmailPassword = Auth::user()->connect_password;        // Email password
        $connectDomainURL = substr($connectEmailAddress, strpos($connectEmailAddress, "@") + 1);              // Your websites domain
        $useHTTPS = true;                       // Depending on how your cpanel is set up, you may be using a secure connection and you may not be. Change this from true to false as needed for your situation

        /* BEGIN MESSAGE COUNT CODE */

        $inbox = imap_open('{' . $connectDomainURL . ':143/notls}INBOX', $connectEmailAddress, $connectEmailPassword) or die('');
        $oResult = imap_search($inbox, 'UNSEEN');

        if (empty($oResult))
            $nMsgCount = 0;
        else
            $nMsgCount = count($oResult);

        imap_close($inbox);
    } catch (Exception $e) {

    }
}
?>

<div class="row-col">
    <div class="col-sm ww-md w-auto-xs light lt bg-auto  hidden-print">
        <div class="padding pos-rlt">
            <div>
                <button class="btn btn-sm white pull-right hidden-sm-up p-r-3" ui-toggle-class="show"
                        target="#inbox-menu"><i class="fa fa-bars"></i></button>
                <a href="{{ route("webmails",["group_id"=>"create"]) }}"
                   class="btn white"> <i class="fa fa-plus"></i>&nbsp; {!! trans('backLang.compose') !!}</a>
            </div>
            <div class="hidden-xs-down m-t" id="inbox-menu">
                <?php
                $cat_id = "3";
                if (Session::has('WebmailToEdit')) {
                    $group_id = Session::get('WebmailToEdit')->group_id;
                    $cat_id = Session::get('WebmailToEdit')->cat_id;
                }
                ?>
                <div class="nav-active-primary">
                    <div class="nav nav-pills nav-sm">
                        <a class="nav-link {{ (($group_id=="" || $cat_id ==0) && ( ($cat_id !=1  && $cat_id !=2) || (!Session::has('WebmailToEdit'))))? "active":"" }}"
                           href="{{ route("webmails") }}">
                            {!! trans('backLang.inbox') !!} {{ ($WaitWebmailsCount >0)? "($WaitWebmailsCount)":"" }}
                        </a>
                        <a class="nav-link {{ ($group_id=="sent" || $cat_id ==1)? "active":"" }}"
                           href="{{ route("webmails",["group_id"=>"sent"]) }}">
                            {!! trans('backLang.sent') !!}
                        </a>
                        <a class="nav-link {{ ($group_id=="draft" || $cat_id ==2)? "active":"" }}"
                           href="{{ route("webmails",["group_id"=>"draft"]) }}">
                            {!! trans('backLang.draft') !!} {{ ($DraftWebmailsCount >0)? "($DraftWebmailsCount)":"" }}
                        </a>

                    </div>
                </div>
                @if(count($WebmailsGroups)>0)
                    <div class="m-y">{!! trans('backLang.labels') !!} :</div>
                    <div class="nav-active-white">
                        <ul class="nav nav-pills nav-stacked nav-sm">
                            <li class="nav-item">
                                <ul class="list m-l-1" style="list-style: none;">
                                    @foreach($WebmailsGroups as $WebmailsGroup)
                                        <li style="margin-bottom: 5px"
                                            onmouseover="document.getElementById('grpRow{{ $WebmailsGroup->id }}').style.display='block'"
                                            onmouseout="document.getElementById('grpRow{{ $WebmailsGroup->id }}').style.display='none'">
                                            <a href="{{ route("webmails",["group_id"=>$WebmailsGroup->id]) }}"
                                                    {!!   ($WebmailsGroup->id == $group_id) ? " style='font-weight: bold;color:#0cc2aa'":""  !!} >
                                                <i class="fa m-r-sm fa-circle"
                                                   style="color: {{$WebmailsGroup->color}}"></i>
                                                {!! $WebmailsGroup->name !!}
                                                <small>({{ count($WebmailsGroup->webmails) }})</small>
                                            </a>

                                            <div id="grpRow{{ $WebmailsGroup->id }}"
                                                 style="display: none"
                                                 class="pull-right">
                                                <a class="btn btn-sm success p-a-0 m-a-0"
                                                   title="{{ trans('backLang.edit') }}"
                                                   href="{{ route("webmailsEditGroup",["id"=>$WebmailsGroup->id]) }}">
                                                    <small>&nbsp;<i class="material-icons">&#xe3c9;</i>&nbsp;
                                                    </small>
                                                </a>
                                                @if(@Auth::user()->permissionsGroup->delete_status)
                                                    <button class="btn btn-sm warning p-a-0 m-a-0"
                                                            data-toggle="modal"
                                                            data-target="#mg-{{ $WebmailsGroup->id }}"
                                                            ui-toggle-class="bounce"
                                                            title="{{ trans('backLang.delete') }}"
                                                            ui-target="#animate">
                                                        <small>&nbsp;<i class="material-icons">&#xe872;</i>&nbsp;
                                                        </small>
                                                    </button>
                                                @endif

                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endif
                <div class="p-y">
                    @if(Session::has('EditWebmailsGroup'))
                        {{Form::open(['route'=>['webmailsUpdateGroup',Session::get('EditWebmailsGroup')->id],'method'=>'POST'])}}
                        <div class="input-group input-group-sm">
                            {!! Form::text('name',Session::get('EditWebmailsGroup')->name, array('placeholder' => trans('backLang.newGroup'),'class' => 'form-control','id'=>'name','required'=>'')) !!}
                            <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit">{!! trans('backLang.save') !!}</button>
              </span>
                        </div>
                        {{Form::close()}}
                    @else
                        {{Form::open(['route'=>['webmailsStoreGroup'],'method'=>'POST'])}}
                        <div class="input-group input-group-sm">
                            {!! Form::text('name','', array('placeholder' => trans('backLang.newGroup'),'class' => 'form-control','id'=>'name','required'=>'')) !!}
                            <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit">{!! trans('backLang.add') !!}</button>
              </span>
                        </div>
                        {{Form::close()}}
                    @endif
                </div>
                <hr>
                @if( $connectEmailAddress !="" )
                    <a class="nav-link" target="_blank"
                       href="<?php echo 'http' . ($useHTTPS ? 's' : '') . '://' . $connectDomainURL . ':' . ($useHTTPS ? '2096' : '2095') . '/login/?user=' . $connectEmailAddress . '&pass=' . $connectEmailPassword . '&failurl=http://' . $connectDomainURL; ?>">
                        {!! trans('backLang.openWebmail') !!}
                        @if($nMsgCount >0 )
                            <span class="label warn m-l-xs">{{ $nMsgCount }}</span>
                        @endif
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div ui-view class="padding">
            @if($group_id!="create" && !Session::has('WebmailToEdit'))
                <a href="{{ route("webmails",["group_id"=>"create"]) }}"
                   class="md-btn md-fab md-fab-bottom-right pos-fix red">
                    <i class="material-icons i-24 text-white">&#xe150;</i>
                </a>
            @endif
            <div>
                @if(Session::has('doneMessage2'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ Session::get('doneMessage2') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if(Session::has('WebmailToEdit'))
                    @if($group_id=="draft" || $cat_id ==2)
                        <div>
                            <div class="box">
                                <div class="box-header dker">
                                    <h3><i class="material-icons">
                                            &#xe02e;</i> {{ trans('backLang.compose') }}
                                    </h3>
                                </div>
                                <div class="box-tool">
                                    <ul class="nav">
                                        <li class="nav-item inline">
                                            <a class="nav-link" href="{{ route('webmails') }}">
                                                <i class="material-icons md-18">×</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="box-body">
                                    {{Form::open(['route'=>['webmailsUpdate',"id"=>Session::get('WebmailToEdit')->id],'method'=>'POST', 'files' => true])}}
                                    <?php
                                    $siteTitle_var = "site_title_" . trans('backLang.boxCode');
                                    $siteTitle_var2 = "site_title_" . trans('backLang.boxCodeOther');
                                    if ($SiteSetting->$siteTitle_var != "") {
                                        $siteTitle = $SiteSetting->$siteTitle_var;
                                    } else {
                                        $siteTitle = $SiteSetting->$siteTitle_var2;
                                    }
                                    try {
                                        $from_email = Session::get('WebmailToEdit')->from_email;
                                        $msg_title = Session::get('WebmailToEdit')->title;
                                        $msg_details = Session::get('WebmailToEdit')->details;
                                        $to_cc = Session::get('WebmailToEdit')->to_cc;
                                        $to_bcc = Session::get('WebmailToEdit')->to_bcc;
                                    } catch (Exception $e) {
                                        $from_email = "";
                                        $msg_title = "";
                                        $msg_details = "";
                                        $to_cc = "";
                                        $to_bcc = "";
                                    }
                                    ?>
                                    {!! Form::hidden('contact_id','') !!}
                                    {!! Form::hidden('father_id','') !!}
                                    {!! Form::hidden('from_email',$SiteSetting->site_webmails) !!}
                                    {!! Form::hidden('from_name',$siteTitle) !!}
                                    {!! Form::hidden('from_phone','') !!}
                                    {!! Form::hidden('to_name','') !!}

                                    <div class="form-group row">
                                        <label for="title_en"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.sendTo') !!}
                                        </label>
                                        <div class="col-sm-9">
                                            {!! Form::email('to_email',$from_email, array('placeholder' => '','class' => 'form-control','id'=>'to_email','required'=>'')) !!}
                                        </div>
                                        <div class="col-sm-1">
                                            <small>
                                                <a onclick="document.getElementById('cc').style.display='block'">{!!  trans('backLang.sendCc') !!}</a><br>
                                                <a onclick="document.getElementById('bcc').style.display='block'">{!!  trans('backLang.sendBcc') !!}</a>
                                            </small>
                                        </div>
                                    </div>

                                    <?php
                                    $cc = "display: none";
                                    $bcc = "display: none";
                                    if ($to_cc !== "") {
                                        $cc = "";
                                        $bcc = "";
                                    }
                                    ?>
                                    <div id="cc" style="<?php echo $cc;?>" class="form-group row">
                                        <label for="title_en"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.sendCc') !!}
                                        </label>
                                        <div class="col-sm-9">
                                            {!! Form::email('to_cc',$to_cc, array('placeholder' => '','class' => 'form-control','id'=>'to_cc')) !!}
                                        </div>
                                        <div class="col-sm-1">
                                            <a onclick="document.getElementById('to_cc').value='';document.getElementById('cc').style.display='none'"><i
                                                        class="material-icons md-18">×</i></a>
                                        </div>
                                    </div>
                                    <div id="bcc" style="<?php echo $bcc;?>" class="form-group row">
                                        <label for="title_en"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.sendBcc') !!}
                                        </label>
                                        <div class="col-sm-9">
                                            {!! Form::email('to_bcc',$to_bcc, array('placeholder' => '','class' => 'form-control','id'=>'to_bcc')) !!}
                                        </div>
                                        <div class="col-sm-1">
                                            <a onclick="document.getElementById('to_bcc').value='';document.getElementById('bcc').style.display='none'"><i
                                                        class="material-icons md-18">×</i></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title_en"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.sendTitle') !!}
                                        </label>
                                        <div class="col-sm-10">
                                            {!! Form::text('title',$msg_title, array('placeholder' => '','class' => 'form-control','id'=>'title','required'=>'')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            {!! Form::textarea('details',$msg_details, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control','ui-options'=>'{height: 250}')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="attach_files"
                                               class="col-sm-2 form-control-label">{!!  trans('backLang.AttachFiles') !!}</label>
                                        <div class="col-sm-10">
                                            {!! Form::file('attach_files[]', array('class' => 'form-control','id'=>'attach_files','multiple'=>'')) !!}
                                        </div>
                                    </div>


                                    <div class="form-group row m-t-md">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            {!! Form::hidden('btn_clicked','', array('id'=>'btn_clicked')) !!}
                                            <button type="submit" name="btn_send" onclick="document.getElementById('btn_clicked').value=''"  class="btn btn-primary m-t"><i
                                                        class="material-icons">
                                                    &#xe31b;</i> {!! trans('backLang.send') !!}</button>
                                            <button type="submit" name="btn_draft" onclick="document.getElementById('btn_clicked').value='draft'" class="btn btn-default m-t"><i
                                                        class="material-icons">
                                                    &#xe161;</i> {!! trans('backLang.SaveToDraft') !!}</button>
                                            <a href="{{ route('webmails') }}"
                                               class="btn btn-default m-t"><i class="material-icons">
                                                    &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                        </div>
                                    </div>

                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="row hidden-print">
                            <div class="col-sm-12">
                                <div class="p-b-1 pull-right">
                                    <a href="{{ route("webmails",["group_id"=>"create","stat"=>"replay","wid"=>Session::get('WebmailToEdit')->id]) }}"
                                       class="btn btn-sm success p-r-1"><i
                                                class="fa fa-mail-reply"></i> {!! trans('backLang.replay') !!}</a>

                                    <a href="{{ route("webmails",["group_id"=>"create","stat"=>"forward","wid"=>Session::get('WebmailToEdit')->id]) }}"
                                       class="btn btn-sm btn-info p-r-1 "><i
                                                class="fa fa-mail-forward"></i> {!! trans('backLang.forward') !!}</a>

                                    <a class="btn btn-sm btn-default p-r-1"
                                       onClick="window.print();"><i
                                                class="fa fa-print"></i> {!! trans('backLang.print') !!}
                                    </a>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="box p-a dark" style="min-height: 110px">
                                    <strong class="text-muted">{!! trans('backLang.sendFrom') !!}:
                                        &nbsp; {!! Session::get('WebmailToEdit')->from_name !!}</strong>
                                    <p class="text-muted">
                                        @if(Session::get('WebmailToEdit')->from_phone !="")
                                            {!! trans('backLang.contactPhone') !!}:
                                            &nbsp; {!! Session::get('WebmailToEdit')->from_phone !!}<br>
                                        @endif
                                        @if(Session::get('WebmailToEdit')->from_email !="")
                                            {!! trans('backLang.contactEmail') !!}:
                                            &nbsp; {!! Session::get('WebmailToEdit')->from_email !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="box p-a" style="min-height: 110px">
                                    <strong class="text-muted">{!! trans('backLang.sendTo') !!}:
                                        &nbsp; {!! Session::get('WebmailToEdit')->to_name !!}</strong>
                                    <p class="text-muted">
                                        @if(Session::get('WebmailToEdit')->to_email !="")
                                            {!! trans('backLang.contactEmail') !!}:
                                            &nbsp; {!! Session::get('WebmailToEdit')->to_email !!}<br>

                                        @endif
                                        @if(Session::get('WebmailToEdit')->to_cc !="")
                                            {!! trans('backLang.sendCc') !!}:
                                            &nbsp; {!! Session::get('WebmailToEdit')->to_cc !!}<br>
                                        @endif
                                        @if(Session::get('WebmailToEdit')->to_bcc !="")
                                            {!! trans('backLang.sendBcc') !!}:
                                            &nbsp; {!! Session::get('WebmailToEdit')->to_bcc !!}
                                        @endif

                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php

                        $dtformated = date('d M Y h:i A', strtotime(Session::get('WebmailToEdit')->date));

                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box p-a">
                                    <h4>{!! Session::get('WebmailToEdit')->title !!}</h4>
                                    <small><i class="fa fa-calendar"></i> {{$dtformated}}</small>
                                    @if(Session::get('WebmailToEdit')->details)
                                        <hr>
                                        <p></p>
                                        {!! nl2br(Session::get('WebmailToEdit')->details) !!}
                                        </p>
                                    @endif

                                </div>
                            </div>
                        </div>
                        @if(count(Session::get('WebmailToEdit')->files) > 0)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="box p-a">
                                        <h6>{{ trans('backLang.AttachFiles') }}</h6>
                                        <hr>
                                        <div class="row">
                                            <?php
                                            $img_type = array(".gif", ".jpeg", ".png", ".jpg");
                                            ?>
                                            @foreach(Session::get('WebmailToEdit')->files as $file)
                                                <div class="col-sm-3">
                                                    <?php
                                                    $ext = strrchr($file->file, ".");
                                                    $ext = strtolower($ext);
                                                    if(!in_array($ext, $img_type)) {
                                                    ?>
                                                    <a href="{{ URL::to('uploads/inbox/'.$file->file) }}"
                                                       style="display: block;padding: 10px;border: 1px solid #eee"
                                                       target="_blank"><strong>{!! $file->file !!}</strong></a>
                                                    <?php
                                                    }else {
                                                    ?>
                                                    <a href="{{ URL::to('uploads/inbox/'.$file->file) }}"
                                                       target="_blank"><img
                                                                src="{{ URL::to('uploads/inbox/'.$file->file) }}"
                                                                style="max-width: 100%" alt=""></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @elseif($group_id=="create")

                    <div>
                        <div class="box">
                            <div class="box-header dker">
                                <h3><i class="material-icons">
                                        &#xe02e;</i> {{ trans('backLang.compose') }}
                                </h3>
                            </div>
                            <div class="box-tool">
                                <ul class="nav">
                                    <li class="nav-item inline">
                                        <a class="nav-link" href="{{ route('webmails') }}">
                                            <i class="material-icons md-18">×</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="box-body">
                                {{Form::open(['route'=>['webmailsStore'],'method'=>'POST', 'files' => true ])}}
                                <?php
                                $siteTitle_var = "site_title_" . trans('backLang.boxCode');
                                $siteTitle_var2 = "site_title_" . trans('backLang.boxCodeOther');
                                if ($SiteSetting->$siteTitle_var != "") {
                                    $siteTitle = $SiteSetting->$siteTitle_var;
                                } else {
                                    $siteTitle = $SiteSetting->$siteTitle_var2;
                                }
                                try {
                                    $from_email = $WebmailToreply->from_email;
                                    $msg_title = $WebmailToreply->title;
                                    $msg_details = $WebmailToreply->details;
                                } catch (Exception $e) {
                                    $from_email = $contact_email;
                                    $msg_title = "";
                                    $msg_details = "";
                                }
                                if ($stat == "replay") {
                                    $msg_title = "Re: " . $msg_title;
                                    $msg_details = "<br><hr><small>" . $msg_details . "</small>";
                                }
                                if ($stat == "forward") {
                                    $from_email = "";
                                    $msg_title = "Forward: " . $msg_title;
                                }
                                ?>
                                {!! Form::hidden('contact_id','') !!}
                                {!! Form::hidden('father_id','') !!}
                                {!! Form::hidden('from_email',$SiteSetting->site_webmails) !!}
                                {!! Form::hidden('from_name',$siteTitle) !!}
                                {!! Form::hidden('from_phone','') !!}
                                {!! Form::hidden('to_name','') !!}

                                <div class="form-group row">
                                    <label for="title_en"
                                           class="col-sm-2 form-control-label">{!!  trans('backLang.sendTo') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        {!! Form::email('to_email',$from_email, array('placeholder' => '','class' => 'form-control','id'=>'to_email','required'=>'')) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        <small>
                                            <a onclick="document.getElementById('cc').style.display='block'">{!!  trans('backLang.sendCc') !!}</a><br>
                                            <a onclick="document.getElementById('bcc').style.display='block'">{!!  trans('backLang.sendBcc') !!}</a>
                                        </small>
                                    </div>
                                </div>
                                <div id="cc" style="display: none" class="form-group row">
                                    <label for="title_en"
                                           class="col-sm-2 form-control-label">{!!  trans('backLang.sendCc') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        {!! Form::email('to_cc','', array('placeholder' => '','class' => 'form-control','id'=>'to_cc')) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        <a onclick="document.getElementById('to_cc').value='';document.getElementById('cc').style.display='none'"><i
                                                    class="material-icons md-18">×</i></a>
                                    </div>
                                </div>
                                <div id="bcc" style="display: none" class="form-group row">
                                    <label for="title_en"
                                           class="col-sm-2 form-control-label">{!!  trans('backLang.sendBcc') !!}
                                    </label>
                                    <div class="col-sm-9">
                                        {!! Form::email('to_bcc','', array('placeholder' => '','class' => 'form-control','id'=>'to_bcc')) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        <a onclick="document.getElementById('to_bcc').value='';document.getElementById('bcc').style.display='none'"><i
                                                    class="material-icons md-18">×</i></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title_en"
                                           class="col-sm-2 form-control-label">{!!  trans('backLang.sendTitle') !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::text('title',$msg_title, array('placeholder' => '','class' => 'form-control','id'=>'title','required'=>'')) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        {!! Form::textarea('details',$msg_details, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control','ui-options'=>'{height: 250}')) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="attach_files"
                                           class="col-sm-2 form-control-label">{!!  trans('backLang.AttachFiles') !!}</label>
                                    <div class="col-sm-10">
                                        {!! Form::file('attach_files[]', array('class' => 'form-control','id'=>'attach_files','multiple'=>'')) !!}
                                    </div>
                                </div>


                                <div class="form-group row m-t-md">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        {!! Form::hidden('btn_clicked','', array('id'=>'btn_clicked')) !!}
                                        <button type="submit" name="btn_send" onclick="document.getElementById('btn_clicked').value=''"  class="btn btn-primary m-t"><i
                                                    class="material-icons">
                                                &#xe31b;</i> {!! trans('backLang.send') !!}</button>
                                        <button type="submit" name="btn_draft" onclick="document.getElementById('btn_clicked').value='draft'" class="btn btn-default m-t"><i
                                                    class="material-icons">
                                                &#xe161;</i> {!! trans('backLang.SaveToDraft') !!}</button>
                                        <a href="{{ route('webmails') }}"
                                           class="btn btn-default m-t"><i class="material-icons">
                                                &#xe5cd;</i> {!! trans('backLang.cancel') !!}</a>
                                    </div>
                                </div>

                                {{Form::close()}}
                            </div>
                        </div>
                    </div>

                @else


                    @if($Webmails->total() == 0)
                        <div class="row p-a">
                            <div class="col-sm-12">
                                <div class=" p-a text-center ">
                                    {{ trans('backLang.noData') }}
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($Webmails->total() > 0)

                                <!-- header -->
                        <div class="m-b">
                            <div class="btn-group pull-right">
                                {{Form::open(['route'=>['webmailsSearch'],'method'=>'POST'])}}
                                <div class="input-group input-group-sm">
                                    {!! Form::text('q',$search_word, array('placeholder' => trans('backLang.search')."...",'class' => 'form-control','id'=>'name','required'=>'')) !!}
                                    <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit"><i class="fa fa-search"></i></button>
              </span>
                                </div>
                                {{Form::close()}}
                            </div>
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    &nbsp; &nbsp;&nbsp;
                                    <label class="ui-check" style="margin-top: 5px;">
                                        <input id="checkAll" type="checkbox"><i style="background: #fff"></i>
                                    </label>
                                    &nbsp;
                                </div>
                                <div class="btn-group dropdown">
                                    <button class="btn white btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <span class="dropdown-label">{{ trans('backLang.options') }}</span>
                                        <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu text-left text-sm">
                                        <a class="dropdown-item"
                                           onclick="document.getElementById('action').value='read';document.getElementById('UpdateAll').submit()"><i
                                                    class="material-icons">
                                                &#xe151;</i> {{ trans('backLang.makeAsRead') }}</a>
                                        <a class="dropdown-item"
                                           onclick="document.getElementById('action').value='unread';document.getElementById('UpdateAll').submit()"><i
                                                    class="material-icons">
                                                &#xe159;</i> {{ trans('backLang.makeAsUnread') }}</a>
                                        @if(@Auth::user()->permissionsGroup->delete_status)
                                            <a class="dropdown-item" data-toggle="modal" data-target="#m-all"
                                               ui-toggle-class="bounce" ui-target="#animate"><i class="material-icons">
                                                    &#xe872;</i> {{ trans('backLang.delete') }}</a>
                                        @endif
                                        @if(count($WebmailsGroups) >0)
                                            <div class="dropdown-divider"></div>
                                            @foreach($WebmailsGroups as $WebmailsGroup)
                                                <a class="dropdown-item"
                                                   onclick="document.getElementById('group').value='{{$WebmailsGroup->id}}';document.getElementById('action').value='move';document.getElementById('UpdateAll').submit()">{{ trans('backLang.moveTo') }}
                                                    <strong
                                                            style="color:{!! $WebmailsGroup->color !!} ">{!! $WebmailsGroup->name !!}</strong>
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- / header -->


                        {{Form::open(['route'=>'webmailsUpdateAll','method'=>'post','id'=>'UpdateAll'])}}
                                <!-- list -->
                        <input type="hidden" id="action" name="action" value="">
                        <input type="hidden" id="group" name="group" value="">
                        <div class="list white">
                            @foreach($Webmails as $Webmail)
                                <?php
                                $s4ds_current_date = date('Y-m-d', $_SERVER['REQUEST_TIME']);
                                $day_mm = date('Y-m-d', strtotime($Webmail->date));
                                if ($day_mm == $s4ds_current_date) {
                                    $dtformated = date('h:i A', strtotime($Webmail->date));
                                } else {
                                    $dtformated = date('d M Y', strtotime($Webmail->date));
                                }

                                try {
                                    $groupColor = $Webmail->webmailsGroup->color;
                                    $groupName = $Webmail->webmailsGroup->name;
                                } catch (Exception $e) {
                                    $groupColor = "";
                                    $groupName = "";
                                }

                                $fontStyle = "";
                                $unreadIcon = "";
                                $unreadbg = "";
                                $unreadText = "";
                                if ($Webmail->status == 0) {
                                    $fontStyle = "_700";
                                    $unreadIcon = "<i class=\"fa fa-envelope\"></i>";
                                    $unreadbg = "style=\"background: $groupColor \"";
                                    $unreadText = "style=\"color: $groupColor \"";
                                }
                                ?>
                                <div class="list-item b-l b-l-2x" style="border-color: {{$groupColor}}">
                                    <div class="list-left">
                                        <label class="ui-check m-a-0">
                                            <input type="checkbox" name="ids[]" value="{{ $Webmail->id }}"><i
                                                    class="dark-white"></i>
                                        </label>
                                        @if(count($Webmail->files))
                                            <i class="fa fa-paperclip m-l-sm text-muted text-xs" {!! $unreadText !!}></i>
                                        @endif
                                    </div>
                                    <div class="list-body" style="cursor: pointer;"
                                         onclick="location.href='{{ route("webmailsEdit",["id"=>$Webmail->id]) }}'">
                                        <div class="pull-right text-muted text-xs">
                                            <span class="hidden-xs  {{$fontStyle}}" {!! $unreadText !!}>{{ $dtformated }}</span>

                                        </div>
                                        <div>
                                            <a href="{{ route("webmailsEdit",["id"=>$Webmail->id]) }}"
                                               class="_500 {{$fontStyle}}" {!! $unreadText !!}>
                                                @if($group_id=="sent" || $group_id=="draft")
                                                    {{ $Webmail->title }}
                                                @else
                                                    {{ $Webmail->from_name }}
                                                @endif
                                            </a>
                                            @if($groupName !="")
                                                <span class="label m-l-sm text-u-c" {!! $unreadbg !!}>
                                      {{ $groupName }}
                                    </span>
                                            @endif
                                        </div>
                                        <div class="text-ellipsis text-muted text-sm ">
                                            <a href="{{ route("webmailsEdit",["id"=>$Webmail->id]) }}"
                                               class=" {{$fontStyle}}" {!! $unreadText !!}>
                                                {!! $unreadIcon !!}
                                                @if($group_id=="sent" || $group_id=="draft")
                                                    {{ $Webmail->to_email }}
                                                @else
                                                    {{ $Webmail->title }}
                                                @endif

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {!! $Webmails->links() !!}
                        </div>
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
                                <!-- / list -->
                    @endif
            </div>

        </div>
    </div>
</div>
<style>
    .modal-backdrop {
        z-index: 1;
    }
</style>

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
