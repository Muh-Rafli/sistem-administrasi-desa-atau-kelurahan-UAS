<?php

namespace App\Http\Controllers;

use App\Models\TipeSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipeSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tipe-surat.index', [
            'title' => 'Tipe Surat',
            'tipeSurats' => TipeSurat::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipe-surat.create', [
            'title' => 'Tambah Tipe Surat',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode_surat' => 'required|max:20|unique:tipe_surat,kode_surat',
            'nama_surat' => 'required',
            'template_konten' => 'required',
        ], [
            'kode_surat.required' => 'Kode Surat wajib diisi',
            'kode_surat.max' => 'Kode Surat maksimal 20 karakter',
            'kode_surat.unique' => 'Kode Surat sudah terdaftar',
            'nama_surat.required' => 'Nama Surat wajib diisi',
            'template_konten.required' => 'Template Konten wajib diisi',
        ]);

        // Biar seragam, jadikan kode_surat uppercase
        $validate['kode_surat'] = strtoupper($validate['kode_surat']);

        DB::beginTransaction();

        try {
            TipeSurat::create($validate);

            DB::commit();
            return to_route('tipe-surat.index')->withSuccess('Data Tipe Surat berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('tipe-surat.create')->withError('Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TipeSurat $tipeSurat)
    {
        return view('tipe-surat.show', [
            'title' => 'Detail Tipe Surat',
            'tipeSurat' => $tipeSurat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipeSurat $tipeSurat)
    {
        return view('tipe-surat.edit', [
            'title' => 'Edit Tipe Surat',
            'tipeSurat' => $tipeSurat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipeSurat $tipeSurat)
    {
        $validate = $request->validate([
            'kode_surat' => 'required|max:20|unique:tipe_surat,kode_surat,' . $tipeSurat->id,
            'nama_surat' => 'required',
            'template_konten' => 'required',
        ], [
            'kode_surat.required' => 'Kode Surat wajib diisi',
            'kode_surat.max' => 'Kode Surat maksimal 20 karakter',
            'kode_surat.unique' => 'Kode Surat sudah terdaftar',
            'nama_surat.required' => 'Nama Surat wajib diisi',
            'template_konten.required' => 'Template Konten wajib diisi',
        ]);

        $validate['kode_surat'] = strtoupper($validate['kode_surat']);

        DB::beginTransaction();

        try {
            $tipeSurat->update($validate);

            DB::commit();
            return to_route('tipe-surat.index')->withSuccess('Data Tipe Surat berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('tipe-surat.edit', $tipeSurat)->withError('Gagal mengubah data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipeSurat $tipeSurat)
    {
        DB::beginTransaction();

        try {
            $tipeSurat->delete();

            DB::commit();
            return to_route('tipe-surat.index')->withSuccess('Data Tipe Surat berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('tipe-surat.index')->withError('Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
