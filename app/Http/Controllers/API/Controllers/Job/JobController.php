<?php

namespace App\Http\Controllers\API\Controllers\Job;

use App\Http\Controllers\API\Controllers\Controller;
use App\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Permet de retourner la liste de tous les emplois
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $jobs = DB::table('jobs')->orderByDesc('created_at')->simplePaginate(10);

        return $this->success($jobs, 200);
    }

    /**
     * Permet de voir un emploi spécifique
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $job = Job::find($id);

        return $this->success($job, 200);
    }

    /**
     * Permet de créer un emploi
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $job = new Job();
        $job->title = $request->get('title');
        $job->description = $request->get('description');
        $job->hours = $request->get('hours');
        $job->salary = $request->get('salary');
        $job->type_id = $request->get('type_id');
        $job->user_id = auth()->id();
        $job->created_at = now();
        $job->save();

        return $this->success('L\'emploi à bien été crée.', 201);
    }
}
