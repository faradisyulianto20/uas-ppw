<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->get('keyword');

        $pegawai = Pegawai::with('pekerjaan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->paginate(10);

        return view('pegawai.index', compact('pegawai'));
    }

    public function add() {
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.add', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string',
            'email'         => 'required|email',
            'gender'        => 'required|in:male,female',
            'is_active'        => 'required|in:0,1',
            'pekerjaan_id'  => 'required|exists:pekerjaan,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pegawai = new Pegawai();
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->gender = $request->gender;
        $pegawai->is_active = $request->is_active;
        $pegawai->pekerjaan_id = $request->pekerjaan_id;
        $pegawai->save();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $pegawai = Pegawai::findOrFail($request->id);
        $pekerjaan = Pekerjaan::all();

        return view('pegawai.edit', compact('pegawai', 'pekerjaan'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string',
            'email'         => 'required|email',
            'gender'        => 'required|in:male,female',
            'is_active'        => 'required|in:0,1',
            'pekerjaan_id'  => 'required|exists:pekerjaan,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pegawai = Pegawai::findOrFail($request->id);
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->gender = $request->gender;
        $pegawai->is_active = $request->is_active;
        $pegawai->pekerjaan_id = $request->pekerjaan_id;
        $pegawai->save();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    /**
     * Hapus pegawai
     */
    public function destroy(Request $request)
    {
        Pegawai::findOrFail($request->id)->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus');
    }
}
