<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Cart;
use App\Models\Kota;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Cart::with(['user', 'product'])->where('user_id', '=', Auth::id())
            ->whereNull('transaction_id')
            ->get();
        $kota = Kota::with('ongkir')
            ->get();
        return view('member.cart')->with(['data' => $data, 'kota' => $kota]);
    }


    public function add_to_cart()
    {
        try {
            if (!Auth::check()) {
                return $this->jsonResponse('Unauthenticated', 202);
            }
            $barang = Barang::find($this->postField('barang'));
            $qty = $this->postField('qty');
            $harga = $barang->harga;
            $total = $qty * $harga;

            $data = [
                'user_id' => Auth::id(),
                'transaksi_id' => null,
                'product_id' => $barang->id,
                'qty' => $qty,
                'harga' => $harga,
                'total' => $total
            ];

            Cart::create($data);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function count_cart()
    {
        try {
            $data = Cart::with('user')->where('user_id', '=', Auth::id())
                ->whereNull('transaction_id')->get();
            return $this->jsonResponse('success', 200, count($data));
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function delete_cart()
    {
        try {
            $id = $this->postField('id');
            Cart::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function checkout()
    {
        try {
            DB::beginTransaction();
            $keterangan = $this->postField('keterangan');
            $ongkir = (int)$this->postField('ongkir');
            $no_transaksi = 'TR-' . \date('YmdHis');

            $cart = Cart::with(['user', 'product'])->where('user_id', '=', Auth::id())
                ->whereNull('transaction_id')
                ->get();

            $cart_total = $cart->sum('total');
            $total = $cart_total + (int)$ongkir;
            $data = [
                'user_id' => Auth::id(),
                'tanggal' => Carbon::now(),
                'no_transaksi' => $no_transaksi,
                'sub_total' => $cart_total,
                'ongkir' => (int)$ongkir,
                'total' => $total,
                'status' => 'menunggu',
                'keterangan' => $ongkir > 0 ? '(' . $this->postField('kota') . ') ' . $keterangan : ''
            ];

            $transaction = Transaction::create($data);
            foreach ($cart as $v) {
                $v->transaction_id = $transaction->id;
                $v->update();
            }
            DB::commit();
            return $this->jsonResponse('success', 200, $transaction->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }
}
