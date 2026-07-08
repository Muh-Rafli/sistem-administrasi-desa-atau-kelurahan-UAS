<div class="row g-3 mb-4">
    <div class="col-md-12">
        <h4 class="fw-bold mb-1">{{ $tipeSurat->nama_surat }}</h4>
        <span class="badge bg-primary fs-6 mb-3">Kode: {{ $tipeSurat->kode_surat }}</span>

        <div class="card bg-light border p-3">
            <h6 class="fw-bold text-muted border-bottom pb-2">Draf Template Konten:</h6>
            <pre style="white-space: pre-wrap; font-family: 'Courier New', Courier, monospace; font-size: 14px;" class="mb-0">{{ $tipeSurat->template_konten }}</pre>
        </div>
    </div>
</div>
