<?php
namespace App\Http\Controllers\Api\Web\Frontoffice;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Models\Publication;
use App\Models\Tag;

class HomeController extends BaseController
{
    public function home(){

        $articles_count = Publication::where('status', 1)->count();

        if($articles_count === 0){

            return view('errors.HomePageControlEmpty');

        }else{

            $annonces = Publication::where('status', 1)->where("publications.type_publication_id", 3)->get();

            $tendances =  Publication::where('status', 1)->where("publications.type_publication_id", 1)->where("publications.deja_citer", 0)->orderBy('views_count', 'desc')->take(4)->get();

            $alaUne =  Publication::where('status', 1)->where("publications.type_publication_id", 1)->where("publications.deja_citer", 0)->orderBy('date_publish', 'desc')->take(23)->get();

            $togoActualite = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 34)
                ->orWhere("category_id", 1)
                ->orWhere("category_id", 2)
                ->orWhere("category_id", 26)
                ->orWhere("category_id", 33);
            })->orderBy('date_publish', 'desc')
            ->take(12)
            ->get();

            return view('welcome', ['annonces' => $annonces, 'tendances' => $tendances, 'alaUne' => $alaUne, 'togoActualite' => $togoActualite]);

        }
    }

     public function togoPolitiqueDataRequest()
    {

        $politiqueFirst = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 26)
        ->orderBy('date_publish', 'desc')
        ->take(8)
        ->get();

        $politiqueTwo = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 26)
        ->where("id", '!=',$politiqueFirst[0]->id)
        ->where("id", '!=',$politiqueFirst[1]->id)
        ->where("id", '!=',$politiqueFirst[2]->id)
        ->where("id", '!=',$politiqueFirst[3]->id)
        ->where("id", '!=',$politiqueFirst[4]->id)
        ->where("id", '!=',$politiqueFirst[5]->id)
        ->where("id", '!=',$politiqueFirst[6]->id)
        ->where("id", '!=',$politiqueFirst[7]->id)
        ->orderBy('date_publish', 'desc')
        ->take(1)
        ->get();

        $politiqueThree = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 26)
        ->where("id", '!=',$politiqueFirst[0]->id)
        ->where("id", '!=',$politiqueFirst[1]->id)
        ->where("id", '!=',$politiqueFirst[2]->id)
        ->where("id", '!=',$politiqueFirst[3]->id)
        ->where("id", '!=',$politiqueFirst[4]->id)
        ->where("id", '!=',$politiqueFirst[5]->id)
        ->where("id", '!=',$politiqueFirst[6]->id)
        ->where("id", '!=',$politiqueFirst[7]->id)
        ->where("id", '!=',$politiqueTwo[0]->id)
        ->orderBy('date_publish', 'desc')
        ->take(8)
        ->get();

        $populars = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->whereDate('date_publish', '>', '2022-12-31')
        ->orderBy('views_count', 'desc')
        ->take(3)
        ->get();



        $categories = Category::orderBy('count_publications', 'desc')->take(6)->get();

        return $this->sendResponse([
            'politiqueFirst' =>  $politiqueFirst,
            'politiqueTwo' =>  $politiqueTwo,
            'politiqueThree' =>  $politiqueThree,
            'categories' =>  $categories,
            'populars' =>  $populars,
            'status' => 200
        ], 'Liste des articles publiés sur togo politique.');

    }
    
    public function InternationalFenetreSurLAfriqueSportsDataRequest(){

        $internationalFirst = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 3)
        ->orderBy('date_publish', 'desc')
        ->take(8)
        ->get();

        $internationalTwo = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 3)
        ->where("id", '!=',$internationalFirst[0]->id)
        ->where("id", '!=',$internationalFirst[1]->id)
        ->where("id", '!=',$internationalFirst[2]->id)
        ->where("id", '!=',$internationalFirst[3]->id)
        ->where("id", '!=',$internationalFirst[4]->id)
        ->where("id", '!=',$internationalFirst[5]->id)
        ->where("id", '!=',$internationalFirst[6]->id)
        ->where("id", '!=',$internationalFirst[7]->id)
        ->orderBy('date_publish', 'desc')
        ->take(1)
        ->get();



        $diaspora = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 23)
        ->orderBy('date_publish', 'desc')
        ->take(9)
        ->get();

        $editorial =  Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 9)
        ->orderBy('date_publish', 'desc')
        ->take(9)
        ->get();

        $sports = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 11)
        ->orderBy('date_publish', 'desc')
        ->take(8)
        ->get();

        return $this->sendResponse([
            'internationalFirst' =>  $internationalFirst,
            'internationalTwo' =>  $internationalTwo,
            'sports' =>  $sports,
            'diaspora' =>  $diaspora,
            'editorial' =>  $editorial,
            'status' => 200
        ], 'Liste des articles publiés sur international.');

    }

     public function societeDataRequest(){

        $societe = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", "=", 6)
        ->orderBy('date_publish', 'desc')
        ->take(6)
        ->get();

        $societeLoad = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", "=", 6)
        ->where("id", '!=',$societe[0]->id)
        ->where("id", '!=',$societe[1]->id)
        ->where("id", '!=',$societe[2]->id)
        ->where("id", '!=',$societe[3]->id)
        ->where("id", '!=',$societe[4]->id)
        ->where("id", '!=',$societe[5]->id)
        ->orderBy('date_publish', 'desc')
        ->take(6)
        ->get();

        $populars = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->whereDate('date_publish', '>', '2024-12-31')
        ->orderBy('likes_count', 'desc')
        ->take(5)
        ->get();

        $tags = Tag::orderBy('tags.count_publications', 'desc')->take(5)->get();

        return $this->sendResponse([
            'status' => 200,
            'societe' => $societe,
            'populars' => $populars,
            'societeLoad' => $societeLoad,
            'tags' => $tags,
        ], 'Toute l\'actualité');

    }

    public function aNePasManquerTogoDataRequest()
    {

        $anepasmanquer = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 20)
        ->orderBy('date_publish', 'desc')
        ->take(8)
        ->get();

        return $this->sendResponse([
            'anepasmanquer' =>  $anepasmanquer,
            'status' => 200
        ], 'Liste des articles publiés sur a ne pas rater togo.');

    }

     public function opinionFaitsDiversDataRequest()
    {

        $opinion = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 25)
        ->orderBy('date_publish', 'desc')
        ->take(8)
        ->get();

        $faitsDivers = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", 14)
        ->orderBy('date_publish', 'desc')
        ->take(8)
        ->get();

        return $this->sendResponse([
            'opinion' =>  $opinion,
            'faitsDivers' =>  $faitsDivers,
            'status' => 200
        ], 'Liste des articles publiés sur les opinions et faits divers.');

    }

    public function importantDataRequest(){

        $importantFirst = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("category_id", "=", 26)
        ->orderBy('date_publish', 'desc')
        ->take(4)
        ->get();

        $importantTwo = Publication::where("status", 1)
        ->where("publications.type_publication_id", 1)
        ->where("id", '!=',$importantFirst[0]->id)
        ->where("id", '!=',$importantFirst[1]->id)
        ->where("id", '!=',$importantFirst[2]->id)
        ->where("id", '!=',$importantFirst[3]->id)
        ->where("category_id", "=", 26)
        ->orderBy('date_publish', 'desc')
        ->take(4)
        ->get();

        return $this->sendResponse([
            'status' => 200,
            'importantFirst' => $importantFirst,
            'importantTwo' => $importantTwo,
        ], 'Les articles publiés sur Important');

    }
    
}