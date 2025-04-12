<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;


class UserController extends Controller 
{

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
    
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('username', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('role', 'like', "%$search%");
            });
        }
    
        $users = $query->orderBy('created_at', 'desc')->paginate(3);
    
        if ($request->ajax()) {
            return view('users.table', compact('users'))->render();
        }
    
        return view('users.index', compact('users'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
    
        // Handle photo upload if exists
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
    
            // Generate unique filename
            $filename = Str::uuid() . '.' . $photo->getClientOriginalExtension();
    
            // Store in public disk (you can change 'public' to any other disk)
            $path = $photo->storeAs('users/photos', $filename, 'public');
    
            // Save the photo path in the validated array
            $validated['photo'] = $path;
        }
    
        // Create the user
        $user = User::create($validated);
    
        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view("users.edit", ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, user $user)
    {
        $validated = $request->validated();
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User added successfully!');    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {

        //
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        

    }
}
