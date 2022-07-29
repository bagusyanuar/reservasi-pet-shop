<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Barang;
use App\Models\Category;
use App\Models\Paket;
use App\Models\Wilayah;

class HomepageController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $grooming = Paket::where('tipe', '=', 'grooming')->get();
        $penitipan = Paket::where('tipe', '=', 'penitipan')->get();
        return view('member.index')->with([
            'grooming' => $grooming,
            'penitipan' => $penitipan
        ]);
    }

    public function product_page($id)
    {
        $data = Paket::with('layanan')->findOrFail($id);
        $wilayah = Wilayah::all();
        return view('member.product')->with(['data' => $data, 'wilayah' => $wilayah]);
    }

    public function category_page($id)
    {
        $category = Category::all();
        $current_category = Category::find($id);
        $data = Barang::with('category')->where('category_id', '=', $id)->get();
        return view('member.category')->with([
            'categories' => $category,
            'data' => $data,
            'current_category' => $current_category
        ]);
    }

    public function get_product_by_name_and_category($id)
    {
        try {
            $name = $this->field('name');
            $data = Barang::with('category')
                ->where('category_id', '=', $id)
                ->where('nama', 'LIKE', '%' . $name . '%')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function about()
    {
        return view('member.tentang');
    }

    public function contact()
    {
        return view('member.hubungi');
    }

    public function pemesanan()
    {
        return view('member.pemesanan');
    }
}
