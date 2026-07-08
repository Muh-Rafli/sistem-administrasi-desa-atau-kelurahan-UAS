<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('pengumuman.index') }}" class="btn btn-outline-secondary rounded-pill px-3 btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pengumuman
                </a>
            </div>

            <!-- Main Post Container -->
            <div class="card shadow-lg border-0 mb-4" style="border-radius: 16px; overflow: hidden;">
                
                <!-- Main Cover Image -->
                @if ($pengumuman->file_gambar)
                    <div style="width: 100%; max-height: 400px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $pengumuman->file_gambar) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $pengumuman->judul }}">
                    </div>
                @else
                    <div class="d-flex flex-column align-items-center justify-content-center text-white py-5" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); min-height: 200px;">
                        <i class="bi bi-newspaper display-3"></i>
                        <h4 class="mt-2 text-uppercase font-semibold tracking-wider" style="font-size: 16px;">Pengumuman Resmi</h4>
                    </div>
                @endif

                <!-- Content Area -->
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Metadata Header -->
                    <div class="d-flex flex-wrap align-items-center text-muted gap-3 mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar3 me-2 text-primary"></i>
                            <span>{{ \Carbon\Carbon::parse($pengumuman->tanggal_publish)->isoFormat('dddd, D MMMM YYYY') }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-fill me-2 text-primary"></i>
                            <span>Ditulis oleh: <strong>{{ $pengumuman->author->name ?? 'Admin' }}</strong></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-tag-fill me-2 text-primary"></i>
                            <span class="badge bg-light text-primary border border-primary border-opacity-25">{{ $pengumuman->author->role ?? 'Petugas' }}</span>
                        </div>
                    </div>

                    <!-- Judul -->
                    <h1 class="fw-bold text-dark mb-4" style="font-size: 28px; line-height: 1.3;">
                        {{ $pengumuman->judul }}
                    </h1>

                    <!-- Teks Konten -->
                    <div class="announcement-content text-dark style-text" style="font-size: 16px; line-height: 1.8; text-align: justify;">
                        {!! nl2br(e($pengumuman->konten)) !!}
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Extra style for clean text formatting -->
    <style>
        .announcement-content {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #2d3748 !important;
        }
        .announcement-content p {
            margin-bottom: 1.5rem;
        }
    </style>

</x-app>
