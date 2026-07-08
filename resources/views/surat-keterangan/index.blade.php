<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('surat-keterangan.create') }}" role="button">Buat Pengajuan</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal Pengajuan</th>
                        <th scope="col">No. Surat</th>
                        <th scope="col">Pemohon</th>
                        <th scope="col">Jenis Surat</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surats as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($s->tanggal_pengajuan)->format('d-m-Y') }}</td>
                            <td>
                                @if($s->nomor_surat)
                                    <span class="fw-semibold">{{ $s->nomor_surat }}</span>
                                @else
                                    <span class="text-muted italic">Belum Ada</span>
                                @endif
                            </td>
                            <td class="text-start">
                                @if($s->penduduk)
                                    <strong>{{ $s->penduduk->nama_lengkap }}</strong><br>
                                    <small class="text-muted">NIK: {{ $s->penduduk->nik }}</small>
                                @else
                                    <span class="text-danger">Penduduk Terhapus</span>
                                @endif
                            </td>
                            <td>
                                @if($s->tipeSurat)
                                    {{ $s->tipeSurat->nama_surat }} ({{ $s->tipeSurat->kode_surat }})
                                @else
                                    <span class="text-danger">Tipe Surat Terhapus</span>
                                @endif
                            </td>
                            <td>
                                @if($s->status == 'Pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($s->status == 'Diproses')
                                    <span class="badge bg-primary">Diproses</span>
                                @elseif($s->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($s->status == 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-detail"
                                    data-route="{{ route('surat-keterangan.show', $s) }}" title="Detail">
                                    <i class='bx bx-show'></i>
                                </button>
                                <a href="{{ route('surat-keterangan.edit', $s) }}" class="btn btn-warning btn-sm" title="Proses/Edit">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                                @if($s->status == 'Selesai')
                                    <a href="{{ route('surat-keterangan.print', $s) }}" target="_blank" class="btn btn-success btn-sm" title="Cetak Surat">
                                        <i class='bx bx-printer'></i>
                                    </a>
                                @endif
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-route="{{ route('surat-keterangan.destroy', $s) }}" title="Hapus Histori">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @push('modals')
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pengajuan Surat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-detail">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            $('#data-table').on('click', '.btn-delete', function() {
                $('#form-delete').attr('action', $(this).data('route'))
            })

            $('#data-table').on('click', '.btn-detail', function() {
                Swal.fire({
                    title: 'Memuat...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $('#modal-detail').load($(this).data('route'), function(response, status, xhr) {
                    if (status == "success") {
                        setTimeout(() => {
                            Swal.close();
                            $('#detailModal').modal('show');
                        }, 500);
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Gagal memuat data",
                            icon: "error"
                        });
                    }
                });
            })
        </script>
    @endpush

</x-app>
