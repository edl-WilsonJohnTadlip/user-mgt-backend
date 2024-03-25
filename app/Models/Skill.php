<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * The users that belong to the skill.
     */
    public function users()
    {
        return $this
        ->belongsToMany(User::class, 'skill_user', 'skill_id', 'user_id')
        ->withTimestamps();
    }
}
