@if($errors ->any())
    <div class="padding p-b-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger m-b-0">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('doneMessage'))
    <div class="padding p-b-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success m-b-0">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ Session::get('doneMessage') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('errorMessage'))
    <div class="padding p-b-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger m-b-0">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ Session::get('errorMessage') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('infoMessage'))
    <div class="padding p-b-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info m-b-0">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ Session::get('infoMessage') }}
                </div>
            </div>
        </div>
    </div>
@endif


@if(Session::has('warningMessage'))
    <div class="padding p-b-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-warning m-b-0">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{ Session::get('warningMessage') }}
                </div>
            </div>
        </div>
    </div>
@endif

