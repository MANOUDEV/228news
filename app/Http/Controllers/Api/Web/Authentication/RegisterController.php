<?php

namespace App\Http\Controllers\Api\Web\Authentication;
use App\Http\Controllers\Api\BaseController;
use App\Mail\VerifyOtp;
use App\Models\User;
use App\Models\OtpRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\Middleware;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\Mail;

class RegisterController extends BaseController
{

    
    public static function middleware(): array{

        return [
            new Middleware(middleware: 'auth:api', except: ['login', 'submitLogin', 'register', 'sendOtpRegister', 'checkOtpRegister', 'newInfoRegister', 'newPassRegister', 'forgot_password', 'sendOtpForgotPassword', 'checkOtpForgotPassword', ' newPassForgotPassword'])
        ];

    }

    public function register(){

        SEOMeta::setTitle('S\'inscrire | Togo actualité');
        SEOMeta::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        SEOMeta::setCanonical('https://actualitetogo.com/auth/register');

        OpenGraph::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        OpenGraph::setTitle('S\'inscrire | Togo actualité');
        OpenGraph::setUrl('https://actualitetogo.com/auth/register');
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage("https://actualitetogo.com/assets/images/Icone.png");

        TwitterCard::setTitle('S\'inscrire | Togo actualité');
        TwitterCard::setSite('@Togoactualite');

        JsonLd::setTitle('S\'inscrire | Togo actualité');
        JsonLd::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        JsonLd::addImage('https://actualitetogo.com/assets/images/Icone.png');

        return view('authentication.register');

    }

    public function sendOtpRegister(Request $request){

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'email' => 'required|email',
        ], [
            'email.required' => ':attribute est obligatoire.',
        ],[
            'email' => 'L\'email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors(), 'status' => 401, "message" => "Erreur de validation"], 200);
        }

        $check_email_user =  User::where('email', $datas['email'])->first();

