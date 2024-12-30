<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Account;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(){
        //$products = Product::all();
        $accountId = Auth::user()->id;
        $products = Product::where('account_id', $accountId)->get();
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
            'category' => 'required|string',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        if($request->hasFile('image')) {
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('images', $fileName, 'public');
            $data['image'] = $filePath;
        } 

        $data['account_id'] = Auth::id();

        if (Product::create($data)) {
            ActivityLog::create([
                'account_id' => Auth::id(),
                'activityType' => 'Tambah',
                'activityDetails' => 'tambah produk baru: ' . $data['name'],
            ]);
    
            return redirect(route('product.index'))->with('success', 'Iklan berjaya dimuatnaik!');
        }
    
        return redirect(route('product.index'))->with('error', 'Iklan tidak berjaya dimuatnaik.');
    }

    public function edit(Product $product){

        if ($product->account_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
    {
        if ($product->account_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'link' => 'nullable|url',
            'price' => 'required|numeric',
            'category' => 'required|string',
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

        if ($product->update($data)) {
            ActivityLog::create([
                'account_id' => Auth::id(),
                'activityType' => 'Kemaskini',
                'activityDetails' => 'kemaskini maklumat produk: ' . $data['name'],
            ]);
    
            return redirect(route('product.index'))->with('success', 'Iklan berjaya disunting!');
        }
    
        return redirect(route('product.index'))->with('error', 'Iklan tidak berjaya disunting.');
    }

    public function destroy(Product $product)
    {
        if ($product->account_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        try {
            if ($product->image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            }

            $productName = $product->name;

            if ($product->delete()) {
                ActivityLog::create([
                    'account_id' => Auth::id(),
                    'activityType' => 'Hapus',
                    'activityDetails' => 'hapuskan produk: ' . $productName,
                ]);

                return redirect()->route('product.index')->with('success', 'Iklan berjaya dibuang.');
            }
        } catch (\Exception $e) {
            \Log::error('Error deleting product: ' . $e->getMessage());
        }

        return redirect()->route('product.index')->with('error', 'Iklan tidak berjaya dibuang.');
    }

    public function view(Request $request)
    {
       $query = Product::query();

       if ($request->has('seller_id')){
        $query->where('account_id', $request->seller_id);
       }

       if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
       }

       if ($request->has('sort') && $request->sort == 'price_asc') {
        $query->orderBy('price', 'asc');
        } elseif ($request->has('sort') && $request->sort == 'price_desc') {
        $query->orderBy('price', 'desc');
        }

       $products = $query->with('account')->get();

       return view('products.products', [
        'products' => $products,
       ]);
    }
}

