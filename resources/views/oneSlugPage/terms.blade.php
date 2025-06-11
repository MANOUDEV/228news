@extends('layouts.base')

@section('title') Conditions d'utilisations @endsection

@section('content')

    @include('includes.header')

    <main style="margin-top: -30px">
        <section class="position-relative">
            <div class="container" data-sticky-container>
                
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h1 class="display-4"> Conditions d'utilisations</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-dots">
                                    <li class="breadcrumb-item"><a href="/"><i class="bi bi-house me-1"></i>Accueil</a></li>
                                    <li class="breadcrumb-item"><a href="#">Conditions d'utilisations</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>

    @include('includes.footer')

@endsection