<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeDashboardController extends Controller
{
    public function index()
    {
        return view('welcome'); // adapte le nom de la vue si nécessaire
    }

}
