<head>
    @include('site.head')
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
                        <option value="umum" {{ old('jenis') == 'umum' ? 'selected' : '' }}>Umum</option>
                        <option value="mahasiswa/i" {{ old('jenis') == 'mahasiswa/i' ? 'selected' : '' }}>Mahasiswa/i</option>
                        <option value="siswa/i" {{ old('jenis') == 'siswa/i' ? 'selected' : '' }}>Siswa/i</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <small>Asal Kampus / Sekolah</small>
                    <input type="text" class="form-control" name="instansi" value="{{ old('instansi') }}" required>
                </div>
                <div class="col-md-6">
                    <small>Jurusan</small>
                    <input type="text" class="form-control" name="jurusan" value="{{ old('jurusan') }}" required>
                </div>
                <div class="col-md-6">
                    <small>Tanggal Mulai - Selesai</small>
                    <input type="text" class="form-control" name="dates" value="{{ old('dates', '') }}" required>
                </div>
                <div class="col-md-6">
                    <small>Tujuan Magang <small style="font-size:10px">ex: Magang Mandiri, Tugas Akhir,
                            dll</small></small>
                            <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan') }}" required>
                        </div>
                <div class="col-md-6">
                    <small>No Telp</small>
                    <input type="number" class="form-control" name="notelp"  value="{{ old('notelp') }}" required>
                </div>
                <div class="col-md-6">
                    <small>Email</small>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <small>Proposal Pengajuan Magang + Surat Pengantar <small style="font-size:10px">Max: 2MB |
                            PDF</small></small>
                    <input type="file" accept=".pdf" class="form-control" name="berkas" required>
                </div>
                <div class="col-md-6">
                    <small>No Kop Surat Pengantar</small>
                    <input type="text" class="form-control" name="no_surat" value="{{ old('no_surat') }}" required>
                    <small>di ambil dari nomor surat pengantar dari perguruan / sekolah. misal :
                        651/UNIV/05/202x</small>
                </div>
                <div class="col-md-6">
                    <small>CV Semua Peserta <small style="font-size:10px">Max: 2MB |
                            PDF</small></small>
                    <input type="file" accept=".pdf" class="form-control" name="ceve" required>
                </div>

                <div class="col-md-12">
                    <br>
                    <small>Data Peserta Magang</small>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <small>Nama Lengkap Peserta</small>
                            <input type="text" class="form-control" name="peserta[]" value="{{ old('peserta.0') }}" required>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <br>
                            <button type="button" class="btn btn-outline-primary btn-sm tambahin"><i class="fa fa-plus"> Tambah Peserta</i></button>
                        </div>
                        <div class="col-md-12 tambahan">
                            @for ($i = 1; $i < 20; $i++)
                                @if (old("peserta.$i"))
                                    <div class="row hapusto">
                                        <div class="col-md-8">
                                            <small>Nama Lengkap Peserta</small>
                                            <input type="text" class="form-control" name="peserta[]" value="{{ old("peserta.$i") }}" required>
                                        </div>
                                        <div class="col-md-2">
                                            <br>
                                            <button type="button" class="btn btn-outline-danger hapus to btn-sm"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12"><br>
                    <input type="checkbox" name="pernyataan" id="labelu" required> <label for="labelu"> <small> Saya
                            menyatakan
                            bahwa data yang saya kirimkan telah sesuai dan data yang sebenarnya </small></label>
                    <br>
                    <button id="ajukanBtn" class="btn btn-primary float-left" onclick="submitForm()">Ajukan Sekarang</button>
                </div>
                <div class="col-md-auto">
                    <div id="loadingIndicator" style="display: none;">Sedang Mengirim . . . .</div><br>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>

</section><!-- End Hero -->

<footer>
    @include('site.footer')
</footer>
<script>
        function submitForm() {
        // Show loading indicator
        $('#loadingIndicator').show();

        // Submit the form
        $('#ajukanBtn').attr('disabled', true); // Disable the button to prevent multiple submissions
        $('#ajukanBtn').closest('form').submit();
    }

    $('input[name="dates"]').daterangepicker({
        startDate: moment(),
        endDate: moment(),
        minDate: moment(),
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
    });
</script>