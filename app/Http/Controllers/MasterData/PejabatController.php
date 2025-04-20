<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\PejabatDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\PejabatRequest;
use App\Models\Pangkat;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PejabatDataTable $datatable)
    {
        return $datatable->render('pages.master-data.pejabat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pangkat = Pangkat::all();

        return view('pages.master-data.pejabat-form', [
            'data' => new Pejabat(),
            'action' => route('master-data.pejabat.store'),
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PejabatRequest $request, Pejabat $pejabat)
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $pejabat->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan'
        ]));
        $pejabat->pangkat_id = $request->pangkat_id;
        $pejabat->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username
        ]);
        $pejabat->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pejabat $pejabat)
    {
        $pejabat->load('pangkat');

        return view('pages.master-data.pejabat-form', [
            'data' => $pejabat,
            'action' => null,
            'pangkat' => Pangkat::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pejabat $pejabat)
    {
        $pangkat = Pangkat::all();

        return view('pages.master-data.pejabat-form', [
            'data' => $pejabat,
            'action' => route('master-data.pejabat.update', $pejabat->id),
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PejabatRequest $request, Pejabat $pejabat)
    {
        $pejabat->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));
        $pejabat->pangkat_id = $request->pangkat_id;

        $pejabat->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pejabat $pejabat)
    {
        $pejabat->delete();
        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip Pejabat
     */
    public function archive()
    {
        $archivedPaKpa = Pejabat::onlyTrashed()->get();

        return view('pages.master-data.pejabat-arsip', compact('archivedPejabat'));
    }

    /**
     * Fungsi restore Pejabat
     */
    public function restore($id)
    {
        $pakpa = Pejabat::onlyTrashed()->find($id);
        $pakpa->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete Pejabat
     */
    public function destroyPermanent($id)
    {
        $pakpa = Pejabat::onlyTrashed()->find($id);
        $pakpa->forceDelete();

        return responseSuccessForceDelete();
    }
}
