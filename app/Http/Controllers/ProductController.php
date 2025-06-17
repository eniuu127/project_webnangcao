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

    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/product'), $imageName);
            $product->product_image = $imageName;
        }

        $product->save();

        return redirect('/admin/products')->with('success', 'Thêm sản phẩm thành công');
    }   

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/product'), $imageName);
            $product->product_image = $imageName;
        }

        $product->save();

        return redirect('/admin/products')->with('success', 'Cập nhật thành công');
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

