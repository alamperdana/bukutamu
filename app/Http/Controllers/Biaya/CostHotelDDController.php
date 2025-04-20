<?php

namespace App\Http\Controllers\Biaya;

use App\DataTables\Biaya\CostHotelDDDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Biaya\CostHotelDDRequest;
use App\Models\Biaya\CostHotelDD;
use Illuminate\Http\Request;

class CostHotelDDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostHotelDDDataTable $datatable)
    {
        return $datatable->render('pages.biaya.hotel-dd');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.biaya.hotel-dd-form', [
            'data' => new CostHotelDD(),
            'action' => route('biaya.ddhotel.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostHotelDDRequest $request, CostHotelDD $ddhotel)
    {
        $ddhotel->fill($request->only([
            'satuan',
            'lev_1',
            'lev_2',
            'lev_3',
            'lev_4',
            'lev_5',
            'lev_6',
            'lev_7',
        ]));
        $ddhotel->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(CostHotelDD $ddhotel)
    {
        return view('pages.biaya.hotel-dd-form', [
            'data' => $ddhotel,
            'action' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostHotelDD $ddhotel)
    {
        return view('pages.biaya.hotel-dd-form', [
            'data' => $ddhotel,
            'action' => route('biaya.ddhotel.update', $ddhotel->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostHotelDDRequest $request, CostHotelDD $ddhotel)
    {
        $ddhotel->fill($request->only([
            'satuan',
            'lev_1',
            'lev_2',
            'lev_3',
            'lev_4',
            'lev_5',
            'lev_6',
            'lev_7',
        ]));
        $ddhotel->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostHotelDD $ddhotel)
    {
        $ddhotel->delete();

        return responseSuccessDelete();
    }
}
