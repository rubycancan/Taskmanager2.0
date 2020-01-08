<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Requests\UpdateTask;
use App\Project;
use App\Repositories\TasksRepository;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    protected $repo;
    public function __construct(TasksRepository $repo){
        $this->repo = $repo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->repo->todos();
        $dones = $this->repo->dones();
        $projects = request()->user()->projects()->pluck('name','id');
        return view('tasks.index',compact('todos','dones','projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTask $request)
    {
        $this->repo->create($request);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $steps = $task->steps()->get();
        $todos = $steps->where('completion',0)->values();
        $dones = $steps->where('completion',1)->values();
        return view('tasks.show', compact('task','todos','dones'));
    }

    public function check($id) {
        $this->repo->check($id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTask $request, $id)
    {
        $this->repo->update($request, $id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return back();
    }

    public function charts()
    {
        $total = $this->repo->totalCount();
        $todoCount = $this->repo->todoCount();
        $doneCount = $this->repo->doneCount();
        $names = $this->repo->filterNames();
        $projects = Project::with('tasks')->get();
//
        return view('tasks.charts', compact('total','todoCount','doneCount','names', 'projects'));
    }
}
