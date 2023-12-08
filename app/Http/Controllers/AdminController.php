<?php

namespace App\Http\Controllers;

use App\Mail\MMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    protected $mail;

    public function __construct(MMail $mail)
    {
        $this->mail = $mail;
    }

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/log');
        }

        $userRole = Auth::user()->role;
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $show_all = $request->input('show_all');

        if ($userRole == 'operator') {
            $pendaftar = DB::table('pendaftar')
            ->when($start_date, function ($query) use ($start_date) {
                return $query->where('start_date', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->where('end_date', '<=', $end_date);
            })
            ->get();
            return view('admin.operator.admin', compact('pendaftar'));

        } elseif ($userRole == 'panitia') {
            $pendaftar = DB::table('pendaftar')
            ->when($start_date, function ($query) use ($start_date) {
                return $query->where('start_date', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->where('end_date', '<=', $end_date);
            })
            ->get();
            return view('admin.panitia.admin', compact('pendaftar'));
            
        } else {
            return view('errors.403');
        }
    }

    function operator()
    {
        $pendaftar = DB::table('pendaftar')->get();
        return view('admin.operator.admin', compact('pendaftar'));
    }
    function panitia()
    {
        $pendaftar = DB::table('pendaftar')->get();
        $peserta = DB::table('peserta')->get();
        return view('admin.panitia.admin', compact('pendaftar', 'peserta'));
    }

    public function download($id, $type)
    {
        $ambil = DB::table('pendaftar')->where('id_daftar', $id)->first();
        if (!$ambil) {
            return abort(404);
        }

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
            return abort(404);
        }
    }

    public function unduhProposal($id)
    {
        DB::table('pendaftar')->where('id_daftar', $id)->update(['status_pendaftar' => 'sedang di tinjau']);

        $ambil = DB::table('pendaftar')->where('id_daftar', $id)->first();

        if (!$ambil) {
            return abort(404);
        }

        $filePath = public_path('berkas/proposal/' . $ambil->proposal);

        if (file_exists($filePath)) {
            // Mengatur header respons untuk berkas yang akan diunduh
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');

            // Mengirimkan berkas sebagai respons
            return response()->file($filePath);
        } else {
            return abort(404);
        }
    }


    public function edit($id)
    {
        $pendaftar = DB::table('pendaftar')
            ->select('*')
            ->where('id_daftar', $id)
            ->first();

        if (!$pendaftar) {
            return abort(404);
        }

        // Dapatkan data peserta berdasarkan ID Pendaftar
        $peserta = DB::table('peserta')
            ->select('*')
            ->where('id_daftar', $id)
            ->get();

        return view('admin.edit', compact('pendaftar', 'peserta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pendaftar' => ['required', Rule::in(['di tolak', 'di terima', 'draft'])],
            'berkas' => $request->input('status_pendaftar') !== 'draft' ? 'required|mimes:pdf|max:2048' : '',
        ]);

        $pendaftar = DB::table('pendaftar')->where('id_daftar', $id)->first();

        if (!$pendaftar) {
            return redirect('/admin')->with('error', 'Pendaftar tidak ditemukan');
        }

        $newStatusPendaftar = $request->input('status_pendaftar');
        $catatan = $request->input('catatan');

        DB::table('pendaftar')
            ->where('id_daftar', $id)
            ->update([
                'status_pendaftar' => $newStatusPendaftar,
                'note' => $catatan,
            ]);

        $newStatusPeserta = $newStatusPendaftar === 'di terima' ? 'magang' : 'tidak';
        $peserta = DB::table('peserta')->where('id_daftar', $id)->first();
        if ($peserta) {
            DB::table('peserta')
                ->where('id_daftar', $id)
                ->update(['status' => $newStatusPeserta]);
        }

        $email = $pendaftar->email;
        if ($email) {
            $status = $request->input('status_pendaftar');
            $attachmentPath = null;
            $attachmentName = null;

            if ($request->input('status_pendaftar') !== 'draft' && $request->hasFile('berkas')) {
                $berkas = $request->file('berkas');
                $fileName = time() . '_' . $berkas->getClientOriginalName();
                $berkas->move(public_path('berkas/surat'), $fileName);
                $attachmentPath = public_path('berkas/surat/' . $fileName);
                $attachmentName = $fileName;

                DB::table('pendaftar')
                    ->where('id_daftar', $id)
                    ->update(['berkas_toter' => $fileName]);
            }

            // Menggunakan MMail untuk mengirim email notifikasi
            $this->mail->notifikasiStatusPendaftar($email, $status, $attachmentPath, $attachmentName, $catatan);

            return redirect('/admin')->with('status', 'Status pendaftar berhasil diperbarui');
        } else {
            return redirect('/admin')->with('error', 'Email pendaftar tidak ditemukan');
        }
    }
}
