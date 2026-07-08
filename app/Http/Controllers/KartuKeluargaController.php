<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kartu-keluarga.index', [
            'title' => 'Kartu Keluarga',
            'kartuKeluargas' => KartuKeluarga::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kartu-keluarga.create', [
            'title' => 'Tambah Kartu Keluarga',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'no_kk' => 'required|digits:16|unique:kartu_keluarga,no_kk',
            'alamat' => 'required',
            'rt' => 'required|max:10',
            'rw' => 'required|max:10',
            'desa_kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
        ], [
            'no_kk.required' => 'Nomor Kartu Keluarga wajib diisi',
            'no_kk.digits' => 'Nomor Kartu Keluarga harus berupa 16 digit angka',
            'no_kk.unique' => 'Nomor Kartu Keluarga sudah terdaftar',
            'alamat.required' => 'Alamat wajib diisi',
            'rt.required' => 'RT wajib diisi',
            'rt.max' => 'RT maksimal 10 karakter',
            'rw.required' => 'RW wajib diisi',
            'rw.max' => 'RW maksimal 10 karakter',
            'desa_kelurahan.required' => 'Desa/Kelurahan wajib diisi',
            'kecamatan.required' => 'Kecamatan wajib diisi',
            'kabupaten_kota.required' => 'Kabupaten/Kota wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            KartuKeluarga::create($validate);

            DB::commit();
            return to_route('kartu-keluarga.index')->withSuccess('Data Kartu Keluarga berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('kartu-keluarga.create')->withError('Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KartuKeluarga $kartuKeluarga)
    {
        return view('kartu-keluarga.show', [
            'title' => 'Detail Kartu Keluarga',
            'kartuKeluarga' => $kartuKeluarga,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KartuKeluarga $kartuKeluarga)
    {
        return view('kartu-keluarga.edit', [
            'title' => 'Edit Kartu Keluarga',
            'kartuKeluarga' => $kartuKeluarga,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KartuKeluarga $kartuKeluarga)
    {
        $validate = $request->validate([
            'no_kk' => 'required|digits:16|unique:kartu_keluarga,no_kk,' . $kartuKeluarga->id,
            'alamat' => 'required',
            'rt' => 'required|max:10',
            'rw' => 'required|max:10',
            'desa_kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
        ], [
            'no_kk.required' => 'Nomor Kartu Keluarga wajib diisi',
            'no_kk.digits' => 'Nomor Kartu Keluarga harus berupa 16 digit angka',
            'no_kk.unique' => 'Nomor Kartu Keluarga sudah terdaftar',
            'alamat.required' => 'Alamat wajib diisi',
            'rt.required' => 'RT wajib diisi',
            'rt.max' => 'RT maksimal 10 karakter',
            'rw.required' => 'RW wajib diisi',
            'rw.max' => 'RW maksimal 10 karakter',
            'desa_kelurahan.required' => 'Desa/Kelurahan wajib diisi',
            'kecamatan.required' => 'Kecamatan wajib diisi',
            'kabupaten_kota.required' => 'Kabupaten/Kota wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            $kartuKeluarga->update($validate);

            DB::commit();
            return to_route('kartu-keluarga.index')->withSuccess('Data Kartu Keluarga berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('kartu-keluarga.edit', $kartuKeluarga)->withError('Gagal mengubah data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KartuKeluarga $kartuKeluarga)
    {
        DB::beginTransaction();

        try {
            $kartuKeluarga->delete();

            DB::commit();
            return to_route('kartu-keluarga.index')->withSuccess('Data Kartu Keluarga berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('kartu-keluarga.index')->withError('Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
