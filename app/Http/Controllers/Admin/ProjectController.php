<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest as AdminStoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illiminate\Http\Requests\Admin\StoreProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ? $request->per_page : 5;

        $projects = Project::paginate($perPage)->appends(['per_page' => $perPage]);
        return view("admin.projects.index", compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreProjectRequest $request)
    {
        $data = $request->validated();
        $newProject = new Project();
        $newProject->slug = Str::slug($request->title);
        if ($request->hasFile('thumb')) {
            $image_path = Storage::put('thumb', $request->thumb);
            $data['thumb'] = $image_path;
        }
        $newProject->fill($data);
        // dd($newProject);
        $newProject->save();

        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', ['project' => $newProject->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->all();
        $project->update($data);

        $project->technologies()->sync(($request->technologies));

        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Project $project)
    {
        $project->technologies()->detach(); // non è obbligatorio con cascadeOnDelete
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Il progetto <span class="fw-bold">' . $project->title . '</span> è stato cancellato.');
    }
}
