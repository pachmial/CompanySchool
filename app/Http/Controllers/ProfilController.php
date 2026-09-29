<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProfilController extends Controller
{

    public function index(): View
    {
        return view('profil.profil');
    }
}