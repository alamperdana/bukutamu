<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\PaguRequest;
use App\Models\Belanja;
use App\Models\Pagu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaguController extends Controller
{
    // Menampilkan modal form untuk Pagu
    public function paguModal($id)
    {
        // Mengambil data Belanja berdasarkan ID
        $belanja = Belanja::findOrFail($id);
        
        // Mengambil semua data Pagu yang berhubungan dengan Belanja
        $paguItems = $belanja->pagu;

        // Ambil semua ID pagu yang ada di form
        $formIds = $paguItems->pluck('id')->toArray();
        Log::info('Form IDs:', $formIds);

        // Menampilkan halaman form dengan data yang dibutuhkan
        return view('pages.master-data.pagu-form', [
            'data' => $belanja,
            'paguItems' => $paguItems,
            'action' => route('master-data.rekening.paguStore', $belanja->id),
        ]);
    }

    // Menyimpan data Pagu baru atau memperbarui data yang ada
    public function storePagu(PaguRequest $request, $belanjaId)
    {
        // Temukan data Belanja berdasarkan ID
        $belanja = Belanja::findOrFail($belanjaId);
    
        // Ambil semua ID pagu yang ada di form
        $formIds = collect($request->input('pagu', []))->pluck('id')->filter()->toArray();
        Log::info('Form IDs:', $formIds);

        // Ambil semua ID pagu yang sudah ada di database
        $existingIds = $belanja->pagu()->pluck('id')->toArray();
    
        // Loop untuk data dari form
        foreach ($request->input('pagu', []) as $pagu) {
            $cleanedAmount = str_replace(['.', ','], ['', '.'], $pagu['amount']); // Format angka
            
            if (!empty($pagu['id'])) {
                // Jika ID ada, update data yang sesuai
                $existingPagu = $belanja->pagu()->where('id', $pagu['id'])->first();
                if ($existingPagu) {
                    $existingPagu->update([
                        'pagu' => $cleanedAmount,
                        'keterangan' => $pagu['description'],
                        'session_input' => json_encode([
                            'tahun' => session('tahun'),
                            'kode_satker' => session('kode_satker'),
                            'username' => auth()->user()->username,
                        ]),
                    ]);
                }
            } else {
                // Jika ID tidak ada, buat data baru
                $belanja->pagu()->create([
                    'pagu' => $cleanedAmount,
                    'keterangan' => $pagu['description'],
                    'session_input' => json_encode([
                        'tahun' => session('tahun'),
                        'kode_satker' => session('kode_satker'),
                        'username' => auth()->user()->username,
                    ]),
                ]);
            }
        }
    
        // Hapus data pagu yang tidak ada dalam form
        $idsToDelete = array_diff($existingIds, $formIds);
        $belanja->pagu()->whereIn('id', $idsToDelete)->forceDelete();
    
        return responseSuccess();
    }
}