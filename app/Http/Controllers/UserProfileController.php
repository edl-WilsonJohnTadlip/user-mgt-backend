<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();
        
        // Return users as JSON response
        return response()->json(['users' => $users], 201);
    }

    /**
     * Display the specified user's profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->update($request->all());

        return response()->json(['message' => 'User profile updated successfully']);
    }

    /**
     * Remove the specified user's profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message' => 'User profile deleted successfully']);
    }
}
