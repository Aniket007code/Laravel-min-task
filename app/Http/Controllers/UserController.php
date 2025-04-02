<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 🔹 Get All Users
    public function index()
    {
        // dd("Wref");
        return response()->json(User::all());
    }

    // 🔹 Add User (Only Admin)
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Access Denied'], 403);
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 1, // Active by default
        ]);

        return response()->json(['message' => 'User added successfully']);
    }

    // 🔹 Edit User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|min:6',
            'role' => 'sometimes|in:admin,user',
            'status' => 'sometimes|boolean',
        ]);

        if ($request->has('password')) {
            $request['password'] = Hash::make($request->password);
        }

        $user->update($request->all());

        return response()->json(['message' => 'User updated successfully']);
    }

    // 🔹 Delete User (Change status to 0)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 0]);

        return response()->json(['message' => 'User deactivated successfully']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        // dd($user);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // ❌ Prevent login if status is 0
        if ($user->status === 0) {
            return response()->json(['message' => 'Your account is inactive. Contact admin.'], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function testFunction(Request $request){
        //  dd("testpage");
        return view('/DummyPages/TestPageNew');
    }

    public function UserDashboardPage(Request $request){

        $auth = Auth::user();
    
        $userDetails = User::where('id',$auth->id)->get();

        // dd($userDetails);
        return view( '/DummyPages/TestPageUser',compact('userDetails'));

    }

    public function AdminDashboardPage(Request $request){
        // $auth = Auth::user();
    
        $userDetails = User::all();

        // dd($userDetails);
        return view( '/DummyPages/TestPageAdmin',compact('userDetails'));
    }



}

