<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\PptkDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\PptkRequest;
use App\Models\Pangkat;
use App\Models\Pptk;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;

class PptkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PptkDataTable $datatable)
    {
        return $datatable->render('pages.master-data.pptk');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode_satker = session('kode_satker');
        $tahun = session('tahun');
        
        $pangkat = Pangkat::all();
        $subkegiatan = SubKegiatan::whereRaw("JSON_EXTRACT(session_input, '$.kode_satker') = ?", [$kode_satker])
            ->whereRaw("JSON_EXTRACT(session_input, '$.tahun') = ?", [$tahun])
            ->get();

        return view('pages.master-data.pptk-form', [
            'data' => new Pptk(),
            'action' => route('master-data.pptk.store'),
            'pangkat' => $pangkat,
            'subkegiatan' => $subkegiatan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PptkRequest $request, Pptk $pptk  )
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $pptk->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));
        $pptk->pangkat_id = $request->pangkat_id;
        $pptk->subkegiatan_id = $request->subkegiatan_id;
        $pptk->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username
        ]);
        $pptk->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pptk $pptk)
    {
        $pptk->load('pangkat', 'subkegiatan');

        return view('pages.master-data.pptk-form', [
            'data' => $pptk,
            'action' => null,
            'pangkat' => Pangkat::all(),
            'subkegiatan' => SubKegiatan::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pptk $pptk)
    {
        $pangkat = Pangkat::all();
        $subkegiatan = SubKegiatan::all();

        return view('pages.master-data.pptk-form', [
            'data' => $pptk,
            'action' => route('master-data.pptk.update', $pptk->id),
            'pangkat' => $pangkat,
            'subkegiatan' => $subkegiatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PptkRequest $request, Pptk $pptk)
    {
        $pptk->fill($request->only([
            'nama_lengkap',
            'nip',
            'jabatan',
        ]));
        $pptk->pangkat_id = $request->pangkat_id;
        $pptk->subkegiatan_id = $request->subkegiatan_id;

        $pptk->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pptk $pptk)
    {
        $pptk->delete();

        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip PPTK
     */
    public function archive()
    {
        $archivedPptk = Pptk::onlyTrashed()->get();

        return view('pages.master-data.pptk-arsip', compact('archivedPptk'));
    }

    /**
     * Fungsi restore PPTK
     */
    public function restore($id)
    {
        $pptk = Pptk::onlyTrashed()->find($id);
        $pptk->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete PPTK
     */
    public function destroyPermanent($id)
    {
        $pptk = Pptk::onlyTrashed()->find($id);
        $pptk->forceDelete();

        return responseSuccessForceDelete();
    }
}
