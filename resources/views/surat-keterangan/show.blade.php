<div class="row g-3 mb-4">
    <div class="col-md-12">
        <h4 class="fw-bold mb-3">Detail Layanan Persuratan</h4>
        <div class="list-group list-group-flush">
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-user me-2'></i>Nama Pemohon
                    </div>
                    <div class="col-8 fw-semibold">
                        @if($surat->penduduk)
                            {{ $surat->penduduk->nama_lengkap }}
                        @else
                            <span class="text-danger">-</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-id-card me-2'></i>NIK Pemohon
                    </div>
                    <div class="col-8">
                        @if($surat->penduduk)
                            {{ $surat->penduduk->nik }}
                        @else
                            <span class="text-danger">-</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-map me-2'></i>Alamat Domisili
                    </div>
                    <div class="col-8 text-muted">
                        @if($surat->penduduk && $surat->penduduk->kartuKeluarga)
                            {{ $surat->penduduk->kartuKeluarga->alamat }} (RT {{ $surat->penduduk->kartuKeluarga->rt }} / RW {{ $surat->penduduk->kartuKeluarga->rw }}), Desa/Kel. {{ $surat->penduduk->kartuKeluarga->desa_kelurahan }}, Kec. {{ $surat->penduduk->kartuKeluarga->kecamatan }}, {{ $surat->penduduk->kartuKeluarga->kabupaten_kota }}, {{ $surat->penduduk->kartuKeluarga->provinsi }}
                        @else
                            <span class="text-danger">-</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-file-blank me-2'></i>Jenis Surat
                    </div>
                    <div class="col-8 fw-semibold text-primary">
                        @if($surat->tipeSurat)
                            {{ $surat->tipeSurat->nama_surat }} ({{ $surat->tipeSurat->kode_surat }})
                        @else
                            <span class="text-danger">-</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-key me-2'></i>Nomor Surat
                    </div>
                    <div class="col-8 fw-bold text-success">
                        {{ $surat->nomor_surat ?? '-' }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-calendar me-2'></i>Tanggal Pengajuan
                    </div>
                    <div class="col-8">
                        {{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->isoFormat('D MMMM YYYY') }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-info-circle me-2'></i>Status Pengajuan
                    </div>
                    <div class="col-8">
                        @if($surat->status == 'Pending')
                            <span class="badge bg-warning text-dark fs-6">Pending</span>
                        @elseif($surat->status == 'Diproses')
                            <span class="badge bg-primary fs-6">Diproses</span>
                        @elseif($surat->status == 'Selesai')
                            <span class="badge bg-success fs-6">Selesai</span>
                        @elseif($surat->status == 'Ditolak')
                            <span class="badge bg-danger fs-6">Ditolak</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-task me-2'></i>Keperluan
                    </div>
                    <div class="col-8">
                        {{ $surat->keterangan_keperluan }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-user-check me-2'></i>Diproses Oleh
                    </div>
                    <div class="col-8 text-muted">
                        @if($surat->processedBy)
                            {{ $surat->processedBy->name }} ({{ $surat->processedBy->role }})
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
