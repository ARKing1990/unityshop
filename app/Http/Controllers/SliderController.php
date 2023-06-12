<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'Accepted')->get();
        return view('slider.index', compact('sliders'));
    }
    public function show()
    {
        $sliders = Slider::all();
        return view('slider.show', compact('sliders'));
    }

    public function create()
    {
        return view('slider.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'caption' => 'required|string|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $imageName = time().'.'.$request->image->extension();
        Storage::putFileAs('public/slider', $request->file('image'), $imageName);

        $userRole = auth()->user()->role->name;
        $status = ($userRole === 'Admin') ? 'Accepted' : 'Pending';
        $slider = Slider::create([
            'title' => $request->title,
            'caption' => $request->caption,
            'image' => $imageName,
            'status' =>$status,
            'created_by'=>Auth::id(),
        ]);
        return redirect()->route('slider.index');
    }

    public function edit(Request $request, $id)
    {
        $slider = Slider::find($id);
        return view('slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'caption' => 'required|string|min:10',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        if ($request->hasFile('image')) {
            $old_image = Slider::find($id)->image;
            Storage::delete('public/slider/'.$old_image);
            $imageName = time().'.'.$request->image->extension();
            Storage::putFileAs('public/slider', $request->file('image'), $imageName);
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
                'image' => $imageName,
            ]);

        } else {
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
            ]);
        }
        return redirect()->route('slider.show');
    }
    public function accept($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = 'Accepted';
        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider accepted successfully.');
    }
    public function reject($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = 'Reject';
        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider has been reject.');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        Storage::delete('public/slider/'.$slider->image);
        $slider->delete();
        return redirect()->route('slider.index');
    }
}
