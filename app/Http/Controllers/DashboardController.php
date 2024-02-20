<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $ideas = Idea::orderBy('created_at', 'DESC');

        //check if their is a search
        //if there is check search value with our database
        if (request()->has('search')) {
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }

        // dump(Idea::all());
        return view('dashboard', [
            'ideas' => $ideas->paginate(5)
        ]);
    }
}
