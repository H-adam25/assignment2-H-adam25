<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $tasks = match ($request->get('filter')) {
            'urgent' => $user->tasks()->wherePriority('high')->get(),
            'latest' => $user->tasks()->orderBy('created_at', 'desc')->get(),
            default => $user->tasks
        };

        $tasks = $tasks->filter(function ($task) {
            return $task->created_by === auth()->id();
        });

        return view('tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-task');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'due_date' => 'required|date:Y-m-d\TH:i',
            'priority' => 'required|in:low,medium,high'
        ]);

        $task = Task::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'priority' => $validated['priority'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('tasks.show', ['task' => $task]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('show-task', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('edit-task', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'filled|string',
            'description' => 'filled|string',
            'due_date' => 'filled|date:Y-m-d\TH:i',
            'priority' => 'filled|in:low,medium,high',
        ]);

        if ($request->filled('completed')) {
            $validated['completed_at'] = now();
        }

        $task->update($validated);

        return redirect()->route('tasks.show', ['task' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
