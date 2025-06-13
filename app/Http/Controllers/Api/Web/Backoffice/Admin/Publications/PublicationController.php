<?php

namespace App\Http\Controllers\Api\Web\Backoffice\Admin\Publications;

use App\Http\Controllers\Api\BaseController; 
use App\Models\TypePublication;
use App\Models\Publication;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Author; 
use App\Models\PushSubscription;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush; 
use Illuminate\Http\Request; 
class PublicationController extends BaseController
{
    public function stripTags($post_content){

        $content = strip_tags($post_content); 

        return $content;

    }
    
    public function publicationCreateBySlugType(Request $request){

        $slug = $request->slug;

        if(auth()->user()->role_id === 1){

            $typePublicationCount = TypePublication::where('slug', $slug)->count();

            if($typePublicationCount === 0){

                return $this->sendResponse(['status' => 401], 'Le formulaire de ce type de publication n\'est pas disponible .');

            }else{

                $categoryCount = Category::orderBy('count_publications', 'desc')->count();

                if($categoryCount === 0){

                    return $this->sendResponse(['status' => 401, 'categoryCount'=> $categoryCount], 'Aucune catégorie n\'est enregistrée.');

                }else{

                    $authorsCount = Author::orderBy('count_publications', 'desc')->count();

                    if($authorsCount === 0){

                        return $this->sendResponse(['status' => 401, 'authorsCount'=> $authorsCount], 'Aucun auteur n\'est enregistré.');

                    }else{

                        $categories = Category::orderBy('categories.count_publications', 'desc')->get();

                        $tags = Tag::orderBy('tags.count_publications', 'desc')->get();

                        $authors = Author::orderBy('authors.count_publications', 'desc')->get();

                        $typePublication = TypePublication::where('slug', $slug)->first();

                        return $this->sendResponse(['typePublication' => $typePublication,'tags' => $tags, 'categories' => $categories,'authors' => $authors ,'typePublicationCount'=> $typePublicationCount,'status' => 200], 'Liste des types de publications.');

                    }

                }

            }

        }else{
            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');
        }

    }

    public function changeStatusPublicationPrgramm(){

        $publicationCount = Publication::where('presently', 1)->count();

        if($publicationCount !== 0){

            $publications = Publication::where('status', 2)->where('presently', 1)->get();

            foreach($publications as $publication){

                if($publication->date_publish <= now()){

                    $publication->status = 1;
                    
                    $publication->update();

                    if($publication->status == 1){

                        if($publication->type_publication_id == 2 || $publication->type_publication_id == 3){

                             

                        }else{

                            

                        }
                    }

                }

            }

            $publicationsH = Publication::where('status', 1)->where('presently', 1)->get();

            foreach($publicationsH as $publication){

                if($publication->date_publish_end <= now()){

                    $publication->status = 4;

                    $publication->update();

                }

            }

            return $this->sendResponse(['status' => 200], 'Changement de status effectué.');

        }else{

            return $this->sendResponse(['status' => 422], 'Erreur de changment de status.');

        }
    }     
}
