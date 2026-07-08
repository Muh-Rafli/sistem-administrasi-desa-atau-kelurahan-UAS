<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('pengumuman.update', $pengumuman) }}" method="post" enctype="multipart/form-data" class="form">
            @csrf
            @method('put')

            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="judul" class="form-label required">Judul Pengumuman</label>
                        <input class="form-control @error('judul') is-invalid @enderror" type="text" id="judul"
                            name="judul" required placeholder="Tuliskan judul informasi desa..." value="{{ old('judul', $pengumuman->judul) }}">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="konten" class="form-label required">Konten / Isi Informasi</label>
                        <textarea class="form-control @error('konten') is-invalid @enderror" id="konten"
                            name="konten" rows="12" required placeholder="Tuliskan isi pengumuman secara lengkap...">{{ old('konten', $pengumuman->konten) }}</textarea>
                        @error('konten')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tanggal_publish" class="form-label required">Tanggal Publish</label>
                        <input class="form-control @error('tanggal_publish') is-invalid @enderror" type="date" id="tanggal_publish"
                            name="tanggal_publish" required value="{{ old('tanggal_publish', $pengumuman->tanggal_publish) }}">
                        @error('tanggal_publish')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file_gambar" class="form-label">Ganti Gambar Cover (Opsional)</label>
                        <input class="form-control @error('file_gambar') is-invalid @enderror" type="file" id="file_gambar"
                            name="file_gambar" accept="image/*">
                        <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG, SVG. Maks: 1 MB.</small>
                        @error('file_gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Image Preview Container -->
                    <div class="card border p-2 text-center" style="min-height: 180px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa; border-radius: 8px;">
                        <div id="preview-placeholder" class="{{ $pengumuman->file_gambar ? 'd-none' : '' }}">
                            <i class="bi bi-image text-muted fs-1"></i>
                            <p class="small text-muted mb-0">Belum ada gambar cover</p>
                        </div>
                        <img id="image-preview" src="{{ $pengumuman->file_gambar ? asset('storage/' . $pengumuman->file_gambar) : '#' }}" alt="Pratinjau Gambar" class="img-fluid {{ $pengumuman->file_gambar ? '' : 'd-none' }}" style="max-height: 200px; object-fit: contain; border-radius: 6px;">
                    </div>
                </div>
            </div>

            <div class="text-end border-top pt-3">
                <a href="{{ route('pengumuman.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>

        </form>

    </div>

    @push('scripts')
        <script>
            // Instant Image Preview script
            $('#file_gambar').on('change', function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#image-preview').attr('src', event.target.result).removeClass('d-none');
                        $('#preview-placeholder').addClass('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    @if ($pengumuman->file_gambar)
                        $('#image-preview').removeClass('d-none').attr('src', '{{ asset('storage/' . $pengumuman->file_gambar) }}');
                        $('#preview-placeholder').addClass('d-none');
                    @else
                        $('#image-preview').addClass('d-none').attr('src', '#');
                        $('#preview-placeholder').removeClass('d-none');
                    @endif
                }
            });
        </script>
    @endpush

</x-app>
