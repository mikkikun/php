<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function add()
    {
        return view('admin.post.create');
    }

    public function create(Request $request)
    {
        return redirect('admin/post/create');
    }  

    
}
