@extends('_layouts.ini-beda')
@section('page_title', 'Tanggapan Pengaduan')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('img/pengaduan/' . $data->foto) }}" class="rounded" width="100%" height="400px"
                                alt="tidak ada gambar">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group d-flex flex-column">
                                <label for="isi">Isi Laporan :</label>
                                <span><b>{{ $data->isi_laporan }}</b></span>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label for="isi">Tanggal Dibuat :</label>
                                <span><b>{{ date('d F Y', strtotime($data->tgl_pengaduan)) }}</b></span>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label for="isi">Tanggapan :</label>
                                <span><b>{{ $tanggapan->tanggapan }}</b></span>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label for="isi">Ditanggapi Oleh :</label>
                                <span><b>{{ $tanggapan->petugas->nama_petugas }}</b></span>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label for="isi">Ditanggapi Pada :</label>
                                <span><b>{{ date('d F Y', strtotime($tanggapan->tgl_tanggapan)) }}</b></span>
                            </div>
                            <a href="{{('')}}" class="btn btn-primary printPage">Print</a>
                            <a href="{{ route('admin.pengaduan-done') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/js/extensions/printpage.js')}}"></script>
@endsection
