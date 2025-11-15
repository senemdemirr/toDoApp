@extends('layouts.app')

@section('content')
    <h1 class="mb-4"> Tasks List</h1>
    <div class="card mb-4">
        <div class="card-header">
            Add New Task
        </div>
        <div class="card-body">
            <form action="{{route('tasks.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" 
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror"
                    >
                        {{old('description')}}
                    </textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                </div>
                <button type="submit" class="btn btn-success">Add Task</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Current Tasks
        </div>
        <div class="card-body p-0">
            @if($tasks->isEmpty())
                <p class="p-3 mb-0">No tasks have been added yet.</p>
            @else
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th style="width: 180px;">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->title}}</td>
                                <td>{{$task->description}}</td>
                                <td>
                                    @if($task->is_done)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-secondary">Waiting</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('tasks.edit', $task)}}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{route('tasks.destroy', $task)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection