<head>
    @include('site.head')
</head>
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <form method="post" action="/daftar/insert" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <small>Jenis Magang</small>
                    <select name="jenis" class="form-control" id="" required>
                        <option value="" selected disabled>Pilih Jenis</option>
                        <option value="umum">Umum</option>
                        <option value="mahasiswa/i">Mahasiswa/i</option>
                        <option value="siswa/i">Siswa/i</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <small>CV Semua Peserta <small style="font-size:10px">Max: 2MB |
                            PDF</small></small>
                    <input type="file" accept=".pdf" class="form-control" name="ceve" required>
                </div>
                <div class="col-md-6">
                    <small>Fakultas / Jurusan</small>
                    <input type="text" class="form-control" name="jurusan" required>
                </div>
                <div class="col-md-6">
                    <small>Asal Perguruan / Sekolah</small>
                    <input type="text" class="form-control" name="instansi" required>
                </div>
                <div class="col-md-6">
                    <small>Tanggal Mulai - Selesai</small>
                    <input type="text" class="form-control" name="dates" required>
                </div>
                <div class="col-md-6">
                    <small>Proposal Pengajuan Magang + Surat Pengantar <small style="font-size:10px">Max: 2MB |
                            PDF</small></small>
                    <input type="file" accept=".pdf" class="form-control" name="berkas" required>
                </div>
                <div class="col-md-6">
                    <small>No Kop Surat Pengantar</small>
                    <input type="text" class="form-control" name="no_surat" required>
                    <small>di ambil dari nomor surat pengantar dari perguruan / sekolah. misal :
                        651/UNIV/05/202x</small>
                </div>
                <div class="col-md-6">
                    <small>Email</small>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="col-md-6">
                    <small>No Telp</small>
                    <input type="number" class="form-control" name="notelp" required>
                </div>
                <div class="col-md-6">
                    <small>Tujuan Magang <small style="font-size:10px">ex: Magang Mandiri, Tugas Akhir,
                            dll</small></small>
                    <textarea name="tujuan" class="form-control" id="" cols="30" rows="4"></textarea>
                </div>
                <div class="col-md-12">
                    <br>
                    <small>Data Peserta Magang</small>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <small>Nama Lengkap Peserta</small>
                            <input type="text" class="form-control" name="peserta[]" id="" required>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2"> <br><button type="button"
                                class="btn btn-outline-primary btn-sm tambahin"><i class="fa fa-plus"> Tambah
                                    Peserta</i></button></div>
                        <div class="col-md-12 tambahan"></div>
                    </div>
                </div>
                <div class="col-md-12"><br>
                    <input type="checkbox" required name="pernyataan" id="labelu"> <label for="labelu"> <small> Saya
                            menyatakan
                            bahwa data yang saya kirimkan telah sesuai dan data yang sebenarnya </small></label>
                    <br>
                    <button class="btn btn-primary float-left">Ajukan Sekarang</button>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </form>
    </div>

</section><!-- End Hero -->

<footer>
    @include('site.footer')
</footer>
<script>
    $('input[name="dates"]').daterangepicker({
        opens: 'left'
    });
    $(document).on('click', '.tambahin', function() {
        // alert('d');
        $('.tambahan').append('<div class="row hapusto"><div class="col-md-8" >' +
            '<small>Nama Lengkap Peserta</small>' +
            '<input type="text" class="form-control" name="peserta[]" id="" required>' +
            '</div>' +
            '<div class="col-md-2"><br><button type="button" class="btn btn-outline-danger hapus to btn-sm"><i class="fa fa-minus"></i></button></div>' +
            '<div class="col-md-2"> </div></div>');
    });
    $(document).on('click', '.hapus', function() {
        $(this).parent().parent().remove();
    })
</script>