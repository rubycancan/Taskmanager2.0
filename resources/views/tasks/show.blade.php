@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h3>{{ $task->name }}</h3>
        <steps route="{{ route('api.tasks.steps.index', $task->id) }}"
{{--               :initial-steps="{{ json_encode($steps) }}"--}}
               :todos="{{ json_encode($todos) }}"
               :dones="{{ json_encode($dones) }}"
        >
        </steps>
    </div>
@endsection

