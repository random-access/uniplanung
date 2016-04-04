<?php
namespace App\Repositories;
use App\User;
use App\Course;
class CourseRepository
{
    /**
     * Get all of the courses for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Course::where('user_id', $user->id)
		    ->orderBy('status', 'asc')
                    ->orderBy('exam_date', 'asc')
                    ->get();
    }
}
