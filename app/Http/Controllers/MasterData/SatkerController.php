<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\SatkerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\SatkerRequest;
use App\Models\Satker;

class SatkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SatkerDataTable $satkerDataTable)
    {   
        return $satkerDataTable->render('pages.master-data.satker');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.satker-form', [
            'data' => new Satker(),
            'action' => route('master-data.satker.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SatkerRequest $request, Satker $satker)
    {
        $satker->fill($request->only(['kode_satker', 'name']));
        $satker->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Satker $satker)
    {
        return view('pages.master-data.satker-form', [
            'data' => $satker,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satker $satker)
    {
        return view('pages.master-data.satker-form', [
            'data' => $satker,
            'action' => route('master-data.satker.update', $satker->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SatkerRequest $request, Satker $satker)
    {
        $satker->fill($request->only(['kode_satker', 'name']));
        $satker->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satker $satker)
    {
        $satker->delete();

        return responseSuccessDelete();
    }

    /**
     * Fungsi arsip satker
     */
    public function archive() 
    {
        $archivedSatker = Satker::onlyTrashed()->get();

        return view('pages.master-data.satker-arsip', compact('archivedSatker'));
    }

    /**
     * Fungsi restore satker
     */
    public function restore($id) 
    {
        $satker = Satker::onlyTrashed()->find($id);
        $satker->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi force delete
     */
    public function destroyPermanent($id) 
    {
        $satker = Satker::onlyTrashed()->find($id);
        $satker->forceDelete();

        return responseSuccessForceDelete();
    }
}
