<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use App\Models\Referensi\RefLayanan;
use App\DataTables\Referensi\RefLayananDataTable;
use App\Http\Requests\Referensi\LayananRequest;
use Illuminate\Http\Request;

class RefLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RefLayananDataTable $layanan)
    {
        return $layanan->render('pages.referensi.layanan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.referensi.layanan-form', [
            'data' => new RefLayanan(),
            'action' => route('referensi.layanan.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LayananRequest $request, RefLayanan $layanan)
    {
        $layanan->fill($request->only('layanan'));
        $layanan->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(RefLayanan $layanan)
    {
        return view('pages.referensi.layanan-form', [
            'data' => $layanan,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RefLayanan $layanan)
    {
        return view('pages.referensi.layanan-form', [
            'data' => $layanan,
            'action' => route('referensi.layanan.update', $layanan->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LayananRequest $request, RefLayanan $layanan)
    {
        $layanan->fill($request->only('layanan'));
        $layanan->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RefLayanan $layanan)
    {
        $layanan->delete();

        return responseSuccessDelete();
    }
}
