<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('products')->get();
        return view('product.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|unique:products|alpha_num',
            'name' => 'required',
            'price' => 'numeric|required',
            'qty' => 'numeric|required'
        ]);
    
        $data = $request->all();
        DB::table('products')->insert([
            'SKU'=>$data['sku'],
            'name'=>$data['name'],
            'price'=>$data['price'],
            'qty'=>$data['qty']
        ]);

        return redirect()->route('product')->with('status', 'Product Added Successfully');
    }
}
