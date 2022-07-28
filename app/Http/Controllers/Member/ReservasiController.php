<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Paket;
use App\Models\Reservasi;
use App\Models\ReservasiGrooming;
use App\Models\ReservasiPenitipan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservasiController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function reservasi()
    {
        try {
            DB::beginTransaction();
            $type = $this->postField('type');
            $tanggal = Carbon::now();
            $no_reservasi = 'RS-GROOM-' . \date('YmdHis');
            $paket_id = $this->postField('paket');
            $paket = Paket::find($paket_id);
            $sub_total = $paket->harga;
            $transport = $this->postField('transport');
            $qty = 1;
            if($type === 'penitipan') {
                $check_in = $this->postField('check_in');
                $check_out = $this->postField('check_out');
                $date1 = date_create_from_format('Y-m-d', $check_in);
                $date2 = date_create_from_format('Y-m-d', $check_out);
                $diff = date_diff($date1, $date2);
                $qty = $diff->d;
                $no_reservasi = 'RS-TTP-' . \date('YmdHis');
            }
            $total = ($sub_total * $qty) + $transport;
            $reservasi = Reservasi::create([
                'user_id' => Auth::id(),
                'tanggal' => $tanggal,
                'no_transaksi' => $no_reservasi,
                'paket_id' => $this->postField('paket'),
                'tipe' => $type,
                'sub_total' => ($sub_total * $qty),
                'transport' => $transport,
                'total' => $total,
                'diskon' => 0,
                'status' => 'menunggu',
            ]);
            if ($type === 'grooming') {
                $data_grooming = [
                    'tanggal' => $this->postField('tanggal_reservasi'),
                    'jam' => $this->postField('jam'),
                    'reservasi_id' => $reservasi->id,
                    'kucing_id' => $this->postField('kucing'),
                    'transport' => $transport > 0 ? 1 : 0,
                    'alamat' => $this->postField('alamat'),
                    'catatan' => $this->postField('catatan')
                ];
                ReservasiGrooming::create($data_grooming);
            } else {
                $data_penitipan = [
                    'check_in' => $this->postField('check_in'),
                    'check_out' => $this->postField('check_out'),
                    'reservasi_id' => $reservasi->id,
                    'kucing_id' => $this->postField('kucing'),
                    'transport' => $transport > 0 ? 1 : 0,
                    'alamat' => $this->postField('alamat'),
                    'catatan' => $this->postField('catatan')
                ];
                ReservasiPenitipan::create($data_penitipan);
            }
            DB::commit();
            return $this->jsonResponse('success', 200, $reservasi->id);
        } catch (\Exception $e) {
            return $this->jsonResponse('gagal ' . $e->getMessage(), 500);
        }
    }
}
