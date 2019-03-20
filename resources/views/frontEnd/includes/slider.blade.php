@if(count($SliderBanners)>0)
    <section id="featured">
        <!-- start slider -->
        <!-- Slider -->
        @foreach($SliderBanners->slice(0,1) as $SliderBanner)
            <?php
            try {
                $SliderBanner_type = $SliderBanner->webmasterBanner->type;
            } catch (Exception $e) {
                $SliderBanner_type = 0;
            }
            ?>
        @endforeach
        <?php
        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');
        ?>
        @if($SliderBanner_type==0)
            {{-- Text/Code Banners--}}
            <div class="text-center">
                @foreach($SliderBanners as $SliderBanner)
                    @if($SliderBanner->$details_var !="")
                        <div>{!! $SliderBanner->$details_var !!}</div>
                    @endif
                @endforeach
            </div>
        @elseif($SliderBanner_type==1)
            {{-- Photo Slider Banners--}}
            <div id="main-slider" class="flexslider">
                <ul class="slides">
                    @foreach($SliderBanners as $SliderBanner)
                        <li>
                            <img src="{{ URL::to('uploads/banners/'.$SliderBanner->$file_var) }}"
                                 alt="{{ $SliderBanner->$title_var }}"/>
                            <div class="flex-caption">
                                @if($SliderBanner->$details_var !="")
                                    <h3>{!! $SliderBanner->$title_var !!}</h3>
                                @endif
                                @if($SliderBanner->$details_var !="")
                                    <p>{!! nl2br($SliderBanner->$details_var) !!}</p>
                                @endif
                                @if($SliderBanner->link_url !="")
                                    <a href="{!! $SliderBanner->link_url !!}"
                                       class="btn btn-theme">{{ trans('frontLang.moreDetails') }}</a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            {{-- Video Banners--}}
            <div class="text-center">
                @foreach($SliderBanners as $SliderBanner)
                    @if($SliderBanner->youtube_link !="")
                        @if($SliderBanner->video_type ==1)
                            <?php
                            $Youtube_id = Helper::Get_youtube_video_id($SliderBanner->youtube_link);
                            ?>
                            @if($Youtube_id !="")
                                {{-- Youtube Video --}}
                                <iframe width="100%" height="500" frameborder="0" allowfullscreen
                                        src="https://www.youtube.com/embed/{{ $Youtube_id }}">
                                </iframe>
                            @endif
                        @elseif($SliderBanner->video_type ==2)
                            <?php
                            $Vimeo_id = Helper::Get_vimeo_video_id($SliderBanner->youtube_link);
                            ?>
                            @if($Vimeo_id !="")
                                {{-- Vimeo Video --}}
                                <iframe width="100%" height="500" frameborder="0" allowfullscreen
                                        src="http://player.vimeo.com/video/{{ $Vimeo_id }}?title=0&amp;byline=0">
                                </iframe>
                            @endif
                        @endif
                    @endif
                    @if($SliderBanner->video_type ==0)
                        @if($SliderBanner->$file_var !="")
                            {{-- Direct Video --}}
                            <video width="100%" height="500" controls>
                                <source src="{{ URL::to('uploads/banners/'.$SliderBanner->$file_var) }}"
                                        type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    @endif
                    @if($SliderBanner->$details_var !="")
                        <div>{!! $SliderBanner->$details_var !!}</div>
                    @endif
                @endforeach
            </div>
    @endif
    <!-- end slider -->
    </section>
@endif