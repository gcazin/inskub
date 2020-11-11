<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorRequest;
use App\Http\Requests\SchoolRequest;
use App\Jobs\SendEmailProfessor;
use App\Models\Classroom;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfessorController extends Controller
{
    /**
     * @var Professor
     */
    private Professor $professor;

    /**
     * @var Classroom
     */
    private Classroom $classroom;

    public function __construct(Professor $professor, Classroom $classroom)
    {
        $this->professor = $professor;
        $this->classroom = $classroom;

        $this->middleware('auth');
    }

    public function index()
    {
        $professors = $this->professor->where('school_id', auth()->id())->paginate(8);
        $classrooms = $this->classroom->where('school_id', auth()->id())->get();

        return view('school.professor.index', compact('professors', 'classrooms'));
    }

    public function store(SchoolRequest $request)
    {
        $password = Str::random(8);

        $user = new User();
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->save();
        $user->assignRole('other');
        $user->givePermissionTo('classroom.*');

        $professor = new Professor();
        $professor->professor_id = $user->id;
        $professor->school_id = auth()->id();
        $professor->save();

        foreach($request->classrooms as $classroom) {
            $this->professor->find($professor->id)->classrooms()->attach($classroom);
        }

        /**
         * On envoie en asynchrone l'envoie des emails
         * Temps: ~30s (pour 5 élèves) réduit à ~1s
         */
        SendEmailProfessor::dispatch($user, auth()->user(), $password);

        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $professor = $this->professor->find($id);

        if($request->has('classrooms')) {
            $professor->classrooms()->sync($request->classrooms);
        } else {
            $classrooms = $professor->classrooms;
            $professor->classrooms()->detach($classrooms);
        }

        return back();
    }
}
