<?php

namespace App\Http\Controllers\Biaya;

use App\DataTables\Biaya\CostTaxiDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Biaya\CostTaxiRequest;
use App\Models\Biaya\CostTaxi;
use Illuminate\Http\Request;

class CostTaxiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostTaxiDataTable $dataTable)
    {
        return $dataTable->render('pages.biaya.taxi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.biaya.taxi-form', [
            'data' => new CostTaxi(),
            'action' => route('biaya.taxi.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostTaxiRequest $request, CostTaxi $taxi)
    {
        $taxi->fill($request->only([
            'harga',
            'satuan'
        ]));
        $taxi->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(CostTaxi $taxi)
    {
        return view('pages.biaya.taxi-form', [
            'data' => $taxi,
            'action' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostTaxi $taxi)
    {
        return view('pages.biaya.taxi-form', [
            'data' => $taxi,
            'action' => route('biaya.taxi.update', $taxi->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostTaxiRequest $request, CostTaxi $taxi)
    {
        $taxi->fill($request->only([
            'harga',
            'satuan'
        ]));
        $taxi->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostTaxi $taxi)
    {
        $taxi->delete();

        return responseSuccessDelete();
    }
}
