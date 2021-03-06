@extends('layout')


@section('content')
    <h1 class="title">{{ $project->title }}</h1>

    <div class="content"> {{ $project->description }}</div>

    @if ($project->tasks->count())
        <div class="box">
            @foreach ($project->tasks as $task)

            <form action="/tasks/{{ $task->id }}" method="POST">
                @method('PATCH')
                @csrf
                <label for="completed" class="checkbox {{ $task->completed ? 'is-complete' : '' }}" >
                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                    {{ $task->description }}
                </label>
            </form>

            @endforeach
        </div>
    @endif

    {{-- This section is for creating tasks --}}
    <form class="box" method="POST" action="/project/{{ $project->id }}/tasks">
        @csrf
        <div class="field">
            <label for="" class="label"> New Task</label>

            <div class="control">
                <input type="text" name="description" class="input" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Add Task</button>
            </div>
        </div>

        @include('errors')

    </form>

    <p>
        <a href="/projects/{{ $project->id }}/edit"> Edit</a>
    </p>
@endsection