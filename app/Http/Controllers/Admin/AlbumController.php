<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Resources\AlbumSiteCollection;
use App\Http\Resources\PhotosAlbumSiteCollection;
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
        $this->middleware('auth', [
            'except' => [
                'listAlbumsSiteApi',
                'openAlbumSiteApi',
            ]
        ]);
    }

    /**
     * Show the albums list.
     *
     * @param $projectId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indx($projectId)
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
     * Lista albuns do site no admin.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexAlbumsSite()
    {
        $albums = Album::where('site' , '=', true)
            ->get();

        return view('admin.album_site.list', [
            'albums' => $albums,
            'breadcrumbs' => [
                [
                    'name' => 'Listar Albuns - Site',
                    'url' => '#',
                    'class' => 'active'
                ]
            ]
        ]);
    }

    /**
     * Lista os albuns do site no retorno da API.
     * @return mixed
     */
    public function listAlbumsSiteApi()
    {
        $albums = Album::where('site' , '=', true)
            ->get();

        return new AlbumSiteCollection($albums);
    }

    public function showAlbumProject($projectId, $albumId)
    {
        $album = Album::find($albumId);

        return view('admin.projects.albums.view', [
            'photos' => $album->photos
        ]);
    }
    
    public function openAlbumSiteApi($albumId)
    {
        $album = Album::where('site' , '=', true)
            ->where('id', '=', $albumId)
            ->first();

        return new PhotosAlbumSiteCollection($album->photos);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createAlbumSite()
    {
        return view('admin.album_site.create', [
            'breadcrumbs' => [
                [
                    'name' => 'Listar Albuns - Site',
                    'url' => '#',
                    'class' => 'active'
                ],
                [
                    'name' => 'Criar Album - Site',
                    'url' => '#',
                    'class' => 'active'
                ]
            ]
        ]);
    }

    /**
     * Cria um novo album do site.
     *
     * @param Request $request
     * @param $projectId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function storeAlbumSite(Request $request)
    {
        $album = new Album([
            'name' => $request->post('name'),
            'site' => 1
        ]);

        $album->save();

        return redirect('albuns');
    }

    /**
     * Edita album do site.
     *
     * @param integer $albumId Identificador do album.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAlbumSite($albumId)
    {
        return view('admin.album_site.edit', [
            'album' => Album::find($albumId),
        ]);
    }

    /**
     * Edita album do site.
     *
     * @param integer $albumId Identificador do album.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateAlbumSite($albumId, Request $request)
    {
        $album = Album::find($albumId);

        $album->update([
            'name' => $request->post('name'),
        ]);

        return redirect('albuns');
    }

    /**
     * Carrega a página de atualização de fotos de albuns do site.
     *
     * @param int $albumId Identificador do album.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAlbumSiteImages($albumId)
    {
        return view('admin.album_site.photos', [
            'album' => Album::find($albumId),
        ]);
    }

    /**
     * @param integer $albumId Identificador do album.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($projectId, $albumId)
    {
        return view('admin.projects.albums.photos', [
            'album' => Album::find($albumId),
            'project' => Project::find($projectId)
        ]);
    }

    /**
     * Método responsável por deletar um album do site.
     *
     * @param $albumId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAlbumSite($albumId)
    {
        $album = Album::find($albumId);

        if (!empty($album)) {
            $album->delete();
        }

        return back();
    }
}
