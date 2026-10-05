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

    /* All Prorams */
     /* program detail Page */
    public function allprograms(string $slug){
        $pageTitle="Afcic Progams";
        //dd($slug);
        $programdetail=Program::where('slug', $slug)->firstOrFail();
       // dd($programdetail->slug);
         return view('frontend.dynamic.programDetails', compact('pageTitle','programdetail'));
    }
     /* stories Page */
    public function allstories(string $slug){
        $pageTitle="Success Stories";
        //dd($slug);
        $storydetail=Testmonial::where('slug', $slug)->firstOrFail();
       // dd($programdetail->slug);
         return view('frontend.dynamic.storiesDetails', compact('pageTitle','storydetail'));
    }
    /* CENTERS
     */
    public function trc()
    {
        $pageTitle = 'Temporary Rescue Center (TRC)';
        $meta_description = "Learn more about our Thika Resource Center and the services we provide to support children and families in need.";
        return view('frontend.static.trc', compact('pageTitle', 'meta_description'));
    }

    public function wcc()
    {
        $pageTitle = 'Working Children Center (WCC)';
        $meta_description = "Discover how our Women's Care Center empowers women and supports their families in Thika, Kenya.";
        return view('frontend.static.wcc', compact('pageTitle', 'meta_description'));
    }

}
