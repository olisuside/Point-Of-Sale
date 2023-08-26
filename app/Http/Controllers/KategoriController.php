<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori.index')->with([
            'user' => Auth::user(),
        ]);
    }

    public function data()
    {
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get();

        return datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('kategori.update', $kategori->id_kategori) .'`)" class="btn btn-sm btn-success"><i class="bi bi-pencil""></i></button>
                    <button onclick="deleteData(`'. route('kategori.destroy', $kategori->id_kategori) .'`)" class="btn btn-sm btn-danger btn-flat"><i class="bi bi-trash3"></i></button>
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
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('kategori.index')->with('success','Kategori has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);

        return response()->json($kategori);
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
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();

        return redirect()->route('kategori.index')->with('success', 'Kategori has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success','Kategori has been deleted successfully');
    }
}
