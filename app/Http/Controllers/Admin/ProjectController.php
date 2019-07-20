<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Resources\AlbumSiteCollection;
use App\Http\Resources\PhotosAlbumSiteCollection;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [
                'list',
                'listAlbumsProject',
                'listPhotosAlbumsProject'
            ]
        ]);
    }

    /**
     * Show the projects list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $projects = Project::all();
        } else {
            $projects = Project::whereHas('users', function ($query) {
                $query->where('users.id', '=', Auth::user()->id);
            })->get();
        }

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
            'description' => $request->post('description', ''),
            'address' => $request->get('address', ''),
        ]);

        $project->save();
        $project->users()
            ->sync($request->get('users', []));

        return redirect('projetos');
    }

    /**
     * Lista os projetos de um usuário.
     *
     * @return mixed
     */
    public function list()
    {
        $projects = Project::whereHas('users', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->get();

        return $projects;
    }

    /**
     * Lista albuns de um projeto específico.
     *
     * @param $idProject
     * @return AlbumSiteCollection|\Illuminate\Http\JsonResponse
     */
    public function listAlbumsProject($idProject)
    {
        $project = Project::where('id', '=', $idProject)
            ->whereHas('users', function ($query) {
            $query->where('users.id', '=', Auth::user()->id);
        })->first();

        if (empty($project)) {
            return response()->json(['Projeto não encontrado.'], 404);
        }

        return new AlbumSiteCollection($project->albums);
    }

    /**
     * Lista fotos de um album especifico de um projeto
     *
     * @param $idProject
     * @return PhotosAlbumSiteCollection
     */
    public function listPhotosAlbumsProject($idProject, $idAlbum)
    {
        $project = Project::where('id', '=', $idProject)
            ->whereHas('users', function ($query) {
                $query->where('users.id', '=', Auth::user()->id);
            })->first();

        if (empty($project)) {
            return response()->json(['Projeto não encontrado.'], 404);
        }

        if (empty($project->albums)) {
            return response()->json(['Album não encontrado.'], 404);
        }

        foreach ($project->albums as $album) {
            if ($album->id == $idAlbum) {
                return new PhotosAlbumSiteCollection($album->photos);
            }
        }

        return response()->json(['Album não encontrado.'], 404);
    }
}
