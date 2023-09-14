<?php

namespace App\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class MMail extends Model
{
    public function registrasi($email, $id)
    {
        $data = [
            'title' => 'Pendaftaran Magang Bea & Cukai Jember',
            'content' => "Hai Sahabat BC Jember ! <br> Selamat data pendaftaran magang kamu telah sampai kepada kami dengan nomor pendaftaran <b>{$id}</b>. Kami akan memprosesnya segera. <br> Pastikan kamu pantau terus ya email kamu, kami akan mengirimkan informasi lebih lanjut dari pengajuan yang telah kamu lakukan atau dapat melihat melalui cek status pengajuan di laman sipemabea <br> terimakasih, jaga selalu kesehatan dengan tetap mematuhi protokol kesehatan. <br><br> Salam BC Jember"
        ];

        $this->sendEmail($email, $data);
    }

    public function notiBc($id)
    {
        $data = [
            'title' => 'Pendaftaran Magang Baru Bea & Cukai Jember',
            'content' => "Hai Admin BC Jember ! <br> Telah ada pengajuan pendaftaran magang baru di Sipemabea dengan nomor pendaftaran {$id}. Silakan melakukan konfirmasi pada pengajuan tersebut. <br><br> Salam BC Jember"
        ];

        $this->sendEmail(env('MAIL_FROM_ADDRESS'), $data);
    }

    private function sendEmail($to, $data, $attachmentPath = null, $attachmentName = null)
    {
        $title = $data['title'];
        $content = $data['content'];

        try {
            Mail::send('emails.template', ['title' => $title, 'content' => $content], function ($message) use ($to, $title, $attachmentPath, $attachmentName) {
                $message->to($to)
                    ->subject($title);

                // Attach berkas jika attachmentPath dan attachmentName tidak kosong
                if ($attachmentPath && $attachmentName && file_exists($attachmentPath)) {
                    $message->attach($attachmentPath, ['as' => $attachmentName]);
                }
            });
        } catch (\Exception $e) {
            // Display or log the error message
            dd($e->getMessage());
        }
    }



    public function notifikasiStatusPendaftar($email, $status, $attachmentPath = null, $attachmentName = null, $catatan = null)
    {
        $data = [
            'title' => 'Perubahan Status Pendaftaran Magang',
            'content' => "Hai Sahabat BC Jember ! <br> Status pendaftaran Anda telah mengalami perubahan baru menjadi <b>$status</b>. <br>"
                . ($catatan ? "Catatan: $catatan <br>" : "") // Tampilkan catatan jika ada
                . "Terima kasih atas kesabaran dan kerja keras Anda selama proses ini. Semua langkah ini adalah bagian alami dari perjalanan menuju hasil terbaik. <br> Mari kita terus bersama-sama melangkah ke depan dengan semangat positif!, jaga selalu kesehatan dengan tetap mematuhi protokol kesehatan. <br><br> Salam BC Jember"
        ];

        // Kirim email dengan atau tanpa lampiran berkas
        $this->sendEmail($email, $data, $attachmentPath, $attachmentName);
    }
}
