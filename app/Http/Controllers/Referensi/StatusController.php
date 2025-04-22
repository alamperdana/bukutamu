<?php

namespace App\Http\Controllers\Referensi;

use App\DataTables\Referensi\StatusDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Referensi\StatusRequest;
use App\Models\Referensi\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StatusDataTable $datatable)
    {
        return $datatable->render('pages.referensi.status');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.referensi.status-form', [
            'data' => new Status(),
            'action' => route('referensi.status.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusRequest $request, Status $status)
    {
        $status->fill($request->only('status'));
        $status->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        return view('pages.referensi.status-form', [
            'data' => $status,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        return view('pages.referensi.status-form', [
            'data' => $status,
            'action' => route('referensi.status.update', $status->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusRequest $request, Status $status)
    {
        $status->fill($request->only('status'));
        $status->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $status->delete();

        return responseSuccessDelete();
    }
}
