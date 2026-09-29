<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Program;
use App\Models\Testmonial;

class FrontendController extends Controller
{
    public function index()
    {
        $title = 'Action for Children in Conflict (AfCiC) — Thika, Kenya';
        $meta_description = "AfCiC protects and empowers children and vulnerable families in Thika, Kenya through child protection, education, women's empowerment and climate action.";
        $programs = Program::with('tag')->latest()->paginate(4);
        $testmonialstories = Testmonial::latest()->paginate(3);
        $partners = Partner::latest()->get();

        // dd($programs);
        return view('frontend.index', compact('title', 'meta_description', 'programs', 'testmonialstories', 'partners'));
    }
}
