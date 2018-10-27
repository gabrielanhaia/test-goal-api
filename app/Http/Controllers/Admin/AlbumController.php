<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
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
     * Show the albums list.
     *
     * @param $projectId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($projectId)
    {
        $project = Project::find($projectId);

        return view('admin.projects.albums.list', [
            'project' => $project,
            'breadcrumbs' => [
                [
                    'name' => 'Listar Albuns',
                    'url' => '#',
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
     * Cria um novo album.
     *
     * @param Request $request
     * @param $projectId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(Request $request, $projectId)
    {
        $album = new Album([
            'name' => (new \DateTime)->format('d/m/Y H:i'),
            'project_id' => $projectId
        ]);

        $album->save();

        return response('', 200);
    }

    /**
     * @param integer $albumId Identificador do album.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($projectId, $albumId)
    {
        return view('admin.projects.albums.test', [
            'album' => Album::find($albumId),
            'project' => Project::find($projectId)
        ]);
    }
}
