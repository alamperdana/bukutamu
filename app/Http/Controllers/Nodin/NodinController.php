<?php

namespace App\Http\Controllers\Nodin;

use Carbon\Carbon;
use App\Models\Pejabat;
use App\Models\Nodin\Nodin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\DataTables\Nodin\NodinDataTable;

class NodinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NodinDataTable $nodin)
    {
        return $nodin->render('pages.nodin.nodin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pejabat = Pejabat::all();

        return view('pages.nodin.nodin-form', [
            'data' => new Nodin(),
            'action' => route('nota.nodin.store'),
            'pejabat' => $pejabat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Nodin $nodin)
    {
        $tahun = session('tahun', date('Y'));
        $kode_satker = session('kode_satker');
        $username = auth()->user()->username;

        $nodin->fill($request->only([
            'kepada',
            'melalui',
            'dari',
            'nomor',
            'tgl_nodin',
            'sifat',
            'lampiran',
            'perihal',
            'pejabat_id',
        ]));

        $nodin->isi_nodin = $request->isi_nodin;

        $nodin->session_input = json_encode([
            'tahun' => $tahun,
            'kode_satker' => $kode_satker,
            'username' => $username
        ]);
        $nodin->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Nodin $nodin)
    {
        $nodin->load('pejabat');

        return view('pages.nodin.nodin-pdf', [
            'data' => $nodin,
            'action' => null,
            'pejabat' => Pejabat::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nodin $nodin)
    {
        $nodin->tgl_nodin = $nodin->tgl_nodin ? Carbon::parse($nodin->tgl_nodin)->format('Y-m-d') : null;

        return view('pages.nodin.nodin-form', [
            'data' => $nodin,
            'action' => route('nota.nodin.update', $nodin->id),
            'pejabat' => Pejabat::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nodin $nodin)
    {
        $nodin->fill($request->only([
            'kepada',
            'melalui',
            'dari',
            'nomor',
            'tgl_nodin',
            'sifat',
            'lampiran',
            'perihal',
            'pejabat_id',
            'isi_nodin',
        ]));
        $nodin->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nodin $nodin)
    {
        $nodin->delete();

        return responseSuccessDelete();
    }

    /**
     * Generate PDF for the specified resource.
     */
    public function generatePdf($id)
    {   
        
        $nodin = Nodin::with('pejabat.pangkat')->find($id);
        
        Pdf::setOption([
            'dpi' => 150,
            'defaultFont' => 'Arial'
        ]);

        $pdf = PDF::loadView('pages.nodin.nodin-pdf', [
            'data' => $nodin
        ])->setPaper(array(0, 0, 609.4488, 935.433), 'portrait');

        return $pdf->stream('Nota-Dinas.pdf');
    }
}

