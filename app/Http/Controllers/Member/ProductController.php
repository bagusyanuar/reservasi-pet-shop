<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Barang;

class ProductController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_product_by_name()
    {
        try {
            $name = $this->field('name');
            $data = Barang::with('category')
                ->where('nama', 'LIKE', '%' . $name . '%')
                ->get();
            return $this->jsonResponse('success', 200, $data);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function detail($id)
    {
        $data = Barang::with('category')->findOrFail($id);
        $category_id = $data->category_id;
        $id = $data->id;
        $recommend = Barang::with('category')
            ->where('id', '!=', $id)
            ->where('category_id', '=', $category_id)
            ->take(4)
            ->get();
        return view('member.product')->with(['data' => $data, 'recommend' => $recommend]);
    }
}
