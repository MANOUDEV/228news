<?php

namespace App\Http\Controllers\Api\Web\Backoffice\Admin;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsLetterController extends BaseController
{
    
    public function index(Request $request){

        if(auth()->user()->role_id === 1){

            $newsLettersCount = NewsLetter::orderBy('count', 'desc')->count();

            if($newsLettersCount === 0){

                return $this->sendResponse(['status' => 401, 'newsLettersCount'=> $newsLettersCount], 'Aucun abonné n\'est enregistré.');

            }else{

                $newsLetters = NewsLetter::query();

                if($request->input('search')){

                    $newsLetters = NewsLetter::where('news_letters.email', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('news_letters.count_publications', 'desc')
                    ->paginate(9);

                    $newsLettersCount = NewsLetter::where('news_letters.email', 'like', '%'. $request->input('search') . '%')
                    ->orderBy('news_letters.count_publications', 'desc')
                    ->count();

                    if($newsLettersCount === 0){

                        return $this->sendResponse(['status' => 401, 'newsLettersCount'=> $newsLettersCount], 'Aucun abonné ne correspond à votre recherche.');
        
                    }else{

                        return $this->sendResponse(['newsLetters' => $newsLetters, 'newsLettersCount'=> $newsLettersCount,'status' => 200], 'Liste des abonnés à la newsletter .');

                    }

                }else{

                    $newsLetters = NewsLetter::orderBy('news_letters.count_publications', 'desc')
                    ->paginate(9);

                    $newsLettersCount = NewsLetter::count();

                    if($newsLettersCount === 0){

                        return $this->sendResponse(['status' => 401, 'newsLettersCount'=> $newsLettersCount], 'Aucun abonné n\'est enregistré.');
        
                    }else{

                        return $this->sendResponse(['newsLetters' => $newsLetters, 'newsLettersCount'=> $newsLettersCount,'status' => 200], 'Liste des abonnés à la newsletter .');

                    }

                }

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function searchByStatus($status){

        if(auth()->user()->role_id === 1){

            $newsLettersCount = NewsLetter::orderBy('count', 'desc')->count();

            if($newsLettersCount === 0){

                return $this->sendResponse(['status' => 401, 'newsLettersCount'=> $newsLettersCount], 'Aucun abonné n\'est enregistré.');

            }else{

                $newsLetters = NewsLetter::query();

                if($status == 3){
 
                    $newsLetters = NewsLetter::orderBy('news_letters.count_publications', 'desc')
                    ->paginate(9);

                    $newsLettersCount = NewsLetter::count();

                    if($newsLettersCount === 0){

                        return $this->sendResponse(['status' => 401, 'newsLettersCount'=> $newsLettersCount], 'Aucun abonné n\'est enregistré.');
        
                    }else{

                        return $this->sendResponse(['newsLetters' => $newsLetters, 'newsLettersCount'=> $newsLettersCount,'status' => 200], 'Liste des abonnés à la newsletter .');

                    }

                }else{
                    
                    $newsLetters = NewsLetter::where('news_letters.status', $status)
                    ->orderBy('news_letters.count_publications', 'desc')
                    ->paginate(9);

                    $newsLettersCount = NewsLetter::where('news_letters.status', $status)
                    ->orderBy('news_letters.count_publications', 'desc')
                    ->count();

                    if($newsLettersCount === 0){

                        return $this->sendResponse(['status' => 401, 'newsLettersCount'=> $newsLettersCount], 'Aucun abonné ne correspond à votre recherche.');
        
                    }else{

                        return $this->sendResponse(['newsLetters' => $newsLetters, 'newsLettersCount'=> $newsLettersCount,'status' => 200], 'Liste des abonnés à la newsletter .');

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

            $newsLettersCount = NewsLetter::where('slug', $slug)->count();

            if($newsLettersCount === 0){

                return $this->sendResponse(['status' => 401], 'Aucun abonné n\'est enregistré.');

            }else{

                $newsLetter = NewsLetter::where('slug', $slug)->first();

                return $this->sendResponse(['newsLetter' => $newsLetter, 'newsLettersCount'=> $newsLettersCount,'status' => 200], 'Liste des abonnés à la newsletter.');

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
                'email' => ['required','string', 'email', 'max:255', 'unique:news_letters'],
            ],[
                'required' => 'Votre :attribute est obligatoire.',
                'email.unique' => 'Cet :attribute est déjà enregistré.'
            ], [
                'email' => 'email',
            ]);
    
            if ($validator->fails()) {
    
                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');
    
            }
    
            $datas['slug'] = Str::slug($datas['email']);

            $datas['date_publish'] = now();
    
            $message = NewsLetter::create($datas);
    
            if($message){
    
                return $this->sendResponse(['message' => $message, 'status' => 200], 'Email enregistré.');
    
            }else{
    
                return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cet email.');
    
            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }


    public function update(Request $request, $slug){

        if(auth()->user()->role_id === 1){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'email' => ['required','string', 'max:255', 'unique:news_letters'],
            ],[
                'required' => 'Votre :attribute est obligatoire.',
                'email.unique' => 'Cet :attribute est déjà enregistré.'
            ], [
                'email' => 'email',
            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

            }

            $datas['slug'] = Str::slug($datas['email']);

            $datas['date_publish'] = now();

            $newsLetterCheck = NewsLetter::where('slug', $slug)->first();


            if($newsLetterCheck){

                $newsLetterUpdateData = $newsLetterCheck->update($datas);

                if($newsLetterUpdateData){

                    return $this->sendResponse(['newsLetterUpdateData' => $newsLetterUpdateData, 'status' => 200], 'Abonné à la newsletter modifié.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de modifier cet abonné à la newsletter.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Cet abonné est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function delete(Request $request,  $slug){

        if(auth()->user()->role_id === 1){

            $newsLetterCheck = NewsLetter::where('slug', $slug)->first();

            if($newsLetterCheck){

                
                $newsLetterDeleteData = $newsLetterCheck->delete();

                if($newsLetterDeleteData){

                    return $this->sendResponse(['newsLetterDeleteData' => $newsLetterDeleteData, 'status' => 200], 'Abonné à la newsletter supprimée.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de supprimer cet abonné à la newsletter.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Cet abonné à la newsletter est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function activate(Request $request,  $slug){

        if(auth()->user()->role_id === 1){

            $newsLetterCheck = NewsLetter::where('slug', $slug)->first();

            if($newsLetterCheck){

                $newsLetterCheck->status = 1;

                $newsLetterCheck->date_publish = now();

                $newsLetterActivateData = $newsLetterCheck->update();

                if($newsLetterActivateData){

                    return $this->sendResponse(['newsLetterActivateData' => $newsLetterActivateData, 'status' => 200], 'Abonné à la newsletter activé.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible d\'activer cet abonné à la newsletter.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Cet abonné à la newsletter est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

    public function block(Request $request,  $slug){

        if(auth()->user()->role_id === 1){

            $newsLetterCheck = NewsLetter::where('slug', $slug)->first();

            if($newsLetterCheck){

                $newsLetterCheck->status = 2;

                $newsLetterCheck->date_publish = now();

                $newsLetterBlockData = $newsLetterCheck->update();

                if($newsLetterBlockData){

                    return $this->sendResponse(['newsLetterBlockData' => $newsLetterBlockData, 'status' => 200], 'Abonné à la newsletter bloqué.');

                }else{

                    return $this->sendResponse(['status' => 422], 'Impossible de bloquer cet abonné à la newsletter.');

                }

            }else{

                return $this->sendResponse(['status' => 422], 'Cet abonné à la newsletter est introuvable.');

            }

        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }

}
