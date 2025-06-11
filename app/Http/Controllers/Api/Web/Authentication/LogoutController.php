<?php

namespace App\Http\Controllers\Api\Web\Authentication;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class LogoutController extends BaseController
{

    
    public static function middleware(): array{

        return [
            new Middleware(middleware: 'auth:api', except: ['login', 'submitLogin', 'register', 'sendOtpRegister', 'checkOtpRegister', 'newInfoRegister', 'newPassRegister', 'forgot_password', 'sendOtpForgotPassword', 'checkOtpForgotPassword', ' newPassForgotPassword'])
        ];

    }
    
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Déconnexion.', 'status' => 200]);
    }

}
