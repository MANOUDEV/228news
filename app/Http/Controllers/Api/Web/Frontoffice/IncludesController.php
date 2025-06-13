<?php
namespace App\Http\Controllers\Api\Web\Frontoffice;
use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Models\NewsLetter;
use App\Models\Tag;
use App\Models\Publication;  
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\PushSubscription;
use App\Models\SenderMessage;
use App\Models\PublicationViews;
use App\Models\PublicationLikes;
use App\Models\Comment;
use App\Models\VisitorMatriculeViews;
use App\Models\VisitorMatriculeComments;
use App\Models\VisitorMatriculeLikes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IncludesController extends BaseController
{

    public function str_replace_all($search, $replace, $subject) {

        return str_replace($search, $replace, $subject);

    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function politiqueRequestData(){

        $politiqueDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 26)->count();

        if($politiqueDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Acune publication sur politique n\'est publiée.');

        }else if ($politiqueDataCount !== 0){

            $politiqueData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 26);
            })->orderBy('date_publish', 'desc')
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'politiqueData' =>  $politiqueData,
                'status' => 200
            ], 'Listes de publications de politique publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }
    }

    public function diasporaRequestData(){

        $diasporaDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 9)->count();

        if($diasporaDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Aucune publication sur diaspora n\'est publiée.');

        }else if ($diasporaDataCount !== 0){

            $diasporaData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 9);
            })->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'diasporaData' =>  $diasporaData,
                'status' => 200
            ], 'Listes de publications de diaspora publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }

    }

   
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function mondeRequestData(){

        $mondeDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 23)->count();

        if($mondeDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Acune publication sur monde n\'est publiée.');

        }else if ($mondeDataCount !== 0){

            $mondeData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 23);
            })->orderBy('date_publish', 'desc')
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'mondeData' =>  $mondeData,
                'status' => 200
            ], 'Listes de publications de monde publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function afriqueRequestData(){

        $afriqueDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 3)->count();

        if($afriqueDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Acune publication sur afrique n\'est publiée.');

        }else if ($afriqueDataCount !== 0){

            $afriqueData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 3);
            })->orderBy('date_publish', 'desc')
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'afriqueData' =>  $afriqueData,
                'status' => 200
            ], 'Listes de publications de afrique publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }


    public function societeRequestData(){

        $societeDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 29)->count();

        if($societeDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Acune publication sur societe n\'est publiée.');

        }else if ($societeDataCount !== 0){

            $societeData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 29);
            })->orderBy('date_publish', 'desc')
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'societeData' =>  $societeData,
                'status' => 200
            ], 'Listes de publications de societe publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    public function sportsRequestData(){

        $sportsDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 31)->count();

        if($sportsDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Aucune publication sur sports n\'est publiée.');

        }else if ($sportsDataCount !== 0){

            $sportsData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 31);
            })->orderBy('date_publish', 'desc')
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'sportsData' =>  $sportsData,
                'status' => 200
            ], 'Listes de publications de sports publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    public function chroniquesRequestData(){

        $chroniquesDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 5)->count();

        if($chroniquesDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Acune publication sur chroniques n\'est publiée.');

        }else if ($chroniquesDataCount !== 0){

            $chroniquesData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 5);
            })->orderBy('date_publish', 'desc')
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'chroniquesData' =>  $chroniquesData,
                'status' => 200
            ], 'Listes de publications de chroniques publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    public function communiqueRequestData(){

        $communiqueDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 6)->count();

        if($communiqueDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Acune publication sur communique n\'est publiée.');

        }else if ($communiqueDataCount !== 0){

            $communiqueData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 6);
            })->orderBy('date_publish', 'desc')
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'communiqueData' =>  $communiqueData,
                'status' => 200
            ], 'Listes de publications de communique publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    public function economieRequestData(){

        $economieDataCount = Publication::where("status", 1)->where("type_publication_id", 1)->where("category_id", 11)->count();

        if($economieDataCount === 0){

            return $this->sendResponse(['status' => 401], 'Acune publication sur economie n\'est publiée.');

        }else if ($economieDataCount !== 0){

            $economieData = Publication::select(array("id", "content", "truncate_content","title", "slug", "date_publish" ,"author_name", "author_slug","image_cover_url"))
            ->where(function ($query) {
                $query->where("status", 1);
            })->where(function ($query) {
                $query->where("category_id", 11);
            })->orderBy('date_publish', 'desc')
            ->orderBy('date_publish', 'desc')
            ->take(4)
            ->get();

            return $this->sendResponse([
                'economieData' =>  $economieData,
                'status' => 200
            ], 'Listes de publications de economie publiés');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible de chargez les données.');

        }



    }

    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsletterStoreRequest(Request $request )
    {

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

        $message = NewsLetter::create($datas);

        if($message){

            return $this->sendResponse(['message' => $message, 'status' => 200], 'Email enregistré.');

        }else{

            return $this->sendResponse(['status' => 422], 'Impossible d\'enregistrer cet email.');

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tagsRequestData()
    {
       $tags = Tag::orderBy('tags.count_publications', 'desc')->take(6)->get();

       return $this->sendResponse(['tagsPopularsData' => $tags, 'status' => 200], 'les mots clés populaires');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryRequestData(){

        if(Category::count() == 0){

            return $this->sendResponse(['FirstSectionCategory' => [], 'TwoSectionCategory' => [] ,'status' => 200], 'les catégories populaires');

        }else{

            $category = Category::where('id', '!=', 34 )
            ->where('id', '!=', 32 )
            ->where('id', '!=', 32 )
            ->where('id', '!=', 25 )
            ->where('id', '!=', 5 )
            ->where('id', '!=', 10 )
            ->where('id', '!=', 11 )
            ->where('id', '!=', 9 )
            ->where('id', '!=', 29 )
            ->where('id', '!=', 3 )
            ->where('id', '!=', 15 )
            ->where('id', '!=', 16 )
            ->where('id', '!=', 19 )
            ->where('id', '!=', 30 )
            ->where('id', '!=', 31 )
            ->take(14)->get();

            $FirstSectionCategory = [$category[12], $category[1], $category[2], $category[3], $category[4], $category[5], $category[6]];

            $TwoSectionCategory = [$category[7], $category[8], $category[9],$category[11], $category[13]];

            return $this->sendResponse(['FirstSectionCategory' => $FirstSectionCategory, 'TwoSectionCategory' => $TwoSectionCategory ,'status' => 200], 'les catégories populaires');

        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicationsRequestData(){

        $publications = Publication::where('status', 1)->where("type_publication_id", 1)->whereDate('date_publish', '>', '2022-12-31')->orderBy('views_count', 'desc')->take(2)->get();

        return $this->sendResponse(['publicationsPopularsData' => $publications, 'status' => 200], 'les publications populaires');

    }

    public function submitContact(Request $request){

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'email' => ['required', 'email', 'max:255'],
            'nom_complet' => ['required', 'string', 'max:255'],
            'content' => ['required'],
        ],[
            'required' => 'Votre :attribute est obligatoire.',
        ], [
            'email' => 'email',
            'nom_complet' => 'nom complet',
            'content' => 'contenu',
        ]);

        if ($validator->fails()) {

            return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

        }

        $datas['slug'] = Str::slug($datas['nom_complet']);

        $check_sender_message = SenderMessage::where('nom_complet', $datas['nom_complet'])->where('email', $datas['email'])->first();

        if($check_sender_message){

            $create_contact = Message::create([
                'sender_message_id' => $check_sender_message->id,
                'content' => $datas['content'],
                'subject' => $datas['subject'] ? $datas['subject'] : null,
            ]);

            $check_sender_message->count_messages += 1;

            $check_sender_message->update();

        }else{

            $create_sender_contact = SenderMessage::create([
                'nom_complet' => $datas['nom_complet'],
                'slug' => $datas['slug'],
                'email' => $datas['email'],
            ]);

            $create_contact = Message::create([
                'sender_message_id' => $create_sender_contact->id,
                'content' => $datas['content'],
                'subject' => $datas['subject'] ? $datas['subject'] : null,
            ]);

            $create_sender_contact->count_messages += 1;

            $create_sender_contact->update();

        }

        return $this->sendResponse(['result' => $create_contact , 'status' => 200], 'Message envoyé.');

    }

    public function saveSubscription(Request $request)
    {
        $items = new PushSubscription();
        $items->subscriptions = json_decode($request->sub);
        $items->save();

        return response()->json(['message' => 'added successfully'], 200);
    }


    public function generateVisitorMatriculeViews(){

        $matricule_visitors_count = VisitorMatriculeViews::count();

        if($matricule_visitors_count == 0){

            $visitor_matricule_create = VisitorMatriculeViews::create([
                'matricule_reference' => $this->str_replace_all("/", "", Hash::make(time().'-1'))
            ]);

            return $this->sendResponse(['visitor_matricule_create' => $visitor_matricule_create, 'status' => 200], 'Matricule de référence pour un visiteur géneré.');

        }else{

            $matricule_visitor_latest = VisitorMatriculeViews::latest()->first();

            if($matricule_visitor_latest){

                $visitor_matricule_create = VisitorMatriculeViews::create([
                    'matricule_reference' => $this->str_replace_all("/", "", Hash::make(time().'-'.$matricule_visitor_latest->id + 1))
                ]);

                return $this->sendResponse(['visitor_matricule_create' => $visitor_matricule_create, 'status' => 200], 'Matricule de référence pour un visiteur géneré.');

            }else{
                return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Impossible de générer un matricule de référence pour ce visiteur.');
            }

        }

    }

    public function checkVisitorMatriculeViews($matricule) {

        $matricule_visitors_count = VisitorMatriculeViews::count();

        if($matricule_visitors_count !== 0){

            $check_matricule_reference = VisitorMatriculeViews::where('matricule_reference', $matricule)->first();

            if($check_matricule_reference){

                return $this->sendResponse(['check_matricule_reference' => $check_matricule_reference, 'status' => 200], 'Ce matricule de réference existe déjà.');

            }else{

                return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Ce matricule de réference n\'existe pas encore.');

            }
        }else{

            return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Aucun matricule de réference n\'existe encore.');

        }

    }

    public function generateVisitorMatriculeLikes(){

        $matricule_visitors_count = VisitorMatriculeLikes::count();

        if($matricule_visitors_count == 0){

            $visitor_matricule_create = VisitorMatriculeLikes::create([
                'matricule_reference' => $this->str_replace_all("/", "", Hash::make(time().'-1'))
            ]);

            return $this->sendResponse(['visitor_matricule_create' => $visitor_matricule_create, 'status' => 200], 'Matricule de référence pour un visiteur géneré.');

        }else{

            $matricule_visitor_latest = VisitorMatriculeLikes::latest()->first();

            if($matricule_visitor_latest){

                $visitor_matricule_create = VisitorMatriculeLikes::create([
                    'matricule_reference' => $this->str_replace_all("/", "", Hash::make(time().'-'.$matricule_visitor_latest->id + 1))
                ]);

                return $this->sendResponse(['visitor_matricule_create' => $visitor_matricule_create, 'status' => 200], 'Matricule de référence pour un visiteur géneré.');

            }else{
                return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Impossible de générer un matricule de référence pour ce visiteur.');
            }

        }

    }

    public function checkVisitorMatriculeLikes($matricule) {

        $matricule_visitors_count = VisitorMatriculeLikes::count();

        if($matricule_visitors_count !== 0){

            $check_matricule_reference = VisitorMatriculeLikes::where('matricule_reference', $matricule)->first();

            if($check_matricule_reference){

                return $this->sendResponse(['check_matricule_reference' => $check_matricule_reference, 'status' => 200], 'Ce matricule de réference existe déjà.');

            }else{

                return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Ce matricule de réference n\'existe pas encore.');

            }
        }else{

            return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Aucun matricule de réference n\'existe encore.');

        }

    }

    public function generateVisitorMatriculeComments(){

        $matricule_visitors_count = VisitorMatriculeComments::count();

        if($matricule_visitors_count == 0){

            $visitor_matricule_create = VisitorMatriculeComments::create([
                'matricule_reference' => $this->str_replace_all("/", "", Hash::make(time().'-1'))
            ]);

            return $this->sendResponse(['visitor_matricule_create' => $visitor_matricule_create, 'status' => 200], 'Matricule de référence pour un visiteur géneré.');

        }else{

            $matricule_visitor_latest = VisitorMatriculeComments::latest()->first();

            if($matricule_visitor_latest){

                $visitor_matricule_create = VisitorMatriculeComments::create([
                    'matricule_reference' => $this->str_replace_all("/", "", Hash::make(time().'-'.$matricule_visitor_latest->id + 1))
                ]);

                return $this->sendResponse(['visitor_matricule_create' => $visitor_matricule_create, 'status' => 200], 'Matricule de référence pour un visiteur géneré.');

            }else{
                return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Impossible de générer un matricule de référence pour ce visiteur.');
            }

        }

    }

    public function checkVisitorMatriculeComments($matricule) {

        $matricule_visitors_count = VisitorMatriculeComments::count();

        if($matricule_visitors_count !== 0){

            $check_matricule_reference = VisitorMatriculeComments::where('matricule_reference', $matricule)->first();

            if($check_matricule_reference){

                return $this->sendResponse(['check_matricule_reference' => $check_matricule_reference, 'status' => 200], 'Ce matricule de réference existe déjà.');

            }else{

                return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Ce matricule de réference n\'existe pas encore.');

            }
        }else{

            return $this->sendResponse(['result' => 'Error', 'status' => 401], 'Aucun matricule de réference n\'existe encore.');

        }

    }

    public function articleState($slug, $local_storage_views, $local_storage_likes){

       $slug =  str_replace('https://news228.com/', '', $slug);

        $article = Publication::where('status', 1)->where('slug', $slug)->where('deja_citer', 0)->first();

        $user_views = VisitorMatriculeViews::where('matricule_reference', $local_storage_views)->first();

        $user_likes = VisitorMatriculeLikes::where('matricule_reference', $local_storage_likes)->first();

        if($article && $user_views && $user_likes){

            $check_views = PublicationViews::where('publication_id', $article->id)->where('visitor_matricule_id', $user_views->id)->first();

            if($check_views){

                $check_likes = PublicationLikes::where('publication_id', $article->id)->where('visitor_matricule_id', $user_likes->id)->first();

                if($check_likes){

                    return $this->sendResponse(['article' => $article, 'status' => 202], 'Les statistiques sur un article.');

                }else{

                    return $this->sendResponse(['article' => $article, 'status' => 201], 'Les statistiques sur un article.');

                }

            }else{

                $articles = Publication::where('status', 1)->where('slug', $slug)->where('deja_citer', 1)->get();

                foreach($articles as $result){

                    $views_create = PublicationViews::create([
                        'visitor_matricule_id' => $user_views->id,
                        'publication_id' => $result->id
                    ]);

                    $result->views_count += 1;

                    $result->update();

                }

                $view_create = PublicationViews::create([
                    'visitor_matricule_id' => $user_views->id,
                    'publication_id' => $article->id
                ]);

                $article->views_count += 1;

                $article->update();

                return $this->sendResponse(['article' => $article, 'status' => 200], 'Les statistiques sur un article.');
            }

        }else{

            return $this->sendResponse(['article' => null, 'status' => 422], 'Impossible de chager les données.');

        }

    }

    public function articleComments($slug, $local_storage_comments){

        $slug =  str_replace('https://news228.com/', '', $slug);

        $article = Publication::where('status', 1)->where('slug', $slug)->first();

        $user = VisitorMatriculeComments::where('matricule_reference', $local_storage_comments)->first();

        if($article && $user){

            $comments = Comment::select(array("comments.id", "comments.content", "comments.date_publish", "commentators.username", "commentators.nom_complet", "comments.commentator_id"))
            ->where('comments.status', 1)
            ->where('comments.publication_id', $article->id)
            ->leftJoin("commentators", "commentators.id", "=", "comments.commentator_id")
            ->orderBy('comments.date_publish', 'desc')
            ->get();

            return $this->sendResponse(['article' => $article, 'comments' => $comments, 'status' => 200], 'Les commentaires sur un article.');

        }else{

            return $this->sendResponse(['article' => null, 'status' => 422], 'Impossible de chager les données.');

        }

    }

}
