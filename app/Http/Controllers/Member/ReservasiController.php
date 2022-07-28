<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use Carbon\Carbon;
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
            if ($type === 'grooming') {
                $tanggal = Carbon::now();
                $no_reservasi = 'RS-GROOM-' . \date('YmdHis');

            }

            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('gagal ' . $e->getMessage(), 500);
        }
    }
}
