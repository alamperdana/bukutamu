<?php

namespace App\Http\Controllers\Biaya;

use App\DataTables\Biaya\CostRepresentasiDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Biaya\CostRepresentasiRequest;
use App\Models\Biaya\CostRepresentasi;
use Illuminate\Http\Request;

class CostRepresentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostRepresentasiDataTable $dataTable)
    {
        return $dataTable->render('pages.biaya.representasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.biaya.representasi-form', [
            'data' => new CostRepresentasi(),
            'action' => route('biaya.representasi.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostRepresentasiRequest $request, CostRepresentasi $representasi)
    {
        $representasi->fill($request->only([
            'walkot',
            'sekda',
            'eselon_2',
        ]));
        $representasi->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(CostRepresentasi $representasi)
    {
        return view('pages.biaya.representasi-form', [
            'data' => $representasi,
            'action' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostRepresentasi $representasi)
    {
        return view('pages.biaya.representasi-form', [
            'data' => $representasi,
            'action' => route('biaya.representasi.update', $representasi->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostRepresentasiRequest $request, CostRepresentasi $representasi)
    {
        $representasi->fill($request->only([
            'walkot',
            'sekda',
            'eselon_2',
        ]));
        $representasi->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostRepresentasi $representasi)
    {
        $representasi->delete();

        return responseSuccessDelete();
    }
}
