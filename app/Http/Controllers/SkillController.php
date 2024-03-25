<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Apply authentication middleware
    }

    // Retrieve all skills
    public function index()
    {
        $skills = Skill::all();
        return response()->json($skills);
    }

    // Create a new skill
    public function store(Request $request)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255|unique:skills,name',
    ]);

    // Create the skill
    $skill = Skill::create($validatedData);

    $user = Auth::user();

    // Associate the skill with the authenticated user
    $user->roles();

    return response()->json($skill, 201);
}

    // Delete a skill
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        
        return response()->json(['message' => 'Skill deleted successfully']);
    }
}
