<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use App\Mail\StudentCreated;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * @var User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->middleware('auth');
    }

    public function index()
    {
        $studentsClassroom = auth()->user()->students->sortBy('created_at')->groupBy('classroom_id')->all();
        $classrooms = auth()->user()->classrooms;

        return view('school.student.index', compact('studentsClassroom', 'classrooms'));
    }

    public function store(SchoolRequest $request)
    {
        $password = Str::random(8);

        $user = $this->user->create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($password)
        ]);
        $user->assignRole('student');
        $user->save();

        $student = new Student();
        $student->student_id = $user->id;
        $student->classroom_id = $request->classroom_id;
        $student->school_id = auth()->id();
        $student->save();

        Mail::to($user->email)->send(new StudentCreated($user, $student->classroom_id, $password));

        return back();
    }
}
