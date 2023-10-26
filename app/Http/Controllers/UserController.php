<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index')->with([
            'user' => Auth::user(),
        ]);
    }

    public function data()
    {
        $user = User::isNotAdmin()->orderBy('id', 'desc')->get();

        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('user.update', $user->id) .'`)" class="btn btn-sm btn-success"><i class="bi bi-pencil""></i></button>
                    <button type="button" onclick="deleteData(`'. route('user.destroy', $user->id) .'`)" class="btn btn-sm btn-danger"><i class="bi bi-trash3""></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 1;
        $user->foto = '/img/user.jpg';
        $user->save();

        return redirect()->route('user.index')->with('success', 'User has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->has('password') && $request->password != "") 
            $user->password = bcrypt($request->password);
        $user->update();
        return redirect()->route('user.index')->with('success', 'User has been update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id)->delete();

        return response(null, 204);
    }

    public function profil()
    {
        $profil = auth()->user();
        return view('user.profil', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        
        $user->name = $request->name;
        if ($request->has('password') && $request->password != "") {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->password == $request->password_confirmation) {
                    $user->password = bcrypt($request->password);
                } else {
                    return redirect()->route('user.profil')->with('error', 'Konfirmasi Password tidak sesuai');
                }
            } else {
                return redirect()->route('user.profil')->with('error', 'Password lama tidak sesuai');
            }
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = 'foto-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('img/' . $nama, file_get_contents($file));
            $user->foto = "/storage/img/$nama";
        }

        $user->update();

        return redirect()->route('user.profil')->with('success', 'User has been update successfully.');
    }
}
