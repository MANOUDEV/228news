<?php

namespace App\Http\Controllers\Api\Web\Authentication;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
class LoginController extends BaseController
{

    
    public static function middleware(): array{

        return [
            new Middleware(middleware: 'auth:api', except: ['login', 'submitLogin', 'register', 'sendOtpRegister', 'checkOtpRegister', 'newInfoRegister', 'newPassRegister', 'forgot_password', 'sendOtpForgotPassword', 'checkOtpForgotPassword', ' newPassForgotPassword'])
        ];

    }
   

    public function login(){
        
        return view('authentication.login');        

    }

    public function submitLogin(Request $request)
    {
        if (filter_var($request->input('username'), FILTER_VALIDATE_EMAIL)) {
            $login_type = 'email';
        } else {
            $login_type = 'username';
        }
        if ($login_type === 'email') {
            $validator = Validator::make($request->all(), [
                'username' => 'required|email',
                'password' => 'required|string|min:5',
            ], [
                'username.required' => ':attribute ou le numero de téléphone est obligatoire.',
                'password.required' => 'Le :attribute est obligatoire.'
            ],[
                'username' => 'L\'email',
                'password' => 'mot de passe'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors'=> $validator->errors(), 'status' => 401, "message" => "Erreur de validation"], 200);
            }

            $username = $request->input('username');
            $user = User::where('email', $username)->where('status', true)->first();;

            if (is_null($user)) {
                return response()->json(['error' => true, 'message' => 'Aucun utilisateur trouvé avec ces identifiants.','status' => 422], 200);
            }

            if ($user->status === 0) {
                return response()->json(['error' => true,
                    'errorType' => 'activationError',
                    'message' => 'Veuillez activer votre compte.','status' => 422], 200);
            }

            if ($user->status === 2) {
                return response()->json(['error' => true,
                    'errorType' => 'suspended',
                    'message' => 'Votre compte est suspendu.','status' => 422], 200);
            }


            $credentials = array_merge(['email' => $request->input('username')], $request->only('password'));
            if (!$token = Auth::guard('api')->attempt($credentials)) {
                return response()->json([
                    'error' => true,
                    'errorType' => 'credentialsError',
                    'message' => 'Les identifiants fournis sont invalides(pas autoris(é)e).','status' => 422], 200);
            }
        }
        //Phone / Password Login
        if ($login_type === 'username') {
            $validator = Validator::make($request->all(), [
                //'telephone_1' => 'required|regex:/(228)[0-9]{8}/',
                'username' => 'required|string|min:5',
                'password' => 'required|string|min:5',
            ], [
                'required' => 'Le :attribute ou l\'email est obligatoire.',
                'password.required' => 'Le :attribute est obligatoire.'
            ], [
                'username' => 'nom d\'utilisateur',
                'password' => 'mot de passe'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors'=> $validator->errors(), 'status' => 401, "message" => "Erreur de validation"], 200);
            }

            $user = User::where('username', $request->username)->first();

            if (is_null($user)) {
                return response()->json(['error' => true, 'message' => 'Aucun utilisateur trouvé avec ces identifiants.','status' => 422], 200);
            }

            if ($user->status === 0) {
                return response()->json(['error' => true,
                    'errorType' => 'activationError',
                    'message' => 'Veuillez activer votre compte.','status' => 422], 200);
            }

            if ($user->status === 2) {
                return response()->json(['error' => true,
                    'errorType' => 'suspended',
                    'message' => 'Votre compte est suspendu.','status' => 422], 200);
            }

            $credentials = array_merge(['username' => $request->input('username')], $request->only('password'));
            if (!$token = Auth::guard('api')->attempt($credentials)) {
                return response()->json(['error' => true,
                    'errorType' => 'credentialsError',
                    'message' => 'Les identifiants fournis sont invalides.','status' => 422], 200);
            }
        }

        $userLogin = User::select('users.username', 'roles.name')
        ->where('users.id', $user->id)
        ->where('users.status', 1)
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->first();


        if($request->input('remember_me')){

            $expires = 60*24*30*12*5;

            return response()->json(['access_token' => $this->createNewToken($token, $expires), 'user' => $userLogin, 'message' => 'Vous êtes maintenant connectés.' ,'status' => 200], 200);

        }

        return response()->json(['access_token' => $this->createNewToken($token), 'user' => $userLogin, 'message' => 'Connexion réussie' ,'status' => 200], 200);
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
