<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\SubKegiatanDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\SubKegiatanRequest;
use App\Models\Satker;
use App\Models\SubKegiatan;

class SubKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubKegiatanDataTable $SubKegiatanDataTable)
    {
        return $SubKegiatanDataTable->render('pages.master-data.subkegiatan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satker = Satker::all();

        return view('pages.master-data.subkegiatan-form', [
            'data' => new SubKegiatan(),
            'action' => route('master-data.subkegiatan.store'),
            'satkers' => $satker,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubKegiatanRequest $request, SubKegiatan $subkegiatan)
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $subkegiatan->fill($request->only(['kode_subkegiatan', 'subkegiatan']));
        $subkegiatan->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username,
        ]);
        $subkegiatan->instansi_anggaran = $request->instansi_anggaran;
        $subkegiatan->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKegiatan $subkegiatan)
    {
        $subkegiatan->load('satker');
        return view('pages.master-data.subkegiatan-form', [
            'data' => $subkegiatan,
            'satkers' => Satker::all('kode_satker', 'name'),
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubKegiatan $subkegiatan)
    {
        return view('pages.master-data.subkegiatan-form', [
            'data' => $subkegiatan,
            'action' => route('master-data.subkegiatan.update', $subkegiatan->id),
            'satkers' => Satker::all('kode_satker', 'name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubKegiatanRequest $request, SubKegiatan $subkegiatan)
    {
        $kode_satker = $request->instansi_anggaran;

        $subkegiatan->fill($request->only(['kode_subkegiatan', 'subkegiatan']));
        $subkegiatan->instansi_anggaran = $kode_satker;
        $subkegiatan->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubKegiatan $subkegiatan)
    {
        $subkegiatan->delete();

        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip subkegiatan
     */
    public function archive()
    {
        $username = auth()->user()->username;

        if (auth()->user()->hasRole('super admin')) {
            $archivedSubKegiatan = SubKegiatan::onlyTrashed()->get();
        } else {
            $archivedSubKegiatan = SubKegiatan::onlyTrashed()->whereJsonContains('session_input->username', $username)->get();
        }
        
        return view('pages.master-data.subkegiatan-arsip', compact('archivedSubKegiatan'));
    }

    /**
     * Fungsi restore subkegiatan
     */
    public function restore($id)
    {
        $subkegiatan = SubKegiatan::onlyTrashed()->find($id);
        $subkegiatan->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete subkegiatan
     */
    public function destroyPermanent($id)
    {
        $subkegiatan = SubKegiatan::onlyTrashed()->find($id);
        $subkegiatan->forceDelete();

        return responseSuccessForceDelete();
    }
}
