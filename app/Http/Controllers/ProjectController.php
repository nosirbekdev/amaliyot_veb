<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Barcha loyihalarni ko'rsatish
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function indexUser()
    {
        $projects = Project::all();
        return view('dashboard', compact('projects'));
    }


    // Yangi loyiha qo'shish
    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'Sizda bu amalni bajarish huquqi yo\'q.');
        }
        return view('projects.create');
    }


    public function show($id)
        {
            $project = Project::findOrFail($id);
            return view('projects.show', compact('project'));
        }


    // Loyiha ma'lumotlarini saqlash
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
            'payment' => 'nullable|numeric|min:0',
            'payment_month' => 'nullable|numeric|min:0',
            'organization' => 'required|string|max:255',
        ]);

        // Faylni saqlash
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('projects', 'public'); // Fayl 'storage/app/public/projects' ga saqlanadi
        }

        // Yangi loyiha yaratish
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->file_path = $filePath; // Fayl yo'li saqlash
        $project ->payment = $request->payment;
        $project ->payment_month = $request->payment_month;
        $project ->organization = $request->organization;
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Loyiha muvaffaqiyatli qo\'shildi!');
    }

     // Loyihani tahrirlash formasi
     public function edit($id)
     {
         // Loyihani topish
         $project = Project::findOrFail($id);

         // Tahrirlash formasini ko'rsatish
         return view('projects.edit', compact('project'));
     }

     // Loyihani yangilash
     public function update(Request $request, $id)
     {
         // Loyihani topish
         $project = Project::findOrFail($id);

         // Formadagi malumotlarni validatsiya qilish
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'start_date' => 'required|date',
             'end_date' => 'required|date|after:start_date',
                'file' => 'nullable|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
                'payment' => 'nullable|numeric|min:0',
                'payment_month' => 'nullable|numeric|min:0',
                'organization' => 'required|string|max:255',
         ]);

         // Loyihani yangilash
         $project->update([
             'name' => $request->input('name'),
             'description' => $request->input('description'),
             'start_date' => $request->input('start_date'),
             'end_date' => $request->input('end_date'),
                'payment' => $request->input('payment'),
                'file' => $request->input('file'),
                'payment_month' => $request->input('payment_month'),
                'organization' => $request->input('organization'),
         ]);

         // Yangilangan loyihani ko'rsatish
         return redirect()->route('projects.show', $project->id)
                          ->with('success', 'Loyiha muvaffaqiyatli yangilandi!');
     }

        // Loyihani o'chirish
        public function destroy($id)
        {
            // Loyihani topish
            $project = Project::findOrFail($id);

            // Loyihani o'chirish
            $project->delete();

            // O'chirilgan loyihalarni ko'rsatish
            return redirect()->route('projects.index')
                             ->with('success', 'Loyiha muvaffaqiyatli o\'chirildi!');
        }

        public function export()
        {
            return Excel::download(new ProjectsExport, 'projects.xlsx');
        }
}
