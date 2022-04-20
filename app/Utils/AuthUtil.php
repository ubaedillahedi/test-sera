<?php

namespace App\Utils;

class AuthUtil
{
    public function login($request)
    {
        $response = $this->actionCurl('https://reqres.in/api/login', $request);
        return $response;
    }

    public function register($request)
    {
        $response = $this->actionCurl('https://reqres.in/api/register', $request);
        return $response;
    }

    protected function actionCurl($urlApi, $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlApi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        try {
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $response = $httpcode == 200 ? ['data' => json_decode($response, true)] : ['message' => "Missing email or password"];
            $response['code'] = $httpcode;
        } catch (\Throwable $th) {
            $httpcode = 500;
            $response = ['code' => $httpcode, 'message' => 'Something wrong! ' . json_encode($th)];
        }

        if ($httpcode == 200) {
            $response['message'] = 'Success!';
        } else {
            $response['data'] = null;
        }
        return $response;
    }
}
