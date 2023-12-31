<footer id="footer">
    <div class="footer-newsletter" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h3 class="text-center" style="text-align: center; color: #5777ba;">Sistem Informasi Pendaftaran
                        Magang Bea & Cukai Jember</h3>
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
</script>
</body>

</html>