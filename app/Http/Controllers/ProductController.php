<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $products = Product::with('brand')->get();
        $products = Product::where('status', 'Accepted')->get();

        if (Auth::user()->role->name == 'User') {
            return view('product.card', ['products' => $products]);
        } else {
            return view('product.index', ['products' => $products]);
        }
    }

    public function show()
    {
        $products = Product::all();
        return view('product.show', compact('products'));
    }

    public function view($id)
    {
        $product = Product::where('id', $id)->with('category')->first();

        $related = Product::where('category_id', $product->category->id)->inRandomOrder()->limit(4)->get();

        if ($product) {
            return view('product.view', compact('product', 'related'));
        } else {
            abort(404);
        }
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();

        return view('product.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required|string|min:3',
            'price' => 'required|integer',
            'sale_price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $imageName = time() . '.' . $request->image->extension();

        Storage::putFileAs('public/product', $request->image, $imageName);
        $userRole = auth()->user()->role->name;
        $status = ($userRole === 'Admin') ? 'Accepted' : 'Pending';
        $product = Product::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'brands_id' => $request->brand,
            'image' => $imageName,
            'status' => $status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->with('category')->first();
        $brands = Brand::all();
        $categories = Category::all();

        return view('product.edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $old_image = Product::find($id)->image;
            Storage::delete('public/product/'.$old_image);
            $imageName = time() . '.' . $request->image->extension();
            Storage::putFileAs('public/product', $request->image, $imageName);

            Product::where('id', $id)->update([
                'category_id' => $request->category,
                'name' => $request->name,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'brands_id' => $request->brand,
                'image' => $imageName,
            ]);
        } else {
            Product::where('id', $id)->update([
                'category_id' => $request->category,
                'name' => $request->name,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'brands_id' => $request->brand,
            ]);
        }

        return redirect()->route('product.show');
    }

    public function accept($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Accepted';
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product accepted successfully.');
    }

    public function reject($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'Reject';
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product has been rejected.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('product.index');
    }
}
