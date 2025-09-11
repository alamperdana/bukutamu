<?php

namespace App\Http\Controllers\Referensi;

use App\DataTables\Referensi\LokasiLayananDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Referensi\LokasiLayananRequest;
use App\Models\Referensi\Layanan;
use App\Models\Referensi\LokasiLayanan;
use Illuminate\Http\Request;

class LokasiLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LokasiLayananDataTable $datatable)
    {
        return $datatable->render('pages.referensi.lokasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.referensi.lokasi-form', [
            'data' => new LokasiLayanan(),
            'action' => route('referensi.lokasi.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LokasiLayananRequest $request, LokasiLayanan $lokasi)
    {
        $lokasi->fill($request->only('lokasi_layanan'));
        $lokasi->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(LokasiLayanan $lokasi)
    {
        return view('pages.referensi.lokasi-form', [
            'data' => $lokasi,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LokasiLayanan $lokasi)
    {
        return view('pages.referensi.lokasi-form', [
            'data' => $lokasi,
            'action' => route('referensi.lokasi.update', $lokasi->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LokasiLayananRequest $request, LokasiLayanan $lokasi)
    {
        $lokasi->fill($request->only('lokasi'));
        $lokasi->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LokasiLayanan $lokasi)
    {
        $lokasi->delete();

        return responseSuccessDelete();
    }
}
