<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Eselon;
use App\Models\Satker;
use App\Models\Pangkat;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\PegawaiDataTable;
use App\Http\Requests\MasterData\PegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PegawaiDataTable $PegawaiDataTable)
    {
        return $PegawaiDataTable->render('pages.master-data.pegawai');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pangkat = Pangkat::all();
        $satker = Satker::all();
        $eselon = Eselon::all();

        return view('pages.master-data.pegawai-form', [
            'data' => new Pegawai(),
            'action' => route('master-data.pegawai.store'),
            'satker' => $satker,
            'pangkat' => $pangkat,
            'eselon' => $eselon
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PegawaiRequest $request, Pegawai $pegawai)
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $pegawai->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));
        $pegawai->eselon_id = $request->eselon_id;
        $pegawai->pangkat_id = $request->pangkat_id;
        $pegawai->satker_id = $request->satker_id;
        $pegawai->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username
        ]);
        $pegawai->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        $pegawai->load('pangkat', 'satker');

        return view('pages.master-data.pegawai-form', [
            'data' => $pegawai,
            'action' => null,
            'satker' => Satker::all(),
            'pangkat' => Pangkat::all(),
            'eselon' => Eselon::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $eselon = Eselon::all();
        $pangkat = Pangkat::all();
        $satker = Satker::all();

        return view('pages.master-data.pegawai-form', [
            'data' => $pegawai,
            'action' => route('master-data.pegawai.update', $pegawai->id),
            'satker' => $satker,
            'pangkat' => $pangkat,
            'eselon' => $eselon
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PegawaiRequest $request, Pegawai $pegawai)
    {
        $pegawai->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));

        $pegawai->eselon_id = $request->eselon_id;
        $pegawai->pangkat_id = $request->pangkat_id;
        $pegawai->satker_id = $request->satker_id;

        $pegawai->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip Pegawai
     */
    public function archive()
    {
        $archivedPegawai = Pegawai::onlyTrashed()->get();

        return view('pages.master-data.pegawai-arsip', compact('archivedPegawai'));
    }

    /**
     * Fungsi restore Pegawai
     */
    public function restore($id)
    {
        $pegawai = Pegawai::onlyTrashed()->find($id);
        $pegawai->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete Pegawai
     */
    public function destroyPermanent($id)
    {
        $pegawai = Pegawai::onlyTrashed()->find($id);
        $pegawai->forceDelete();

        return responseSuccessForceDelete();
    }
}
