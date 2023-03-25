@extends('_layouts.app')
@section('content')
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px grey;
            border-radius: 8px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(117, 115, 115);
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(42, 41, 41)
        }
    </style>
    <div class="page-heading">
        <h3>Halo {{ $me->nama }}, Selamat datang</h3>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Berikut cara mudah untuk membuat pengaduan</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Pertama, klik "Pengaduan"</li>
                        <li>Setelah masuk, klik "buat pengaduan" yang terdapat pada halaman atas tabel</li>
                        <li>Lalu isi form yang disediakan, pastikan terisi semua</li>
                        <li>Jika sudah klil "buat pengaduan"</li>
                        <li>Pengaduan anda sudah terkirim. silahkan tunggu 2-5 hari hingga proses pengaduan selesai</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <b>Pengaduan yang belum diverifikasi</b>
                </div>
                <div class="card-body">{{ $belum_verif }} </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <b>Pengaduan Yang Sedang Diproses</b>
                </div>
                <div class="card-body">{{ $belum_tanggap }} </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <b>Pengaduan Yang Sudah Selesai</b>
                </div>
                <div class="card-body">{{ $sudah_tanggap }} </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <b>Total Pengaduan</b>
                </div>
                <div class="card-body">{{ $total_pengaduan }} </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h3>Beberapa aduan dari masyarakat lain</h3>
    </div>
    <div class="row">
        @forelse ($pengaduan as $item)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Status :</span>
                        @if ($item->status == 'selesai')
                            <span class="badge bg-success">Sudah Selesai</span>
                        @endif
                        @if ($item->status == 'proses')
                            <span class="badge bg-warning">Sedang Proses</span>
                        @endif
                        @if ($item->status == '0')
                            <span class="badge bg-secondary">Belum Terverifikasi</span>
                        @endif
                    </div>
                    <div class="card-body d-flex">
                        <h6 class="col-md-6">{{ $item->isi_laporan }}</h6>
                        <img src="{{asset('img/pengaduan/'. $item->foto)}}" alt="tidak ada foto" class="rounded" width="200px" height="200px">
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <small>{{ date('d F Y h:m:s', strtotime($item->tgl_pengaduan)) }}</small>
                            @if ($item->status == 'selesai')
                                <a href="{{ route('masyarakat.pengaduan.tanggapan.detail', $item->no_pengaduan) }}"
                                    class="btn btn-sm btn-primary">Lihat tanggapan</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
        @endforelse
    </div>
@endsection
