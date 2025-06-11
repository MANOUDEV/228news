<?php

namespace App\Http\Controllers\Api\Web\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
class WebRouteController extends Controller
{
    public function administrateur(){

        SEOMeta::setTitle('Administration | Togo actualité');
        SEOMeta::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        SEOMeta::setCanonical('https://actualitetogo.com/auth/register');

        OpenGraph::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        OpenGraph::setTitle('Administration | Togo actualité');
        OpenGraph::setUrl('https://actualitetogo.com/auth/register');
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage("https://actualitetogo.com/assets/images/Icone.png");

        TwitterCard::setTitle('Administration | Togo actualité');
        TwitterCard::setSite('@Togoactualite');

        JsonLd::setTitle('Administration | Togo actualité');
        JsonLd::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        JsonLd::addImage('https://actualitetogo.com/assets/images/Icone.png');

        return view('backoffice.administrateur');

    }

    public function publicateur(){

        SEOMeta::setTitle('Administration | Togo actualité');
        SEOMeta::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        SEOMeta::setCanonical('https://actualitetogo.com/auth/register');

        OpenGraph::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        OpenGraph::setTitle('Administration | Togo actualité');
        OpenGraph::setUrl('https://actualitetogo.com/auth/register');
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage("https://actualitetogo.com/assets/images/Icone.png");

        TwitterCard::setTitle('Administration | Togo actualité');
        TwitterCard::setSite('@Togoactualite');

        JsonLd::setTitle('Administration | Togo actualité');
        JsonLd::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        JsonLd::addImage('https://actualitetogo.com/assets/images/Icone.png');

        return view('backoffice.publicateur');

    }
}
