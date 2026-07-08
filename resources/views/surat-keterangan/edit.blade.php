<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('surat-keterangan.update', $surat) }}" method="post" class="form">
            @csrf
            @method('put')

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="penduduk_id" class="form-label required">Pemohon (Warga/Penduduk)</label>
                        <select class="form-select select2-default @error('penduduk_id') is-invalid @enderror" id="penduduk_id" name="penduduk_id" required>
                            <option value="">Cari Penduduk...</option>
                            @foreach($penduduks as $p)
                                <option value="{{ $p->id }}" @selected(old('penduduk_id', $surat->penduduk_id) == $p->id)>
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
                                <option value="{{ $ts->id }}" @selected(old('tipe_surat_id', $surat->tipe_surat_id) == $ts->id)>
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

                    <div class="mb-3">
                        <label for="keterangan_keperluan" class="form-label required">Keperluan Surat</label>
                        <textarea class="form-control @error('keterangan_keperluan') is-invalid @enderror" id="keterangan_keperluan"
                            name="keterangan_keperluan" rows="3" required>{{ old('keterangan_keperluan', $surat->keterangan_keperluan) }}</textarea>
                        @error('keterangan_keperluan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border border-primary border-opacity-25 h-100">
                        <div class="card-header bg-primary bg-opacity-10 fw-bold text-primary">
                            <i class="bi bi-gear-fill me-2"></i>Pemrosesan Status Surat
                        </div>
                        <div class="card-body mt-3">
                            <div class="mb-3">
                                <label for="status" class="form-label required">Status Pengajuan</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="Pending" @selected(old('status', $surat->status) == 'Pending')>Pending</option>
                                    <option value="Diproses" @selected(old('status', $surat->status) == 'Diproses')>Diproses</option>
                                    <option value="Selesai" @selected(old('status', $surat->status) == 'Selesai')>Selesai</option>
                                    <option value="Ditolak" @selected(old('status', $surat->status) == 'Ditolak')>Ditolak</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3" id="nomor-surat-group">
                                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                <input class="form-control @error('nomor_surat') is-invalid @enderror" type="text" id="nomor_surat"
                                    name="nomor_surat" placeholder="Contoh: 470/102/SKD/2026" value="{{ old('nomor_surat', $surat->nomor_surat) }}">
                                <small class="text-muted italic d-block mt-1">Wajib diisi jika status diatur ke 'Diproses' atau 'Selesai'.</small>
                                @error('nomor_surat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('surat-keterangan.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>

    @push('scripts')
        <script>
            // Client side logic to toggle nomor_surat required state based on status dropdown
            function toggleNomorSuratRequired() {
                var status = $('#status').val();
                if (status === 'Selesai' || status === 'Diproses') {
                    $('#nomor_surat').attr('required', 'required');
                    $('label[for="nomor_surat"]').addClass('required');
                } else {
                    $('#nomor_surat').removeAttr('required');
                    $('label[for="nomor_surat"]').removeClass('required');
                }
            }

            $('#status').on('change', function() {
                toggleNomorSuratRequired();
            });

            // Initial check
            toggleNomorSuratRequired();
        </script>
    @endpush

</x-app>
