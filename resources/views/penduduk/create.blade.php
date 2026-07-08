<x-app>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="card shadow-lg p-3">

        <form action="{{ route('penduduk.store') }}" method="post" class="form">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kk_id" class="form-label required">Kartu Keluarga (No. KK)</label>
                        <select class="form-select select2-default @error('kk_id') is-invalid @enderror" id="kk_id" name="kk_id" required>
                            <option value="">Cari Nomor KK...</option>
                            @foreach($kartuKeluargas as $kk)
                                <option value="{{ $kk->id }}" @selected(old('kk_id') == $kk->id)>
                                    {{ $kk->no_kk }} - {{ $kk->alamat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kk_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label required">Nomor Induk Kependudukan (NIK)</label>
                        <input class="form-control @error('nik') is-invalid @enderror" type="text" id="nik"
                            name="nik" required data-parsley-type="digits" data-parsley-length="[16, 16]" value="{{ old('nik') }}">
                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label required">Nama Lengkap</label>
                        <input class="form-control @error('nama_lengkap') is-invalid @enderror" type="text" id="nama_lengkap"
                            name="nama_lengkap" required value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tempat_lahir" class="form-label required">Tempat Lahir</label>
                            <input class="form-control @error('tempat_lahir') is-invalid @enderror" type="text" id="tempat_lahir"
                                name="tempat_lahir" required value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir" class="form-label required">Tanggal Lahir</label>
                            <input class="form-control @error('tanggal_lahir') is-invalid @enderror" type="date" id="tanggal_lahir"
                                name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label required">Jenis Kelamin</label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki (L)</option>
                            <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan (P)</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="agama" class="form-label required">Agama</label>
                        <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" @selected(old('agama') == 'Islam')>Islam</option>
                            <option value="Protestan" @selected(old('agama') == 'Protestan')>Protestan</option>
                            <option value="Katolik" @selected(old('agama') == 'Katolik')>Katolik</option>
                            <option value="Hindu" @selected(old('agama') == 'Hindu')>Hindu</option>
                            <option value="Buddha" @selected(old('agama') == 'Buddha')>Buddha</option>
                            <option value="Khonghucu" @selected(old('agama') == 'Khonghucu')>Khonghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pendidikan" class="form-label required">Pendidikan</label>
                        <select class="form-select @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" required>
                            <option value="">Pilih Pendidikan</option>
                            <option value="Tidak Sekolah" @selected(old('pendidikan') == 'Tidak Sekolah')>Tidak Sekolah</option>
                            <option value="SD" @selected(old('pendidikan') == 'SD')>SD</option>
                            <option value="SMP" @selected(old('pendidikan') == 'SMP')>SMP</option>
                            <option value="SMA" @selected(old('pendidikan') == 'SMA')>SMA</option>
                            <option value="Diploma" @selected(old('pendidikan') == 'Diploma')>Diploma</option>
                            <option value="S1" @selected(old('pendidikan') == 'S1')>S1</option>
                            <option value="S2" @selected(old('pendidikan') == 'S2')>S2</option>
                            <option value="S3" @selected(old('pendidikan') == 'S3')>S3</option>
                        </select>
                        @error('pendidikan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label required">Pekerjaan</label>
                        <select class="form-select @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" required>
                            <option value="">Pilih Pekerjaan</option>
                            <option value="Belum Bekerja" @selected(old('pekerjaan') == 'Belum Bekerja')>Belum Bekerja</option>
                            <option value="Ibu Rumah Tangga" @selected(old('pekerjaan') == 'Ibu Rumah Tangga')>Ibu Rumah Tangga</option>
                            <option value="Mahasiswa" @selected(old('pekerjaan') == 'Mahasiswa')>Mahasiswa / Pelajar</option>
                            <option value="PNS" @selected(old('pekerjaan') == 'PNS')>PNS</option>
                            <option value="Karyawan Swasta" @selected(old('pekerjaan') == 'Karyawan Swasta')>Karyawan Swasta</option>
                            <option value="Wiraswasta" @selected(old('pekerjaan') == 'Wiraswasta')>Wiraswasta</option>
                            <option value="Petani" @selected(old('pekerjaan') == 'Petani')>Petani</option>
                            <option value="Buruh" @selected(old('pekerjaan') == 'Buruh')>Buruh</option>
                        </select>
                        @error('pekerjaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status_perkawinan" class="form-label required">Status Perkawinan</label>
                        <select class="form-select @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan" required>
                            <option value="">Pilih Status Perkawinan</option>
                            <option value="Belum Kawin" @selected(old('status_perkawinan') == 'Belum Kawin')>Belum Kawin</option>
                            <option value="Kawin" @selected(old('status_perkawinan') == 'Kawin')>Kawin</option>
                            <option value="Cerai Hidup" @selected(old('status_perkawinan') == 'Cerai Hidup')>Cerai Hidup</option>
                            <option value="Cerai Mati" @selected(old('status_perkawinan') == 'Cerai Mati')>Cerai Mati</option>
                        </select>
                        @error('status_perkawinan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status_hidup" class="form-label required">Status Hidup</label>
                        <select class="form-select @error('status_hidup') is-invalid @enderror" id="status_hidup" name="status_hidup" required>
                            <option value="1" @selected(old('status_hidup', '1') == '1')>Hidup</option>
                            <option value="0" @selected(old('status_hidup') == '0')>Meninggal</option>
                        </select>
                        @error('status_hidup')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('penduduk.index') }}" class="btn btn-warning me-1">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>

</x-app>
