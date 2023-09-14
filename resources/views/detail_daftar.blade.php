<head>
    @include('site.head')
</head>
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <h5>Selamat ..</h5>
        <h6>Data Kamu telah tersimpan dengan nomor pendaftaran {{ $nomor }} .. cek pesan masuk di emailmu untuk
            informasi lebih lengkap.</h6>
    </div>
</section><!-- End Hero -->

<footer>
    @include('site.footer')
</footer>

<script>
    $(document).ready(function() {
        $('input[name="dates"]').daterangepicker({
            opens: 'left'
        });

        $(document).on('click', '.tambahin', function() {
            $('.tambahan').append(
                '<div class="row hapusto">' +
                '<div class="col-md-8">' +
                '<small>Nama Lengkap Peserta</small>' +
                '<input type="text" class="form-control" name="peserta[]" id="" required>' +
                '</div>' +
                '<div class="col-md-2"><br><button type="button" class="btn btn-outline-danger hapus to btn-sm"><i class="fa fa-minus"></i></button></div>' +
                '<div class="col-md-2"> </div>' +
                '</div>'
            );
        });

        $(document).on('click', '.hapus', function() {
            $(this).parent().parent().remove();
        });
    });
</script>