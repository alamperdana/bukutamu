<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\PangkatDataTable;
use App\Http\Requests\MasterData\PangkatRequest;
use Spatie\ErrorSolutions\SolutionProviders\Laravel\ViewNotFoundSolutionProvider;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PangkatDataTable $dataTable)
    {
        return $dataTable->render('pages.master-data.pangkat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.pangkat-form', [
            'data' => new Pangkat(),
            'action' => route('master-data.pangkat.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PangkatRequest $request, Pangkat $pangkat)
    {

        $pangkat->fill($request->only(['pangkat', 'golongan', 'pnsyes']));
        $pangkat->save();

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pangkat $pangkat)
    {
        return view('pages.master-data.pangkat-form', [
            'data' => $pangkat,
            'action' => null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pangkat $pangkat)
    {
        return view('pages.master-data.pangkat-form', [
            'data' => $pangkat,
            'action' => route('master-data.pangkat.update', $pangkat->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pangkat $pangkat)
    {
        $pangkat->fill($request->only(['pangkat', 'golongan', 'pnsyes']));
        $pangkat->save();

        return responseSuccess(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pangkat $pangkat)
    {
        $pangkat->delete();

        return responseSuccessDelete();
    }
}
