<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Referensi\Status;
use App\Models\Referensi\Layanan;
use App\DataTables\AbsensiDataTable;
use App\Http\Requests\AbsensiRequest;
use App\Models\Referensi\LokasiLayanan;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Absensi $absensi)
    {
        $lokasi = LokasiLayanan::all();
        $layanan = Layanan::all();
        $status = Status::all();

        return view('pages.absensi-form', [
            'data' => new Absensi(),
            'lokasi' => $lokasi,
            'layanan' => $layanan,
            'status' => $status,
            'action' => route('absensi.store')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $lokasi = LokasiLayanan::all();
    //     $layanan = Layanan::all();
    //     $status = Status::all();

    //     return view('pages.absensi-form', [
    //         'data' => new Absensi(),
    //         'lokasi' => $lokasi,
    //         'layanan' => $layanan,
    //         'status' => $status,
    //         'action' => route('absensi.store')
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AbsensiRequest $request, Absensi $absensi)
    {
        // Mendapatkan alamat IP pengguna
        $ipAddress = $request->ip();

        // Memeriksa apakah pengguna dengan IP yang sama sudah mengisi buku tamu dalam 1 jam terakhir
        $lastVisit = Absensi::where('ip_address', $ipAddress)
                            ->where('created_at', '>=', now()->subHour()) // Cek pengisian dalam 1 jam terakhir
                            ->first();

        if ($lastVisit) {
            // Jika sudah mengisi dalam 1 jam terakhir, kembalikan response error
            return response()->json(['message' => 'Anda sudah mengisi buku tamu dalam 1 jam terakhir.'], 400);
        }

        // Menangani penyimpanan foto (jika ada)
        if ($request->has('photo_path')) {
            $photoData = $request->input('photo_path');
            
            // Decode base64 menjadi gambar
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photoData)); 
            
            // Menyimpan gambar di folder public/photos
            $photoPath = 'photos/' . uniqid() . '.png';
            Storage::disk('public')->put($photoPath, $image);
        } else {
            $photoPath = null;
        }

        // Mengisi data ke dalam model Absensi menggunakan fill()
        $absensi->fill($request->only([
            'lokasi_layanan_id',
            'asal',
            'jabatan',
            'nama',
            'no_telp',
            'layanan_id',
            'catatan',
            'latitude',
            'longitude',
        ]));

        // Menambahkan photo_path dan IP address yang telah diproses
        $absensi->photo_path = $photoPath;
        $absensi->ip_address = $ipAddress;
        $absensi->status_id = 1; // Menetapkan status ID secara otomatis, sesuaikan jika diperlukan

        // Menyimpan data ke dalam database
        $absensi->save();

        // Mengembalikan response sukses
        return responseSuccess();  // Ganti dengan fungsi atau format response yang sesuai dengan aplikasi Anda
    }



    /** 
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
