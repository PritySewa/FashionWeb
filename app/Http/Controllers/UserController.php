<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->title = 'User';
        $this->route = 'users.';
        $this->resources = 'users.';


    }

    public function index()
    {
        $info = $this->crudInfo();
        $info['users'] = User::all();
        return view($this->indexResource(), $info);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('role', 'LIKE', "%{$query}%")
            ->get();

        return view('users.searchresult', ['users' => $users])->render();    }




}
