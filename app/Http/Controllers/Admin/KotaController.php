<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Category;
use App\Models\Kota;
use App\Models\Wilayah;

class KotaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Wilayah::all();
        return view('admin.data.kota.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.data.kota.add');
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
                'harga' => $this->postField('harga'),
            ];
            Wilayah::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Wilayah::findOrFail($id);
        return view('admin.data.kota.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $wilayah = Wilayah::find($id);
            $data = [
                'nama' => $this->postField('nama'),
                'harga' => $this->postField('harga'),
            ];

            $wilayah->update($data);
            return redirect('/wilayah')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Wilayah::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
