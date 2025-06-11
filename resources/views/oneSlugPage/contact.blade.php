@extends('layouts.base')

@section('title') Contact @endsection

@section('content')

    @include('includes.header')

    <main style="margin-top: -30px">
        <section>
            <div class="container">
                <div class="row"> 
                    <div class="col-md-9 mx-auto text-center">
                          
                        <h1 class="display-4">Contactez-nous</h1>
                        <!-- breadcrumb -->
                        <nav class="d-flex justify-content-center" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-dots mb-0">
                            <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house me-1"></i>Accueil</a></li>
                            <li class="breadcrumb-item active">contactez-nous</li>
                        </ol>
                        </nav>
                        
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto"> 
                        
                        <div class="row mt-2">
                            <div class="col-sm-12 mb-sm-0">
                                <h3>Publicités / Annonces</h3>
                                <p>Contactez-nous directement pour toutes vos publictés et annonces</p>
                                <p>Téléphone <a href="tel:+330614305786" class="text-reset"><u> +33 06 14 30 57 86</u></a>, <a href="tel:+22899565788" class="text-reset"><u>+228 99 56 57 88</u></a></p>
                                <p>Email: <a href="#" class="text-reset"><u>contact@togoactualite.com</u></a></p>
                                <p>Temps d'assistance: Lundi à Vendredi de  9:30 à 18:30</p>
                            </div>
                        </div>
                        <hr class="my-5">
                        <contact></contact>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('includes.footer')

@endsection
