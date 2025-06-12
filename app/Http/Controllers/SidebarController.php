<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function refreshSidebar()
    {
        $kriteriaList = KriteriaModel::all();
        return view('partials.sidebar_kriteria', compact('kriteriaList'));
    }
}
