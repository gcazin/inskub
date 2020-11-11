<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Professor;
use App\Models\User;

class ClassroomController extends Controller
{
    private Classroom $classroom;
    private Professor $professor;
    private User $user;

    public function __construct(Classroom $classroom, Professor $professor, User $user)
    {
        $this->classroom = $classroom;
        $this->professor = $professor;
        $this->user = $user;

        $this->middleware('auth');
    }

    public function index()
    {
        $classrooms = $this->classroom->where('school_id', auth()->id())->paginate(8);
        $professors = $this->professor::all()->where('school_id', auth()->id())->map(function($professor) {
            return $this->user->find($professor->professor_id);
        });

        return view('school.classroom.index', compact('classrooms', 'professors'));
    }

    public function store(ClassroomRequest $request)
    {
        $classroom = new Classroom();
        $classroom->name = $request->name;
        $classroom->description = $request->description ?? null;
        $classroom->school_id = auth()->id();
        $classroom->save();

        /*foreach($request->professors as $professor) {
            $this->professor->firstWhere('professor_id', $professor)->classrooms()->attach($classroom);
        }*/

        return back();
    }

    public function update(int $id, ClassroomRequest $request)
    {
        $classroom = $this->classroom->find($id);
        $classroom->update($request->validated());

        return back();
    }
}
