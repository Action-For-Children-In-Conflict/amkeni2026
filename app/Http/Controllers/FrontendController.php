<?php

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function index()
    {
        $title = 'Action for Children in Conflict (AfCiC) — Thika, Kenya';
        $meta_description = "AfCiC protects and empowers children and vulnerable families in Thika, Kenya through child protection, education, women's empowerment and climate action.";

        return view('frontend.index', compact('title', 'meta_description'));
    }
}
