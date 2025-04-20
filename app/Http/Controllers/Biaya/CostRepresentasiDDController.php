<?php

namespace App\Http\Controllers\Biaya;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Biaya\CostRepresentasi;
use App\Models\Biaya\CostRepresentasiDD;
use App\DataTables\Biaya\CostRepresentasiDDDataTable;
use App\Http\Requests\Biaya\CostRepresentasiDDRequest;

class CostRepresentasiDDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostRepresentasiDDDataTable $datatable)
    {
        return $datatable->render('pages.biaya.representasi-dd');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.biaya.representasi-dd-form', [
            'data' => new CostRepresentasiDD(),
            'action' => route('biaya.ddrepresentasi.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostRepresentasiDDRequest $request, CostRepresentasiDD $ddrepresentasi)
    {
        $ddrepresentasi->fill($request->only([
            'satuan',
            'lev_1',
            'lev_2',
            'lev_3',
        ]));
        $ddrepresentasi->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(CostRepresentasiDD $ddrepresentasi)
    {
        return view('pages.biaya.representasi-dd-form', [
            'data' => $ddrepresentasi,
            'action' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostRepresentasiDD $ddrepresentasi)
    {
        return view('pages.biaya.representasi-dd-form', [
            'data' => $ddrepresentasi,
            'action' => route('biaya.ddrepresentasi.update', $ddrepresentasi->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostRepresentasiDDRequest $request, CostRepresentasiDD $ddrepresentasi)
    {
        $ddrepresentasi->fill($request->only([
            'satuan',
            'lev_1',
            'lev_2',
            'lev_3',
        ]));
        $ddrepresentasi->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostRepresentasiDD $ddrepresentasi)
    {
        $ddrepresentasi->delete();

        return responseSuccessDelete();
    }
}
