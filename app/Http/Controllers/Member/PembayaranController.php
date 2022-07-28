<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Payment;
use App\Models\Reservasi;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function detail($id)
    {
        $data = Reservasi::with(['payment'])->where('user_id', '=', Auth::id())
            ->findOrFail($id);
        return view('member.pembayaran')->with(['data' => $data]);
    }

    public function create($id)
    {
        try {
            DB::beginTransaction();
            $reservasi = Reservasi::find($id);
            $data = [
                'reservasi_id' => $reservasi->id,
                'bank' => $this->postField('bank'),
                'no_rekening' => $this->postField('no_rekening'),
                'nama' => $this->postField('nama'),
                'total' => $reservasi->total,
                'status' => 'menunggu',
                'keterangan' => '',
            ];
            $nama_gambar = $this->generateImageName('bukti');

            if ($nama_gambar !== '') {
                $data['bukti'] = $nama_gambar;
                $this->uploadImage('bukti', $nama_gambar, 'bukti');
            }
            Payment::create($data);
            $reservasi->update([
                'status' => 'terbayar'
            ]);
            DB::commit();
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function cetak($id)
    {
        $data = Reservasi::with(['user.member', 'penitipan.kucing', 'grooming.kucing', 'paket'])->where('user_id', '=', Auth::id())
            ->findOrFail($id);
        $html = view('member.nota')->with(['data' => $data]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a5', 'landscape');
        return $pdf->stream();
    }
}
