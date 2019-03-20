@if(Helper::GeneralSiteSettings("style_subscribe"))
    <div class="col-lg-{{$bx4w}}">
        <div class="widget">
            <h4 class="widgetheading"><i class="fa fa-envelope-open"></i>&nbsp; {{ trans('frontLang.newsletter') }}</h4>
            <p>{{ trans('frontLang.subscribeToOurNewsletter') }}</p>
            <div id="subscribesendmessage"><i class="fa fa-check-circle"></i> &nbsp;{{ trans('frontLang.subscribeToOurNewsletterDone') }}</div>
            <div id="subscribeerrormessage">{{ trans('frontLang.youMessageNotSent') }}</div>

            {{Form::open(['route'=>['Home'],'method'=>'POST','class'=>'subscribeForm'])}}
            <div class="form-group">
                {!! Form::text('subscribe_name',"", array('placeholder' => trans('frontLang.yourName'),'class' => 'form-control','id'=>'subscribe_name', 'data-msg'=> trans('frontLang.enterYourName'),'data-rule'=>'minlen:4')) !!}
                <div class="alert alert-warning validation"></div>
            </div>
            <div class="form-group">
                {!! Form::email('subscribe_email',"", array('placeholder' => trans('frontLang.yourEmail'),'class' => 'form-control','id'=>'subscribe_email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}
                <div class="validation"></div>
            </div>
            <button type="submit" class="btn btn-info">{{ trans('frontLang.subscribe') }}</button>
            {{Form::close()}}
        </div>
    </div>
@endif