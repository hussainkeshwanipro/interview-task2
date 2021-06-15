<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\Vue;

class OrderController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        $order = DB::table('orders')->get();
        return view('order.index', compact('products', 'order'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'qty' => 'numeric|required'
        ]);
    
        $data = $request->all();
        $prd_qty = DB::table('products')->select('qty')->where('name', $data['name'])->get();
        if($prd_qty[0]->qty == 0)
        {
            return redirect()->route('order')->with('status', 'Product is out of stock');
        }
        else
        {
            DB::table('orders')->insert([
                'product_name'=>$data['name'],
                'qty'=>$data['qty']
            ]);
            DB::table('products')->where('name', $data['name'])->update([
                'qty'=>$prd_qty[0]->qty - $data['qty']
            ]);

            return redirect()->route('order')->with('status', 'Order placed successfully');
        }
    }

    public function delete($id)
    {
        $data = DB::table('orders')->where('id', $id)->get();
       
        $prd_qty = DB::table('products')->where('name', $data[0]->product_name)->get();
        $qty = $data[0]->qty + $prd_qty[0]->qty;
        DB::table('products')->where('name', $data[0]->product_name)->update([
            'qty'=>$qty
        ]);

        DB::table('orders')->where('id', $id)->delete();
        return redirect()->route('order')->with('status', 'order deleted successfully');
    }


    public function edit($id)
    {
        $products = DB::table('products')->get();

        $data = DB::table('orders')->where('id', $id)->get();
        return view('order.edit', compact('data', 'products'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        DB::table('orders')->where('id', $id)->update([
            'product_name'=>$data['name'],
                
        ]);

        return redirect()->route('order')->with('status', 'order updated successfully');
    }
}
