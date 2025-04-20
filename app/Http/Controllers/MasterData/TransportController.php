<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\TransportDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\SatkerRequest;
use App\Http\Requests\MasterData\TransportRequest;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TransportDataTable $datatables)
    {
        return $datatables->render('pages.master-data.transport');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.transport-form', [
            'data' => new Transport(),
            'action' => route('master-data.transport.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransportRequest $request, Transport $transport)
    {
        $transport->fill($request->only('jenis_transportasi'));
        $transport->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Transport $transport)
    {
        return view('pages.master-data.transport-form', [
            'data' => $transport,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        return view('pages.master-data.transport-form', [
            'data' => $transport,
            'action' => route('master-data.transport.update', $transport->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportRequest $request, Transport $transport)
    {
        $transport->fill($request->only('jenis_transportasi'));
        $transport->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transport)
    {
        $transport->delete();

        return responseSuccessDelete();
    }

    /**
     * Fungsi untuk menampilkan data yang dihapus
     */
    public function archive()
    {
        $archivedTransport = Transport::onlyTrashed()->get();
        return view('pages.master-data.transport-arsip', compact('archivedTransport'));
    }

    /**
     * Fungsi untuk restore transport
     */
    public function restore($id)
    {
        $transport = Transport::onlyTrashed()->find($id);
        $transport->restore();

        return responseSuccessRestore();
    }

    /**
     * Fungsi untuk hapus permanen
     */
    public function destroyPermanent($id)
    {
        $transport = Transport::onlyTrashed()->find($id);
        $transport->forceDelete();

        return responseSuccessForceDelete();
    }
}
