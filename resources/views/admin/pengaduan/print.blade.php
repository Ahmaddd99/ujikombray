<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengaduan Desa Citapen</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}" />
    <link rel="shortcut icon" href="{{ asset('img/logo_kabupaten.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('img/logo_kabupaten.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between col-md-4">
                        <img src="{{asset('img/logo_kabupaten.png')}}" alt="tidak ada foto" class="rounded" width="75px" height="100px">
                        <h3 class="text-center">Pengaduan Desa Citapen</h3>
                        <h6>2023 Ujikom</h6>
                    </div>
                    <div class="card-body">
                        @if (isset($month))
                        <h6>Pengaduan Bulan {{$month}} tahun {{$year}}</h6>
                        @else
                        <h6>Data Pengaduan</h6>
                        @endif

                        <table class="table" style="border: 1px solid gray">
                            <thead style="border: 2px solid gray">
                                <th>Pengadu</th>
                                <th>Isi Laporan</th>
                                <th>Tanggal Pengaduan</th>
                                <th>Status</th>
                                <th>Foto Bukti</th>
                            </thead>
                            <tbody style="border: 1px solid gray">
                                @forelse ($data as $item)
                                    <tr style="border: 1px solid gray">
                                        <td style="border: 1px solid gray">{{ $item->masyarakat->nama }}</td>
                                        <td style="border: 1px solid gray">{{ $item->isi_laporan }}</td>
                                        <td style="border: 1px solid gray">{{ date('d F Y h:m', strtotime($item->tgl_pengaduan)) }}</td>
                                        <td style="border: 1px solid gray">
                                            @if ($item->status == 'proses')
                                                <span class="badge bg-warning">{{ ucfirst($item->status) }}</span>
                                            @elseif ($item->status == 'selesai')
                                                <span class="badge bg-success">{{ ucfirst($item->status) }}</span>
                                            @elseif ($item->status == '0')
                                                <span class="badge bg-secondary">Belum Diproses</span>
                                            @else
                                                <span class="badge bg-dark">Ditolak</span>
                                            @endif
                                        </td>
                                        <td style="border: 1px solid gray">
                                            <img src="{{asset('img/pengaduan/'. $item->foto)}}" alt="tidak ada foto" class="rounded" width="200px" height="200px">
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data pengaduan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <h4>Total Pengaduan: {{$data->count()}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/extensions/print/print.js')}}"></script>
    <script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
