<?php

namespace App\Http\Controllers;

class FilterObjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $response = [];
        $json = json_decode(file_get_contents(__DIR__ . '/../../../' . env('FILTER_DATA')));
        foreach ($json->data->response->billdetails as $val) {
            $number = preg_replace('/DENOM|:|\s+/', '', $val->body[0]);
            if ((int) $number >= 100000) $response[] = (int) $number;
        }
        var_dump($response);
        return;
    }
}
