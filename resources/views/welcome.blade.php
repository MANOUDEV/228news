@extends('layouts.base')

@section('title') Accueil @endsection

@section('content')

    @include('includes.header')

    <main>

        <section class="position-relative" style="margin-top: -45px; margin-bottom: -25px">

            @include('adsense.google-ads.ads-sections-home-page')

            @include('sectionHomePage.alaUne.alaUne')

             @include('adsense.google-ads.ads-sections-home-page')

            @include('sectionHomePage.toutelActualite.toutelActualite')

            @include('adsense.google-ads.ads-sections-home-page')

            @include('sectionHomePage.togoPolitique.togoPolitique')

            @include('adsense.google-ads.ads-sections-home-page')

            @include('sectionHomePage.international.international')

            @include('adsense.google-ads.ads-sections-home-page')

            @include('sectionHomePage.important.important')

             @include('adsense.google-ads.ads-sections-home-page')

            @include('sectionHomePage.opinionFaitsDivers.opinionFaitsDivers')

             @include('adsense.google-ads.ads-sections-home-page')

            @include('sectionHomePage.societe.societe')

             @include('adsense.google-ads.ads-sections-home-page')

            @include('sectionHomePage.aNePasManquerTogo.aNePasManquerTogo')

             @include('adsense.google-ads.ads-sections-home-page')

        </section>

        @include('includes.newletter')
    </main>
    @include('includes.footer')

@endsection
