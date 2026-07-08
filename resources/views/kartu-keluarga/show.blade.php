<div class="row g-3 mb-4">
    <div class="col-md-12">
        <h4 class="fw-bold mb-3">No. KK: {{ $kartuKeluarga->no_kk }}</h4>
        <div class="list-group list-group-flush">
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-map me-2'></i>Alamat
                    </div>
                    <div class="col-8 fw-semibold">
                        {{ $kartuKeluarga->alamat }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-directions me-2'></i>RT / RW
                    </div>
                    <div class="col-8 fw-semibold">
                        RT {{ $kartuKeluarga->rt }} / RW {{ $kartuKeluarga->rw }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-building me-2'></i>Desa / Kelurahan
                    </div>
                    <div class="col-8 fw-semibold">
                        {{ $kartuKeluarga->desa_kelurahan }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-navigation me-2'></i>Kecamatan
                    </div>
                    <div class="col-8 fw-semibold">
                        {{ $kartuKeluarga->kecamatan }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-building-house me-2'></i>Kabupaten / Kota
                    </div>
                    <div class="col-8 fw-semibold">
                        {{ $kartuKeluarga->kabupaten_kota }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-map-pin me-2'></i>Provinsi
                    </div>
                    <div class="col-8 fw-semibold">
                        {{ $kartuKeluarga->provinsi }}
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-calendar-plus me-2'></i>Dibuat
                    </div>
                    <div class="col-8">
                        {{ $kartuKeluarga->created_at->diffForHumans() }}
                        <small class="text-muted d-block">{{ $kartuKeluarga->created_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 border-0">
                <div class="row">
                    <div class="col-4 text-muted">
                        <i class='bx bx-calendar-edit me-2'></i>Diubah
                    </div>
                    <div class="col-8">
                        {{ $kartuKeluarga->updated_at->diffForHumans() }}
                        <small class="text-muted d-block">{{ $kartuKeluarga->updated_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
