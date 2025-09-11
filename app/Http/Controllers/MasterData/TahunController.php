<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\TahunDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\TahunRequest;
use App\Models\Tahun;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Fill;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TahunDataTable $tahunDataTable)
    {
        return $tahunDataTable->render('pages.master-data.tahun');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.tahun-form', [
            'data' => new Tahun(),
            'action' => route('master-data.tahun.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TahunRequest $request, Tahun $tahun)
    {
        $tahun->fill($request->only(['tahun']));
        $tahun->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tahun $tahun)
    {
        return view('pages.master-data.tahun-form', [
            'data' => $tahun,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tahun $tahun)
    {
        return view('pages.master-data.tahun-form', [
            'data' => $tahun,
            'action' => route('master-data.tahun.update', $tahun->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TahunRequest $request, Tahun $tahun)
    {
        $tahun->fill($request->only(['tahun']));
        $tahun->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tahun $tahun)
    {
        $tahun->delete();

        return responseSuccessDelete();
    }

    // Fungsi untuk menampilkan data yang dihapus
    public function archive()
    {
        $archivedTahun = Tahun::onlyTrashed()->get();
        return view('pages.master-data.tahun-arsip', compact('archivedTahun'));
    }

    // Fungsi untuk restore tahun
    public function restore($id)
    {
        $tahun = Tahun::onlyTrashed()->find($id);
        $tahun->restore();

        return responseSuccessRestore();
    }

    // Fungsi untuk hapus permanen
    public function destroyPermanent($id)
    {
        $tahun = Tahun::onlyTrashed()->find($id);
        $tahun->forceDelete();

        return responseSuccessForceDelete();
    }
}
