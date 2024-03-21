<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminProfileController extends Controller
{
    /**
     * Display the admin profile of the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        // Get the authenticated user
        $user = $request->user();

        // Check if the user has the 'admin' role
        if (!$user->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Return the admin profile (user data) as JSON response
        return response()->json($user);
    }

    /**
     * Update the admin profile of the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if the user has the 'admin' role
        if (!$user->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validate incoming request data
        $validatedData = $request->validate([
            // Define validation rules for admin profile update
            
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:5'],
            'address' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'integer'],
            'gender' => ['required', 'string', 'max:10'],
            'age' => ['required', 'integer'],
            'role' => ['required', 'string'],
            
        ]);

        // Update the admin profile (user) with validated data
        $user->update($validatedData);

        // Return the updated admin profile (user data) as JSON response
        return response()->json($user);
    }

    /**
     * Delete the admin profile of the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if the user has the 'admin' role
        if (!$user->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Delete the admin profile (user)
        $user->delete();

        // Return success message as JSON response
        return response()->json(['message' => 'Admin profile deleted']);
    }
}
