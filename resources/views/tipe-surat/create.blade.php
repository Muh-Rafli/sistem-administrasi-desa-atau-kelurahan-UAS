<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('tipe-surat.store') }}" method="post" class="form">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kode_surat" class="form-label required">Kode Surat</label>
                        <input class="form-control @error('kode_surat') is-invalid @enderror" type="text" id="kode_surat"
                            name="kode_surat" required placeholder="Contoh: SKD, SKU, SKTM" maxlength="20" value="{{ old('kode_surat') }}">
                        @error('kode_surat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_surat" class="form-label required">Nama Surat</label>
                        <input class="form-control @error('nama_surat') is-invalid @enderror" type="text" id="nama_surat"
                            name="nama_surat" required placeholder="Contoh: Surat Keterangan Domisili" value="{{ old('nama_surat') }}">
                        @error('nama_surat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="alert alert-info">
                        <h6 class="fw-bold mb-2"><i class="bi bi-info-circle-fill me-2"></i>Panduan Template Konten</h6>
                        <p class="small mb-0">Anda dapat menggunakan tag/placeholders berikut yang akan diganti secara otomatis dengan data penduduk saat mencetak/membuat surat:</p>
                        <ul class="small mb-0 mt-2 ps-3">
                            <li><code>[nama_lengkap]</code> : Nama lengkap penduduk</li>
                            <li><code>[nik]</code> : Nomor Induk Kependudukan</li>
                            <li><code>[tempat_lahir]</code> : Tempat lahir penduduk</li>
                            <li><code>[tanggal_lahir]</code> : Tanggal lahir penduduk</li>
                            <li><code>[jenis_kelamin]</code> : Jenis kelamin (Laki-laki / Perempuan)</li>
                            <li><code>[agama]</code> : Agama</li>
                            <li><code>[pendidikan]</code> : Pendidikan terakhir</li>
                            <li><code>[pekerjaan]</code> : Pekerjaan saat ini</li>
                            <li><code>[alamat]</code> : Alamat lengkap (RT, RW, Desa, Kec, Kab)</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="template_konten" class="form-label required">Template Konten Surat</label>
                        <textarea class="form-control @error('template_konten') is-invalid @enderror" id="template_konten"
                            name="template_konten" rows="12" required placeholder="Tuliskan draf teks surat di sini...">{{ old('template_konten') }}</textarea>
                        @error('template_konten')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('tipe-surat.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>

</x-app>
