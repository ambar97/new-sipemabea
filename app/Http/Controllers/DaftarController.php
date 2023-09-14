<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\MMail;

class DaftarController extends Controller
{
    protected $mail;

    public function __construct(MMail $mail)
    {
        $this->mail = $mail;
    }

    public function index()
    {
        return view('daftar');
    }

    public function insertData(Request $req)
    {
        $validatedData = $req->validate([
            'jenis' => ['required', Rule::in(['umum', 'mahasiswa/i', 'siswa/i'])],
            'instansi' => 'required|string|max:100',
            'jurusan' => 'required|string|max:30',
            'dates' => 'required|string',
            'berkas' => 'required|mimes:xls,pdf|max:2048',
            'no_surat' => 'required|string|max:100',
            'email' => 'required|email|max:50',
            'notelp' => 'required|string|max:13',
            'tujuan' => 'required|string',
            'peserta' => 'required|array',
            'peserta.*' => 'required|string|max:100',
            'pernyataan' => 'required|accepted',
            'ceve' => 'required|mimes:pdf|max:2048',
        ], [
            'tujuan.required' => 'Tujuan magang harus dipilih.',
            'email.required' => 'Mail harus diisi untuk pemberitahuan lebih lanjut.',
            'jurusan.required' => 'Asal Fakultas / Jurusan harus diisi',
            'notelp.required' => 'Nomor telepon harus diisi untuk pemberitahuan lebih lanjut.',
            'instansi.required' => 'Asal perguruan / sekolah harus diisi.',
            'berkas.required' => 'Proposal Pengajuan peserta harus diunggah.',
            'berkas.mimes' => 'File harus berupa PDF.',
            'berkas.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            'no_surat.required' => 'Nomor Surat harus diisi.',
            'ceve.required' => 'CV peserta harus diunggah.',
            'ceve.mimes' => 'File CV harus berupa PDF.',
            'ceve.max' => 'Ukuran CV peserta tidak boleh lebih dari 2MB.',
        ]);

        $jenis = $validatedData['jenis'];
        $instansi = $validatedData['instansi'];
        $dates = $validatedData['dates'];
        $split = explode('-', $dates);
        $count = count($split);

        if ($count !== 2) {
            // Handle invalid data
        }

        $start = date('Y/m/d', strtotime($split[0]));
        $end = date('Y/m/d', strtotime($split[1]));
        $email = $validatedData['email'];
        $notelp = $validatedData['notelp'];
        $tujuan = $validatedData['tujuan'];
        $peserta = $validatedData['peserta'];
        $jurusan = $validatedData['jurusan'];
        $nosurat = $validatedData['no_surat'];
        $kd = 'MAGANG-' . date('dmyhis');

        if ($req->hasFile('berkas') && $req->hasFile('ceve')) {
            $file = $req->file('berkas');
            $fileCv = $req->file('ceve');
            $fileName = time() . "_" . $file->getClientOriginalName();
            $ceveName = time() . "_" . $fileCv->getClientOriginalName();
            $file->move(public_path('berkas/proposal'), $fileName);
            $fileCv->move(public_path('berkas/cv'), $ceveName);
            $data = [
                'kd_daftar' => $kd,
                'type' => $jenis,
                'nama_instansi' => $instansi,
                'tujuan_magang' => $tujuan,
                'start_date' => $start,
                'end_date' => $end,
                'proposal' => $fileName,
                'cv_pendaftar' => $ceveName,
                'email' => $email,
                'notelp' => $notelp,
                'jurusan' => $jurusan,
                'no_surat' => $nosurat,
            ];

            $id_daftar = DB::table('pendaftar')->insertGetId($data);
            foreach ($peserta as $pesertaNama) {
                $pesertaData = [
                    'nama_peserta' => $pesertaNama,
                    'start' => $start,
                    'end' => $end,
                    'id_daftar' => $id_daftar,
                    'kd_daftar' => $kd,
                ];
                DB::table('peserta')->insert($pesertaData);
            }

            $this->mail->registrasi($email, $kd);
            $this->mail->notiBc($kd);
            Log::info('Data successfully inserted into database.');
            return redirect()->route('daftar.detail', ['arr' => $kd]);
        } else {
            return "File Kosong";
        }
    }

    public function detail($arr)
    {
        $data = ['nomor' => $arr];
        return view('detail_daftar', $data);
    }

    public function cariData(Request $request)
    {
        $kd = $request->input('kode');
        $ambil = DB::table('pendaftar')->where('kd_daftar', $kd)->first();
        if ($ambil->status_pendaftar == 'pengajuan') {
            $echo = 'text-warning';
        } elseif ($ambil->status_pendaftar == 'sedang di tinjau') {
            $echo = 'text-primary';
        } elseif ($ambil->status_pendaftar == 'di tolak') {
            $echo = 'text-danger';
        } else {
            $echo = 'text-success';
        }

        $kirim = [
            'status' => $ambil->status_pendaftar,
            'warn' => $echo,
            'tanggal' => date('d F Y', strtotime($ambil->start_date)) . ' s.d. ' . $ambil->end_date,
            'jenis' => $ambil->type,
            'tujuan' => $ambil->tujuan_magang,
            'instansi' => $ambil->nama_instansi,
            'idnn' => $ambil->id_daftar,
        ];
        return response()->json($kirim);
    }

    public function downloadBerkasToter($id)
    {
        // Ambil kolom berkas_toter dari database berdasarkan ID
        $berkasToter = DB::table('pendaftar')->select('berkas_toter')->where('id_daftar', $id)->first();

        if ($berkasToter) {
            $berkasData = $berkasToter->berkas_toter;

            // Cek apakah berkas tidak kosong
            if (!empty($berkasData)) {
                // Atur header respons agar berkas dapat diunduh
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="berkas_toter_' . $id . '.pdf"');
                header('Content-Length: ' . strlen($berkasData));

                // Keluarkan berkas ke output
                echo $berkasData;
            } else {
                // Jika berkas kosong, tampilkan pesan atau redirect sesuai kebutuhan
                return redirect()->back()->with('error', 'Berkas tidak ditemukan atau kosong.');
            }
        } else {
            // Jika tidak ada data dengan ID yang sesuai, tampilkan pesan atau redirect sesuai kebutuhan
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    public function download($id, $type)
    {
        $ambil = DB::table('pendaftar')->where('id_daftar', $id)->first();
        if ($ambil) {
            if ($type === 'proposal') {
                $filename = $ambil->proposal;
                $filePath = public_path('berkas/proposal/' . $filename);
            } elseif ($type === 'cv') {
                $filename = $ambil->cv_pendaftar;
                $filePath = public_path('berkas/cv/' . $filename);
            } elseif ($type === 'berkas_toter') {
                $filename = $ambil->berkas_toter;
                $filePath = public_path('berkas/surat/' . $filename);
            } else {
                return abort(404);
            }

            if (file_exists($filePath)) {
                return response()->download($filePath);
            } else {
                dd("File not found at path: " . $filePath);
            }
        } else {
            return abort(404);
        }
    }
}
