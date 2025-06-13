@extends('layouts.base')

@section('title') {!! $article->title !!} @endsection

@section('content')

@include('includes.header')

    <main style="margin-top: -45px; margin-bottom: -25px">

        <section>
            <div class="container">
                
                @include('adsense.google-ads.ads-sections-second-header')
                <div class="row">
                    <div class="col-12">
                        <div class="tiny-slider arrow-dark arrow-hover arrow-round rounded-3">
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
                                    <div>
                                        <div class="card card-fold bg-dark">
                                            <img src="{{$article->image_cover_url}}" class="card-img-top alauneH_first_section_img_rectangle" alt="{{$article->title}}">
                                         </div>
                                    </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-md-flex justify-content-between text-md-start my-2 ">
					<!-- Tag -->
					<ul class="list-inline mb-0">
                        @foreach ($categoriesH as $category)
                            <li class="list-inline-item">
                                <a class="btn btn-success btn-sm" href="/{{ $category->category_slug }}">{{ $category->category_name }}</a>
                            </li>
                        @endforeach
					</ul>
				</div>
                <h2 class="text-dark">  {!! $article->title !!} </h2>

            </div>
        </section>
        <section class="pt-0 mt-2">
            <div class="container" data-sticky-container>
                

                <div class="row" style="margin-top: -35px">
                    <!-- Left sidebar START -->
                    <div class="col-md-1">
                        <div class="text-start text-lg-center" data-sticky data-margin-top="80" data-sticky-for="767">
                            <ul class="nav text-white-force">
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-facebook" href="#">
                                        <i class="fab fa-facebook-square align-middle"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-twitter" href="#">
                                        <i class="fab fa-twitter-square align-middle"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-linkedin" href="#">
                                        <i class="fab fa-linkedin align-middle"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-success" href="#">
                                        <i class="fab fa-whatsapp align-middle"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-danger" href="#">
                                        <i class="far fa-envelope align-middle"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <div id="states"></div>
                        @if ($tagsCount !== 0)  <h5>Mots clés</h5> @endif
                        <div class="d-md-flex justify-content-between  text-md-start my-3">

                            <!-- Tag -->
                            @if ($tagsCount !== 0)

                                <ul class="list-inline mb-0">

                                    @foreach ($tags as $tag )

                                        <li class="list-inline-item">
                                            <a class="btn btn-outline-light btn-sm" href="/tags/{{$tag->slug}}">#{{ $tag->name }}</a>
                                        </li>

                                    @endforeach

                                </ul>

                            @endif
                            <!-- Info -->

                        </div>
                        <div class="d-flex p-2 p-md-4 my-3 bg-primary bg-opacity-10 rounded">
                            <!-- Avatar -->
                            <a href="#">
                                <div class="avatar avatar-xxl me-2 me-md-4">
                                    <div class="avatar-img rounded-circle bg-success">
                                        <span class="text-white position-absolute top-50 start-50 translate-middle fw-bold " style="font-size: 35px">{{ strtoupper($article->author_name[0].''.$article->author_name[1]) }}</span>
                                    </div>
                                </div>
                            </a>
                            <!-- Info -->
                            <div>
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div>
                                        <h4 class="m-0"><a href="/authors/{{$article->author_slug}}" class="text-reset">{{$article->author_name}}</a></h4>
                                        <small>Auteur de cet article</small>
                                    </div>
                                    <a href="/authors/{{$article->author_slug}}" class="btn btn-sm btn-success">Voir ces articles</a>
                                </div>
                                <p class="my-2"> Nous tenons à rappeler aux visiteurs du site que
                                    sans partenariat avec togoactualite.com, la reprise des articles même partielle est strictement interdite.
                                    Tout contrevenant s'expose à de graves poursuites.</p>
                                <!-- Social icons -->

                            </div>
                        </div>
                        <br>
                        <div class="row g-4" style="margin-top: -20px">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                               
                            </div>
                        </div>

                        @include('adsense.google-ads.ads-sections-second-header')

                        <p> {!! showPub($article->content, $categoriesH[0]->id, $article->id)  !!} </p>

                        
                        @include('adsense.google-ads.ads-sections-second-header')

                        <!-- =======================Adv END -->
                        @if ($previous && $next)
                            <div class="row g-0">
                                <div class="col-sm-6 bg-primary bg-opacity-10 p-4 position-relative border-end border-1 rounded-start">
                                    <span><i class="bi bi-arrow-left me-3 rtl-flip"></i>Article Précedent</span>
                                    <h6 class="m-0"><a href="/{{ $previous->slug}}" class="stretched-link btn-link text-reset"> {!! $previous->title !!} </a></h6>
                                </div>
                                <div class="col-sm-6 bg-primary bg-opacity-10 p-4 position-relative text-sm-end rounded-end">
                                    <span>Article Suivant <i class="bi bi-arrow-right ms-3 rtl-flip"></i></span>
                                    <h6 class="m-0"><a href="/{{ $next->slug}}" class="stretched-link btn-link text-reset">{!! $next->title !!}</a></h6>
                                </div>
                            </div>
                            <!-- Related post START -->
                        @endif
                        <br>
                       
                        @include('adsense.google-ads.ads-sections-second-header')

                        <div class="mt-2">
                            <h2 class="my-3"><i class="bi bi-symmetry-vertical me-2"></i>Voir aussi</h2>
                            <div class="tiny-slider arrow-hover arrow-blur arrow-dark arrow-round">
                                <div class="tiny-slider-inner"
                                    data-autoplay="true"
                                    data-hoverpause="true"
                                    data-gutter="24"
                                    data-arrow="true"
                                    data-dots="false"
                                    data-items-xl="3"
                                    data-items-xs="1">

                                    @foreach ($similars as $similar )
                                        <!-- Card item START -->
                                    <div class="card">
                                        <!-- Card img -->
                                        <div class="position-relative">
                                            <img class="card-img" src="{{$similar->image_cover_url}}" alt="{{$article->title}}" style="height: 220px; object-fit: cover">
                                            <div class="card-img-overlay d-flex align-items-start flex-column p-3">

                                                <!-- Card overlay bottom -->
                                                <div class="w-100 mt-auto">
                                                    <a href="/{{ $similar->category_slug }}" class="badge text-bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{ $similar->category_name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-0 pt-3">
                                            <h6 class="card-title"><a href="/{{ $similar->slug }}" class="btn-link text-reset stretched-link fw-bold"> {!! $similar->title !!} </a></h6>
                                            <!-- Card info -->
                                            <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">

                                                <li class="nav-item">{{ date('d/m/Y', strtotime($similar->date_publish)) }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    @endforeach

                                </div>
                            </div> <!-- Slider END -->
                        </div>

                        @include('adsense.google-ads.ads-sections-second-header')
                        <div id="comments"></div>
                    </div>
                    <div class="col-lg-3 mt-5 mt-lg-0">
                        <div data-sticky data-margin-top="80" data-sticky-for="767">
                            <!-- Categories -->
                            <div class="row g-2">

                                 <!-- Advertisement -->
                                 <div class="mt-4">
                                    
                                </div>
                                
                                <!-- Most read -->
                                <div>
                                    <br>
                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5594963864359932"
                                        crossorigin="anonymous"></script>
                                    <!-- annonce carré 300x300 -->
                                    <ins class="adsbygoogle"
                                        style="display:inline-block;width:300px;height:300px"
                                        data-ad-client="ca-pub-5594963864359932"
                                        data-ad-slot="9589411564"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                    <br>
                                    <h5 class="mb-3">A LA UNE </h5>
                                    <div class="tiny-slider dots-creative mt-3 mb-1">
                                        <div class="tiny-slider-inner"
                                            data-autoplay="true"
                                            data-hoverpause="true"
                                            data-gutter="0"
                                            data-arrow="false"
                                            data-dots="true"
                                            data-items="1">

                                            @foreach ($alireaussi as  $result)

                                                <!-- Card item START -->
                                            <div class="card">
                                                <!-- Card img -->
                                                <div class="position-relative">
                                                    <img class="card-img" src="{{ $result->image_cover_url }}" style="height: 230px; width: 550px ; object-fit: cover" alt="{{ $result->title }}">
                                                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">

                                                        <!-- Card overlay bottom -->
                                                        <div class="w-100 mt-auto">
                                                            <a href="/{{$result->category_slug}}" class="badge text-bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{$result->category_name}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0 pt-3">
                                                    <h6 class="card-title"><a href="/{{$result->slug}}" class="btn-link text-reset fw-bold">{!! $result->title !!}</a></h6>
                                                </div>
                                            </div>
                                            <!-- Card item END -->

                                            @endforeach


                                        </div>
                                    </div>

                                    <br>
                                    <h5 class="mb-3">TOGO POLITIQUE </h5>
                                    <div class="tiny-slider dots-creative mt-3 mb-1">
                                        <div class="tiny-slider-inner"
                                            data-autoplay="true"
                                            data-hoverpause="true"
                                            data-gutter="0"
                                            data-arrow="false"
                                            data-dots="true"
                                            data-items="1">

                                            @foreach ($politiqueFirst as  $result)

                                                <!-- Card item START -->
                                            <div class="card">
                                                <!-- Card img -->
                                                <div class="position-relative">
                                                    <img class="card-img" src="{{ $result->image_cover_url }}" style="height: 230px; width: 550px ; object-fit: cover" alt="{{ $result->title }}">
                                                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">

                                                        <!-- Card overlay bottom -->
                                                        <div class="w-100 mt-auto">
                                                            <a href="/{{$result->category_slug}}" class="badge text-bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{$result->category_name}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0 pt-3">
                                                    <h6 class="card-title"><a href="/{{$result->slug}}" class="btn-link text-reset fw-bold">{!! $result->title !!}</a></h6>
                                                </div>
                                            </div>
                                            <!-- Card item END -->

                                            @endforeach


                                        </div>
                                    </div>
                                </div>


                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5594963864359932"
                                crossorigin="anonymous"></script>
                                <!-- annonce carré 300px -->
                                <ins class="adsbygoogle"
                                    style="display:inline-block;width:300px;height:300px"
                                    data-ad-client="ca-pub-5594963864359932"
                                    data-ad-slot="2321295639"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                                <!-- Right sidebar END -->
                            </div>
                        </div>
                    </div>
                </div>
                
                @include('adsense.google-ads.ads-sections-second-header')
            </div>
        </section>
    </main>

@include('includes.footer')

@endsection
