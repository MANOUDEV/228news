@extends('layouts.base')

@section('title') A propos @endsection

@section('content')

    @include('includes.header')

    <main style="margin-top: -30px">

        <section>
            <div class="container">
                
                <div class="row">
                    <div class="col-md-9 mx-auto text-center">
                        
                        <h1 class="display-4">A propos</h1>
                        <!-- breadcrumb -->
                        <nav class="d-flex justify-content-center" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dots mb-0">
                            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house me-1"></i> Accueil</a></li>
                            <li class="breadcrumb-item active">A propos</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================Inner intro END -->

        <!-- =======================About START -->
        <section class="pt-4 pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        
                        <h2>Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.</h2>

                        <h3 class="mt-4">Les raisons de la création du site togoactualite sont plusieurs :</h3> <br>
                        <ul>
                            <li>Fournir les informations fiables sans déformation via notre site internet.</li>
                            <li>Permettre à la diaspora togolaise d’être informée de ce qui se passe dans notre cher pays.</li>
                            <li>Nouer des partenariats avec d’autres sites d’information.</li>
                            <li>Faire mieux connaître notre Togo à travers des débats, vidéos, nos cultures, etc…</li>
                            <li>Permettre à nos abonnés de nous suivre et d’animer des débats dans le respect.</li>
                        </ul>
                        
                        <!-- Team START -->
                        <h3 class="mb-3 mt-5">Notre Groupe</h3>
                        <div class="row g-4">

                            @foreach ($users as $user )
                            @if ($user->role_id == 1 || $user->role_id == 2 )
                                <div class="col-sm-6 col-lg-3">
                                    <div class="text-center">
                                        <!-- Avatar img -->
                                        <div class="avatar avatar-xxl mb-2">
                                            <div class="avatar-img rounded-circle bg-success">
                                                <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold small" style="font-size: 30px"> {{ strtoupper(substr($user->prenoms, 0, 2)) }} </span>
                                            </div>
                                        </div>
                                        <h5>{{ $user->prenoms }}</h5>
                                        <p class="m-0">
                                            @if ($user->role_id == 1)
                                                Administrateur
                                            @else
                                                Publicateur d'articles
                                            @endif
                                        </p>

                                    </div>
                                </div>
                            @endif
                            @endforeach
                            <!-- Team item-->

                            </div>
                            <!-- Service END -->
                        </div> 
                         <br> <br>
                        <!-- Service END -->
                    </div>  <!-- Col END -->
                </div>
            </div>
        </section>

        <section class="pt-0 mt-5 pt-md-5">
            <div class="container">
                <div class="row g-4">
                    <!-- Title -->
                    <div class="col-md-3">
                        <h2>Nos services</h2>
                        <p>Si vous désirez bénéficier de nos services alors contactez nous</p>
                        <a href="/contact" class="btn btn-dark mb-0">Nous contactez </a>
                    </div>

                    <!-- Slider item START -->
                    <div class="col-md-9">
                        <div class="tiny-slider arrow-hover arrow-dark arrow-blur arrow-round">
                            <div class="tiny-slider-inner"
                            data-autoplay="true"
                            data-hoverpause="true"
                            data-gutter="24"
                            data-edge="2"
                            data-arrow="true"
                            data-dots="false"
                            data-items-xl="3"
                            data-items-lg="2"
                            data-items-xs="1"
                            >

                                <!-- Slider item START -->
                                <div>
                                    <div class="card border">
                                        <!-- Image -->
                                        <div class="position-relative">
                                            <div class=" card-img-top avatar mb-2" style="width: 100%; height: 180px">
                                                <div class="avatar-img bg-success">
                                                    <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold small" > <i class="bi bi-chat-left-text fs-1" style="font-size: 80px"></i> </span>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Card body -->
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="/" class="stretched-link">L' actualité</a></h5>
                                            <p class="mb-3">Nous diffusons de l'information en temps réel sur l'actualité togolaise et dans le monde. </p>
                                            <h6 class="mb-0"><i class="bi bi-patch-check text-primary me-2"></i>l'actualité vérifiée</h6>
                                        </div>

                                        <!-- Card footer -->
                                        <div class="card-footer pb-3 d-grid">
                                            <a href="/" class="btn btn-sm btn-dark mb-0">Voir nos articles</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Slider item END -->
                                <div>
                                    <div class="card border">
                                        <!-- Image -->
                                        <div class="position-relative">
                                            <div class=" card-img-top avatar mb-2" style="width: 100%; height: 180px">
                                                <div class="avatar-img bg-success">
                                                    <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold small" > <i class="bi bi-patch-question fs-1" style="font-size: 80px"></i> </span>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Card body -->
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="/" class="stretched-link">Les alert infos</a></h5>
                                            <p class="mb-3">Nous vous tenons au courant de toute information très urgent </p>

                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="card border">
                                        <!-- Image -->
                                        <div class="position-relative">
                                            <div class=" card-img-top avatar mb-2" style="width: 100%; height: 180px">
                                                <div class="avatar-img bg-success">
                                                    <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold small" > <i class="bi bi-camera-reels fs-1" style="font-size: 80px"></i> </span>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Card body -->
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="/videos" class="stretched-link">Les vidéos d'actualités</a></h5>
                                            <p class="mb-3">Nous partageons avec vous les vidéos d'actualité interessantes. </p>

                                        </div>

                                         <!-- Card footer -->
                                         <div class="card-footer pb-3 d-grid">
                                            <a href="/videos" class="btn btn-sm btn-dark mb-0">Voir nos vidéos</a>
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="card border">
                                        <!-- Image -->
                                        <div class="position-relative">
                                            <div class=" card-img-top avatar mb-2" style="width: 100%; height: 180px">
                                                <div class="avatar-img bg-success">
                                                    <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold small" > <i class="bi bi-chat-square fs-1" style="font-size: 80px"></i> </span>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Card body -->
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="/" class="stretched-link">Les annonces</a></h5>
                                            <p class="mb-3">Nous vous tenons informer de toutes les annonces importantes </p>

                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="card border">
                                        <!-- Image -->
                                        <div class="position-relative">
                                            <div class=" card-img-top avatar mb-2" style="width: 100%; height: 180px">
                                                <div class="avatar-img bg-success">
                                                    <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold small" > <i class="bi bi-chat-right-dots fs-1" style="font-size: 80px"></i> </span>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Card body -->
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="/evennements" class="stretched-link">Les évènnements</a></h5>
                                            <p class="mb-3">Restez au courant de tous les évènnements importants. </p>

                                        </div>

                                         <!-- Card footer -->
                                         <div class="card-footer pb-3 d-grid">
                                            <a href="/evennements" class="btn btn-sm btn-dark mb-0">Voir nos évènnements</a>
                                        </div>

                                    </div>
                                </div>
                                <div>
                                    <div class="card border">
                                        <!-- Image -->
                                        <div class="position-relative">
                                            <div class=" card-img-top avatar mb-2" style="width: 100%; height: 180px">
                                                <div class="avatar-img bg-success">
                                                    <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold small" > <i class="bi bi-ui-checks-grid fs-1" style="font-size: 80px"></i> </span>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Card body -->
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="/publicites" class="stretched-link">Les publicités</a></h5>
                                            <p class="mb-3">Nous diffusons aussi des publicités. </p>

                                        </div>

                                         <!-- Card footer -->
                                         <div class="card-footer pb-3 d-grid">
                                            <a href="/publicites" class="btn btn-sm btn-dark mb-0">Voir nos publicités</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =======================About END -->
    </main>

    @include('includes.footer')

@endsection
