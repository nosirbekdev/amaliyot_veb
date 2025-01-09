<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = [
            'to_do' => Task::where('status', 'to_do')->get(),
            'in_progress' => Task::where('status', 'in_progress')->get(),
            'closed' => Task::where('status', 'closed')->get(),
            'frozen' => Task::where('status', 'frozen')->get(),
        ];

        return view('tasks.index', compact('tasks'));
    }

    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'participant' => 'required|string|max:255',
            'priority' => 'required|in:High,Medium,Low',
            'status' => 'required|in:to_do,in_progress,closed,frozen',
            'date_added' => 'required|date',
            'deadline' => 'required|date|after_or_equal:date_added',
        ]);

        $validated['project_id'] = $project->id;

        Task::create($validated);

        return redirect()->route('projects.tasks', ['project_id' => $project->id]);
    }



    public function show($project_id)
    {
        // Get the project by ID
        $project = Project::find($project_id);

        if (!$project) {
            abort(404, 'Project not found');
        }

        // Get the tasks for the selected project grouped by status
        $tasks = [
            'to_do' => Task::where('project_id', $project_id)->where('status', 'to_do')->get(),
            'in_progress' => Task::where('project_id', $project_id)->where('status', 'in_progress')->get(),
            'closed' => Task::where('project_id', $project_id)->where('status', 'closed')->get(),
            'frozen' => Task::where('project_id', $project_id)->where('status', 'frozen')->get(),
        ];


        // Return the view with the project and categorized tasks
        return view('tasks.show', compact('project', 'tasks'));
    }

    public function edit(Task $task)
{
    return view('tasks.edit', compact('task'));
}

    public function update(Request $request, Task $task)
{
    $validated = $request->validate([
        'status' => 'required|in:to_do,in_progress,closed,frozen',
    ]);

    $task->update($validated);

    return redirect()->route('projects.tasks', ['project_id' => $task->project_id])
                     ->with('success', 'Task updated successfully.');
}

public function destroy(Task $task)
{
    $task->delete();

    return redirect()->route('projects.tasks', ['project_id' => $task->project_id])
                     ->with('success', 'Task deleted successfully.');
}

public function updateStatus(Request $request, Task $task)
{
    $task->status = $request->status;
    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Task status updated.');
}

}

