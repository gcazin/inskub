<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Professor;
use App\Models\Student;

class SchoolController extends Controller
{
    /**
     * @var Professor
     */
    private Professor $professor;

    /**
     * @var Classroom
     */
    private Classroom $classroom;

    /**
     * @var Student
     */
    private Student $student;

    public function __construct(Professor $professor, Classroom $classroom, Student $student)
    {
        $this->professor = $professor;
        $this->classroom = $classroom;
        $this->student = $student;

        $this->middleware('auth');
    }

    public function index()
    {
        $professors = $this->professor->where('school_id', auth()->id())->get();
        $classrooms = $this->classroom->where('school_id', auth()->id())->get();
        $students = $this->student->where('school_id', auth()->id())->get();

        return view('school.index', compact('professors', 'classrooms', 'students'));
    }
}
