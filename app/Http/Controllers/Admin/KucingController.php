<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kucing;
use App\Models\User;

class KucingController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Kucing::with('user.member')->get();
        return view('admin.data.kucing.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $data = User::with('member')->where('role', '=', 'member')->get();
        return view('admin.data.kucing.add')->with(['data' => $data]);
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
                'user_id' => $this->postField('pemilik'),
                'ras' => $this->postField('ras'),
                'jenis_kelamin' => $this->postField('jenis_kelamin'),
                'pola' => $this->postField('pola'),
                'usia' => $this->postField('usia'),
            ];
            $nama_gambar = $this->generateImageName('foto');

            if ($nama_gambar !== '') {
                $data['foto'] = $nama_gambar;
                $this->uploadImage('foto', $nama_gambar, 'kucing');
            }
            Kucing::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $pemilik = User::with('member')->where('role', '=', 'member')->get();
        $data = Kucing::with('user.member')->findOrFail($id);
        return view('admin.data.kucing.edit')->with(['data' => $data, 'pemilik' => $pemilik]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $kucing = Kucing::find($id);
            $data = [
                'nama' => $this->postField('nama'),
                'user_id' => $this->postField('pemilik'),
                'ras' => $this->postField('ras'),
                'jenis_kelamin' => $this->postField('jenis_kelamin'),
                'pola' => $this->postField('pola'),
                'usia' => $this->postField('usia'),
            ];
            $nama_gambar = $this->generateImageName('foto');

            if ($nama_gambar !== '') {
                $data['foto'] = $nama_gambar;
                $this->uploadImage('foto', $nama_gambar, 'kucing');
            }
            $kucing->update($data);
            return redirect('/kucing')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Kucing::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
