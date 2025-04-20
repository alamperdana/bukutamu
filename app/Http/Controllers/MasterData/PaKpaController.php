<?php

namespace App\Http\Controllers\MasterData;

use App\Models\PaKpa;
use App\Models\Pangkat;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\PaKpaDataTable;
use App\Http\Requests\MasterData\PaKpaRequest;

class PaKpaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaKpaDataTable $datatable)
    {
        return $datatable->render('pages.master-data.pakpa');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pangkat = Pangkat::all();

        return view('pages.master-data.pakpa-form', [
            'data' => new PaKpa(),
            'action' => route('master-data.pakpa.store'),
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaKpaRequest $request, PaKpa $pakpa)
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $pakpa->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
            'payes'
        ]));
        $pakpa->pangkat_id = $request->pangkat_id;
        $pakpa->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username
        ]);
        $pakpa->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(PaKpa $pakpa)
    {
        $pakpa->load('pangkat');

        return view('pages.master-data.pakpa-form', [
            'data' => $pakpa,
            'action' => null,
            'pangkat' => Pangkat::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaKpa $pakpa)
    {
        $pangkat = Pangkat::all();

        return view('pages.master-data.pakpa-form', [
            'data' => $pakpa,
            'action' => route('master-data.pakpa.update', $pakpa->id),
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaKpaRequest $request, PaKpa $pakpa)
    {
        $pakpa->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
            'payes'
        ]));
        $pakpa->pangkat_id = $request->pangkat_id;

        $pakpa->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaKpa $pakpa)
    {
        $pakpa->delete();
        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip PA/KPA
     */
    public function archive()
    {
        $archivedPaKpa = PaKpa::onlyTrashed()->get();

        return view('pages.master-data.pakpa-arsip', compact('archivedPaKpa'));
    }

    /**
     * Fungsi restore PA/KPA
     */
    public function restore($id)
    {
        $pakpa = PaKpa::onlyTrashed()->find($id);
        $pakpa->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete PA/KPA
     */
    public function destroyPermanent($id)
    {
        $pakpa = PaKpa::onlyTrashed()->find($id);
        $pakpa->forceDelete();

        return responseSuccessForceDelete();
    }
}
