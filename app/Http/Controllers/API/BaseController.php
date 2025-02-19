<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($message, $data){
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response,200);
    }

    public function sendError($message, $errorMessage=[], $code=404){
        $response = [
            'status' => false,
            'message' => $message,
            'errors' => $errorMessage,
        ];

        // if(!empty($errorMessage)){
        //     $rersponse['data'] = $errorMessage;
        // }
        return response()->json($response,$code);
    }

    
}
