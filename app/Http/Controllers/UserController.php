<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error', 'Email or password is incorrect');
    }

    public function profile()
    {
        $id = auth()->user()->id;
        $profile = \App\Models\User::find($id);

        return view('pages.profile', compact('profile'));
    }

    public function getProfile()
    {
        $id = auth()->user()->id;
        $profile = \App\Models\User::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $profile
        ]);
    }

    public function saveProfile(Request $request)
    {
        $id = auth()->user()->id;
        $profile = \App\Models\User::find($id);

        $profile->name = $request->name;
        $profile->email = $request->email;
        if ($request->password) {
            $profile->password = bcrypt($request->password);
        }
        $profile->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully'
        ]);
    }

    public function index()
    {
        return view('pages.users');
    }

    public function getUsers()
    {
        $users = \App\Models\User::all();

        return \Yajra\DataTables\DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '<a href="#" class="btn btn-sm btn-primary edit" data-id="' . $user->id . '">Edit</a> <a href="#" class="btn btn-sm btn-danger delete" data-id="' . $user->id . '">Delete</a>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d M Y');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
