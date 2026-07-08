<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penduduk.index', [
            'title' => 'Penduduk',
            'penduduks' => Penduduk::with('kartuKeluarga')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penduduk.create', [
            'title' => 'Tambah Penduduk',
            'kartuKeluargas' => KartuKeluarga::orderBy('no_kk')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kk_id' => 'required|exists:kartu_keluarga,id',
            'nik' => 'required|digits:16|unique:penduduk,nik',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => 'required',
            'status_hidup' => 'required|boolean',
        ], [
            'kk_id.required' => 'Kartu Keluarga wajib dipilih',
            'kk_id.exists' => 'Kartu Keluarga tidak valid',
            'nik.required' => 'NIK wajib diisi',
            'nik.digits' => 'NIK harus berupa 16 digit angka',
            'nik.unique' => 'NIK sudah terdaftar',
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi',
            'tanggal_lahir.date' => 'Format Tanggal Lahir tidak valid',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis Kelamin tidak valid',
            'agama.required' => 'Agama wajib diisi',
            'pendidikan.required' => 'Pendidikan wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'status_perkawinan.required' => 'Status Perkawinan wajib diisi',
            'status_hidup.required' => 'Status Hidup wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            Penduduk::create($validate);

            DB::commit();
            return to_route('penduduk.index')->withSuccess('Data Penduduk berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('penduduk.create')->withError('Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        return view('penduduk.show', [
            'title' => 'Detail Penduduk',
            'penduduk' => $penduduk->load('kartuKeluarga'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', [
            'title' => 'Edit Penduduk',
            'penduduk' => $penduduk,
            'kartuKeluargas' => KartuKeluarga::orderBy('no_kk')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $validate = $request->validate([
            'kk_id' => 'required|exists:kartu_keluarga,id',
            'nik' => 'required|digits:16|unique:penduduk,nik,' . $penduduk->id,
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => 'required',
            'status_hidup' => 'required|boolean',
        ], [
            'kk_id.required' => 'Kartu Keluarga wajib dipilih',
            'kk_id.exists' => 'Kartu Keluarga tidak valid',
            'nik.required' => 'NIK wajib diisi',
            'nik.digits' => 'NIK harus berupa 16 digit angka',
            'nik.unique' => 'NIK sudah terdaftar',
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi',
            'tanggal_lahir.date' => 'Format Tanggal Lahir tidak valid',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis Kelamin tidak valid',
            'agama.required' => 'Agama wajib diisi',
            'pendidikan.required' => 'Pendidikan wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'status_perkawinan.required' => 'Status Perkawinan wajib diisi',
            'status_hidup.required' => 'Status Hidup wajib diisi',
        ]);

        DB::beginTransaction();

        try {
            $penduduk->update($validate);

            DB::commit();
            return to_route('penduduk.index')->withSuccess('Data Penduduk berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('penduduk.edit', $penduduk)->withError('Gagal mengubah data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        DB::beginTransaction();

        try {
            $penduduk->delete();

            DB::commit();
            return to_route('penduduk.index')->withSuccess('Data Penduduk berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('penduduk.index')->withError('Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
