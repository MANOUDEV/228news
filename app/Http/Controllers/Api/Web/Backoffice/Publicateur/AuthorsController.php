<?php

namespace App\Http\Controllers\Api\Web\Backoffice\Publicateur;
use App\Http\Controllers\Api\BaseController;
use App\Models\Author;
use App\Models\Publication;
use App\Models\Tag;
use App\Models\File;
use App\Models\TypePublication;
use App\Models\Category;
use App\Models\PublicationFile;
use App\Models\PublicationTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthorsController extends BaseController
{

    public function index(Request $request){

        if(auth()->user()->role_id === 2){

            $authorsCount = Author::where('user_id', auth()->user()->id)->orderBy('count_publications', 'desc')->count();

            if($authorsCount === 0){

                return $this->sendResponse(['status' => 401, 'authorsCount'=> $authorsCount], 'Aucun auteur n\'est enregistré.');

            }else{

                $authors = Author::query();

                if($request->input('search')){

                    $authors = Author::where('user_id', auth()->user()->id)
                    ->where('authors.authorName', 'like', '%'. $request->input('search') . '%')
                    ->where('authors.nom_complet', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('authors.count_publications', 'desc')
                    ->paginate(9);

                    $authorsCount = Author::where('user_id', auth()->user()->id)
                    ->where('authors.authorName', 'like', '%'. $request->input('search') . '%')
                    ->where('authors.nom_complet', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('authors.count_publications', 'desc')
                    ->count();

                    if($authorsCount === 0){

                        return $this->sendResponse(['status' => 401, 'authorsCount'=> $authorsCount], 'Aucun auteur ne correspond à votre recherche.');

                    }else{

                        return $this->sendResponse(['authors' => $authors, 'authorsCount'=> $authorsCount,'status' => 200], 'Liste des auteurs.');

                    }

                }else{

                    $authors = Author::where('user_id', auth()->user()->id)
                    ->orderBy('authors.count_publications', 'desc')
                    ->paginate(9);

                    $authorsCount = Author::where('user_id', auth()->user()->id)->count();

                    if($authorsCount === 0){

                        return $this->sendResponse(['status' => 401, 'authorsCount'=> $authorsCount], 'Aucun auteur n\'est enregistré.');

                    }else{

                        return $this->sendResponse(['authors' => $authors, 'authorsCount'=> $authorsCount,'status' => 200], 'Liste des auteurs.');

                    }

                }


            }

        }else{
            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');
        }

    }

    public function show(Request $request){

        $slug = $request->slug;

        if(auth()->user()->role_id === 2){

            $authorsCount = Author::where('user_id', auth()->user()->id)->where('slug', $slug)->count();

            if($authorsCount === 0){

                return $this->sendResponse(['status' => 401], 'Cet auteur n\'est pas enregistré.');

            }else{

                $author = Author::where('user_id', auth()->user()->id)->where('slug', $slug)->first();

                return $this->sendResponse(['author' => $author, 'authorsCount'=> $authorsCount,'status' => 200], 'Liste des auteurs.');

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

        if(auth()->user()->role_id === 2){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'nom' => ['required','string', 'max:255'],
                'prenoms' => ['required','string', 'max:255'],
                'email' => ['required','string', 'max:255', 'unique:authors'],
            ],[
                'required' => ':attribute est obligatoire.',
                'email.unique' => ':attribute est déjà enregistré.'
            ], [
                'nom' => 'Le nom',
                'prenoms' => 'Le prénom',
                'email' => 'L\'email',
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $datas['user_id'] = auth()->user()->id;

            $datas['date_publish'] = now();

            $datas['nom_complet'] = $datas['nom'].' '.$datas['prenoms'];

            if($datas['authorName']){

                if(strlen($datas['authorName']) < 4){

                    return $this->sendResponse(['status' => 422], 'Le non d\'auteur doit avoir 4 caractères minimum.');

                }

                $authorNameCheck = Author::where('authorName', $datas['authorName'])->first();

                if($authorNameCheck){

                    return $this->sendResponse(['status' => 422], 'Désolé ce nom d\'auteur est déjà utilisé.');

                }

            }else{

                $datas['authorName']= $datas['prenoms'];

            }

            $datas['slug'] = Str::slug($datas['authorName']);

            $authorCreateData = Author::create($datas);

            if($authorCreateData){

                return $this->sendResponse(['authorCreateData' => $authorCreateData, 'status' => 200], 'Auteur enregistré.');

            }else{

                return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cet auteur.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }


    public function update(Request $request, $slug){

        if(auth()->user()->role_id === 2){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'nom' => ['required','string', 'max:255'],
                'prenoms' => ['required','string', 'max:255'],
                'email' => ['required','string', 'max:255'],
            ],[
                'required' => ':attribute est obligatoire.',
                'email.unique' => ':attribute est déjà enregistré.'
            ], [
                'nom' => 'Le nom',
                'prenoms' => 'Le prénom',
                'email' => 'L\'email',
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $datas['user_id'] = auth()->user()->id;

            $datas['date_publish'] = now();

            $datas['nom_complet'] = $datas['nom'].' '.$datas['prenoms'];

            if($datas['authorName']){

                if(strlen($datas['authorName']) < 4){

                    return $this->sendResponse(['status' => 422], 'Le non d\'auteur doit avoir 4 caractères minimum.');

                }

                $authorNameCheck = Author::where('authorName', $datas['authorName'])->first();

                if($authorNameCheck){

                    return $this->sendResponse(['status' => 422], 'Désolé ce nom d\'auteur est déjà utilisé.');

                }

            }else{

                $datas['authorName']= $datas['prenoms'];

            }

            $datas['slug'] = Str::slug($datas['authorName']);

            $authorCheck = Author::where('user_id', auth()->user()->id)->where('slug', $slug)->first();

            if($authorCheck){

                if($authorCheck->user_id === auth()->user()->id){

                    $authorUpdateData = $authorCheck->update($datas);

                    if($authorUpdateData){

                        $articlesCheck = Publication::where('author_slug', $slug)->get();

                        foreach($articlesCheck as $articleCheck){

                            $articleCheck->author_slug =  $datas['slug'];

                            $articleCheck->author_name =  $datas['authorName'];

                            $articleCheck->update();
                        }

                        return $this->sendResponse(['authorUpdateData' => $authorUpdateData, 'status' => 200], 'Auteur modifié.');

                    }else{

                        return $this->sendResponse(['status' => 422], 'Impossible de modifier cet auteur.');

                    }

                }else{

                    return $this->sendResponse(['status' => 422], 'Désolé vous n\'êtes pas autorisé à modifier cet auteur.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Cet auteur est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function delete(Request $request,  $slug){

        if(auth()->user()->role_id === 2){

            $authorCheck = Author::where('user_id', auth()->user()->id)->where('slug', $slug)->first();

            if($authorCheck){

                if($authorCheck->user_id === auth()->user()->id){

                    $articlesCheck = Publication::where('author_slug', $slug)->get();

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
    
                        $typePublication = TypePublication::where('slug', $articleCheck->typePublication_slug)->first();
    
                        $typePublication->count_publications = $typePublication->count_publications - 1;
    
                        $typePublication->update();
    
                        $category = Category::where('slug', $articleCheck->category_slug)->first();
    
                        $category->count_publications = $category->count_publications - 1;
    
                        $category->update();
                        
                        $articleCheck->delete();
                    }


                    $authorDeleteData = $authorCheck->delete();

                    if($authorDeleteData){

                        return $this->sendResponse(['authorDeleteData' => $authorDeleteData, 'status' => 200], 'Auteur supprimé.');

                    }else{

                        return $this->sendResponse(['status' => 422], 'Impossible de supprimer cet auteur.');

                    }

                }else{

                    return $this->sendResponse(['status' => 422], 'Désolé vous n\'êtes pas autorisé à supprimer cet auteur.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Cet auteur est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function articlesPublish(){

    }
}
