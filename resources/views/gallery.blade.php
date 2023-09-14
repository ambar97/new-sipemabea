<head>
    @include('site.head')
</head>
<section id="hero" class="d-flex align-items-center">
    <div class="container" style="margin-bottom: -20px !important;">
        <h1>Galery Kegiatan</h1>
        <hr>
        <div loading="lazy" data-mc-src="75542ac8-3b06-4ce6-b2b0-7bf8b55477ee#instagram"></div>

        <script src="https://cdn2.woxo.tech/a.js#637ae37ec90b1f81f96b26c4" async data-usrc>
        </script>
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