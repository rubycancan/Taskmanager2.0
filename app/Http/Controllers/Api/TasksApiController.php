<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TasksRepository;
use App\Project;
use Illuminate\Http\Request;

class TasksApiController extends Controller
{
    protected $repo;

    public function __construct(TasksRepository $repo)
    {
        $this->repo = $repo;
    }
//    public function getProject()
//    {
//        $project = Project::all();
//        return response()->json($project);
//    }

    public function search()
    {
        return response()->json([
            'tasks'=> $this->repo->all()
        ],200);
    }
}
