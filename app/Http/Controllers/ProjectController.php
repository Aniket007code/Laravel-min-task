<?php

namespace App\Http\Controllers;

use App\Models\Project;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator; // ✅ Correct Facade
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = Project::all();
        return view('projectPages.projectListing',compact('projects'));
    }

    // Show the create form
    public function create()
    {
        return view('projectPages.createProject');
    }

    // Store a new project
    public function store(Request $request)
    {
        $request->validate([
            'project_title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        // dd($imagePath);

        Project::create([
            'project_title' => $request->project_title,
            'description' => $request->description,
            'image' => $imagePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'timeline' => \Carbon\Carbon::parse($request->start_date)->diffInDays($request->end_date),
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }

    // Show the edit form
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projectPages.editProject', compact('project'));
    }

    // Update a project
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        // dump($request->all());

       

        // Custom validation rules
        // dd($request->file('image')->getMimeType());
    $validator = Validator::make($request->all(), [
        'project_title' => 'required|string|max:255',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    if ($validator->fails()) {
        dump($validator->errors()->all()); // Ye errors dekhne ke liye hai
    }

    if ($request->hasFile('image')) {
        // dd($request->file('image')->getMimeType()); 
    } else {
        // dd('No file uploaded!');
    }

    // Agar validation fail ho jaye toh redirect back with errors
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput(); // Old input values wapas form me rakhne ke liye
    }
         
        if ($request->hasFile('image') && $request->image != null) {
            // Step 1: Purani image ka path database se le lo
            $oldImage = $project->image;
        
            // Step 2: Agar image exist karti hai, toh use delete karo
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        
            // Step 3: Nayi image upload karo
            $newImagePath = $request->file('image')->store('projects', 'public');
            $project->update([
                'image' => $newImagePath ?? null,

            ]);
        
            
        }

        $project->update([
            'project_title' => $request->project_title,
            'description' => $request->description,
            // 'image' => $newImagePath ?? null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'timeline' => \Carbon\Carbon::parse($request->start_date)->diffInDays($request->end_date),
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    // Delete a project
    public function delete($id)
    {
        $project = Project::findOrFail($id);

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }

    
}
