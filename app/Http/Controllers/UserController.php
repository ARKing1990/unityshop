<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'image'=> 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'email' => 'required|email',
            'phone' => 'required|string|min:10',
            'role' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // ubah nama file
        $imageName = time() . '.' . $request->image->extension();

        // simpan file ke folder public/product
        Storage::putFileAs('public/user', $request->image, $imageName);
        $user = User::create([
            'name' => $request->name,
            'image' => $imageName,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:10',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        if ($request->hasFile('image')) {
            $old_image = User::find($id)->image;
            Storage::delete('public/user/'.$old_image);
            $imageName = time().'.'.$request->image->extension();
            Storage::putFileAs('public/user', $request->file('image'), $imageName);
            User::where('id', $id)->update([
                'name' => $request->name,
                'image' => $imageName,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

        }
        else {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
