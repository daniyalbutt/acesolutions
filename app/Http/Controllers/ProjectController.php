<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:project')->only('index');
        $this->middleware('permission:create project')->only(['create','store']);
        $this->middleware('permission:edit project')->only(['edit','update']);
        $this->middleware('permission:delete project')->only('destroy');
    }

    public function index(Request $request)
    {
        $data = Project::orderBy('id', 'desc');
        $user = auth()->user();
        if ($user->hasRole('user')) {
            $data = $data->where('user_id', $user->id);
        }elseif ($user->hasRole('admin') && $user->can('project')) {
            $data = $data->with('user');
        } 
        else {
            abort(403, "Unauthorized");
        }
        $data = $data->paginate(20);
        return view('project.index', compact('data'));
    }

    public function create(){
        return view('project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name'      => 'required|string|max:255',
            'company_address'   => 'required|string|max:255',
            'name'              => 'required|string|max:255',
            'company_phone'     => 'required|string|max:50',
            'company_email'     => 'required|email|max:255',
            'description'       => 'nullable|string',
            'additional_notes'  => 'nullable|string',
            'file'              => 'required|file|mimes:pdf,doc,docx,dwg,dxf|max:10240', // 10MB
        ]);
        $filePath = null;
        $project = new Project();
        $project->company_name      = $request->company_name;
        $project->company_address   = $request->company_address;
        $project->name              = $request->name;
        $project->company_phone     = $request->company_phone;
        $project->company_email     = $request->company_email;
        $project->description       = $request->description;
        $project->additional_notes  = $request->additional_notes;
        $project->file              = $filePath;
        $project->status            = 0;
        $project->user_id           = auth()->id();
        $project->save();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filePath = $file->storeAs('projects/' . $project->id, $originalName, 'public');
            $project->file = $filePath;
            $project->save();
        }
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $user = auth()->user();
        if ($user->hasRole('user') && $project->user_id != $user->id) {
            abort(403, "Unauthorized access");
        }
        if ($user->hasRole('admin') && !$user->can('edit project')) {
            abort(403, "Unauthorized access");
        }
        return view('project.create', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        if (!auth()->user()->hasRole('admin') && $project->user_id != auth()->id()) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'company_name'      => 'required|string|max:255',
            'company_address'   => 'required|string|max:255',
            'name'              => 'required|string|max:255',
            'company_phone'     => 'required|string|max:50',
            'company_email'     => 'required|email|max:255',
            'description'       => 'nullable|string',
            'additional_notes'  => 'nullable|string',
        ]);
        $project->company_name      = $request->company_name;
        $project->company_address   = $request->company_address;
        $project->name              = $request->name;
        $project->company_phone     = $request->company_phone;
        $project->company_email     = $request->company_email;
        $project->description       = $request->description;
        $project->additional_notes  = $request->additional_notes;
        $project->save();
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function uploadFile(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,dwg,dxf|max:10240',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $filePath = $file->storeAs('projects/' . $project->id, $originalName, 'public');

        ProjectFile::create([
            'project_id' => $project->id,
            'file' => $filePath,
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function projectFiles($id)
    {
        $project = Project::findOrFail($id);
        $files = ProjectFile::where('project_id', $project->id)->get();
        $userId = auth()->id();
        $isAdmin = auth()->user()->hasRole('admin');
        $allFiles = collect();
        if (!empty($project->file)) {
            $allFiles->push((object)[
                'id' => null, 
                'file' => $project->file, 
                'uploaded_by' => $project->user_id,
                'source' => 'project_main_file' 
            ]);
        }
        $allFiles = $allFiles->merge($files);
        if ($isAdmin) {
            $userFiles = $allFiles->where('uploaded_by', '!=', $userId)->values();
            $adminFiles = $allFiles->where('uploaded_by', $userId)->values();
        } else {
            $userFiles = $allFiles->where('uploaded_by', $userId)->values();
            $adminFiles = $allFiles->where('uploaded_by', '!=', $userId)->values();
        }
        return view('project.files-modal', compact('adminFiles', 'userFiles', 'project'));
    }



}
