<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'link' => 'nullable|url',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        if($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('images', $fileName, 'public');
            $data['image'] = $filePath;
        } 
        Product::create($data);
        return redirect(route('product.index'))->with('success', 'Iklan berjaya dimuatnaik!');
    }

    public function edit(Product $product){
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'link' => 'nullable|url',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('image')) {
            if($product->image) {
                \Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            }
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->StoreAs('images', $fileName, 'public');
            $date['image'] = '\storage' . $filePath;
        } else {
            $data['image'] = $product->image;
        }

        $product->update($data);
        return redirect(route('product.index'))->with('success', 'Iklan berjaya disunting!');
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            }
            $product->delete();

            return redirect()->route('product.index')->with('success', 'Iklan berjaya dibuang.');
        } catch (\Exception $e) {
            \Log::error('Error deleting product: ' . $e->getMessage());
            return redirect()->route('product.index')->with('error', 'Error deleting product.');
        }
    }

    public function view()
    {
        $products = Product::all();
        return view('products.products', ['products' => $products]);
    }
}

