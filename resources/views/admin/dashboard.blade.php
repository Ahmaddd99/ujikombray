@extends('_layouts.admin')
@section('page_title', 'Dashboard')
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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3>Halo {{ $me->nama_petugas }}</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <b>Total Masyarakat</b>
                </div>
                <div class="card-body">{{ $total_user }}</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <b>Total Pengaduan</b>
                </div>
                <div class="card-body">{{ $total_pengaduan }}</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <b>Total Pengaduan Ditanggapi</b>
                </div>
                <div class="card-body">{{ $tanggap }}</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <b>Total Pengaduan Belum Ditanggapi</b>
                </div>
                <div class="card-body">{{ $belum_tanggap }}</div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        @forelse ($pengaduan as $item)
            <div class="col-md-4">
                @if ($item->status == '0')
                    <h3>Waduh masih ada yang nih pending, ayo tanggapi!</h3>
                @endif
            </div>
        @endforelse
    </div> --}}
    {{-- <div class="row">
        @forelse ($pengaduan as $item)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Status :</span>
                        @if ($item->status == '0')
                            <span class="badge bg-secondary">Segera Verifikasi</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h6>{{ $item->isi_laporan }}</h6>
                        <div class="d-flex justify-content-center">
                            <img src="{{asset('img/pengaduan/'. $item->foto)}}" alt="tidak ada foto" class="rounded" width="200px" height="200px">
                        </div>
                    </div>
                    <form action="{{ route('admin.create-tanggapan', $item->no_pengaduan) }}" method="post">
                        <div class="d-flex justify-content-between">
                            @if ($item->status == '0')
                                <button class="btn btn-small btn-primary">gasss</button>
                            @endif
                            <small>{{ date('d F Y h:m:s', strtotime($item->tgl_pengaduan)) }}</small>
                        </div>
                    </form>
                </div>
            </div>
        @empty
        @endforelse
    </div> --}}
@endsection
