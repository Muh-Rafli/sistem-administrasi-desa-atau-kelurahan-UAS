<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('surat-keterangan.store') }}" method="post" class="form">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="penduduk_id" class="form-label required">Pemohon (Warga/Penduduk)</label>
                        <select class="form-select select2-default @error('penduduk_id') is-invalid @enderror" id="penduduk_id" name="penduduk_id" required>
                            <option value="">Cari Penduduk berdasarkan NIK / Nama...</option>
                            @foreach($penduduks as $p)
                                <option value="{{ $p->id }}" @selected(old('penduduk_id') == $p->id)>
                                    {{ $p->nik }} - {{ $p->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('penduduk_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tipe_surat_id" class="form-label required">Jenis Surat Keterangan</label>
                        <select class="form-select select2-default @error('tipe_surat_id') is-invalid @enderror" id="tipe_surat_id" name="tipe_surat_id" required>
                            <option value="">Pilih Jenis Surat...</option>
                            @foreach($tipeSurats as $ts)
                                <option value="{{ $ts->id }}" @selected(old('tipe_surat_id') == $ts->id)>
                                    {{ $ts->nama_surat }} ({{ $ts->kode_surat }})
                                </option>
                            @endforeach
                        </select>
                        @error('tipe_surat_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="keterangan_keperluan" class="form-label required">Keperluan Surat</label>
                        <textarea class="form-control @error('keterangan_keperluan') is-invalid @enderror" id="keterangan_keperluan"
                            name="keterangan_keperluan" rows="5" required placeholder="Contoh: Untuk melamar pekerjaan / Syarat pengajuan beasiswa">{{ old('keterangan_keperluan') }}</textarea>
                        @error('keterangan_keperluan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('surat-keterangan.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>

</x-app>
