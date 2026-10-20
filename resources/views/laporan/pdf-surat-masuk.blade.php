<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Masuk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }
        
        .container {
            width: 98%;
            padding: 20px;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }
        
        .header-content {
            display: table;
            width: 97%;
            margin-bottom: 10px;
        }
        
        .logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
        }
        
        .logo img {
            width: 70px;
            height: 70px;
        }
        
        .header-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        
        .header-text h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .header-text p {
            font-size: 11px;
            margin-bottom: 2px;
        }
        
        .title {
            margin-top: 15px;
        }
        
        .title h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .title p {
            font-size: 11px;
            color: #666;
        }
        
        /* Table */
        table {
            width: 98%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
            padding: 8px;
            border: 1px solid #333;
            font-size: 10px;
        }
        
        table td {
            padding: 6px 8px;
            border: 1px solid #333;
            font-size: 10px;
            vertical-align: top;
        }
        
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        /* Status Badge */
        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .status-belum-dibaca {
            background-color: #fee;
            color: #c00;
        }
        
        .status-sudah-dibaca {
            background-color: #e7f3ff;
            color: #0066cc;
        }
        
        .status-diproses {
            background-color: #fff4e5;
            color: #cc8800;
        }
        
        .status-selesai {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        
        /* Footer */
        .footer {
            margin-top: 40px;
            page-break-inside: avoid;
        }
        
        .footer-content {
            display: table;
            width: 98%;
        }
        
        .footer-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        .footer-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: right;
        }
        
        .signature-space {
            margin-top: 80px;
            border-bottom: 1px solid #333;
            width: 200px;
            margin-left: auto;
        }
        
        .print-info {
            font-size: 9px;
            color: #666;
            margin-top: 5px;
        }
        
        /* Page Break */
        .page-break {
            page-break-after: always;
        }
        
        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.05);
            z-index: -1;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <div class="container">
        
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="logo">
                    <!-- Logo akan muncul jika file ada -->
                    @if(file_exists(public_path('images/logo-kuningan.png')))
                    <img src="{{ public_path('images/logo-kuningan.png') }}" alt="Logo BPKAD">
                    @endif
                </div>
                <div class="header-text">
                    <h1>LAPORAN SURAT MASUK</h1>
                    <h2>BADAN PENGELOLA KEUANGAN DAN ASET DAERAH</h2>
                    <p>Jl. Siliwangi No. 88, Kelurahan Purwawinangun, Kecamatan Kuningan, Kabupaten Kuningan, Jawa Barat 45512</p>
                    <p>Periode: {{ \Carbon\Carbon::parse($tanggalAwal)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d F Y') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Tabel Data -->
        @if($data->count() > 0)
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th style="width: 15%;">Nomor Surat</th>
                    <th class="text-center" style="width: 12%;">Tgl. Surat</th>
                    <th class="text-center" style="width: 12%;">Tgl. Diterima</th>
                    <th style="width: 18%;">Pengirim</th>
                    <th style="width: 25%;">Perihal</th>
                    <th class="text-center" style="width: 13%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $surat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td class="text-center">{{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $surat->tanggal_diterima->format('d/m/Y') }}</td>
                    <td>{{ $surat->pengirim }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td class="text-center">
                        <span class="status 
                            @if($surat->status == 'belum_dibaca') status-belum-dibaca
                            @elseif($surat->status == 'sudah_dibaca') status-sudah-dibaca
                            @elseif($surat->status == 'diproses') status-diproses
                            @else status-selesai @endif">
                            {{ ucfirst(str_replace('_', ' ', $surat->status)) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    <p><strong>Total Surat Masuk:</strong> {{ $data->count() }} surat</p>
                    <p class="print-info">Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</p>
                </div>
                <div class="footer-right">
                    <p>Mengetahui,</p>
                    <div class="signature-space"></div>
                    <p><strong>Kepala BPKAD</strong></p>
                </div>
            </div>
        </div>
        
        @else
        <div style="text-align: center; padding: 50px 0;">
            <p style="font-size: 14px; color: #666;">Tidak ada data surat masuk dalam periode yang dipilih.</p>
        </div>
        @endif
        
    </div>
    
</body>
</html>