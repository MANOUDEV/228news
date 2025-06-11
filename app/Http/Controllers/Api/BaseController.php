<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
   /**
    * success response method.
    *
    * @param $result
    * @param $message
    * @return JsonResponse
    */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($errors = [], $message, $code)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        if(!empty($errors)){
            $response['errors'] = $errors;
        }
        return response()->json($response, $code);
    }
}
