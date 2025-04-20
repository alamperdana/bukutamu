<?php

namespace App\Http\Controllers\Biaya;

use App\DataTables\Biaya\CostHarianDDDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Biaya\CostHarianDDRequest;
use App\Models\Biaya\CostHarianDD;
use Illuminate\Http\Request;

use function Termwind\render;

class CostHarianDDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostHarianDDDataTable $datatable)
    {
        return $datatable->render('pages.biaya.harian-dd');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.biaya.harian-dd-form', [
            'data' => new CostHarianDD(),
            'action' => route('biaya.ddharian.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostHarianDDRequest $request, Costhariandd $ddharian)
    {
        $ddharian->fill($request->only([
            'tujuan',
            'satuan',
            'lev_1',
            'lev_2',
            'lev_3',
            'lev_4',
            'lev_5',
            'lev_6',
        ]));
        $ddharian->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(CostHarianDD $ddharian)
    {
        return view('pages.biaya.harian-dd-form', [
            'data' => $ddharian,
            'action' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostHarianDD $ddharian)
    {
        return view('pages.biaya.harian-dd-form', [
            'data' => $ddharian,
            'action' => route('biaya.ddharian.update', $ddharian->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostHarianDDRequest $request, CostHarianDD $ddharian)
    {
        $ddharian->fill($request->only([
            'tujuan',
            'satuan',
            'lev_1',
            'lev_2',
            'lev_3',
            'lev_4',
            'lev_5',
            'lev_6',
        ]));
        $ddharian->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostHarianDD $ddharian)
    {
        $ddharian->delete();

        return responseSuccessDelete();
    }
}
