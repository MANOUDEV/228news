<?php

namespace App\Http\Controllers\Api\Web\Backoffice\Admin;
use App\Http\Controllers\Api\BaseController;
use App\Models\PublicationTag;
use App\Models\Tag;
use App\Models\InfosMonthYear;
use App\Models\InfosMonthYearTag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TagsAdminController extends BaseController
{

    public function searchByDate(){

        if(auth()->user()->role_id === 1){

            $infosMonthYearTagsCount = InfosMonthYearTag::orderBy('id', 'desc')->count();

            if($infosMonthYearTagsCount === 0){

                return $this->sendResponse(['status' => 401, 'infosMonthYearTagsCount'=> $infosMonthYearTagsCount], 'Aucune recherche n\'est enregistrée.');

            }else{

                $infosMonthYearTags = InfosMonthYearTag::where('deja_citer', 0)->orderBy('id', 'desc')->get();

                $users = User::where('status', 1)->get();

                return $this->sendResponse(['status' => 200, 'infosMonthYearTags'=> $infosMonthYearTags, 'users' => $users], 'Aucune recherche n\'est enregistrée.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }
    }

    public function searchByUserInfos(Request $request){

        if(auth()->user()->role_id === 1){

            $tagsCount = Tag::orderBy('count_publications', 'desc')->count();

            if($tagsCount === 0){

                return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag n\'est enregistré.');

            }else{

                $tags = Tag::query();

                if($request->input('user_id') != 0){

                    $tags = Tag::where('tags.user_id', $request->input('user_id'))
                    ->orderBy('tags.count_publications', 'desc')
                    ->paginate(9);

                    $tagsCount = Tag::where('tags.user_id', $request->input('user_id'))
                    ->count();

                    if($tagsCount === 0){

                        return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag ne correspond à votre recherche.');
        
                    }else{

                        return $this->sendResponse(['tags' => $tags, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');
                    }

                }else{

                    $tags = Tag::orderBy('tags.count_publications', 'desc')
                    ->paginate(9);

                    $tagsCount = Tag::count();

                    if($tagsCount === 0){

                        return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag n\'enregistré.');
        
                    }else{

                        return $this->sendResponse(['tags' => $tags, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');
                    }

                }

            }

        }else{
            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');
        }

    }

    public function searchByDateInfos(Request $request){

        if(auth()->user()->role_id === 1){

            $tagsCount = Tag::orderBy('count_publications', 'desc')->count();

            if($tagsCount === 0){

                return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag n\'est enregistré.');

            }else{

                $tags = Tag::query();

                if($request->input('searchH') != "ALL"){

                    $tags = Tag::where('tags.date_name', $request->input('searchH'))
                    ->orderBy('tags.count_publications', 'desc')
                    ->paginate(9);

                    $tagsCount = Tag::count();

                    if($tagsCount === 0){

                        return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag ne correspond à votre recherche.');

                    }else{

                        return $this->sendResponse(['tags' => $tags, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');
                    }

                }else{

                    if($request->input('searchH') == "ALL"){

                        $tags = Tag::where('tags.date_name_default', $request->input('searchH'))
                        ->orderBy('tags.count_publications', 'desc')
                        ->paginate(9);

                        $tagsCount = Tag::count();

                        if($tagsCount === 0){

                            return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag ne correspond à votre recherche.');

                        }else{

                            return $this->sendResponse(['tags' => $tags, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');
                        }

                    }else{

                        $tags = Tag::orderBy('tags.count_publications', 'desc')
                        ->paginate(9);


                        $tagsCount = Tag::count();

                        if($tagsCount === 0){

                            return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag n\'est enregistré.');

                        }else{

                            return $this->sendResponse(['tags' => $tags, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');
                        }
                    }

                }


                return $this->sendResponse(['tags' => $tags, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');

            }

        }else{
            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');
        }

    }

    public function index(Request $request){

        if(auth()->user()->role_id === 1){

            $tagsCount = Tag::orderBy('count_publications', 'desc')->count();

            if($tagsCount === 0){

                return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag n\'est enregistré.');

            }else{

                $tags = Tag::query();

                if($request->input('search')){

                    $tags = Tag::where('tags.name', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('tags.count_publications', 'desc')
                    ->paginate(9);

                    $tagsCount = Tag::where('tags.name', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('tags.count_publications', 'desc')
                    ->count();

                    if($tagsCount === 0){

                        return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag ne correspond à votre recherche.');

                    }else{

                        return $this->sendResponse(['tags' => $tags, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');
                    }

                }else{

                    $tags = Tag::orderBy('tags.count_publications', 'desc')
                    ->paginate(9);

                    $tagsCount = Tag::count();

                    if($tagsCount === 0){

                        return $this->sendResponse(['status' => 401, 'tagsCount'=> $tagsCount], 'Aucun tag n\'est enregistré.');

                    }else{

                        return $this->sendResponse(['tags' => $tags, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');
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

            $tagsCount = Tag::where('slug', $slug)->count();

            if($tagsCount === 0){

                return $this->sendResponse(['status' => 401], 'Aucun tag n\'est enregistré.');

            }else{

                $tag = Tag::where('slug', $slug)->first();

                return $this->sendResponse(['tag' => $tag, 'tagsCount'=> $tagsCount,'status' => 200], 'Liste des tags.');

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
                'name' => ['required','string', 'max:255', 'unique:tags'],
            ],[
                'required' => 'Ce :attribute est obligatoire.',
                'name.unique' => 'Ce :attribute est déjà enregistrée.'
            ], [
                'name' => 'tag',
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $date = Carbon::parse(now());

            $mois_id = $date->format('m');

            $year = $date->format('Y');

            $mois = InfosMonthYear::where('month_id', $mois_id)->first();

            $date_name = $mois->month.' '.$year;

            $verify_date_name = InfosMonthYearTag::where('date_name', $date_name)->first();

            if(!$verify_date_name){

                InfosMonthYearTag::create(['date_name' => $date_name, 'deja_citer' => 0, 'user_id' => auth()->user()->id]);

            }else{

                if($verify_date_name->deja_citer === 0){

                    InfosMonthYearTag::create(['date_name' => $date_name, 'deja_citer' => 1, 'user_id' => auth()->user()->id]);

                }

            }

            $datas['date_name'] = $date_name;

            $datas['slug'] = Str::slug($datas['name']);

            $datas['user_id'] = auth()->user()->id;

            $datas['date_publish'] = now();

            $tagCreateData = Tag::create($datas);

            if($tagCreateData){

                return $this->sendResponse(['tagCreateData' => $tagCreateData, 'status' => 200], 'Tag enregistré.');

            }else{

                return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer ce tag.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }


    public function update(Request $request, $slug){

        if(auth()->user()->role_id === 1){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'name' => ['required','string', 'max:255', 'unique:tags'],
            ],[
                'required' => 'Ce :attribute est obligatoire.',
                'name.unique' => 'Ce :attribute est déjà enregistrée.'
            ], [
                'name' => 'tag',
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $datas['slug'] = Str::slug($datas['name']);

            $datas['user_id'] = auth()->user()->id;

            $tagCheck = Tag::where('slug', $slug)->first();

            if($tagCheck){

                $tagUpdateData = $tagCheck->update($datas);

                if($tagUpdateData){

                    return $this->sendResponse(['tagUpdateData' => $tagUpdateData, 'status' => 200], 'Tag modifié.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de modifier ce tag.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Ce tag est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function delete(Request $request,  $slug){

        if(auth()->user()->role_id === 1){

            $tagCheck = Tag::where('slug', $slug)->first();

            if($tagCheck){

                $articleTagsChecks = PublicationTag::where('tag_id', $tagCheck->tag_id)->get();

                foreach($articleTagsChecks as $articleTagCheck){

                    $articleTagCheck->delete();

                }

                $tagDeleteData = $tagCheck->delete();

                if($tagDeleteData){

                    return $this->sendResponse(['tagDeleteData' => $tagDeleteData, 'status' => 200], 'Tag supprimé.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de supprimer ce tag.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Ce tag est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function articlesPublish(){

    }
}
