<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\PPKomDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\PPKomRequest;
use App\Models\Pangkat;
use App\Models\PPKom;
use Illuminate\Http\Request;

class PPKomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PPKomDataTable $datatable)
    {
        return $datatable->render('pages.master-data.ppkom');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pangkat = Pangkat::all();

        return view('pages.master-data.ppkom-form', [
            'data' => new PPKom(),
            'action' => route('master-data.ppk.store'),
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PPKomRequest $request, PPKom $ppk)
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $ppk->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));
        $ppk->pangkat_id = $request->pangkat_id;
        $ppk->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username
        ]);
        $ppk->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(PPKom $ppk)
    {
        $ppk->load('pangkat');

        return view('pages.master-data.ppkom-form', [
            'data' => $ppk,
            'action' => null,
            'pangkat' => Pangkat::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PPKom $ppk)
    {
        $pangkat = Pangkat::all();

        return view('pages.master-data.ppkom-form', [
            'data' => $ppk,
            'action' => route('master-data.pakpa.update', $ppk->id),
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PPKomRequest $request, PPKom $ppk)
    {
        $ppk->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));
        $ppk->pangkat_id = $request->pangkat_id;

        $ppk->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PPKom $ppk)
    {
        $ppk->delete();
        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip PPKom
     */
    public function archive()
    {
        $archivedPpk = PPKom::onlyTrashed()->get();

        return view('pages.master-data.ppkom-arsip', compact('archivedPpk'));
    }

    /**
     * Fungsi restore PPKom
     */
    public function restore($id)
    {
        $ppk = PPKom::onlyTrashed()->find($id);
        $ppk->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete PPKom
     */
    public function destroyPermanent($id)
    {
        $ppk = PPKom::onlyTrashed()->find($id);
        $ppk->forceDelete();

        return responseSuccessForceDelete();
    }
}
