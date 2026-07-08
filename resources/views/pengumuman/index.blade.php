<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    @php
        $canManage = in_array(Auth::user()->role, ['Superadmin', 'Admin', 'Kades']);
    @endphp

    @if ($canManage)
        <!-- Nav Tabs for Admin/Kades -->
        <ul class="nav nav-tabs nav-tabs-buffered mb-4" id="pengumumanTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="portal-tab" data-bs-toggle="tab" data-bs-target="#portal-view" type="button" role="tab" aria-controls="portal-view" aria-selected="true">
                    <i class="bi bi-grid-fill me-2"></i>Portal Informasi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="manage-tab" data-bs-toggle="tab" data-bs-target="#manage-view" type="button" role="tab" aria-controls="manage-view" aria-selected="false">
                    <i class="bi bi-sliders me-2"></i>Kelola Pengumuman
                </button>
            </li>
        </ul>
    @endif

    <div class="tab-content" id="pengumumanTabContent">
        <!-- Portal View (Card Grid) -->
        <div class="tab-pane fade show active" id="portal-view" role="tabpanel" aria-labelledby="portal-tab">
            @if ($pengumumans->isEmpty())
                <div class="alert alert-info text-center py-5">
                    <i class="bi bi-info-circle fs-1 d-block mb-3"></i>
                    Belum ada pengumuman yang dipublikasikan.
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
                    @foreach ($pengumumans as $p)
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0 transition-hover" style="border-radius: 12px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
                                <!-- Image Header -->
                                <div style="height: 180px; overflow: hidden; position: relative;">
                                    @if ($p->file_gambar)
                                        <img src="{{ asset('storage/' . $p->file_gambar) }}" class="card-img-top w-100 h-100" style="object-fit: cover;" alt="{{ $p->judul }}">
                                    @else
                                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-white" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                                            <i class="bi bi-newspaper fs-1"></i>
                                            <span class="small mt-2">Info Desa Sukajaya</span>
                                        </div>
                                    @endif
                                    <span class="position-absolute top-0 end-0 badge bg-dark m-3 opacity-90">
                                        {{ \Carbon\Carbon::parse($p->tanggal_publish)->isoFormat('D MMM YYYY') }}
                                    </span>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold text-dark text-truncate-2 mb-2" style="font-size: 16px; line-height: 1.4; height: 45px;">
                                        {{ $p->judul }}
                                    </h5>
                                    <p class="card-text text-muted text-truncate-3 small mb-4" style="font-size: 13px;">
                                        {{ Str::limit(strip_tags($p->konten), 120) }}
                                    </p>
                                    <div class="mt-auto d-flex align-items-center justify-content-between pt-3 border-top">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle-sm bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 28px; height: 28px; border-radius: 50%; font-size: 12px; font-weight: bold;">
                                                {{ strtoupper(substr($p->author->name ?? 'A', 0, 1)) }}
                                            </div>
                                            <span class="small text-muted text-truncate" style="max-width: 120px;">
                                                {{ $p->author->name ?? 'Admin' }}
                                            </span>
                                        </div>
                                        <a href="{{ route('pengumuman.show', $p) }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                                            Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @if ($canManage)
            <!-- Manage View (DataTable CRUD) -->
            <div class="tab-pane fade" id="manage-view" role="tabpanel" aria-labelledby="manage-tab">
                <div class="card shadow-lg p-3 border-0">
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('pengumuman.create') }}" role="button">
                            <i class="bi bi-plus-lg me-2"></i>Tulis Pengumuman
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped w-100" id="data-table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col" style="width: 12%;">Tanggal</th>
                                    <th scope="col" style="width: 40%;">Judul</th>
                                    <th scope="col" style="width: 15%;">Penulis</th>
                                    <th scope="col" style="width: 13%;">Gambar</th>
                                    <th scope="col" style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengumumans as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->tanggal_publish)->format('d-m-Y') }}</td>
                                        <td class="text-start font-semibold">{{ $p->judul }}</td>
                                        <td>{{ $p->author->name ?? '-' }}</td>
                                        <td>
                                            @if ($p->file_gambar)
                                                <span class="badge bg-success">Ada</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('pengumuman.show', $p) }}" class="btn btn-info btn-sm" title="Pratinjau">
                                                <i class='bx bx-show'></i>
                                            </a>
                                            <a href="{{ route('pengumuman.edit', $p) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class='bx bx-edit-alt'></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-route="{{ route('pengumuman.destroy', $p) }}" title="Hapus">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Extra Styling for Card Zoom -->
    <style>
        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .text-truncate-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    @push('scripts')
        <script>
            $('#data-table').on('click', '.btn-delete', function() {
                $('#form-delete').attr('action', $(this).data('route'))
            });
        </script>
    @endpush

</x-app>
