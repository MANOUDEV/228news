<?php

namespace App\Http\Controllers\Api\Web\Authentication;

use App\Http\Controllers\Api\BaseController; 
use App\Mail\VerifyOtp;
use App\Models\User;
use App\Models\Publication;
use App\Models\OtpForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\Middleware;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends BaseController
{

    
    public static function middleware(): array{

        return [
            new Middleware(middleware: 'auth:api', except: ['login', 'submitLogin', 'register', 'sendOtpRegister', 'checkOtpRegister', 'newInfoRegister', 'newPassRegister', 'forgot_password', 'sendOtpForgotPassword', 'checkOtpForgotPassword', ' newPassForgotPassword'])
        ];

    }

    public function forgot_password(){

        SEOMeta::setTitle('Mot de passe oublié | Togo actualité');
        SEOMeta::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        SEOMeta::setCanonical('https://actualitetogo.com/auth/register');

        OpenGraph::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        OpenGraph::setTitle('Mot de passe oublié | Togo actualité');
        OpenGraph::setUrl('https://actualitetogo.com/auth/register');
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage("https://actualitetogo.com/assets/images/Icone.png");

        TwitterCard::setTitle('Mot de passe oublié | Togo actualité');
        TwitterCard::setSite('@Togoactualite');

        JsonLd::setTitle('Mot de passe oublié | Togo actualité');
        JsonLd::setDescription('Nous sommes Togo Actualité, l’information en temps réel sur le Togo et l’Afrique.');
        JsonLd::addImage('https://actualitetogo.com/assets/images/Icone.png');

        return view('authentication.forgot_password');
       
    }

    public function sendOtpForgotPassword(Request $request){

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

        $check_email_user = User::where('email', $datas['email'])->first();

        if($check_email_user){

            if($check_email_user->status == 1){

                $verify_otp = OtpForgotPassword::where('email', $datas['email'])->first();

                if($verify_otp){

                    $verify_otp->otp =  rand(101478,981264);

                    $verify_otp->update();

                    $content = [
                        'subject' => 'Code de renitialisation de mot de passe',
                        'body' => 'Votre code est '. $verify_otp->otp
                    ];

                    Mail::to($datas['email'])->send(new VerifyOtp($content));

                    return response()->json(['success' => true, 'message' => 'Un nouveau code de rénitialisation a été envoyé à cet email','status' => 200], 200);

                }else{

                    $create_otp = OtpForgotPassword::create([
                        'otp' => rand(101478,981264),
                        'email' => $check_email_user->email,
                        'user_id' => $check_email_user->id,
                    ]);

                    $content = [
                        'subject' => 'Code de renitialisation de mot de passe',
                        'body' => 'Votre code est '. $create_otp->otp
                    ];

                    Mail::to($datas['email'])->send(new VerifyOtp($content));

                    return response()->json(['success' => true, 'message' => 'Un code de rénitialisation a été envoyé à cet email','status' => 200], 200);

                }

            }else{
                return response()->json(['error' => true, 'message' => 'Désolé ce compte est n\'est pas actif.','status' => 422], 200);
            }

        }else{
            return response()->json(['error' => true, 'message' => 'Aucun utilisateur trouvé avec cet email.','status' => 422], 200);
        }

    }

    public function checkOtpForgotPassword(Request $request){

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'otp' => 'required',
        ], [
            'otp.required' => ':attribute est obligatoire.',
        ],[
            'otp' => 'Le code de rénitialisation',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors(), 'status' => 401, "message" => "Erreur de validation"], 200);
        }

        $check_email_user = User::where('email', $datas['email'])->first();

        if($check_email_user){

            if($check_email_user->status == 1){

                $verify_otp = OtpForgotPassword::where('email', $datas['email'])->where('otp', $datas['otp'])->first();

                if($verify_otp){

                    $verify_otp->status = 1;

                    $verify_otp->update();

                    return response()->json(['success' => true, 'message' => 'Votre code de rénitialisation a été verifié','status' => 200], 200);

                }else{

                    return response()->json(['error' => true, 'message' => 'Ce code de rénitialisation n\'est pas valide. Veuillez réessayer.','status' => 422], 200);

                }

            }else{

                return response()->json(['error' => true, 'message' => 'Désolé ce compte est n\'est pas actif.','status' => 422], 200);

            }

        }else{

            return response()->json(['error' => true, 'message' => 'Aucun utilisateur trouvé avec cet email.','status' => 422], 200);

        }

    }


    public function newPassForgotPassword(Request $request){

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

                    $verify_otp = OtpForgotPassword::where('email', $datas['email'])->where('otp', $datas['otp'])->first();

                    if( $verify_otp->status = 1){

                        $check_email_user->password = Hash::make($datas['password']);

                        $check_email_user->update();

                        return response()->json(['success' => true, 'message' => 'Votre mot de passe a été modifié','status' => 200], 200);
                        
                    }else{

                        return response()->json(['error' => true, 'message' => 'Impossible de modifier le mot de passe.','status' => 422], 200);

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
}
