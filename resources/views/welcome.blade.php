@extends('layouts.base')

@section('title') Accueil @endsection

@section('content')

    @include('includes.header')

    <main>

        <section class="position-relative" style="margin-top: -45px; margin-bottom: -25px">

            @include('sectionHomePage.alaUne.alaUne')

            @include('sectionHomePage.toutelActualite.toutelActualite')

            @include('sectionHomePage.togoPolitique.togoPolitique')

            @include('sectionHomePage.international.international')

            @include('sectionHomePage.important.important')

            @include('sectionHomePage.opinionFaitsDivers.opinionFaitsDivers')

            @include('sectionHomePage.societe.societe')

            @include('sectionHomePage.aNePasManquerTogo.aNePasManquerTogo')

        </section>

        @include('includes.newletter')
    </main>
    @include('includes.footer')

@endsection
