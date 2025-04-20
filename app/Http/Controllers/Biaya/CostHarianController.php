<?php

namespace App\Http\Controllers\Biaya;

use App\DataTables\Biaya\CostHarianDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Biaya\CostHarianRequest;
use App\Models\Biaya\CostHarian;
use Illuminate\Http\Request;

class CostHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostHarianDataTable $datatable)
    {
        return $datatable->render('pages.biaya.harian');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.biaya.harian-form', [
            'data' => new CostHarian(),
            'action' => route('biaya.harian.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostHarianRequest $request, CostHarian $harian)
    {
        $harian->fill($request->only([
            'walkot',
            'sekda',
            'eselon_2',
            'eselon_3',
            'eselon_4',
            'gol_4',
            'gol_3',
            'gol_2',
            'gol_1',
            'tkk'
        ]));
        $harian->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(CostHarian $harian)
    {
        return view('pages.biaya.harian-form', [
            'data' => $harian,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostHarian $harian)
    {
        return view('pages.biaya.harian-form', [
            'data' => $harian,
            'action' => route('biaya.harian.update', $harian->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostHarianRequest $request, CostHarian $harian)
    {
        $harian->fill($request->only([
            'walkot',
            'sekda',
            'eselon_2',
            'eselon_3',
            'eselon_4',
            'gol_4',
            'gol_3',
            'gol_2',
            'gol_1',
            'tkk'
        ]));
        $harian->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostHarian $harian)
    {
        $harian->delete();

        return responseSuccessDelete();
    }
}
