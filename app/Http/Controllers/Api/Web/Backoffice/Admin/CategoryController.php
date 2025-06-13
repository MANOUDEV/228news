<?php

namespace App\Http\Controllers\Api\Web\Backoffice\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Models\Publication;
use App\Models\File;
use App\Models\Author;
use App\Models\TypePublication;
use App\Models\PublicationTag;
use App\Models\PublicationFile;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
   
    public function index(Request $request){

        if(auth()->user()->role_id === 1){

            $categoryCount = Category::orderBy('count_publications', 'desc')->count();

            if($categoryCount === 0){

                return $this->sendResponse(['status' => 401, 'categoryCount'=> $categoryCount], 'Aucune catégorie n\'est enregistrée.');

            }else{

                $categories = Category::query();

                if($request->input('search')){

                    $categories = Category::where('categories.name', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('categories.count_publications', 'desc')
                    ->paginate(9);

                    $categoryCount = Category::where('categories.name', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('categories.count_publications', 'desc')
                    ->count();

                    if($categoryCount === 0){

                        return $this->sendResponse(['status' => 401, 'categoryCount'=> $categoryCount], 'Aucune catégorie ne correspond à votre recherche.');
        
                    }else{

                        return $this->sendResponse(['categories' => $categories, 'categoryCount'=> $categoryCount,'status' => 200], 'Liste des catégories.');

                    }

                }else{

                    $categories = Category::orderBy('categories.count_publications', 'desc')->paginate(9);

                    $categoryCount = Category::count();

                    if($categoryCount === 0){

                        return $this->sendResponse(['status' => 401, 'categoryCount'=> $categoryCount], 'Aucune catégorie n\'est enregistrée.');
        
                    }else{

                        return $this->sendResponse(['categories' => $categories, 'categoryCount'=> $categoryCount,'status' => 200], 'Liste des catégories.');

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

            $categoryCount = Category::where('slug', $slug)->count();

            if($categoryCount === 0){

                return $this->sendResponse(['status' => 401], 'Aucune catégorie n\'est enregistrée.');

            }else{

                $category = Category::where('slug', $slug)->first();

                return $this->sendResponse(['category' => $category, 'categoryCount'=> $categoryCount,'status' => 200], 'Liste des catégories.');

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
                'name' => ['required','string', 'max:255', 'unique:categories'],
            ],[
                'required' => 'Votre :attribute est obligatoire.',
                'name.unique' => 'Cette :attribute est déjà enregistrée.'
            ], [
                'name' => 'catégorie',
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $datas['slug'] = Str::slug($datas['name']);

            $datas['user_id'] = auth()->user()->id;

            $datas['date_publish'] = now();

            $categoryCreateData = Category::create($datas);

            if($categoryCreateData){

                return $this->sendResponse(['categoryCreateData' => $categoryCreateData, 'status' => 200], 'Catégorie enregistrée.');

            }else{

                return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cette catégorie.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }


    public function update(Request $request, $slug){

        if(auth()->user()->role_id === 1){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'name' => ['required','string', 'max:255', 'unique:categories'],
            ],[
                'required' => 'Votre :attribute est obligatoire.',
                'name.unique' => 'Cette :attribute est déjà enregistrée.'
            ], [
                'name' => 'catégorie',
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $datas['slug'] = Str::slug($datas['name']);

            $datas['date_publish'] = now();

            $categoryCheck = Category::where('slug', $slug)->first();


            if($categoryCheck){

                $categoryUpdateData = $categoryCheck->update($datas);

                if($categoryUpdateData){

                    $articlesCheck = Publication::where('category_slug', $slug)->get();

                    foreach($articlesCheck as $articleCheck){

                        $articleCheck->category_slug =  $datas['slug'];

                        $articleCheck->category_name =  $datas['name'];

                        $articleCheck->update();
                    }

                    return $this->sendResponse(['categoryUpdateData' => $categoryUpdateData, 'status' => 200], 'Catégorie modifiée.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de modifier cette catégorie.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Cette catégorie est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function delete(Request $request,  $slug){

        if(auth()->user()->role_id === 1){

            $categoryCheck = Category::where('slug', $slug)->first();

            if($categoryCheck){

                $articlesCheck = Publication::where('category_slug', $slug)->get();
 
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

                    $author = Author::where('slug', $articleCheck->author_slug)->first();

                    $author->count_publications = $author->count_publications - 1;

                    $author->update();
                    
                    $articleCheck->delete();
                }

                
                $categoryDeleteData = $categoryCheck->delete();

                if($categoryDeleteData){

                    return $this->sendResponse(['categoryDeleteData' => $categoryDeleteData, 'status' => 200], 'Catégorie supprimée.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de supprimer cette catégorie.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Cette catégorie est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function articlesPublish(){

    }
}
