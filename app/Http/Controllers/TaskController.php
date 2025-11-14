<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request -> validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_done' => false

        ]);

        return redirect()-> route('tasks.index')->with('success', 'Task added succesfully');
    }


    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request -> validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_done' => 'nullable|boolean'
        ]);

        $task -> update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_done' => $request -> has('is_done')
        ]);

        return redirect()->route('tasks.index')->with('success','Successfully uptadeted the task');

    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Succesfully deleted the task');
    }
}
