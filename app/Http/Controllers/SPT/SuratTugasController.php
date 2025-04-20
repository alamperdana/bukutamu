<?php

namespace App\Http\Controllers\SPT;

use App\Models\Pejabat;
use App\Models\Transport;
use App\Models\Nodin\Nodin;
use Illuminate\Http\Request;
use App\Models\SPT\SuratTugas;
use App\Http\Controllers\Controller;
use App\Models\Belanja;
use App\Models\SubKegiatan;

class SuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pejabat = Pejabat::all();
        $transport = Transport::all();
        $nodin = Nodin::all();
        $belanja = Belanja::all();
        $subkegiatan = SubKegiatan::all();

        return view('pages.spt.spt-form', [
            'data' => new SuratTugas(),
            'action' => route('surat.spt.store'),
            'pejabat' => $pejabat,
            'transport' => $transport,
            'nodin' => $nodin,
            'belanja' => $belanja,
            'subkegiatan' => $subkegiatan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratTugas $suratTugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratTugas $suratTugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratTugas $suratTugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratTugas $suratTugas)
    {
        //
    }
}
