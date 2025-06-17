<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.all_product', compact('products'));
    }

    public function create() {
        return view('admin.add_product');
    }

    public function store(Request $request) {
        $filename = null;
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/product'), $filename);
        }

        Product::create([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_image' => $filename,
        ]);

        return redirect('/admin/products');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/product'), $filename);
            $product->product_image = $filename;
        }

        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->save();

        return redirect('/admin/products');
    }

    public function destroy($id) {
        Product::destroy($id);
        return redirect('/admin/products');
    }

    public function showProducts()
    {
         $products = Product::all();
        return view('pages.Product', compact('products'));
    }
}

