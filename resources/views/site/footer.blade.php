<footer id="footer">
    <div class="footer-newsletter" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h4>Cek Status Pengajuan</h4>
                    <p>Cek Status Pengajuan kamu disini dengan memasukkan Nomor Pendaftaran</p>
                    <form id="cario-form">
                        @csrf
                        <input style="border:none" placeholder="MAGANG-xxx" type="text" class="form-control"
                            id="emailer" name="kode">
                        <input type="submit" value="Cari" id="cario">
                    </form>
                    <div class="clases">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact" data-aos="fade-up">
                    <h5>Bea & Cukai Jember</h5>
                    <p>
                        Jl. Kalimantan, Krajan Timur, Sumbersari Jember <br><br>
                        <strong>Telepon :</strong> (0331)5444442-5444470<br>
                        <strong>Email :</strong> info@example.com<br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="100">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ asset('/') }}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a
                                href="https://www.bcjember.beacukai.go.id/">Website</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ asset('kegiatan') }}">Kegiatan</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="200">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://silangit.beacukaijember.com/">Aplikasi
                                Penguna Jasa</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a
                                href="https://www.bcjember.beacukai.go.id/Pengaduan">Pengaduan Masyarakat</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="300">
                    <p>Direktorat Jenderal Bea dan Cukai adalah nama dari sebuah instansi pemerintah yang melayani
                        masyarakat di bidang kepabeanan dan cukai.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="copyright">
            &copy; Copyright <strong><span>BCJember</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="">Team IT of BC Jember</a>
        </div>
    </div>
</footer>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('Appland/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Appland/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Appland/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('Appland/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('Appland/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('Appland/assets/vendor/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('Appland/assets/vendor/aos/aos.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('OwlCarousel/dist/owl.carousel.min.js') }}"></script>
<!-- Template Main JS File -->
<script src="{{ asset('Appland/assets/js/main.js') }}"></script>

<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            items: 5,
            autoplay: true,
            autoPlaySpeed: 5000,
            autoPlayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            navigation: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false
                }
            }
        });
    });

    $(document).on("submit", "#cario-form", function (e) {
        e.preventDefault();
        var mailer = $('#emailer').val();
        $.ajax({
            type: "POST",
            url: '{{ route("cariData") }}',
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                kode: mailer
            },
            success: function (data) {
                $('.clases').empty();
                $('.clases').append(
                    '<br>' +
                    '<span>Nomor Pendaftaran : ' + mailer + ' </span> <br>' +
                    '<span>Status : <small style="font-size:16px" class="' + data.warn + '">' + data.status +
                    '</small></span><br>' +
                    '<span>Tanggal magang : ' + data.tanggal + '</span>' +
                    '<br>' +
                    '<span>Jenis Magang : ' + data.jenis + '</span>' +
                    '<br>' + '<span>Tujuan Magang : ' + data.tujuan + '</span>' +
                    '<br>' +
                    '<span>Instansi : ' + data.instansi + '</span><br>'
                );

                // Cek jika status di terima atau di tolak dan ada berkas_toter
                if (data.status === 'di terima' || data.status === 'di tolak') {
                    // Tampilkan tombol unduh berkas
                    $('.clases').append(
                        '<span>Unduh Berkas : <a href="/download/' + data.idnn + '/berkas_toter" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download Berkas Balasan</a></span>'
                    );
                }

                $('#emailer').val('');
            },
            error: function () {
                $('.clases').empty();
                $('.clases').append('<span>Error: Data tidak ditemukan.</span>');
            }
        });
    });
</script>
</body>

</html>