<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Kucing;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KucingController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Kucing::with('user.member')->where('user_id', '=', Auth::id())->get();
        return view('member.kucing-ku')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('member.tambah-kucing-ku');
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
                'user_id' => Auth::id(),
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
        $data = Kucing::with('user.member')->findOrFail($id);
        return view('member.edit-kucing-ku')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $kucing = Kucing::find($id);
            $data = [
                'nama' => $this->postField('nama'),
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
            return redirect('/kucing-ku')->with(['success' => 'Berhasil Merubah Data...']);
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
