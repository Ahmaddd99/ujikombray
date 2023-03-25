@extends('_layouts.admin')
@section('page_title', 'Semua Pengaduan')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Data Semua Pengaduan</h5>
                    <div class="d-inline">
                        <select name="month" id="month" class="form-select">
                            <option value="">Semua Pengaduan</option>
                            @foreach ($month as $item)
                                <option value="{{$item['value']}}">{{$item['month']}} </option>
                            @endforeach
                        </select>
                        <a href="{{route('admin.print-all')}}" class="btn btn-primary" id="Ronaldo">Cetak Pengaduan</a>
                    </div>
                </div>
                <div    class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="data-table">
                            <thead>
                                <th>Nama</th>
                                <th>Isi Pengaduan</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Dibuat tanggal</th>
                                <th>Ditanggapi tanggal</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/js/extensions/printpage.js')}}"></script>
    <script>
        $(document).ready(function() {
            initiateDatatable();
            $('#month').on('change', function () {
                var url = '{{ route('admin.print-all') }}' + '?month=' + $(this).val();
                $('#Ronaldo').attr('href',url)
                $('#data-table').DataTable().destroy()
                initiateDatatable($(this).val())
            })
            $('#Ronaldo').printPage({
                massage: 'Oke banh tunggu yh',
            })
        })

        function initiateDatatable(month = '') {
            $('#data-table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                autoWidth: false,
                ordering: false,
                ajax: {
                    url:'{{ route('admin.get-pengaduan-all') }}',
                    data: {
                        month: month,
                    }
                },
                columns: [{
                        data: 'masyarakat.nama'
                    },
                    {
                        data: 'isi_laporan'
                    },
                    {
                        data: 'foto'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'tgl_pengaduan'
                    },
                    {
                        data: 'tgl_tanggapan'
                    },
                    {
                        data: 'action'
                    }
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari Data",
                    lengthMenu: "Tampilkan _MENU_ baris",
                    zeroRecords: "Tidak ada data",
                    infoEmpty: "Menampilkan 0 - 0 (0 data)",
                    infoFiltered: "(Difilter dari _MAX_ total data)",
                    info: "Menampilkan _START_ - _END_ (_TOTAL_ data)",
                    paginate: {
                        previous: '<i class="bi bi-arrow-left"></i>',
                        next: '<i class="bi bi-arrow-right"></i>',
                    }
                },
            })
        }

        function responseAduan(no_pengaduan) {
            var url = '{{ route('admin.pengaduan-detail', ':id') }}';
            var url = url.replace(':id', no_pengaduan);
            window.location = url
        }
    </script>
@endsection
