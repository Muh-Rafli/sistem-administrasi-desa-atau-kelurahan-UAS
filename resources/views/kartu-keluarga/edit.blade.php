<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('kartu-keluarga.update', $kartuKeluarga) }}" method="post" class="form">
            @csrf
            @method('put')

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="no_kk" class="form-label required">Nomor Kartu Keluarga (No. KK)</label>
                        <input class="form-control @error('no_kk') is-invalid @enderror" type="text" id="no_kk"
                            name="no_kk" required data-parsley-type="digits" data-parsley-length="[16, 16]" value="{{ old('no_kk', $kartuKeluarga->no_kk) }}">
                        @error('no_kk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label required">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            name="alamat" rows="3" required>{{ old('alamat', $kartuKeluarga->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="rt" class="form-label required">RT</label>
                            <input class="form-control @error('rt') is-invalid @enderror" type="text" id="rt"
                                name="rt" required maxlength="10" value="{{ old('rt', $kartuKeluarga->rt) }}">
                            @error('rt')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rw" class="form-label required">RW</label>
                            <input class="form-control @error('rw') is-invalid @enderror" type="text" id="rw"
                                name="rw" required maxlength="10" value="{{ old('rw', $kartuKeluarga->rw) }}">
                            @error('rw')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="desa_kelurahan" class="form-label required">Desa / Kelurahan</label>
                        <input class="form-control @error('desa_kelurahan') is-invalid @enderror" type="text" id="desa_kelurahan"
                            name="desa_kelurahan" required value="{{ old('desa_kelurahan', $kartuKeluarga->desa_kelurahan) }}">
                        @error('desa_kelurahan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kecamatan" class="form-label required">Kecamatan</label>
                        <input class="form-control @error('kecamatan') is-invalid @enderror" type="text" id="kecamatan"
                            name="kecamatan" required value="{{ old('kecamatan', $kartuKeluarga->kecamatan) }}">
                        @error('kecamatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kabupaten_kota" class="form-label required">Kabupaten / Kota</label>
                        <input class="form-control @error('kabupaten_kota') is-invalid @enderror" type="text" id="kabupaten_kota"
                            name="kabupaten_kota" required value="{{ old('kabupaten_kota', $kartuKeluarga->kabupaten_kota) }}">
                        @error('kabupaten_kota')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="provinsi" class="form-label required">Provinsi</label>
                        <input class="form-control @error('provinsi') is-invalid @enderror" type="text" id="provinsi"
                            name="provinsi" required value="{{ old('provinsi', $kartuKeluarga->provinsi) }}">
                        @error('provinsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('kartu-keluarga.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>

</x-app>
