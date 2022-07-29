<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfilController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = User::with('member')
            ->where('id', '=', Auth::id())
            ->firstOrFail();
        if($this->request->method() === 'POST') {
            try {
                DB::beginTransaction();
                $id = $this->postField('id');
                $user = User::find($id);
                $data_user = [
                    'username' => $this->postField('username'),
                ];

                if ($this->postField('password') !== '') {
                    $data_user['password'] = Hash::make($this->postField('password'));
                }
                $user->update($data_user);
                $member = Member::with('user')->where('user_id', '=', $user->id)->firstOrFail();
                $member_data = [
                    'nama' => $this->postField('nama'),
                    'no_hp' => $this->postField('no_hp'),
                    'alamat' => $this->postField('alamat')
                ];
                $member->update($member_data);
                DB::commit();
                return redirect('/profil')->with(['success' => 'Berhasil Merubah Data...']);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
            }
        }
        return view('member.profil')->with(['data' => $data]);
    }
}
