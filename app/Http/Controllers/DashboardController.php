<?php

namespace App\Http\Controllers;

use App\KartuKeluarga;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['kk'] = KartuKeluarga::all()->toJson();
        return view('templates.material.index', $data);
    }
}
