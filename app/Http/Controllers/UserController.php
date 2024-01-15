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

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
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

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id . '|email',
        ]);

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
                return '<button class="btn btn-sm btn-primary" onclick="editUser(' . $user->id . ')">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser(' . $user->id . ')">Delete</button>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d M Y');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function storeUsers(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required'
        ]);

        $user = new \App\Models\User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \bcrypt('123456');
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully'
        ]);
    }

    public function editUsers($id)
    {
        $user = \App\Models\User::find($id);

        return response()->json([
            'status' => 'success',
            'user' => $user
        ]);
    }

    public function updateUsers(Request $request)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_email' => 'required|unique:users,email,' . $request->edit_id . '|email',
        ]);

        $user = \App\Models\User::find($request->edit_id);
        $user->name = $request->edit_name;
        $user->email = $request->edit_email;
        if ($request->edit_password) {
            $user->password = \bcrypt($request->edit_password);
        }
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully'
        ]);
    }
}
