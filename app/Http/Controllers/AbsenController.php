<?php

namespace App\Http\Controllers;
use App\Models\Absen;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index(): View
    {
        //get posts
        $absens = Absen::latest()->paginate(5);

        //render view with posts
        return view('form', compact('absens'));
    }
    public function create(): View
    {
        return view('form');
    }
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'norek' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'levelJabatan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unitKantor' => 'required|string|max:255',
            'foto'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'ttd' => 'required|string|max:255',
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('public/absens', $image->hashName());

        //create post
        Absen::create([
            'nama' => $request->input('nama'),
            'norek' => $request->input('norek'),
            'nik' => $request->input('nik'),
            'levelJabatan' => $request->input('levelJabatan'),
            'jabatan' => $request->input('jabatan'),
            'unitKantor' => $request->input('unitKantor'),
            'foto'     => $image->hashName(),
            'ttd' => $request->input('ttd'),
        ]);

        //redirect to index
        return redirect()->route('absens.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
