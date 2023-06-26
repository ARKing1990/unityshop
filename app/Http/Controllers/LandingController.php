<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $sliders = Slider::where('status', 'Accepted')->get();

        $keyword = $request->input('search');

        if ($keyword) {
            $products = Product::where('status', 'Accepted')
                    ->where(function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhereHas('category', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('brand', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
            })
            ->with('category', 'brand')
            ->get();
        } elseif ($request->category) {
            $products = Product::where('status', 'Accepted')
                ->with('category')
                ->whereHas('category', function ($query) use ($request) {
                    $query->where('name', $request->category);
                })
                ->get();
        } elseif ($request->brand) {
            $products = Product::where('status', 'Accepted')
                ->with('brand')
                ->whereHas('brand', function ($query) use ($request) {
                    $query->where('name', $request->brand);
                })
                ->get();
        }elseif ($request->min && $request->max) {
            $products = Product::where('status', 'Accepted')
                ->where(function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('price', '>=', $request->min)
                            ->where('price', '<=', $request->max);
                    })
                    ->orWhere(function ($q) use ($request) {
                        $q->where('sale_price', '>=', $request->min)
                            ->where('sale_price', '<=', $request->max);
                    });
                })
                ->get();
        } else {
            // mengambil 8 data produk secara acak
            $products = Product::where('status', 'Accepted')
                ->latest()
                ->limit(8)
                ->get();
        }

        return view('landing', compact('products', 'categories','brands', 'sliders'));
    }
}
