<?php

namespace App\Http\Controllers\Biaya;

use App\DataTables\Biaya\CostUangHarianDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Biaya\CostUangHarianRequest;
use App\Models\Biaya\CostUangHarian;
use Illuminate\Http\Request;

class CostUangHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostUangHarianDataTable $datatable)
    {
        return $datatable->render('pages.biaya.uang-harian');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.biaya.uang-harian-form', [
            'data' => new CostUangHarian(),
            'action' => route('biaya.uangharian.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostUangHarianRequest $request, CostUangHarian $uangharian)
    {
        $uangharian->fill($request->only([
            'tujuan',
            'satuan',
            'lev_1',
            'lev_2',
        ]));
        $uangharian->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(CostUangHarian $uangharian)
    {
        return view('pages.biaya.uang-harian-form', [
            'data' => $uangharian,
            'action' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostUangHarian $uangharian)
    {
        return view('pages.biaya.uang-harian-form', [
            'data' => $uangharian,
            'action' => route('biaya.uangharian.update', $uangharian->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostUangHarianRequest $request, CostUangHarian $uangharian)
    {
        $uangharian->fill($request->only([
            'tujuan',
            'satuan',
            'lev_1',
            'lev_2',
        ]));
        $uangharian->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostUangHarian $uangharian)
    {
        $uangharian->delete();

        return responseSuccessDelete();
    }
}
