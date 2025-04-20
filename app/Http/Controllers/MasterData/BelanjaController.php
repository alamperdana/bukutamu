<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Belanja;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\BelanjaDataTable;
use App\Http\Requests\MasterData\BelanjaRequest;

class BelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BelanjaDataTable $belanjaDataTable)
    {
        return $belanjaDataTable->render('pages.master-data.belanja');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subkegiatans = SubKegiatan::whereRaw("JSON_EXTRACT(session_input, '$.tahun') = ?", [session('tahun')])
            ->whereRaw("JSON_EXTRACT(session_input, '$.kode_satker') = ?", [session('kode_satker')])
            ->get();

        return view('pages.master-data.belanja-form', [
            'data' => new Belanja(),
            'action' => route('master-data.rekening.store'),
            'subkegiatans' => $subkegiatans,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BelanjaRequest $request, Belanja $belanja)
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $belanja->fill($request->only(['kode_belanja', 'rekening_belanja', 'subkegiatan_id']));
        $belanja->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username,
        ]);
        $belanja->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Belanja $rekening)
    {
        // $belanja = Belanja::findOrFail($id);

        $rekening->load('subkegiatan');
        
        return view('pages.master-data.belanja-form', [
            'data' => $rekening,
            'action' => null,
            'subkegiatans' => subkegiatan::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Belanja $rekening)
    {
        $rekening->load('subkegiatan');

        return view('pages.master-data.belanja-form', [
            'data' => $rekening,
            'action' => route('master-data.rekening.update', $rekening->id),
            'subkegiatans' => SubKegiatan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BelanjaRequest $request, Belanja $rekening)
    {
        $rekening->fill($request->only(['kode_belanja', 'rekening_belanja', 'subkegiatan_id']));
        $rekening->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Belanja $rekening)
    {
        $rekening->delete();

        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip subkegiatan
     */
    public function archive()
    {
        $archivedBelanja = Belanja::onlyTrashed()->get();

        return view('pages.master-data.belanja-arsip', compact('archivedBelanja'));
    }

    /**
     * Fungsi restore subkegiatan
     */
    public function restore($id)
    {
        $belanja = Belanja::onlyTrashed()->find($id);
        $belanja->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete subkegiatan
     */
    public function destroyPermanent($id)
    {
        $belanja = Belanja::onlyTrashed()->find($id);
        $belanja->forceDelete();

        return responseSuccessForceDelete();
    }
}
