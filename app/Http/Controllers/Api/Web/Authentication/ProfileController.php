<?php
namespace App\Http\Controllers\Api\Web\Authentication;
use App\Http\Controllers\Api\BaseController;
use App\Models\Author;
use App\Models\Publication;
use App\Models\Role;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\Middleware; 
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{

    public static function middleware(): array{

        return [
            new Middleware(middleware: 'auth:api', except: ['login', 'submitLogin', 'register', 'sendOtpRegister', 'checkOtpRegister', 'newInfoRegister', 'newPassRegister', 'forgot_password', 'sendOtpForgotPassword', 'checkOtpForgotPassword', ' newPassForgotPassword']),
        ];

    }

    public function profile(){

        SEOMeta::setTitle('Editer son profil | Togo actualité');
        SEOMeta::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        SEOMeta::setCanonical('https://actualitetogo.com/auth/register');

        OpenGraph::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        OpenGraph::setTitle('Editer son profil | Togo actualité');
        OpenGraph::setUrl('https://actualitetogo.com/auth/register');
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage("https://actualitetogo.com/assets/images/Icone.png");

        TwitterCard::setTitle('Editer son profil | Togo actualité');
        TwitterCard::setSite('@Togoactualite');

        JsonLd::setTitle('Editer son profil | Togo actualité');
        JsonLd::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        JsonLd::addImage('https://actualitetogo.com/assets/images/Icone.png');

        return view('authentication.profile');
    }

    public function me()
    {
        $user = User::select('users.nom','users.prenoms', 'users.email','users.username', 'users.telephone', 'authors.address', 'authors.authorName', 'authors.description' ,'roles.name as role_name')
        ->where('users.id', auth()->user()->id)
        ->where('users.status', 1)
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('authors', 'authors.id', '=', 'users.author_id')
        ->first();
        return $this->sendResponse([
            'status' => 200,
            'user' => $user
        ], "");
    }

    public function updateMePassword(Request $request){

        $user = User::where('id', '=' ,auth()->user()->id )->first();

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'password' => ['required','string', 'max:255'],
            'new_password' => ['required','string', 'max:255'],
            'new_password_confirm' => ['required','string', 'max:255'],
        ],[
            'required' => 'Votre :attribute est obligatoire.', 
        ], [
            'password' => 'mot de passe',
            'new_password' => 'nouveau mot de passe',
            'new_password_confirm' => ' confirmation du nouveau mot de passe',
        ]);

        if ($validator->fails()) {

            return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

        }

        if($datas['new_password'] == $datas['new_password_confirm']){

            if($user){
                
                $user = User::where('id', '=' ,auth()->user()->id )->first();

                if($user){
                    
                    $user->password = Hash::make($datas['new_password']);

                    $update_user = $user->update();

                    if($update_user){
                        $user = User::select('users.nom','users.prenoms', 'users.email','users.username', 'users.telephone', 'authors.address', 'authors.authorName', 'authors.description' ,'roles.name as role_name')
                        ->where('users.id', auth()->user()->id)
                        ->where('users.status', 1)
                        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                        ->leftJoin('authors', 'authors.id', '=', 'users.author_id')
                        ->first();

                        return $this->sendResponse([
                            'status' => 200,
                            'user' => $user
                        ], "Profile modifé");
                    }else{

                        return $this->sendResponse(['errors'=> [], 'status' => 401],'Impossible d\'enregistrer les données.');

                    }

                }else{

                    return $this->sendResponse(['errors'=> [], 'status' => 401],'Ce mot de passse ne correspond pas.');
                }
                
            }

        }else{
            return $this->sendResponse(['errors'=> [], 'status' => 401],'La confirmation de votre mot de passe ne correspond pas.');
        }

        

    }

    public function updateMeProfile(Request $request){

        $user = User::where('id', '=' ,auth()->user()->id )->first();

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'nom' => ['required','string', 'max:255'],
            'prenoms' => ['required','string', 'max:255'],
            'email' => ['required','email', 'max:255'],
        ],[
            'required' => 'Votre :attribute est obligatoire.',
            'email.unique' => 'Votre :attribute est déjà enregistrée.'
        ], [
            'nom' => 'nom',
            'prenoms' => 'prénoms',
            'email' => 'email',
        ]);

        if ($validator->fails()) {

            return $this->sendResponse(['errors'=> $validator->errors(), 'status' => 401],'Erreur de validation');

        }

        if($user){
            
            $author = Author::where('id', '=', $user->author_id )->first(); 

            if($user->email !=  $datas['email']){

                $email_check = User::where('email', '=' ,$datas['email'] )->first();
    
                if($email_check){
    
                    return $this->sendResponse(['errors'=> [], 'status' => 401],'Cet email est déjà utilisé.');
    
                }
            }

           
            if($datas['username'] == null){

                $datas['username'] = $datas['prenoms'];

            }

            if($datas['authorName'] == null){

                $datas['authorName'] = $datas['prenoms'];

            }

            $datas['slug'] = Str::slug($datas['username']);
    
            $update_user = $user->update($datas);

            if($author){

                $author->slug = Str::slug($datas['authorName']);

                $update_author = $author->update($datas);

                $publications = Publication::where('type_publication_id', '!=', 2)->where('type_publication_id', '!=', 3)->get();

                foreach($publications as $publication){

                    $publication->author_name = $update_author->authorName;

                    $publication->author_slug= $update_author->slug;

                    $publication->update();

                }
            } 

            if($update_user){
                $user = User::select('users.nom','users.prenoms', 'users.email','users.username', 'users.telephone', 'authors.address', 'authors.authorName', 'authors.description' ,'roles.name as role_name')
                ->where('users.slug', $update_user->slug)
                ->where('users.status', 1)
                ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                ->leftJoin('authors', 'authors.id', '=', 'users.author_id')
                ->first();

                return $this->sendResponse([
                    'status' => 200,
                    'user' => $user
                ], "Profile modifé");
            }else{

                return $this->sendResponse(['errors'=> [], 'status' => 401],'Impossible d\'enregistrer les données.');

            }

           

        }
        

    }

    public function getRole()
    {
        $role = Role::where('id', '=' ,auth()->user()->role_id )->first();

        return response()->json([
            'status' => 200,
            'role' => $role->nbRsp
        ], 200);
    }
}
