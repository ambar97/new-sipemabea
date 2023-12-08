<!doctype html>
<html lang="en">

<head>
    @include('site.panitiahead')
    <style>
        .scrollable-table {
            max-height: 800px;
            overflow-y: auto;
        }
        .fixed-header {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: #d9edf7; /* Background color for the fixed header */
            color: black;
        }

        .fixed-header th {
            text-align: center;
            white-space: nowrap; /* Prevent text from wrapping to the next line */
        }

        .fixed-header td {
            white-space: nowrap; /* Prevent text from wrapping to the next line */
        }

        .table tbody tr:nth-child(even) {
            background-color: #d9edf7; /* Use a light blue color for even rows */
        }

        .table tbody tr:nth-child(odd) {
            background-color: white; /* Use white color for odd rows */
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        .centered-table td {
            text-align: center;
            vertical-align: middle;
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
        <form action="{{ route('admin.search') }}" method="GET">
            @csrf
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required>
            <button type="submit" class="btn btn-outline-primary btn-sm tambahin">Search Date</button>
            <a href=/admin class="btn btn-outline-primary btn-sm tambahin">Show All</a>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="scrollable-table">
                    <table class="table table-bordered centered-table">
                        <thead class="fixed-header">
                            <tr style="text-align: center;">
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
                                <td><h5>
                                    <span class="badge
                                        @if ($statusPeserta === 'magang') badge badge-success /* Green color for 'Magang' */
                                        @else badge badge-danger 'Tidak Magang' /* Red color for 'Tidak Magang' */
                                        @endif">
                                        {{ $statusPeserta }}
                                    </span></h5>
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