<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengumuman.index', [
            'title' => 'Portal Pengumuman',
            'pengumumans' => Pengumuman::with('author')->latest('tanggal_publish')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengumuman.create', [
            'title' => 'Tulis Pengumuman Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'file_gambar' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:1024',
            'tanggal_publish' => 'required|date',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi',
            'judul.max' => 'Judul pengumuman maksimal 255 karakter',
            'konten.required' => 'Konten pengumuman wajib diisi',
            'file_gambar.image' => 'File harus berupa gambar',
            'file_gambar.mimes' => 'Format gambar harus png, jpg, jpeg, atau svg',
            'file_gambar.max' => 'Ukuran gambar tidak boleh lebih dari 1 MB',
            'tanggal_publish.required' => 'Tanggal terbit wajib diisi',
            'tanggal_publish.date' => 'Format tanggal terbit tidak valid',
        ]);

        // Generate unique slug
        $slug = Str::slug($request->judul);
        $count = Pengumuman::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        $validate['slug'] = $slug;
        $validate['author_id'] = Auth::id();

        DB::beginTransaction();

        try {
            if ($request->file('file_gambar')) {
                $validate['file_gambar'] = $request->file('file_gambar')->store('img/announcements', 'public');
            }

            Pengumuman::create($validate);

            DB::commit();
            return to_route('pengumuman.index')->withSuccess('Pengumuman berhasil dipublikasikan');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('pengumuman.create')->withError('Gagal mempublikasikan pengumuman: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('pengumuman.show', [
            'title' => 'Detail Pengumuman',
            'pengumuman' => $pengumuman->load('author'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', [
            'title' => 'Edit Pengumuman',
            'pengumuman' => $pengumuman,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validate = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'file_gambar' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:1024',
            'tanggal_publish' => 'required|date',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi',
            'judul.max' => 'Judul pengumuman maksimal 255 karakter',
            'konten.required' => 'Konten pengumuman wajib diisi',
            'file_gambar.image' => 'File harus berupa gambar',
            'file_gambar.mimes' => 'Format gambar harus png, jpg, jpeg, atau svg',
            'file_gambar.max' => 'Ukuran gambar tidak boleh lebih dari 1 MB',
            'tanggal_publish.required' => 'Tanggal terbit wajib diisi',
            'tanggal_publish.date' => 'Format tanggal terbit tidak valid',
        ]);

        // Regenerate slug if title changes
        if ($request->judul !== $pengumuman->judul) {
            $slug = Str::slug($request->judul);
            $count = Pengumuman::where('slug', 'like', $slug . '%')->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $validate['slug'] = $slug;
        }

        DB::beginTransaction();

        try {
            if ($request->file('file_gambar')) {
                $validate['file_gambar'] = $request->file('file_gambar')->store('img/announcements', 'public');
                if ($pengumuman->file_gambar && Storage::disk('public')->exists($pengumuman->file_gambar)) {
                    Storage::disk('public')->delete($pengumuman->file_gambar);
                }
            }

            $pengumuman->update($validate);

            DB::commit();
            return to_route('pengumuman.index')->withSuccess('Pengumuman berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('pengumuman.edit', $pengumuman)->withError('Gagal mengubah pengumuman: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        DB::beginTransaction();

        try {
            $file_gambar = $pengumuman->file_gambar;

            $pengumuman->delete();

            if ($file_gambar && Storage::disk('public')->exists($file_gambar)) {
                Storage::disk('public')->delete($file_gambar);
            }

            DB::commit();
            return to_route('pengumuman.index')->withSuccess('Pengumuman berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('pengumuman.index')->withError('Gagal menghapus pengumuman: ' . $e->getMessage());
        }
    }
}
