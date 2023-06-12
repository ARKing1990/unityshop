<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        // mengambil data category
        $categories = Category::all();

        // mengambil data slider yang sudah di approve
        $sliders = Slider::where('status', 'Accepted')->get();

        if ($request->category) {
            $products = Product::where('status', 'Accepted')->with('category')->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            })->get();
        } else if ($request->min && $request->max) {
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
            })->get();
        } else {
            // mengambil 8 data produk secara acak
            $products = Product::where('status', 'Accepted')->inRandomOrder()->limit(8)->get();
        }

        return view('landing', compact('products', 'categories', 'sliders'));
    }
}
