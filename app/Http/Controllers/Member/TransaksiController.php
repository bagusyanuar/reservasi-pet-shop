<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Transaction::with(['user', 'cart'])->where('user_id', '=', Auth::id())
            ->get();
        return view('member.transaksi')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Transaction::with(['user', 'cart.product', 'waiting_payment'])->where('user_id', '=', Auth::id())
            ->findOrFail($id);
        return view('member.transaksi-detail')->with(['data' => $data]);
    }
}
