<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\ReservasiGrooming;
use App\Models\ReservasiPenitipan;
use App\Models\Slot;

class SlotController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSlot()
    {
        try {
            $data = Slot::first();
            return $this->jsonResponse('succes', 200, $data);
        }catch (\Exception $e) {
            return $this->jsonResponse('gagal '.$e->getMessage(), 500);
        }
    }

    public function getUsedSlot($type)
    {
        try {
            $tanggal = $this->field('tanggal');
            if($type === 'grooming') {
                $grooming = ReservasiGrooming::with('reservasi')
                    ->whereHas('reservasi', function ($query){
                        return $query->where('status', '=', 'ongoing')->orWhere('status', '=', 'terdaftar');
                    })
                    ->where('tanggal', '=', $tanggal)
                    ->get();
                $count = count($grooming);
            } else {
                $penitipan = ReservasiPenitipan::with('reservasi')
                    ->whereHas('reservasi', function ($query){
                        return $query->where('status', '=', 'ongoing')->orWhere('status', '=', 'terdaftar');
                    })
                    ->whereRaw('? between check_in and check_out', [$tanggal])
                    ->get();
                $count = count($penitipan);
            }
            return $this->jsonResponse('succes', 200, $count);
        }catch (\Exception $e) {
            return $this->jsonResponse('gagal '.$e->getMessage(), 500);
        }
    }
}
