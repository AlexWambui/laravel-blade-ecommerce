<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $count_users = User::whereNotIn('user_level', [0, 1])
            ->where('user_status', 1)
            ->count();
        $count_all_users = User::count();
        $messages = Message::latest()
            ->where('status', 0)
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'count_users',
            'count_all_users',
            'messages',
        ));
    }
}
