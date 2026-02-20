<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        $data = [
            'nik' => '0803202100007062',
            'passphrase' => 'Bsre2026.#!',
            'signatureProperties' => [
                [
                    "imageBase64" => base64_encode(file_get_contents(public_path('8734409041.png'))),
                    "tampilan" => "VISIBLE",
                    "page" => 1,
                    "originX" => 0.0,
                    "originY" => 0.0,
                    "width" => 100.0,
                    "height" => 75.0
                ]

            ],
            'file' => [
                base64_encode(file_get_contents(public_path('154902178.pdf')))
            ],
        ];
        // return response()->json($data);
        $response = Http::withBody(json_encode($data))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ZXNpZ246cXdlcnR5'
            ])->post("http://36.67.236.171:8194/api/v2/sign/pdf");
        $jd = json_decode($response, true);
        return $jd['file'][0];
    }
}
