<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar;
use App\Models\Peserta;


class DaftarController extends Controller
{
    public function tambah(Request $request)
    {
        $dates = $request->dates;
        $split = explode('-', $dates);
        $count = count($split);

        if ($count <> 2) {
            #invalid data
        }

        $start = date('Y/m/d', strtotime($split[0]));
        $end = date('Y/m/d', strtotime($split[1]));

        $fileName = time() . '.pdf';
        $request->file->move(public_path('upload'), $fileName);
        $kd = 'MAGANG-' . date('dmyhis');

        $daftarData = [
            'nama_instansi' => $request->instansi,
            'type' => $request->jenis,
            'jurusan' => $request->jurusan,
            'start_date' => $start,
            'end_date' => $end,
            'proposal' => $fileName,
            'no_surat' => $request->no_surat,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'tujuan_magang' => $request->tujuan,
            'kd_daftar' => $kd,
        ];
        $daftar = Daftar::create(
            $daftarData
        );

        $namapeserta = $request->peserta;
        foreach ($namapeserta as $data) {
            Peserta::create([
                'nama_peserta' => $data,
                'start' => $start,
                'end' => $end,
                'id_daftar' => $daftar->id_daftar,
                'kd_daftar' => $kd,
            ]);
        }
        return redirect()->route('daftar.detail', ['kd' => $kd]);
    }

    public function detail($arr)
    {
        $daftarData['nomor'] = $arr;
        return view('detail_daftar', $daftarData);
    }
}
