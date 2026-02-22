<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Crypt, DB};
use App\Http\Controllers\Controller;
use App\Models\Nik;
use Dotenv\Exception\ValidationException;

class NikController extends Controller
{
    public function index(Request $request)
    {
        $slug = Crypt::decrypt($request->slug);
        $data = [
            'slug' => $slug
        ];
        return view('backend.nik.index', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $slug = Crypt::decrypt($request->slug);
        $data = [
            'slug' => $slug,
            'detail' => DB::table('nik')->where('id', $slug['id'])->get()->first()
        ];
        return view('backend.nik.create', ['data' => $data]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'nik' => 'required|string'

            ]);
            $data['user_id'] = $request->user_id;
            if (empty($request->id)) {
                Nik::create($data);
            } else {
                DB::table('nik')->where('id', $request->id)->update($data);
            }
            return redirect()->route('nik.index', ['slug' => Crypt::encrypt(['id' => $request->user_id, 'title' => $request->perusahaan])]);
        } catch (ValidationException $e) {
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
    public function modald(Request $request)
    {
        $data = [
            'id' => $request->id
        ];
        return view("backend.nik.modald", ['data' => $data]);
    }

    public function delete(Request $request)
    {
        try {
            DB::table('nik')->where('id', $request->id)->delete();
            $id = 1;
            $komen = "Data Sukses dihapus";
        } catch (\Exception $e) {
            $id = 0;
            $komen = $e->getMessage();
        }
        return response()->json([
            'id' => $id,
            'komen' => $komen,
            'vid' => $request->id
        ]);
    }
}
