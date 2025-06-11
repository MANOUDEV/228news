<div class="container">
    <div class=" row mt-3">
       
        <div class="col-md-12">
            <!-- Title -->
            <div class="d-md-flex justify-content-between">
                <div class="d-flex mb-2">
                    <div>
                        <img src="/assets/images/Icones_formes/Icones-TAAsset-82.png" class="toutelactualite_logo" alt="toutelactualite_logo">
                    </div>
                    <div>&nbsp; &nbsp; &nbsp;</div>
                    <div>
                        <h2 class="text-success m-0 toute_lactualite_title">NATIONAL</h2>
                        <p>Suivez toute l'actualité nationale.</p>
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

                    @for ($i=0; $i<= count($alaUne) - 1; $i++ )

                        <!-- Card item START -->
                        <div class="card">
                            <!-- Card img -->
                            <div class="position-relative">
                                <img class="card-img toute_lactualite" src="{{$alaUne[$i]['image_cover_url']}}"   alt="{!! $alaUne[$i]['title'] !!}">
                                <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                    <!-- Card overlay Top -->

                                    <!-- Card overlay bottom -->
                                    <div class="w-100 mt-auto">
                                        <!-- Card category -->
                                        <a href="/{{$alaUne[$i]['category_slug']}}" class="badge text-bg-success mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{$alaUne[$i]['category_name']}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-3">
                                <h6 class="card-title"><a href="/{{ $alaUne[$i]['slug'] }}" class="btn-link text-reset fw-bold">{!! $alaUne[$i]['title'] !!}</a></h6>
                                <!-- Card info -->
                                <ul class="nav nav-divider align-items-center d-sm-inline-block" style="font-size: 12px">
                                    <li class="nav-item">
                                        <div class="nav-link">
                                            <div class="d-flex align-items-center position-relative">
                                                <div class="avatar avatar-xs">
                                                    <div class="avatar-img rounded-circle bg-success">
                                                        <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ strtoupper($alaUne[$i]['author_name'][0].''.$alaUne[$i]['author_name'][1]) }}</span>
                                                    </div>
                                                </div>
                                                <span class="ms-3">par <a href="/auteurs/{{ $alaUne[$i]['author_slug'] }}" class="stretched-link text-reset btn-link">{{ $alaUne[$i]['author_name'] }}</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">{{ date('d/m/Y', strtotime($alaUne[$i]['date_publish'])) }}</li>
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

