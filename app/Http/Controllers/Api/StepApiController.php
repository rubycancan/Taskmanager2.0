<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\createStep;
use App\Step;
use App\Task;
use Illuminate\Http\Request;

class StepApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return json
     */
    public function index(Task $task)
    {
        return response()->json([
            'steps' => $task->steps()->get()
        ],200);
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
    public function store(Task $task,createStep $request)
    {
        //写法一
//        $step = $task->steps()->create([
//            'name'=> $request->name
//        ]);
//        $step->refresh();
        return response()->json([
           'step'=>$task->steps()->create($request->only('name'))
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Task $task, Step $step)
    {
        return response()->json([
            'step'=>$step->update($request->only('name'))
        ],201);
    }

    public function toggle(Request $request,Task $task, Step $step)
    {
        return response()->json([
            'step'=>$step->update($request->only('completion'))
        ],201);
    }

    public function completeAll(Task $task)
    {
        $task->steps()->update([
           'completion'=> 1
        ]);
        return response()->json([
            'msg'=>'已完成全部步骤'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Step $step)
    {
        $step->delete();

        return response()->json([
            'msg'=>'当前step删除成功'
        ],204);
    }

    public function clear(Task $task) {
        $task->steps()->where('completion', 1)->delete();
        return response()->json([
            'msg'=>'已完成步骤全部删除成功'
        ],204);
    }
}
