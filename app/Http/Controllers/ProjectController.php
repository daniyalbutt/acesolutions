<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectCreatedMail;
use App\Mail\ProjectFileUploadedMail;

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
            'company_phone'     => 'required|numeric',
            'company_email'     => 'required|email|max:255',
            'description'       => 'nullable|string',
            'additional_notes'  => 'nullable|string',
            'file'              => 'required|file|mimes:pdf,doc,docx,dwg,dxf',
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
            $projectFile = new ProjectFile();
            $projectFile->project_id = $project->id;
            $projectFile->uploaded_by = auth()->id();
            $projectFile->save();
            $filePath = $file->storeAs(
                'projects/' . $project->id . '/file/' . $projectFile->id,
                $originalName,
                'public'
            );
            $projectFile->file = $filePath;
            $projectFile->save();
        }
        $adminEmail = config('mail.admin_email');
        Mail::to($adminEmail)->send(new ProjectCreatedMail($project));
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

    public function uploadFile(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'file' => 'required|file|mimes:pdf,doc,docx,dwg,dxf',
        ]);
        $project = Project::findOrFail($request->project_id);
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $projectFile = new ProjectFile();
        $projectFile->project_id = $project->id;
        $projectFile->uploaded_by = auth()->id();
        $projectFile->file = '';
        $projectFile->save();
        $filePath = $file->storeAs(
            'projects/' . $project->id . '/file/' . $projectFile->id,
            $originalName,
            'public'
        );
        $projectFile->file = $filePath;
        $projectFile->save();
        $adminEmail = config('mail.admin_email');
        Mail::to($adminEmail)->send(new ProjectFileUploadedMail($project, auth()->user()));
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function projectFiles($id)
    {
        $project = Project::findOrFail($id);
        $user = auth()->user();
        $userId = $user->id;
        $isAdmin = $user->hasRole('admin');
        $files = ProjectFile::where('project_id', $project->id)->get();
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
            // Admin sees all files
            $userFiles = $allFiles->filter(fn($f) => !empty($f->file));
            $adminFiles = $allFiles->filter(fn($f) => !empty($f->admin_file));
        } else {
            $userFiles = $allFiles->filter(fn($f) => $f->uploaded_by == $userId && !empty($f->file));
            $adminFiles = $allFiles->filter(fn($f) => !empty($f->admin_file));
        }
        return view('project.files-modal', compact('adminFiles', 'userFiles', 'project'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $user = auth()->user();
        if (!$user->hasRole('admin') || !$user->can('edit project')) {
            abort(403, "Unauthorized access");
        }
        return view('project.show', compact('project'));
    }

    public function adminUploadFile(Request $request, $id){
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,dwg,dxf',
        ]);
        $user = auth()->user();
        $files = ProjectFile::find($id);
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs(
            'projects/' . $files->project_id . '/file/' . $files->id,
            $originalName,
            'public'
        );
        $files->admin_file = $filePath;
        $files->save();
        $project = Project::findOrFail($files->project_id);
        Mail::to($project->user->email)->send(new ProjectFileUploadedMail($project, auth()->user()));
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function updateStatus(Request $request, Project $project)
    {
        $project->status = $request->status;
        $project->save();
        return redirect()->back()->with('success', 'Project status updated successfully!');
    }





}
