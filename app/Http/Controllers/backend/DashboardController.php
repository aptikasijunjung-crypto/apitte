<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Crypt, DB, Hash};
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Faker\Guesser\Name;

class DashboardController extends Controller
{
    public function index()
    {
        // return Auth::guard('admin')->user();
        $data = [];
        return view('backend.home.home', ['data' => $data]);
    }
    public function create(Request $request)
    {
        $slug = Crypt::decrypt($request->slug);
        $data = [
            'slug' => $slug,
            'detail' => DB::table('users')->where('id', $slug['id'])->get()->first()
        ];
        return view('backend.home.create', ['data' => $data]);
    }

    public function store(Request $request)
    {
        if (empty($request->id)) {
            try {
                $data = $request->validate([
                    'name' => ['required', 'string'],
                    'email' => ['required', 'email'],
                    'password' => [Password::min(8)->letters()->mixedCase()->symbols()],
                ]);
                $data['kegunaan'] = $request->kegunaan;
                User::create($data);
                return redirect()->route('dashboard');
            } catch (ValidationException $e) {
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        } else {
            if (empty($request->password)) {
                try {
                    $data = $request->validate([
                        'name' => ['required', 'string'],
                        'email' => ['required', 'email'],

                    ]);
                    $data['kegunaan'] = $request->kegunaan;
                    DB::table('users')->where('id', $request->id)->update($data);
                    return redirect()->route('dashboard');
                } catch (ValidationException $e) {
                } catch (\Exception $e) {
                    return back()->with('error', $e->getMessage());
                }
            } else {
                try {
                    $data = $request->validate([
                        'name' => ['required', 'string'],
                        'email' => ['required', 'email'],
                        'password' => [Password::min(8)->letters()->mixedCase()->symbols()],
                    ]);
                    $data['kegunaan'] = $request->kegunaan;
                    $data['password'] = Hash::make($request->password);
                    DB::table('users')->where('id', $request->id)->update($data);
                    return redirect()->route('dashboard');
                } catch (ValidationException $e) {
                } catch (\Exception $e) {
                    return back()->with('error', $e->getMessage());
                }
            }
        }
    }

    public function modald(Request $request)
    {
        $data = [
            'id' => $request->id
        ];
        return view("backend.home.modald", ['data' => $data]);
    }

    public function delete(Request $request)
    {
        try {
            DB::table('users')->where('id', $request->id)->delete();
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
