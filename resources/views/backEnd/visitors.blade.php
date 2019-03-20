@extends('backEnd.layout')
@section('headerInclude')
<link rel="stylesheet" type="text/css" href="{{ URL::to("backEnd/assets/styles/flags.css") }}"/>
@endsection
@section('content')

    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ trans('backLang.visitorsAnalyticsVisitorsHistory') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.visitorsAnalytics') }}</a>
                </small>
            </div>


            <div class="table-responsive">
                <table class="table table-striped  b-t">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('backLang.topicDate') }}</th>
                        <th class="text-center">{{ trans('backLang.ip') }}</th>
                        <th>{{ trans('backLang.visitorsAnalyticsByCity') }}</th>
                        <th>{{ trans('backLang.visitorsAnalyticsByCountry') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ii = 1;
                    ?>
                    @foreach($AnalyticsVisitors as $Analytic)
                        <tr>
                            <td class="text-center" >
                                <small>{{$Analytic->date}} &nbsp; {{date('h:i A', strtotime($Analytic->time)) }}</small>
                            </td>
                            <td class="text-center dker text-info"><a href="{{route("visitorsIP",$Analytic->ip)}}">{{$Analytic->ip}}</a></td>
                            <td>{{$Analytic->city}}</td>
                            <?php
                            $flag = "";
                            $country_code = strtolower($Analytic->country_code);
                            if ($country_code != "unknown") {
                                $flag = "<div class='flag flag-$country_code' style='display: inline-block'></div> ";
                            }
                                    ?>
                            <td>{!! $flag !!} &nbsp;{{$Analytic->country}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <br>
                <div class="text-center">
                    {!! $AnalyticsVisitors->links() !!}
                </div>
                <br>
            </div>
        </div>
    </div>

@endsection
@section('footerInclude')
@endsection
