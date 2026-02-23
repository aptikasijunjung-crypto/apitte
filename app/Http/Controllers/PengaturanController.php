<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'detail' => DB::table('pengaturan')->where('id', 1)->get()->first()
        ];
        return view('backend.pengaturan.index', ['data' => $data]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'host_tte' => 'required|string'
        ]);
        $cek = DB::table('pengaturan')->where('id', 1)->count();
        if (empty($cek)) {
            DB::table('pengaturan')->insert([
                'id' => 1,
                'name' => $request->name,
                'host_tte' => $request->host_tte
            ]);
        } else {
            DB::table('pengaturan')->where('id', 1)->update([

                'name' => $request->name,
                'host_tte' => $request->host_tte
            ]);
        }
        return back();
    }
}
