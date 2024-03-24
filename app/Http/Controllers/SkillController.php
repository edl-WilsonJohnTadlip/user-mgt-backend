<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index method to fetch all skills
    public function index()
    {
        return Skill::all();
    }

    // Other controller methods...

    // Store method to create a new skill
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:skills|max:255',
        ]);

        $skill = Skill::create($request->all());

        return response()->json($skill, 201);
    }

    // Update method to update an existing skill
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|unique:skills|max:255',
        ]);

        $skill->update($request->all());

        return response()->json($skill, 200);
    }

    // Destroy method to delete a skill
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json(null, 204);
    }

    // Index method to fetch all skills of a user
    public function userSkills()
    {
        $user = Auth::user();
        return $user->skills;
    }

    // Store method to add a skill to the authenticated user
    public function addUserSkill(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
        ]);

        $user = Auth::user();
        $user->skills()->attach($request->skill_id);

        return response()->json($user->skills, 201);
    }

    // Destroy method to remove a skill from the authenticated user
    public function removeUserSkill($skillId)
    {
        $user = Auth::user();
        $user->skills()->detach($skillId);

        return response()->json(null, 204);
    }
}
