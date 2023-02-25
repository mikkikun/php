<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    public function map(Request $request)
    {
        return view('admin.map.map');
    }

}
