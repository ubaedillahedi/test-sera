<?php

namespace App\Http\Controllers;

use App\Utils\AuthUtil;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function __construct(AuthUtil $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $response = $this->auth->login($request->all());
        return response()->json($response, $response['code']);
    }

    public function register(Request $request)
    {
        $response = $this->auth->register($request->all());
        return response()->json($response, $response['code']);
    }
}
