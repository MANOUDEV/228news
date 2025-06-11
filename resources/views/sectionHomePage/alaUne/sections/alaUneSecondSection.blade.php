<div class="row">

@for ($i=18; $i<= count($alaUne) - 1; $i++ )
    @if ($i > 18)
        <div class="col-lg-6 col-sm-6 col-xs-12 mb-3">
            <!-- Newsletter START -->
           <div class="card card-overlay-bottom card-img-scale">
                <!-- Card Image -->
                <img class="card-img toute_lactualite_h" src="{{$alaUne[$i]['image_cover_url']}}" alt="{!! $alaUne[$i]['title'] !!}">
                <!-- Card Image overlay -->
                <div class="card-img-overlay d-flex flex-column p-3 p-sm-4">

                    <div class="w-100 mt-auto">
                        <div>
                            <!-- Card category -->
                            <a href="{{$alaUne[$i]['category_slug']}}" class="badge text-bg-success"><i class="fas fa-circle me-2 small fw-bold"></i>{{$alaUne[$i]['category_name']}}</a>
                        </div>
                        <!-- Card title -->
                        <h6 class="text-white"><a href="/{{ $alaUne[$i]['slug'] }}" class="btn-link text-reset stretched-link">{!! \Illuminate\Support\Str::words($alaUne[$i]['title'], 9, ' ...') !!}</a></h6>
                         
                        <!-- Card info -->
                        <ul class="nav nav-divider text-white-force align-items-center d-none d-sm-inline-block" style="font-size: 11px">
                            <li class="nav-item">
                                <div class="nav-link">
                                    <div class="d-flex align-items-center position-relative">
                                        
                                        <span class="ms-3"><a href="/auteurs/{{ $alaUne[$i]['author_slug'] }}" class="stretched-link text-reset btn-link">{{ $alaUne[$i]['author_name'] }}</a></span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">{{ date('d/m/Y', strtotime($alaUne[$i]['date_publish'])) }}</li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter END -->
    @endif
@endfor
</div>


