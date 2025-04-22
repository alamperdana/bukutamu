<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Models\Referensi\Layanan;
use App\Http\Controllers\Controller;
use App\DataTables\Referensi\LayananDataTable;
use App\Http\Requests\Referensi\LayananRequest;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LayananDataTable $datatable)
    {
        return $datatable->render('pages.referensi.layanan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.referensi.layanan-form', [
            'data' => new Layanan(),
            'action' => route('referensi.layanan.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LayananRequest $request, Layanan $layanan)
    {
        $layanan->fill($request->only('layanan'));
        $layanan->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        return view('pages.referensi.layanan-form', [
            'data' => $layanan,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('pages.referensi.layanan-form', [
            'data' => $layanan,
            'action' => route('referensi.layanan.update', $layanan->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LayananRequest $request, Layanan $layanan)
    {
        $layanan->fill($request->only('layanan'));
        $layanan->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return responseSuccessDelete();
    }
}
