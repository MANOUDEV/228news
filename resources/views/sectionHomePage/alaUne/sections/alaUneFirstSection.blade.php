<div class="row">
    <div class="col-12">
        <div class="tiny-slider arrow-hover arrow-blur arrow-round rounded-3 overflow-hidden">
            <div class="tiny-slider-inner"
            data-autoplay="true"
            data-hoverpause="true"
            data-gutter="24"
            data-arrow="true"
            data-dots="false"
            data-items-xl="1"
            data-items-lg="1"
            data-items-md="1"
            data-items-sm="1"
            data-items-xs="1">
            <!-- Card item START -->
                @for ($i=9; $i<= count($alaUne) - 1; $i++ )

                    @if ($i <= 17)
                        <div>
                            <div class="card card-overlay-bottom card-img-scale">
                                <!-- Card Image -->
                                <img class="card-img alaune_first_section_img_responsive" src="{{$alaUne[$i]['image_cover_url']}}" alt="{!! $alaUne[$i]['title'] !!}">
                                <!-- Card Image overlay -->
                                <div class="card-img-overlay d-flex flex-column p-3 p-sm-4">

                                    <div class="w-100 mt-auto">
                                        <div>
                                            <!-- Card category -->
                                            <a href="{{$alaUne[$i]['category_slug']}}" class="badge text-bg-success"><i class="fas fa-circle me-2 small fw-bold"></i>{{$alaUne[$i]['category_name']}}</a>
                                        </div>
                                        <!-- Card title -->
                                        <h4 class="text-white"><a href="/{{ $alaUne[$i]['slug'] }}" class="btn-link text-reset stretched-link">{!! \Illuminate\Support\Str::words($alaUne[$i]['title'], 9, ' ...') !!}</a></h4>
                                        <div class="text-white-force">
                                            <div>{!! $alaUne[$i]['truncate_content'] !!}</div>
                                        </div>
                                        <!-- Card info -->
                                        <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">
                                                        <div class="avatar avatar-sm">
                                                            <div class="avatar-img rounded-circle bg-success">
                                                                <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ strtoupper($alaUne[$i]['author_name'][0].''.$alaUne[$i]['author_name'][1]) }}</span>
                                                            </div>
                                                        </div>
                                                        <span class="ms-3">par <a href="/auteurs/{{ $alaUne[$i]['author_slug'] }}" class="stretched-link text-reset btn-link">{{ $alaUne[$i]['author_name'] }}</a></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item">{{ date('d/m/Y', strtotime($alaUne[$i]['date_publish'])) }}</li>
                                            <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-thumbs-up me-1"></i> {{ $alaUne[$i]['likes_count'] }}</a></li>
                                            <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-comment-alt me-1"></i> {{ $alaUne[$i]['comment_count'] }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>

        </div>
    </div>
</div>
