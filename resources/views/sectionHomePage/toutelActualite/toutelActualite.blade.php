<div class="container">
    <div class=" row mt-3">
       
        <div class="col-md-12">
            <!-- Title -->
            <div class="d-md-flex justify-content-between">
                <div class="d-flex mb-2">
                    
                    <div>
                        <h2 class="text-success m-0 toute_lactualite_title">NEWS TOGO</h2> 
                    </div>
                </div>
            </div>
            <div class="tiny-slider arrow-hover arrow-blur arrow-dark arrow-round">
                <div class="tiny-slider-inner"
                    data-autoplay="true"
                    data-hoverpause="true"
                    data-gutter="24"
                    data-arrow="true"
                    data-dots="false"
                    data-items-xl="3"
                    data-items-md="2"
                    data-items-sm="2"
                    data-items-xs="1">

                    @for ($i=0; $i<= count($togoActualite) - 1; $i++ )

                        <!-- Card item START -->
                        <div class="card">
                            <!-- Card img -->
                            <div class="position-relative">
                                <img class="card-img toute_lactualite" src="{{$togoActualite[$i]['image_cover_url']}}"   alt="{!! $togoActualite[$i]['title'] !!}">
                                <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                    <!-- Card overlay Top -->

                                    <!-- Card overlay bottom -->
                                    <div class="w-100 mt-auto">
                                        <!-- Card category -->
                                        <a href="/{{$togoActualite[$i]['category_slug']}}" class="badge text-bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{$togoActualite[$i]['category_name']}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-3">
                                <h6 class="card-title"><a href="/{{ $togoActualite[$i]['slug'] }}" class="btn-link text-reset fw-bold">{!! $togoActualite[$i]['title'] !!}</a></h6>
                                <!-- Card info -->
                                <ul class="nav nav-divider align-items-center d-sm-inline-block" style="font-size: 12px">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="avatar avatar-xs">
                                                    <div class="avatar-img rounded-circle bg-success">
                                                        <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ strtoupper($togoActualite[$i]['author_name'][0].''.$togoActualite[$i]['author_name'][1]) }}</span>
                                                    </div>
                                                </div>
                                                <span class="ms-3">par <a href="/auteurs/{{ $togoActualite[$i]['author_slug'] }}" class="stretched-link text-reset btn-link">{{ $togoActualite[$i]['author_name'] }}</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">{{ date('d/m/Y', strtotime($togoActualite[$i]['date_publish'])) }}</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Card item END -->

                    @endfor
                </div>
            </div>
        </div>
         
    </div>

</div>

