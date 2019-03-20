@extends('backEnd.layout')
@section('content')
    <div class="padding">
        {{Form::open(['route'=>['adminFind'],'method'=>'POST', 'class' => "m-b-md" ])}}

        <div class="input-group input-group-lg">
            <input type="text" name="q" value="{{ $search_word }}" class="form-control"
                   placeholder="{{ trans('backLang.search') }}..." required>
      <span class="input-group-btn">
        <button class="btn b-a no-shadow white" type="submit">{{ trans('backLang.search') }}</button>
      </span>
        </div>
        {{Form::close()}}
        <p class="m-b-md">
            <strong>{{ $totalcount = count($Topics) + count($Sections) + count($Contacts) + count($Events) + count($Webmails) }}</strong> {{ trans('backLang.resultsFoundFor') }}
            : <strong>{{ $search_word }}</strong></p>

        <ul class="nav nav-sm nav-pills nav-active-primary clearfix">
            @if(count($Topics)>0)
                <li class="nav-item">
                    <a class="nav-link {{ ($active_tab==1) ? "active":"" }}" href data-toggle="tab"
                       data-target="#tab_1"> {{ trans('backLang.pages') }}
                        <span
                                class="label label-xs primary m-l-xs">{{count($Topics)}}</span></a>
                </li>
            @endif
            @if(count($Sections)>0)
                <li class="nav-item">
                    <a class="nav-link {{ ($active_tab==2) ? "active":"" }}" href data-toggle="tab" data-target="#tab_2"> {{ trans('backLang.sections') }}
                        <span
                                class="label label-xs primary m-l-xs">{{count($Sections)}}</span></a>
                </li>
            @endif
            @if(count($Contacts)>0)
                <li class="nav-item">
                    <a class="nav-link {{ ($active_tab==3) ? "active":"" }}" href data-toggle="tab" data-target="#tab_3"> {{ trans('backLang.newsletter') }}
                        <span
                                class="label label-xs primary m-l-xs">{{count($Contacts)}}</span></a>
                </li>
            @endif
            @if(count($Events)>0)
                <li class="nav-item">
                    <a class="nav-link {{ ($active_tab==4) ? "active":"" }}" href data-toggle="tab" data-target="#tab_4"> {{ trans('backLang.notesEvents') }}
                        <span
                                class="label label-xs primary m-l-xs">{{count($Events)}}</span></a>
                </li>
            @endif
            @if(count($Webmails)>0)
                <li class="nav-item">
                    <a class="nav-link {{ ($active_tab==5) ? "active":"" }}" href data-toggle="tab" data-target="#tab_5"> {{ trans('backLang.inbox') }} <span
                                class="label label-xs primary m-l-xs">{{count($Webmails)}}</span></a>
                </li>
            @endif
        </ul>

        <div class="tab-content">
            @if(count($Topics)>0)
                <div class="tab-pane p-v-sm  {{ ($active_tab==1) ? "active":"" }}" id="tab_1">

                    <?php
                    $title_var = "title_" . trans('backLang.boxCode');
                    $title_var2 = "title_" . trans('backLang.boxCodeOther');
                    $details_var = "details_" . trans('backLang.boxCode');
                    ?>
                    @foreach($Topics as $Topic)
                        <?php
                        if ($Topic->$title_var != "") {
                            $title = $Topic->$title_var;
                        } else {
                            $title = $Topic->$title_var2;
                        }
                        $section = "";
                        try {
                            if ($Topic->section->$title_var != "") {
                                $section = $Topic->section->$title_var;
                            } else {
                                $section = $Topic->section->$title_var2;
                            }
                        } catch (Exception $e) {
                            $section = "";
                        }
                        if (strlen(stripcslashes(strip_tags($Topic->$details_var))) > 300) {
                            $details = mb_substr(stripcslashes(strip_tags($Topic->$details_var)), 0, 300, 'UTF-8') . "...";
                        } else {
                            $details = stripcslashes(strip_tags($Topic->$details_var));
                        }
                        ?>
                        <div class="box m-t p-a-sm">
                            <ul class="list m-b-0">
                                <li class="list-item">
                                    @if($Topic->photo_file !="")
                                        <div class="pull-left pull-none-xs m-r m-b w p-a-xs b-a">
                                            <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                                 style="height: 40px" alt="{{ $title }}" class="w-full">
                                        </div>
                                    @endif
                                    <div class="clear">
                                        <h5 class="m-a-0 m-b-sm text-primary"><a
                                                    href="{{ route("topicsEdit",["webmasterId"=>$Topic->webmaster_id,"id"=>$Topic->id]) }}">{{ $title }}</a>
                                        </h5>
                                        <p class="text-muted m-b-0">{!! $details !!}</p>
                                        <p><span class="label m-r">{!! $section  !!}</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach

                </div>
            @endif
            @if(count($Sections)>0)
                <div class="tab-pane p-v-sm  {{ ($active_tab==2) ? "active":"" }}" id="tab_2">
                    <div class="box m-t p-a-sm">
                        <ul class="list m-b-0">
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
                                <li class="list-item">
                                    <div class="clear">
                                        <h5 class="m-a-0 m-b-sm text-primary"><a
                                                    href="{{ route("sectionsEdit",["webmasterId"=>$Section->webmaster_id,"id"=>$Section->id]) }}">{{ $title }}</a>
                                        </h5>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if(count($Contacts)>0)
                <div class="tab-pane p-v-sm  {{ ($active_tab==3) ? "active":"" }}" id="tab_3">
                    <div class="m-t">
                        <div class="row row-sm">
                            @foreach($Contacts as $Contact)
                                <div class="col-xs-6 col-lg-4">
                                    <div class="list-item box r m-b">

                                        <a href="{{ route("contactsEdit",["id"=>$Contact->id]) }}" class="list-left">
                                            <span class="w-40 avatar">
                                            @if($Contact->photo!="")
                                                    <img src="{{ URL::to('uploads/contacts/'.$Contact->photo) }}"
                                                         class="on b-white bottom">
                                                @else
                                                    <img src="{{ URL::to('uploads/contacts/profile.jpg') }}"
                                                         class="on b-white bottom"
                                                         style="opacity: 0.5">
                                                @endif
                                            </span>
                                        </a>

                                        <div class="list-body">
                                            <div class="text-ellipsis"><a
                                                        href="{{ route("contactsEdit",["id"=>$Contact->id]) }}">{{ $Contact->first_name }} {{ $Contact->last_name }}</a>
                                            </div>
                                            <small class="text-muted text-ellipsis">
                                                <span dir="ltr">{{ $Contact->phone }}</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif

            @if(count($Events)>0)
                <div class="tab-pane p-v-sm  {{ ($active_tab==4) ? "active":"" }}" id="tab_4">

                    @foreach($Events as $Event)
                        <div class="box m-t p-a-sm">
                            <ul class="list m-b-0">

                                <li class="list-item">
                                    <div class="clear">

                                        <h5 class="m-a-0 m-b-sm text-primary">
                                            <span class="label m-r" style="margin-bottom: 5px;">
                                                @if($Event->type ==3 || $Event->type ==2)
                                                    {{ date('d M Y  h:i A', strtotime($Event->start_date)) }}
                                                @else
                                                    {{ date('d M Y', strtotime($Event->start_date)) }}
                                                @endif
                                            </span><br>
                                            <a
                                                    href="{{ route("calendarEdit",["id"=>$Event->id]) }}">{{ $Event->title }}</a>

                                        </h5>
                                        <p class="text-muted  m-b-0">{!! nl2br($Event->details) !!}</p>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach

                </div>
            @endif

            @if(count($Webmails)>0)
                <div class="tab-pane p-v-sm  {{ ($active_tab==5) ? "active":"" }}" id="tab_5">

                    @foreach($Webmails as $Webmail)
                        <?php
                        if (strlen(stripcslashes(strip_tags($Webmail->details))) > 300) {
                            $details = mb_substr(stripcslashes(strip_tags($Webmail->details)), 0, 300, 'UTF-8') . "...";
                        } else {
                            $details = stripcslashes(strip_tags($Webmail->details));
                        }
                        ?>
                        <div class="box m-t p-a-sm">
                            <ul class="list m-b-0">
                                <li class="list-item">
                                    <div class="clear"><span class="label m-r">
                                                    {{ date('d M Y', strtotime($Webmail->date)) }}
                                            </span>

                                        <h5 class="m-a-0 m-b-sm text-primary"><a
                                                    href="{{ route("webmailsEdit",["id"=>$Webmail->id]) }}">{{ $Webmail->title }}</a>
                                        </h5>
                                        <p class="text-muted m-b-0">{!! $Webmail->details !!}</p>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach

                </div>
            @endif


        </div>
    </div>

@endsection
