<!DOCTYPE html>
<html lang="en">

<head>
    @include('site.loginhead')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <br><br><br>
            <h2 class="text-center" style="color: #5777ba;">Edit Status Pengajuan</h2>
        </header>
        <div class="form-container">
            <form action="{{ route('update', ['id' => $pendaftar->id_daftar]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tampilkan informasi dari tabel pendaftar -->
                <div class="container">
                    <h4>Informasi Pendaftar</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nomor Pendaftaran</th>
                                <th>Nama Instansi</th>
                                <th>Jurusan</th>
                                <th>Tujuan Magang</th>
                                <th>Email</th>
                                <th>Proposal</th>
                                <th>CV</th>
                                <th>Berkas</th>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $pendaftar->kd_daftar }}</td>
                                <td>{{ $pendaftar->nama_instansi }}</td>
                                <td>{{ $pendaftar->jurusan }}</td>
                                <td>{{ $pendaftar->tujuan_magang }}</td>
                                <td>{{ $pendaftar->email }}</td>
                                <td>
                                    <a href="{{ route('unduh.proposal', ['id' => $pendaftar->id_daftar]) }}"
                                        onclick="refreshAfterDownload(event)">Unduh Proposal</a>
                                </td>
                                <td><a href="{{ route('downloads', ['id' => $pendaftar->id_daftar, 'type' => 'cv']) }}"
                                        download>Lihat CV</a></td>
                                <td>
                                    @if ($pendaftar->berkas_toter)
                                    <a href="{{ route('downloads', ['id' => $pendaftar->id_daftar, 'type' => 'berkas_toter']) }}"
                                        download>Lihat Berkas</a>
                                    @else
                                    Tidak ada berkas
                                    @endif
                                </td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        </tbody>
                    </table>
                </div><br>

                <!-- Tampilkan informasi dari tabel peserta jika ada -->
                @if ($peserta->count() > 0)
                <div class="container">
                    <h4>Informasi Peserta</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Peserta</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $item)
                            <tr>
                                <td>{{ $item->nama_peserta }}</td>
                                <td>{{ $item->start }}</td>
                                <td>{{ $item->end }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <br>
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="status_pendaftar">Status Pendaftar</label>
                        <select name="status_pendaftar" id="statuspendaftar" class="form-control"
                            {{$pendaftar->status_pendaftar == 'di terima' || $pendaftar->status_pendaftar == 'di tolak'
                            ? 'disabled':''}} >
                            <option value="di tolak" {{ $pendaftar->status_pendaftar == 'di tolak' ? 'selected':''
                                }}>Ditolak</option>
                            <option value="di terima" {{ $pendaftar->status_pendaftar == 'di terima' ? 'selected':''
                                }}>Diterima</option>
                            <option value="draft" {{ $pendaftar->status_pendaftar == 'draft' ? 'selected':''
                                }}>Draft
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" name="catatan" {{$pendaftar->status_pendaftar == 'di terima' || $pendaftar->status_pendaftar == 'di tolak'
                                ? 'disabled':''}}>{{ old('catatan', $pendaftar->note) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group" id="berkas-group">
                        <div class="col-md-6">
                            <label for="berkas">Berkas Informasi <small style="font-size:10px">Max: 2MB |
                                    PDF</small></label>
                            <input required type="file" {{$pendaftar->status_pendaftar == 'di terima' ||
                            $pendaftar->status_pendaftar == 'di tolak'? 'disabled' : ''}} accept=".pdf"
                            class="form-control" name="berkas">
                            @error('berkas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    @error('status_pendaftar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary" onclick="submitForm()" id="ajukanBtn" {{$pendaftar->status_pendaftar ==
                        'di terima' || $pendaftar->status_pendaftar == 'di tolak'
                        ? 'disabled':''}} >Simpan Perubahan</button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                    <div id="loadingIndicator" style="display: none;">
                        Loading...
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>

    <footer>
        @include('site.loginfooter')
    </footer>

    <script>
        $(document).ready(function() {
            // Fungsi untuk memeriksa dan mengubah atribut 'required' pada input berkas
            function toggleFileInputRequired() {
                var statusPendaftar = $('#statuspendaftar').val();
                if (statusPendaftar === 'draft') {
                    $('#berkas-group').hide();
                    $('input[name="berkas"]').removeAttr('required');
                } else {
                    $('#berkas-group').show();
                    $('input[name="berkas"]').attr('required', 'required');
                }
            }

            // Panggil fungsi di atas saat halaman dimuat dan saat status_pendaftar berubah
            toggleFileInputRequired();
            $('#statuspendaftar').on('change', toggleFileInputRequired);
        });
    </script>
    <script>
        $(document).ready(function() {
            function toggleFileInputRequired() {
                var statusPendaftar = $('#statuspendaftar').val();
                if (statusPendaftar === 'draft') {
                    $('#berkas-group').hide();
                    $('input[name="berkas"]').removeAttr('required');
                } else {
                    $('#berkas-group').show();
                    $('input[name="berkas"]').attr('required', 'required');
                }
            }
    
            toggleFileInputRequired();
            $('#statuspendaftar').on('change', toggleFileInputRequired);
        });
    </script>
    
    <script>
        function refreshAfterDownload(event) {
            event.preventDefault();
            var downloadLink = event.target.href;
    
            // Buat elemen untuk mengunduh file
            var downloadElement = document.createElement('a');
            downloadElement.style.display = 'none';
            downloadElement.href = downloadLink;
            document.body.appendChild(downloadElement);
    
            // Mulai pengunduhan
            downloadElement.click();
    
            // Tunggu sejenak sebelum memuat ulang halaman
            setTimeout(function () {
                location.reload();
            }, 1000); // Ganti dengan penundaan yang sesuai (dalam milidetik)
        }
    </script>
    <script>
        function submitForm() {
            // Show loading indicator
            $('#loadingIndicator').show();
    
            // Disable the button to prevent multiple submissions
            $('#ajukanBtn').attr('disabled', true);
    
            // Submit the form
            $('#ajukanBtn').closest('form').submit();
        }
    </script>
</body>

</html>