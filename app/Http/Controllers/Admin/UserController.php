<?php

namespace App\Http\Controllers\Admin;

use App\AccessType;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Atualiza um usuário.
     *
     * @param integer $userId Identificador do usuário a ser editado.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($userId, Request $request)
    {
        $user = User::find($userId);

        $updateData = [
            'name' => $request->get('name'),
            'description' => $request->get('description', ''),
            'email' => $request->get('email'),
        ];

        if (!empty($request->get('password'))) {
            $updateData['password'] = Hash::make($request->get('password'));
        }

        $user->update($updateData);

        if (!empty($request->get('type'))) {
            $userType = AccessType::where([
                'type' => $request->get('type')
            ])->first();

            $userType->users()->save($user);
        }

        return redirect('usuarios');
    }

    /**
     * Exibe a view de cadastro de um novo usuário.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create', [
            'breadcrumbs' => [
                [
                    'name' => 'Cadastrar Usuário',
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

    /**
     * Cadastra um novo usuário.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $userType = AccessType::where([
            'type' => $request->get('type')
        ])->first();

        $user = new User([
            'name' => $request->get('name'),
            'password' => Hash::make($request->get('password')),
            'description' => $request->get('description'),
            'email' => $request->get('email'),
            'access_type_id' => $userType->id
        ]);

        $user->save();

        return redirect('usuarios');
    }

    /**
     * Deleta um usuário do sistema.
     *
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($userId)
    {
        User::destroy($userId);

        return redirect('usuarios');
    }
}
