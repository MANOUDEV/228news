<?php

namespace App\Http\Controllers\Api\Web\Backoffice\Admin;
use App\Http\Controllers\Api\BaseController;
use App\Models\Publication;
use App\Models\PublicationTag;
use App\Models\PublicationFile;
use App\Models\TypePublication;
use App\Models\Tag;
use App\Models\File;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TypePublicationController extends BaseController
{
   
    public function index(Request $request){

        if(auth()->user()->role_id === 1){

            $typePublicationCount = TypePublication::orderBy('count', 'desc')->count();

            if($typePublicationCount === 0){

                return $this->sendResponse(['status' => 401, 'typePublicationCount'=> $typePublicationCount], 'Aucun type de publication n\'est enregistré.');

            }else{

                $typePublications = TypePublication::query();

                if($request->input('search')){

                    $typePublications = TypePublication::where('type_publications.name', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('type_publications.count_publications', 'desc')
                    ->paginate(9);

                    $typePublicationCount = TypePublication::where('type_publications.name', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('type_publications.count_publications', 'desc')
                    ->count();

                    if($typePublicationCount === 0){

                        return $this->sendResponse(['status' => 401, 'typePublicationCount'=> $typePublicationCount], 'Aucun type de publication ne correspond à votre recherche.');
        
                    }else{

                        return $this->sendResponse(['typePublications' => $typePublications, 'typePublicationCount'=> $typePublicationCount,'status' => 200], 'Liste des types de publications.');

                    }

                }else{

                    $typePublications = TypePublication::orderBy('type_publications.count_publications', 'desc')->paginate(9);

                    $typePublicationCount = TypePublication::count();

                    if($typePublicationCount === 0){

                        return $this->sendResponse(['status' => 401, 'typePublicationCount'=> $typePublicationCount], 'Aucun type de publication n\'est enregistré.');
        
                    }else{

                        return $this->sendResponse(['typePublications' => $typePublications, 'typePublicationCount'=> $typePublicationCount,'status' => 200], 'Liste des types de publications.');

                    }

                }
 
            }

        }else{
            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');
        }

    }

    public function show(Request $request){

        $slug = $request->slug;

        if(auth()->user()->role_id === 1){

            $typePublicationCount = TypePublication::where('slug', $slug)->count();

            if($typePublicationCount === 0){

                return $this->sendResponse(['status' => 401], 'Aucun type de publication n\'est enregistré.');

            }else{

                $typePublication = TypePublication::where('slug', $slug)->first();

                return $this->sendResponse(['typePublication' => $typePublication, 'typePublicationCount'=> $typePublicationCount,'status' => 200], 'Liste des types de publications.');

            }

        }else{
            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        if(auth()->user()->role_id === 1){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'name' => ['required','string', 'max:255', 'unique:type_publications'],
            ],[
                'required' => 'Votre :attribute est obligatoire.',
                'name.unique' => 'Ce :attribute est déjà enregistré.',
            ], [
                'name' => 'type de publication',
            
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $datas['slug'] = Str::slug($datas['name']);

            $datas['user_id'] = auth()->user()->id;

            $datas['date_publish'] = now();

            $typePublicationCreateData = TypePublication::create($datas);

            if($typePublicationCreateData){

                return $this->sendResponse(['typePublicationCreateData' => $typePublicationCreateData, 'status' => 200], 'Type de publication enregistré.');

            }else{

                return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer ce type de publication.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }


    public function update(Request $request, $slug){

        if(auth()->user()->role_id === 1){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'name' => ['required','string', 'max:255', 'unique:type_publications'],
            ],[
                'required' => 'Votre :attribute est obligatoire.',
                'name.unique' => 'Ce :attribute est déjà enregistré.',
            ], [
                'name' => 'type de publication',
            
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $datas['slug'] = Str::slug($datas['name']);

            $datas['date_publish'] = now();

            $typePublicationCheck = TypePublication::where('slug', $slug)->first();


            if($typePublicationCheck){

                $typePublicationUpdateData = $typePublicationCheck->update($datas);

                if($typePublicationUpdateData){

                    $articlesCheck = Publication::where('type_publication_slug', $slug)->get();

                    foreach($articlesCheck as $articleCheck){

                        $articleCheck->type_publication_slug =  $datas['slug'];

                        $articleCheck->type_publication_name =  $datas['name'];

                        $articleCheck->update();
                    }

                    return $this->sendResponse(['typePublicationUpdateData' => $typePublicationUpdateData, 'status' => 200], 'Type de publication modifié.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de modifier ce type de publication.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Ce type de publication est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function delete(Request $request,  $slug){

        if(auth()->user()->role_id === 1){

            $typePublicationCheck = TypePublication::where('slug', $slug)->first();

            if($typePublicationCheck){

                $articlesCheck = Publication::where('type_publication_slug', $slug)->get();

                foreach($articlesCheck as $articleCheck){

                    $articleTagsChecks = PublicationTag::where('publication_id', $articleCheck->id)->get();

                    $articleFilesChecks = PublicationFile::where('publication_id', $articleCheck->id)->get();

                    foreach($articleTagsChecks as $articleTagCheck){

                        $tag = Tag::where('id', $articleTagCheck->tag_id)->first();

                        $tag->count_publications = $tag->count_publications - 1;

                        $tag->update();

                        $articleTagCheck->delete();

                    }

                    foreach($articleFilesChecks as $articleFileCheck){

                        $file = File::where('id', $articleFileCheck->file_id)->first();

                        $file->count_publications = $file->count_publications - 1;

                        $file->update();

                        $articleFileCheck->delete();

                    }

                    $category = Category::where('slug', $articleCheck->category_slug)->first();

                    $category->count_publications = $category->count_publications - 1;

                    $category->update();

                    $author = Author::where('slug', $articleCheck->author_slug)->first();
    
                    $author->count_publications = $author->count_publications - 1;

                    $author->update();
                    
                    $articleCheck->delete();
                }

                $typePublicationDeleteData = $typePublicationCheck->delete();

                if($typePublicationDeleteData){

                    return $this->sendResponse(['type_publicationDeleteData' => $typePublicationDeleteData, 'status' => 200], 'Type de publication supprimé.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de supprimer ce type de publication.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Ce type de publication est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function articlesPublish(){

    }
}
