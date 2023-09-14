<html>

<head>
    @include('site.head')
</head>

<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1"
                data-aos="fade-up">
                <div>
                    <div class="wrapp">
                        <svg>
                            <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                                SIPEMABEA
                            </text>
                        </svg>
                    </div>
                    <h2>Sistem Informasi Pendaftaran Magang Bea & Cukai Jember</h2>
                    <a href="{{ asset('/daftar') }}" class="download-btn"><i class="fa fa-pencil"></i> Daftar
                        Sekarang</a>
                </div>
            </div>
            <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                data-aos="fade-up">
                <img src="{{ asset('Appland\assets\img\hero-img.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>

<main id="main">
    <section id="alur" class="features">
        <div class="container">
            <div class="row no-gutters">
                <img src="{{ asset('alur.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </section>

    <section id="pedoman" class="features">
        <div class="container">
            <h3 class="text-center" style="text-align: center; color: #5777ba;">PEDOMAN PEMBELAJARAN MAGANG KPPBC TMP C
                Jember</h3> <br>
            <div class="row no-gutters">
                <div class="table-responsive" id="hero" style="margin-top: -50px !important;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pokok Bahasan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Pengenalan DJBC
                                    dan KPPBC TMPC
                                    Jember</td>
                                <td>Disetarakan
                                    dengan 2 SKS</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Pengenalan
                                    ekspor</td>
                                <td>Disetarakan
                                    dengan 4 SKS</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Pengenalan
                                    Fasilitas
                                    Kepabenan dan
                                    Cukai.</td>
                                <td>Disetarakan
                                    dengan 4 SKS</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Pengenalan
                                    pengelolaan
                                    kinerja / KPI, kode
                                    etik Pegawai
                                    DJBC.</td>
                                <td>Disetarakan
                                    dengan 3 SKS</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Pengenalan
                                    proses hasil
                                    penindakan
                                    kepabeanan/cukai.
                                    Rokok Ilegal</td>
                                <td>Disetarakan
                                    dengan 2 SKS</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>Barang kiriman,
                                    pindahan, jasa
                                    titipan, barang
                                    penumpang.</td>
                                <td>Disetarakan
                                    dengan 4 SKS</td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td>Pendaftaran IMEI
                                    dan Modus
                                    Penipuan
                                    mengatasnamakan
                                    BC</td>
                                <td>Disetarakan
                                    dengan 2 SKS</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section id="kegiatan">
        <div class="container center">
            <h2>Galeri Kegiatan</h2>
            <hr>
            <div loading="lazy" data-mc-src="7457a397-020f-4868-9986-68031fba39f3#instagram"></div>
            <script src="https://cdn2.woxo.tech/a.js#637ae37ec90b1f81f96b26c4" async data-usrc>
            </script>
        </div>
    </section>

    <section id="sahabat">
        <div class="container">
            <h2 class="text-center">DAFTAR SAHABAT BEA CUKAI </h2>
            <hr>
            <div class="owl-carousel">
                @foreach ($peserta as $x)
                <div class="m-3 text-center">
                    <img style="border-radius: 50%; border: 1px solid white; "
                        src="{{ $x->foto == NULL ? 'https://cdn-icons-png.flaticon.com/512/219/219983.png' : asset('sakai/' . $x->foto) }}"
                        class="img-fluid" alt="">

                    <br><b><span style="margin-top: 15px !important; font-size: 15px;">{{ $x->nama }}</span> </b><br>
                    <small style="font-size: 13px;">{{ $x->asal }}</small>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</main>
<footer>
    @include('site.footer')
</footer>