<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\EselonDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\EselonRequest;
use App\Models\Eselon;
use Illuminate\Http\Request;

class EselonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EselonDataTable $datatables)
    {
        return $datatables->render('pages.master-data.eselon');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.eselon-form', [
            'data' => new Eselon(),
            'action' => route('master-data.eselon.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EselonRequest $request, Eselon $eselon)
    {
        $eselon->fill($request->only('nama_eselon'));
        $eselon->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Eselon $eselon)
    {
        return view('pages.master-data.eselon-form', [
            'data' => $eselon,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eselon $eselon)
    {
        return view('pages.master-data.eselon-form', [
            'data' => $eselon,
            'action' => route('master-data.eselon.update', $eselon->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eselon $eselon)
    {
        $eselon->fill($request->only('nama_eselon'));
        $eselon->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eselon $eselon)
    {
        $eselon->delete();

        return responseSuccessDelete();
    }

    /**
     * Fungsi untuk menampilkan data yang dihapus
     */
    public function archive()
    {
        $archivedEselon = Eselon::onlyTrashed()->get();
        return view('pages.master-data.eselon-arsip', compact('archivedEselon'));
    }

    /**
     * Fungsi untuk restore transport
     */
    public function restore($id)
    {
        $eselon = Eselon::onlyTrashed()->find($id);
        $eselon->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi untuk hapus permanen
     */
    public function destroyPermanent($id)
    {
        $eselon = Eselon::onlyTrashed()->find($id);
        $eselon->forceDelete();

        return responseSuccessForceDelete();
    }
}
