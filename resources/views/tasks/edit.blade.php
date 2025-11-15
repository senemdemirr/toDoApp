@extends('layouts.app')

@section('title', 'Task Edit')

@section('content')
    <h1 class="mb-4">Edit Task</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{route('tasks.update' , $task)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title', $task->title)}}">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">
                        {{old('description' , $task->description)}}
                    </textarea>
                    @error('description')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" id="is_done" name="is_done" class="form-check-input" {{$task->is_done ? 'checked' : ''}}>
                    <label for="is_done" class="form-check-label">Task is completed</label>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{route('tasks.index')}}" class="btn btn-secondary">Go Back</a>
            </form>
        </div>
    </div>
@endsection