<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Course;
use App\Repositories\CourseRepository;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CourseRepository $courses)
    {
        $this->middleware('auth');

        $this->courses = $courses;
    }

    /**
     * Display a list of all of the user's courses.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('courses.index', [
            'courses' => $this->courses->forUser($request->user()),
        ]);
    }

    /**
     * Create a new course.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cnumber' => 'required|max:10',
            'cname' => 'required|max:100',
        ]);

        $request->user()->courses()->create([
            'course_no' => $request->cnumber,
            'course_name' => $request->cname,
            'status' => $request->cstatus,
            'exam_mode' => $request->emode,
            'exam_date' => $request->edate,
            'exam_grade' => $request->egrade,
        ]);
        return redirect('/courses');
    }


    /**
     * Destroy the given course.
     *
     * @param  Request  $request
     * @param  Course  $course
     * @return Response
     */
    public function destroy(Request $request, Course $course)
    {
        $this->authorize('destroy', $course);
        $course->delete();
        return redirect('/courses');
    }
}
