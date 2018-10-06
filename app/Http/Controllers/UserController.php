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
}
