<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the projects list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.list', [
            'projects' => $projects,
            'breadcrumbs' => [
                [
                    'name' => 'Listar Projetos',
                    'url' => '#',
                    'class' => 'active'
                ]
            ]
        ]);
    }

    /**
     * @param $projectId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($projectId)
    {
        $project = Project::find($projectId);

        $usersProject = [];
        foreach ($project->users as $user) {
            $usersProject[$user->id] = $user;
        }

        return view('admin.projects.edit', [
            'project' => $project,
            'usersProject' => $usersProject,
            'users' => User::all(),
            'breadcrumbs' => [
                [
                    'name' => 'Editar Projeto',
                    'url' => '',
                    'class' => 'active'
                ],
                [
                    'name' => 'Listar Projetos',
                    'url' => 'projetos',
                    'class' => ''
                ]
            ]
        ]);
    }

    /**
     * @param $projectId
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($projectId, Request $request)
    {
        $project = Project::find($projectId);

        $project->update([
            'title' => $request->get('title'),
            'description' => $request->get('description', ''),
            'address' => $request->get('address'),
        ]);

        $project->users()->sync($request->get('users', []));

        return redirect('projetos');
    }

    public function create()
    {
        return view('admin.projects.create', [
            'users' => User::all(),
            'breadcrumbs' => [
                [
                    'name' => 'Cadastrar Projeto',
                    'url' => '',
                    'class' => 'active'
                ],
                [
                    'name' => 'Listar Projetos',
                    'url' => 'projetos',
                    'class' => ''
                ]
            ]
        ]);
    }

    public function save(Request $request)
    {

        $project = new Project([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'address' => $request->get('address'),
        ]);

        $project->save();
        $project->users()
            ->sync($request->get('users', []));

        return redirect('projetos');
    }
}
