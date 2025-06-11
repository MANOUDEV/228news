@extends('layouts.base')

@section('title') Accueil @endsection

@section('content')

    @include('includes.header')

    <main>

        <section class="position-relative" style="margin-top: -45px; margin-bottom: -25px">

            @include('sectionHomePage.alaUne.alaUne')

            @include('sectionHomePage.toutelActualite.toutelActualite')

        </section>

        @include('includes.newletter')
    </main>
    @include('includes.footer')

@endsection
