<?php

namespace App\Http\Controllers\Api\Web\Backoffice\Admin\Publications\CRUD;

use App\Http\Controllers\Api\BaseController;
use App\Models\InfosMonthYear;
use App\Models\InfosMonthYearPublication;
use App\Models\TypePublication;
use App\Models\Publication;
use App\Models\PushSubscription;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;
use Carbon\Carbon;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AlertInfosAnnonceController extends BaseController
{
    public function str_replace_all($search, $replace, $subject) {

        return str_replace($search, $replace, $subject);

    }

    public function getExcerpt($limit = 50, $post_content)
    {
        $content = strip_tags($post_content); // Supprime les balises HTML

        $words = explode(' ', $content); // Sépare les mots

        if (count($words) > $limit) {

            $excerpt = implode(' ', array_slice($words, 0, $limit)) . '...';

        } else {

            $excerpt = $content;

        }

        return $excerpt;
    }

    public function stripTags($post_content){

        $content = strip_tags($post_content); 

        return $content;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function storeInfoAlertAnnonce(Request $request, $slug){

        if(auth()->user()->role_id === 1){

            $datas = $request->all();

            $validator = Validator::make($datas, [
                'title' => ['required','string', 'unique:publications'],
                'status' => ['required'],
            ],[
                'required' => 'Votre :attribute est obligatoire.',
                'title.unique' => 'Ce :attribute est déjà enregistré.',
            ], [
                'title' => 'titre de la publication',

            ]);

            if ($validator->fails()) {

                return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Le titre de votre publication est obligatoire');

            }

            $typePublicationCount = TypePublication::where('slug', $slug)->count();

            if($typePublicationCount === 0){

                return $this->sendResponse(['status' => 422], 'Aucun type de publication n\'est enregistré.');

            }else{

                $typePublication = TypePublication::where('slug', $slug)->first();

                if($datas['status'] == 0 || $datas['status'] == 3){

                    $typePublication->count_publications += 1;

                    $typePublication->update();

                    $datas['type_publication_id'] = $typePublication->id;

                    $datas['type_publication_name'] = $typePublication->name;

                    $datas['type_publication_slug'] = $typePublication->slug;

                    $datas['user_id'] = auth()->user()->id;

                    if($typePublication->id == 1){

                        $datas['is_alert_infos'] = true;

                    }else{

                        $datas['is_annonce'] = true;

                    }

                    $datas['is_article'] = false;

                    $datas['presently'] = 1;

                    $datas['title'] = $this->str_replace_all('<p>', '<div> <a href="#" class="text-reset btn-link">', $this->str_replace_all('</p>', '</a></div>', $datas['title'])) ;

                    $datas['slug'] = Str::slug($this->stripTags($datas['title']));
    
                    $datas['title_truncate'] = $this->getExcerpt(10, $datas['title']);

                    $date = Carbon::parse(now());

                    $mois_id = $date->format('m');

                    $year = $date->format('Y');

                    $mois = InfosMonthYear::where('month_id', $mois_id)->first();

                    $date_name = $mois->month.' '.$year;

                    $datas['date_name'] =  $date_name;

                    $verify_date_name = InfosMonthYearPublication::where('date_name', $date_name)->first();

                    if(!$verify_date_name){

                        InfosMonthYearPublication::create(['date_name' => $date_name]);

                    }

                    $publicationCreateData =  Publication::create($datas);

                    if($publicationCreateData){

                        return $this->sendResponse(['publicationCreateData' => $publicationCreateData, 'status' => 200], 'Publication enregistrée.');

                    }else{

                        return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cette publication.');

                    }
     
                }else{

                    if($datas['date_publish'] <= now()){

                        return $this->sendResponse(['status' => 422], 'Veuillez bien revoir votre date de debut de publication .');
    
                    }else{
    
                        if($datas['date_publish_end'] <= now()){
    
                            return $this->sendResponse(['status' => 422], 'Veuillez bien revoir votre date de fin de publication .');
    
                        }else{
    
                            if($datas['date_publish_end'] <= $datas['date_publish']){
    
                                return $this->sendResponse(['status' => 422], 'Votre date de fin de publication ne peut être antérieure à la date de debut de publication ');
    
                            }else{
    
                                $typePublication->count_publications += 1;
    
                                $typePublication->update();
    
                                $datas['type_publication_id'] = $typePublication->id;
    
                                $datas['type_publication_name'] = $typePublication->name;
    
                                $datas['type_publication_slug'] = $typePublication->slug;
    
                                $datas['user_id'] = auth()->user()->id;
    
                                if($typePublication->id == 2){
    
                                    $datas['is_alert_infos'] = true;
    
                                }else{
    
                                    $datas['is_annonce'] = true;
    
                                }
    
                                $datas['is_article'] = false;
    
                                $datas['presently'] = 1;
    
                                $datas['title'] = $this->str_replace_all('<p>', '<div> <a href="#" class="text-reset btn-link">', $this->str_replace_all('</p>', '</a></div>', $datas['title'])) ;
    
                                $datas['slug'] = Str::slug($this->stripTags($datas['title']));
                
                                $datas['title_truncate'] = $this->getExcerpt(10, $datas['title']);
    
                                $date = Carbon::parse(now());
    
                                $mois_id = $date->format('m');
    
                                $year = $date->format('Y');
    
                                $mois = InfosMonthYear::where('month_id', $mois_id)->first();
    
                                $date_name = $mois->month.' '.$year;
    
                                $datas['date_name'] =  $date_name;
    
                                $verify_date_name = InfosMonthYearPublication::where('date_name', $date_name)->first();
    
                                if(!$verify_date_name){
    
                                    InfosMonthYearPublication::create(['date_name' => $date_name]);
    
                                }
    
                                $publicationCreateData =  Publication::create($datas);

                                 
    
                                if($publicationCreateData){
    
                                    return $this->sendResponse(['publicationCreateData' => $publicationCreateData, 'status' => 200], 'Publication enregistrée.');
    
                                }else{
    
                                    return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cette publication.');
    
                                }
    
                            }
    
                        }
    
                    }    

                } 
            }


        }else{

            return $this->sendResponse(['status' => 422], 'Vous n\'êtes pas autorisé à acceder à ses données .');

        }

    }
}