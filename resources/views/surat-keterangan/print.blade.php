<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak {{ $surat->tipeSurat->nama_surat ?? 'Surat' }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            color: #000;
            background-color: #fff;
            margin: 0;
            padding: 40px;
            font-size: 16px;
            line-height: 1.5;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .header-kop {
            text-align: center;
            border-bottom: 5px double #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
            position: relative;
        }
        .header-kop h2 {
            margin: 0;
            text-transform: uppercase;
            font-size: 18px;
            letter-spacing: 0.5px;
        }
        .header-kop h1 {
            margin: 5px 0 0 0;
            text-transform: uppercase;
            font-size: 22px;
            font-weight: bold;
        }
        .header-kop p {
            margin: 5px 0 0 0;
            font-size: 13px;
            font-style: italic;
        }
        .title-surat {
            text-align: center;
            margin-bottom: 25px;
        }
        .title-surat h3 {
            margin: 0;
            text-transform: uppercase;
            font-size: 18px;
            text-decoration: underline;
            font-weight: bold;
        }
        .title-surat p {
            margin: 5px 0 0 0;
            font-size: 15px;
        }
        .content {
            margin-bottom: 40px;
            text-align: justify;
        }
        .content pre {
            white-space: pre-wrap;
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
        }
        .footer-tandatangan {
            float: right;
            text-align: center;
            width: 250px;
            margin-top: 20px;
        }
        .footer-tandatangan p {
            margin: 0;
        }
        .footer-tandatangan .nama-kades {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }
        /* Button style */
        .no-print-area {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            gap: 10px;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.5;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-primary {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-secondary {
            color: #212529;
            background-color: #f8f9fa;
            border-color: #ced4da;
        }
        @media print {
            .no-print-area {
                display: none;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <div class="no-print-area">
        <button onclick="window.print()" class="btn btn-primary">Cetak Surat</button>
        <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
    </div>

    <div class="container">
        <div class="header-kop">
            <h2>Pemerintah Kabupaten {{ $surat->penduduk->kartuKeluarga->kabupaten_kota ?? 'Bogor' }}</h2>
            <h2>Kecamatan {{ $surat->penduduk->kartuKeluarga->kecamatan ?? 'Cibinong' }}</h2>
            <h1>Kantor Kepala Desa {{ $surat->penduduk->kartuKeluarga->desa_kelurahan ?? 'Sukajaya' }}</h1>
            <p>Alamat: {{ $surat->penduduk->kartuKeluarga->alamat ?? 'Jl. Raya Merdeka No. 12' }}, Kode Pos: 16911</p>
        </div>

        <div class="title-surat">
            <h3>{{ $surat->tipeSurat->nama_surat }}</h3>
            <p>Nomor: {{ $surat->nomor_surat }}</p>
        </div>

        <div class="content">
            <pre>{{ $kontenParsed }}</pre>
        </div>

        <div class="footer-tandatangan">
            <p>{{ $surat->penduduk->kartuKeluarga->desa_kelurahan ?? 'Sukajaya' }}, {{ \Carbon\Carbon::parse($surat->updated_at)->isoFormat('D MMMM YYYY') }}</p>
            <p>Kepala Desa {{ $surat->penduduk->kartuKeluarga->desa_kelurahan ?? 'Sukajaya' }}</p>
            
            <p class="nama-kades">
                {{ $surat->processedBy ? $surat->processedBy->name : 'Kades Ahmad' }}
            </p>
        </div>
    </div>

    <script>
        // Auto trigger browser print after page load
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(function() {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
