<?php

namespace App\Repositories;

use Image;
use App\Project;
use App\Task;

class TasksRepository {
    public function create($request)
    {
        return Task::create([
            'name'=>$request->name,
            'completion'=>(int) false,
            'project_id'=>$request->project
        ]);
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function check($id)
    {
        $task = $this->find($id);
        $task->update(['completion'=> (int) true]);
    }

    public function update($request, $id)
    {
        $task = $this->find($id);
        $task->update([
            'name'=>$request->name,
            'project_id'=>$request->project_id
        ]);
    }

    public function delete($id)
    {
        $task = $this->find($id);
        $task->delete();
    }

    public function all()
    {
        return auth()->user()->tasks()->get();
    }

    public function todos() {
        return auth()->user()->tasks()->where('completion',0)->paginate(5);
    }

    public function dones() {
        return auth()->user()->tasks()->where('completion',1)->paginate(5);
    }

    public function todoCount() {
        return auth()->user()->tasks()->where('completion',0)->count();
    }

    public function doneCount() {
        return auth()->user()->tasks()->where('completion',1)->count();
    }

    public function totalCount() {
        return auth()->user()->tasks()->count();
    }

    public function filterNames() {
        return Project::all()->map(function($project) {
            return $project->name;
        });
    }
}