        if($check_email_user){

            if($check_email_user->status != 0){

                return response()->json(['error' => true, 'message' => 'Désolé un utilisateur utilise déjà cet email.','status' => 422], 200);

            }else{

                $verify_otp = OtpRegister::where('email', $datas['email'])->first();

                if($verify_otp){

                    $verify_otp->otp =  rand(101478,981264);

                    $verify_otp->update();

                    $content = [
                        'subject' => 'Code d\'activation de mot de passe',
                        'body' => 'Votre code est '. $verify_otp->otp
                    ];

                    Mail::to($datas['email'])->send(new VerifyOtp($content));

                    return response()->json(['success' => true, 'message' => 'Un nouveau code d\'activation a été envoyé à cet email','status' => 200], 200);

                }else{

                    $create_otp = OtpRegister::create([
                        'otp' => rand(101478,981264),
                        'email' => $check_email_user->email,
                        'user_id' => $check_email_user->id,
                    ]);

                    $content = [
                        'subject' => 'Code d\'activation de mot de passe',
                        'body' => 'Votre code est '. $create_otp->otp
                    ];

                    Mail::to($datas['email'])->send(new VerifyOtp($content));

                    return response()->json(['success' => true, 'message' => 'Un code d\'activation a été envoyé à cet email','status' => 200], 200);

                }

            }

        }else{

            $check_email_user =  User::create(['email' => $datas['email']]);

            $verify_otp = OtpRegister::where('email', $datas['email'])->first();

            if($verify_otp){

                $verify_otp->otp =  rand(101478,981264);

                $verify_otp->update();

                $content = [
                    'subject' => 'Code d\'activation de mot de passe',
                    'body' => 'Votre code est '. $verify_otp->otp
                ];

                Mail::to($datas['email'])->send(new VerifyOtp($content));

                return response()->json(['success' => true, 'message' => 'Un nouveau code d\'activation a été envoyé à cet email','status' => 200], 200);

            }else{

                $create_otp = OtpRegister::create([
                    'otp' => rand(101478,981264),
                    'email' => $check_email_user->email,
                    'user_id' => $check_email_user->id,
                ]);

                $content = [
                    'subject' => 'Code d\'activation de mot de passe',
                    'body' => 'Votre code est '. $create_otp->otp
                ];

                Mail::to($datas['email'])->send(new VerifyOtp($content));

                return response()->json(['success' => true, 'message' => 'Un code d\'activation a été envoyé à cet email','status' => 200], 200);

            }
        }

    }

    public function checkOtpRegister(Request $request){

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'otp' => 'required',
        ], [
            'otp.required' => ':attribute est obligatoire.',
        ],[
            'otp' => 'Le code d\'activation',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors(), 'status' => 401, "message" => "Erreur de validation"], 200);
        }

        $check_email_user = User::where('email', $datas['email'])->first();

        if($check_email_user){

            if($check_email_user->status === 0){

                $verify_otp = OtpRegister::where('email', $datas['email'])->where('otp', $datas['otp'])->first();

                if($verify_otp){

                    $verify_otp->status = 1;

                    $verify_otp->update();

                    $check_email_user->status = 1;

                    $check_email_user->update();

                    return response()->json(['success' => true, 'message' => 'Votre code d\'activation a été verifié','status' => 200], 200);

                }else{

                    return response()->json(['error' => true, 'message' => 'Ce code d\'activation n\'est pas valide. Veuillez réessayer.','status' => 422], 200);

                }

            }else{

                return response()->json(['error' => true, 'message' => 'Désolé ce compte est déjà actif.','status' => 422], 200);

            }

        }else{

            return response()->json(['error' => true, 'message' => 'Aucun utilisateur trouvé avec cet email.','status' => 422], 200);

        }

    }


    public function newInfoRegister(Request $request){

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'nom' => 'required',
            'prenoms' => 'required',
        ], [
            'nom.required' => ':attribute est obligatoire.',
            'prenoms.required' => ':attribute est obligatoire.',
        ],[
            'nom' => 'Le nom',
            'prenoms' => 'Le prénom',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors(), 'status' => 401, "message" => "Erreur de validation"], 200);
        }

        $check_email_user = User::where('email', $datas['email'])->first();

        if($check_email_user){

            if($check_email_user->status == 1){

                $verify_otp = OtpRegister::where('email', $datas['email'])->where('otp', $datas['otp'])->first();

                if( $verify_otp->status = 1){

                    if($datas['username']){

                        if(strlen($datas['username']) < 4){

                            return response()->json(['error' => true, 'message' => 'Votre non d\'utilisateur doit avoir 4 caractères minimum.','status' => 422], 200);

                        }

                        $usernameCheck = User::where('username', $datas['username'])->first();

                        if($usernameCheck){

                            return $this->sendResponse(['status' => 422], 'Désolé ce non d\'utilisateur est déjà utilisé.');

                        }

                        $check_email_user->username = $datas['username'];

                        $check_email_user->slug = Str::slug($datas['username']);

                    }else{

                        $check_email_user->username = $datas['prenoms'];

                        $check_email_user->slug = Str::slug($datas['prenoms']);

                    }

                    $check_email_user->nom = $datas['nom'];

                    $check_email_user->prenoms = $datas['prenoms'];

                    $check_email_user->nom_complet = $datas['nom'].' '.$datas['prenoms'];

                    $check_email_user->slug = Str::slug($datas['username']);

                    $check_email_user->update();

                    return response()->json(['success' => true, 'message' => 'Votre profil a été completé','status' => 200], 200);

                }else{

                    return response()->json(['error' => true, 'message' => 'Impossible d\'ajouter ces infos.','status' => 422], 200);

                }

            }else{

                return response()->json(['error' => true, 'message' => 'Désolé ce compte n\'est pas actif.','status' => 422], 200);

            }

        }else{

            return response()->json(['error' => true, 'message' => 'Aucun utilisateur trouvé avec cet email.','status' => 422], 200);

        }


    }

    public function newPassRegister(Request $request){

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'password' => 'required',
            'password_confirm' => 'required',
        ], [
            'password.required' => ':attribute est obligatoire.',
            'password_confirm.required' => ':attribute est obligatoire.',
        ],[
            'password' => 'Le mot de passe',
            'password_confirm' => 'La confirmation du mot de passe',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors(), 'status' => 401, "message" => "Erreur de validation"], 200);
        }

        if($datas['password'] === $datas['password_confirm']){

            if(strlen($datas['password']) > 6){

                $check_email_user = User::where('email', $datas['email'])->first();

            if($check_email_user){

                if($check_email_user->status == 1){

                    $verify_otp = OtpRegister::where('email', $datas['email'])->where('otp', $datas['otp'])->first();

                    if( $verify_otp->status = 1){

                        $check_email_user->password = Hash::make($datas['password']);

                        $check_email_user->role_id = 3;

                        $check_email_user->update();

                        $credentials = array_merge(['username' => $check_email_user->username], $request->only('password'));

                        if (!$token = Auth::guard('api')->attempt($credentials)) {
                            return response()->json(['error' => true,
                                'errorType' => 'credentialsError',
                                'message' => 'Les identifiants fournis sont invalides.','status' => 422], 200);
                        }

                        $userLogin = User::select('users.username', 'roles.name')
                        ->where('users.id', $check_email_user->id)
                        ->where('users.status', 1)
                        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                        ->first();

                        if($request->input('remember_me')){

                            $expires = 60*24*30*12*5;

                            return response()->json(['access_token' => $this->createNewToken($token, $expires), 'user' => $userLogin, 'message' => 'Vous êtes maintenant connectés.' ,'status' => 200], 200);

                        }

                        return response()->json(['access_token' => $this->createNewToken($token), 'user' => $userLogin, 'message' => 'Connexion réussie.' ,'status' => 200], 200);

                    }else{

                        return response()->json(['error' => true, 'message' => 'Impossible d\' ajouter le mot de passe.','status' => 422], 200);

                    }

                }else{

                    return response()->json(['error' => true, 'message' => 'Désolé ce compte est n\'est pas actif.','status' => 422], 200);

                }

            }else{

                return response()->json(['error' => true, 'message' => 'Aucun utilisateur trouvé avec cet email.','status' => 422], 200);

            }

            }else{

                return response()->json(['error' => true, 'message' => 'Votre mot de passe doit avoir 6 caractères minimum.','status' => 422], 200);

            }


        }else{
            return response()->json(['error' => true, 'message' => 'Desolé vos mots de passes ne correspondent pas.','status' => 422], 200);
        }
    }


    protected function createNewToken(string $token, $expires = 1)
    {
        return response()->json([
            'access_token' => $token,
            'status' => 200,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * $expires
        ])->header('Authorization', $token);
    }
}
