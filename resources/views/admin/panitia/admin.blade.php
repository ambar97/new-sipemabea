<!doctype html>
<html lang="en">

<head>
    @include('site.panitiahead')
    <style>
        .scrollable-table {
            max-height: 800px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center" style="color: #5777ba;">Selamat datang di halaman Panitia</h3>
            </div><br>
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <div class="scrollable-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Daftar</th>
                                <th>Tipe</th>
                                <th>Nama Instansi</th>
                                <th>Jurusan</th>
                                <th>Tujuan Magang</th>
                                <th>No Telp</th>
                                <th>No Surat</th>
                                <th>CV Pendaftar</th>
                                <th>Email</th>
                                <th>Proposal</th>
                                <th>Tanggal Input Data</th>
                                <th>Tanggal Mulai Magang</th>
                                <th>Tanggal Selesai Magang</th>
                                <th>Berkas yang ditolak/diterima</th>
                                <th>Status Pendaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftar as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->kd_daftar }}</td>
                                <td>{{ $data->type }}</td>
                                <td>{{ $data->nama_instansi }}</td>
                                <td>{{ $data->jurusan }}</td>
                                <td>{{ $data->tujuan_magang }}</td>
                                <td>{{ $data->notelp }}</td>
                                <td>{{ $data->no_surat }}</td>
                                <td><a href="{{ route('downloads', ['id' => $data->id_daftar, 'type' => 'cv']) }}"
                                        download>Lihat CV</a></td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <a href="{{ route('unduh.proposal', ['id' => $data->id_daftar]) }}"
                                        onclick="refreshAfterDownload(event)">Unduh Proposal</a>
                                </td>
                                <td>{{ $data->insert_time }}</td>
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->end_date }}</td>
                                <td>
                                    @if ($data->berkas_toter)
                                    <a href="{{ route('downloads', ['id' => $data->id_daftar, 'type' => 'berkas_toter']) }}"
                                        download>Lihat Berkas</a>
                                    @else
                                    Tidak ada berkas
                                    @endif
                                </td>
                                <?php
                                $statusPeserta = DB::table('peserta')->where('id_daftar', $data->id_daftar)->value('status');
                                ?>
                                <td>
                                    @if ($statusPeserta === 'magang')
                                    Magang
                                    @else
                                    Tidak Magang
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

<footer>
    @include('site.loginfooter')
</footer>

</html>