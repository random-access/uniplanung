<?php

namespace App\Policies;

use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can delete the given course.
     *
     * @param  User  $user
     * @param  Course  $course
     * @return bool
     */
    public function destroy(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }
}
