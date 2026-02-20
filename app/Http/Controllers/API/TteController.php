<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TteController extends Controller
{
    public function index(Request $request)
    {

        $data = [
            'nik' => '0803202100007062',
            // 'passphrase' => 'Bsre2026.#!',
            'passphrase' => $request->passphrase,
            'signatureProperties' => $request->signatureProperties,
            'file' => $request->file,
        ];

        $response = Http::withBody(json_encode($data))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ZXNpZ246cXdlcnR5'
            ])->post("http://36.67.236.171:8194/api/v2/sign/pdf");
        header("Content-type:application/json");
        $jd = json_decode($response);
        return response()->json($jd);
    }
}
