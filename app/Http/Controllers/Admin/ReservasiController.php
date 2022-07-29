<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kegiatan;
use App\Models\Payment;
use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;

class ReservasiController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Payment::with('reservasi.user', 'reservasi.paket')
            ->where('status', '=', 'menunggu')
            ->get();
        return view('admin.reservasi.baru.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Reservasi::with(['user.member', 'payment', 'grooming.kucing', 'penitipan.kucing'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {

            try {
                DB::beginTransaction();
                $status = $this->postField('status');
                $keterangan = $this->postField('keterangan');
                $data_payment = [
                    'status' => $status,
                    'keterangan' => $status === 'terima' ? '' : $keterangan
                ];
                $payment = Payment::where('reservasi_id', '=', $id)->firstOrFail();
                $payment->update($data_payment);
                $reservasi = Reservasi::find($id);
                $reservasi->update([
                    'status' => $status === 'terima' ? 'terdaftar' : 'tolak'
                ]);
                DB::commit();
                return redirect('/reservasi-baru');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
            }
        }
        return view('admin.reservasi.baru.detail')->with(['data' => $data]);
    }

    public function waiting_list()
    {
        $data_grooming = Reservasi::with('user.member', 'paket', 'penitipan', 'grooming')
            ->where('status', '=', 'terdaftar')
            ->where('tipe', '=', 'grooming')
            ->get();
        $data_penitipan = Reservasi::with('user.member', 'paket', 'penitipan', 'grooming')
            ->where('status', '=', 'terdaftar')
            ->where('tipe', '=', 'penitipan')
            ->get();
        return view('admin.reservasi.waiting-list.index')->with(['data_grooming' => $data_grooming, 'data_penitipan' => $data_penitipan]);
    }

    public function detail_waiting_list($id)
    {
        $data = Reservasi::with(['user.member', 'grooming.kucing', 'penitipan.kucing'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            try {
                $reservasi = Reservasi::find($id);
                $reservasi->update([
                    'status' => 'ongoing'
                ]);
                return redirect('/reservasi-waiting-list');
            } catch (\Exception $e) {
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
            }
        }
        return view('admin.reservasi.waiting-list.detail')->with(['data' => $data]);
    }

    public function ongoing()
    {
        $data_grooming = Reservasi::with('user.member', 'paket', 'penitipan', 'grooming')
            ->where('status', '=', 'ongoing')
            ->where('tipe', '=', 'grooming')
            ->get();
        $data_penitipan = Reservasi::with('user.member', 'paket', 'penitipan', 'grooming')
            ->where('status', '=', 'ongoing')
            ->where('tipe', '=', 'penitipan')
            ->get();
        return view('admin.reservasi.ongoing.index')->with(['data_grooming' => $data_grooming, 'data_penitipan' => $data_penitipan]);
    }

    public function detail_ongoing($id)
    {
        $data = Reservasi::with(['user.member', 'grooming.kucing', 'penitipan.kucing', 'kegiatan'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            try {
                $reservasi = Reservasi::find($id);
                $reservasi->update([
                    'status' => 'selesai'
                ]);
                return redirect('/reservasi-ongoing');
            } catch (\Exception $e) {
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
            }
        }
        return view('admin.reservasi.ongoing.detail')->with(['data' => $data]);
    }

    public function kegiatan_ongoing()
    {
        try {
            $data = [
                'waktu' => $this->postField('jam'),
                'reservasi_id' => $this->postField('id-reservasi'),
                'kegiatan' => $this->postField('kegiatan'),
            ];
            $nama_gambar = $this->generateImageName('foto');

            if ($nama_gambar !== '') {
                $data['foto'] = $nama_gambar;
                $this->uploadImage('foto', $nama_gambar, 'kegiatan');
            }
            Kegiatan::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function delete_kegiatan_ongoing()
    {
        try {
            $id = $this->postField('id');
            Kegiatan::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }

    public function selesai()
    {
        $data_grooming = Reservasi::with('user.member', 'paket', 'penitipan', 'grooming')
            ->where('status', '=', 'selesai')
            ->where('tipe', '=', 'grooming')
            ->get();
        $data_penitipan = Reservasi::with('user.member', 'paket', 'penitipan', 'grooming')
            ->where('status', '=', 'selesai')
            ->where('tipe', '=', 'penitipan')
            ->get();
        return view('admin.reservasi.selesai.index')->with(['data_grooming' => $data_grooming, 'data_penitipan' => $data_penitipan]);
    }

    public function detail_selesai($id)
    {
        $data = Reservasi::with(['user.member', 'grooming.kucing', 'penitipan.kucing', 'kegiatan'])
            ->findOrFail($id);
        return view('admin.reservasi.selesai.detail')->with(['data' => $data]);
    }

    public function cetak_detail_selesai($id)
    {
        $data = Reservasi::with(['user.member', 'grooming.kucing', 'penitipan.kucing', 'kegiatan'])
            ->findOrFail($id);
        return $this->convertToPdf('admin.reservasi.selesai.cetak', [
            'data' => $data
        ]);
    }
}
