<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Models\User;

class TeacherRole implements Rule
{
    public function passes($attribute, $value)
    {
        // Retrieve the teacher role
        $teacherRole = Role::where('name', 'teacher')->first();

        // Check if the user with the specified ID has the teacher role
        return User::find($value)->hasRole($teacherRole);
    }

    public function message()
    {
        return 'The selected teacher must have a teacher role.';
    }
}
