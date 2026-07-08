<div class="row g-3 mb-4">
    <div class="col-md-4 text-center">
        <i class='bx bx-user-circle text-primary' style="font-size: 150px;"></i>
        <h5 class="fw-bold mt-2">{{ $penduduk->nama_lengkap }}</h5>
        <span class="badge bg-{{ $penduduk->status_hidup ? 'success' : 'danger' }} fs-6">
            {{ $penduduk->status_hidup ? 'Hidup' : 'Meninggal' }}
        </span>
    </div>
    <div class="col-md-8">
        <h4 class="fw-bold mb-3">Detail Demografi</h4>
        <div class="list-group list-group-flush">
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-id-card me-2'></i>NIK
                    </div>
                    <div class="col-8 fw-semibold">
                        {{ $penduduk->nik }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-folder me-2'></i>Nomor KK
                    </div>
                    <div class="col-8 fw-semibold">
                        @if($penduduk->kartuKeluarga)
                            {{ $penduduk->kartuKeluarga->no_kk }}
                        @else
                            <span class="text-danger">-</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-map me-2'></i>Alamat Keluarga
                    </div>
                    <div class="col-8">
                        @if($penduduk->kartuKeluarga)
                            {{ $penduduk->kartuKeluarga->alamat }} (RT {{ $penduduk->kartuKeluarga->rt }} / RW {{ $penduduk->kartuKeluarga->rw }}), Desa/Kel. {{ $penduduk->kartuKeluarga->desa_kelurahan }}, Kec. {{ $penduduk->kartuKeluarga->kecamatan }}, {{ $penduduk->kartuKeluarga->kabupaten_kota }}, {{ $penduduk->kartuKeluarga->provinsi }}
                        @else
                            <span class="text-danger">-</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-calendar me-2'></i>Tempat, Tgl Lahir
                    </div>
                    <div class="col-8">
                        {{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->isoFormat('D MMMM YYYY') }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-male-female me-2'></i>Jenis Kelamin
                    </div>
                    <div class="col-8">
                        {{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki (L)' : 'Perempuan (P)' }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-heart me-2'></i>Agama
                    </div>
                    <div class="col-8">
                        {{ $penduduk->agama }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-book-open me-2'></i>Pendidikan
                    </div>
                    <div class="col-8">
                        {{ $penduduk->pendidikan }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-briefcase me-2'></i>Pekerjaan
                    </div>
                    <div class="col-8">
                        {{ $penduduk->pekerjaan }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-paperclip me-2'></i>Status Perkawinan
                    </div>
                    <div class="col-8">
                        {{ $penduduk->status_perkawinan }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
