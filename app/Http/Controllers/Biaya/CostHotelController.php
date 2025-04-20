<?php

namespace App\Http\Controllers\Biaya;

use App\DataTables\Biaya\CostHotelDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Biaya\CostHotelRequest;
use App\Models\Biaya\CostHotel;
use Illuminate\Http\Request;

class CostHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostHotelDataTable $datatable)
    {
        return $datatable->render('pages.biaya.hotel');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.biaya.hotel-form', [
            'data' => new CostHotel(),
            'action' => route('biaya.hotel.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostHotelRequest $request, CostHotel $hotel)
    {
        $hotel->fill($request->only([
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
        $hotel->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(CostHotel $hotel)
    {
        return view('pages.biaya.hotel-form', [
            'data' => $hotel,
            'action' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostHotel $hotel)
    {
        return view('pages.biaya.hotel-form', [
            'data' => $hotel,
            'action' => route('biaya.hotel.update', $hotel->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostHotelRequest $request, CostHotel $hotel)
    {
        $hotel->fill($request->only([
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
        $hotel->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostHotel $hotel)
    {
        $hotel->delete();

        return responseSuccessDelete();
    }
}
