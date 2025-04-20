<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\BendaharaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\BendaharaRequest;
use App\Models\Bendahara;
use App\Models\Pangkat;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BendaharaDataTable $datatable)
    {
        return $datatable->render('pages.master-data.bendahara');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pangkat = Pangkat::all();

        return view('pages.master-data.bendahara-form', [
            'data' => new Bendahara(),
            'action' => route('master-data.bendahara.store'),
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BendaharaRequest $request, Bendahara $bendahara)
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $bendahara->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));
        $bendahara->pangkat_id = $request->pangkat_id;
        $bendahara->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username
        ]);
        $bendahara->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Bendahara $bendahara)
    {
        $bendahara->load('pangkat');

        return view('pages.master-data.bendahara-form', [
            'data' => $bendahara,
            'action' => null,
            'pangkat' => Pangkat::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bendahara $bendahara)
    {
        $pangkat = Pangkat::all();

        return view('pages.master-data.bendahara-form', [
            'data' => $bendahara,
            'action' => route('master-data.bendahara.update', $bendahara->id),
            'pangkat' => $pangkat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BendaharaRequest $request, Bendahara $bendahara)
    {
        $bendahara->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));
        $bendahara->pangkat_id = $request->pangkat_id;

        $bendahara->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bendahara $bendahara)
    {
        $bendahara->delete();

        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip Bendahara
     */
    public function archive()
    {
        $archivedBendahara = Bendahara::onlyTrashed()->get();

        return view('pages.master-data.bendahara-arsip', compact('archivedBendahara'));
    }

    /**
     * Fungsi restore Bendahara
     */
    public function restore($id)
    {
        $bendahara = Bendahara::onlyTrashed()->find($id);
        $bendahara->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete Bendahara
     */
    public function destroyPermanent($id)
    {
        $bendahara = Bendahara::onlyTrashed()->find($id);
        $bendahara->forceDelete();

        return responseSuccessForceDelete();
    }
}
