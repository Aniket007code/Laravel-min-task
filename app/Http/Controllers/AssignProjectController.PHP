<?php

namespace App\Http\Controllers;

use App\Models\AssignedProject;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignProjectController extends Controller
{
    public function index(){
        $assignProjectsonlyIds = AssignedProject::all();

        $assignProjects = [];
        foreach ($assignProjectsonlyIds as $assignProject) {
            $project = Project::find($assignProject->project_id);

            $employeeIDS = explode(',', $assignProject->employee_id);
             $employeeNames=Employee::whereIn('id', $employeeIDS)->pluck('name');
             $finalEmployeeNames = implode(',', $employeeNames->toArray());

            if ($project) {
                $assignProjects[] = collect([
                    'id' => $assignProject->id,
                    'project_title' => $project->project_title,
                    'employee_name' => $finalEmployeeNames,
                ]);
            }
        }


        return view('assignProjectPages.assignProjectListing', compact('assignProjects'));
    }

    public function create(){

        
        $projects=Project::select('id', 'project_title as title')->get();
        $employees=Employee::select('id', 'name')->get();
        
        return view('assignProjectPages.assignProjectCreate',compact('projects','employees'));
    }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'project_ids' => 'required',
            'employees' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($request->all());

        AssignedProject::create([
            'project_id' => $request->project_ids,
            'employee_id' => implode(',', $request->employees),

        ]);

        return redirect()->route('assignProjects.index')->with('success', 'Project assigned successfully!');
    }

    public function edit($id){
        $assignProject = AssignedProject::findOrFail($id);

        $projects=Project::select('id', 'project_title as title')->get();
        $employees=Employee::select('id', 'name')->get();
        return view('assignProjectPages.assignProjectEdit', compact('assignProject','projects','employees'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'project_ids' => 'required',
            'employees' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        AssignedProject::where('id', $id)->update([
            'project_id' => $request->project_ids,
            'employee_id' => implode(',', $request->employees),

        ]);

        return redirect()->route('assignProjects.index')->with('success', 'Project updated successfully!');
    }
    public function delete($id){
        AssignedProject::where('id', $id)->delete();
        return redirect()->route('assignProjects.index')->with('success', 'Project deleted successfully!');
    }



}