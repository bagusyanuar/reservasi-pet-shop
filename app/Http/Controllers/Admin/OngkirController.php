<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kota;
use App\Models\Ongkir;

class OngkirController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Ongkir::with('kota')->get();
        return view('admin.data.ongkir.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $data = Kota::all();
        return view('admin.data.ongkir.add')->with(['data' => $data]);
    }

    public function create()
    {
        try {
            $data = [
                'kota_id' => $this->postField('kota'),
                'total' => $this->postField('total'),
            ];
            Ongkir::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Ongkir::findOrFail($id);
        $kota = Kota::all();
        return view('admin.data.ongkir.edit')->with(['data' => $data, 'kota' => $kota]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $category = Ongkir::find($id);
            $data = [
                'total' => $this->postField('total'),
                'kota_id' => $this->postField('kota'),
            ];

            $category->update($data);
            return redirect('/ongkir')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Ongkir::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
