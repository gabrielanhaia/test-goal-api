<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.list', [
            'users' => $users,
            'breadcrumbs' => [
                [
                    'name' => 'Listar Usuários',
                    'url' => '',
                    'class' => 'active'
                ]
            ]
        ]);
    }

    /**
     * Editar usuários.
     *
     * @param integer $userId Identificador do usuário a ser editado.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($userId)
    {
        $user = User::find($userId);

        return view('admin.users.edit', [
            'user' => $user,
            'breadcrumbs' => [
                [
                    'name' => 'Editar Usuário',
                    'url' => '',
                    'class' => 'active'
                ],
                [
                    'name' => 'Listar Usuários',
                    'url' => 'usuarios',
                    'class' => ''
                ]
            ]
        ]);
    }
}
