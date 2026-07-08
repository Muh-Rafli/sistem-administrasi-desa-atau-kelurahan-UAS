<?php

namespace App\Http\Controllers;

use App\Models\SuratKeterangan;
use App\Models\Penduduk;
use App\Models\TipeSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratKeteranganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('surat-keterangan.index', [
            'title' => 'Layanan Persuratan',
            'surats' => SuratKeterangan::with(['penduduk', 'tipeSurat'])->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('surat-keterangan.create', [
            'title' => 'Buat Pengajuan Surat',
            'penduduks' => Penduduk::orderBy('nama_lengkap')->get(),
            'tipeSurats' => TipeSurat::orderBy('nama_surat')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'penduduk_id' => 'required|exists:penduduk,id',
            'tipe_surat_id' => 'required|exists:tipe_surat,id',
            'keterangan_keperluan' => 'required',
        ], [
            'penduduk_id.required' => 'Penduduk/Pemohon wajib dipilih',
            'penduduk_id.exists' => 'Data Penduduk tidak valid',
            'tipe_surat_id.required' => 'Jenis Surat wajib dipilih',
            'tipe_surat_id.exists' => 'Jenis Surat tidak valid',
            'keterangan_keperluan.required' => 'Keperluan pengajuan surat wajib diisi',
        ]);

        $validate['tanggal_pengajuan'] = now()->toDateString();
        $validate['status'] = 'Pending';

        DB::beginTransaction();

        try {
            SuratKeterangan::create($validate);

            DB::commit();
            return to_route('surat-keterangan.index')->withSuccess('Pengajuan surat berhasil dikirim');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('surat-keterangan.create')->withError('Gagal mengirim pengajuan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKeterangan $suratKeterangan)
    {
        return view('surat-keterangan.show', [
            'title' => 'Detail Surat Keterangan',
            'surat' => $suratKeterangan->load(['penduduk.kartuKeluarga', 'tipeSurat', 'processedBy']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKeterangan $suratKeterangan)
    {
        return view('surat-keterangan.edit', [
            'title' => 'Proses Pengajuan Surat',
            'surat' => $suratKeterangan->load(['penduduk', 'tipeSurat']),
            'penduduks' => Penduduk::orderBy('nama_lengkap')->get(),
            'tipeSurats' => TipeSurat::orderBy('nama_surat')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratKeterangan $suratKeterangan)
    {
        $validate = $request->validate([
            'penduduk_id' => 'required|exists:penduduk,id',
            'tipe_surat_id' => 'required|exists:tipe_surat,id',
            'status' => 'required|in:Pending,Diproses,Selesai,Ditolak',
            'nomor_surat' => 'nullable|required_if:status,Selesai,Diproses',
            'keterangan_keperluan' => 'required',
        ], [
            'penduduk_id.required' => 'Penduduk/Pemohon wajib dipilih',
            'penduduk_id.exists' => 'Data Penduduk tidak valid',
            'tipe_surat_id.required' => 'Jenis Surat wajib dipilih',
            'tipe_surat_id.exists' => 'Jenis Surat tidak valid',
            'status.required' => 'Status pengajuan wajib dipilih',
            'status.in' => 'Status pengajuan tidak valid',
            'nomor_surat.required_if' => 'Nomor Surat wajib diisi jika status disetujui atau diproses',
            'keterangan_keperluan.required' => 'Keperluan pengajuan surat wajib diisi',
        ]);

        $validate['processed_by'] = Auth::id();

        DB::beginTransaction();

        try {
            $suratKeterangan->update($validate);

            DB::commit();
            return to_route('surat-keterangan.index')->withSuccess('Pengajuan surat berhasil diproses');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('surat-keterangan.edit', $suratKeterangan)->withError('Gagal memproses pengajuan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeterangan $suratKeterangan)
    {
        DB::beginTransaction();

        try {
            $suratKeterangan->delete();

            DB::commit();
            return to_route('surat-keterangan.index')->withSuccess('Histori pengajuan surat berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('surat-keterangan.index')->withError('Gagal menghapus histori: ' . $e->getMessage());
        }
    }

    /**
     * Print the specified letter with placeholders replaced.
     */
    public function print(SuratKeterangan $suratKeterangan)
    {
        $suratKeterangan->load(['penduduk.kartuKeluarga', 'tipeSurat']);
        $penduduk = $suratKeterangan->penduduk;
        $tipeSurat = $suratKeterangan->tipeSurat;

        // Get full address
        $alamatLengkap = $penduduk->kartuKeluarga
            ? $penduduk->kartuKeluarga->alamat . ' RT ' . $penduduk->kartuKeluarga->rt . ' / RW ' . $penduduk->kartuKeluarga->rw . ', Desa/Kel. ' . $penduduk->kartuKeluarga->desa_kelurahan . ', Kec. ' . $penduduk->kartuKeluarga->kecamatan . ', ' . $penduduk->kartuKeluarga->kabupaten_kota . ', ' . $penduduk->kartuKeluarga->provinsi
            : '-';

        // Parse placeholders in template
        $placeholders = [
            '[nama_lengkap]' => $penduduk->nama_lengkap,
            '[nik]' => $penduduk->nik,
            '[tempat_lahir]' => $penduduk->tempat_lahir,
            '[tanggal_lahir]' => \Carbon\Carbon::parse($penduduk->tanggal_lahir)->isoFormat('D MMMM YYYY'),
            '[jenis_kelamin]' => $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            '[agama]' => $penduduk->agama,
            '[pendidikan]' => $penduduk->pendidikan,
            '[pekerjaan]' => $penduduk->pekerjaan,
            '[alamat]' => $alamatLengkap,
        ];

        $kontenParsed = str_replace(
            array_keys($placeholders),
            array_values($placeholders),
            $tipeSurat->template_konten
        );

        return view('surat-keterangan.print', [
            'surat' => $suratKeterangan,
            'kontenParsed' => $kontenParsed,
        ]);
    }
}
