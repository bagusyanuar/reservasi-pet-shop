<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class PaymentController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Payment::with(['transaction.user.member', 'transaction.cart'])
            ->where('status', '=', 'menunggu')
            ->get();
        return view('admin.transaksi.pesanan.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Payment::with(['transaction.user.member', 'transaction.cart.product'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            try {
                $status = $this->postField('status');
                $keterangan = $this->postField('keterangan');
                $data_payment = [
                    'status' => $status,
                    'keterangan' => $status === 'terima' ? '' : $keterangan
                ];
                $data->update($data_payment);
                $transaction = Transaction::with('cart.product')->find($data->transaction_id);
                $transaction->update([
                    'status' => $status === 'terima' ? 'packing' : 'tolak'
                ]);
                if($status === 'terima') {
                    $cart = $transaction->cart;
                    foreach ($cart as $c) {
                        $current_qty = $c->product->qty;
                        $qty = $c->qty;
                        $sisa = $current_qty - $qty;
                        if ($sisa < 0) {
                            return redirect()->back()->with(['failed' => 'Sisa Stock Barang Kurang']);
                        }
                        $c->product()->update([
                            'qty' => $sisa
                        ]);
                    }
                }
                DB::commit();
                return redirect('/pesanan');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
            }

        }
        return view('admin.transaksi.pesanan.detail')->with(['data' => $data]);
    }


}
