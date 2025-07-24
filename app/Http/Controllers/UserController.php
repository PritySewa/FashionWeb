<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

    public function admin()
    {
        $totalUsers = User::count();

        $newUsers = User::where('created_at', '>=', now()->subDays(7))->count();

        // Just set activeUsers to totalUsers or 0 for now
        $activeUsers = 0; // or $totalUsers if you want

        return view('dashboard', compact('totalUsers', 'activeUsers', 'newUsers'));
    }




}
