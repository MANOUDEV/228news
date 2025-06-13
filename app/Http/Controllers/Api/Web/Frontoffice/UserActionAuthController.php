<?php
namespace App\Http\Controllers\Api\Web\Frontoffice;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\Message;
use App\Models\SenderMessage; 
use App\Models\PublicationLikes;
use App\Models\Comment;
use App\Models\Commentator;
use App\Models\VisitorMatriculeLikes;
use App\Models\VisitorMatriculeComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserActionAuthController extends BaseController
{
    public function actionsLikes($slug, $local_storage_likes){

        $slug =  str_replace('https://togoactu.com/', '', $slug);

        $article = Publication::where('status', 1)->where('slug', $slug)->where('deja_citer', 0)->first();

        $user = VisitorMatriculeLikes::where('matricule_reference', $local_storage_likes)->first();

        if($article && $user){

            $check_likes = PublicationLikes::where('publication_id', $article->id)->where('user_id', auth()->user()->id)->first();

            if($check_likes){

                $articles = Publication::where('status', 1)->where('slug', $slug)->where('deja_citer', 1)->get();

                foreach($articles as $articleH){

                    $check_likess = PublicationLikes::where('publication_id', $articleH->id)->where('user_id', auth()->user()->id)->first();

                    foreach($check_likess as $result){
               
                        $result->visible = 0;

                        $result->update();
        
                        $articleH->likes_count -= 1;
        
                        $articleH->update();

                    }
                }

                $check_likes->visible = 0;

                $check_likes->update();

                $article->likes_count -= 1;
        
                $article->update();

                return $this->sendResponse(['article' => $article, 'status' => 202], 'null');

            }else{

                $check_likes = PublicationLikes::where('publication_id', $article->id)->where('user_id', auth()->user()->id)->first();

                if($check_likes){

                    $articles = Publication::where('status', 1)->where('slug', $slug)->where('deja_citer', 1)->get();
    
                    foreach($articles as $articleH){
    
                        $check_likess = PublicationLikes::where('publication_id', $articleH->id)->where('user_id', auth()->user()->id)->first();
    
                        foreach($check_likess as $result){
                   
                            $result->visible = 1;
    
                            $result->update();
            
                            $articleH->likes_count += 1;
            
                            $articleH->update();
    
                        }
                    }
    
                    $check_likes->visible = 1;
    
                    $check_likes->update();
    
                    $article->likes_count += 1;
            
                    $article->update();
    
                    return $this->sendResponse(['article' => $article, 'status' => 201], 'Merci d\' avoir aimé cet article .');
                }else{

                    $articles = Publication::where('status', 1)->where('slug', $slug)->where('deja_citer', 1)->get();

                    foreach($articles as $articleH){

                        $likes_create = PublicationLikes::create([
                            'visitor_matricule_id' => $user->id,
                            'user_id' => auth()->user()->id,
                            'publication_id' => $articleH->id,
                            'date_publish'=>now()
                        ]);

                        $articleH->likes_count += 1;

                        $articleH->update();
                    
                    }

                    $likes_create = PublicationLikes::create([
                        'visitor_matricule_id' => $user->id,
                        'user_id' => auth()->user()->id,
                        'publication_id' => $article->id,
                        'date_publish'=>now()
                    ]);

                    $article->likes_count += 1;

                    $article->update();

                    return $this->sendResponse(['article' => $article, 'status' => 201], 'Merci d\'avoir aimé cette publication');
                }

                

            }
        }

    }

    public function submitCommentAuth(Request $request, $slug, $local_storage_comments){

        $slug =  str_replace('https://togoactu.com/', '', $slug);

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'content' => ['required'],
        ],[
            'required' => 'Votre :attribute est obligatoire.',
        ], [
            'content' => 'contenu',
        ]);

        if ($validator->fails()) {

            return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

        }

        $datas['slug'] = Str::slug(auth()->user()->nom_complet);

        $check_sender_comment = Commentator::where('nom_complet', auth()->user()->nom_complet)->where('email', auth()->user()->email)->first();

        $article = Publication::where('status', 1)->where('slug', $slug)->first();

        $user = VisitorMatriculeComments::where('matricule_reference', $local_storage_comments)->first();

        if($article){

            if($user){

                if($check_sender_comment){

                    $articles = Publication::where('status', 1)->where('slug', $slug)->get();

                    foreach($articles as $articleH){

                        $create_comment = Comment::create([
                            'commentator_id' => $check_sender_comment->id,
                            'content' => $datas['content'],
                            'publication_id' => $articleH->id,
                            'date_publish'=>now()
                        ]);

                        $articleH->comment_count += 1;

                        $articleH->update();
        
                    }

                    $check_sender_comment->count_comments += 1;
            
                    $check_sender_comment->update();
                }else{

                    $articles = Publication::where('status', 1)->where('slug', $slug)->get();

                    $create_sender_comment = Commentator::create([
                        'nom_complet' =>auth()->user()->nom_complet,
                        'user_id' => auth()->user()->id,
                        'email' => auth()->user()->email,
                        'username' => auth()->user()->username,
                        'slug'=> $datas['slug'],
                        'date_publish'=>now()
                    ]);

                    foreach($articles as $articleH){

                        $create_comment = Comment::create([
                            'commentator_id' => $create_sender_comment->id,
                            'content' => $datas['content'],
                            'publication_id' => $articleH->id,
                            'date_publish'=>now()
                        ]);

                        $articleH->comment_count += 1;

                        $articleH->update();
            
                    }

                    $create_sender_comment->count_comments += 1;
            
                    $create_sender_comment->update();

                }

            }else{

                return $this->sendResponse(['result' => 'Error', 'status' => 422], 'Ce matricule de réference n\'existe pas encore.');

            }

        }else{

            return $this->sendResponse(['result' => 'Error', 'status' => 422], 'Cette publication n\'existe pas encore.');

        }

        return $this->sendResponse(['result' => $create_comment , 'status' => 200], 'Commentaire envoyé.');
    }

    public function submitContactAuth(Request $request){

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'content' => ['required'],
        ],[
            'required' => 'Votre :attribute est obligatoire.',
        ], [
            'content' => 'contenu',
        ]);

        if ($validator->fails()) {

            return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

        }

        $datas['slug'] = Str::slug(auth()->user()->nom_complet);

        $check_sender_message = SenderMessage::where('nom_complet', auth()->user()->nom_complet)->where('email', auth()->user()->email)->first();

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
                'nom_complet' =>auth()->user()->nom_complet,
                'slug' => $datas['slug'],
                'email' => auth()->user()->email,
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
}
