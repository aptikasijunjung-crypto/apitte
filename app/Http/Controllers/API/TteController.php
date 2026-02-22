<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Http};
use App\Http\Controllers\Controller;

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

    public function tte(Request $request)
    {
        $cek = DB::table('nik as a')->join('users as b', 'a.user_id', '=', 'b.id')
            ->where('a.nik', $request->nik)
            ->where('b.id', Auth::user()->id)->count();
        if (empty($cek)) {
            return response()->json([
                'response_code' => 404,
                'status'        => 'Tanda Tangan Tidak Ditemukan, NIK yang di masukkan tidak terdaftar',
            ]);
        } else {
            $data = [
                'nik' => $request->nik,
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
}
